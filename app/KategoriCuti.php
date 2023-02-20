<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriCuti extends Model
{
    protected $table = 'kategori_cuti';
    protected $primaryKey = 'id';

    public function tipeCuti()
    {
      return $this->hasMany('App\CutiKaryawan', 'jenis_cuti');
    }
}
