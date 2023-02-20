<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementDISC extends Model
{
    protected $table ="statement_disc";
    protected $primaryKey ='id';

    protected $fillable = [
      'kategori_plus',
      'kategori_minus',
      'pernyataan', 
      'id_soal'
      ];

    public function getKategoriPlus()
    {
      return $this->belongsTo('App\KategoriDISC', 'kategori_plus');
    }

    public function getKategoriMinus()
    {
      return $this->belongsTo('App\KategoriDISC', 'kategori_minus');
    }

}
