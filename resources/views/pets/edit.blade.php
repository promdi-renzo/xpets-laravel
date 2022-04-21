@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update pets
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($pets,['route' => ['pets.update',$pets->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="pet_name" class="text-lg">Pet Name</label>
                    {{ Form::text('pet_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'pet_name')) }}
                    @if($errors->has('pet_name'))
                    <p class="text-center text-red-500">{{ $errors->first('pet_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="sex" class="text-lg">sex</label>
                    {{ Form::text('sex',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'sex')) }}
                    @if($errors->has('sex'))
                    <p class="text-center text-red-500">{{ $errors->first('sex') }}</p>
                    @endif
                </div>

                <div>
                    <label for="classification" class="text-lg">classification</label>
                    {{ Form::text('classification',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'classification')) }}
                    @if($errors->has('classification'))
                    <p class="text-center text-red-500">{{ $errors->first('classification') }}</p>
                    @endif
                </div>

                <div>
                    <label for="pictures" class="block text-lg pb-3">Pictures</label>
                    {{ Form::file('pictures',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'pictures')) }}
                    <img src="{{ asset('pictures/pets/'.$pets->pictures)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-24 py-2">
                    @if($errors->has('pictures'))
                    <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
                    @endif
                </div>

                <div>
                    <label for="customer_id" class="text-lg">Type</label>
                    {!! Form::select('customer_id',$customers, $pets->customer_id,['class' => 'block shadow-5xl p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('customer_id'))
                    <p class="text-center text-red-500">{{ $errors->first('customer_id') }}</p>
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
