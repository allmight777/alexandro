@extends('employee.homedash')

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle !important;
    }
</style>
@endpush

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Bienvenue -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h5 class="fw-normal text-muted">Bienvenue sur votre espace Toolzy</h5>
                <h3 class="fw-bold text-dark">Bonjour {{ $user->nom }} {{ $user->prenom }} !</h3>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a href="{{ route('page.aide') }}" class="btn btn-outline-info">
                    Aide <i class="mdi mdi-help-circle-outline ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Équipements & Actions rapides -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title fw-bold text-primary">Vos équipements</h4>
                        @if ($affectations->count() > 0)
                            <table class="table table-striped table-bordered table-hover align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Équipement</th>
                                        <th>Statut</th>
                                        <th>Date d'assignation</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($affectations as $aff)
                                        <tr>
                                            <td class="fw-semibold">{{ $aff->equipement->nom }}</td>
                                            <td>
                                                <span class="badge {{ $aff->equipement->etat === 'fonctionnel' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($aff->equipement->etat) }}
                                                </span>
                                            </td>
                                            <td>{{ $aff->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Aucun équipement pour le moment.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title fw-bold text-primary">Actions rapides</h4>
                        <div class="d-grid gap-2">
                            <a href="{{ route('demande.equipement') }}" class="btn btn-primary btn-lg">
                                <i class="mdi mdi-laptop"></i> Demander un équipement
                            </a>
                            <a href="{{ route('signaler.panne') }}" class="btn btn-danger btn-lg">
                                <i class="mdi mdi-alert"></i> Signaler une panne
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demandes & Pannes -->
        <div class="row">
            <!-- Demandes récentes -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title fw-bold text-primary">Demandes récentes</h4>
                        @if ($demandes->count())
                            <table class="table table-striped table-bordered align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($demandes as $demande)
                                        @php
                                            $badge = match($demande->statut) {
                                                'en_attente' => 'bg-warning',
                                                'acceptee' => 'bg-success',
                                                'rejetee' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <tr>
                                            <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="fw-semibold">{{ $demande->motif }}</td>
                                            <td><span class="badge {{ $badge }}">{{ ucfirst($demande->statut) }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Aucune demande récente.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pannes signalées -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title fw-bold text-primary">Pannes signalées</h4>
                        @if ($pannes->count())
                            <table class="table table-striped table-bordered table-hover align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Date</th>
                                        <th>Équipement</th>
                                        <th>Motif</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($pannes as $panne)
                                        <tr>
                                            <td>{{ $panne->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $panne->equipement->nom }}</td>
                                            <td>{{ $panne->description }}</td>
                                            <td>
                                                <span class="badge {{ $panne->statut === 'resolu' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($panne->statut) }}
                                                </span>
                                            </td>
                                            <td>
                                                <form method="POST" action="#">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Aucune panne signalée.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
