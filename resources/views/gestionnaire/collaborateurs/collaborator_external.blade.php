@extends('gestionnaire.collaborateurs.layouts.gestionlay')
@section('content')
@if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <div class="toast align-items-center text-white bg-{{ session('success') ? 'success' : 'danger' }} border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success')}}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Ajouter un Collaborateur</h4>
        </div>
        <div class="card-body">
            <!-- <form action="{{route('HandleCollaborator')}}" method="POST" enctype="multipart/form-data"> -->
            <form action="{{ route('gestionnaire.collaborateurs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="chemin_carte" class="form-label">Carte d'identité</label>
                    <input type="file" name="chemin_carte" id="chemin_carte" class="form-control" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.querySelector('.toast');
        if (toastEl) {
            const bsToast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 5000 // 5 secondes avant disparition auto
            });
            bsToast.show();
        }
    });
</script>
@endpush
