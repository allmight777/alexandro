@extends('admin.layouts.adminlay')
@section('content')
    @php $verification = false; @endphp
    @php
        $optionsHtml = '';
        $equipementDisponibleTrouvé = false;

        foreach ($equipements_groupes as $categorie) {
            $equipementsDisponibles = $categorie->equipement->where('etat', 'disponible');

            if ($equipementsDisponibles->count() > 0) {
                $equipementDisponibleTrouvé = true;
                $optionsHtml .= '<optgroup label="' . e($categorie->nom) . '">';
                foreach ($equipementsDisponibles as $equipement) {
                    $optionsHtml .= '<option value="' . e($equipement->id) . '">' . e($equipement->nom) . '</option>';
                }
                $optionsHtml .= '</optgroup>';
            }
        }
        // Si aucun équipement n'a été trouvé
        if (!$equipementDisponibleTrouvé) {
            $optionsHtml .= '<option value="">Aucun élément disponible</option>';
        }
    @endphp
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card shadow-lg">

            <div class="card-header bg-primary text-white">
                <h4>Affectation d'Équipements</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('handle.affectation') }}" method="POST">
                    @csrf

                    <!-- Employé -->
                    <div class="mb-3">
                        <label for="employe_id" class="form-label">Employé</label>
                        <select name="employe_id" id="employe_id" class="form-select" required>
                            <option value="">-- Sélectionnez un employé --</option>
                            @foreach ($employes as $employe)
                                <option value="{{ $employe->id }}">{{ $employe->nom }} {{ $employe->prenom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Motif global -->
                    <div class="mb-3">
                        <label for="motif" class="form-label">Motif</label>
                        <textarea name="motif" id="motif" class="form-control" rows="3" required></textarea>
                    </div>

                    <hr>

                    <!-- Liste dynamique des équipements -->
                    <div id="equipement-wrapper">
                        <div class="equipement-item row mb-3">
                            <div class="col-md-6">
                                <label>Équipement</label>
                                <select name="equipements[]" class="form-control" required>
                                    <option value="">-- Sélectionner un équipement --</option>
                                    @foreach ($equipements_groupes as $categorie)
                                        @php
                                            $equipements_dispo = $categorie->equipement->where('etat', 'disponible');
                                        @endphp

                                        @if (count($equipements_dispo) > 0)
                                            <optgroup label="{{ $categorie->nom }}">
                                                @foreach ($equipements_dispo as $equipement)
                                                    <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                                                @endforeach
                                            </optgroup>
                                           @php  $verification=true;@endphp
                                        @endif
                                    @endforeach

                                    @if ($verification==false)
                                        <option value="">Aucun element disponible</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Date de retour</label>
                                <input type="date" name="dates_retour[]" class="form-control" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-btn">Supprimer</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-primary mb-3" id="add-equipement">
                        <i class="mdi mdi-plus"></i> Ajouter un équipement
                    </button>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Affecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Options des équipements (déjà correctement échappées via $optionsHtml)
            const optionsEquipement = `{!! $optionsHtml !!}`;

            // Bouton d'ajout et conteneur
            const addButton = document.getElementById('add-equipement');
            const wrapper = document.getElementById('equipement-wrapper');

            // Fonction pour ajouter un nouvel équipement
            function addEquipementField() {
                const newField = document.createElement('div');
                newField.classList.add('equipement-item', 'row', 'mb-3');
                newField.innerHTML = `
                <div class="col-md-6">
                    <label>Équipement</label>
                    <select name="equipements[]" class="form-control" required>
                        <option value="">-- Sélectionner un équipement --</option>
                        ${optionsEquipement}
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Date de retour</label>
                    <input type="date" name="dates_retour[]" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-btn">Supprimer</button>
                </div>
            `;
                wrapper.appendChild(newField);
            }
           if (!optionsEquipement.includes('<option value=')) {
                addButton.disabled = true;
                addButton.classList.add('disabled');
                addButton.title = 'Aucun équipement disponible à ajouter';
            }
            // Gestionnaire pour le bouton d'ajout
            if (addButton) {
                addButton.addEventListener('click', addEquipementField);
            }

            // Délégation d'événement pour les boutons de suppression
            if (wrapper) {
                wrapper.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('remove-btn')) {
                        e.target.closest('.equipement-item').remove();
                    }
                });
            }
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
@endpush
