@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detail Santri</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('santri.index') }}"
                            class="{{ request()->routeIs('santri.index') ? 'active' : '' }}">
                            Santri Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('santri.show', $santri->nis) }}"
                            class="{{ request()->routeIs('santri.show', $santri->nis) ? 'active' : '' }}">Detail Santri</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Table to display the santri details -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>NIS</th>
                            <td>{{ $santri->nis }}</td>
                        </tr>
                        <tr>
                            <th>Nama Santri</th>
                            <td>{{ $santri->nama_santri }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $santri->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Asrama</th>
                            <td>{{ $asrama->nama_asrama }}</td>
                        </tr>
                        <tr>
                            <th>Total Paket Diterima</th>
                            <td>{{ $santri->total_paket_diterima }}</td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <!-- Tombol Back -->
                    <a class="btn btn-secondary" href="{{ route('santri.index') }}">Kembali</a>

                    <!-- Tombol untuk Export PDF -->
                    <a href="{{ route('santri.exportPdf', $santri->nis) }}" class="btn btn-sm btn-danger shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Download PDF
                    </a>
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
