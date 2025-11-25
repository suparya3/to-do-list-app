@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-calendar-week me-2"></i>Weekly Task ({{ $startOfWeek->format('d M') }} - {{ $endOfWeek->format('d M, Y') }})</h2>
    </div>

    @if($todos->count() > 0)
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Tugas Mingguan</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-0"><i class="fas fa-tasks me-1"></i> Nama Kegiatan</th>
                            <th class="border-0"><i class="fas fa-clock me-1"></i> Deadline</th>
                            <th class="border-0"><i class="fas fa-info-circle me-1"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                        <tr class="animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.06 }}s;">
                            <td class="fw-medium">{{ $todo->judul }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-calendar me-1"></i> {{ $todo->deadline }}
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
            <i class="fas fa-clipboard-list text-ligh mb-3" style="font-size: 3rem;"></i>
            <h4 class="text-ligh">Tidak ada tugas untuk minggu ini</h4>
            <p class="text-ligh mb-4">Silakan tambah tugas baru</p>
            <a href="{{ route('todo.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Tugas Baru
            </a>
        </div>
    </div>
    @endif
</div>
@endsection