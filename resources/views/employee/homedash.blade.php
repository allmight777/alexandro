<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toolzy | Tableau de bord Employé</title>
    <!-- base:css -->
    <link rel="stylesheet" href="/vendors1/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors1/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css1/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images1/favicon.png" />
    <style>
      :root {
        --primary: #2563eb;
        --secondary: #1e40af;
        --accent: #f59e0b;
        --dark: #1e293b;
      }
      .navbar-brand .logo-text {
        font-weight: 700;
        color: var(--dark);
        font-size: 1.5rem;
      }
      .btn-primary {
        background: var(--primary);
        border: none;
      }
      .btn-primary:hover {
        background: var(--secondary);
      }
      .btn-accent {
        background: var(--accent);
        color: white;
      }
      .badge-success {
        background-color: #10b981;
      }
      .badge-warning {
        background-color: #f59e0b;
      }
      .badge-info {
        background-color: #3b82f6;
      }
      .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      }
      .top-navbar {
        background: white !important;
      }
      .bottom-navbar {
        background: white !important;
      }
      .nav-link.active {
        color: var(--primary) !important;
        font-weight: 600;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
      <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
              <ul class="navbar-nav navbar-nav-left">
                <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                  <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
                </li>
                <li class="nav-item dropdown">
                  
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-success">
                            <i class="mdi mdi-check-circle mx-0"></i>
                          </div>
                      </div>
                      <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal">Demande approuvée</h6>
                          <p class="font-weight-light small-text mb-0 text-muted">
                            Votre ordinateur portable a été approuvé
                          </p>
                      </div>
                    </a>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-warning">
                            <i class="mdi mdi-alert mx-0"></i>
                          </div>
                      </div>
                      <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal">Panne signalée</h6>
                          <p class="font-weight-light small-text mb-0 text-muted">
                            Votre ticket a été pris en charge
                          </p>
                      </div>
                    </a>
                  </div>
                </li>
              </ul>
              <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                  <a class="navbar-brand brand-logo" href="index.html">
                    <i class="fas fa-tools me-2" style="color: var(--primary);"></i>
                    <span class="logo-text">TOOLZY</span>
                  </a>
                  <a class="navbar-brand brand-logo-mini" href="index.html">
                    <i class="fas fa-tools" style="color: var(--primary);"></i>
                  </a>
              </div>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">{{$user->nom}} {{$user->prenom}}</span>
                    <span class="online-status"></span>
                    <img src="/images1/faces/face28.png" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Paramètres
                      </a>
                      <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item" style="background: none; border: none; text-align: left; width: 100%;">
                          <i class="mdi mdi-logout text-primary"></i>
                          Déconnexion
                        </button>
                      </form>
                  </div>
                </li>
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </div>
        </nav>
        <nav class="bottom-navbar">
          <div class="container">
              <ul class="nav page-navigation">
                <li class="nav-item">
                  <a class="nav-link active" href="index.html">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                    <span class="menu-title">Tableau de bord</span>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-laptop menu-icon"></i>
                      <span class="menu-title">Demander équipement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-alert-circle menu-icon"></i>
                      <span class="menu-title">Signaler pannes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                      <span class="menu-title">Équipements assignés</span>
                    </a>
                </li>
              </ul>
          </div>
        </nav>
      </div>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                  <div>
                      <h6 class="font-weight-normal mb-2">Bienvenue sur votre espace Toolzy</h6>
                      <h3 class="text-dark font-weight-bold mb-2">Bonjour {{$user->nom}} {{$user->prenom}}!</h3>
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
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="footer-wrap">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© 2023 Toolzy - Jaspe Technologie</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Support technique: support@toolzy.bj</span>
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="/vendors1/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/js1/template.js"></script>
    <!-- endinject -->
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="/vendors1/chart.js/Chart.min.js"></script>
    <script src="/vendors1/progressbar.js/progressbar.min.js"></script>
    <script src="/vendors1/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
    <script src="/vendors1/justgage/raphael-2.1.4.min.js"></script>
    <script src="/vendors1/justgage/justgage.js"></script>
    <script src="/js1/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="/js1/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>