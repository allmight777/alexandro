@extends('gestionnaire.rapports.layouts.gestionlay')

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="fas fa-file-alt text-primary me-2"></i> Rapport n°{{ $rapport->id }}</h2>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3 text-muted">Créé le : {{ $rapport->created_at->format('d/m/Y H:i') }}</h5>
            <p style="white-space: pre-wrap;">{{ $rapport->contenu }}</p>
        </div>
    </div>

    <a href="{{ route('gestionnaire.rapports.download', $rapport->id) }}" class="btn btn-primary mt-3">
        <i class="fas fa-download me-1"></i> Télécharger le PDF
    </a>
</div>
@endsection
