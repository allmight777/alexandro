<!DOCTYPE html>
<html lang="fr">
<head>
  <base href="/public">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Toolzy - Administration</title>
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
  <link rel="shortcut icon" href="images/favicon.png" />
  <style>
    .btn{ width: 200px; }
    
    :root {
      --toolzy-primary: #4776E6;
      --toolzy-secondary: #8E54E9;
      --toolzy-success: #38ef7d;
      --toolzy-warning: #FFC837;
      --toolzy-danger: #f5515f;
      --toolzy-light: #f8f9fa;
      --toolzy-dark: #343a40;
    }
    
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f7fa; }
    
    .bg-gradient-toolzy-primary { background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary)); }
    .bg-gradient-toolzy-secondary { background: linear-gradient(to right, #FF8008, var(--toolzy-warning)); }
    .bg-gradient-toolzy-success { background: linear-gradient(to right, #11998e, var(--toolzy-success)); }
    .bg-gradient-toolzy-danger { background: linear-gradient(to right, var(--toolzy-danger), #ff9966); }
    .text-toolzy { color: var(--toolzy-primary); }
    
    .badge-toolzy { background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary)); color: white; }
   
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
    
    .toolzy-logo { font-size: 24px; font-weight: bold; color: var(--toolzy-primary); }
    .toolzy-logo i { margin-right: 8px; }
    
    .sidebar { box-shadow: 0 0 15px rgba(0, 0, 0, 0.05); min-width: 250px; width: 250px; }
    
    .sidebar .nav .nav-item.active > .nav-link {
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      border-radius: 6px;
      width: calc(100% - 30px);
      margin: 3px 15px;
      padding: 12px 15px;
      min-width: 200px;
    }

    .sidebar .nav .nav-item.active > .nav-link i,
    .sidebar .nav .nav-item.active > .nav-link .menu-title { color: #ffffff; }

    .sidebar .nav .nav-item .nav-link {
      border-radius: 8px;
      margin: 3px 15px;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      padding: 12px 15px;
      width: calc(100% - 30px);
      min-width: 200px;
    }

    .sidebar .nav .nav-item .nav-link:hover {
      background-color: rgba(71, 118, 230, 0.08);
      transform: translateX(2px);
    }

    .sidebar .nav .nav-item .nav-link .menu-icon {
      margin-right: 12px;
      font-size: 18px;
      width: 20px;
      text-align: center;
      flex-shrink: 0;
    }

    .sidebar .nav .nav-item .nav-link .menu-title {
      flex: 1;
      white-space: nowrap;
      font-size: 14px;
      font-weight: 500;
    }

    .sidebar .nav .nav-item .nav-link .menu-arrow {
      margin-left: 10px;
      transition: transform 0.3s ease;
      font-size: 16px;
      color: #6c757d;
      opacity: 0.8;
      flex-shrink: 0;
      transform: rotate(180deg);
    }

    .sidebar .nav .nav-item .nav-link[aria-expanded="true"] .menu-arrow {
      transform: rotate(0deg);
      color: #ffffff;
    }
    
    .sidebar .nav .nav-item .collapse { margin-left: 0; margin-right: 0; transition: all 0.3s ease; overflow: visible; }
    .sidebar .nav .nav-item .collapse.show { display: block !important; max-height: none; }
    .sidebar .nav .nav-item .collapse:not(.show) { display: none !important; max-height: 0; }

    .sidebar .nav .nav-item .sub-menu {
      background-color: #f8f9fa;
      border: none;
      border-radius: 0;
      margin: 0;
      padding: 8px 0;
      box-shadow: none;
      border-left: 3px solid var(--toolzy-primary);
    }

    .sidebar .nav .nav-item .sub-menu .nav-item .nav-link {
      padding: 10px 15px 10px 35px;
      margin: 0;
      font-size: 14px;
      color: #495057;
      border-radius: 0;
      transition: all 0.2s ease;
      font-weight: 500;
      white-space: nowrap;
      overflow: visible;
      text-overflow: clip;
      display: block;
      width: 100%;
    }

    .sidebar .nav .nav-item .sub-menu .nav-item .nav-link:hover {
      background-color: rgba(71, 118, 230, 0.1);
      color: var(--toolzy-primary);
      transform: none;
      padding-left: 40px;
    }

    .sidebar .nav .nav-item .sub-menu .nav-item.active .nav-link {
      background: rgba(71, 118, 230, 0.15) !important;
      color: var(--toolzy-primary) !important;
      font-weight: 600;
      border-left: none;
      padding-left: 40px;
    }
    
    .sidebar .nav .nav-item.active .nav-link .menu-icon { color: #ffffff; }
    .action-buttons .btn { margin-right: 5px; }
    
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
    
    .card-img-holder { position: relative; }
    .card-img-absolute { position: absolute; top: 0; right: 0; opacity: 0.1; }
    
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
    
    .table tbody tr td:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .table tbody tr td:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
    
    .badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 500;
    }
    
    .badge-gradient-success { background: linear-gradient(to right, #11998e, var(--toolzy-success)); color: white; }
    .badge-gradient-warning { background: linear-gradient(to right, #FF8008, var(--toolzy-warning)); color: white; }
    .badge-gradient-danger { background: linear-gradient(to right, var(--toolzy-danger), #ff9966); color: white; }
    
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
    
    .nav-profile-text { display: flex; flex-direction: column; }
    
    .btn-outline-primary, .btn-outline-danger, .btn-outline-info, .btn-outline-warning, .btn-outline-success {
      border-radius: 6px;
      padding: 6px 10px;
      transition: all 0.3s;
    }
    
    .btn-outline-primary:hover, .btn-outline-danger:hover, .btn-outline-info:hover, .btn-outline-warning:hover, .btn-outline-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .demo-content {
      padding: 20px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
    }
    
    .demo-title {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--toolzy-primary);
    }
    
    .instructions {
      background-color: #f8f9fa;
      border-left: 4px solid var(--toolzy-primary);
      padding: 15px;
      margin: 20px 0;
      border-radius: 0 8px 8px 0;
    }
    
    .instructions h4 {
      margin-top: 0;
      color: var(--toolzy-primary);
    }
    
    .highlight {
      background-color: rgba(71, 118, 230, 0.1);
      padding: 3px 6px;
      border-radius: 4px;
      font-weight: 500;
    }
    
    .sidebar .logout-container {
      padding: 0 15px;
      margin-top: 15px;
      width: 100%;
    }
    
    .sidebar .logout-btn {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      background-color: #f5515f;
      color: white;
      border: none;
      transition: all 0.3s ease;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .sidebar .logout-btn i { margin-right: 8px; }
    .sidebar .logout-btn:hover {
      background-color: #e04553;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .form-card {
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border: none;
      margin-bottom: 30px;
    }
    
    .form-header {
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      color: white;
      border-radius: 12px 12px 0 0;
      padding: 20px 25px;
    }
    
    .form-body {
      padding: 25px;
      background-color: #fff;
      border-radius: 0 0 12px 12px;
    }
    
    .form-icon {
      background: rgba(255,255,255,0.2);
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
    }
    
    .form-control, .form-select {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #e1e5eb;
      transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--toolzy-primary);
      box-shadow: 0 0 0 0.25rem rgba(71, 118, 230, 0.25);
    }
    
    .form-label {
      font-weight: 500;
      margin-bottom: 8px;
      color: #495057;
    }
    
    .required-label:after {
      content: " *";
      color: var(--toolzy-danger);
    }
    
    .form-footer {
      background-color: #f8f9fa;
      padding: 20px 25px;
      border-radius: 0 0 12px 12px;
      border-top: 1px solid #e1e5eb;
    }
    
    .btn-submit {
      background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .btn-reset {
      background: #f8f9fa;
      color: #495057;
      border: 1px solid #e1e5eb;
      padding: 10px 25px;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-reset:hover { background: #e9ecef; }
    
    /* Toast position and style */
    .toast-container { z-index: 1050; }
    
    /* Ajout des styles pour les champs de mot de passe */
    .password-input-group {
      position: relative;
    }
    
    .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #6c757d;
      z-index: 10;
    }
    
    .password-toggle:focus {
      outline: none;
    }
  .alert-green {
    background:rgb(121, 168, 121);
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
      @include('admin.sidebar_add_user')
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Toast notifications -->
            <!-- Remplacez le code toast actuel par ceci -->
          <div class="row">
            <div class="col-12 grid-margin">
               @session('success')
                      <div class="alert alert-green">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{$value}} 
                      </div>
                @endsession
              <div class="card form-card">
                <div class="form-body">
                  <form method="POST" action="{{route('registerPost')}}">
                    @csrf
                    <div class="row mb-4">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="firstName" class="form-label required-label">Prénom</label>
                          <input type="text" class="form-control" id="firstName" placeholder="Entrez le prénom" required name="prenom">
                          @error('prenom')
                               <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="lastName" class="form-label required-label">Nom</label>
                          <input type="text" class="form-control" id="lastName" placeholder="Entrez le nom" required name="nom">
                           @error('nom')
                               <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    
                    <div class="row mb-4">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="email" class="form-label required-label">Email</label>
                          <input type="email" class="form-control" id="email" placeholder="exemple@toolzy.com" required name="email">
                           @error('email')
                               <span class="text-danger">{{$message}}</span>
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
                               <span class="text-danger">{{$message}}</span>
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
                            <option value="developpeur">Développeur</option>
                            <option value="designer">Designer</option>
                            <option value="chef_projet">Chef de projet</option>
                            <option value="support">Support technique</option>
                            <option value="rh">Ressources Humaines</option>
                          </select>
                           @error('poste')
                               <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="service" class="form-label required-label">Service</label>
                          <select class="form-select" id="service" required name="service">
                            <option value="" selected disabled>Sélectionnez un service</option>
                            <option value="informatique">Informatique</option>
                            <option value="marketing">Marketing</option>
                            <option value="commercial">Commercial</option>
                            <option value="production">Production</option>
                            <option value="rh">Ressources Humaines</option>
                          </select>
                           @error('service')
                               <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="password" class="form-label required-label">Mot de passe </label>
                          <div class="password-input-group">
                            <input type="password" class="form-control" id="password" placeholder="Créer un mot de passe temporaire"  name="password">
                            <button type="button" class="password-toggle" id="togglePassword">
                              <i class="mdi mdi-eye"></i>
                            </button>
                          </div>
                           @if($errors->has('password') && !str_contains($errors->first('password'), 'confirmation'))
                                 <span class="text-danger">{{$errors->first('password')}}</span>
                           @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="confirmPassword" class="form-label required-label">Confirmer le mot de passe</label>
                          <div class="password-input-group">
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmer le mot de passe" required name="password_confirmation">
                            <button type="button" class="password-toggle" id="toggleConfirmPassword">
                              <i class="mdi mdi-eye"></i>
                            </button>
                          </div>
                            @if($errors->has('password') && str_contains($errors->first('password'), 'confirmation'))
                               <span class="text-danger">{{$errors->first('password')}}</span>
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
                          <i class="mdi mdi-account-plus me-1"></i> Créer l'utilisateur
                        </button>
                      </div>
                   </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  
  <script>
    // Initialiser les toasts
    document.addEventListener('DOMContentLoaded', function() {
      // Toast initialization
      const toastElList = document.querySelectorAll('.toast')
      const toastList = [...toastElList].map(toastEl => {
        const toast = new bootstrap.Toast(toastEl, {
          autohide: true,
          delay: 5000
        })
        toast.show()
        return toast
      })
      
      // Sidebar dropdown toggle
      const sidebarDropdowns = document.querySelectorAll('.sidebar-dropdown-toggle');
      
      sidebarDropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          const targetId = this.getAttribute('data-target');
          const target = document.querySelector(targetId);
          const arrow = this.querySelector('.menu-arrow');
          
          if (target) {
            const isCurrentlyOpen = target.classList.contains('show');
            
            if (isCurrentlyOpen) {
              target.classList.remove('show');
              this.setAttribute('aria-expanded', 'false');
            } else {
              target.classList.add('show');
              this.setAttribute('aria-expanded', 'true');
            }
          }
        });
      });
      
      // Initialize open menus
      document.querySelectorAll('.collapse.show').forEach(function(openMenu) {
        const menuId = openMenu.id;
        const trigger = document.querySelector(`[data-target="#${menuId}"]`);
        if (trigger) {
          trigger.setAttribute('aria-expanded', 'true');
        }
      });
      
      // Submenu active state
      const subMenuLinks = document.querySelectorAll('.sub-menu .nav-link');
      subMenuLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
          document.querySelectorAll('.sub-menu .nav-item').forEach(item => {
            item.classList.remove('active');
          });
          this.closest('.nav-item').classList.add('active');
        });
      });
      
      // Form reset button
      document.querySelector('.btn-reset').addEventListener('click', function(e) {
        document.querySelector('form').reset();
      });
      
      // Ajout de la fonctionnalité de visualisation des mots de passe
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');
      const iconPassword = togglePassword.querySelector('i');
      
      togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        iconPassword.classList.toggle('mdi-eye');
        iconPassword.classList.toggle('mdi-eye-off');
      });
      
      const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
      const confirmPassword = document.getElementById('confirmPassword');
      const iconConfirmPassword = toggleConfirmPassword.querySelector('i');
      
      toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        iconConfirmPassword.classList.toggle('mdi-eye');
        iconConfirmPassword.classList.toggle('mdi-eye-off');
      });
    });
  </script>
</body>
</html>