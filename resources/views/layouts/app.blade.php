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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="">

    <div id="app"></div>

    <nav class="flex justify-between items-center p-5 navbar navbar-expand-md">
        <div class="container">

            <a href="{{ URL('data') }}">
                <div class="flex font-bold text-2xl bg-white rounded-l-lg">
                    <h1 class="flex-auto p-2 font-bold bg-black border-black text-red-600 rounded-l-lg">XxXxX</h1>
                    <h1 class="flex-auto p-2 text-black bg-slate-100 rounded-r-lg">Pets</h1>
                </div>
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto text-2xl ml-48">
                    <button> <a href="{{ URL('dashboard') }}">
                            <h5 class="mr-4">Home</h5>
                        </a></button>
                    <button> <a href="{{ URL('pets') }}">
                            <h5 class="mr-4">Pets</h5>
                        </a></button>
                    <button><a href="{{ URL('customer') }}">
                            <h5 class="mr-4">Customer</h5>
                        </a></button>
                    <button><a href="{{ URL('service') }}">
                            <h5 class="mr-4">Service</h5>
                        </a></button>
                    <button><a href="{{ URL('consultation') }}">
                            <h5 class="mr-4">Consultations</h5>
                        </a></button>
                    <button><a href="{{ URL('contact') }}">
                            <h5 class="mr-4">Feedback</h5>
                        </a></button>
                    <button><a href={{ URL('personnel') }}>
                            <h5 class="mr-4">Personnel</h5>
                        </a></button>
                    <li class="nav-item">
                        <a href="{{ route('transaction.shoppingCart') }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
                            <span class="text-xs text-white">{{ Session::has('cart') ? Session::get('cart')->totalCost :
                                '' }}</span>
                        </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto text-2xl">
                    <!-- Authentication Links -->

                    @guest
                    @if (Route::has('personnel.signin'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('personnel.signin') }}">{{ __('Sign In') }}</a>
                    </li>
                    @endif

                    @if (Route::has('personnel.signup'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('personnel.signup') }}">{{ __('Sign Up') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('personnel.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('personnel.logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    </header>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>
