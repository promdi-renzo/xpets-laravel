@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Personnel
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            {{ Form::model($personnels,['route' => ['personnel.show',$personnels->id],'method'=>'PUT']) }}
            <div class="block">
                <div class="grid grid-cols-2 py-2">
                    <label for="full_name" class="text-lg">Full Name</label>
                    {{ Form::text('full_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'full_name')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="email" class="text-lg">Email</label>
                    {{ Form::email('email',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'email')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="role" class="text-lg mt-2">Pick Your Role</label>
                    {{ Form::text('role',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'role')) }}
                </div>

                <div class="grid justify-center w-full">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold py-2 px-4 mt-5 text-center"
                        role="button">Go Back &rarr;</a>
                </div>
            </div>
            </form>
        </div>
        @endsection