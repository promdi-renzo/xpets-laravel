@extends('layouts.app')

@section('content')

<div class="py-3">
    <table class="border-collapse shadow">
        <thead>
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">Full Name</th>
                <th class="w-screen text-3xl p-3">Email</th>
                <th class="w-screen text-3xl p-3">Pic</th>
                <th class="w-screen text-3xl p-3">Update</th>
                <th class="w-screen text-3xl p-3">Delete</th>
                <th class="w-screen text-3xl p-3">Restore</th>
                <th class="w-screen text-3xl p-3">Destroy</th>
            </tr>
        </thead>


        @forelse ($employees as $employee)
        <tr>
            @if($employee->deleted_at)
            <td class="text-center text-3xl">
                <a href="#">{{$employee->id}}</a>
            </td>
            @else
            <td class="text-center text-3xl">
                <a href="{{route('employee.show',$employee->id)}}">{{$employee->id}}</a>
            </td>
            @endif
            </td>
            <td class="text-center text-3xl">
                {{ $employee->full_name }}
            </td>
            <td class="text-center text-3xl">
                {{ $employee->email }}
            </td>
            <td class="pl-12">
                <img src="{{ asset('pics/employee/'.$employee->pictures)}}" alt="Pic" width="75" height="75">
            </td>
            @if($employee->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-black p-2">
                        Update
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="employee/{{ $employee->id }}/edit" class="text-center text-2xl bg-black p-2">
                    Update
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('employee.destroy', $employee->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Delete
                </button>
                {!! Form::close() !!}
            </td>
            @if($employee->deleted_at)
            <td>
                <a href="{{ route('employee.restore', $employee->id) }}">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded">
                        Restore
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded">
                        Restore
                    </p>
                </a>
            </td>
            @endif
            <td>
                <a href="{{ route('employee.forceDelete', $employee->id) }}">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No employee Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $employees->links()}}</div>
</div>
</div>
@endsection