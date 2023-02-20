<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resource';
    protected $primaryKey = 'id';

    public function getResource(){
        return $this->hasMany('App\Proposal', 'resource_id');
    }

    public function getRes(){
        return $this->hasMany('App\TimeSheetUser', 'resource_id');
    }

    public function resourceName(){
        return $this->hasMany('App\chartProposal', 'resource_id');
    }
    public function resourceName2(){
        return $this->hasMany('App\chartProject', 'resource_id');
    }

    public function resourceProject(){
        return $this->hasMany('App\ResourceProject', 'resource');
    }

    public function resProject(){
        return $this->hasMany('App\Project', 'resource_id');
    }
}
