@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show pets
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            {{ Form::model($pets,['route' => ['pets.show',$pets->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div class="grid grid-cols-2 py-2">
                    <label for="animal_name" class="text-lg">Animal Name</label>
                    {{ Form::text('animal_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'animal_name')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="age" class="text-lg">Age</label>
                    {{ Form::text('age',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'age')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="gender" class="text-lg">Gender</label>
                    {{ Form::text('gender',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'gender')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="type" class="text-lg">Type</label>
                    {{ Form::text('type',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'type')) }}
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Animal Pic</label>
                    <img src="{{ asset('uploads/pets/'.$pets->images)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-36 py-2">
                </div>

                <div>
                    <label for="customer_id" class="text-lg">Type</label>
                    {!! Form::select('customer_id',$customers, $pets->customer_id,['class' => 'block shadow-5xl
                    p-2 my-2 w-full', 'disabled' => true]) !!}
                </div>

                <div class="grid justify-center w-full pr-11">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold py-2 px-4 mt-5 text-center"
                        role="button">Go Back &rarr;</a>
                </div>
            </div>
            </form>
        </div>
        @endsection
