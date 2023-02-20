<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chartProposal extends Model
{
    protected $table = 'chart_proposal';
    protected $primaryKey = 'id';

    public function resourceName(){
        return $this->belongsTo('App\Resource', 'resource_id');
    }
}
