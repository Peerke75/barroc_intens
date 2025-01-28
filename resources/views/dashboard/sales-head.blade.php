@extends('layouts.app')
@section('content')
@if (session('error'))
    <div class="bg-red-400 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Head Salesman Dashboard</h1>
</div>
@endsection

