@extends('layouts.app')

@section('content')
<div class="pl-24 container">
    <h1 class="text-5xl pt-24">
        Sign In
    </h1>

    <form method="POST" action="{{ route('personnel.signin') }}">
        @csrf

        <div class="">
            <label for="email" class="">Email Address</label>

            <div class="">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>

        <div class="">
            <label for="password" class="col-form-label">Password</label>

            <div class="">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">
                <div class="form-check pt-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                        ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                    @if($errors->has('password'))
                    <p class="text-center text-red-500 font-bold">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="">
            <div class="bg-red-800">
                <input type="submit" value="Sign In" class="p-3 ">
                @if (Route::has('personnel.email'))
                <a class="" href="{{ route('personnel.email') }}">
                    Forgot Your Password
                </a>
                @endif
                <!-- <a href="{{ route('review') }}" class="offset-sm-5 btn btn-danger text-white font-bold">Send Your Feedback</a> -->
            </div>
        </div>
    </form>
</div>
@endsection
