@extends('layouts.app')

@section('title', 'Finance Head Dashboard')

@section('content')
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
            // Testdata voor maandelijkse uitgaven
            const monthlyLabels = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
            const monthlyData = [400, 300, 500, 450, 600, 550, 700, 650, 620, 580, 490, 520]; // Maandelijkse bedragen in euro's

            // Maandelijkse grafiek
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
                                    return '€' + value; // Voeg "€" toe aan de y-as
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

            // Testdata voor jaarlijkse uitgaven
            const yearlyLabels = ['2020', '2021', '2022', '2023', '2024'];
            const yearlyData = [5200, 6100, 5800, 6000, 6500]; // Jaarlijkse bedragen in euro's

            // Jaarlijkse grafiek
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
                        fill: true // Kleur onder de lijn
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '€' + value; // Voeg "€" toe aan de y-as
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