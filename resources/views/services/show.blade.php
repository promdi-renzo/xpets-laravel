@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Services
        </h1>
    </div>
    <div class="py-3">
        <table class="border-collapse shadow">
            <thead>
                <tr class="text-gray-50 text-center">
                    <th class="w-screen text-3xl p-3">Id</th>
                    <th class="w-screen text-3xl p-3">Service Name</th>
                    <th class="w-screen text-3xl p-3">Cost</th>
                    <th class="w-screen text-3xl p-3">Animal Pic</th>
                    <th class="w-screen text-3xl p-3">Update</th>
                    <th class="w-screen text-3xl p-3">Delete</th>
                    <th class="w-screen text-3xl p-3">Restore</th>
                    <th class="w-screen text-3xl p-3">Destroy</th>
                </tr>
            </thead>


            @forelse ($services as $service)
            <tr>
                <td class=" text-center text-3xl">
                    {{$service->id}}
                </td>
                <td class=" text-center text-3xl">
                    {{ $service->service_name }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $service->cost }}
                </td>
                <td class="pl-10">
                    <img src="{{ asset('pics/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
                </td>
            </tr>
            @empty
            <p>No service Data in the Database</p>
            @endforelse
        </table>
    </div>
    @endsection