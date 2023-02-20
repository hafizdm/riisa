<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreMSDT extends Model
{
    protected $table ="score_msdt";
    protected $primaryKey ='id';

    protected $fillable = [
      'id_kategori',
      'id_soal', 
      'id_candidate'
      ];

}
