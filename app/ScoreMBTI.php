<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreMBTI extends Model
{
    protected $table ="score_mbti";
    protected $primaryKey ='id';

    protected $fillable = [
      'id_kategori',
      'id_soal', 
      'id_candidate'
      ];
}
