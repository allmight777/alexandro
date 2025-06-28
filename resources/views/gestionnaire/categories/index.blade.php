{{-- resources/views/categories/index.blade.php --}}

@extends('layouts.app') {{-- ou ton layout principal --}}

@section('content')
<div class="container">
    <h1>Liste des catégories</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('gestionnaire.categories.create') }}" class="btn btn-primary mb-3">Ajouter une catégorie</a>

    @if($categories->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                <tr>
                    <td>{{ $categorie->id }}</td>
                    <td>{{ $categorie->nom }}</td>
                    <td>{{ $categorie->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $categorie->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('gestionnaire.categories.edit', $categorie->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('gestionnaire.categories.destroy', $categorie->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune catégorie trouvée.</p>
    @endif
</div>
@endsection
