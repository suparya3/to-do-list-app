@extends('layouts.app')

@section('content')
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Tambah Jadwal</h5>

      <form method="POST" action="{{ route('todo.update', $todo) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input name="judul" value="{{ old('judul', $todo->judul) }}" class="form-control" required>
          @error('judul') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $todo->deadline) }}">
            @error('deadline') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi (opsional)</label>
          <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $todo->deskripsi) }}</textarea>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $todo->tanggal) }}" class="form-control" required>
            @error('tanggal') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Jam</label>
            <input type="time" name="jam" value="{{ old('jam', $todo->jam) }}" class="form-control" required>
            @error('jam') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="{{ route('todo.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
@endsection
