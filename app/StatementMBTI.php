<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementMBTI extends Model
{
    protected $table ="statement_mbti";
    protected $primaryKey ='id';

    protected $fillable = [
      'id_kategoriA',
      'pernyataanA', 
      'id_kategoriB',
      'pernyataanB', 
      'id_soal'
      ];

    public function getNamaKategoriMBTI_A()
    {
      return $this->belongsTo('App\KategoriMBTI', 'id_kategoriA');
    }
    public function getNamaKategoriMBTI_B()
    {
      return $this->belongsTo('App\KategoriMBTI', 'id_kategoriB');
    }
}
