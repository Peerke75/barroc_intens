@extends('layouts.app')
<title>Barroc intens | Klanten overzicht</title>
@section('content')

<div class="flex h-screen">
    <!-- Column 1: Customer list (scrollable) -->
    @if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="w-1/4 bg-gray-100 overflow-y-auto p-4 border-r border-gray-300">
        <div class="my-4">
            <a href="{{ route('customers.create') }}" class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors duration-200">
                voeg klant toe
            </a>
        </div>
        <ul class="space-y-2">
            <li class="hover:bg-gray-300 p-2 rounded transition-colors duration-200">
                <a href="javascript:void(0)" class="block text-gray-800 font-medium" onclick="showCustomerDetails({{ $customer->id }})">
                    {{ $customer->name }}
                </a>
            </li>
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
    let customers = @json($customer);

    // Random description generator function
    function generateRandomDescription(customerId) {
        const descriptions = [
            "Customer specializes in web development services with innovative online solutions.",
            "Customer is a consulting firm offering strategic business advice and marketing optimization.",
            "Customer provides cloud hosting services with a focus on scalable web infrastructure.",
            "Customer is a design agency known for minimalist web designs and great user experiences.",
            "Customer offers SEO optimization services to improve online visibility for businesses.",
            "Customer focuses on digital marketing strategies with an emphasis on social media growth.",
            "Customer is a tech company developing mobile apps for various industries.",
            "Customer offers financial services, specializing in tax consulting and investment strategies."
        ];
        return descriptions[Math.floor(Math.random() * descriptions.length)];
    }

    // Random invoice generation function
    function generateRandomInvoice() {
        const descriptions = ["Web development services", "Consulting", "Design services", "Hosting", "SEO optimization"];
        const randomDescription = descriptions[Math.floor(Math.random() * descriptions.length)];
        const randomPrice = (Math.random() * (500 - 50) + 50).toFixed(2); // Price between 50 and 500 EUR
        const randomQuantity = Math.floor(Math.random() * 5) + 1; // Quantity between 1 and 5

        return {
            number: "INV-" + Math.floor(Math.random() * 100000),
            description: randomDescription,
            price: parseFloat(randomPrice),
            quantity: randomQuantity
        };
    }

    function showCustomerDetails(customerId) {
    let customer = customers.find(c => c.id === customerId);

    if (customer) {
        // Fetch the latest saved invoice if available
        const newInvoice = @json(session('new_invoice'));

        let invoiceSection = '';
        if (newInvoice && customerId === newInvoice.customer_id) {
            invoiceSection = `
                <h2 class="text-3xl font-bold">FACTUUR</h2>
                <p class="mt-4"><strong>Klant:</strong> ${customer.name}</p>
                <p><strong>Factuurnr.:</strong> ${newInvoice.number}</p>

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
                                <td class="py-2">${newInvoice.quantity}x</td>
                                <td class="py-2">${newInvoice.number}</td>
                                <td class="py-2">${newInvoice.description}</td>
                                <td class="py-2">€${newInvoice.price}</td>
                                <td class="py-2">€${newInvoice.total}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="mt-4 font-bold">Totaal: €${newInvoice.total}</p>
            `;
        } else {
            invoiceSection = `
                <p class="text-gray-500 text-center">No invoice available</p>
            `;
        }

        document.getElementById('invoice-placeholder').innerHTML = invoiceSection;
    }
}
let customers = @json($customer);
let newInvoice = @json(session('new_invoice', null)); // Pass the newly created invoice

</script>

@endsection
