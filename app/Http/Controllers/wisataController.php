<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use App\User;
use App\wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class wisataController extends Controller
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
        $wisata = wisata::join('users', 'wisata.id_user', '=', 'users.id')
            ->where('users.id', '!=', '1')->get();
        return view('admin.profilwisata', compact('wisata'));
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

    public function tabelwisata()
    {
        return DataTables::of(wisata::leftjoin('users', 'wisata.id_user', '=', 'users.id')
            ->where('users.id', '!=', '1'))
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_user . '" class="hapus-data" style="font-size: 15px"><i class="now-ui-icons files_box"></i> Delete</a>';
                $edit = '<a href="' . route('wisata.edit', $data->id) . '" style="font-size: 15px"><i class="now-ui-icons text_caps-small"></i> Edit</a>';
                return $edit . '&nbsp' . ' | ' . '&nbsp' . $del;
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role_id' => 2,
            'password' => Hash::make($request['password']),
        ]);
        $nama = $request->get('name');
        $email = $request->get('email');
        $cekid = User::where('name', $nama)->where('email', $email);
        $id = User::where('name', $nama)->where('email', $email)->value('id');
        if ($cekid->exists()) {
            $gambar = $request->file('gambar');
            $new_name = rand() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path("images"), $new_name);
            wisata::create([
                'alamat' => $request['alamat'],
                'deskripsi' => $request['deskripsi'],
                'facebook' => $request['fb'],
                'twitter' => $request['tw'],
                'instagram' => $request['ig'],
                'gambar' => $new_name,
                'id_user' => $id,
            ]);
            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil Menambah Wisata"
            ]);
        } else {
            \Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "gagal"
            ]);
        }

        return redirect()->route('wisata.index');
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
        $data = wisata::join('users', 'wisata.id_user', '=', 'users.id')->first();
//        return response()->json($data);
        return view('admin.editwisata', compact('data'));

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
        User::where('id', '=', $id)
            ->update([
                'name' => $request['name'],
                'email' => $request['email'],
            ]);

        $gambar = $request->file('gambar');
        $new_name = rand() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path("images"), $new_name);

        wisata::where('id_user', '=', $id)
            ->update([
                'alamat' => $request['alamat'],
                'deskripsi' => $request['deskripsi'],
                'facebook' => $request['fb'],
                'twitter' => $request['tw'],
                'instagram' => $request['ig'],
                'gambar' => $new_name,
            ]);
        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data Berhasil Diupdate!"
        ]);
        return redirect()->route('wisata.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}
