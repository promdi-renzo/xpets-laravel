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
                    <label for="pet_name" class="text-lg">Pet Name</label>
                    {{ Form::text('pet_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'pet_name')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="sex" class="text-lg">sex</label>
                    {{ Form::text('sex',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'sex')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="classification" class="text-lg">classification</label>
                    {{ Form::text('classification',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'classification')) }}
                </div>

                <div>
                    <label for="pictures" class="block text-lg pb-3">Animal Pic</label>
                    <img src="{{ asset('pictures/pets/'.$pets->pictures)}}" alt="Pictures" width="100" height="100"
                        class="ml-36 py-2">
                </div>

                <div>
                    <label for="customer_id" class="text-lg">Customer_Id</label>
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
