@extends('employee.homedash')

@push('styles')
    <style>
        .table thead th {
            background-color: #f1f3f5;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .table tbody tr:hover {
            background-color: #f9fcff;
        }

        .badge-status {
            font-size: 0.85rem;
            padding: 0.4em 0.7em;
            border-radius: 0.375rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-status i {
            font-size: 1rem;
        }

        .card-title {
            font-size: 1.2rem;
        }
    </style>
@endpush

@section('content')
<div class="main-panel">
    <div class="content-wrapper px-4 py-3">
        <h2 class="fw-bold mb-4 text-primary">📋 Mes pannes signalées</h2>

        <div class="card dashboard-card shadow-sm p-3">
            @if ($pannes->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Équipement</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pannes as $index => $panne)
                                <tr>
                                    <td class="text-muted">{{ $loop->iteration + ($pannes->currentPage() - 1) * $pannes->perPage() }}</td>
                                    <td class="fw-semibold">{{ $panne->equipement->nom }}</td>
                                    <td>
                                        <span title="{{ $panne->description }}">
                                            {{ Str::limit($panne->description, 50) }}
                                        </span>
                                    </td>
                                    <td>{{ $panne->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge-status 
                                            @if($panne->statut === 'resolu') bg-success
                                            @else bg-danger
                                            @endif text-white">
                                            <i class="mdi {{ $panne->statut === 'resolu' ? 'mdi-check-circle-outline' : 'mdi-alert-circle-outline' }}"></i>
                                            {{ ucfirst($panne->statut) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $pannes->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="no-data text-center">
                    <i class="mdi mdi-bug-outline fs-1 text-muted"></i>
                    <p class="text-muted">Aucune panne signalée pour le moment.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
