<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offerte #{{ $proposal->id }}</title>
    <style>
        /* Voeg Tailwind's utility-first benadering in de inline stijl toe voor PDF styling */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css');

        /* PDF-specifieke styling voor gebruik in DomPDF */
        body {
            font-family: Arial, sans-serif;
            color: #000000; /* Kleur 2: Zwart */
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #fdd716; /* Kleur 1: Goud (#fdd716) */
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 22px;
            margin-top: 30px;
            margin-bottom: 10px;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
        }
        .company-logo {
            width: 150px;
            margin-bottom: 20px;
        }
        .proposal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .proposal-header .company-info {
            font-size: 14px;
        }
        .proposal-header .company-info p {
            margin: 0;
        }
        .price-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .price-table th, .price-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .price-table th {
            background-color: #fdd716; /* Kleur 1: Goud (#fdd716) */
            color: #ffffff;
        }
        .price-table td {
            background-color: #f9f9f9;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="proposal-header flex justify-between items-center mb-8">
            <img src="{{ public_path('img/Logo6_klein.png') }}" alt="Company Logo" class="company-logo">
            <div class="company-info text-sm">
                <h2 class="text-xl text-yellow-500 mb-4">Offerte #{{ $proposal->id }}</h2>
                <p><strong>Klant:</strong> {{ $proposal->customer->company_name }}</p>
                <p><strong>Contactpersoon:</strong> {{ $proposal->customer->name }}</p>
                <p><strong>Email:</strong> {{ $proposal->customer->mail }}</p>
                <p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($proposal->date)->format('d-m-Y') }}</p>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-yellow-500 mb-4">Offerte Details</h1>

        <table class="price-table w-full border-collapse mb-6">
            <thead>
                <tr class="bg-yellow-500 text-white">
                    <th class="px-4 py-2 text-left">Product</th>
                    <th class="px-4 py-2 text-left">Aantal</th>
                    <th class="px-4 py-2 text-left">Prijs</th>
                    <th class="px-4 py-2 text-left">Totaal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal->priceLines as $priceLine)
                    <tr>
                        <td class="px-4 py-2">{{ $priceLine->product->name }}</td>
                        <td class="px-4 py-2">{{ $priceLine->amount }}</td>
                        <td class="px-4 py-2">€{{ number_format($priceLine->price, 2) }}</td>
                        <td class="px-4 py-2">€{{ number_format($priceLine->price * $priceLine->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total text-right">
            <p><strong>Totaal:</strong> €{{ number_format($proposal->priceLines->sum(function($line) { return $line->price * $line->amount; }), 2) }}</p>
        </div>

        <p class="mt-4">Deze offerte is geldig tot 30 dagen na de datum van uitgifte.</p>
    </div>

</body>
</html>
