<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KamusPapikostik extends Model
{
    protected $table ="kamus_papikostik";
    protected $primaryKey ='id';

    protected $fillable = [
        'id_kategori',
        'nilai', 
        'keterangan'
    ];

    public function getNamaKategori2()
    {
      return $this->belongsTo('App\KategoriPapikostik', 'id_kategori');
    }
    
    public function KategoriScoring()
    {
        return $this->belongsTo('App\KategoriPapikostik','id_kategory');
    }

}
