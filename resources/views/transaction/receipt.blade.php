<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)),
    url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    <div class="pt-8 pb-4 px-8">
        <a href="{{url()->previous()}}" class="text-red-600 p-3 italic bg-black text-lg">
            Go Back &rarr;
        </a>
    </div>
    </div>
    <h1 class="text-center text-white text-3xl pt-4">RECEIPT</h1>
    <div class="flex justify-center p-4 w-full">
        @forelse ($customers as $customer)
        <div class="grid grid-flow-row justify-center border-b border-gray-200 shadow">
            <table>
                <thead class="bg-gray-50">
                    <tr>

                        <th class="text-center px-4 py-2 text-xs text-gray-500 ">
                            Customer
                        </th>
                        <th class="text-center px-4 py-2 text-xs text-gray-500 ">
                            Animal
                        </th>
                        <th class="text-center px-4 py-2 text-xs text-gray-500 ">
                            Service
                        </th>
                        <th class="text-center px-4 py-2 text-xs text-gray-500 ">
                            Cost
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="whitespace-nowrap">

                        <td class="text-center px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $customer->full_name }}
                            </div>
                        </td>
                        <td class="text-center px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $customer->pet_name }}
                            </div>
                        </td>
                        <td class="text-center px-6 py-4">
                            {{ $customer->service_name }}
                        </td>
                        <td class="text-center px-6 py-4 text-sm text-gray-500">
                            {{ $customer->cost }}
                        </td>
                    </tr>
                    @empty
                    <p class="text-center text-4xl py-8">Receipt Is Empty</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
