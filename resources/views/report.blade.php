@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full max-h-screen px-4 overflow-y-auto sm:px-8">
        {{-- Header Section --}}
        <div class="flex items-center justify-around w-full mt-2 lg:justify-between">
            <span class="text-3xl font-semibold ml-5 text-[#9a031f] lg:font-bold lg:text-4xl">Report</span>
        </div>
        <hr class="my-2 border-b-2 border-yellow-500">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2">
            {{-- Pie Chart --}}
            <div class="w-full h-48 my-4">
                <canvas id="pieChart"></canvas>
            </div>

            {{-- Bar Chart --}}
            <div class="w-full h-64 my-4">
                <canvas id="barChart"></canvas>
            </div>

            {{-- Line Chart --}}
            <div class="w-full h-64 my-4">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Required chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart Data and Configuration
        const pieData = {
            labels: ["Pending", "Processing", "Shipping", "Delivered"],
            datasets: [{
                label: "Order Status",
                data: [{{ $pending }}, {{ $processing }}, {{ $shipping }}, {{ $delivered }}],
                backgroundColor: ["rgb(90, 50, 241)", "rgb(101, 143, 200)", "rgb(0, 200, 20)",
                    "rgb(150, 143, 0)"
                ],
                hoverOffset: 4,
            }],
        };
        new Chart(document.getElementById("pieChart"), {
            type: "pie",
            data: pieData
        });

        // Bar Chart Data and Configuration
        const barData = {
            labels: ["Pending", "Processing", "Shipping", "Delivered"],
            datasets: [{
                label: "Order Status",
                data: [{{ $pending }}, {{ $processing }}, {{ $shipping }}, {{ $delivered }}],
                backgroundColor: ["rgba(90, 50, 241, 0.7)", "rgba(101, 143, 200, 0.7)", "rgba(0, 200, 20, 0.7)",
                    "rgba(150, 143, 0, 0.7)"
                ],
            }],
        };
        new Chart(document.getElementById("barChart"), {
            type: "bar",
            data: barData
        });

        // Line Chart Data and Configuration
        const lineData = {
            labels: ["Pending", "Processing", "Shipping", "Delivered"],
            datasets: [{
                label: "Order Status",
                data: [{{ $pending }}, {{ $processing }}, {{ $shipping }}, {{ $delivered }}],
                borderColor: "rgb(75, 192, 192)",
                fill: false,
                tension: 0.1,
            }],
        };
        new Chart(document.getElementById("lineChart"), {
            type: "line",
            data: lineData
        });
    </script>
@endsection
