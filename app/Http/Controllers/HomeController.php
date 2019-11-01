<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use http\Env\Response;
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

            $re = [[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
            foreach ($data as $key => $value) {
                $re[$value->id_pengunjung - 1][$value->bulan - 1] = $value->jumlah;
            }
            $data1 = implode(', ', $re[0]);
            $data2 = implode(', ', $re[1]);
            return view('home', compact('data1','data2'));
        } elseif (\Auth::user()->can('adminwisata') == 2) {
            return redirect()->route('adminWisata.index');
        }
    }
}
