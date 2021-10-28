<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use App\User;
use App\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = date('Y');
        $wisata = Wisata::join('users', 'wisata.id_user', '=', 'users.id')->get();
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
        return view('user.homeUser', compact('data1', 'data2', 'wisata','tahun'));
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

    public function tahun($tahun){
        $wisata = Wisata::join('users', 'wisata.id_user', '=', 'users.id')->get();
        $data = dataPengunjung::select(
            DB::raw('YEAR(tanggal_dataPengunjung) as tahun'), 'id_pengunjung',
            DB::raw('MONTH(tanggal_dataPengunjung) as bulan'), 'id_pengunjung',
            DB::raw('sum(jumlah_dataPengunjung) as jumlah'))
            ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', $tahun)
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
        return view('user.homeUser', compact('data1', 'data2', 'wisata','tahun'));
    }

    public function show($id)
    {
        $data = dataPengunjung::select(
            DB::raw('YEAR(tanggal_dataPengunjung) as tahun'), 'id_pengunjung',
            DB::raw('MONTH(tanggal_dataPengunjung) as bulan'), 'id_pengunjung',
            DB::raw('sum(jumlah_dataPengunjung) as jumlah'))
            ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'))
            ->where('id_user', '=', $id)
            ->groupby(DB::raw('YEAR(tanggal_dataPengunjung)'))
            ->groupby(DB::raw('MONTH(tanggal_dataPengunjung)'))
            ->groupby('id_pengunjung')
            ->get();
        $wisata = User::join('wisata', 'wisata.id_user', '=', 'users.id')->where('id_user', '=', $id)->first();
        $re = [[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
        foreach ($data as $key => $value) {
            $re[$value->id_pengunjung - 1][$value->bulan - 1] = $value->jumlah;
        }
        $data1 = implode(', ', $re[0]);
        $data2 = implode(', ', $re[1]);
//        return response()->json($data);
        return view('user.detailWisata', compact('data1', 'data2', 'wisata'));
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
