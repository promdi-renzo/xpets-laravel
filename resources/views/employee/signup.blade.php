@extends('layouts.app')

@section('content')
<div class="pl-32 container w-full">

    <h1 class="text-5xl">
        Sign Up
    </h1>

    <form method="POST" action="{{ route('employee.signup') }}" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <label for="full_name" class="col-form-label">Full Name</label>

            <div class="col-md-6">
                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror"
                    name="full_name" value="{{ old('full_name') }}">

                @if($errors->has('full_name'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('full_name') }}</p>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-form-label">Email Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}">

                @if($errors->has('email'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-form-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">

                @if($errors->has('password'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('password') }}</p>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-form-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>
        </div>

        <div>
            <label for="pictures" class="text-lg">Picture</label>
            <input type="file" class="block shadow-5xl p-2 w-full" id="pictures" name="pictures"
                value="{{old('pictures')}}">
            @if($errors->has('pictures'))
            <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
            @endif
        </div>

        <div class="row">
            <div class="col-md-6">
                <input type="submit" value="Sign Up" class="btn btn-primary">
                <a href="{{url()->previous()}}" class="btn btn-danger" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection