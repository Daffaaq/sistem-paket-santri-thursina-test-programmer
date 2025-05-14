<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriPaketRequest;
use App\Http\Requests\UpdateKategoriPaketRequest;
use App\Models\KategoriPaket;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class KategoriPaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kategori-paket.index')->only('index', 'list');
        $this->middleware('permission:kategori-paket.create')->only('create', 'store');
        $this->middleware('permission:kategori-paket.edit')->only('edit', 'update');
        $this->middleware('permission:kategori-paket.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $kategoriPaket = KategoriPaket::select(['id_kategori', 'nama_kategori']);
            return DataTables::of($kategoriPaket)
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori-paket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori-paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriPaketRequest $request)
    {
        KategoriPaket::create($request->validated());

        return redirect()->route('kategori-paket.index')->with('success', 'Kategori Paket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriPaket $kategoriPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriPaket $kategoriPaket)
    {
        return view('kategori-paket.edit', compact('kategoriPaket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriPaketRequest $request, KategoriPaket $kategoriPaket)
    {
        $kategoriPaket->update($request->validated());

        return redirect()->route('kategori-paket.index')->with('success', 'Kategori Paket berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriPaket $kategoriPaket)
    {
        try {
            $kategoriPaket->delete();
            return response()->json(['success' => true, 'message' => 'Kategori Paket berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus kategori paket']);
        }
    }
}
