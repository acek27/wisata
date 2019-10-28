<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kabupaten extends Model
{
    protected $table = 'regencies';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function provinsi()
    {
        return $this->belongsTo('App\provinsi','province_id','id');
    }
}
