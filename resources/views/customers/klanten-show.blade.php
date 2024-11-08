@extends('layouts.app')

@section('content')

<div class="flex">
    <!-- Customer list (scrollable container) -->
    <div class="w-1/4 h-screen overflow-y-auto bg-gray-200 p-4">
        <ul class="space-y-2">
            @foreach($customers as $customer)
                <li class="hover:bg-gray-700 p-2 rounded">
                    <a href="javascript:void(0)" class="block" onclick="showCustomerDetails({{ $customer->id }})">{{ $customer->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Customer details (right side) -->
    <div class="flex-1 p-8" id="customer-details">
        <!-- No customer details displayed by default -->
    </div>
</div>

<script>
    // Function to show customer details when clicked
    function showCustomerDetails(customerId) {
        // Find the customer object using the customerId
        let customers = @json($customers); // Convert PHP array to JavaScript array
        let customer = customers.find(c => c.id === customerId);

        if (customer) {
            // Display customer details in the right pane with additional information
            let detailsSection = `
                <div class="customer-section mt-8">
                    <h3 class="text-2xl font-semibold">${customer.name}</h3>
                    <p class="text-lg"><strong>Company:</strong> ${customer.company_name}</p>
                    <p class="text-lg"><strong>Email:</strong> ${customer.mail}</p>
                    <p class="text-lg"><strong>Status:</strong> ${customer.order_status}</p>
                    <p class="text-lg"><strong>BKR Check:</strong> ${customer['BKR-check'] ? 'Passed' : 'Failed'}</p>
                    <p class="mt-4"><strong>Description:</strong></p>
                    <p>${customer.description || 'No description available.'}</p>
                </div>
            `;
            document.getElementById('customer-details').innerHTML = detailsSection;
        }
    }
</script>

@endsection
