<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriMBTI extends Model
{
    protected $table ="kategori_mbti";
    protected $primaryKey ='id';

    protected $fillable = [
        'nama_kategori',
        ];

    public function getNamaKategoriMBTI_A()
    {
      return $this->hasMany('App\StatementMBTI', 'id_kategoriA');
    }

    public function getNamaKategoriMBTI_B()
    {
      return $this->hasMany('App\StatementMBTI', 'id_kategoriB');
    }
}
