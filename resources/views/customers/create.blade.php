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
                        <label for="full_name" class="text-lg">Full Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="full_name" name="full_name"
                            placeholder="First Name" value="{{old('full_name')}}">
                        @if($errors->has('full_name'))
                        <p class="text-center text-red-500">{{ $errors->first('full_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="number" class="text-lg">Number</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="number"
                            name="number" placeholder="number" value="{{old('number')}}">
                        @if($errors->has('number'))
                        <p class="text-center text-red-500">{{ $errors->first('number') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="pictures" class="text-lg">Picture</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="pictures" name="pictures"
                            value="{{old('pictures')}}">
                        @if($errors->has('pictures'))
                        <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
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
