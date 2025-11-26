@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-calendar-alt me-2"></i> Jadwal</h2>
    <a href="{{ route('todo.create') }}" class="btn btn-primary">
      <i class="fas fa-plus me-1"></i> Tambah Jadwal
    </a>
  </div>

  @forelse($todos as $todo)
    <div class="todo-item animate-slide-in">
      <div class="todo-content">
        <div class="d-flex align-items-center mb-2">
          <form id="toggle-{{ $todo->id }}" method="POST" action="{{ route('todo.toggle', $todo) }}" class="me-3">
            @csrf
            <div class="form-check">
              <input class="form-check-input" type="checkbox" 
                     onchange="document.getElementById('toggle-{{ $todo->id }}').submit();" 
                     {{ $todo->status ? 'checked' : '' }}
                     style="width: 1.2rem; height: 1.2rem; cursor: pointer;">
            </div>
          </form>
          <div class="todo-title {{ $todo->status ? 'done' : '' }}">
            {{ $todo->judul }}
          </div>
        </div>
        
        <div class="todo-meta mb-2">
          <span class="badge badge-secondary me-2">
            <i class="fas fa-calendar me-1"></i>
            {{ $todo->tanggal->format('d M Y') }}
          </span>
          <span class="badge badge-secondary">
            <i class="fas fa-clock me-1"></i>
            {{ \Carbon\Carbon::parse($todo->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($todo->jam_selesai)->format('H:i') }}
          </span>
        </div>
        
        @if($todo->deskripsi)
          <div class="todo-description">
            {{ $todo->deskripsi }}
          </div>
        @endif
      </div>

      <div class="todo-actions">
        <a href="{{ route('todo.edit', $todo) }}" class="btn-action btn-edit" title="Edit">
          <i class="fas fa-edit"></i>
        </a>
        
        <form method="POST" action="{{ route('todo.destroy', $todo) }}" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-action btn-delete" title="Hapus">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      </div>
    </div>
  @empty
    <div class="card">
      <div class="card-body text-center py-5">
        <i class="fas fa-clipboard-list text-light mb-3" style="font-size: 3rem;"></i>
        <h4 class="text-light">Belum ada jadwal</h4>
        <p class="text-muted mb-4">Silakan tambahkan jadwal baru terlebih dahulu</p>
        <a href="{{ route('todo.create') }}" class="btn btn-primary">
          <i class="fas fa-plus me-1"></i> Tambah Jadwal Baru
        </a>
      </div>
    </div>
  @endforelse
</div>

<style>
  .todo-item {
    display: flex;
    align-items: flex-start;
    padding: 1.25rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    background-color: var(--card-bg);
    border: 1px solid var(--card-border);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
  }

  .todo-item:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    border-color: var(--primary-color);
  }

  .todo-content {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .todo-title {
    font-weight: 600;
    font-size: 1.1rem;
    color: #e2e8f0;
    margin-bottom: 0;
  }

  .todo-title.done {
    text-decoration: line-through;
    opacity: 0.6;
  }

  .todo-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
  }

  .todo-description {
    font-size: 0.95rem;
    color: #94a3b8;
    line-height: 1.4;
  }

  .todo-actions {
    display: flex;
    gap: 0.5rem;
    margin-left: 1rem;
  }

  .btn-action {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
  }

  .btn-edit {
    background-color: rgba(245, 158, 11, 0.1);
    color: var(--warning-color);
    border: 1px solid rgba(245, 158, 11, 0.3);
  }

  .btn-edit:hover {
    background-color: var(--warning-color);
    color: white;
  }

  .btn-delete {
    background-color: rgba(239, 68, 68, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(239, 68, 68, 0.3);
  }

  .btn-delete:hover {
    background-color: var(--danger-color);
    color: white;
  }

  .badge {
    font-weight: 500;
    padding: 0.4rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
  }

  .badge-secondary {
    background-color: #475569;
    color: #e2e8f0;
  }

  .form-check-input:checked {
    background-color: var(--success-color);
    border-color: var(--success-color);
  }

  .form-check-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25);
  }

  @media (max-width: 768px) {
    .todo-item {
      flex-direction: column;
      align-items: flex-start;
    }
    
    .todo-actions {
      margin-left: 0;
      margin-top: 1rem;
      width: 100%;
      justify-content: flex-end;
    }
    
    .todo-meta {
      flex-direction: column;
      align-items: flex-start;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const todoItems = document.querySelectorAll('.todo-item');
    todoItems.forEach((item, index) => {
      item.style.animationDelay = `${index * 0.1}s`;
      item.classList.add('animate-slide-in');
    });
  });
</script>
@endsection