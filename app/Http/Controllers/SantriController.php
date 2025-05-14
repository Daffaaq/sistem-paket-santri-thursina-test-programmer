<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSantriRequest;
use App\Http\Requests\UpdateSantriRequest;
use App\Models\Asrama;
use App\Models\Santri;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\SantriImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SantriExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SantriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:santri.index')->only('index', 'list');
        $this->middleware('permission:santri.create')->only('create', 'store');
        $this->middleware('permission:santri.edit')->only('edit', 'update');
        $this->middleware('permission:santri.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $santri = Santri::with('asrama')->select(['nis', 'nama_santri', 'id_asrama']);
            return DataTables::of($santri)
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('santri.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asrama = Asrama::select('id_asrama', 'nama_asrama', 'gedung')->get();
        return view('santri.create', compact('asrama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSantriRequest $request)
    {
        // Menyimpan data santri
        Santri::create($request->validated());

        return redirect()->route('santri.index')->with('success', 'Santri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Santri $santri)
    {
        // Ambil data santri beserta relasinya
        $asrama = $santri->asrama;  // Relasi dengan Asrama

        // Kirim data ke view
        return view('santri.show', compact('santri', 'asrama'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        $asrama = Asrama::select('id_asrama', 'nama_asrama', 'gedung')->get();
        return view('santri.edit', compact('santri', 'asrama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSantriRequest $request, Santri $santri)
    {
        // Mengupdate data santri
        $santri->update($request->validated());

        return redirect()->route('santri.index')->with('success', 'Santri berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Santri $santri)
    {
        try {
            // Menghapus santri
            $santri->delete();
            return response()->json(['success' => true, 'message' => 'Santri berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus santri']);
        }
    }

    public function showImportForm()
    {
        // Ambil semua asrama untuk ditampilkan di dropdown
        $asramas = Asrama::all();
        return view('santri.import', compact('asramas'));
    }

    public function import(Request $request)
    {
        // Validasi file dan Asrama yang dipilih
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'id_asrama' => 'required|exists:asramas,id_asrama' // Pastikan id_asrama valid
        ]);

        // Ambil Asrama yang dipilih
        $idAsrama = $request->input('id_asrama');

        // Impor data Excel
        $import = new SantriImport($idAsrama);
        Excel::import($import, $request->file('file'));

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil diimport!');
    }

    public function exportSantri()
    {
        return Excel::download(new SantriExport, 'data_santri.xlsx');
    }

    public function exportPdf(Santri $santri)
    {
        // Ambil data santri
        $asrama = $santri->asrama;  // Relasi dengan Asrama

        // Buat PDF dari view
        $pdf = PDF::loadView('santri.pdf', compact('santri', 'asrama'));

        // Tampilkan PDF untuk preview
        return $pdf->stream('santri_detail_' . $santri->nis . '.pdf');
    }
}
