@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la catégorie</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('gestionnaire.categories.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $categorie->nom }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        <a href="{{ route('gestionnaire.categories.list') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection
