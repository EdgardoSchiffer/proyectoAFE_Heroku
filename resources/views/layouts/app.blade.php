<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link id="estilos" href="{{Cache::get('tema')}}" rel="stylesheet">

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

</head>
<body >
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- 
                EJEMPLOS DE COMO VALIDAR ROL:
                //Multiples roles
                @hasanyrole('Administrator|Client')
                @endhasanyrole
                //Un solo rol
                @role('Administrator')
                @endrole
                https://spatie.be/docs/laravel-permission/v5/basic-usage/blade-directives#content-roles
                -->
                @role('Administrator')
                <a class="navbar-brand" href="{{ url('/vehicle') }}">
                    Vehículos
                </a>
                @endrole
                <a class="navbar-brand" href="{{ url('/vehicleDashboard') }}">
                    Vehículos dashboard
                </a>
                @role('Administrator')
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Mntto. Catalogos
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="{{ url('/departments') }}">
                                Departamentos
                            </a>
                         </li>
                         <li>
                            <a class="dropdown-item" href="{{ url('/municipalities') }}">
                                Municipios
                            </a>
                         </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/brand') }}">
                            Marcas
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/accessories') }}">
                            Accesorios
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/fuel_type') }}">
                            Tipo de Combustible
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/vehicle_type') }}">
                            Tipo de Vehículo
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/accessory_type') }}">
                            Tipo de Accesorio
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/roles') }}">
                            Roles
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/clients') }}">
                            Clientes
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="{{ url('/users') }}">
                            Usuarios
                        </a>
                     </li>
                    </ul>
                </div>
                @endrole
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                {{-- modo oscuro --}}
                <div class="toggle-container">
                    <button class="theme-btn light animate__animated animate__bounceInDown" onclick="setLight()" title="Light mode">
                      <img src="upload/images/sun.png" alt="sun">
                    </button>
                    <button class="theme-btn dark animate__animated animate__bounceInDown" onclick="setDark()" title="Dark mode">
                      <img src="upload/images/moon.png" alt="moon">
                    </button>
                </div>
            </div>
        </nav>

        <main class="py-3">
            @yield('content')
        </main>
    </div>
</body>
</html>


<script>
    //ejecutar al inicio
    const inicio = ()=>{
        if(localStorage.tema){
            document.getElementById('estilos').href = localStorage.tema;
        }else{
            document.getElementById('estilos').href = 'css/light.css';
        }
    }
window.onload = inicio();

//set tema claro
    const setLight=()=>{
        document.getElementById('estilos').href = 'css/light.css';
        localStorage.removeItem("tema");
        localStorage.setItem("tema", "css/light.css")
    }

    //set tema oscuro
    const setDark=()=>{
        document.getElementById('estilos').href = 'css/dark.css';
        localStorage.removeItem("tema");
        localStorage.setItem("tema", "css/dark.css")
    }
</script>
