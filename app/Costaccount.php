<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costaccount extends Model
{
    protected $table = 'cost_account';
    protected $primaryKey = 'id';

    public function getCostAccount(){
        return $this->hasMany('App\TimeSheetUser', 'cost_account_id');
    }
}
