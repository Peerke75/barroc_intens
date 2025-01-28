@extends('layouts.app')

@section('title', 'Marketing Head Dashboard')

@section('content')
@if (session('error'))
    <div class="bg-red-400 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Stock Head Dashboard</h1>
    <p>Welcome to the Stock Head dashboard. Drive stock strategy, lead campaigns, and manage brand performance.</p>
</div>
@endsection
