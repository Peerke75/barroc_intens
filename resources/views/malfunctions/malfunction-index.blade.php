@extends('layouts.app')
<title> Barroc intens | Storing overzicht</title>
@section('content')





<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Storingen</h1>

    <table class="table-auto w-full bg-white border border-gray-300 rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Klant</th>
                <th class="px-4 py-2 border">datum storing</th>
                <th class="px-4 py-2 border">Meer info</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($malfunctions as $malfunction)

            <tr>
                <td class="px-4 py-2 border">{{ $malfunction->id }}</td>
                <td class="px-4 py-2 border">{{ $malfunction->customer->name }}</td>
                <td class="px-4 py-2 border">{{ $malfunction->date }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('malfunctions.malfunction-show', $malfunction->id) }}" class="text-blue-500">Meer info</a>
                </td>
            </tr>
            @if ($malfunction->status == 'open')
            <tr>
                <td colspan="6" class="px-4 py-2 border text-center">Geen storingen gevonden</td>
            </tr>
            @endif
            @endforeach


        </tbody>
    </table>
</div>
@endsection