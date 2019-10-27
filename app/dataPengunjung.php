<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataPengunjung extends Model
{
    protected $table = 'datapengunjung';
    public $timestamps = false;
    protected $fillable = ['jumlah_dataPengunjung','tanggal_dataPengunjung','id_pengunjung'];

    public function pengunjung()
    {
        return $this->belongsTo('App\dataPengunjung','id_pengunjung','id_pengunjung');
    }
}
