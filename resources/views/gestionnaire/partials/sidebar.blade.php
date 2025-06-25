<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="d-flex align-items-center">
                    <div class="profile-initials">AT</div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">Gestionnaire Toolzy</span>
                        <span class="text-secondary text-small">Gestionnaire</span>
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item {{ request()->is('dashboard/gestionnaire') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/dashboard/gestionnaire') }}">
                <span class="menu-title">Tableau de bord</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        
        {{-- Gestion Utilisateurs --}}
        @php
            $userActive = request()->routeIs('showusers') || request()->routeIs('register');
        @endphp


        {{-- Gestion Équipements --}}
        @php
            $equipActive = request()->routeIs('ShowToolpage') || request()->routeIs('addToolpage');
        @endphp
        <li class="nav-item {{ $equipActive ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#equipment-management"
                aria-expanded="{{ $equipActive ? 'true' : 'false' }}" aria-controls="equipment-management">
                <span class="menu-title">Gestion Équipements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-laptop menu-icon"></i>
            </a>
            <div class="collapse {{ $equipActive ? 'show' : '' }}" id="equipment-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('gestionnaire.tools.list') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('gestionnaire.tools.list') }}">Inventaire</a>
                    </li>   
                    <li class="nav-item {{ request()->routeIs('gestionnaire.tools.add') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('gestionnaire.tools.add') }}">Ajouter un équipement</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('liste.bons') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('gestionnaire.bons.bon_external')}}">BONS</a>
                    </li>
                  
                </ul>
            </div>
        </li>

        {{-- Le reste des liens, tu peux faire pareil --}}
        <li class="nav-item {{ request()->is('equipment-out-of-service') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('gestionnaire.pannes.index') }}">
                <span class="menu-title">Equipements en Pannes</span>
                <i class="mdi mdi-alert-circle-outline menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->is('equipment-lost') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('gestionnaire.equipements.perdus') }}"class="btn btn-warning">
                <span class="menu-title">Equipements Perdus</span>
                <i class="mdi mdi-emoticon-sad-outline menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs("gestionnaire.demandes.index") ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs('gestionnaire.demandes.index') ? 'active' : '' }}" 
               href="{{ route('gestionnaire.demandes.index') }}">
            <span class="menu-title">Les demandes </span>
                <i class="mdi mdi-cart-outline menu-icon"></i>
            </a>
        </li>

        {{-- Tu continues pour les autres sections de la même façon --}}


        <!-- ------------------------------------------------------------------------------------------------------ -->

        {{-- Affectation Équipement --}}
        <!-- <li class="nav-item">
            <a class="nav-link" href="affectation.html">
                <span class="menu-title">Affectation Équipement</span>
                <i class="mdi mdi-swap-horizontal menu-icon"></i>
            </a>
        </li> -->




        @php
              $affectActive = request()->routeIs('gestionnaire.affectations.*');
        @endphp

        <li class="nav-item {{ $affectActive ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#affectation-management"
                aria-expanded="{{ $affectActive ? 'true' : 'false' }}" aria-controls="affectation-management">
                <span class="menu-title">Affectation Équipement</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-swap-horizontal menu-icon"></i>
            </a>
            <div class="collapse {{ $affectActive ? 'show' : '' }}" id="affectation-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('gestionnaire.affectations.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('gestionnaire.affectations.index') }}">Liste des affectations</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('gestionnaire.affectations.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('gestionnaire.affectations.create') }}">Nouvelle affectation</a>
                    </li>
                </ul>
            </div>
        </li>

<!-- ------------------------------------------------------------------------------------------------------ -->


        {{-- Rapports --}}

    
        @php
            $rapportActive = request()->routeIs('gestionnaire.rapports.*');
        @endphp
        <li class="nav-item {{ $rapportActive ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#rapport-management" 
            aria-expanded="{{ $rapportActive ? 'true' : 'false' }}" aria-controls="rapport-management">
                <span class="menu-title">Rapports</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-chart menu-icon"></i>
            </a>
            <div class="collapse {{ $rapportActive ? 'show' : '' }}" id="rapport-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('gestionnaire.rapports.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('gestionnaire.rapports.index') }}">Liste des rapports</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('gestionnaire.rapports.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('gestionnaire.rapports.create') }}">Générer un rapport</a>
                    </li>
                </ul>
            </div>
        </li>
<!-- ------------------------------------------------------------------------------------------------------------ -->

        {{-- Collaborateurs Externes --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#collab-externes" aria-expanded="false"
                aria-controls="collab-externes">
                <span class="menu-title">Collaborateurs Externes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-group menu-icon"></i>
            </a>
            <div class="collapse" id="collab-externes">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gestionnaire.collaborateurs.create') }}">Ajouter</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gestionnaire.collaborateurs.index') }}">Liste</a>

                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('gestionnaire.bons.bon_external_collaborator') }}">Bon</a>
                    </li>
                </ul>
            </div>
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
