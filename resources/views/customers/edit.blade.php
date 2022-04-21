@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Customer
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($Customers,['route' => ['customer.update',$Customers->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="full_name" class="text-lg">First Name</label>
                    {{ Form::text('full_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'full_name')) }}
                    @if($errors->has('full_name'))
                    <p class="text-center text-red-500">{{ $errors->first('full_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="number" class="text-lg">Number</label>
                    {{ Form::text('number',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'number')) }}
                    @if($errors->has('number'))
                    <p class="text-center text-red-500">{{ $errors->first('number') }}</p>
                    @endif
                </div>

                <div>
                    <label for="pictures" class="block text-lg pb-3">Pictures</label>
                    {{ Form::file('pictures',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'pictures')) }}
                    <img src="{{ asset('pics/customers/'.$Customers->pictures)}}" alt="I am A Pic" width="100"
                        height="100" class="ml-24 py-2">
                    @if($errors->has('pictures'))
                    <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
                    @endif
                </div>


                    <button type="submit" class="text-red-600 p-3 italic bg-black text-lg">
                        Submit
                    </button>
                    <a href="{{url()->previous()}}" class="text-red-600 p-3 italic bg-black text-lg"
                        role="button">Cancel</a>

            </div>
            </form>
        </div>
        @endsection
