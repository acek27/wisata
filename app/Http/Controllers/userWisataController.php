<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use App\User;
use App\wisata;
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
        $wisata = wisata::join('users', 'wisata.id_user', '=', 'users.id')->get();
        $data = dataPengunjung::select(
            DB::raw('YEAR(tanggal_dataPengunjung) as tahun'), 'id_pengunjung',
            DB::raw('MONTH(tanggal_dataPengunjung) as bulan'), 'id_pengunjung',
            DB::raw('sum(jumlah_dataPengunjung) as jumlah'))
            ->where(DB::raw('YEAR(tanggal_dataPengunjung)'), '=', DB::raw('YEAR(current_date())'))
            ->groupby(DB::raw('YEAR(tanggal_dataPengunjung)'))
            ->groupby(DB::raw('MONTH(tanggal_dataPengunjung)'))
            ->groupby('id_pengunjung')
            ->get();
        return view('user.homeUser', compact('data', 'wisata'));
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
//        return response()->json($data);
        return view('user.detailWisata', compact('data', 'wisata'));
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
