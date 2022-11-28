<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('dashboard') }}" class="brand-link">
        <img src="{{ URL::to('bin/img/0DaWevkh_400x400-removebg-preview.png') }}" alt="PT.MAN Logo"
            class="brand-image me-3" style="opacity: .8;">
        <span class="brand-text fw-bold h6">PT. Media Antar Nusa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->profile_pic != null ? auth()->user()->profile_pic : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                    class="img-circle elevation-2" alt="User Image" style="height: 2em; width: 2em;">
            </div>
            <div class="info">
                <a href="{{ URL::to('profil-saya') }}"
                    class="d-block">{{ implode(' ', [explode(' ', auth()->user()->name)[0], explode(' ', auth()->user()->name)[1]]) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ URL::to('dashboard') }}"
                        class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header mt-2 fw-bold text-secondary">Data Master</li>
                <li class="nav-item">
                    <a href="{{ URL::to('data-pelanggan') }}"
                        class="nav-link {{ Request::segment(1) == 'data-pelanggan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('data-layanan') }}"
                        class="nav-link {{ Request::segment(1) == 'data-layanan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Data Layanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('data-promo') }}"
                        class="nav-link {{ Request::segment(1) == 'data-promo' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Data Promo
                        </p>
                    </a>
                </li>
                @can('AuthMaster')
                    <li class="nav-item">
                        <a href="{{ URL::to('data-pengguna') }}"
                            class="nav-link {{ Request::segment(1) == 'data-pengguna' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Data Pengguna
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
