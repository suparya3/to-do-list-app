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
                      ->orderBy('jam')
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
            'jam' => 'required|date_format:H:i',
            'deadline' => 'required|date',
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
            'jam' => 'required',
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
}
