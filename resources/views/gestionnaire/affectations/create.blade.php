@extends('gestionnaire.affectations.layouts.gestionlay')
@section('content')
<div class="container">
    <h2>Affecter un équipement</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('affectations.store') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="equipement_id">Équipement</label>
            <select class="form-control" name="equipement_id" required>
                <option value="">-- Sélectionner --</option>
                @foreach($equipements as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }} ({{ $equip->reference }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="user_id">Employé</label>
            <select class="form-control" name="user_id" required>
                <option value="">-- Sélectionner --</option>
                @foreach($employes as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="date_affectation">Date d'affectation</label>
            <input type="date" class="form-control" name="date_affectation" required>
        </div>

        <div class="form-group mb-3">
            <label for="date_retour">Date de retour (optionnel)</label>
            <input type="date" class="form-control" name="date_retour">
        </div>

        <button type="submit" class="btn btn-primary">Affecter</button>
    </form>
</div>
@endsection
