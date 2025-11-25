@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
  <h2><i class="fas fa-calendar-alt me-1"></i> Jadwal</h2>
  </div>
  

  @forelse($todos as $todo)
  <div class="container">
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
<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-clipboard-list text-ligh mb-3" style="font-size: 3rem;"></i>
        <h4 class="text-ligh">Belum ada jadwal</h4>
        <p class="ligh-muted mb-4">Silakan tambahkan jadwal baru terlebih dahulu</p>

        <a href="{{ route('todo.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Jadwal Baru
        </a>
    </div>
</div>
@endempty
</div>

@endsection
