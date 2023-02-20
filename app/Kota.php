<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    // use SoftDeletes;
    public $timestamps=false;
    protected $table ='master_kota';
    protected $guarded =['updated_at'];
    // protected $fillable  =['id','provinsi_id','nama'];
    protected $primaryKey ='id';

    public function provinsi()
    {
      return $this->belongsTo('App\Provinsi', 'provinsi_id')->withTrashed();
    }
}

