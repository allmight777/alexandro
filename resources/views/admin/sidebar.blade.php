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

        <li class="nav-item {{ request()->is('dashboard/admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/dashboard/admin') }}">
                <span class="menu-title">Tableau de bord</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        {{-- Gestion Utilisateurs --}}
        @php
            $userActive = request()->routeIs('showusers') || request()->routeIs('register');
        @endphp
        <li class="nav-item {{ $userActive ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#user-management"
                aria-expanded="{{ $userActive ? 'true' : 'false' }}" aria-controls="user-management">
                <span class="menu-title">Gestion Utilisateurs</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
            <div class="collapse {{ $userActive ? 'show' : '' }}" id="user-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('showusers') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('showusers') }}">Liste des utilisateurs</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('register') }}">Ajouter un utilisateur</a>
                    </li>
                </ul>
            </div>
        </li>

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
                    <li class="nav-item {{ request()->routeIs('ShowToolpage') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ShowToolpage') }}">Inventaire</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('addToolpage') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('addToolpage') }}">Ajouter un équipement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="equipment-categories.html">Catégories</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Le reste des liens, tu peux faire pareil --}}
        <li class="nav-item  {{ request()->routeIs("equipements.pannes") ? 'active' : '' }}">
            <a class="nav-link" href="{{route("equipements.pannes")}}">
                <span class="menu-title">Equipements en Pannes</span>
                <i class="mdi mdi-alert-circle-outline menu-icon"></i>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link {{ request()->routeIs("tools.lost") ? 'active' : '' }}" href="{{route('tools.lost')}}">
                <span class="menu-title">Equipements Perdus</span>
                <i class="mdi mdi-emoticon-sad-outline menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs("liste.demandes") ? 'active' : '' }}">
            <a class="nav-link" href="{{route("liste.demandes")}}">
                <span class="menu-title">Demande D'équipement</span>
                <i class="mdi mdi-cart-outline menu-icon"></i>
            </a>
        </li>

        {{-- Tu continues pour les autres sections de la même façon --}}
        
        {{-- Affectation Équipement --}}
        <li class="nav-item {{ request()->routeIs("page.affectation") ? 'active' : '' }}">
            <a class="nav-link" href="{{ route("page.affectation") }}">
                <span class="menu-title">Affectation Équipement</span>
                <i class="mdi mdi-swap-horizontal menu-icon"></i>
            </a>
        </li>

        {{-- Rapports --}}
        <li class="nav-item">
            <a class="nav-link" href="rapports.html">
                <span class="menu-title">Rapports</span>
                <i class="mdi mdi-file-chart menu-icon"></i>
            </a>
        </li>

        {{-- Collaborateurs Externes CollaboratorsPage" --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#collab-externes" aria-expanded="false"
                aria-controls="collab-externes">
                <span class="menu-title">Collaborateurs Externes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-group menu-icon"></i>
            </a>
            <div class="collapse" id="collab-externes">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('CollaboratorsPage') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route("CollaboratorsPage")}}">Ajouter</a>
                    </li>
                    <li class="nav-item  {{ request()->routeIs('ShowListCollaborator') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('ShowListCollaborator')}}">Liste</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="collaborateurs-bon.html">Bon</a>
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
