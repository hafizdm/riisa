<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    //
    // use SoftDeletes;
    protected $table = 'master_jenis_barang';
    protected $primaryKey = 'id';

    public function jenisbarang()
    {
      return $this->hasMany('App\Barang', 'jenis_barang');
    }

    public function masterjenisbarang()
    {
      return $this->hasMany('App\RequestBarang', 'jenis_barang');
    }

    
    
}
