@extends('gestionnaire.collaborateurs.layouts.gestionlay')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Liste des Collaborateurs Externes</h4>
        </div>
        <div class="card-body">

            @if($collaborateurs->isEmpty())
                <p class="text-center text-muted">Aucun collaborateur externe trouvé.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collaborateurs as $collaborateur)
                                <tr>
                                    <td>{{ $collaborateur->nom }}</td>
                                    <td>{{ $collaborateur->prenom }}</td>
                                    <td>
                                        <!-- <form action="{{ route('gestionnaire.collaborateurs.destroy', $collaborateur) }}" method="POST"></form> -->
                                        <form action="{{ route('gestionnaire.collaborateurs.destroy', $collaborateur->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce collaborateur ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="mdi mdi-delete"></i> Supprimer
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
