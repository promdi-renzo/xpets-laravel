@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Animal
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/pets" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="animal_name" class="text-lg">Animal Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="animal_name" name="animal_name"
                            placeholder="Animal Name" value="{{old('animal_name')}}">
                        @if($errors->has('animal_name'))
                        <p class="text-center text-red-500">{{ $errors->first('animal_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="age" class="text-lg">Age</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="age" name="age"
                            placeholder="Age" value="{{old('age')}}">
                        @if($errors->has('age'))
                        <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="gender" class="text-lg">Gender</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="gender" name="gender"
                            placeholder="Gender" value="{{old('gender')}}">
                        @if($errors->has('gender'))
                        <p class="text-center text-red-500">{{ $errors->first('gender') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="type" class="text-lg">Type</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="type" name="type"
                            placeholder="Type of Animal" value="{{old('type')}}">
                        @if($errors->has('type'))
                        <p class="text-center text-red-500">{{ $errors->first('type') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="images" class="text-lg">Animal Pic</label>
                        <input type="file" class="" id="images" name="images"
                            value="{{old('images')}}">
                        @if($errors->has('images'))
                        <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                        @endif
                    </div>

                    <label for="customer_id" class="text-lg">Customer</label>
                    <select name="customer_id" id="customer_id" class="">
                        @foreach ($customers as $id => $customer)
                        <option value="{{ $id }}">{{ $customer }}</option>
                        @endforeach
                    </select>

                    <div class="mt-4">
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
