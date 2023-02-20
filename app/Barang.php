<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table ="barang";
    // protected $fillable =['nama_barang'];
    protected $primaryKey ='id_barang';

    public function databarang()
    {
      return $this->belongsTo('App\KategoriBarang', 'kode_barang');
    }
    
    public function jenisbarang()
    {
      return $this->belongsTo('App\JenisBarang', 'jenis_barang');
    }

}
