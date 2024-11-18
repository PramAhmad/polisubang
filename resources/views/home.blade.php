<x-layouts.app>
    <!-- Welcome Section with Today's Stats -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 bg-primary-subtle overflow-hidden shadow-sm">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle overflow-hidden me-3">
                                    <img src="{{ asset('templates/mdrnz/images/profile/user-1.jpg') }}" alt="" width="50" height="50">
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0">Welcome back, {{ auth()->user()->name }}!</h5>
                                    <p class="mb-0 text-muted">Here's what's happening today.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <div class="me-4">
                                    <h3 class="mb-1 fw-bold">{{ $summary['today_stats']['peminjaman'] }}</h3>
                                    <p class="text-muted mb-0">Today's Z</p>
                                </div>
                                <div class="me-4">
                                    <h3 class="mb-1 fw-bold">{{ $summary['today_stats']['pengajuan'] }}</h3>
                                    <p class="text-muted mb-0">Today's Applications</p>
                                </div>
                                <div>
                                    <h3 class="mb-1 fw-bold">{{ $summary['today_stats']['prasat'] }}</h3>
                                    <p class="text-muted mb-0">Today's Prasat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <img src="{{ asset('templates/mdrnz/images/backgrounds/welcome-bg.svg') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Statistics Cards -->
    <div class="row mt-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Inventory Alerts</h5>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-4">
                            <h4 class="fw-semibold text-warning">{{ $summary['inventory_stats']['expired_soon'] }}</h4>
                            <p class="fs-6 mb-0">Expiring Soon</p>
                        </div>
                        <div>
                            <h4 class="fw-semibold text-danger">{{ $summary['inventory_stats']['low_stock'] }}</h4>
                            <p class="fs-6 mb-0">Low Stock</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Peminjaman Status</h5>
                    <h4 class="fw-semibold">{{ $summary['active_peminjaman'] }}/{{ $summary['total_peminjaman'] }}</h4>
                    <p class="fs-6 mb-0">Active/Total Z</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Pengajuan Status</h5>
                    <h4 class="fw-semibold">{{ $summary['pending_pengajuan'] }}/{{ $summary['total_pengajuan'] }}</h4>
                    <p class="fs-6 mb-0">Pending/Total Applications</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Total Records</h5>
                    <h4 class="fw-semibold">{{ $summary['total_prasat'] }}</h4>
                    <p class="fs-6 mb-0">Prasat Records</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">Weekly Statistics</h6>
                </div>
                <div class="card-body">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">Monthly Overview</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Records Section -->
    <div class="row mt-4">
        <!-- Latest Peminjaman -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">Latest Z</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestPeminjaman as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->code }}</td>
                                    <td>{{ $peminjaman->name }}</td>
                                    <td>{{ $peminjaman->jadwal }}</td>
                                    <td>
                                        <span class="badge bg-{{ $peminjaman->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ $peminjaman->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Prasat -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">Latest Prasat Records</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestPrasat as $prasat)
                                <tr>
                                    <td>{{ $prasat->nama_prasat }}</td>
                                    <td>{{ $prasat->alamat }}</td>
                                    <td>{{ $prasat->no_telp }}</td>
                                    <td>{{ $prasat->type }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Section -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">Inventory Overview</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Location</th>
                                    <th>Quantity</th>
                                    <th>Condition</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popularItems as $item)
                                <tr>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->lokasi_barang }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->kondisi === 'good' ? 'success' : 'warning' }}">
                                            {{ $item->kondisi }}
                                        </span>
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($item->tanggal_expired)->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Weekly Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        const weeklyLabels = {!! json_encode($weeklyStats->pluck('week_label')) !!};
        const weeklyData = {!! json_encode($weeklyStats->pluck('total_peminjaman')) !!};

        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Peminjaman per Week',
                    data: weeklyData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyLabels = {!! json_encode($monthlyStats->pluck('month')) !!};
        const monthlyData = {!! json_encode($monthlyStats->pluck('total_peminjaman')) !!};

        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: monthlyLabels.map(month => `Month ${month}`),
                datasets: [{
                    label: 'Peminjaman per Month',
                    data: monthlyData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
</x-layouts.app>
