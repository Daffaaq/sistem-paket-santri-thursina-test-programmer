@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Paket Masuk</h6>
                <div>
                    <button id="filterHarian" class="btn btn-sm btn" style="color: rgba(54, 162, 235, 0.6)">Harian</button>
                    <button id="filterMingguan" class="btn btn-sm btn"
                        style="color: rgba(75, 192, 192, 0.6) ">Mingguan</button>
                    <button id="filterBulanan" class="btn btn-sm btn"
                        style="color: rgba(153, 102, 255, 0.6)">Bulanan</button>
                    <button id="filterTahunan" class="btn btn-sm btn"
                        style="color: rgba(255, 159, 64, 0.6)">Tahunan</button>
                </div>
            </div>
            <div class="card-body">
                <!-- Tempat untuk grafik yang akan diganti sesuai filter -->
                <h5 class="text-center">Grafik Paket Masuk</h5>
                <canvas id="grafikPaket" class="chart-container"></canvas>
            </div>
        </div>



        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Kategori Paket Masuk</h6>
            </div>
            <div class="card-body">
                <canvas id="grafikKategoriPaket"></canvas>
            </div>
        </div>

        <!-- Paket Terbaru -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Paket Terbaru</h6>
            </div>
            <div class="card-body">
                @if ($semuaPaket->count())
                    <div class="table-responsive">
                        <table class="table table-bordered" id="paketTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Nama Kategori Paket</th>
                                    <th>Nama Santri</th>
                                    <th>Asrama</th>
                                    <th>Pengirim</th>
                                    <th>Tanggal Diterima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaPaket as $index => $paket)
                                    <tr class="paket-row {{ $index >= 5 ? 'd-none' : '' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $paket->nama_paket }}</td>
                                        <td>{{ $paket->kategoriPaket->nama_kategori }}</td>
                                        <td>{{ $paket->penerimaPaket->nama_santri }}</td>
                                        <td>{{ $paket->penerimaPaket->asrama->nama_asrama }}</td>
                                        <td>{{ $paket->pengirim_paket ?? 'Tidak diketahui' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($paket->tanggal_diterima)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol Toggle View -->
                    <div class="text-center mt-3">
                        <button id="toggleViewAll" class="btn btn-sm btn-primary">View All</button>
                    </div>
                @else
                    <p class="text-muted">Belum ada paket terbaru.</p>
                @endif
            </div>
        </div>

        <div class="row mb-4">
            <!-- Belum Diambil -->
            <div class="col-md-6 mb-3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Paket Belum Diambil</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahBelumDiambil }}</div>
                        </div>
                        <i class="fas fa-box-open fa-2x text-warning"></i>
                    </div>
                </div>
            </div>

            <!-- Disita -->
            <div class="col-md-6 mb-3">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Paket Disita</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahDisita }}</div>
                        </div>
                        <i class="fas fa-ban fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>





    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada elemen filterSelect
            $('#filterSelect').select2();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleViewAll');
            const paketRows = document.querySelectorAll('.paket-row');
            let showingAll = false;

            toggleButton.addEventListener('click', function() {
                showingAll = !showingAll;
                paketRows.forEach((row, index) => {
                    if (index >= 5) {
                        row.classList.toggle('d-none', !showingAll);
                    }
                });
                toggleButton.textContent = showingAll ? 'Show Less' : 'View All';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi data grafik
            const datasets = {
                harian: {
                    labels: {!! json_encode($labelsHarian) !!},
                    data: {!! json_encode($dataHarian) !!},
                },
                mingguan: {
                    labels: {!! json_encode($labelsMingguan) !!},
                    data: {!! json_encode($dataMingguan) !!},
                },
                bulanan: {
                    labels: {!! json_encode($labelsBulanan) !!},
                    data: {!! json_encode($dataBulanan) !!},
                },
                tahunan: {
                    labels: {!! json_encode($labelsTahunan) !!},
                    data: {!! json_encode($dataTahunan) !!},
                },
            };

            // Variabel untuk menyimpan instansi chart
            let chart = null;

            // Fungsi untuk membuat grafik berdasarkan tipe
            function createChart(type) {
                // Hancurkan grafik sebelumnya jika ada
                if (chart) {
                    chart.destroy();
                }

                // Tentukan data dan warna berdasarkan tipe
                let data, backgroundColor, borderColor, label;
                switch (type) {
                    case 'harian':
                        data = datasets.harian;
                        backgroundColor = 'rgba(54, 162, 235, 0.6)';
                        borderColor = 'rgba(54, 162, 235, 1)';
                        label = 'Jumlah Paket Harian';
                        break;
                    case 'mingguan':
                        data = datasets.mingguan;
                        backgroundColor = 'rgba(75, 192, 192, 0.6)';
                        borderColor = 'rgba(75, 192, 192, 1)';
                        label = 'Jumlah Paket Mingguan';
                        break;
                    case 'bulanan':
                        data = datasets.bulanan;
                        backgroundColor = 'rgba(153, 102, 255, 0.6)';
                        borderColor = 'rgba(153, 102, 255, 1)';
                        label = 'Jumlah Paket Bulanan';
                        break;
                    case 'tahunan':
                        data = datasets.tahunan;
                        backgroundColor = 'rgba(255, 159, 64, 0.6)';
                        borderColor = 'rgba(255, 159, 64, 1)';
                        label = 'Jumlah Paket Tahunan';
                        break;
                }


                // Membuat grafik dengan data yang dipilih
                const ctx = document.getElementById('grafikPaket').getContext('2d');
                chart = new Chart(ctx, {
                    type: 'line', // atau 'bar' sesuai kebutuhan
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: label,
                            data: data.data,
                            backgroundColor: backgroundColor,
                            borderColor: borderColor,
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                },
                            },
                        },
                    },
                });
            }

            // Event listener untuk tombol filter
            document.getElementById('filterHarian').addEventListener('click', function() {
                createChart('harian');
            });

            document.getElementById('filterMingguan').addEventListener('click', function() {
                createChart('mingguan');
            });

            document.getElementById('filterBulanan').addEventListener('click', function() {
                createChart('bulanan');
            });

            document.getElementById('filterTahunan').addEventListener('click', function() {
                createChart('tahunan');
            });

            // Inisialisasi dengan grafik Harian pertama kali
            createChart('harian');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kategoriLabels = {!! json_encode($kategoriLabels) !!};
            const kategoriTotals = {!! json_encode($kategoriTotals) !!};

            // Buat array warna otomatis
            const backgroundColors = [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(201, 203, 207, 0.6)',
                'rgba(0, 255, 127, 0.6)',
                'rgba(255, 140, 0, 0.6)',
                'rgba(60, 179, 113, 0.6)'
            ];

            const borderColors = backgroundColors.map(color => color.replace('0.6', '1'));

            const ctx = document.getElementById('grafikKategoriPaket').getContext('2d');
            const grafikKategoriPaket = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: kategoriLabels,
                    datasets: [{
                        label: 'Total Paket per Kategori',
                        data: kategoriTotals,
                        backgroundColor: backgroundColors.slice(0, kategoriLabels.length),
                        borderColor: borderColors.slice(0, kategoriLabels.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // <-- Matikan tampilan legend (termasuk warna samping label)
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed.y} paket`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
