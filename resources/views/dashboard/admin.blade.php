@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
@if (session('error'))
    <div class="bg-red-400 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
    <p>Welcome to the Admin dashboard. Here you can manage all users, settings, and reports.</p>
</div>
@endsection
