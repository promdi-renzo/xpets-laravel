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
                        <label for="pet_name" class="text-lg">Pet Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="pet_name" name="pet_name"
                            placeholder="Animal Name" value="{{old('pet_name')}}">
                        @if($errors->has('pet_name'))
                        <p class="text-center text-red-500">{{ $errors->first('pet_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="sex" class="text-lg">Sex</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="sex" name="sex"
                            placeholder="sex" value="{{old('sex')}}">
                        @if($errors->has('sex'))
                        <p class="text-center text-red-500">{{ $errors->first('sex') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="classification" class="text-lg">classification</label>
                        <input classification="text" class="block shadow-5xl p-2 my-2 w-full" id="classification" name="classification"
                            placeholder="classification of Animal" value="{{old('classification')}}">
                        @if($errors->has('classification'))
                        <p class="text-center text-red-500">{{ $errors->first('type') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="pictures" class="text-lg">Pictures</label>
                        <input type="file" class="" id="pictures" name="pictures"
                            value="{{old('pictures')}}">
                        @if($errors->has('pictures'))
                        <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
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
