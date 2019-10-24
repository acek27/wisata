<?php

namespace App\Http\Controllers;

use App\wisata;
use Illuminate\Http\Request;

class wisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/profilwisata');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createwisata');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
//            'uang' => 'numeric|required',
//            'beras' => 'nullable|numeric',
//            'gula' => 'nullable|numeric'
        ]);
        $add = new wisata();
        $add->nama_tamu = $request->get('nama');
        $add->alamat = $request->get('alamat');
        $add->uang = $request->get('uang');
        $add->beras = $request->get('beras');
        $add->gula = $request->get('gula');
        $add->lain = $request->get('lain');
        $add->id_ket = $request->get('keterangan');
        $add->id_user = Auth::user()->id;
        $add->save();
        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah tamu : $request->nama"
        ]);
        return redirect('/user/userData');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
