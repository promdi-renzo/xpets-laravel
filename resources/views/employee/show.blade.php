@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show employee
        </h1>
    </div>
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
                <td class="text-center text-3xl">
                    <a href="{{route('employee.show',$employee->id)}}">{{$employee->id}}</a>
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
            </tr>
            @empty
            <p>No employee Data in the Database</p>
            @endforelse
        </table>
    </div>
    @endsection