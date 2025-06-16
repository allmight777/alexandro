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
      <a class="nav-link" href="{{url('/dashboard/admin')}}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Tableau de bord</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link sidebar-dropdown-toggle" href="#user-management" data-target="#user-management">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Gestion Utilisateurs</span>
        <i class="mdi mdi-chevron-down menu-arrow"></i>
      </a>
      <div class="collapse show" id="user-management">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('showusers')}}">Liste des utilisateurs</a>
          </li>
          <li class="nav-item active"> 
            <a class="nav-link" href="{{route('register')}}">Ajouter un utilisateur</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link sidebar-dropdown-toggle" href="#equipment-management" data-target="#equipment-management">
        <i class="mdi mdi-laptop menu-icon"></i>
        <span class="menu-title">Gestion Équipements</span>
        <i class="mdi mdi-chevron-down menu-arrow"></i>
      </a>
      <div class="collapse" id="equipment-management">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="equipment-list.html">Inventaire</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="equipment-add.html">Ajouter équipement</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="equipment-categories.html">Catégories</a>
          </li>
        </ul>
      </div>
    </li>
    
    <!-- Section Equipements en Pannes -->
    <li class="nav-item">
      <a class="nav-link" href="equipment-out-of-service.html">
        <i class="mdi mdi-alert-circle-outline menu-icon"></i>
        <span class="menu-title">Equipements en Pannes</span>
      </a>
    </li>
    
    <!-- Section Equipements Perdus -->
    <li class="nav-item">
      <a class="nav-link" href="equipment-lost.html">
        <i class="mdi mdi-emoticon-sad-outline menu-icon"></i>
        <span class="menu-title">Equipements Perdus</span>
      </a>
    </li>
    
    <!-- Section Demande D'equipement -->
    <li class="nav-item">
      <a class="nav-link" href="equipment-request.html">
        <i class="mdi mdi-cart-outline menu-icon"></i>
        <span class="menu-title">Demande Equipement</span>
      </a>
    </li>
    
    <!-- Section Collaborateurs externes -->
    <li class="nav-item">
      <a class="nav-link sidebar-dropdown-toggle" href="#external-collaborators" data-target="#external-collaborators">
        <i class="mdi mdi-account-network menu-icon"></i>
        <span class="menu-title">Collaborateurs externes</span>
        <i class="mdi mdi-chevron-down menu-arrow"></i>
      </a>
      <div class="collapse" id="external-collaborators">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="external-collaborator-add.html">Ajouter</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="external-collaborator-list.html">Liste</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="external-collaborator-generate.html">Générer bon</a>
          </li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="assignments.html">
        <i class="mdi mdi-account-check menu-icon"></i>
        <span class="menu-title">Affectations</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="reports.html">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Rapports</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="maintenance.html">
        <i class="mdi mdi-wrench menu-icon"></i>
        <span class="menu-title">Maintenance</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="settings.html">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Paramètres</span>
      </a>
    </li>
    <!-- Correction du bouton de déconnexion -->
    <li class="nav-item">
      <a href="#" class="btn btn-danger mybtn">Déconnexion</a>
    </li>
  </ul>
</nav>
<!-- partial -->