@extends('layouts.app')
<title>Barroc intens | Klanten overzicht</title>
@section('content')
    <div class="flex h-screen bg-gray-50">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 shadow-lg mx-auto">
                {{ session('success') }}
            </div>
        @endif
        <div class="w-1/4 bg-white overflow-y-auto p-4 border-r border-gray-200 shadow">
            <div class="my-4 text-center">
                <a href="{{ route('customers.create') }}"
                    class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 shadow-md transition-transform transform hover:scale-105">
                    Voeg Klant Toe
                </a>
            </div>
            <ul class="space-y-2">
                @foreach ($customers as $customer)
                    <li class="hover:bg-gray-100 p-2 rounded-lg shadow transition-transform transform hover:scale-105">
                        <a href="javascript:void(0)" class="block text-gray-800 font-medium"
                            onclick="showCustomerDetails({{ $customer->id }})">
                            {{ $customer->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-1/2 p-8 bg-gray-50 shadow-lg" id="customer-details">
            <p class="text-gray-400 text-center italic">Selecteer een klant voor meer details</p>
        </div>

        <div class="w-1/2 bg-gray-900 text-white p-8 shadow-lg" id="invoice-placeholder">
            <p class="text-gray-400 text-center italic">Factuur komt hier terecht</p>
        </div>
    </div>

    <script>
        let customers = @json($customers);
        function showCustomerDetails(customerId) {
            let customer = customers.find(c => c.id === customerId);
            console.log(customer)
            if (customer) {
                let paymentStatusClass = '';
                let paymentStatusText = '';

                if (customerId === 1) {
                    paymentStatusClass = 'bg-green-500';
                    paymentStatusText = 'Paid';
                } else if (customerId === 2) {
                    paymentStatusClass = 'bg-yellow-500';
                    paymentStatusText = 'Pending';
                } else if (customerId === 3) {
                    paymentStatusClass = 'bg-red-500';
                    paymentStatusText = 'Overdue';
                } else {
                    paymentStatusClass = 'bg-gray-500';
                    paymentStatusText = 'Unknown';
                }

                let detailsSection = `
            <div class="mt-8 space-y-4">
                <h3 class="text-2xl font-semibold text-gray-800">${customer.name}</h3>
                <p class="text-lg text-gray-700"><strong>Company:</strong> ${customer.company_name}</p>
                <p class="text-lg text-gray-700"><strong>Email:</strong> ${customer.mail}</p>
                <p class="text-lg text-gray-700"><strong>Status:</strong> ${customer.order_status}</p>
                <p class="text-lg text-gray-700"><strong>BKR Check:</strong> ${customer['BKR-check'] ? 'Passed' : 'Failed'}</p>

                <!-- Payment Status Box -->
                <div class="mt-4 p-4 rounded-lg ${paymentStatusClass} text-white text-center">
                    <p class="text-xl font-semibold">Payment Status: ${paymentStatusText}</p>
                </div>

                <!-- Make Invoice Button -->
                <div class="mt-4">
                    <a href="/customers/${customerId}/invoice/create" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 shadow-md transition-transform transform hover:scale-105">
                        Make Invoice
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

                        <!-- Invoice Table -->
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

                        <!-- Total Amount -->
                        <div class="text-right mt-6">
                            <p class="text-xl font-bold text-yellow-400">Totaal: €${invoice.total}</p>
                        </div>

                       <div class="mt-6">
                            <a href="#"
                            id="downloadPdfButton"
                            data-customer-id="${customer.id}"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
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

                document.getElementById('downloadPdfButton').addEventListener('click', function(e) {
                    e.preventDefault(); 
                    const customerId = this.getAttribute('data-customer-id');

                    const url = `/customers/downloadPdf/${customerId}`;

                    window.location.href = url;
                });
            }
        }
    </script>
@endsection
