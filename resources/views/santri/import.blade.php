@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Import Santri</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('santri.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Dropdown Pilih Asrama -->
                    <div class="form-group">
                        <label for="id_asrama">Pilih Asrama:</label>
                        <select name="id_asrama" id="id_asrama"
                            class="form-control @error('id_asrama') is-invalid @enderror" required>
                            <option value="">-- Pilih Asrama --</option>
                            @foreach ($asramas as $asrama)
                                <option value="{{ $asrama->id_asrama }}">{{ $asrama->nama_asrama }} - {{ $asrama->gedung }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_asrama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- File Excel -->
                    <div class="form-group">
                        <label for="file">Import File Excel:</label>
                        <input type="file" name="file" class="form-control" required accept=".xlsx,.xls">
                    </div>
                    <a href="{{ route('santri.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
            </div>
        </div>
    </div>
@endsection
