@extends('layouts.app')
<title> Barroc intens | Storing overzicht</title>
@section('content')
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Succes!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                </svg>
            </span>
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                </svg>
            </span>
        </div>
    @endif

    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold mb-5">Storingen</h1>
        <div class="flex justify-between items-center mb-5 flex-col sm:flex-row">
            <a href="{{ route('storingen.create') }}" class="btn btn-primary w-full sm:w-auto mb-3 sm:mb-0">Nieuwe storing</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Klant</th>
                        <th class="px-4 py-2 border">datum storing</th>
                        <th class="px-4 py-2 border">status</th>
                        <th class="px-4 py-2 border">Meer info</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($malfunctions->isEmpty())
                        <tr>
                            <td class="px-4 py-2 border" colspan="5">Er zijn geen storingen gevonden.</td>
                        </tr>
                    @endif
                    @foreach ($malfunctions as $malfunction)
                        <tr>
                            <td class="px-4 py-2 border">{{ $malfunction->id }}</td>
                            <td class="px-4 py-2 border">{{ $malfunction->customer->name }}</td>
                            <td class="px-4 py-2 border">{{ $malfunction->date }}</td>
                            <td class="px-4 py-2 border">{{ $malfunction->status }}</td>
                            <td class="px-4 py-2 border">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('storingen.show', $malfunction->id) }}" class="btn btn-info w-full sm:w-auto">Bekijk</a>
                                    <a href="{{ route('storingen.edit', $malfunction->id) }}" class="btn btn-warning w-full sm:w-auto">Bewerken</a>
                                    <form action="{{ route('storingen.destroy', $malfunction->id) }}" method="POST" class="inline w-full sm:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-full sm:w-auto">Verwijderen</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
