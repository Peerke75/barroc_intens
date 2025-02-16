@extends('layouts.app')
<title>Barroc Intens | Klanten Overzicht</title>

@section('content')
    <div class="flex flex-col md:flex-row md:h-screen bg-gray-50">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4 " role="alert">
                <strong class="font-bold">Succes!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                    </svg>
                </span>
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                    </svg>
                </span>
            </div>
        @endif

        <div class="w-full md:w-1/4 bg-white overflow-y-auto p-4 border-b md:border-r border-gray-200 shadow-lg" id="customer-list">
            <div class="my-4 text-center">
                <a href="{{ route('customers.create') }}"
                    class="inline-block bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 shadow-md transition-transform transform hover:scale-105">
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

        <div class="w-full md:w-1/2 p-8 bg-gray-50 shadow-lg" id="customer-details">
            <div class="flex flex-col items-center justify-center h-full text-center space-y-4 text-gray-400">
                <p class="text-xl font-semibold">Selecteer een klant voor meer details</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-gray-900 text-white p-8 shadow-lg" id="invoice-placeholder">
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

    <!-- Mobile responsive styling -->
    <style>
        @media (max-width: 768px) {
            .flex {
                flex-direction: column !important; /* Stack the columns vertically on mobile */
            }

            #customer-details, #invoice-placeholder {
                width: 100% !important; /* Full width for mobile layout */
                padding: 1rem; /* Add padding for better spacing */
            }

            /* Customer list adjustments for mobile */
            #customer-list {
                max-height: 350px; /* Limit the height of the customer list */
                overflow-y: auto; /* Make the list scrollable */
            }

            /* Adjust the text sizes for mobile */
            #customer-details p, #invoice-placeholder p {
                font-size: 1rem;
            }

            /* Ensure padding and margin is correct */
            .space-y-3 {
                margin-bottom: 1rem;
            }

            .space-y-4 {
                margin-bottom: 1rem;
            }
        }
    </style>

@endsection
