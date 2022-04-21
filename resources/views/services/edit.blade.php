@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Vervices
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($services,['route' => ['service.update',$services->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="service_name" class="text-lg">First Name</label>
                    {{ Form::text('service_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'service_name')) }}
                    @if($errors->has('service_name'))
                    <p class="text-center text-red-500">{{ $errors->first('service_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="cost" class="text-lg">Cost</label>
                    {{ Form::text('cost',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'cost'))
                    }}
                    @if($errors->has('cost'))
                    <p class="text-center text-red-500">{{ $errors->first('cost') }}</p>
                    @endif
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Service Pic</label>
                    {{ Form::file('images',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'images')) }}
                    <img src="{{ asset('pics/services/'.$services->images)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-24 py-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
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