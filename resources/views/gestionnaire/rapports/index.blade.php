@extends('gestionnaire.rapports.layouts.gestionlay')

@section('content')
<div class="container-fluid py-4">
    <!-- Titre -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="h3 text-dark fw-bold mb-0">
                <i class="fas fa-file-alt text-primary me-2"></i>
                Mes Rapports
            </h2>
        </div>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Tableau dans une carte -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 fw-semibold text-muted">#</th>
                                    <th class="px-4 py-3 fw-semibold text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        Date
                                    </th>
                                    <th class="px-4 py-3 fw-semibold text-muted">
                                        <i class="fas fa-file-text me-1"></i>
                                        Contenu (extrait)
                                    </th>
                                    <th class="px-4 py-3 fw-semibold text-muted text-center">
                                        <i class="fas fa-download me-1"></i>
                                        PDF
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rapports as $rapport)
                                    <tr class="align-middle">
                                        <td class="px-4 py-3">
                                            <span class="badge bg-light text-dark fw-semibold px-3 py-2">
                                                {{ $rapport->id }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <div class="fw-semibold text-dark">
                                                    {{ $rapport->created_at->format('d/m/Y H:i') }}
                                                </div>
                                                <small class="text-muted">
                                                    {{ $rapport->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-dark" style="max-width: 400px;">
                                                {{ Str::limit($rapport->contenu, 50) }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('gestionnaire.rapports.download', $rapport->id) }}" 
                                               target="_blank" 
                                               class="btn btn-primary btn-sm px-3 py-2">
                                                <i class="fas fa-download me-1"></i>
                                                Voir / Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table > :not(caption) > * > * {
        padding: 1rem;
        border-color: #f1f3f4;
    }
    
    .table-hover > tbody > tr:hover > td {
        background-color: rgba(13, 110, 253, 0.04);
    }
    
    .badge {
        border-radius: 8px;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
    }
    
    .alert {
        border-radius: 10px;
    }
    
    .table thead th {
        background-color: #f8f9fa !important;
        border-bottom: 2px solid #e9ecef;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endsection