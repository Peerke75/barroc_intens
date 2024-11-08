@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Auth;
?>
<title> Barroc Intens | Dashboard</title>
@section('content')

<div class="bg-white text-black">

    <!-- Sidebar -->
    <div class="flex">
        <div class="w-1/6 bg-gray-800 text-white h-screen p-4">
            <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
            <ul>
                <li class="mb-2">Voorraad</li>
                <li class="mb-2">Offertes</li>
                <li class="mb-2">Facturen</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-5/6 p-4">
            <div class="flex justify-end items-center mb-4">
                <?php
                $user = Auth::user();
                ?>
                <div class="bg-gray-200 p-2 rounded">Logged in as: {{ $user->name }} (Function ID: {{ $user->function_id }})</div>
            </div>

            <!-- overzicht en planning -->
            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                <h2 class="text-xl font-semibold mb-2">Overzicht / Planning</h2>
                <div id='calendar'></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <!-- To-Do List -->
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-2">To-Do</h2>
                    <ul class="space-y-2">
                        <li class="bg-white p-2 rounded shadow">Task 1</li>
                        <li class="bg-white p-2 rounded shadow">Task 2</li>
                        <li class="bg-white p-2 rounded shadow">Task 3</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection