<nav class="navbar navbar-expand-md navbar-light fixed-top bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item {{ ($menu == 'home')?'active':''}}">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Inicio') }}</a>
                </li>
                <li class="nav-item {{ ($menu == 'find_functionaries')?'active':''}}">
                    <a class="nav-link" href="{{ route('find_functionaries') }}">{{ __('Encuentra funcionarios') }}</a>
                </li>
                <li class="nav-item {{ ($menu == 'themes')?'active':''}}">
                    <a class="nav-link" href="{{ route('themes') }}">{{ __('Temas') }}</a>
                </li>
                <li class="nav-item {{ ($menu == 'chamber_dips')?'active':''}}">
                    <a class="nav-link" href="{{ route('chamber_dips') }}">{{ __('Diputados') }}</a>
                </li>
                <li class="nav-item {{ ($menu == 'chamber_sens')?'active':''}}">
                    <a class="nav-link" href="#">{{ __('Senadores') }}</a>
                </li>
                @guest
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications') }}">
                            <i class="fa fa-bell"></i>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <sup>
                                    {{auth()->user()->unreadNotifications->count()}}+
                                </sup>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name .' '.Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->role == 'suscriber')
                                <a class="dropdown-item" href="{{ route('profile') }}" title="">
                                    Perfil
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('admin') }}" title="">
                                    Administrador
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>