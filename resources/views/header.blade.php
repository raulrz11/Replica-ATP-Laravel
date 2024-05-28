<header style="background-color: #051224; border-bottom: 2px solid white;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="row collapse navbar-collapse" id="navbarNav">
            <div class="col-2">
                <img src="/images/logo.png" alt="Logo" height="70px" width="140px">
            </div>
            <div class="col-3">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex justify-content-evenly">
                        <a class="nav-link {{ Route::is('tenistas.index') ? 'active' : '' }}" href="{{ route('tenistas.index') }}" style="color: white">Tenistas</a>
                        <a class="nav-link {{ Route::is('torneos.index') ? 'active' : '' }}" href="{{ route('torneos.index') }}" style="color: white">Torneos</a>
                    </li>
                </ul>
            </div>
            <div class="col-4">

            </div>
        </div>
    </nav>
</header>
