@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Asrama Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('asrama.index') }}"
                            class="{{ request()->routeIs('asrama.index') ? 'active' : '' }}">Asrama</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('asrama.create') }}"
                            class="{{ request()->routeIs('asrama.create') ? 'active' : '' }}">Create Asrama</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('asrama.store') }}">
                    @csrf

                    <!-- Nama Asrama -->
                    <div class="form-group">
                        <label for="nama_asrama">Nama Asrama:</label>
                        <input type="text" name="nama_asrama" id="nama_asrama" placeholder="Contoh: Al-Azhar"
                            class="form-control @error('nama_asrama') is-invalid @enderror"
                            value="{{ old('nama_asrama') }}">
                        @error('nama_asrama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Gedung -->
                    <div class="form-group">
                        <label for="gedung">Gedung:</label>
                        <input type="text" name="gedung" id="gedung" placeholder="Contoh: Gedung Putri"
                            class="form-control @error('gedung') is-invalid @enderror" value="{{ old('gedung') }}">
                        @error('gedung')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('asrama.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
