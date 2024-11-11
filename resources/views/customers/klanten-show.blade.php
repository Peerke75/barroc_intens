@extends('layouts.app')

@section('content')

<div class="flex h-screen">
    <!-- Column 1: Customer list (scrollable) -->
    <div class="w-1/4 bg-gray-100 overflow-y-auto p-4 border-r border-gray-300">
        <ul class="space-y-2">
            @foreach($customers as $customer)
                <li class="hover:bg-gray-300 p-2 rounded transition-colors duration-200">
                    <a href="javascript:void(0)" class="block text-gray-800 font-medium" onclick="showCustomerDetails({{ $customer->id }})">
                        {{ $customer->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Column 2: Customer details -->
    <div class="w-1/2 p-8 bg-white" id="customer-details">
        <p class="text-gray-500 text-center">Select a customer to view details</p>
    </div>

    <!-- Column 3: Invoice placeholder -->
    <div class="w-1/2 bg-gray-900 text-white p-8" id="invoice-placeholder">
        <p class="text-gray-500 text-center">Invoice details will appear here</p>
    </div>
</div>

<script>
    // Prepare customers with invoices data
    let customers = @json($customers);

    // Random invoice generation function
    function generateRandomInvoice() {
        const descriptions = ["Web development services", "Consulting", "Design services", "Hosting", "SEO optimization"];
        const randomDescription = descriptions[Math.floor(Math.random() * descriptions.length)];
        const randomPrice = (Math.random() * (500 - 50) + 50).toFixed(2); // Price between 50 and 500 EUR
        const randomQuantity = Math.floor(Math.random() * 5) + 1; // Quantity between 1 and 5

        const invoice = {
            number: "INV-" + Math.floor(Math.random() * 100000), // Random invoice number
            description: randomDescription,
            price: parseFloat(randomPrice),
            quantity: randomQuantity
        };

        return invoice;
    }

    function showCustomerDetails(customerId) {
        // Find the customer object by ID
        let customer = customers.find(c => c.id === customerId);

        if (customer) {
            // Hard-coded Payment Status Box
            let paymentStatusClass = '';
            let paymentStatusText = '';
            // Hard-coding different payment statuses for demonstration
            if (customerId === 1) {
                paymentStatusClass = 'bg-green-500';  // Paid
                paymentStatusText = 'Paid';
            } else if (customerId === 2) {
                paymentStatusClass = 'bg-yellow-500';  // Pending
                paymentStatusText = 'Pending';
            } else if (customerId === 3) {
                paymentStatusClass = 'bg-red-500';  // Overdue
                paymentStatusText = 'Overdue';
            } else {
                paymentStatusClass = 'bg-gray-500';  // Default
                paymentStatusText = 'Unknown';
            }

            // Update Customer Details section
            let detailsSection = `
                <div class="mt-8 space-y-4">
                    <h3 class="text-2xl font-semibold text-gray-800">${customer.name}</h3>
                    <p class="text-lg text-gray-700"><strong>Company:</strong> ${customer.company_name}</p>
                    <p class="text-lg text-gray-700"><strong>Email:</strong> ${customer.mail}</p>
                    <p class="text-lg text-gray-700"><strong>Status:</strong> ${customer.order_status}</p>
                    <p class="text-lg text-gray-700"><strong>BKR Check:</strong> ${customer['BKR-check'] ? 'Passed' : 'Failed'}</p>
                    <div class="mt-4">
                        <p class="text-lg text-gray-700"><strong>Description:</strong></p>
                        <p class="text-gray-600">${customer.description || 'No description available.'}</p>
                    </div>

                    <!-- Payment Status Box -->
                    <div class="mt-4 p-4 rounded-lg ${paymentStatusClass} text-white text-center">
                        <p class="text-xl font-semibold">Payment Status: ${paymentStatusText}</p>
                    </div>
                </div>
            `;
            document.getElementById('customer-details').innerHTML = detailsSection;

            // Generate random invoice if no customer invoices are found
            let randomInvoice = generateRandomInvoice();

            let invoiceSection = `
                <h2 class="text-3xl font-bold">FACTUUR</h2>
                <p class="mt-4"><strong>Klant:</strong> ${customer.name}</p> <!-- Changed from Klantnr. to Customer Name -->
                <p><strong>Contractnr.:</strong> ${customer.contract_number || 'N/A'}</p>
                <p><strong>Factuurnr.:</strong> ${randomInvoice.number || 'N/A'}</p>

                <div class="mt-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b border-yellow-500 py-2">Aantal</th>
                                <th class="border-b border-yellow-500 py-2">Nummer</th>
                                <th class="border-b border-yellow-500 py-2">Omschrijving</th>
                                <th class="border-b border-yellow-500 py-2">Prijs</th>
                                <th class="border-b border-yellow-500 py-2">Subtotaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2">${randomInvoice.quantity}x</td>
                                <td class="py-2">${randomInvoice.number}</td>
                                <td class="py-2">${randomInvoice.description}</td>
                                <td class="py-2">€${randomInvoice.price}</td>
                                <td class="py-2">€${(randomInvoice.price * randomInvoice.quantity).toFixed(2)}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="mt-4 font-bold">Totaal: €${(randomInvoice.price * randomInvoice.quantity).toFixed(2)}</p>
                <p class="mt-4 text-sm">Te betalen binnen 14 dagen na dagtekening.</p>
            `;
            document.getElementById('invoice-placeholder').innerHTML = invoiceSection;
        }
    }
</script>

@endsection
    