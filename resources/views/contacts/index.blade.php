@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
  <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="py-3">
  <table class="border-collapse shadow text-center">
    <tr class="text-center">
      <th class="w-screen text-3xl p-3">Id</th>
      <th class="w-screen text-3xl p-3">Full Name</th>
      <th class="w-screen text-3xl p-3">Email</th>
      <th class="w-screen text-3xl p-3">Phone Number</th>
      <th class="w-screen text-3xl p-3">Service Type</th>
      <th class="w-screen text-3xl p-3">Review</th>
      <th class="w-screen text-3xl p-3">Delete</th>
      <th class="w-screen text-3xl p-3">Restore</th>
      <th class="w-screen text-3xl p-3">Destroy</th>
    </tr>

    @forelse ($contacts as $contact)

    <tr>
      <td class="text-white text-center text-2xl">
        <a href="{{route('contact.show',$contact->id)}}">{{$contact->id}}</a>
      </td>
      <td class="text-white text-center text-2xl">
        {{ $contact->name }}
      </td>
      <td class="text-white text-center text-2xl">
        {{ $contact->email }}
      </td>
      <td class="text-white text-center text-2xl">
        {{ $contact->phone_number }}
      </td>
      <td class="text-white text-center text-2xl">
        {{ $contact->service_name }}
      </td>
      <td class="text-white text-center text-2xl">
        {{ $contact->review }}
      </td>

      <td class="text-center">
        {!! Form::open(array('route' => array('contact.destroy', $contact->id),'method'=>'DELETE')) !!}
        <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded my-2">
          Delete &rarr;
        </button>
        {!! Form::close() !!}
      </td>

      @if($contact->deleted_at)
      <td>
        <a href="{{ route('contact.restore', $contact->id) }}">
          <p class="text-center text-lg bg-black text-red-600 p-2 rounded my-2">
            Restore &rarr;
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="#">
          <p class="text-center text-lg bg-black text-red-600 p-2 rounded my-2">
            Restore &rarr;
          </p>
        </a>
      </td>
      @endif

      <td>
        <a href="{{ route('contact.forceDelete', $contact->id) }}">
          <p class="text-center text-lg bg-black text-red-600 p-2 rounded"
            onclick="return confirm('Do you want to delete this data permanently?')">
            Destroy &rarr;
          </p>
        </a>
      </td>
    </tr>
    @empty
    <p>No Contact Data in the Database</p>
    @endforelse
  </table>
  <div class="pt-6 px-4">{{ $contacts->links( )}}</div>
</div>
</div>
@endsection
