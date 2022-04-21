@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show pets
        </h1>
    </div>
    <div class="py-3">
        <table class="border-collapse shadow">
            <thead>
                <tr class="text-gray-50 text-center">
                    <th class="w-screen text-3xl p-3">Id</th>
                    <th class="w-screen text-3xl p-3">Pet Name</th>
                    <th class="w-screen text-3xl p-3">Sex</th>
                    <th class="w-screen text-3xl p-3">classification</th>
                    <th class="w-screen text-3xl p-3">Customer</th>
                    <th class="w-screen text-3xl p-3">Pictures</th>
                </tr>
            </thead>


            @forelse ($pets as $pet)
            <tr>
                <td class=" text-center text-3xl">
                    {{$pet->id}}
                </td>
                <td class=" text-center text-3xl">
                    {{ $pet->pet_name }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $pet->sex }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $pet->classification }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $pet->full_name }}
                </td>
                <td class="pl-10">
                    <img src="{{ asset('pics/pets/'.$pet->pictures)}}" alt="Picture" width="75" height="75">
                </td>
            </tr>
            @empty
            <p>No pets to be seen</p>
            @endforelse
        </table>
    </div>
    @endsection