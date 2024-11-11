<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storingen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Storingen</h1>

    <table class="table-auto w-full bg-white border border-gray-300 rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Product ID</th>
                <th class="px-4 py-2 border">Customer ID</th>
                <th class="px-4 py-2 border">Message</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($malfunctions as $malfunction)
                <tr>
                    <td class="px-4 py-2 border">{{ $malfunction->id }}</td>
                    <td class="px-4 py-2 border">{{ $malfunction->product_id }}</td>
                    <td class="px-4 py-2 border">{{ $malfunction->customer_id }}</td>
                    <td class="px-4 py-2 border">{{ $malfunction->message }}</td>
                    <td class="px-4 py-2 border">{{ $malfunction->status }}</td>
                    <td class="px-4 py-2 border">
                        {{-- Corrected date formatting using Carbon --}}
                        {{ \Carbon\Carbon::parse($malfunction->date)->format('Y-m-d H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 border text-center">No malfunctions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
