<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementPapikostik extends Model
{
    protected $table ="statement_papikostik";
    protected $primaryKey ='id';

    protected $fillable = [
      'id_kategoriA',
      'pernyataanA', 
      'id_kategoriB',
      'pernyataanB', 
      'id_soal'
      ];

    public function getNamaKategoriA()
    {
      return $this->belongsTo('App\KategoriPapikostik', 'id_kategoriA');
    }
    public function getNamaKategoriB()
    {
      return $this->belongsTo('App\KategoriPapikostik', 'id_kategoriB');
    }
}
