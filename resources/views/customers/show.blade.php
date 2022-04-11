@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Customer
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            {{ Form::model($Customers,['route' => ['customer.show',$Customers->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div class="grid grid-cols-2 py-2">
                    <label for="first_name" class="text-start text-lg">First Name</label>
                    {{ Form::text('first_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'first_name')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="last_name" class="text-start text-lg">Last_name</label>
                    {{ Form::text('last_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'last_name'))
                    }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="phone_number" class="text-lg">Phone Number</label>
                    {{ Form::text('phone_number',null,['readonly'],array('class'=>'block shadow-5xl p-2
                    my-2w-full','id'=>'phone_number')) }}
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Customer Pic</label>
                    <img src="{{ asset('uploads/customers/'.$Customers->images)}}" alt="I am A Pic" width="100"
                        height="100" class="ml-36 py-2">
                </div>

                <div class="grid justify-center w-full pr-11">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold py-2 px-4 mt-5 text-center"
                        role="button">Go Back &rarr;</a>
                </div>
            </div>
            </form>
        </div>
        @endsection