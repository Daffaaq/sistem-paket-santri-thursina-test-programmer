@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Santri Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('santri.index') }}"
                            class="{{ request()->routeIs('santri.index') ? 'active' : '' }}">Santri</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('santri.edit', $santri->nis) }}"
                            class="{{ request()->routeIs('santri.edit') ? 'active' : '' }}">Edit Santri</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('santri.update', $santri->nis) }}">
                    @csrf
                    @method('PUT')

                    <!-- NIS -->
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror"
                            value="{{ old('nis', $santri->nis) }}">
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Santri -->
                    <div class="form-group">
                        <label for="nama_santri">Nama Santri:</label>
                        <input type="text" name="nama_santri" id="nama_santri"
                            class="form-control @error('nama_santri') is-invalid @enderror"
                            value="{{ old('nama_santri', $santri->nama_santri) }}">
                        @error('nama_santri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $santri->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Asrama -->
                    <div class="form-group">
                        <label for="id_asrama">Asrama:</label>
                        <select name="id_asrama" id="id_asrama"
                            class="form-control @error('id_asrama') is-invalid @enderror">
                            <option value="">-- Pilih Asrama --</option>
                            @foreach ($asrama as $item)
                                <option value="{{ $item->id_asrama }}"
                                    {{ old('id_asrama', $santri->id_asrama) == $item->id_asrama ? 'selected' : '' }}>
                                    {{ $item->nama_asrama }} - {{ $item->gedung }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_asrama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Total Paket Diterima -->
                    <div class="form-group">
                        <label for="total_paket_diterima">Total Paket Diterima:</label>
                        <input type="number" name="total_paket_diterima" id="total_paket_diterima"
                            class="form-control @error('total_paket_diterima') is-invalid @enderror"
                            value="{{ old('total_paket_diterima', $santri->total_paket_diterima) }}" min="0">
                        @error('total_paket_diterima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('santri.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
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
