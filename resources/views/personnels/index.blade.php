@extends('layouts.app')

@section('content')

<div class="py-3">
    <table class="border-collapse shadow">
        <thead>
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">Full Name</th>
                <th class="w-screen text-3xl p-3">Email</th>
                <th class="w-screen text-3xl p-3">Position</th>
                <th class="w-screen text-3xl p-3">Update</th>
                <th class="w-screen text-3xl p-3">Delete</th>
                <th class="w-screen text-3xl p-3">Restore</th>
                <th class="w-screen text-3xl p-3">Destroy</th>
            </tr>
        </thead>


        @forelse ($personnels as $personnel)
        <tr>
            <td class="text-center text-3xl">
                <a href="{{route('personnel.show',$personnel->id)}}">{{$personnel->id}}</a>
            </td>
            <td class="text-center text-3xl">
                {{ $personnel->full_name }}
            </td>
            <td class="text-center text-3xl">
                {{ $personnel->email }}
            </td>
            <td class="text-center text-3xl">
                {{ $personnel->role }}
            </td>
            <td class=" text-center">
                <a href="personnel/{{ $personnel->id }}/edit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Update
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('personnel.destroy', $personnel->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Delete
                </button>
                {!! Form::close() !!}
            </td>
            @if($personnel->deleted_at)
            <td>
                <a href="{{ route('personnel.restore', $personnel->id) }}">
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
                <a href="{{ route('personnel.forceDelete', $personnel->id) }}">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No Personnel Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $personnels->links()}}</div>
</div>
</div>
@endsection
