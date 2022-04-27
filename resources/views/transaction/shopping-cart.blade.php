@extends('layouts.app')

@section('content')

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

@if(Session::has('cart'))
<div class="grid justify-center gap-3 w-full">
    <div class="row">
        <div>
            <ul>
                @foreach($pets as $pet)
                @foreach($services as $service)
                <li>
                    <span class="pr-6">{{ $pet['pet_name'] }}</span>
                    <span class="pr-6">{{ $service['cost'] }}</span>
                    <div class="btn-group">
                        <a class="btn btn-danger my-2 py-2"
                            href="{{ route('transaction.remove',['id'=>$service['services']['id']]) }}">Remove</a>
                    </div>
                </li>
                @endforeach
                @endforeach
            </ul>
        </div>
    </div>

    <strong>Total: {{ $totalCost }}</strong>
    <a href="{{route ('checkout')}}"> <button class="p-2 bg-black text-red-600">Checkout</button><a>

    @else
<h2>No Items in Cart!</h2>

</div>
@endif
@endsection
