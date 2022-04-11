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
                @foreach($pets as $animal)
                @foreach($services as $service)
                <li>
                    <span class="pr-6">{{ $animal['name'] }}</span>
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
    <div class="row">
        <div>
            <strong>Total: {{ $totalCost }}</strong>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <a href="{{route ('checkout')}}"> <button type="button" class="btn btn-success">Checkout</button><a>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <h2>No Items in Cart!</h2>
        </div>
    </div>
</div>
@endif
@endsection
