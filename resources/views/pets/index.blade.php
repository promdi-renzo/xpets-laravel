@extends('layouts.app')

@section('content')

<div class="pt-8 pb-4 px-8">
    <a href="pets/create" class="text-red-600 p-3 italic bg-black text-lg">
        Add a new pet
    </a>
</div>

<div class="py-3">
    <table class="border-collapse shadow">
        <thead >
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">Pet Name</th>
                <th class="w-screen text-3xl p-3">Sex</th>
                <th class="w-screen text-3xl p-3">classification</th>
                <th class="w-screen text-3xl p-3">Customer</th>
                <th class="w-screen text-3xl p-3">Pictures</th>
                <th class="w-screen text-3xl p-3">Actions</th>
            </tr>
        </thead>


        @forelse ($pets as $pet)
        <tr>
            <td class=" text-center text-3xl">
                <a href="{{route('pets.show',$pet->id)}}">{{$pet->id}}</a>
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
                <img src="{{ asset('pictures/pets/'.$pet->images)}}" alt="Picture" width="75" height="75">
            </td>
            <td class=" text-center">
                <a href="pets/{{ $pet->id }}/edit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Update
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('pets.destroy', $pet->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Delete
                </button>
                {!! Form::close() !!}
            </td>
            @if($pet->deleted_at)
            <td>
                <a href="{{ route('pets.restore', $pet->id) }}">
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
                <a href="{{ route('pets.forceDelete', $pet->id) }}">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy
                    </p>
                </a>
            </td>
        </tr>
        @empty
            <p>No pets to be seen</p>
        @endforelse
    </table>

    <div class="pt-6 px-4">{{ $pets->links( )}}</div>
</div>

</div>
@endsection
