<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengunjung extends Model
{
    protected $table = 'pengunjung';
    public $timestamps = false;
    protected $fillable = ['status_pengunjung'];

    public function dataPengunjung()
    {
        return $this->hasMany(pengunjung::class, 'id_pengunjung', 'id_pengunjung');
    }
}
