<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class negara extends Model
{
    protected $table = 'negara';
    public $timestamps = false;
    protected $fillable = ['negara_nama'];

    public function provinsi()
    {
        return $this->hasMany(provinsi::class, 'id_negara', 'id');
    }
}
