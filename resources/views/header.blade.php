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
            <div class="col-3">

            </div>
            <div class="col-4 d-flex justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex justify-content-around" style="padding-right: 20px">
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: white">
                                    {{ __('Cerrar Sesion') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="nav-link" style="color: white">Iniciar Sesion</a>
                                <a href="{{ route('register') }}" class="nav-link" style="color: white">Registrarse</a>
                            @endauth
                        @endif
                    </li>
                    @auth()
                        <li class="nav-item">
                            <div class="d-flex justify-content-center align-items-center">
                                <a class="d-flex justify-content-center align-items-center" style="background-color: #007bff; color: white; padding: 10px; width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; text-decoration: none" href="{{ route ('home')  }}">
                                    <span class="navbar-text" style="color: #413f3d; font-family: 'Rowdies';">
                                        {{ strtoupper(substr(auth()->user()->nombre ?? 'invitado/a', 0, 1)) }}
                                    </span>
                                </a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <div class="d-flex justify-content-center align-items-center" style="background-color: #007bff; color: white; padding: 10px; width: 40px; height: 40px; border-radius: 50%">
                                <span class="navbar-text" style="color: #413f3d; font-family: 'Rowdies';">
                                    {{ strtoupper(substr('invitado/a', 0, 1)) }}
                                </span>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
