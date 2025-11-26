@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-calendar-week me-2"></i>Weekly Task ({{ $startOfWeek->format('d M') }} - {{ $endOfWeek->format('d M, Y') }})</h2>
    </div>

    @if($todos->count() > 0)
    <div class="row">
        @foreach($todos as $todo)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="todo-item animate-slide-in" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                <div class="todo-content">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="todo-title {{ $todo->status ? 'done' : '' }}">
                            {{ $todo->judul }}
                        </div>
                        @if($todo->status)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i> Selesai
                            </span>
                        @else
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-clock me-1"></i> Belum
                            </span>
                        @endif
                    </div>
                    
                    <div class="todo-meta mb-3">
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge badge-secondary">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $todo->tanggal->format('d M Y') }}
                            </span>
                            <span class="badge badge-primary">
                                <i class="fas fa-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($todo->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($todo->jam_selesai)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                    
                    @if($todo->deskripsi)
                        <div class="todo-description">
                            {{ $todo->deskripsi }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-clipboard-list text-light mb-3" style="font-size: 3rem;"></i>
            <h4 class="text-light">Tidak ada tugas untuk minggu ini</h4>
            <p class="text-light mb-4">Silakan tambah tugas baru</p>
            <a href="{{ route('todo.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Tugas Baru
            </a>
        </div>
    </div>
    @endif
</div>

<style>
    .todo-item {
        display: flex;
        align-items: flex-start;
        padding: 1.25rem;
        border-radius: 12px;
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .todo-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
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
    }

    .todo-description {
        font-size: 0.9rem;
        color: #94a3b8;
        line-height: 1.4;
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

    .badge-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .bg-success {
        background-color: var(--success-color) !important;
    }

    .bg-warning {
        background-color: var(--warning-color) !important;
    }

    @media (max-width: 768px) {
        .todo-item {
            padding: 1rem;
        }
        
        .todo-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
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