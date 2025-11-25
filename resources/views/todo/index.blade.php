@extends('layouts.app')

@section('content')
  <h3 class="mb-3">Jadwal Saya</h3>

  @forelse($todos as $todo)
    <div class="card mb-2 animate__animated animate__fadeInUp">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <form id="toggle-{{ $todo->id }}" method="POST" action="{{ route('todo.toggle', $todo) }}">
            @csrf
            <input type="checkbox" onchange="document.getElementById('toggle-{{ $todo->id }}').submit();" {{ $todo->status ? 'checked' : '' }}>
          </form>

          <strong class="{{ $todo->status ? 'done' : '' }}">
            {{ $todo->judul }}
          </strong>
          <div class="small text-muted">
            {{ $todo->tanggal->format('d M Y') }} - {{ \Carbon\Carbon::parse($todo->jam)->format('H:i') }}
          </div>
          @if($todo->deskripsi)
            <div class="mt-1">{{ $todo->deskripsi }}</div>
          @endif
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('todo.edit', $todo) }}" class="btn btn-sm btn-outline-warning">Edit</a>

          <form method="POST" action="{{ route('todo.destroy', $todo) }}" onsubmit="return confirm('Yakin ingin menghapus?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-info">Belum ada jadwal, tambahkan terlebih dahulu.</div>
  @endforelse
@endsection
