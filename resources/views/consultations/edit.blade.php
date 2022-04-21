@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Consultations
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($consultations,['route' => ['consultation.update',$consultations->id],'method'=>'PUT']) }}
            <div class="block">
                <div>
                    <label for="date" class="text-lg">Date</label>
                    {{ Form::date('date',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'date')) }}
                    @if($errors->has('date'))
                    <p class="text-center text-red-500">{{ $errors->first('date') }}</p>
                    @endif
                </div>

                <div>
                    <label for="disease_injury" class="text-lg">Disease or Injury</label>
                    {{ Form::select('disease_injury',array('Cataracts' => 'Cataracts', 'Arthritis' => 'Arthritis',
                    'Ear_Infections' => 'Ear_Infections', 'Kennel_Cough' => 'Kennel_Cough',
                    'Diarrhea' => 'Diarrhea', 'Fleas_and_ticks' => 'Fleas_and_ticks',
                    'Heartworm' => 'Heartworm', 'Broken_Bones' => 'Broken_Bones',
                    'Obesity' => 'Obesity', 'Cancer' => 'Cancer'))}}
                </div>

                <div>
                    <label for="price" class="text-lg">Price</label>
                    {{ Form::text('price',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'price')) }}
                    @if($errors->has('price'))
                    <p class="text-center text-red-500">{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div>
                    <label for="comment" class="text-lg">Comment</label>
                    {{ Form::text('comment',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'comment')) }}
                    @if($errors->has('comment'))
                    <p class="text-center text-red-500">{{ $errors->first('comment') }}</p>
                    @endif
                </div>

                <div>
                    <label for="employee_id" class="text-lg">Type</label>
                    {!! Form::select('employee_id',$employees, $consultations->employee_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('employee_id'))
                    <p class="text-center text-red-500">{{ $errors->first('employee_id ') }}</p>
                    @endif
                </div>

                <div>
                    <label for="animal_id" class="text-lg">Type</label>
                    {!! Form::select('animal_id',$pets, $consultations->animal_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('animal_id'))
                    <p class="text-center text-red-500">{{ $errors->first('animal_id ') }}</p>
                    @endif
                </div>


                <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Submit
                </button>
                <a href="{{url()->previous()}}" class="text-center text-lg bg-black text-red-600 p-2 rounded"
                    role="button">Cancel</a>
            </div>

            </form>
        </div>
        @endsection