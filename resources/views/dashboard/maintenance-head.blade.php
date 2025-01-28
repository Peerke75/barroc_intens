@extends('layouts.app')

@section('title', 'Maintenance Head Dashboard')

@section('content')
@if (session('error'))
    <div class="bg-red-400 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Maintenance Head Dashboard</h1>
    <p>Welcome to the Maintenance Head dashboard. Supervise all maintenance operations and team scheduling.</p>
</div>
@endsection
