@extends('layouts.app')

@section('title', 'Sales Dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Sales Dashboard</h1>
    <p>Welcome to the Sales dashboard. Review sales data, analyze performance, and view sales metrics here.</p>
    <a href="{{route('dashboard.sales.export') }}" class="inline-block px-4 py-2 bg-green-800 text-white text-sm font-medium rounded hover:bg-green-600 active:bg-green-700 transition duration-200">
        Export Excel
    </a>
</div>
@endsection
