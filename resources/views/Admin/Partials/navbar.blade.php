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
                    <button type="button" class="btn dropdown-item" data-bs-toggle="modal"
                        data-bs-target="#firstModal">
                        <i class="fas fa-comments me-1"></i>
                        Feedback
                    </button>
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

<!-- Modal -->
<div class="modal fade" id="firstModal" tabindex="-1" aria-labelledby="firstModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="firstModalLabel">Konfirmasi Feedback</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kendala anda terdapat di layar ini ?
            </div>
            <div class="modal-footer bg-success">
                <button type="button" class="btn btn-danger" id="decisionBtnNoFeedback">Tidak</button>
                <button type="button" class="btn btn-primary" id="decisionBtnYesFeedback">
                    Ya, Benar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="secondModal" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="secondModalLabel">Form Feedback</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kendala anda terdapat di layar ini ?
            </div>
            <div class="modal-footer bg-success">

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="thirdModal" tabindex="-1" aria-labelledby="thirdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="thirdModalLabel">Form Feedback</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kendala anda terdapat di layar ini ?
            </div>
            <div class="modal-footer bg-success">

            </div>
        </div>
    </div>
</div>
