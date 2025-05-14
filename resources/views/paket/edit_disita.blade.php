@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Isi Paket yang Disita</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('paket.disita.update', $paket->id_paket) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="isi_paket_yang_disita">Isi Paket yang Disita</label>
                        <textarea name="isi_paket_yang_disita" id="isi_paket_yang_disita" rows="3"
                            class="form-control @error('isi_paket_yang_disita') is-invalid @enderror">{{ old('isi_paket_yang_disita', $paket->isi_paket_yang_disita) }}</textarea>
                        @error('isi_paket_yang_disita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <a href="{{ route('paket.show', $paket->id_paket) }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
