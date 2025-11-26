@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-calendar-day me-2"></i>Daily Tasks - {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h2>
        <div class="d-flex align-items-center">
            <form method="GET" action="{{ route('todo.daily') }}" class="d-flex align-items-center">
                <input type="date" name="date" value="{{ $date }}" class="form-control me-2" style="width: 200px;">
                <button class="btn btn-primary">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </form>
        </div>
    </div>

    @if($todos->count() > 0)
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Tugas Harian</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-0"><i class="fas fa-tasks me-1"></i> Nama Kegiatan</th>
                            <th class="border-0"><i class="fas fa-align-left me-1"></i> Deskripsi</th>
                            <th class="border-0"><i class="fas fa-clock me-1"></i> Waktu</th>
                            <th class="border-0"><i class="fas fa-info-circle me-1"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                        <tr class="animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.06 }}s;">
                            <td>
                                <div class="fw-medium {{ $todo->status ? 'done' : '' }}">{{ $todo->judul }}</div>
                            </td>
                            <td>
                                @if($todo->deskripsi)
                                    <div class="small text-muted">{{ Str::limit($todo->deskripsi, 50) }}</div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    <i class="fas fa-clock me-1"></i> 
                                    {{ \Carbon\Carbon::parse($todo->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($todo->jam_selesai)->format('H:i') }}
                                </span>
                            </td>
                            <td>
                                @if($todo->status)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i> Selesai
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-clock me-1"></i> Belum Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-clipboard-list text-light mb-3" style="font-size: 3rem;"></i>
            <h4 class="text-light">Tidak ada tugas untuk hari ini</h4>
            <p class="text-light mb-4">Silakan tambah tugas baru atau pilih tanggal lain</p>
            <a href="{{ route('todo.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Tugas Baru
            </a>
        </div>
    </div>
    @endif
</div>

<style>
    .table {
        margin-bottom: 0;
    }
    
    .table-dark {
        background-color: var(--card-bg);
        border-color: var(--card-border);
    }
    
    .table-dark th {
        background-color: rgba(30, 41, 59, 0.8);
        border-bottom: 1px solid var(--card-border);
        color: #e2e8f0;
        font-weight: 600;
        padding: 1rem 0.75rem;
    }
    
    .table-dark td {
        border-color: var(--card-border);
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }
    
    .table-dark tbody tr:hover {
        background-color: rgba(139, 92, 246, 0.1);
        transform: translateX(2px);
        transition: all 0.3s ease;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        font-size: 0.8rem;
    }
    
    .bg-primary {
        background-color: var(--primary-color) !important;
    }
    
    .bg-success {
        background-color: var(--success-color) !important;
    }
    
    .bg-warning {
        background-color: var(--warning-color) !important;
    }
    
    .done {
        text-decoration: line-through;
        opacity: 0.7;
    }
    
    .text-muted {
        color: #94a3b8 !important;
    }
    
    .small {
        font-size: 0.85rem;
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table-dark th,
        .table-dark td {
            padding: 0.75rem 0.5rem;
            font-size: 0.9rem;
        }
        
        .badge {
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-flex.justify-content-between h2 {
            margin-bottom: 0;
        }
    }
</style>
@endsection