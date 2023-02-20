<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyek extends Model
{
    // use SoftDeletes;
    protected $table ="lokasi_project";
    protected $fillable =['id','nama','lokasi'];
    protected $primaryKey ='id';
    // protected $timestamp = false;

    public function lokasi()
    {
      return $this->hasOne('App\Employee', 'lokasi_id');
    }
    
    public function lokasiProyek(){
      return $this->belongsTo('App\RequestBarang', 'nama_proyek');
    }
    
     public function getLokasi(){
      return $this->hasMany('App\Proposal', 'lokasi_id');
  }

    public function getLoc(){
      return $this->hasMany('App\TimeSheetUser','project_id');
    }

    public function getLoc_Project(){
      return $this->hasMany('App\Project', 'lokasi_id');
  }


}
