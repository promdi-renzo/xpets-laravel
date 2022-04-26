@extends('layouts.app')

@section('content')

<div class="pt-8 pb-4 px-8">
    <a href="service/create" class="text-red-600 p-3 italic bg-black text-lg">
        Add a new service &rarr;
    </a>
</div>

<div class="py-3">
    <table class="border-collapse shadow">
        <thead>
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">Service Name</th>
                <th class="w-screen text-3xl p-3">Cost</th>
                <th class="w-screen text-3xl p-3">Animal Pic</th>
                <th class="w-screen text-3xl p-3">Update</th>
                <th class="w-screen text-3xl p-3">Delete</th>
                <th class="w-screen text-3xl p-3">Restore</th>
                <th class="w-screen text-3xl p-3">Destroy</th>
            </tr>
        </thead>


        @forelse ($services as $service)
        <tr>
            @if($service->deleted_at)
            <td class="text-center text-3xl">
                <a href="#">{{$service->id}}</a>
            </td>
            @else
            <td class="text-center text-3xl">
                <a href="{{route('service.show',$service->id)}}">{{$service->id}}</a>
            </td>
            @endif
            </td>
            <td class=" text-center text-3xl">
                {{ $service->service_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->cost }}
            </td>
            <td class="pl-10">
                <img src="{{ asset('pics/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            @if($service->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-black p-2">
                        Update
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="service/{{ $service->id }}/edit" class="text-center text-2xl bg-black p-2">
                    Update
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('service.destroy', $service->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($service->deleted_at)
            <td>
                <a href="{{ route('service.restore', $service->id) }}">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif
            <td>
                <a href="{{ route('service.forceDelete', $service->id) }}">
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy &rarr;
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No service Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $services->links()}}</div>
</div>
</div>
@endsection