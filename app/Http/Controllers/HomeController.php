<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use App\User;
use App\wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (\Auth::user()->can('admin') == 1) {
            $data = dataPengunjung::select(
                DB::raw('YEAR(tanggal_dataPengunjung) as tahun'), 'id_pengunjung',
                DB::raw('MONTH(tanggal_dataPengunjung) as bulan'), 'id_pengunjung',
                DB::raw('sum(jumlah_dataPengunjung) as jumlah'))
                ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'))
                ->groupby(DB::raw('YEAR(tanggal_dataPengunjung)'))
                ->groupby(DB::raw('MONTH(tanggal_dataPengunjung)'))
                ->groupby('id_pengunjung')
                ->get();

            $re = [[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
            foreach ($data as $key => $value) {
                $re[$value->id_pengunjung - 1][$value->bulan - 1] = $value->jumlah;
            }
            $data1 = implode(', ', $re[0]);
            $data2 = implode(', ', $re[1]);
            $wisata = User::where('id', '!=', 1)->get();
            return view('home', compact('data1', 'data2', 'wisata'));
        } elseif (\Auth::user()->can('adminwisata') == 2) {
            return redirect()->route('adminWisata.index');
        }
    }

    public function generatePDF($year)
    {
        $cek = dataPengunjung::where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', $year);

        if ($cek->exists()) {
            $data = dataPengunjung::select('id_dataPengunjung', 'jumlah_dataPengunjung',
                'tanggal_dataPengunjung', 'status_pengunjung', 'users.name as nama_wisata',
                DB::raw('CONCAT_WS(" ",regencies.name, " - ", negara_nama) AS asal'))
                ->join('pengunjung', 'datapengunjung.id_pengunjung', '=', 'pengunjung.id_pengunjung')
                ->join('negara', 'datapengunjung.id_negara', '=', 'negara.id')
                ->leftjoin('regencies', 'datapengunjung.id_kabupaten', '=', 'regencies.id')
                ->join('users', 'datapengunjung.id_user', '=', 'users.id')
                ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', $year)
                ->get();;
            $pdf = PDF::loadView('myPDF', ['data' => $data]);
            return $pdf->stream('Laporan-Wisata-' . date('Y') . '.pdf');

        } else {
            return redirect()->back()->with('message', 'Data tidak ditemukan');
        }
    }

    public function generateByMonth($month)
    {
        $cek = dataPengunjung::where(DB::raw('MONTH(tanggal_dataPengunjung)'), '=', $month)
            ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'));
        if ($cek->exists()) {
            $data = dataPengunjung::select('id_dataPengunjung', 'jumlah_dataPengunjung',
                'tanggal_dataPengunjung', 'status_pengunjung', 'users.name as nama_wisata',
                DB::raw('CONCAT_WS(" ",regencies.name, " - ", negara_nama) AS asal'))
                ->join('pengunjung', 'datapengunjung.id_pengunjung', '=', 'pengunjung.id_pengunjung')
                ->join('negara', 'datapengunjung.id_negara', '=', 'negara.id')
                ->leftjoin('regencies', 'datapengunjung.id_kabupaten', '=', 'regencies.id')
                ->join('users', 'datapengunjung.id_user', '=', 'users.id')
                ->where(DB::raw('MONTH(tanggal_dataPengunjung)'), '=', $month)
                ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'))
                ->get();
            $pdf = PDF::loadView('myPDF', ['data' => $data]);
            return $pdf->stream('Laporan-Wisata-' . date('Y') . '.pdf');

        } else {
            return redirect()->back()->with('message', 'Tidak ada pengunjung di bulan ini');
        }
    }
    public function generateByName($name)
    {
        $cek = dataPengunjung::join('users', 'datapengunjung.id_user', '=', 'users.id')
            ->where('users.id','=',$name)
            ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'));

        if ($cek->exists()) {
            $data = dataPengunjung::select('id_dataPengunjung', 'jumlah_dataPengunjung',
                'tanggal_dataPengunjung', 'status_pengunjung', 'users.name as nama_wisata',
                DB::raw('CONCAT_WS(" ",regencies.name, " - ", negara_nama) AS asal'))
                ->join('pengunjung', 'datapengunjung.id_pengunjung', '=', 'pengunjung.id_pengunjung')
                ->join('negara', 'datapengunjung.id_negara', '=', 'negara.id')
                ->leftjoin('regencies', 'datapengunjung.id_kabupaten', '=', 'regencies.id')
                ->join('users', 'datapengunjung.id_user', '=', 'users.id')
                ->where('users.id','=',$name)
                ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'))
                ->get();
            $pdf = PDF::loadView('myPDF', ['data' => $data]);
            return $pdf->stream('Laporan-Wisata-' . date('Y') . '.pdf');

        } else {
            return redirect()->back()->with('message', 'Data tidak ditemukan');
        }
    }
}
