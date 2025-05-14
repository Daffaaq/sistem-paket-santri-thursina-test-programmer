@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detail Paket</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('paket.index') }}" class="{{ request()->routeIs('paket.index') ? 'active' : '' }}">
                            Paket Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('paket.show', $paket->id_paket) }}"
                            class="{{ request()->routeIs('paket.show', $paket->id_paket) ? 'active' : '' }}">
                            Detail Paket
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Table to display the paket details -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Paket</th>
                            <td>{{ $paket->nama_paket }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Diterima</th>
                            <td>{{ \Carbon\Carbon::parse($paket->tanggal_diterima)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Kategori Paket</th>
                            <td>{{ $paket->kategoriPaket->nama_kategori }}</td>
                        </tr>
                        <tr>
                            <th>Penerima Paket</th>
                            <td>{{ $paket->penerimaPaket->nama_santri }}</td>
                        </tr>
                        <tr>
                            <th>Pengirim Paket</th>
                            <td>{{ $paket->pengirim_paket }}</td>
                        </tr>
                        <tr>
                            <th>Isi Paket yang Disita</th>
                            <td>{{ $paket->isi_paket_yang_disita }}</td>
                        </tr>
                        <tr>
                            <th>Status Paket</th>
                            <td id="status-paket">{{ $paket->status_paket }}</td>
                        </tr>
                    </table>
                </div>

                <div class="row">
                    <!-- Tombol Back -->
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <a class="btn btn-secondary w-100" href="{{ route('paket.index') }}">Kembali</a>
                    </div>

                    <!-- Tombol Edit Isi Disita -->
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <a href="{{ route('paket.disita.edit', $paket->id_paket) }}" class="btn btn-info w-100">
                            Edit Isi Paket yang Disita
                        </a>
                    </div>

                    <!-- Tombol Update Status -->
                    <div class="col-12 col-md-4">
                        @if ($paket->status_paket == 'Belum Diambil')
                            <button class="btn btn-success w-100" id="update-status" data-status="Diambil">Paket
                                Diambil</button>
                        @elseif($paket->status_paket == 'Diambil')
                            <button class="btn btn-warning w-100" id="update-status" data-status="Belum Diambil">Paket Belum
                                Diambil</button>
                        @endif
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#update-status').on('click', function() {
                var status = $(this).data('status');
                var paketId = "{{ $paket->id_paket }}"; // ID paket yang sedang dilihat

                // Menyesuaikan teks konfirmasi berdasarkan status yang ingin diubah
                var statusText = status === 'Diambil' ? 'Diambil' : 'Belum Diambil';

                // SweetAlert konfirmasi sebelum melakukan update status
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan mengubah status paket ini menjadi " + statusText +
                        ".", // Menampilkan status yang ingin diubah
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah status!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/transaksi-management/paket/' + paketId + '/status/' +
                                status, // URL untuk mengupdate status
                            method: 'PATCH',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Menampilkan pesan toast sukses
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });

                                    // Update status di halaman
                                    $('#status-paket').text(response.message);

                                    // Ganti status tombol untuk aksi selanjutnya
                                    if (status === 'Diambil') {
                                        $('#update-status').text('Belum Diambil');
                                        $('#update-status').data('status',
                                            'Belum Diambil');
                                        // Ganti kelas tombol sesuai status
                                        $('#update-status').removeClass('btn-success')
                                            .addClass('btn-warning');
                                    } else {
                                        $('#update-status').text('Diambil');
                                        $('#update-status').data('status', 'Diambil');
                                        // Ganti kelas tombol sesuai status
                                        $('#update-status').removeClass('btn-warning')
                                            .addClass('btn-success');
                                    }
                                } else {
                                    Swal.fire('Gagal', response.message, 'error');
                                }
                            },
                            error: function() {
                                Swal.fire('Terjadi kesalahan', 'Coba lagi nanti',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush

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
