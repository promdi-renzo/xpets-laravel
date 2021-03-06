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
                    <p class="text-center text-lg bg-black text-red-600 p-2 rounded">
                        Update
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="service/{{ $service->id }}/edit" class="text-center text-lg bg-black text-red-600 p-2 rounded">
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

        </tr>
        @empty
        <p>No service Data in the Database</p>
        @endforelse
    </table>

    <span class="flex justify-center pt-6">
        <form action="{{ url('results') }}" type="GET">
            <input type="result" name="result" id="result" class="text-center pb-1 px-2 w-full">
            <div class="grid w-full">
                <button class="text-center text-lg bg-black text-red-600 p-2 rounded">Search</button>
            </div>
    </span>
    <div class="pt-6 px-4">{{ $services->links()}}</div>
</div>
</div>
@endsection
