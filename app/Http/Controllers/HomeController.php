<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return view('home', compact('data'));
        } elseif (\Auth::user()->can('adminwisata') == 2) {
            return redirect()->route('adminWisata.index');
        }
    }
}
