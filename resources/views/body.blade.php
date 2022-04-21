<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
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
                <button><a href={{ URL('employee') }}>
                        <h5 class="mr-4">employee</h5>
                    </a></button>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto text-2xl">
                <!-- Authentication Links -->

                @guest
                @if (Route::has('employee.signin'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('employee.signin') }}">{{ __('Sign In') }}</a>
                </li>
                @endif

                @if (Route::has('employee.signup'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('employee.signup') }}">{{ __('Sign Up') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->full_name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('employee.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<body>
    @include('sweetalert::alert')
    @yield('contents')
</body>

</html>