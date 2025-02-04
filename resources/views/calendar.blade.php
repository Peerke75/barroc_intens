@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/calendar.js'])

@section('content')
<div class="container mx-auto px-4">

    <div class="py-4 mb-4 text-center">
        <button id="addEventButton" class="bg-green-500 text-white px-4 py-2 rounded w-full sm:w-auto">
            Afspraak toevoegen
        </button>
    </div>

    <div id="calendar"></div>
</div>

<div id="eventModal" style="z-index: 1000;" class="modal hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
    <div class="modal-content bg-white p-6 rounded-lg w-full sm:w-1/3">
        <h2 id="modalTitle" class="text-xl font-semibold mb-4 text-center">Afspraak toevoegen</h2>
        <form id="eventForm">
            <div class="mb-4">
                <label for="eventName" class="block font-semibold">Title: </label>
                <input type="text" id="eventName" class="w-full border border-gray-300 rounded p-2" required />
            </div>
            <div class="mb-4">
                <label for="eventCustomer" class="block font-semibold">Klant (optioneel): </label>
                <select id="eventCustomer" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="">Selecteer een klant</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="eventStartTime" class="block font-semibold">Starttijd: </label>
                <input type="datetime-local" id="eventStartTime" class="w-full border border-gray-300 rounded p-2" required />
            </div>
            <div class="mb-4">
                <label for="eventEndTime" class="block font-semibold">Eindtijd: </label>
                <input type="datetime-local" id="eventEndTime" class="w-full border border-gray-300 rounded p-2" />
            </div>
            <div class="mb-4">
                <label for="eventDescription" class="block font-semibold">Omschrijving: </label>
                <textarea id="eventDescription" class="w-full border border-gray-300 rounded p-2"></textarea>
            </div>
            <div class="flex justify-end space-x-2 flex-wrap">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto">Save</button>
                <button type="button" id="deleteEventButton" class="bg-red-500 text-white px-4 py-2 rounded w-full sm:w-auto">Delete</button>
                <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded w-full sm:w-auto">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection
