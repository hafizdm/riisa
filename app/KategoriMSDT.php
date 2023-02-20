<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriMSDT extends Model
{
    protected $table ="kategori_msdt";
    protected $primaryKey ='id';

    protected $fillable = [
        'nama_kategori',
        ];

    public function getNamaKategoriA_MSDT()
    {
      return $this->hasMany('App\StatementMSDT', 'id_kategoriA');
    }

    public function getNamaKategoriB_MSDT()
    {
      return $this->hasMany('App\StatementMSDT', 'id_kategoriB');
    }
}
