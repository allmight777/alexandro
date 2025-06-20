@extends('employee.homedash')
@section("content")
@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div class="toast align-items-center text-white   bg-success  border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-danger text-white">
            <h4>Signaler une Panne</h4>
        </div>
        <div class="card-body">
            <form action="{{route("post.HandlePanne")}}" method="POST">
                @csrf
                <!-- Sélection de l'équipement -->
                <div class="mb-3">
                    <label for="equipement_id" class="form-label">Équipement concerné</label>
                    <select name="equipement_id" id="equipement_id" class="form-select" required>
                        <option value="">-- Sélectionnez un équipement --</option>
                         @foreach($equipements_user as $equipement)
                            <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description de la panne -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description de la panne</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Décrivez le problème..." required></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-danger">
                        <i class="mdi mdi-alert-circle-outline"></i> Signaler la panne
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection