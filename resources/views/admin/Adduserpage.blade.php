@extends('admin.layouts.adminlay')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @session('success')
                <div class="alert alert-green">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ $value }}
                </div>
            @endsession

            <div class="card form-card">
                <div class="page-header mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h3 class="mb-1 text-primary fw-bold">Ajout d’un utilisateur</h3>
                            <p class="text-muted mb-0">Remplissez les informations nécessaires pour créer un nouvel
                                utilisateur.</p>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <a href="{{ route('showusers') }}" class="btn btn-outline-primary btn-sm">
                                <i class="mdi mdi-arrow-left me-1"></i> Retour à la liste
                            </a>
                        </div>
                    </div>
                    <hr class="mt-3">
                </div>

                <div class="form-body">
                    <form method="POST" action="{{ route('registerPost') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label required-label">Prénom</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Entrez le prénom"
                                        required name="prenom">
                                    @error('prenom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label required-label">Nom</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Entrez le nom"
                                        required name="nom">
                                    @error('nom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label required-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="exemple@toolzy.com" required name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label required-label">Rôle</label>
                                    <select class="form-select" id="role" required name="role">
                                        <option value="" selected disabled>Sélectionnez un rôle</option>
                                        <option value="admin">Administrateur</option>
                                        <option value="gestionnaire">Gestionnaire</option>
                                        <option value="employé">Employé</option>
                                    </select>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="poste" class="form-label required-label">Poste</label>
                                    <select class="form-select" id="poste" required name="poste">
                                        <option value="" selected disabled>Sélectionnez un poste</option>
                                        <option value="stagiaire">Stagiaire</option>
                                        <option value="technicien">Technicien</option>
                                        <option value="electricien">Électricien</option>
                                        <option value="rigger">Rigger</option>
                                        <option value="support_technique">Support technique</option>
                                        <option value="secretariat">Secrétariat</option>
                                        <option value="comptabilite">Comptabilité</option>
                                        <option value="team_leader">Team Leader</option>
                                        <option value="directeur_technique">Directeur Technique</option>
                                        <option value="directeur_general">Directeur Général</option>
                                    </select>
                                    @error('poste')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="service" class="form-label required-label">Service</label>
                                    <select class="form-select" id="service" required name="service">
                                        <option value="" selected disabled>Sélectionnez un service</option>
                                        <option value="secretariat">Secrétariat</option>
                                        <option value="comptabilite">Comptabilité</option>
                                        <option value="deploiement_ftth">Déploiement FTTH</option>
                                        <option value="deploiement_fttr">Déploiement FTTR</option>
                                        <option value="deploiement_reseaux">Déploiement Réseaux</option>
                                        <option value="deploiement_securise_video">Déploiement Sécurisé et Vidéo
                                            Surveillance</option>
                                        <option value="service_informatique">Service Informatique</option>
                                        <option value="direction">Direction</option>
                                    </select>
                                    @error('service')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>


                        <div class="form-footer">
                            <div class="d-flex flex-wrap justify-content-end gap-2">
                                <button type="reset" class="btn btn-reset">
                                    <i class="mdi mdi-refresh me-1"></i> Réinitialiser
                                </button>
                                <button type="submit" class="btn btn-submit">
                                    <i class="mdi mdi-account-plus me-1"></i> Créer l'utilisateur
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById("togglePassword");
            const passwordField = document.getElementById("password");

            const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
            const confirmPasswordField = document.getElementById("confirmPassword");

            togglePassword.addEventListener("click", function() {
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
                this.querySelector("i").classList.toggle("mdi-eye");
                this.querySelector("i").classList.toggle("mdi-eye-off");
            });

            toggleConfirmPassword.addEventListener("click", function() {
                const type = confirmPasswordField.getAttribute("type") === "password" ? "text" : "password";
                confirmPasswordField.setAttribute("type", type);
                this.querySelector("i").classList.toggle("mdi-eye");
                this.querySelector("i").classList.toggle("mdi-eye-off");
            });
        });
    </script>
@endpush
