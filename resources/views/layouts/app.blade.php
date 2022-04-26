<!doctype html>
<html lang="">

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="">

    <nav class="flex justify-between items-center p-5 navbar navbar-expand-md">
        <div class="container">

            <a href="{{ URL('dashboard') }}">
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
                    <button><a href="{{ URL('employee') }}">
                            <h5 class="mr-4">employee</h5>
                        </a></button>
                    <button><a href="{{ URL('consultation') }}">
                            <h5 class="mr-4">consultation</h5>
                        </a></button>
                    <button><a href="{{ URL('comment') }}">
                            <h5 class="mr-4">comment</h5>
                        </a></button>


                </ul>


                <ul class="navbar-nav ms-auto text-2xl">

                    @guest
                    @if (Route::has('employee.signin'))
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('employee.signin') }}">{{ __('Sign In') }}</a>
                    </li>
                    @endif

                    @if (Route::has('employee.signup'))
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('employee.signup') }}">{{ __('Sign Up') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">

                        {{ Auth::user()->full_name }}

                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ route('employee.logout') }}">{{ __('Logout') }}</a>
                    </li>

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
    </header>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>
