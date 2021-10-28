<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinces';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function negara()
    {
        return $this->belongsTo('App\negara','id_negara','id');
    }
    public function kabupaten()
    {
        return $this->hasMany(kabupaten::class, 'province_id', 'id');
    }
}
