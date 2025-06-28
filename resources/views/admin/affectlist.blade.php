@extends("admin.layouts.adminlay")
@section("content")

<div class="container-fluid mt-4 px-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Liste des Affectations</h4>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
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
                                <td class="text-nowrap">{{ $index + 1 }}</td>
                                <td class="text-nowrap">{{ $affectation->equipement->nom ?? 'Inconnu' }}</td>
                                <td class="text-nowrap">{{ $affectation->quantite_affectee ?? 1 }}</td>
                                <td class="text-nowrap">{{ $affectation->user->nom }} {{ $affectation->user->prenom }}</td>
                                <td class="text-nowrap">{{ $affectation->created_by ?? 'Admin' }}</td>
                                <td class="text-nowrap">{{ $affectation->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune affectation enregistrée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
