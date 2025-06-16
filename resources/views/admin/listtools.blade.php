<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toolzy - Gestion des équipements</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
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

        .sidebar .nav .nav-item.active>.nav-link {
            background: linear-gradient(to right, var(--toolzy-primary), var(--toolzy-secondary));
            border-radius: 6px;
        }

        .sidebar .nav .nav-item.active>.nav-link i,
        .sidebar .nav .nav-item.active>.nav-link .menu-title {
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
        .btn-outline-primary,
        .btn-outline-danger,
        .btn-outline-info,
        .btn-outline-warning,
        .btn-outline-success {
            border-radius: 6px;
            padding: 6px 10px;
            transition: all 0.3s;
        }

        .btn-outline-primary:hover,
        .btn-outline-danger:hover,
        .btn-outline-info:hover,
        .btn-outline-warning:hover,
        .btn-outline-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Styles spécifiques pour la page d'inventaire */
        .equipment-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .equipment-img:hover {
            transform: scale(1.05);
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-available {
            background-color: rgba(56, 239, 125, 0.1);
            color: #11998e;
        }

        .status-assigned {
            background-color: rgba(255, 200, 55, 0.1);
            color: #FF8008;
        }

        .status-maintenance {
            background-color: rgba(245, 81, 95, 0.1);
            color: #f5515f;
        }

        .action-icon {
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-icon:hover {
            transform: scale(1.1);
        }

        .edit-icon {
            color: var(--toolzy-primary);
        }

        .delete-icon {
            color: var(--toolzy-danger);
        }

        /* Styles pour la popup d'image */
        .image-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .image-popup-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }

        .image-popup-content img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .close-popup {
            position: absolute;
            top: -40px;
            right: -10px;
            color: white;
            font-size: 30px;
            cursor: pointer;
            background: var(--toolzy-danger);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .close-popup:hover {
            background: #d43f3a;
            transform: rotate(90deg);
        }

        .image-popup-title {
            color: white;
            text-align: center;
            margin-top: 15px;
            font-size: 1.2rem;
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
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Rechercher un équipement..." id="navbar-search">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
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
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard/admin') }}">
                            <span class="menu-title">Tableau de bord</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="false"
                            aria-controls="user-management">
                            <span class="menu-title">Gestion Utilisateurs</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                        </a>
                        <div class="collapse" id="user-management">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('showusers') }}">Liste des
                                        utilisateurs</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('register') }}">Ajouter un
                                        utilisateur</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="collapse" href="#equipment-management" aria-expanded="true"
                            aria-controls="equipment-management">
                            <span class="menu-title">Gestion Équipements</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-laptop menu-icon"></i>
                        </a>
                        <div class="collapse show" id="equipment-management">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item active"> <a class="nav-link"
                                        href="equipment-list.html">Inventaire</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('addToolpage') }}">Ajouter
                                        un équipement</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="equipment-categories.html">Catégories</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="equipment-out-of-service.html">
                            <span class="menu-title">Equipements en Pannes</span>
                            <i class="mdi mdi-alert-circle-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="equipment-lost.html">
                            <span class="menu-title">Equipements Perdus</span>
                            <i class="mdi mdi-emoticon-sad-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="equipment-request.html">
                            <span class="menu-title">Demande D'équipement</span>
                            <i class="mdi mdi-cart-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#external-collaborators"
                            aria-expanded="false" aria-controls="external-collaborators">
                            <span class="menu-title">Collaborateurs externes</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-account-network menu-icon"></i>
                        </a>
                        <div class="collapse" id="external-collaborators">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="external-collaborator-add.html">Ajouter</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="external-collaborator-remove.html">Supprimer</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="external-collaborator-generate.html">Générer bon</a></li>
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
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('post')
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
                                <i class="mdi mdi-laptop"></i>
                            </span>
                            Inventaire des équipements
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Gestion des équipements</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Inventaire</li>
                            </ul>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Liste des équipements</h4>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Description</th>
                                                    <th>Catégorie</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($equipements as $equip)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="/{{ $equip->image_path }}"
                                                                    alt="{{ $equip->nom }}" class="equipment-img"
                                                                    onclick="showImagePopup('/{{ $equip->image_path }}', '{{ $equip->nom }}')">
                                                                <span>{{ $equip->nom }}</span>
                                                            </div>
                                                        </td>
                                                        <td>{{ $equip->description }}</td>
                                                        <td>{{ $equip->categorie->nom }}</td>
                                                        <td>
                                                            <span
                                                                class="status-badge status-available">{{ $equip->etat }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('putToolpage', $equip->id) }}">
                                                                <i class="mdi mdi-pencil edit-icon action-icon"
                                                                    title="Modifier"></i>
                                                            </a>
                                                            <a href="{{ route('DeleteTool', $equip->id) }}">
                                                                <i class="mdi mdi-delete delete-icon action-icon"
                                                                    title="Supprimer"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted">
                                                            Aucun équipement existant.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                  @if ($equipements->count())
                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <div class="text-muted">
                                            Affichage de {{ $equipements->firstItem() }} à
                                            {{ $equipements->lastItem() }} sur {{ $equipements->total() }} équipements
                                        </div>
                                        <div>
                                            {{ $equipements->links() }}
                                        </div>
                                    </div>
                                  @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a
                                href="#" target="_blank">Toolzy</a>. Tous droits réservés.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Gestion des
                            équipements professionnels</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- Image Popup -->
    <div class="image-popup" id="imagePopup">
        <div class="image-popup-content">
            <span class="close-popup" onclick="closeImagePopup()">&times;</span>
            <img id="popupImage" src="" alt="Image agrandie">
            <div class="image-popup-title" id="popupImageTitle"></div>
        </div>
    </div>

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
        // Fonction pour afficher la popup d'image
        function showImagePopup(imageSrc, imageTitle) {
            const popup = document.getElementById('imagePopup');
            const popupImage = document.getElementById('popupImage');
            const popupTitle = document.getElementById('popupImageTitle');

            popupImage.src = imageSrc;
            popupTitle.textContent = imageTitle;
            popup.style.display = 'flex';

            // Empêcher le défilement de la page lorsque la popup est ouverte
            document.body.style.overflow = 'hidden';
        }

        // Fonction pour fermer la popup d'image
        function closeImagePopup() {
            const popup = document.getElementById('imagePopup');
            popup.style.display = 'none';

            // Rétablir le défilement de la page
            document.body.style.overflow = 'auto';
        }

        // Fermer la popup si on clique en dehors de l'image
        document.getElementById('imagePopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImagePopup();
            }
        });

        // Fermer la popup avec la touche ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImagePopup();
            }
        });

        // Script pour gérer les actions sur les équipements
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des clics sur les icônes d'action
            document.querySelectorAll('.edit-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    // Logique pour modifier l'équipement
                    console.log('Modifier équipement:', this.closest('tr').querySelector('td')
                        .textContent.trim());
                });
            });


            // Gestion de la recherche dans la navbar
            const searchInput = document.getElementById('navbar-search');
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>
