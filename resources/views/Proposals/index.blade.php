<!-- resources/views/proposals/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 rounded shadow-lg">
    <h1 class="text-4xl font-bold mb-6 text-black-600">Offertes</h1>

    <a href="{{ route('proposals.create') }}" class="bg-black text-yellow-500 px-4 py-2 rounded mb-6 inline-block">Nieuwe Offerte</a>

    <ul class="mt-6 divide-y divide-gray-300">
        @foreach ($proposals as $proposal)
            <li class="py-4 flex items-center justify-between">
                <a href="{{ route('proposals.show', $proposal) }}" class="text-lg font-semibold text-gray-800 hover:text-yellow-500">
                    Offerte #{{ $proposal->id }} - {{ $proposal->date->format('d-m-Y') }}
                </a>
                <a href="{{ route('proposals.show', $proposal) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                    Bekijk Offerte
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
