@extends('admin.layouts.adminlay')
@push('styles')
<style>
    .alert-hold {
        background-color: #fffbe6;
        border: 1px solid #ffe58f;
        color: #664d03;
    }
</style>
@endpush

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-circle-outline me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif
        @if (session('hold'))
            <div
                class="alert alert-hold shadow-sm d-flex align-items-center justify-content-between px-4 py-3 rounded mb-4 bg-warning">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-timer-sand fs-4 me-2 text-dark"></i>
                    <span class="text-dark fw-semibold">{{ session('hold') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <h4 class="mb-4 fw-bold text-primary">Liste des demandes d’équipement</h4>

        <div class="table-responsive">
            <table class="table table-striped align-middle table-bordered shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>Date</th>
                        <th>Équipement(s) demandés(Quantité)</th>
                        <th>Motif</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($demandes as $demande)
                        <tr>
                            <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                 @foreach ($demande->equipements as $equipement)
                                    {{ $equipement->nom }} ({{ $equipement->pivot->nbr_equipement }})<br>
                                 @endforeach
                            </td>
                            <td>{{ $demande->motif }}</td>
                            <td class="text-center">
                                {{-- Bouton Vérifier (ouvre modal) --}}
                                <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal"
                                    data-bs-target="#verificationModal{{ $demande->id }}">
                                    <i class="mdi mdi-eye-check-outline"></i> Vérifier
                                </button>

                                {{-- Bouton Rejeter --}}
                                <form action="{{ route('refuser.demande', $demande->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="mdi mdi-close-circle-outline"></i> Rejeter
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Vérification --}}
                        <div class="modal fade" id="verificationModal{{ $demande->id }}" tabindex="-1"
                            aria-labelledby="modalLabel{{ $demande->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="modalLabel{{ $demande->id }}">
                                            Vérification de la demande du {{ $demande->created_at->format('d/m/Y H:i') }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach ($demande->equipements as $equipement)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $equipement->nom }}</strong> – demandés :
                                                        <span class="badge bg-secondary">
                                                            {{ $equipement->pivot->nbr_equipement }}
                                                        </span>
                                                    </div>
                                                    @if ($equipement->quantite >= $equipement->pivot->nbr_equipement)
                                                        <span class="badge bg-success">Disponible</span>
                                                    @else
                                                        <span class="badge bg-danger">Stock insuffisant (stock actuel :
                                                            {{ $equipement->quantite }})</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('valider.demande', $demande->id) }}" method="POST"
                                            class="me-auto">
                                            @csrf @method('PUT')
                                            <button type="submit" class="btn btn-success">
                                                <i class="mdi mdi-check"></i> Valider
                                            </button>
                                        </form>

                                        <form action="{{ route('loading.demande', $demande->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <button type="submit" class="btn btn-warning">
                                                <i class="mdi mdi-timer-sand"></i> Mettre en attente
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucune demande pour le moment.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            <div class="mt-2">{{ $demandes->links() }}</div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
