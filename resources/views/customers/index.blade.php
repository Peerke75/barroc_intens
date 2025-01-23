@extends('layouts.app')
<title>Barroc Intens | Klanten Overzicht</title>

@section('content')
    <div class="flex h-screen bg-gray-50">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-2 rounded mb-4 shadow-lg mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <div class="w-1/4 bg-white overflow-y-auto p-4 border-r border-gray-200 shadow-lg">
            <div class="my-4 text-center">
                <a href="{{ route('customers.create') }}"
                    class="inline-block bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 shadow-md transition-transform transform hover:scale-105">
                    Voeg Klant Toe
                </a>
            </div>
            <ul class="space-y-3">
                @foreach ($customers as $customer)
                    <li>
                        <button
                            class="w-full text-left bg-gray-200 text-gray-800 font-medium py-3 px-4 rounded-lg shadow-sm hover:bg-gray-300 hover:shadow-md transition-transform transform hover:scale-105 focus:outline-none"
                            onclick="showCustomerDetails({{ $customer->id }})">
                            {{ $loop->iteration }}. {{ $customer->name }} 
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-1/2 p-8 bg-gray-50 shadow-lg" id="customer-details">
            <div class="flex flex-col items-center justify-center h-full text-center space-y-4 text-gray-400">
                <p class="text-xl font-semibold">Selecteer een klant voor meer details</p>
            </div>
        </div>

        <div class="w-1/2 bg-gray-900 text-white p-8 shadow-lg" id="invoice-placeholder">
            <p class="text-gray-400 text-center italic">Factuur komt hier terecht</p>
        </div>
    </div>

    <script>
        let customers = @json($customers);

        function showCustomerDetails(customerId) {
            let customer = customers.find(c => c.id === customerId);
            if (customer) {
                let paymentStatusClass = '';
                let paymentStatusText = '';

                switch (customerId) {
                    case 1:
                        paymentStatusClass = 'bg-green-500';
                        paymentStatusText = 'Paid';
                        break;
                    case 2:
                        paymentStatusClass = 'bg-yellow-500';
                        paymentStatusText = 'Pending';
                        break;
                    case 3:
                        paymentStatusClass = 'bg-red-500';
                        paymentStatusText = 'Overdue';
                        break;
                    default:
                        paymentStatusClass = 'bg-gray-500';
                        paymentStatusText = 'Unknown';
                }

                const detailsSection = `
                <div class="p-6 bg-white rounded-lg shadow-md border border-gray-200 space-y-6">
                    <h3 class="text-3xl font-bold text-gray-800 border-b border-gray-300 pb-4">${customer.name}</h3>
                    <div class="text-lg space-y-2">
                        <p><span class="font-semibold text-gray-700">Bedrijf:</span> ${customer.company_name}</p>
                        <p><span class="font-semibold text-gray-700">Email:</span> <a href="mailto:${customer.mail}" class="text-blue-500 underline">${customer.mail}</a></p>
                        <p><span class="font-semibold text-gray-700">Status:</span> ${customer.order_status}</p>
                        <p>
                            <span class="font-semibold text-gray-700">BKR Check:</span>
                            <span class="${customer['BKR-check'] ? 'text-green-500' : 'text-red-500'}">
                                ${customer['BKR-check'] ? 'Geslaagd' : 'Niet geslaagd'}
                            </span>
                        </p>
                    </div>
                    <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                        <span class="text-lg font-semibold">Betalingsstatus:</span>
                        <span class="px-4 py-2 rounded-lg text-white ${paymentStatusClass}">
                            ${paymentStatusText}
                        </span>
                    </div>
                    <div class="text-center">
                        <a href="/customers/${customerId}/invoice/create"
                        class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-600 transition-transform transform hover:scale-105">
                            Factuur aanmaken
                        </a>
                    </div>
                </div>
            `;

                document.getElementById('customer-details').innerHTML = detailsSection;

                let invoiceSection = '';
                if (customer.invoices.length > 0) {
                    let invoice = customer.invoices[0];
                    invoiceSection = `
                        <div class="space-y-6">
                            <h2 class="text-3xl font-extrabold text-yellow-400 border-b border-yellow-500 pb-2">Factuur Details</h2>
                            <div class="space-y-2">
                                <p class="text-lg"><strong>Klant:</strong> ${customer.name}</p>
                                <p class="text-lg"><strong>Factuurnummer:</strong> ${invoice.number}</p>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse border border-gray-700">
                                    <thead class="bg-gray-800 text-white">
                                        <tr>
                                            <th class="py-3 px-4 border-b border-gray-700 text-left">Aantal</th>
                                            <th class="py-3 px-4 border-b border-gray-700 text-left">Nummer</th>
                                            <th class="py-3 px-4 border-b border-gray-700 text-left">Omschrijving</th>
                                            <th class="py-3 px-4 border-b border-gray-700 text-left">Prijs (€)</th>
                                            <th class="py-3 px-4 border-b border-gray-700 text-left">Subtotaal (€)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-700 text-white">
                                        <tr class="hover:bg-gray-600 transition">
                                            <td class="py-3 px-4">${invoice.quantity}x</td>
                                            <td class="py-3 px-4">${invoice.number}</td>
                                            <td class="py-3 px-4">${invoice.description}</td>
                                            <td class="py-3 px-4">€${invoice.price}</td>
                                            <td class="py-3 px-4 font-semibold">€${invoice.total}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right mt-6">
                                <p class="text-xl font-bold text-yellow-400">Totaal: €${invoice.total}</p>
                            </div>

                            <div class="mt-6 text-center">
                                <a href="/customers/downloadPdf/${customer.id}"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    `;
                } else {
                    invoiceSection = `
                        <div class="flex flex-col items-center justify-center h-full text-center space-y-4">
                            <p class="text-xl font-semibold text-gray-400">Geen factuur beschikbaar</p>
                            <p class="text-gray-500">Selecteer een klant met een factuur of maak een nieuwe aan.</p>
                        </div>
                    `;
                }

                document.getElementById('invoice-placeholder').innerHTML = invoiceSection;
            }
        }
    </script>
@endsection
