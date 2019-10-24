<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wisata extends Model
{
    protected $table = 'wisata';
    public $timestamps = false;
    protected $fillable = ['jumlah_dataPengunjung','tanggal_dataPengunjung','id_pengunjung'];
}
