<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsramaRequest;
use App\Http\Requests\UpdateAsramaRequest;
use App\Models\Asrama;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AsramaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:asrama.index')->only('index', 'list');
        $this->middleware('permission:asrama.create')->only('create', 'store');
        $this->middleware('permission:asrama.edit')->only('edit', 'update');
        $this->middleware('permission:asrama.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $asrama = Asrama::select(['id_asrama', 'nama_asrama', 'gedung']);
            return DataTables::of($asrama)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('asrama.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asrama.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsramaRequest $request)
    {
        Asrama::create($request->validated());

        return redirect()->route('asrama.index')->with('success', 'Asrama berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asrama $asrama)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asrama $asrama)
    {
        return view('asrama.edit', compact('asrama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsramaRequest $request, Asrama $asrama)
    {
        $asrama->update($request->validated());

        return redirect()->route('asrama.index')->with('success', 'Asrama berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asrama $asrama)
    {
        try {
            $asrama->delete();
            return response()->json(['success' => true, 'message' => 'Asrama berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus asrama']);
        }
    }
}
