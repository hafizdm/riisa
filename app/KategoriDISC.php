<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriDISC extends Model
{
    protected $table ="kategori_disc";
    protected $primaryKey ='id';

    protected $fillable = [
        'nama_kategori',
        ];

    public function getKategoriPlus()
    {
        return $this->hasMany('App\StatementDISC','kategori_plus');
    }

    public function getKategoriMinus()
    {
        return $this->hasMany('App\StatementDISC','kategori_minus');
    }

    public function KategoriScoringPlus()
    {
        return $this->hasMany('App\ScoreDISC','id_kategori_plus');
    }

    public function KategoriScoringMinus()
    {
        return $this->hasMany('App\ScoreDISC','id_kategori_minus');
    }
}

