@extends('layouts.app')
<title>Barroc intens | Klanten overzicht</title>
@section('content')
    <div class="flex h-screen">
        <!-- Column 1: Customer list (scrollable) -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="w-1/4 bg-gray-100 overflow-y-auto p-4 border-r border-gray-300">
            <div class="my-4">
                <a href="{{ route('customers.create') }}"
                    class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors duration-200">
                    voeg klant toe
                </a>
            </div>
            <ul class="space-y-2">
                @foreach ($customers as $customer)
                    <li class="hover:bg-gray-300 p-2    rounded transition-colors duration-200">
                        <a href="javascript:void(0)" class="block text-gray-800 font-medium"
                            onclick="showCustomerDetails({{ $customer->id }})">
                            {{ $customer->name }}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>

        <!-- Column 2: Customer details -->
        <div class="w-1/2 p-8 bg-white" id="customer-details">
            <p class="text-gray-500 text-center">Selecteer een klant voor meer details</p>
        </div>

        <!-- Column 3: Invoice placeholder -->
        <div class="w-1/2 bg-gray-900 text-white p-8" id="invoice-placeholder">
            <p class="text-gray-500 text-center">Factuur komt hier terecht</p>
        </div>
    </div>

    <script>
        // Prepare customers with invoices data
        let customers = @json($customers); // Pass all customers and their invoices

        function showCustomerDetails(customerId) {
            let customer = customers.find(c => c.id === customerId);
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
                        <a href="/customers/${customerId}/invoice/create" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-200">
                            Make Invoice
                        </a>
                    </div>
                </div>
                `;
                document.getElementById('customer-details').innerHTML = detailsSection;

                // Fetch the customer-specific invoice
                let invoiceSection = '';
                if (customer.invoices.length > 0) {
                    let invoice = customer.invoices[0]; // Get the latest invoice for the customer
                    invoiceSection = `
                        <h2 class="text-3xl font-bold">FACTUUR</h2>
                        <p class="mt-4"><strong>Klant:</strong> ${customer.name}</p>
                        <p><strong>Factuur nummer:</strong> ${invoice.number}</p>

                        <div class="mt-4">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr>
                                        <th class="border-b border-yellow-500 py-2 text-white">Aantal</th>
                                        <th class="border-b border-yellow-500 py-2 text-white">Nummer</th>
                                        <th class="border-b border-yellow-500 py-2 text-white">Omschrijving</th>
                                        <th class="border-b border-yellow-500 py-2 text-white">Prijs</th>
                                        <th class="border-b border-yellow-500 py-2 text-white">Subtotaal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 text-white">${invoice.quantity}x</td>
                                        <td class="py-2 text-white">${invoice.number}</td>
                                        <td class="py-2 text-white">${invoice.description}</td>
                                        <td class="py-2 text-white">€${invoice.price}</td>
                                        <td class="py-2 text-white">€${invoice.total}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="mt-4 font-bold text-white">Totaal: €${invoice.total}</p>
                    `;
                } else {
                    invoiceSection = `<p class="text-gray-500 text-center">No invoice available</p>`;
                }

                document.getElementById('invoice-placeholder').innerHTML = invoiceSection;
            }
        }
    </script>
@endsection
