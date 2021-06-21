<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

</head>
<body>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <div id="app">
 
        <b-navbar :sticky=true toggleable="sm" type="dark" variant="primary">
            <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>

            <b-navbar-brand href="{{ url('/') }}" >
                {{ config('app.name', 'Laravel') }}
            </b-navbar-brand>

            <b-collapse id="nav-text-collapse" is-nav>
          
                <b-navbar class="ml-auto">
                    <b-navbar-nav>
                        @guest
                            <b-nav-item href="{{ route('login') }}">Ingresar</b-nav-item>
                            <b-nav-item href="{{ route('register') }}">Registro</b-nav-item>
                        @else
                            <!-- Navbar dropdowns -->
                            <b-nav-item-dropdown text="{{ auth()->user()->name }}" right>
                                <b-dropdown-item href="#" @click="logout">
                                    Cerrar Sesion
                                </b-dropdown-item>
                            </b-nav-item-dropdown>
                    @endguest    
                    </b-navbar-nav>
                </b-navbar>
            
            </b-collapse>
        </b-navbar>

        <b-container>
            <b-row align-h="center" class="my-2">
                <b-col cols=12 class="my-0 mx-0">
                    <alert-component/>
                </b-col>
            </b-row>
            <b-row align-h="center">
                <b-col cols=12>
                    @yield('content')
                </b-col>
            </b-row>
        </b-container>

        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
