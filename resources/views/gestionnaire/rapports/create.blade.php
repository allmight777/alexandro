@extends('gestionnaire.rapports.layouts.gestionlay')

@section('content')
<h2>Créer un Rapport</h2>

<form method="POST" action="{{ route('rapports.store') }}">
    @csrf
    <textarea name="contenu" rows="10" placeholder="Rédigez le contenu du rapport" required></textarea><br>
    <button type="submit">Générer et Soumettre</button>
</form>
@endsection
