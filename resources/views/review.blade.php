@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="my-3">
    <div class="text-center">
        <h1 class="text-5xl">
            Send Us Your Feedback
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="{{ route('send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="name" class="text-lg">Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-full" id="name" name="name"
                            placeholder="Full Name" value="{{old('name')}}">
                    </div>

                    <div>
                        <label for="email" class="text-lg">Email</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-full" id="email" name="email"
                            placeholder="Email" value="{{old('email')}}">
                    </div>

                    <div>
                        <label for="phone_number" class="text-lg">Phone Number</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-full" id="phone_number"
                            name="phone_number" placeholder="Phone Number" value="{{old('phone_number')}}">
                    </div>

                    <label for="service_id" class="text-lg">Service</label>
                    <select name="service_id" id="service_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($services as $id => $service)
                        <option value="{{ $id }}">{{ $service }}</option>
                        @endforeach
                    </select>

                    <div>
                        <label for="review" class="text-lg">Feedback</label>
                        <textarea id="review" name="review" class="block shadow-5xl p-2 my-3 w-full" rows="4" cols="50"
                            placeholder="Leave Your Message Here" value="{{old('review')}}"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                            Submit
                        </button>
                        <a href="{{route('personnel.signin')}}"
                            class="text-center text-lg bg-black text-red-600 p-2 rounded" role="button">Go Back</a>
                    </div>
                </div>
            </form>
        </div>

        @endsection
