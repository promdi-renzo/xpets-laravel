@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Customer
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/customer" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="first_name" class="text-lg">First Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="first_name" name="first_name"
                            placeholder="First Name" value="{{old('first_name')}}">
                        @if($errors->has('first_name'))
                        <p class="text-center text-red-500">{{ $errors->first('first_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="last_name" class="text-lg">Last Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="last_name" name="last_name"
                            placeholder="Last Name" value="{{old('last_name')}}">
                        @if($errors->has('last_name'))
                        <p class="text-center text-red-500">{{ $errors->first('last_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="phone_number" class="text-lg" r">Phone Number</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="phone_number"
                            name="phone_number" placeholder="phone_number" value="{{old('phone_number')}}">
                        @if($errors->has('phone_number'))
                        <p class="text-center text-red-500">{{ $errors->first('phone_number') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="images" class="text-lg">Customer Pic</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="images" name="images"
                            value="{{old('images')}}">
                        @if($errors->has('images'))
                        <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                            Submit
                        </button>
                        <a href="{{url()->previous()}}" class="text-center text-lg bg-black text-red-600 p-2 rounded"
                            role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        @endsection
