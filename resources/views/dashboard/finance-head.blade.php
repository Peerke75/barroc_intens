@extends('layouts.app')

@section('title', 'Finance Head Dashboard')

@section('content')
@if (session('error'))
    <div class="bg-red-400 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Finance Head Dashboard</h1>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Expense Charts</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>
        <div style="display: flex; justify-content: space-around; padding: 20px;">
            <div style="width: 45%;">
                <h2>Maandelijkse Uitgaven (in €)</h2>
                <canvas id="monthlyChart" width="400" height="200"></canvas>
            </div>
            <div style="width: 45%;">
                <h2>Jaarlijkse Uitgaven (in €)</h2>
                <canvas id="yearlyChart" width="400" height="200"></canvas>
            </div>
        </div>

        <script>
            const monthlyLabels = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
            const monthlyData = [400, 300, 500, 450, 600, 550, 700, 650, 620, 580, 490, 520]; 

            const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(ctxMonthly, {
                type: 'bar',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Maandelijkse Uitgaven (€)',
                        data: monthlyData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '€' + value; 
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                        },
                        title: {
                            display: true,
                            text: 'Maandelijkse Uitgaven'
                        }
                    }
                }
            });

            const yearlyLabels = ['2020', '2021', '2022', '2023', '2024'];
            const yearlyData = [5200, 6100, 5800, 6000, 6500]; 

            const ctxYearly = document.getElementById('yearlyChart').getContext('2d');
            const yearlyChart = new Chart(ctxYearly, {
                type: 'line',
                data: {
                    labels: yearlyLabels,
                    datasets: [{
                        label: 'Jaarlijkse Uitgaven (€)',
                        data: yearlyData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 2,
                        fill: true 
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '€' + value; 
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                        },
                        title: {
                            display: true,
                            text: 'Jaarlijkse Uitgaven'
                        }
                    }
                }
            });
        </script>
    </body>

    </html>

</div>
@endsection
