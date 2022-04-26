@extends('layouts.app')

@section('content')

<div class="pt-8 pb-4 px-8">
    <a href="comment/create" class="text-red-600 p-3 italic bg-black text-lg">
        Add a new comment &rarr;
    </a>
</div>

<div class="py-3">
    <table class="border-collapse shadow">
        <thead>
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-3xl p-3">Id</th>
                <th class="w-screen text-3xl p-3">Comment</th>
                <th class="w-screen text-3xl p-3">Service Name</th>
                <th class="w-screen text-3xl p-3">Customer Name</th>
            </tr>
        </thead>


        @forelse ($comments as $comment)
        <tr>

            <td class="text-center text-3xl">
                <a href="#">{{$comment->id}}</a>
            </td>
            <td class=" text-center text-3xl">
                {{ $comment->comment }}
            </td>
            <td class=" text-center text-3xl">
                {{ $comment->service_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $comment->full_name }}
            </td>
        </tr>
        @empty
        <p>No comment Data in the Database</p>
        @endforelse
    </table>

    <span class="flex justify-center pt-6">
        <form action="{{ url('results') }}" type="GET">
            <input type="result" name="result" id="result" class="text-center pb-1 px-2 w-full">
            <div class="grid w-full">
                <button class="text-center text-lg bg-black text-red-600 p-2 rounded">Search</button>
            </div>
    </span>
</div>
</div>
@endsection
