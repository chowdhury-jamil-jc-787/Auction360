<x-backend.layouts.master>
    <x-slot:title1>Dashboard</x-slot:title1>
    <x-slot:title>Dashboard</x-slot:title>

    @if($userRoles->contains('Super Admin'))
        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategories }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-cubes" style="font-size:35px;color:red"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Users</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Bids</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBids }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-book" style="font-size:30px;color:red"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-12" style="width: 100vw;">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Bids Report</h6>
                </div>
                <div class="card-body" style="height: 30vh;">
                    <canvas id="bar-chart-custom-tooltip" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
        </div>

        @push('js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const dataBarCustomTooltip = {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($bidsPerMonth->pluck('month')->map(function ($month) { return DateTime::createFromFormat('!m', $month)->format('F'); })) !!},
                        datasets: [
                            {
                                label: 'Bids',
                                data: {!! json_encode($bidsPerMonth->pluck('total')) !!}
                            },
                        ],
                    },
                };

                const optionsBarCustomTooltip = {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';
                                    label = `${label}: ${context.formattedValue} bids`;
                                    return label;
                                },
                            },
                        },
                    },
                };

                new Chart(
                    document.getElementById('bar-chart-custom-tooltip'),
                    {
                        type: dataBarCustomTooltip.type,
                        data: dataBarCustomTooltip.data,
                        options: optionsBarCustomTooltip,
                    }
                );
            </script>
        @endpush
    @else
        @if($userRoles->contains('Customer'))
            <div class="text-center">
                <h3>Welcome, Customer!</h3>
                <img src="{{ asset('assets/frontend/home/images/logo.png') }}" alt="Customer Image">
            </div>
        @elseif($userRoles->contains('Seller'))
            <div class="text-center">
                <h3>Welcome, Seller!</h3>
                <img src="{{ asset('assets/frontend/home/images/logo.png') }}" alt="Seller Image 1">
                <img src="https://cdn.townweb.com/cityofmineralpoint.com/wp-content/uploads/2023/09/auction-2.jpg" alt="Seller Image 2">
            </div>
        @else
            <div class="text-center">
                <h3>Welcome, {{ $userRoles->implode(', ') }}</h3>
            </div>
        @endif
    @endif
</x-backend.layouts.master>

