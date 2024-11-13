@extends('layouts.app')
<title> Barroc intens | Storing overzicht</title>
@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Storingen</h1>


    <div class="flex justify-end mb-5">
        <a href="{{ route('storingen.create') }}" class="btn btn-primary">Nieuwe storing aanmaken</a>
    </div>
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
                    <a href="{{ route('storingen.show', $malfunction->id) }}" class="btn btn-info">Bekijk</a>
                    <a href="{{ route('storingen.edit', $malfunction->id) }}" class="btn btn-warning">Bewerk</a>
                    <form action="{{ route('storingen.destroy', $malfunction->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Verwijder</button>
                    </form>
                </td>
            </tr>
            @if ($malfunction->status == 'Closed')
            <tr>
                <td colspan="6" class="px-4 py-2 border text-center">Geen storingen gevonden</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection