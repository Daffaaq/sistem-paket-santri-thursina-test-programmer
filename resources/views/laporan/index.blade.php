@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Paket</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="date" id="from_date" class="form-control" placeholder="Dari Tanggal">
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="to_date" class="form-control" placeholder="Sampai Tanggal">
                    </div>
                    <div class="col-md-3">
                        <select id="kategori_filter" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoriPaket as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" id="filterBtn">Filter</button>
                        <button class="btn btn-secondary" id="resetBtn">Reset</button>
                    </div>
                </div>

                <ul class="nav nav-tabs mb-3" id="laporanTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="masuk-tab" data-toggle="tab" href="#masuk" role="tab">Paket
                            Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keluar-tab" data-toggle="tab" href="#keluar" role="tab">Paket Keluar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="disita-tab" data-toggle="tab" href="#disita" role="tab">Paket Disita</a>
                    </li>
                </ul>

                <div class="tab-content" id="laporanTabContent">
                    <!-- Paket Masuk -->
                    <div class="tab-pane fade show active" id="masuk" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="PaketMasukTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Paket</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Kategori</th>
                                        <th>Penerima</th>
                                        <th>Pengirim</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <!-- Paket Keluar -->
                    <div class="tab-pane fade" id="keluar" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="PaketKeluarTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Paket</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Kategori</th>
                                        <th>Penerima</th>
                                        <th>Pengirim</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <!-- Paket Disita -->
                    <div class="tab-pane fade" id="disita" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="PaketDisitaTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Paket</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Kategori</th>
                                        <th>Penerima</th>
                                        <th>Pengirim</th>
                                        <th>Status</th>
                                        <th>Isi Disita</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item {
            font-size: 0.875rem;
        }

        .breadcrumb-item a {
            color: #464646;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item a.active {
            font-weight: bold;
            color: #007bff;
            pointer-events: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        let tableMasuk, tableKeluar, tableDisita;

        $(document).ready(function() {
            initTables();

            $('#filterBtn').click(function() {
                reloadAllTables();
            });

            $('#resetBtn').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#kategori_filter').val('').trigger('change');
                reloadAllTables();
            });

        });

        function initTables() {
            tableMasuk = loadDatatable('#PaketMasukTable', 'Belum Diambil');
            tableKeluar = loadDatatable('#PaketKeluarTable', 'Diambil');
            tableDisita = loadDatatable('#PaketDisitaTable', 'disita');
        }

        function reloadAllTables() {
            tableMasuk.ajax.reload();
            tableKeluar.ajax.reload();
            tableDisita.ajax.reload();
        }

        function loadDatatable(tableId, status) {
            return $(tableId).DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('laporan.list') }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        d.status = status;
                        d.from = $('#from_date').val();
                        d.to = $('#to_date').val();
                        d.kategori = $('#kategori_filter').val(); // Filter berdasarkan kategori
                    }
                },
                columns: getColumnsConfig(status)
            });
        }

        function getColumnsConfig(status) {
            let columns = [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_paket'
                },
                {
                    data: 'tanggal_diterima'
                },
                {
                    data: 'kategori_paket.nama_kategori',
                    defaultContent: '-'
                },
                {
                    data: 'penerima_paket',
                    render: function(data, type, row) {
                        return row.penerima_paket?.nama_santri ?? '-';
                    }
                },
                {
                    data: 'pengirim_paket'
                },
                {
                    data: 'status_paket'
                }
            ];

            if (status === 'disita') {
                columns.push({
                    data: 'isi_paket_yang_disita',
                    render: function(data) {
                        return data ? data : '-';
                    }
                });
            }

            return columns;
        }
    </script>
@endpush
