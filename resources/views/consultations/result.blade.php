<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Search Pets</title>
</head>

<body
    style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    <div class="py-3">
        <h1 class="text-center text-blue-600 text-3xl font-bold py-6">CONSULTATION HISTORY</h1>
        <hr>
        <table class="border-collapse shadow">
            <tr class="text-gray-50 text-center">
                <th class="w-screen text-4xl">Animal</th>
                <th class="w-screen text-4xl">Date</th>
                <th class="w-screen text-4xl">Disease or Injury</th>
                <th class="w-screen text-4xl">Vet</th>
            </tr>
            @forelse ($consultations as $consultation)
            <tr>
                <td class=" text-center text-4xl">
                    {{ $consultation->pet_name }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $consultation->date }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $consultation->disease_injury }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $consultation->full_name }}
                </td>
                @empty
                <p class="text-center text-4xl py-8">The Animal You Search Is Not In The Database.</p>
                @endforelse
        </table>
    </div>
    </tr>
    <hr>
    <h1 class="text-center text-5xl py-8 text-red-600">Thank you for Choosing ACME Pet Clinic</h1>
    <div class="flex justify-end">
        <a href="{{url()->previous()}}" class="bg-gray-800 text-white text-2xl font-bold p-2 mr-10 text-center"
            role="button">Go Back &rarr;</a>
    </div>
</body>

</html>
