<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4 text-center">{{ $message }}</strong>
</div>
@endif

<body  class="flex ">
        <a href="{{ URL('dashboard') }}">
                    <div class="flex font-bold text-2xl bg-white rounded-l-lg">
                        <h1 class="flex-auto p-2 font-bold bg-black border-black text-red-600 rounded-l-lg">XxXxX</h1>
                        <h1 class="flex-auto p-2 text-black bg-slate-100 rounded-r-lg">Pets</h1>
                    </div>
                </a>
        <section class="">

        @foreach ($pets->chunk(1) as $serviceChunk)
        <div
            class="max-w-sm bg-black text-red-500  ">
            @foreach ($serviceChunk as $pet)
            <img src="{{ asset('pics/pets/'.$pet->pictures)}}" alt="I am A Pic" width="400"
                style="">
            <div class="h-1">
                <h5 class="">{{ $pet->pet_name }}
                </h5>
                <p class="text-lg ">{{ $pet->classification }}</p>
                <div class="">
                    <a href=" {{ route('transaction.addPet', ['id'=>$pet->id]) }} " class="bg-black-500"
                        >Choose</a>

                </div>
            </div>
        </div>
        @endforeach
        @endforeach
    </section>
    <section class="flex flex-wrap gap-1 justify-center p-2 ">
        @foreach ($services->chunk(1) as $serviceChunk)
        <div
            class=" bg-black text-red-500 rounded-lg border  ">
            @foreach ($serviceChunk as $service)
            <img src="{{ asset('pics/services/'.$service->images)}}" alt="I am A Pic" width="400"
                style="">
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $service->service_name }}
                </h5>
                <p class="mb-2 text-lg font-bold">{{ $service->cost }}</p>
                <div class="">
                    <a href=" {{ route('transaction.addToCart', ['id'=>$service->id]) }} " class="bg-black text-red-500"
                        role="button"></i> Add Service </a>

                </div>
            </div>
        </div>
        @endforeach
        @endforeach
    </section>
</body>

</html>
