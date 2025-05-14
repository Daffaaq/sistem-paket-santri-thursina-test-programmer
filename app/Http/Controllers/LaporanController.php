<?php

namespace App\Http\Controllers;

use App\Models\KategoriPaket;
use App\Models\Paket;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:laporan.index')->only('index', 'list');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $pakets = Paket::with(['kategoriPaket', 'penerimaPaket'])
                ->select('id_paket', 'nama_paket', 'tanggal_diterima', 'id_kategori', 'penerima_paket', 'pengirim_paket', 'status_paket', 'isi_paket_yang_disita');

            // Filter berdasarkan status
            if ($request->status === 'disita') {
                $pakets->whereNotNull('isi_paket_yang_disita')->where('isi_paket_yang_disita', '!=', '');
            } elseif ($request->status) {
                $pakets->where('status_paket', $request->status);
            }

            // Filter berdasarkan kategori
            if ($request->kategori) {
                $pakets->where('id_kategori', $request->kategori);
            }

            // Filter berdasarkan rentang tanggal
            if ($request->filled('from') && $request->filled('to')) {
                $pakets->whereBetween('tanggal_diterima', [$request->from, $request->to]);
            }

            return DataTables::of($pakets)
                ->addIndexColumn()
                ->make(true);
        }
    }


    public function index()
    {
        // Mengambil kategori paket untuk filter
        $kategoriPaket = KategoriPaket::select('id_kategori', 'nama_kategori')->get();
        return view('laporan.index', compact('kategoriPaket'));
    }
}
