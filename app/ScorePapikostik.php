<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScorePapikostik extends Model
{
    protected $table ="score_papikostik";
    protected $primaryKey ='id';

    protected $fillable = [
      'id_category',
      'score', 
      'id_candidate'
      ];

    public function KategoriScoring()
    {
      return $this->belongsTo('App\KategoriPapikostik', 'id_category');
    }

}
