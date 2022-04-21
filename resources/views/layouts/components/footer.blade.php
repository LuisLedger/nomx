<footer class="mt-3 mb-5">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-12 col-md">
                <img src="{{asset('imgs/logo.png')}}" style="height: 25px;margin-top: 1rem; margin-bottom: 1rem;"/>
                <small class="d-block mb-3 text-muted">
                    © {{ config('app.name', 'Laravel') }} - {{date('Y')}} 
                    <br>
                    powered by Luis Navarro 
                </small>
                <a href="https://www.facebook.com/MiDirectorIOWeb/" target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
                {{-- &nbsp;&nbsp;
                <a href="#">
                    <i class="fa fa-twitter"></i>
                </a> --}}
                &nbsp;&nbsp;
                <a href="https://www.instagram.com/midirectorioweb" target="_blank">
                    <i class="fa fa-instagram"></i>
                </a>
            </div>
            <div class="col-6 col-md">
                <h5>
                    Estados
                </h5>
                <ul class="list-unstyled text-small">
                    @foreach (\App\Models\State::limit(4)->get() as $state)
                        <li>
                            <a href="{{ route('cities', ['state' => $state->name]) }}">
                                {{ $state->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>
                    Ciudades
                </h5>
                <ul class="list-unstyled text-small">
                    @foreach (\App\Models\Delegation::where('status',1)->limit(4)->get() as $delegation)
                        <li>
                            <a href="{{ route('home', ['city' => $delegation->name]) }}">
                                {{ $delegation->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>
                    Avisos Legales
                </h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="{{ route('terms') }}">
                            Términos de uso
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacity') }}">
                            Privacidad
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('service') }}">
                            Servicio
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>
                    Acerca de Nosotros
                </h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a href="{{ route('team') }}">
                            Equipo
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mision_vision') }}">
                            Misión y Visión
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">
                            Contácto
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>