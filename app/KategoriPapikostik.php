<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPapikostik extends Model
{
    protected $table ="kategori_papikostik";
    protected $primaryKey ='id';

    protected $fillable = [
        'nama_kategori',
        ];

    public function getNamaKategoriA()
    {
        return $this->hasMany('App\StatementPapikostik','id_kategoriA');
    }
    public function getNamaKategoriB()
    {
        return $this->hasMany('App\StatementPapikostik','id_kategoriB');
    }

    public function getNamaKategori2()
    {
        return $this->hasMany('App\KamusPapikostik','id_kategori');
    }

    public function KategoriScoring()
    {
        return $this->hasMany('App\KamusPapikostik','id_kategory');
    }


}
