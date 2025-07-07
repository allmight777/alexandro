@extends('admin.layouts.adminlay')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @session('succès')
                <div class="alert alert-green">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ $value }}
                </div>
            @endsession

            <div class="card form-card">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <div class="page-title-icon bg-gradient-toolzy-primary text-white me-3">
                            <i class="mdi mdi-account-edit"></i>
                        </div>
                        <div>
                            <h3 class="page-title mb-0">Modification d'utilisateur</h3>
                            <p class="text-muted mb-0">Modifiez les informations de l'utilisateur ci-dessous</p>
                        </div>
                    </div>
                </div>

                <div class="form-body">
                    <form method="POST" action="{{ route('putuser', $user->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label required-label">Prénom</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Entrez le prénom"
                                        required name="prenom" value="{{ $user->prenom }}">
                                    @error('prenom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label required-label">Nom</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Entrez le nom"
                                        required name="nom" value="{{ $user->nom }}">
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
                                        placeholder="exemple@toolzy.com" required name="email"
                                        value="{{ $user->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label required-label">Rôle</label>
                                    <select class="form-select" id="role" required name="role">
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                                        <option value="gestionnaire" {{ $user->role == 'gestionnaire' ? 'selected' : '' }}>gestionnaire</option>
                                        <option value="employé" {{ $user->role == 'employé' ? 'selected' : '' }}>employé</option>
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
                                        <option value="developpeur" {{ $user->poste == 'developpeur' ? 'selected' : '' }}>developpeur</option>
                                        <option value="designer" {{ $user->poste == 'designer' ? 'selected' : '' }}>designer</option>
                                        <option value="chef_projet" {{ $user->poste == 'chef_projet' ? 'selected' : '' }}>chef_projet</option>
                                        <option value="support" {{ $user->poste == 'support' ? 'selected' : '' }}>support</option>
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
                                        <option value="informatique" {{ $user->service == 'informatique' ? 'selected' : '' }}>informatique</option>
                                        <option value="marketing" {{ $user->service == 'marketing' ? 'selected' : '' }}>marketing</option>
                                        <option value="commercial" {{ $user->service == 'commercial' ? 'selected' : '' }}>commercial</option>
                                        <option value="production" {{ $user->service == 'production' ? 'selected' : '' }}>production</option>
                                        <option value="rh" {{ $user->service == 'rh' ? 'selected' : '' }}>rh</option>
                                    </select>
                                    @error('service')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <div class="password-input-group">
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Créer un mot de passe temporaire" name="password" value="">
                                        <button type="button" class="password-toggle" id="togglePassword">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                    @if ($errors->has('password') && !str_contains($errors->first('password'), 'confirmation'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-footer">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-reset me-3">
                                    <i class="mdi mdi-refresh me-1"></i> Réinitialiser
                                </button>
                                <button type="submit" class="btn btn-submit">
                                    <i class="mdi mdi-account-plus me-1"></i> Editer l'utilisateur
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
    document.addEventListener("DOMContentLoaded", function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            this.querySelector('i').classList.toggle('mdi-eye');
            this.querySelector('i').classList.toggle('mdi-eye-off');
        });
    });
</script>
@endpush
