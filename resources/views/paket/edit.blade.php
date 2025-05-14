@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Paket</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('paket.index') }}"
                            class="{{ request()->routeIs('paket.index') ? 'active' : '' }}">Paket</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('paket.edit', $paket->id_paket) }}"
                            class="{{ request()->routeIs('paket.edit') ? 'active' : '' }}">Edit Paket</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('paket.update', $paket->id_paket) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Paket -->
                    <div class="form-group">
                        <label for="nama_paket">Nama Paket:</label>
                        <input type="text" name="nama_paket" id="nama_paket"
                            class="form-control @error('nama_paket') is-invalid @enderror"
                            value="{{ old('nama_paket', $paket->nama_paket) }}" placeholder="Contoh: Paket Makanan">
                        @error('nama_paket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Diterima -->
                    <div class="form-group">
                        <label for="tanggal_diterima">Tanggal Diterima:</label>
                        <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                            class="form-control @error('tanggal_diterima') is-invalid @enderror"
                            value="{{ old('tanggal_diterima', $paket->tanggal_diterima) }}">
                        @error('tanggal_diterima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori Paket -->
                    <div class="form-group">
                        <label for="id_kategori">Kategori Paket:</label>
                        <select name="id_kategori" id="id_kategori"
                            class="form-control @error('id_kategori') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoriPakets as $kategori)
                                <option value="{{ $kategori->id_kategori }}"
                                    {{ old('id_kategori', $paket->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Penerima Paket -->
                    <div class="form-group">
                        <label for="penerima_paket">Penerima Paket:</label>
                        <select name="penerima_paket" id="penerima_paket"
                            class="form-control @error('penerima_paket') is-invalid @enderror">
                            <option value="">-- Pilih Santri --</option>

                            @foreach ($groupedSantris as $namaAsrama => $group)
                                <optgroup label="{{ $namaAsrama }}">
                                    @foreach ($group as $santri)
                                        <option value="{{ $santri->nis }}"
                                            {{ old('penerima_paket', $paket->penerima_paket) == $santri->nis ? 'selected' : '' }}>
                                            {{ $santri->nis }} - {{ $santri->nama_santri }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('penerima_paket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pengirim Paket -->
                    <div class="form-group">
                        <label for="pengirim_paket">Pengirim Paket:</label>
                        <input type="text" name="pengirim_paket" id="pengirim_paket"
                            class="form-control @error('pengirim_paket') is-invalid @enderror"
                            value="{{ old('pengirim_paket', $paket->pengirim_paket) }}" placeholder="Contoh: Orang Tua">
                        @error('pengirim_paket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Isi Paket yang Disita -->
                    <div class="form-group">
                        <label for="isi_paket_yang_disita">Isi Paket yang Disita (jika ada):</label>
                        <input type="text" name="isi_paket_yang_disita" id="isi_paket_yang_disita"
                            class="form-control @error('isi_paket_yang_disita') is-invalid @enderror"
                            value="{{ old('isi_paket_yang_disita', $paket->isi_paket_yang_disita) }}"
                            placeholder="Contoh: Camilan, Uang">
                        @error('isi_paket_yang_disita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Paket -->
                    <div class="form-group">
                        <label for="status_paket">Status Paket:</label>
                        <select name="status_paket" id="status_paket"
                            class="form-control @error('status_paket') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            <option value="Belum Diambil"
                                {{ old('status_paket', $paket->status_paket) == 'Belum Diambil' ? 'selected' : '' }}>
                                Belum Diambil</option>
                            <option value="Diambil"
                                {{ old('status_paket', $paket->status_paket) == 'Diambil' ? 'selected' : '' }}>
                                Diambil</option>
                        </select>
                        @error('status_paket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('paket.index') }}">Cancel</a>
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
