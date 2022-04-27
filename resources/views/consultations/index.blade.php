@extends('layouts.app')

@section('content')

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4">
    <strong class=" text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="pt-8 pb-4 px-8">
    <a href="consultation/create" class="text-red-600 p-3 italic bg-black text-lg">
        Add a new consultation
    </a>

</div>

<div class="py-3">
    <table class="border-collapse shadow">
        <thead>
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">Date</th>
                <th class="w-screen text-3xl p-3">disease or Injury</th>
                <th class="w-screen text-3xl p-3">price</th>
                <th class="w-screen text-3xl p-3">Comment</th>
                <th class="w-screen text-3xl p-3">Vet</th>
                <th class="w-screen text-3xl p-3">Animal</th>
                <th class="w-screen text-3xl p-3">Update</th>
                <th class="w-screen text-3xl p-3">Delete</th>
                <th class="w-screen text-3xl p-3">Restore</th>
            </tr>
        </thead>


        @forelse ($consultations as $consultation)
        <tr>
        @if($consultation->deleted_at)
      <td class="text-center text-3xl">
        <a href="#">{{$consultation->id}}</a>
      </td>
      @else
      <td class="text-center text-3xl">
        <a href="{{route('consultation.show',$consultation->id)}}">{{$consultation->id}}</a>
      </td>
      @endif
      </td>

            <td class=" text-center text-2xl">
                {{ $consultation->date }}
            </td>
            <td class=" text-center text-2xl">
                {{ $consultation->disease_injury }}
            </td>
            <td class=" text-center text-2xl">
                {{ $consultation->price }}
            </td>
            <td class=" text-center text-2xl">
                {{ $consultation->comment }}
            </td>
            <td class=" text-center text-2xl">
                {{ $consultation->full_name }}
            </td>
            <td class=" text-center text-2xl">
                {{ $consultation->pet_name }}
            </td>
            @if($consultation->deleted_at)
      <td class=" text-center">
        <a href="#">
          <p class="text-center text-lg bg-black text-red-600 p-2 rounded">
            Update
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="consultation/{{ $consultation->id }}/edit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
          Update
        </a>
      </td>
      @endif
            <td class="text-center">
                {!! Form::open(array('route' => array('consultation.destroy', $consultation->id),'method'=>'DELETE'))
                !!}
                <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Delete
                </button>
                {!! Form::close() !!}
            </td>
            @if($consultation->deleted_at)
            <td>
                <a href="{{ route('consultation.restore', $consultation->id) }}">
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
        <p>No Consultation Data in the Database</p>
        @endforelse
    </table>

    <span class="flex justify-center pt-6">
        <form action="{{ url('results') }}" type="GET">
            <input type="result" name="result" id="result" class="text-center pb-1 px-2 w-full">
            <div class="grid w-full">
                <button class="text-center text-lg bg-black text-red-600 p-2 rounded">Search</button>
            </div>
    </span>

    <div class="pt-6 px-4">{{ $consultations->links( )}}</div>
</div>
</div>
@endsection
