@extends('layouts.app')

@section('content')
<div class="pl-24 container">
    <h1 class="text-5xl pt-24">
        Sign In
    </h1>

    <form method="POST" action="{{ route('employee.signin') }}">
        @csrf

        <div class="">
            <label for="email" class="">Email Address</label>

            <div class="">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}">
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
                @if($errors->has('password'))
                <p class="text-center text-red-500 font-bold">{{ $errors->first('password') }}</p>
                @endif
            </div>
        </div>

        <div class="">
            <div class="bg-red-800">
                <input type="submit" value="Sign In" class="p-3 ">
            </div>
        </div>
    </form>
</div>
@endsection