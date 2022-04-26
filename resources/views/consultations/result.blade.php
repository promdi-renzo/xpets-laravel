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
    >
    <div class="py-3">
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
    <div class="flex justify-end">
        <a href="{{url()->previous()}}" class="text-red-600 p-3 italic bg-black text-lg"
            role="button">Go Back &rarr;</a>
    </div>
</body>

</html>
