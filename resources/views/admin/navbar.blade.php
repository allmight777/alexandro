<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
            <span class="toolzy-logo"><i class="fas fa-tools text-primary"></i>J-Tools</span>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
            <i class="fas fa-tools text-primary"></i>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <form class="d-flex align-items-center h-100" action="#" onsubmit="return false;" style="height: 45px;">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" id="navbar-search-btn" class="input-group-text border bg-primary rounded-start"
                        style="height: 45px;">
                        <i class="mdi mdi-magnify fs-4  text-white"></i>
                    </button>
                </div>
                <input type="text" id="navbar-search" class="form-control border bg-white rounded-end"
                    placeholder="Rechercher un équipement..." style="height: 45px; width: 500px;">
            </div>
        </form>

        @php
            $initials = strtoupper(substr(auth()->user()->nom, 0, 1) . substr(auth()->user()->prenom, 0, 1));
        @endphp

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="profile-initials">{{ $initials }}</div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    {{-- <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cached mr-2 text-success"></i>
                        Journal d'activité
                    </a> --}}
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none; border: none;">
                            <a class="dropdown-item">
                                <i class="mdi mdi-logout mr-2 text-primary"></i>
                                Déconnexion
                            </a>
                        </button>
                    </form>
                </div>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
