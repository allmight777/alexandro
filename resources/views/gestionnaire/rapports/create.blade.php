@extends('gestionnaire.rapports.layouts.gestionlay')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">
                <i class="fas fa-file-alt mr-2"></i>Créer un Rapport
            </h2>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('rapports.store') }}" class="needs-validation" novalidate>
                @csrf
                
                <div class="form-group">
                    <label for="contenu" class="font-weight-bold">Contenu du rapport</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="10" 
                              placeholder="Rédigez le contenu du rapport ici..." required></textarea>
                    <div class="invalid-feedback">
                        Veuillez saisir le contenu du rapport.
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-file-export mr-2"></i>Générer et Soumettre
                    </button>
                    <a href="{{ route('rapports.index') }}" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 0.5rem;
    }
    textarea {
        min-height: 300px;
    }
    .btn-lg {
        padding: 0.5rem 1.5rem;
        font-size: 1.1rem;
    }
</style>
@endpush

@push('scripts')
<script>
// Validation Bootstrap
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
@endpush