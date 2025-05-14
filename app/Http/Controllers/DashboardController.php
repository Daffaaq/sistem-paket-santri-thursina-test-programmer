<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $semuaPaket = Paket::with('kategoriPaket', 'penerimaPaket')->orderBy('tanggal_diterima', 'desc')->get();
        $jumlahBelumDiambil = Paket::where('status_paket', 'Belum Diambil')->count();
        $jumlahDisita = Paket::whereNotNull('isi_paket_yang_disita')->where('isi_paket_yang_disita', '!=', '')->count();

        // Harian - 7 hari terakhir
        $harian = Paket::select(DB::raw('DATE(tanggal_diterima) as label'), DB::raw('count(*) as total'))
            ->where('tanggal_diterima', '>=', Carbon::now()->subDays(6))
            ->groupBy('label')->orderBy('label')->get();

        $labelsHarian = [];
        $dataHarian = [];
        $day = Carbon::now()->subDays(6);
        while ($day <= Carbon::now()) {
            $label = $day->format('d M');
            $labelsHarian[] = $label;
            $dataHarian[] = $harian->firstWhere('label', $day->format('Y-m-d'))->total ?? 0;
            $day->addDay();
        }

        // Mingguan - 4 minggu terakhir
        $labelsMingguan = [];
        $dataMingguan = [];
        for ($i = 3; $i >= 0; $i--) {
            $start = Carbon::now()->startOfWeek()->subWeeks($i);
            $end = $start->copy()->endOfWeek();

            $labelsMingguan[] = $start->format('d M') . ' - ' . $end->format('d M');
            $dataMingguan[] = Paket::whereBetween('tanggal_diterima', [$start, $end])->count();
        }

        // Bulanan - 12 bulan terakhir
        $labelsBulanan = [];
        $dataBulanan = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $start = $month->copy()->startOfMonth();
            $end = $month->copy()->endOfMonth();

            $labelsBulanan[] = $month->format('M Y');
            $dataBulanan[] = Paket::whereBetween('tanggal_diterima', [$start, $end])->count();
        }

        // Tahunan - 5 tahun terakhir
        $labelsTahunan = [];
        $dataTahunan = [];
        for ($i = 4; $i >= 0; $i--) {
            $year = Carbon::now()->subYears($i);
            $start = $year->copy()->startOfYear();
            $end = $year->copy()->endOfYear();

            $labelsTahunan[] = $year->format('Y');
            $dataTahunan[] = Paket::whereBetween('tanggal_diterima', [$start, $end])->count();
        }

        $kategoriData = Paket::select('id_kategori', DB::raw('count(*) as total'))
            ->groupBy('id_kategori')
            ->with('kategoriPaket')
            ->get()
            ->filter(function ($paket) {
                return $paket->kategoriPaket !== null;
            })
            ->map(function ($paket) {
                return [
                    'label' => $paket->kategoriPaket->nama_kategori,
                    'total' => $paket->total,
                ];
            });

        $kategoriLabels = $kategoriData->pluck('label');
        $kategoriTotals = $kategoriData->pluck('total');


        // dd($labelsHarian, $dataHarian, $labelsMingguan, $dataMingguan, $labelsBulanan, $dataBulanan, $labelsTahunan, $dataTahunan);

        return view('home', compact(
            'semuaPaket',
            'jumlahBelumDiambil',
            'jumlahDisita',
            'labelsHarian',
            'dataHarian',
            'labelsMingguan',
            'dataMingguan',
            'labelsBulanan',
            'dataBulanan',
            'labelsTahunan',
            'dataTahunan',
            'kategoriLabels',
            'kategoriTotals',
        ));
    }
}
