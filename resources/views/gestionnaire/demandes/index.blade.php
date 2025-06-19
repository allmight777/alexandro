@extends('gestionnaire.demandes.layouts.gestionlay')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des demandes des employés</h2>

    @forelse($demandes as $demande)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Demande #{{ $demande->id }}</h5>
                <p><strong>Employé :</strong> {{ $demande->user->name }}</p>
                <p><strong>Lieu :</strong> {{ $demande->lieu }}</p>
                <p><strong>Motif :</strong> {{ $demande->motif }}</p>
                <p><strong>Statut :</strong> {{ ucfirst($demande->statut) }}</p>

                <h6>Équipements demandés :</h6>
                <ul>
                    @foreach($demande->equipementsDemandes as $ed)
                        <li>
                            {{ $ed->equipement->nom }} — Quantité : {{ $ed->nbr_equipement }}
                            (État : {{ $ed->equipement->etat }})
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Aucune demande n’a encore été soumise.</div>
    @endforelse
</div>
@endsection
