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
                    <label for="animal_name" class="text-lg">Animal Name</label>
                    {{ Form::text('animal_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'animal_name')) }}
                    @if($errors->has('animal_name'))
                    <p class="text-center text-red-500">{{ $errors->first('animal_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="age" class="text-lg">Age</label>
                    {{ Form::text('age',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'age')) }}
                    @if($errors->has('age'))
                    <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                    @endif
                </div>

                <div>
                    <label for="gender" class="text-lg">Gender</label>
                    {{ Form::text('gender',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'gender')) }}
                    @if($errors->has('gender'))
                    <p class="text-center text-red-500">{{ $errors->first('gender') }}</p>
                    @endif
                </div>

                <div>
                    <label for="type" class="text-lg">Type</label>
                    {{ Form::text('type',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'type')) }}
                    @if($errors->has('type'))
                    <p class="text-center text-red-500">{{ $errors->first('type') }}</p>
                    @endif
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Animal Pic</label>
                    {{ Form::file('images',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'images')) }}
                    <img src="{{ asset('uploads/pets/'.$pets->images)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-24 py-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
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
