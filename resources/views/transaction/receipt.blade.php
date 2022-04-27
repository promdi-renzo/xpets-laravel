<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="">
    <div class="pt-8 pb-4 px-8">
        <a href="dashboard" class="text-red-600 p-3 italic bg-black text-lg">
            Go Back &rarr;
        </a>
    </div>
    </div>

    <div class="p-4 w-full">

        <div class="py-20 h-screen bg-blue-400 px-2 bg-black text-red-600">
    <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
        <div class="md:flex">
            <div class="w-full p-3">
                <div class="border rounded-lg border-dashed py-5 border-3 bg-blue-600">
                    <div class="p-3">
                    <h1 class="text-center text-3xl pt-4">THANK YOU FOR SHOPPING</h1>
                    </div>
                    <div class="flex w-full mt-3 mb-3"> <span class="border border-dashed w-full border-white"></span> </div>
                    @forelse ($customers as $customer)
                    <div class="p-3 space-y-5">
                        <div class="flex flex-col"> <span class="bg-black text-red-600">Customer: </span> <span class="text-white text-lg font-bold">  {{ $customer->full_name }}</span> </div>
                        <div class="flex flex-col"> <span class="bg-black text-red-600">Pet: </span> <span class="text-white text-lg font-bold">  {{ $customer->pet_name }}</span> </div>
                        <div class="flex flex-col"> <span class="bg-black text-red-600">Service: </span> <span class="text-white text-lg font-bold"> {{ $customer->service_name }}</span> </div>
                        <div class="flex flex-col"> <span class="bg-black text-red-600">Cost: </span> <span class="text-white text-lg font-bold">  {{ $customer->cost }}</span> </div>

                    </div>
                    @empty
                    <p class="text-center text-4xl py-8">Receipt Is Empty</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

            </table>
        </div>
    </div>
</body>

</html>
