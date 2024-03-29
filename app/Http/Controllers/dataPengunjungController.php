<?php

namespace App\Http\Controllers;

use App\dataPengunjung;
use App\kabupaten;
use App\negara;
use App\pengunjung;
use App\Provinsi;
use App\User;
use App\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class dataPengunjungController extends Controller
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

        return view('admin.dataPengunjung');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = date('Y-m-d');
        $negara = negara::all();
        $provinsi = Provinsi::all();
        return view('adminWisata.inputPengunjung', compact('date', 'negara', 'provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengunjung = $request->get('pengunjung');
        if ($pengunjung == 1) {
            dataPengunjung::create([
                'jumlah_dataPengunjung' => $request['jumlah'],
                'tanggal_dataPengunjung' => $request['tgl'],
                'id_negara' => 102,
                'id_kabupaten' => $request['kabupaten'],
                'id_pengunjung' => $request['pengunjung'],
                'id_user' => Auth::user()->id,
            ]);
        } elseif ($pengunjung == 2) {
            dataPengunjung::create([
                'jumlah_dataPengunjung' => $request['jumlah'],
                'tanggal_dataPengunjung' => $request['tgl'],
                'id_negara' => $request['negara'],
                'id_pengunjung' => $request['pengunjung'],
                'id_user' => Auth::user()->id,
            ]);
        }

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menambah Pengunjung"
        ]);
        return redirect()->route('adminWisata.index');
    }

    public function dataProvinsi($id)
    {
        $data = kabupaten::where('province_id', '=', $id)->get();
        return response()->json($data);
    }

    public function tabelPengunjung()
    {
        return DataTables::of(dataPengunjung::select('id_dataPengunjung', 'jumlah_dataPengunjung',
            'tanggal_dataPengunjung', 'status_pengunjung', 'users.name as nama_wisata', DB::raw('CONCAT_WS(" ",regencies.name, " - ", negara_nama) AS asal'))
            ->join('pengunjung', 'datapengunjung.id_pengunjung', '=', 'pengunjung.id_pengunjung')
            ->join('negara', 'datapengunjung.id_negara', '=', 'negara.id')
            ->leftjoin('regencies', 'datapengunjung.id_kabupaten', '=', 'regencies.id')
            ->join('users', 'datapengunjung.id_user', '=', 'users.id'))
            ->make(true);
    }

    public function tabelPengunjungWisata()
    {
        return DataTables::of(dataPengunjung::select('id_dataPengunjung', 'jumlah_dataPengunjung',
            'tanggal_dataPengunjung', 'status_pengunjung', 'users.name as nama_wisata',
            DB::raw('CONCAT_WS(" ",regencies.name, " ", negara_nama) AS asal'))
            ->join('users', 'users.id', '=', 'datapengunjung.id_user')
            ->join('pengunjung', 'datapengunjung.id_pengunjung', '=', 'pengunjung.id_pengunjung')
            ->join('negara', 'datapengunjung.id_negara', '=', 'negara.id')
            ->leftjoin('regencies', 'datapengunjung.id_kabupaten', '=', 'regencies.id')
            ->where('id_user', '=', Auth::user()->id))
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_dataPengunjung . '" class="hapus-data"><i class="now-ui-icons files_box"> delete</i></a>';
                $edit = '<a href="' . route('dataPengunjung.edit', $data->id_dataPengunjung) . '"><i class="now-ui-icons text_caps-small"> edit</i></a>';
                return $edit . '&nbsp' . '&nbsp' . $del;
            })
            ->make(true);
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
        $pengunjung = dataPengunjung::findOrFail($id);
        $status = pengunjung::all();
        $negara = negara::all();
        $provinsi = Provinsi::all();
        return view('adminWisata.editPengunjung', compact('pengunjung', 'provinsi','status','negara'));
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
        $pengunjung = $request->get('pengunjung');
        if ($pengunjung == 1) {
            dataPengunjung::where('id_dataPengunjung',$id)->update([
                'jumlah_dataPengunjung' => $request['jumlah'],
                'tanggal_dataPengunjung' => $request['tgl'],
                'id_negara' => 102,
                'id_kabupaten' => $request['kabupaten'],
                'id_pengunjung' => $request['pengunjung'],
                'id_user' => Auth::user()->id,
            ]);
        } elseif ($pengunjung == 2) {
            dataPengunjung::where('id_dataPengunjung',$id)->update([
                'jumlah_dataPengunjung' => $request['jumlah'],
                'tanggal_dataPengunjung' => $request['tgl'],
                'id_negara' => $request['negara'],
                'id_pengunjung' => $request['pengunjung'],
                'id_user' => Auth::user()->id,
            ]);
        }

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menambah Pengunjung"
        ]);
        return redirect()->route('adminWisata.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dataPengunjung::destroy($id);
    }
}
