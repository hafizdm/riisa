<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{    
    use SoftDeletes;
    protected $table ='master_provinsi';
    protected $fillable  =['id','nama','nama_singkat','ibu_kota_provinsi'];
    protected $primaryKey ='id';

    public function kota()
    {
      return $this->hasMany('App\Kota', 'provinsi_id')->withTrashed();
    }
}
