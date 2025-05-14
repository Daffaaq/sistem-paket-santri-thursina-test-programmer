@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Paket Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('paket.index') }}"
                            class="{{ request()->routeIs('paket.index') ? 'active' : '' }}">Paket Management</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <!-- Tombol Export untuk Paket Masuk -->
                    <a href="{{ route('paket.export.masuk') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mr-2">
                        <i class="fas fa-file-excel fa-sm text-white-50"></i> Export Paket Masuk ke Excel
                    </a>
                    <!-- Tombol Export untuk Paket Keluar -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('paket.export.keluar') }}" class="btn btn-success">
                            Export Paket Keluar ke Excel
                        </a>
                    </div>

                    <a href="{{ route('paket.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket
                    </a>
                </div>
                <ul class="nav nav-tabs mb-3" id="paketTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="masuk-tab" data-toggle="tab" href="#masuk" role="tab">Paket
                            Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keluar-tab" data-toggle="tab" href="#keluar" role="tab">Paket Keluar</a>
                    </li>
                </ul>

                <div class="tab-content" id="paketTabContent">
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
                                        <th>Aksi</th>
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
                                        <th>Aksi</th>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            var tableMasuk = $('#PaketMasukTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('paket.list') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: 'Belum Diambil'
                    }
                },
                columns: getColumnsConfig()
            });

            var tableKeluar = $('#PaketKeluarTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('paket.list') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: 'Diambil'
                    }
                },
                columns: getColumnsConfig()
            });

            function getColumnsConfig() {
                return [{
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
                    },
                    {
                        data: 'id_paket',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let editUrl = `/transaksi-management/paket/${data}/edit`;
                            let showUrl = `/transaksi-management/paket/${data}`;
                            return `
                        <a href="${editUrl}" class="btn icon btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <a href="${showUrl}" class="btn icon btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')"><i class="bi bi-trash"></i></button>
                    `;
                        }
                    }
                ];
            }

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = `/transaksi-management/paket/${id}`;
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dihapus!',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                                $('#PaketTable').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message || 'Terjadi kesalahan.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Tidak dapat menghubungi server.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
