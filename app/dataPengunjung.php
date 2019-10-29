<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataPengunjung extends Model
{
    protected $table = 'datapengunjung';
    protected $primaryKey = 'id_dataPengunjung';
    public $timestamps = false;
    protected $fillable = ['jumlah_dataPengunjung','tanggal_dataPengunjung','id_negara','id_kabupaten','id_pengunjung','id_user'];

    public function pengunjung()
    {
        return $this->belongsTo('App\pengunjung','id_pengunjung','id_pengunjung');
    }
}
