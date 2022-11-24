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
        <li class="nav-item">
            <button type="button" class="btn nav-link" id="feedbackButton">
                <i class="fas fa-comment me-1"></i>
                Feedback
            </button>
        </li>
        <form class="nav-item" action="{{ URL::to('logout') }}" method="POST">
            @csrf
            <button class="nav-link btn" type="submit">
                <i class="fas fa-sign-out-alt me-1"></i>
                Keluar
            </button>
        </form>
    </ul>
</nav>
