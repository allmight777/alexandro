<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <base href="/public">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Toolzy - Administration</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <style>
    :root {
      --toolzy-primary: #4776E6;
      --toolzy-secondary: #8E54E9;
      --toolzy-success: #38ef7d;
      --toolzy-warning: #FFC837;
      --toolzy-danger: #f5515f;
      --toolzy-light: #f8f9fa;
      --toolzy-dark: #343a40;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
    }
    
    .bg-gradient-toolzy-primary {
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
    }
    
    .bg-gradient-toolzy-secondary {
      background: linear-gradient(to right, #FF8008, var(--toolzy-warning));
    }
    
    .bg-gradient-toolzy-success {
      background: linear-gradient(to right, #11998e, var(--toolzy-success));
    }
    
    .bg-gradient-toolzy-danger {
      background: linear-gradient(to right, var(--toolzy-danger), #ff9966);
    }
    
    .text-toolzy {
      color: var(--toolzy-primary);
    }
    
    .badge-toolzy {
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      color: white;
    }
    
    .btn-toolzy {
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      transition: all 0.3s ease;
    }
    
    .btn-toolzy:hover {
      background: linear-gradient(to right, var(--toolzy-secondary), var(--toolzy-primary));
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .toolzy-logo {
      font-size: 24px;
      font-weight: bold;
      color: var(--toolzy-primary);
    }
    
    .toolzy-logo i {
      margin-right: 8px;
    }
    
    .sidebar {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }
    
    .sidebar .nav .nav-item.active > .nav-link {
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      border-radius: 6px;
    }
    
    .sidebar .nav .nav-item.active > .nav-link i,
    .sidebar .nav .nav-item.active > .nav-link .menu-title {
      color: #ffffff;
    }
    
    .sidebar .nav .nav-item .nav-link {
      border-radius: 6px;
      margin: 5px 15px;
      transition: all 0.3s;
    }
    
    .sidebar .nav .nav-item .nav-link:hover {
      background-color: rgba(71, 118, 230, 0.1);
    }
    
    .action-buttons .btn {
      margin-right: 5px;
    }
    
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .card-img-holder {
      position: relative;
    }
    
    .card-img-absolute {
      position: absolute;
      top: 0;
      right: 0;
      opacity: 0.1;
    }
    
    .table {
      border-collapse: separate;
      border-spacing: 0 8px;
    }
    
    .table thead th {
      border-bottom: none;
      font-weight: 600;
      color: var(--toolzy-dark);
      padding: 12px;
    }
    
    .table tbody tr {
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      border-radius: 8px;
      background-color: white;
    }
    
    .table tbody td {
      padding: 15px 12px;
      vertical-align: middle;
      border-top: none;
    }
    
    .table tbody tr td:first-child {
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
    }
    
    .table tbody tr td:last-child {
      border-top-right-radius: 8px;
      border-bottom-right-radius: 8px;
    }
    
    .badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 500;
    }
    
    .badge-gradient-success {
      background: linear-gradient(to right, #11998e, var(--toolzy-success));
      color: white;
    }
    
    .badge-gradient-warning {
      background: linear-gradient(to right, #FF8008, var(--toolzy-warning));
      color: white;
    }
    
    .badge-gradient-danger {
      background: linear-gradient(to right, var(--toolzy-danger), #ff9966);
      color: white;
    }
    
    .page-header {
      background-color: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 24px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .page-title-icon {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .footer {
      background-color: white;
      border-radius: 12px;
      padding: 15px;
      margin-top: 30px;
      box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.05);
    }
    
    /* Styles pour les avatars avec initiales */
    .user-initials {
      width: 36px;
      height: 36px;
      border-radius: 6px;
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      color: white;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      margin-right: 10px;
    }
    
    .profile-initials {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      margin-right: 10px;
    }
    
    .nav-profile {
      padding: 15px;
      margin-bottom: 15px;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .nav-profile-text {
      display: flex;
      flex-direction: column;
    }
    
    /* Amélioration des boutons d'action */
    .btn-outline-primary, .btn-outline-danger, .btn-outline-info, .btn-outline-warning, .btn-outline-success {
      border-radius: 6px;
      padding: 6px 10px;
      transition: all 0.3s;
    }
    
    .btn-outline-primary:hover, .btn-outline-danger:hover, .btn-outline-info:hover, .btn-outline-warning:hover, .btn-outline-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
          <span class="toolzy-logo"><i class="fas fa-tools text-primary"></i>Toolzy</span>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <i class="fas fa-tools text-primary"></i>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="search-field d-none d-md-block">
          <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>                
              </div>
              <input type="text" class="form-control bg-transparent border-0" placeholder="Rechercher un équipement...">
            </div>
          </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="d-flex align-items-center">
                <div class="profile-initials">AT</div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">Admin Toolzy</p>
                </div>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-cached mr-2 text-success"></i>
                Journal d'activité
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Déconnexion
              </a>
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="d-flex align-items-center">
                <div class="profile-initials">AT</div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">Admin Toolzy</span>
                  <span class="text-secondary text-small">Administrateur</span>
                </div>
              </div>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/dashboard/admin')}}">
              <span class="menu-title">Tableau de bord</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="false" aria-controls="user-management">
              <span class="menu-title">Gestion Utilisateurs</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="user-management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('showusers')}}">Liste des utilisateurs</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('register')}}">Ajouter un utilisateur</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#equipment-management" aria-expanded="false" aria-controls="equipment-management">
              <span class="menu-title">Gestion Équipements</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-laptop menu-icon"></i>
            </a>
            <div class="collapse" id="equipment-management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="equipment-list.html">Inventaire</a></li>
                <li class="nav-item"> <a class="nav-link" href="equipment-add.html">Ajouter un équipement</a></li>
                <li class="nav-item"> <a class="nav-link" href="equipment-categories.html">Catégories</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="assignments.html">
              <span class="menu-title">Affectations</span>
              <i class="mdi mdi-account-check menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reports.html">
              <span class="menu-title">Rapports</span>
              <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="maintenance.html">
              <span class="menu-title">Maintenance</span>
              <i class="mdi mdi-wrench menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings.html">
              <span class="menu-title">Paramètres</span>
              <i class="mdi mdi-settings menu-icon"></i>
            </a>
          </li>
           <li class="nav-item">
            <form action="{{route("logout")}}" method="POST">
               @csrf
               @method("post")
               <button type="submit" class="btn btn-danger">Deconnexion</button>

            </form>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-toolzy-primary text-white mr-2">
                <i class="mdi mdi-home"></i>                 
              </span>
              Tableau de bord
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Vue d'ensemble
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-toolzy-primary card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">Total Équipements
                    <i class="mdi mdi-laptop mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">245</h2>
                  <h6 class="card-text">Augmentation de 15% ce mois</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-toolzy-secondary card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">Équipements affectés
                    <i class="mdi mdi-account-check mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">184</h2>
                  <h6 class="card-text">75% du total des équipements</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-toolzy-success card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Utilisateurs actifs
                    <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">156</h2>
                  <h6 class="card-text">Augmentation de 8% ce mois</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title float-left">Statistiques d'utilisation des équipements</h4>
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>                                     
                  </div>
                  <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Distribution des équipements</h4>
                  <canvas id="traffic-chart"></canvas>
                  <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>                                                      
                </div>
              </div>
            </div>
          </div>
          
          <!-- Gestion des utilisateurs -->
          
          
          <!-- Gestion des équipements -->
          
          <!-- Affectations récentes -->
          
          <!-- Rapports récents -->
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a href="#" target="_blank">Toolzy</a>. Tous droits réservés.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Gestion des équipements professionnels</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script>
    // Personnalisation des graphiques pour Toolzy
    document.addEventListener('DOMContentLoaded', function() {
      if ($("#visit-sale-chart").length) {
        Chart.defaults.global.legend.labels.usePointStyle = true;
        var ctx = document.getElementById('visit-sale-chart').getContext("2d");

        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 181);
        gradientStroke1.addColorStop(0, '#4776E6');
        gradientStroke1.addColorStop(1, '#8E54E9');

        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 360);
        gradientStroke2.addColorStop(0, '#FF8008');
        gradientStroke2.addColorStop(1, '#FFC837');

        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
            datasets: [
              {
                label: 'Ordinateurs',
                borderColor: gradientStroke1,
                backgroundColor: gradientStroke1,
                pointBackgroundColor: gradientStroke1,
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: gradientStroke1,
                pointBorderWidth: 0,
                pointHoverRadius: 0,
                pointHoverBorderWidth: 0,
                pointRadius: 0,
                fill: true,
                borderWidth: 2,
                data: [65, 59, 80, 81, 56, 55, 40]
              },
              {
                label: 'Autres équipements',
                borderColor: gradientStroke2,
                backgroundColor: gradientStroke2,
                pointBackgroundColor: gradientStroke2,
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: gradientStroke2,
                pointBorderWidth: 0,
                pointHoverRadius: 0,
                pointHoverBorderWidth: 0,
                pointRadius: 0,
                fill: true,
                borderWidth: 2,
                data: [30, 40, 35, 50, 49, 60, 70]
              }
            ]
          },
          options: {
            legend: {
              display: false,
            },
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  maxTicksLimit: 5,
                  stepSize: 20,
                  max: 100
                },
                gridLines: {
                  borderDash: [3, 3],
                  drawBorder: false,
                  color: 'rgba(0,0,0,0.1)',
                  zeroLineColor: 'rgba(0,0,0,0)',
                }
              }],
              xAxes: [{
                gridLines: {
                  display: false,
                  drawBorder: false,
                  color: 'rgba(0,0,0,0.1)',
                  zeroLineColor: 'rgba(0,0,0,0)',
                },
                ticks: {
                  padding: 20,
                  fontColor: "#9c9fa6",
                  autoSkip: true,
                }
              }]
            }
          }
        });
        document.getElementById('visit-sale-chart-legend').innerHTML = myChart.generateLegend();
      }

      if ($("#traffic-chart").length) {
        var ctx = document.getElementById('traffic-chart').getContext("2d");
        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 181);
        gradientStroke1.addColorStop(0, '#4776E6');
        gradientStroke1.addColorStop(1, '#8E54E9');
        
        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 50);
        gradientStroke2.addColorStop(0, '#FF8008');
        gradientStroke2.addColorStop(1, '#FFC837');
        
        var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 50);
        gradientStroke3.addColorStop(0, '#11998e');
        gradientStroke3.addColorStop(1, '#38ef7d');
        
        var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 50);
        gradientStroke4.addColorStop(0, '#f5515f');
        gradientStroke4.addColorStop(1, '#ff9966');

        var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            datasets: [{
              data: [40, 25, 20, 15],
              backgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
                gradientStroke4
              ],
              hoverBackgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
                gradientStroke4
              ],
              borderColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
                gradientStroke4
              ],
              legendColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
                gradientStroke4
              ]
            }],
            labels: [
              'Ordinateurs',
              'Téléphones',
              'Imprimantes',
              'Autres'
            ]
          },
          options: {
            responsive: true,
            cutoutPercentage: 70,
            legend: false,
            animation: {
              animateScale: true,
              animateRotate: true
            }
          }
        });
        document.getElementById('traffic-chart-legend').innerHTML = myChart.generateLegend();
      }
    });
  </script>
  <!-- End custom js for this page-->
</body>

</html>
