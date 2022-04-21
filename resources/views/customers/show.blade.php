@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Customer
        </h1>
    </div>
    <div>
        <div class="py-3">
            <table class="border-collapse shadow">
                <thead>
                    <tr class="text-gray-50 text-center">
                        <th class="w-screen text-3xl p-3">Id</th>
                        <th class="w-screen text-3xl p-3">Full Name</th>
                        <th class="w-screen text-3xl p-3">Number</th>
                        <th class="w-screen text-3xl p-3">Picture</th>
                        <th class="w-screen text-3xl p-3">Pet</th>
                        <th class="w-screen text-3xl p-3">Actions</th>
                    </tr>
                </thead>


                @forelse ($customers as $customer)

                <tr>
                    <td class="text-center text-3xl">
                        {{$customer->id}}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $customer->full_name }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $customer->number }}
                    </td>
                    <td class="pl-12">
                        <img src="{{ asset('pics/customers/'.$customer->pictures)}}" alt="Pic" width="75" height="75">
                    </td>
                    <td class=" text-center text-3xl">
                        {{ $customer->pet_name }}
                    </td>
                </tr>
                @empty
                <p>No Data in the Database</p>
                @endforelse
                @endsection
            </table>
        </div>
    </div>
    @endsection