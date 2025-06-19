@extends('gestionnaire.rapports.layouts.gestionlay')@extends('gestionnaire.rapports.layouts.gestionlay')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0">
                    <i class="fas fa-file-alt me-2"></i>Mes Rapports
                </h2>
                <a href="{{ route('gestionnaire.rapports.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Nouveau rapport
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date</th>
                            <th>Contenu</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapports as $rapport)
                            <tr>
                                <td class="text-center">{{ $rapport->id }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $rapport->created_at->format('d/m/Y') }}
                                    </span>
                                    <small class="text-muted d-block">
                                        {{ $rapport->created_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ Str::limit($rapport->titre, 30) }}</div>
                                    <small class="text-muted">{{ Str::limit($rapport->contenu, 50) }}</small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('gestionnaire.rapports.download', $rapport->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       target="_blank"
                                       data-bs-toggle="tooltip" 
                                       title="Télécharger le PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('gestionnaire.rapports.show', $rapport->id) }}" 
                                       class="btn btn-sm btn-outline-secondary ms-1"
                                       data-bs-toggle="tooltip"
                                       title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($rapports->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucun rapport disponible</h5>
                    <p class="text-muted">Commencez par créer votre premier rapport</p>
                </div>
            @endif
        </div>

        @if($rapports->hasPages())
            <div class="card-footer">
                {{ $rapports->links() }}
            </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
    // Active les tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>
@endsection
@endsection