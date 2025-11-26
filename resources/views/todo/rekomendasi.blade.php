@extends('layouts.app')

@section('content')
<div class="container">

    @if($todos->count() > 0)
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list-ol me-2"></i>Urutan Prioritas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-0">#</th>
                            <th class="border-0"><i class="fas fa-tasks me-1"></i> Nama Tugas</th>
                            <th class="border-0"><i class="fas fa-calendar me-1"></i> Deadline</th>
                            <th class="border-0"><i class="fas fa-calendar me-1"></i> deskripsi</th>
                            <th class="border-0"><i class="fas fa-clock me-1"></i> Waktu</th>
                            <th class="border-0"><i class="fas fa-star me-1"></i> Skor</th>
                            <th class="border-0"><i class="fas fa-info-circle me-1"></i> Status</th>
                            <th class="border-0"><i class="fas fa-flag me-1"></i> Prioritas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                        <tr class="animate__animated animate__fadeInUp priority-row-{{ $todo->priority_level }}" 
                            style="animation-delay: {{ $loop->index * 0.05 }}s;">
                            <td class="fw-bold text-primary">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-medium {{ $todo->status ? 'done' : '' }}">{{ $todo->judul }}</div>
                                
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $todo->deadline->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                @if($todo->deskripsi)
                                    <h6><div class="small text-light mt-1">{{ Str::limit($todo->deskripsi, 40) }}</div></h6>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($todo->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($todo->jam_selesai)->format('H:i') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge priority-badge-{{ $todo->priority_level }}">
                                    <i class="fas fa-star me-1"></i>
                                    {{ number_format($todo->priority_score, 0) }}
                                </span>
                            </td>
                            <td>
                                @if($todo->status)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i> Selesai
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-clock me-1"></i> Belum
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge priority-label-{{ $todo->priority_level }}">
                                    @if($todo->priority_level == 'high')
                                        <i class="fas fa-exclamation-triangle me-1"></i>Tinggi
                                    @elseif($todo->priority_level == 'medium')
                                        <i class="fas fa-exclamation-circle me-1"></i>Sedang
                                    @else
                                        <i class="fas fa-info-circle me-1"></i>Rendah
                                    @endif
                                </span>
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
            <h4 class="text-light">Belum ada tugas</h4>
            <p class="text-light mb-4">Silakan tambah tugas terlebih dahulu</p>
            <a href="{{ route('todo.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Tugas Baru
            </a>
        </div>
    </div>
    @endif
</div>

<style>
    /* Tambahan styling untuk tabel dengan prioritas */
    .priority-row-high {
        border-left: 4px solid var(--danger-color);
        background: linear-gradient(90deg, rgba(239, 68, 68, 0.05) 0%, var(--card-bg) 100%);
    }

    .priority-row-medium {
        border-left: 4px solid var(--warning-color);
        background: linear-gradient(90deg, rgba(245, 158, 11, 0.05) 0%, var(--card-bg) 100%);
    }

    .priority-row-low {
        border-left: 4px solid var(--success-color);
        background: linear-gradient(90deg, rgba(16, 185, 129, 0.05) 0%, var(--card-bg) 100%);
    }

    .priority-badge-high {
        background-color: var(--danger-color) !important;
        color: white;
    }

    .priority-badge-medium {
        background-color: var(--warning-color) !important;
        color: #1e293b;
    }

    .priority-badge-low {
        background-color: var(--success-color) !important;
        color: white;
    }

    .priority-label-high {
        background-color: rgba(239, 68, 68, 0.2) !important;
        color: var(--danger-color);
        border: 1px solid var(--danger-color);
    }

    .priority-label-medium {
        background-color: rgba(245, 158, 11, 0.2) !important;
        color: var(--warning-color);
        border: 1px solid var(--warning-color);
    }

    .priority-label-low {
        background-color: rgba(16, 185, 129, 0.2) !important;
        color: var(--success-color);
        border: 1px solid var(--success-color);
    }
</style>
@endsection