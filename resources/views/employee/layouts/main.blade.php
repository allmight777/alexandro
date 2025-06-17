@extends('employee.homedash')
@section('content')
         
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-6 mb-4 mb-xl-0">
                    <div class="d-lg-flex align-items-center">
                        <div>
                            <h6 class="font-weight-normal mb-2">Bienvenue sur votre espace Toolzy</h6>
                            <h3 class="text-dark font-weight-bold mb-2">Bonjour {{ $user->nom }} {{ $user->prenom }}!</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center justify-content-md-end">
                        <div class="pe-1 mb-3 mb-xl-0">
                            <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                Aide
                                <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Vos équipements</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Équipement</th>
                                            <th>Numéro de série</th>
                                            <th>Statut</th>
                                            <th>Date d'assignation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ordinateur portable</td>
                                            <td>LP-784512</td>
                                            <td><label class="badge badge-success">Actif</label></td>
                                            <td>12/05/2023</td>
                                        </tr>
                                        <tr>
                                            <td>Téléphone mobile</td>
                                            <td>PH-451236</td>
                                            <td><label class="badge badge-warning">En maintenance</label></td>
                                            <td>12/05/2023</td>
                                        </tr>
                                        <tr>
                                            <td>Écran 24"</td>
                                            <td>MN-785412</td>
                                            <td><label class="badge badge-success">Actif</label></td>
                                            <td>12/05/2023</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Actions rapides</h4>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-lg" type="button">
                                    <i class="mdi mdi-laptop"></i> Demander un équipement
                                </button>
                                <button class="btn btn-danger btn-lg" type="button">
                                    <i class="mdi mdi-alert"></i> Signaler une panne
                                </button>
                                <button class="btn btn-accent btn-lg" type="button">
                                    <i class="mdi mdi-history"></i> Voir mes demandes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Demandes récentes</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<<<<<<< HEAD
                                     @foreach ($demandes as $demande)
                                          <tr>
                                            <td>{{$demande->created_at}}</td>
                                            <td>{{$demande->motif}}</td>
                                            <td><label class="badge badge-info">{{$demande->statut}}</label></td>
                                        </tr>
                                     @endforeach
=======
                                        <tr>
                                            <td>15/06/2023</td>
                                            <td>Demande souris ergonomique</td>
                                            <td><label class="badge badge-info">En attente</label></td>
                                        </tr>
                                        <tr>
                                            <td>10/06/2023</td>
                                            <td>Réparation téléphone</td>
                                            <td><label class="badge badge-success">Résolu</label></td>
                                        </tr>
                                        <tr>
                                            <td>05/06/2023</td>
                                            <td>Demande clavier</td>
                                            <td><label class="badge badge-success">Approuvé</label></td>
                                        </tr>
>>>>>>> af758dea731329e7bba6b46a89107155913363fd
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pannes signalées</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Équipement</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>18/06/2023</td>
                                            <td>Téléphone mobile</td>
                                            <td><label class="badge badge-warning">En cours</label></td>
                                        </tr>
                                        <tr>
                                            <td>12/06/2023</td>
                                            <td>Écran 24"</td>
                                            <td><label class="badge badge-success">Résolu</label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    
    </div>
@endsection
 <!-- main-panel ends -->
