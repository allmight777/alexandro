@extends('gestionnaire.affectations.layouts.gestionlay')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Liste des affectations</h4>
            <a href="{{ route('gestionnaire.affectations.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouvelle affectation
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            @if($affectations->isEmpty())
                <div class="alert alert-info">Aucune affectation enregistrée pour le moment.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Équipement</th>
                                <th>Employé</th>
                                <th>Date de retour</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($affectations as $index => $affectation)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $affectation->equipement->nom ?? 'N/A' }}</td>
                                    <td>{{ $affectation->user->nom ?? 'N/A' }} {{ $affectation->user->prenom ?? '' }}</td>
                                    <td>{{ $affectation->date_retour ?? '-' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning me-1">
                                            <i class="bi bi-pencil-square"></i> Modifier
                                        </a>
                                        <form action="#" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette affectation ?')">
                                                <i class="bi bi-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
