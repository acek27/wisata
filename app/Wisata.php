<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $primaryKey = 'id_wisata';
    public $timestamps = false;
    protected $fillable = ['alamat','deskripsi','facebook','twitter','instagram','gambar','id_user'];

    public function User()
    {
        return $this->hasMany(User::class, 'id_user', 'id');
    }
}
