<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use App\wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class adminWisataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = dataPengunjung::select(
            DB::raw('YEAR(tanggal_dataPengunjung) as tahun'), 'id_pengunjung',
            DB::raw('MONTH(tanggal_dataPengunjung) as bulan'), 'id_pengunjung',
            DB::raw('sum(jumlah_dataPengunjung) as jumlah'))
            ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'))
            ->where('id_user', '=', Auth::user()->id)
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
        return view('adminWisata.homeWisata', compact('data1', 'data2'));
    }

    public function generatePDF()

    {
        $data = dataPengunjung::select('id_dataPengunjung', 'jumlah_dataPengunjung',
            'tanggal_dataPengunjung', 'status_pengunjung', 'users.name as nama_wisata',
            DB::raw('CONCAT_WS(" ",regencies.name, " ", negara_nama) AS asal'))
            ->join('pengunjung', 'datapengunjung.id_pengunjung', '=', 'pengunjung.id_pengunjung')
            ->join('negara', 'datapengunjung.id_negara', '=', 'negara.id')
            ->leftjoin('regencies', 'datapengunjung.id_kabupaten', '=', 'regencies.id')
            ->join('users', 'datapengunjung.id_user', '=', 'users.id')
            ->where('id_user', '=', Auth::user()->id)
            ->get();
        $pdf = PDF::loadView('myPDF', compact('data'));
        return $pdf->stream('Laporan-Pengunjung-'.Auth::user()->name. date('Y'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
