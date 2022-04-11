@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Contacts
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            {{ Form::model($contacts,['route' => ['contact.show',$contacts->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div class="grid grid-cols-2 py-2">
                    <label for="name" class="text-lg">Name</label>
                    {{ Form::text('name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'name')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="email" class="text-lg">Email</label>
                    {{ Form::email('email',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'email')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="phone_number" class="text-lg">Phone Number</label>
                    {{ Form::text('phone_number',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'phone_number')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="review" class="text-lg">Review</label>
                    {{ Form::text('review',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'review')) }}
                </div>

                <div>
                    <label for="service_id" class="text-lg">Type</label>
                    {!! Form::select('service_id',$services, $contacts->service_id,['class' => 'block shadow-5xl
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