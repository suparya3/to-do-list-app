<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())
                      ->orderBy('tanggal')
                      ->orderBy('jam_mulai')
                      ->orderBy('jam_selesai')
                      ->get();
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            // 'jam' => 'required|date_format:H:i',
            'deadline' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
        ]);

        $data['user_id'] = auth()->id();
        Todo::create($data);
        return redirect()->route('todo.index')->with('success', 'Jadwal berhasil ditambahkan!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return view('todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'deadline' => 'required|date',
            'status' => 'nullable|boolean',
        ]);

        $todo->update($data);
        return redirect()->route('todo.index')->with('success', 'Jadwal berhasil diperbarui!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Jadwal berhasil dihapus!.');
    }

    // Toggle status (selesao/belum)
    public function toggle(Todo $todo)
    {
        $todo->status = !$todo->status;
        $todo->save();
        return redirect()->back();
    }

    public function daily(Request $request)
    {
        $date = $request->date ?? now()->toDateString();
        $todos = Todo::where('user_id', auth()->id())
                      ->whereDate('tanggal', $date)
                      ->get();

        return view('todo.daily', compact('todos', 'date'));
    }

    public function weekly()
    {
        $startOfWeek = now()->startOfWeek(); //senin
        $endOfWeek = now()->endOfWeek(); //minggu

        $todos = Todo::where('user_id', auth()->id())
                      ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                      ->get();

        return view('todo.weekly', compact('todos', 'startOfWeek', 'endOfWeek'));
    }
    public function rekomendasi()
{
    $userId = auth()->id();

    // Ambil semua todo user
    $todos = Todo::where('user_id', $userId)->get();

    // Hitung jumlah tugas minggu ini
    $weeklyTasks = Todo::where('user_id', $userId)
                        ->whereBetween('tanggal', [
                            now()->startOfWeek(), 
                            now()->endOfWeek()
                        ])->count();

    $todos = $todos->map(function ($todo) use ($weeklyTasks) {

        // === 1. Hitung Urgensi (Deadline) ===
        $daysLeft = now()->diffInDays($todo->deadline, false);

        if ($daysLeft <= 0) {
            $urgency = 100;               // Sudah deadline, paling penting
        } else {
            $urgency = max(5, 30 - $daysLeft);  
        }

        // === 2. Hitung Durasi Tugas ===
        if ($todo->jam_mulai && $todo->jam_selesai) {
            $durationMinutes = 
                (strtotime($todo->jam_selesai) - strtotime($todo->jam_mulai)) / 60;

            if ($durationMinutes <= 0) {
                $durationMinutes = 5;
            }

            // Skor durasi
            $duration = min(30, $durationMinutes / 2);  
        } else {
            // Jika user tidak mengisi jam
            $duration = 10; 
        }

        // === 3. Hitung Workload Mingguan ===
        if ($weeklyTasks == 0) {
            $workload = 5;
        } else {
            $workload = min(50, $weeklyTasks * 3);
        }

        // === 4. Total Skor Prioritas ===
        $todo->priority_score = $urgency + $duration + $workload;
        // warna berdasarkan skor
        if ($todo->priority_score >= 80) {
            $todo->priority_level = 'high';   // merah
        } elseif ($todo->priority_score >= 50) {
            $todo->priority_level = 'medium'; // kuning
        } else {
            $todo->priority_level = 'low';    // hijau
        }

        return $todo;
    });

    // urutkan highest score → lowest
    $todos = $todos->sortByDesc('priority_score');

    return view('todo.rekomendasi', compact('todos'));
}

}
