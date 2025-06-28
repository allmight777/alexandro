@extends('gestionnaire.categories.layouts.gestionlay')
@section('content')
<h1>Ajouter une catégorie</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('gestionnaire.categories.store') }}" method="POST">
    @csrf
    <label for="nom">Nom de la catégorie</label>
    <input type="text" name="nom" id="nom" required>
    <button type="submit">Ajouter</button>
</form>

<a href="{{ route('gestionnaire.categories.index') }}">Retour à la liste</a>
@endsection
