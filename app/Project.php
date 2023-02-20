<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'project';
    protected $primaryKey = 'id';
    protected $fillable =['id','nama','lokasi_id','resource_id','status','status_approved','tgl_approved','man_hours','created_at','updated_at'];

    public function getLoc_Project(){
        return $this->belongsTo('App\Proyek', 'lokasi_id');
    }

    public function resProject(){
        return $this->belongsTo('App\Resource', 'resource_id');
    }
    
}
