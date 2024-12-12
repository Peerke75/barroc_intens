<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factuur #{{ $customer->id }}</title>
    <style>
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css');

        body {
            font-family: Arial, sans-serif;
            color: #000000;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            background-color: #ffffff;

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
            color: #fdd716;
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
            background-color: #fdd716;
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
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .invoice-header .company-info {
            font-size: 14px;
        }
        .invoice-header .company-info p {
            margin: 0;
        }
        .company-logo {
            width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="invoice-header">
            <img src="{{ public_path('img/Logo6_klein.png') }}" alt="Bedrijfslogo" class="company-logo">
            <div class="company-info">
                <h2>Factuur #{{ $customer->id }}</h2>
                <p><strong>Klant:</strong> {{ $customer->name }}</p>
                <p><strong>Bedrijf:</strong> {{ $customer->company_name }}</p>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Datum:</strong> {{ now()->format('d-m-Y') }}</p>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-yellow-500 mb-4">Factuur Details</h1>

        <table class="price-table w-full border-collapse mb-6">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer->invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->description }}</td>
                        <td>{{ $invoice->quantity }}</td>
                        <td>€{{ number_format($invoice->price, 2) }}</td>
                        <td>€{{ number_format($invoice->price * $invoice->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total text-right">
            <p><strong>Totaal:</strong> €{{ number_format($customer->invoices->sum(function($invoice) { return $invoice->price * $invoice->quantity; }), 2) }}</p>
        </div>

        <p class="mt-4">Deze factuur is gegenereerd op {{ now()->format('d-m-Y') }}.</p>
    </div>

</body>
</html>
