@extends('admin.layouts.adminlay')
@section('content')
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
                                <th class="text-center">Équipement</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-center">Affecté à</th>
                                @if (auth()->user()->role === 'admin')
                                    <th>Effectué par</th>
                                @endif
                                <th class="text-center">Date</th>
                                <th class="text-center">date_retour</th>
                                <th class="text-center">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($affectations as  $affectation)
                                <tr>
                                    <td class="text-nowrap">{{$affectation->id}}</td>
                                    <td class="text-nowrap">{{ $affectation->equipement->nom ?? 'Inconnu' }}</td>
                                    <td class="text-nowrap">{{ $affectation->quantite_affectee ?? 1 }}</td>
                                    <td class="text-nowrap">{{ $affectation->user->nom }} {{ $affectation->user->prenom }}
                                    </td>
                                    @if (auth()->user()->role == 'admin')
                                        <td class="text-nowrap">{{ $affectation->created_by ?? 'Admin' }}</td>
                                    @endif
                                    <td class="text-nowrap">{{ $affectation->created_at->format('d/m/Y') }}</td>
                                    <td>{{$affectation->date_retour ? $affectation->date_retour->format('d/m/Y'):"Aucune date de retour enregistrée ou équipement non concerné par un retour."}}</td>
                                    <td class="text-nowrap">
                                        <form action="{{ route('affectations.destroy', $affectation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucune affectation enregistrée.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    <div class="mt-2">{{ $affectations->links() }}</div>
            </div>
        </div>
    </div>
@endsection
