<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chartProject extends Model
{
    protected $table = 'chart_project';
    protected $primaryKey = 'id';

    public function resourceName2(){
        return $this->belongsTo('App\Resource', 'resource_id');
    }
}
