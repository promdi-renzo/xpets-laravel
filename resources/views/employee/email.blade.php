@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-5xl pt-32 ml-4">
        {{ __('Reset Password') }}
    </h1>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('employeee.email') }}">
            @csrf

            <div class="row mb-3">
                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <a href="{{url()->previous()}}" class="btn btn-danger" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection
