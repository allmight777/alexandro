@extends('gestionnaire.affectations.layouts.gestionlay')

@section('content')
    <h2>Liste des affectations</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Équipement</th>
                <th>Employé</th>
                <th>Date d'affectation</th>
                <th>Date de retour</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($affectations as $affectation)
                <tr>
                    <td>{{ $affectation->id }}</td>
                    <td>{{ $affectation->equipement->nom ?? 'N/A' }}</td>
                    <td>{{ $affectation->user->name ?? 'N/A' }}</td>
                    <td>{{ $affectation->date_affectation }}</td>
                    <td>{{ $affectation->date_retour ?? '-' }}</td>
                    <td>
                        <!-- boutons Modifier / Supprimer selon ton besoin -->
                        <a href="#">Modifier</a> |
                        <a href="#">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
