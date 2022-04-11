@extends('layouts.app')

@section('content')

<div class="py-3">
    <table class="border-collapse shadow">
        <tr class="text-gray-50 text-center">
            <th class="w-screen text-3xl p-3">Transaction Id</th>
            <th class="w-screen text-3xl p-3">Animal Name</th>
            <th class="w-screen text-3xl p-3">Service Name</th>
            <th class="w-screen text-3xl p-3">Full Name</th>
            <th class="w-screen text-3xl p-3">Date</th>
        </tr>

        @forelse ($customers as $customer)
        <tr>
            <td class=" text-center text-3xl">
                {{ $customer->id }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->animal_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->service_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->full_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->date }}
            </td>
        </tr>
        @empty
        <p>No Transaction Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $customers->links( )}}</div>
</div>
</div>
@endsection
