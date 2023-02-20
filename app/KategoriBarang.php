<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    //
    protected $table ="kategori_barang";
    protected $fillable =['nama_kategori','kode_kategori'];
    protected $primaryKey ='id';

    public function databarang()
    {
        return $this->hasMany('App\Barang','kode_barang');
    }

    public function masterKategori()
    {
      return $this->hasMany('App\RequestBarang', 'kode_barang');
    }

    // public function dtbrg()
    // {
    //     return $this->hasMany('App\Barang','kode_barang','kode_kategori');
    // }


}



