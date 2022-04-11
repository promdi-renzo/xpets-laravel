@extends('layouts.app')

@section('content')

<div class="pt-8 pb-4 px-8">
    <a href="pets/create" class="text-red-600 p-3 italic bg-black text-lg">
        Add a new animal
    </a>
</div>

<div class="py-3">
    <table class="border-collapse shadow">
        <thead >
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">Animal Name</th>
                <th class="w-screen text-3xl p-3">Age</th>
                <th class="w-screen text-3xl p-3">Gender</th>
                <th class="w-screen text-3xl p-3">Type of Animal</th>
                <th class="w-screen text-3xl p-3">Owner</th>
                <th class="w-screen text-3xl p-3">Animal Pic</th>
                <th class="w-screen text-3xl p-3">Update</th>
                <th class="w-screen text-3xl p-3">Delete</th>
                <th class="w-screen text-3xl p-3">Restore</th>
                <th class="w-screen text-3xl p-3">Destroy</th>
            </tr>
        </thead>


        @forelse ($pets as $animal)
        <tr>
            <td class=" text-center text-3xl">
                <a href="{{route('pets.show',$animal->id)}}">{{$animal->id}}</a>
            </td>
            <td class=" text-center text-3xl">
                {{ $animal->animal_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $animal->age }}
            </td>
            <td class=" text-center text-3xl">
                {{ $animal->gender }}
            </td>
            <td class=" text-center text-3xl">
                {{ $animal->type }}
            </td>
            <td class=" text-center text-3xl">
                {{ $animal->first_name }}
            </td>
            <td class="pl-10">
                <img src="{{ asset('uploads/pets/'.$animal->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            <td class=" text-center">
                <a href="pets/{{ $animal->id }}/edit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Update
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('pets.destroy', $animal->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Delete
                </button>
                {!! Form::close() !!}
            </td>
            @if($animal->deleted_at)
            <td>
                <a href="{{ route('pets.restore', $animal->id) }}">
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
                <a href="{{ route('pets.forceDelete', $animal->id) }}">
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
