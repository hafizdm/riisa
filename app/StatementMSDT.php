<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementMSDT extends Model
{
    protected $table ="statement_msdt";
    protected $primaryKey ='id';

    protected $fillable = [
      'id_kategoriA',
      'pernyataanA', 
      'id_kategoriB',
      'pernyataanB', 
      'id_soal'
      ];

    public function getNamaKategoriA_MSDT()
    {
      return $this->belongsTo('App\KategoriMSDT', 'id_kategoriA');
    }
    public function getNamaKategoriB_MSDT()
    {
      return $this->belongsTo('App\KategoriMSDT', 'id_kategoriB');
    }
}
