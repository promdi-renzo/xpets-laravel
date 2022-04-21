@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Employee
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($employees,['route' => ['employee.update',$employees->id],'method'=>'PUT']) }}
            <div class="block">
                <div>
                    <label for="full_name" class="text-lg">Full Name</label>
                    {{ Form::text('full_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'full_name')) }}
                    @if($errors->has('full_name'))
                    <p class="text-center text-red-500">{{ $errors->first('full_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="email" class="text-lg">Email</label>
                    {{ Form::email('email',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'email')) }}
                    @if($errors->has('email'))
                    <p class="text-center text-red-500">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <label for="role" class="text-lg">Pick Your Role</label>
                    {{ Form::select('role',array('Employee' => 'Employee', 'Veterinarian' => 'Veterinarian', 'Volunteer'
                    => 'Volunteer'))}}
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
