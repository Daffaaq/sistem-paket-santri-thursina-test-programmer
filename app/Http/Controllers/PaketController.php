<?php

namespace App\Http\Controllers;

use App\Exports\PaketKeluarExport;
use App\Exports\PaketMasukExport;
use App\Http\Requests\StorePaketRequest;
use App\Http\Requests\UpdatePaketRequest;
use App\Models\KategoriPaket;
use App\Models\Paket;
use App\Models\Santri;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:paket.index')->only('index', 'list');
        $this->middleware('permission:paket.create')->only('create', 'store');
        $this->middleware('permission:paket.edit')->only('edit', 'update');
        $this->middleware('permission:paket.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $pakets = Paket::with(['kategoriPaket', 'penerimaPaket'])
                ->when($request->status, function ($query) use ($request) {
                    $query->where('status_paket', $request->status);
                })
                ->select('id_paket', 'nama_paket', 'tanggal_diterima', 'id_kategori', 'penerima_paket', 'pengirim_paket', 'status_paket');

            return DataTables::of($pakets)
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('paket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriPakets = KategoriPaket::select('id_kategori', 'nama_kategori')->get();
        $santris = Santri::with('asrama')->select('nis', 'nama_santri', 'id_asrama')->get();

        // Grouping the santris by asrama name
        $groupedSantris = $santris->groupBy(function ($santri) {
            return $santri->asrama->nama_asrama ?? 'Tanpa Asrama';
        });

        return view('paket.create', compact('kategoriPakets', 'groupedSantris'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaketRequest $request)
    {
        Paket::create($request->validated());

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        // show detail paket
        // Eager load relasi 'kategoriPaket' dan 'santri'
        $paket->load('kategoriPaket', 'penerimaPaket');

        // Kembalikan tampilan dengan data paket
        return view('paket.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        $kategoriPakets = KategoriPaket::select('id_kategori', 'nama_kategori')->get();
        $santris = Santri::with('asrama')->select('nis', 'nama_santri', 'id_asrama')->get();

        // Grouping the santris by asrama name
        $groupedSantris = $santris->groupBy(function ($santri) {
            return $santri->asrama->nama_asrama ?? 'Tanpa Asrama';
        });

        return view('paket.edit', compact('paket', 'kategoriPakets', 'groupedSantris'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaketRequest $request, Paket $paket)
    {
        $paket->update($request->validated());

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        try {
            $paket->delete();
            return response()->json(['success' => true, 'message' => 'Paket berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus paket']);
        }
    }

    public function updateStatus($id_paket, $status)
    {
        // Validasi status yang diterima
        if (!in_array($status, ['Diambil', 'Belum Diambil'])) {
            return response()->json([
                'success' => false,
                'message' => 'Status tidak valid!'
            ], 400); // HTTP 400 Bad Request
        }

        // Mencari paket berdasarkan ID
        $paket = Paket::find($id_paket);

        if (!$paket) {
            return response()->json([
                'success' => false,
                'message' => 'Paket tidak ditemukan!'
            ], 404); // HTTP 404 Not Found
        }

        // Update status
        $paket->status_paket = $status;
        $paket->save();

        // Tentukan pesan berdasarkan status yang diperbarui
        $message = $status == 'Diambil' ? 'Paket sudah diambil' : 'Paket belum diambil';

        // Return JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => $message, // Pesan sesuai status yang diperbarui
            'data' => $paket // Optional: you can return the updated package data
        ], 200); // HTTP 200 OK
    }

    public function editDisita($id_paket)
    {
        $paket = Paket::findOrFail($id_paket);
        return view('paket.edit_disita', compact('paket'));
    }

    // Proses update isi paket yang disita
    public function updateDisita(Request $request, $id_paket)
    {
        $request->validate([
            'isi_paket_yang_disita' => 'nullable|string|max:200',
        ]);

        $paket = Paket::findOrFail($id_paket);
        $paket->isi_paket_yang_disita = $request->isi_paket_yang_disita;
        $paket->save();

        return redirect()->route('paket.show', $paket->id_paket)->with('success', 'Isi paket yang disita berhasil diperbarui.');
    }

    public function exportPaketMasuk()
    {
        return Excel::download(new PaketMasukExport, 'paket_masuk.xlsx');
    }

    // Export Paket Keluar
    public function exportPaketKeluar()
    {
        return Excel::download(new PaketKeluarExport, 'paket_keluar.xlsx');
    }
}
