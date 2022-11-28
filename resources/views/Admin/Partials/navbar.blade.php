<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a type="button" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ URL::to('profil-saya') }}">
                        <i class="fas fa-user-circle me-1"></i>
                        Profil Saya
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ URL::to('ubah-password') }}">
                        <i class="fas fa-key me-1"></i>
                        Ubah Password
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="https://s.id/feedbackformregonline">
                        <i class="fas fa-comments me-1"></i>
                        Feedback
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form class="dropdown-item p-0 m-0" action="{{ URL::to('logout') }}" method="POST">
                        @csrf
                        <button class="btn" type="submit">
                            <i class="fas fa-sign-out-alt me-1"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
