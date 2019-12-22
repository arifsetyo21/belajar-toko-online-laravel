<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="dicoding:email" content="arifsetyo19@gmail.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Reselia') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- <script src="{{asset('js/tail.select.min.js')}}"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.4.3/dist/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.4.3/dist/sweetalert2.css">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Reselia') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Auth::check())
                            <li class="nav-item {{(Request::is('home') || Request::is('catalogs')) ? 'active' : ''}}">
                                <a class="nav-link" href="{{url('/home')}}">Home <span class="sr-only">(current)</span></a>
                            </li>
                            @can('admin-access')
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" aria-haspopup="true" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Manage <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="dropdown-item">
                                            <a href="{{route('categories.index')}}"><i class="fa fa-btn fa-tags"></i>Categories</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('products.index')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Products</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('orders.index')}}"><i class="fa fa-car" aria-hidden="true"></i>Orders</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                        @endif
                        <li class="nav-item {{Request::is('checkout/login')? 'active' : ''}}">
                            <a class="nav-link" href="{{url('checkout/login')}}">Checkout</a>
                        </li>  
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            @include('layouts._customer-feature', ['partial_view' => 'layouts._cart-menu-bar'])
                        </li>
                        <li class="nav-item">
                            @include('layouts._customer-feature', ['partial_view' => 'layouts._check-order-menu-bar', 'data' => []])
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <div class="container mt-3">
            @include('flash::message')
        </div>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    @if (Session::has('flash_product_name'))
        @include('catalog._product-added', ['product_name' => Session::get('flash_product_name')])
    @endif
    <script>
        @yield('script')
    </script>

    <!-- Sweetalert -->
    @include('sweetalert::alert')
</body>
</html>
