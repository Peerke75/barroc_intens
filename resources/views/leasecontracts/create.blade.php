@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mt-3 mb-6">Nieuw Leasecontract</h1>
    <form action="{{ route('leasecontracts.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Klant</label>
                <select name="customer_id" id="customer_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>Selecteer een klant</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ isset($leaseContract) && $leaseContract->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Gebruiker</label>
                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>Selecteer een gebruiker</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ isset($leaseContract) && $leaseContract->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Startdatum</label>
                <input type="date" name="start_date" id="start_date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('start_date', $leaseContract->start_date ?? '') }}" required>
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Einddatum</label>
                <input type="date" name="end_date" id="end_date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('end_date', $leaseContract->end_date ?? '') }}" required>
            </div>

            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Betaalmethode</label>
                <select name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="creditcard" {{ (isset($leaseContract) && $leaseContract->payment_method === 'creditcard') ? 'selected' : '' }}>Creditcard</option>
                    <option value="bank_transfer" {{ (isset($leaseContract) && $leaseContract->payment_method === 'bank_transfer') ? 'selected' : '' }}>Bankoverschrijving</option>
                    <option value="paypal" {{ (isset($leaseContract) && $leaseContract->payment_method === 'paypal') ? 'selected' : '' }}>PayPal</option>
                    <option value="cash" {{ (isset($leaseContract) && $leaseContract->payment_method === 'cash') ? 'selected' : '' }}>Contant</option>
                </select>
            </div>

            <div>
                <label for="machine_amount" class="block text-sm font-medium text-gray-700">Aantal machines</label>
                <input type="number" name="machine_amount" id="machine_amount"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('machine_amount', $leaseContract->machine_amount ?? '') }}" min="1" required>
            </div>

            <div>
                <label for="notice_period" class="block text-sm font-medium text-gray-700">Betaal termijn</label>
                <select name="notice_period" id="notice_period" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="maandelijks" {{ (isset($leaseContract) && $leaseContract->notice_period === 'maandelijks') ? 'selected' : '' }}>Maandelijks</option>
                    <option value="per kwartaal" {{ (isset($leaseContract) && $leaseContract->notice_period === 'per kwartaal') ? 'selected' : '' }}>Per kwartaal</option>
                    <option value="per jaar" {{ (isset($leaseContract) && $leaseContract->notice_period === 'per jaar') ? 'selected' : '' }}>Per jaar</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required @readonly(true)>
                    <option value="pending" {{ (isset($leaseContract) && $leaseContract->status === 'pending') ? 'selected' : '' }}>In afwachting</option>
                    <option value="active" {{ (isset($leaseContract) && $leaseContract->status === 'active') ? 'selected' : '' }}>Actief</option>
                    <option value="terminated" {{ (isset($leaseContract) && $leaseContract->status === 'terminated') ? 'selected' : '' }}>Beëindigd</option>
                    <option value="completed" {{ (isset($leaseContract) && $leaseContract->status === 'completed') ? 'selected' : '' }}>Voltooid</option>
                </select>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Machines Toevoegen</h2>
            <div id="price-lines" class="price-lines space-y-4">
                <div class="price-line grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700">Machine</label>
                        <select name="machine_id[]" class="machine-selector block w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500" required>
                            <option value="">-- Selecteer een machine --</option>
                            @foreach ($machines as $machine)
                                <option value="{{ $machine->id }}" data-price="{{ $machine->price }}">{{ $machine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700">Prijs</label>
                        <input type="number" name="price[]" class="price-input w-full p-3 border rounded-lg bg-gray-200 focus:ring-yellow-500 focus:border-yellow-500" readonly required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700">Aantal</label>
                        <input type="number" name="amount[]" class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="button" id="add-line-btn" class="flex items-center text-green-600 hover:text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Machine toevoegen
                </button>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                Opslaan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-line-btn').addEventListener('click', function() {
        const container = document.getElementById('price-lines');
        const lineDiv = document.createElement('div');
        lineDiv.classList.add('price-line', 'grid', 'grid-cols-1', 'md:grid-cols-3', 'gap-4', 'mt-4');
        lineDiv.innerHTML = `
            <div>
                <label class="block font-semibold text-gray-700">Machine</label>
                <select name="machine_id[]" class="machine-selector block w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500" required>
                    <option value="">-- Selecteer een Machine --</option>
                    @foreach ($machines as $machine)
                        <option value="{{ $machine->id }}" data-price="{{ $machine->price }}">{{ $machine->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-semibold text-gray-700">Prijs</label>
                <input type="number" name="price[]" class="price-input w-full p-3 border rounded-lg bg-gray-200 focus:ring-yellow-500 focus:border-yellow-500" readonly required>
            </div>
            <div>
                <label class="block font-semibold text-gray-700">Aantal</label>
                <input type="number" name="amount[]" class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
        `;
        container.appendChild(lineDiv);

        lineDiv.querySelector('.machine-selector').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const priceInput = this.closest('.price-line').querySelector('.price-input');
            priceInput.value = price || '';
        });
    });

    document.querySelectorAll('.machine-selector').forEach(select => {
        select.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const priceInput = this.closest('.price-line').querySelector('.price-input');
            priceInput.value = price || '';
        });
    });
</script>
@endsection
