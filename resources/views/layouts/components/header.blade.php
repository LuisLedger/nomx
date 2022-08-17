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
                <li class="nav-item {{ ($menu_name == 'home')?'active':''}}">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Inicio') }}</a>
                </li>
                <li class="nav-item {{ ($menu_name == 'find_functionaries')?'active':''}}">
                    <a class="nav-link" href="{{ route('find_functionaries') }}">{{ __('Encuentra funcionarios') }}</a>
                </li>
                <li class="nav-item {{ ($menu_name == 'themes')?'active':''}}">
                    <a class="nav-link" href="{{ route('themes') }}">{{ __('Temas') }}</a>
                </li>
                <li class="nav-item {{ ($menu_name == 'chamber_dips')?'active':''}}">
                    <a class="nav-link" href="{{ route('chamber_dips') }}">{{ __('Diputados') }}</a>
                </li>
                <li class="nav-item {{ ($menu_name == 'chamber_sens')?'active':''}}">
                    <a class="nav-link" href="{{ route('chamber_sens') }}">{{ __('Senadores') }}</a>
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
                        <a class="nav-link" href="{{ route('admin') }}">{{ __('Ir al Admin') }}</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications') }}">
                            <i class="fa fa-bell"></i>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <sup>
                                    {{auth()->user()->unreadNotifications->count()}}+
                                </sup>
                            @endif
                        </a>
                    </li> --}}
                @endguest
            </ul>
        </div>
    </div>
</nav>