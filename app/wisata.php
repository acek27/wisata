<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wisata extends Model
{
    protected $table = 'wisata';
    public $timestamps = false;
    protected $fillable = ['alamat','deskripsi','facebook','twitter','instagram','gambar','id_user'];

    public function User()
    {
        return $this->hasMany(User::class, 'id_user', 'id');
    }
}
