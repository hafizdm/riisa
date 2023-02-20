<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CutiKaryawan extends Model
{
    protected $table = 'cuti_karyawan';
    protected $primaryKey = 'id';

    public function tipeCuti()
    {
      return $this->belongsTo('App\KategoriCuti', 'jenis_cuti');
    } 

}
