@extends('layouts.app')

@section('content')

<div class="pt-8 pb-4 px-8">
  <a href="customer/create" class="text-red-600 p-3 italic bg-black text-lg">
    Add a new customer
  </a>
</div>

<div class="py-3">
  <table class="border-collapse shadow">
      <thead>
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">First Name</th>
                <th class="w-screen text-3xl p-3">Last Name</th>
                <th class="w-screen text-3xl p-3">Phone Number</th>
                <th class="w-screen text-3xl p-3">Customer Pic</th>
                <th class="w-screen text-3xl p-3">Animal</th>
                <th class="w-screen text-3xl p-3">Update</th>
                <th class="w-screen text-3xl p-3">Delete</th>
                <th class="w-screen text-3xl p-3">Restore</th>
                <th class="w-screen text-3xl p-3">Destroy</th>
            </tr>
        </thead>


    @forelse ($customers as $customer)

    <tr>
      <td class="text-center text-3xl">
        <a href="{{route('customer.show',$customer->id)}}">{{$customer->id}}</a>
      </td>
      <td class="text-center text-3xl">
        {{ $customer->first_name }}
      </td>
      <td class="text-center text-3xl">
        {{ $customer->last_name }}
      </td>
      <td class="text-center text-3xl">
        {{ $customer->phone_number }}
      </td>
      <td class="pl-12">
        <img src="{{ asset('uploads/customers/'.$customer->images)}}" alt="I am A Pic" width="75" height="75">
      </td>
      <td class=" text-center text-3xl">
        {{ $customer->animal_name }}
      </td>
      <td class=" text-center">
        <a href="customer/{{ $customer->id }}/edit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
          Update
        </a>
      </td>
      <td class=" text-center">
        {!! Form::open(array('route' => array('customer.destroy', $customer->id),'method'=>'DELETE')) !!}
        <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
          Delete
        </button>
        {!! Form::close() !!}
      </td>

      @if($customer->deleted_at)
      <td>
        <a href="{{ route('customer.restore', $customer->id) }}">
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
        <a href="{{ route('customer.forceDelete', $customer->id) }}">
          <p class="text-center text-lg bg-black text-red-600 p-2 rounded"
            onclick="return confirm('Do you want to delete this data permanently?')">
            Destroy
          </p>
        </a>
      </td>
    </tr>
    @empty
    <p>No customer Data in the Database</p>
    @endforelse
  </table>

  <div class="pt-6 px-4">{{ $customers->links( )}}</div>

  <span class="flex justify-center pt-6">
    <form action="{{ url('result') }}" type="GET">
      <input type="result" name="result" id="result" class="text-center pb-1 px-2 w-full">
      <div class="grid w-full">
        <button class="text-center text-lg bg-black text-red-600 p-2 rounded">Search</button>
      </div>
  </span>
</div>
</div>
@endsection
