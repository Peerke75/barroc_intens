@extends('layouts.app')

@section('title', 'Marketing Head Dashboard')

@section('content')
@if (session('error'))
    <div class="bg-red-400 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Marketing Head Dashboard</h1>
    <p>Welcome to the Marketing Head dashboard. Drive marketing strategy, lead campaigns, and manage brand performance.</p>
</div>
@endsection
