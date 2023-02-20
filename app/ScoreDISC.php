<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreDISC extends Model
{
    protected $table ="score_disc";
    protected $primaryKey ='id';

    protected $fillable = [
      'id_kategori_plus',
      'id_kategori_minus',
      'score_plus', 
      'score_minus', 
      'id_soal',
      'id_candidate'
      ];

      public function KategoriScoringPlus()
      {
        return $this->belongsTo('App\KategoriDISC', 'id_kategori_plus');
      }

      public function KategoriScoringMinus()
      {
        return $this->belongsTo('App\KategoriDISC', 'id_kategori_minus');
      }
}
