@extends('layouts.admin_main')

@section('content')

    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Khách hàng mới</span>
                    <span class="text-lg font-semibold"></span>
                </div>
                <div class="text-4xl text-green-500 p-3 ">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            <div>
                <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                <span>from 2019</span>
            </div>
        </div>

        <!-- Thẻ thông tin chuyến đi mới -->
        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Chuyến đi mới</span>
                    <span class="text-lg font-semibold"></span>
                </div>
                <div class="text-4xl text-blue-500 p-3">
                    <i class="fas fa-route"></i>
                </div>
            </div>
            <div>
                <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                <span>from 2019</span>
            </div>
        </div>

        <!-- Thẻ thông tin tài xế -->
        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Tài xế</span>
                    <span class="text-lg font-semibold"></span>
                </div>
                <div class="text-4xl text-yellow-500 p-3">
                    <i class="fas fa-taxi"></i>
                </div>
            </div>
            <div>
                <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                <span>from 2019</span>
            </div>
        </div>

        <!-- Thẻ thông tin doanh thu -->
        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Danh thu</span>
                    <span class="text-lg font-semibold"> VNĐ</span>
                </div>
                <div class="text-4xl text-red-500 p-3">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div>
                <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                <span>from 2019</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-6 mt-6 lg:flex-row lg:gap-6">
        <!-- Biểu đồ doanh thu -->
        <div class="flex-1 p-4 border rounded-lg shadow-sm bg-white">
            <h3 class="text-lg font-semibold">Doanh thu hàng tháng</h3>
            <canvas id="revenueChart" width="400" height="200"></canvas>
        </div>

        <div class="flex-1 p-4 border rounded-lg shadow-sm bg-white">
            <h3 class="text-lg font-semibold">Khách hàng, Tài xế, Chuyến đi 6 tháng gần nhất</h3>
            <canvas id="metricsChart" width="400" height="200"></canvas>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Doanh thu',
                    data: @json($monthlyRevenue),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctxMetrics = document.getElementById('metricsChart').getContext('2d');
        const metricsChart = new Chart(ctxMetrics, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Số lượng khách hàng',
                        data: @json($monthlyCustomerCount),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Số lượng tài xế',
                        data: @json($monthlyDriverCount),
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Số lượng chuyến đi',
                        data: @json($monthlyBookingCount),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.formattedValue;
                            }
                        }
                    }
                }
            }
        });
    </script> --}}
@endsection
