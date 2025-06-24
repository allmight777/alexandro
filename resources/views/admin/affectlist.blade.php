@extends("admin.layouts.adminlay")
@section("content")

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Liste des Affectations</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Équipement</th>
                        <th>Quantité</th>
                        <th>Affecté à</th>
                        <th>Effectué par</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($affectations as $index => $affectation)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $affectation->equipement->nom ?? 'Inconnu' }}</td>
                            <td>{{ $affectation->quantite_affectee ?? 1 }}</td>
                            <td>{{ $affectation->user->nom }} {{ $affectation->user->prenom }}</td>
                            <td>{{ $affectation->created_by ?? 'Admin' }}</td>
                            <td>{{ $affectation->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucune affectation enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
