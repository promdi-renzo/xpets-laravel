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
        <th class="w-screen text-3xl p-3">Full Name</th>
        <th class="w-screen text-3xl p-3">Number</th>
        <th class="w-screen text-3xl p-3">Picture</th>
        <th class="w-screen text-3xl p-3">Pet</th>
        <th class="w-screen text-3xl p-3">Actions</th>
      </tr>
    </thead>


    @forelse ($customers as $customer)

    <tr>
      @if($customer->deleted_at)
      <td class="text-center text-3xl">
        <a href="#">{{$customer->id}}</a>
      </td>
      @else
      <td class="text-center text-3xl">
        <a href="{{route('customer.show',$customer->id)}}">{{$customer->id}}</a>
      </td>
      @endif
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
      @if($customer->deleted_at)
      <td class=" text-center">
        <a href="#">
          <p class="text-center text-lg bg-black text-red-600 p-2 rounded">
            Update
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="customer/{{ $customer->id }}/edit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
          Update
        </a>
      </td>
      @endif
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
    </tr>
    @empty
    <p>No Data in the Database</p>
    @endforelse
  </table>

  <div class="pt-6 px-4">{{ $customers->links( )}}</div>

</div>
</div>
@endsection
