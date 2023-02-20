<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $table = 'general_working_type';
    protected $primaryKey = 'id';

    public function workingType(){
        return $this->hasMany('App\TimeSheetUser', 'working_type_id');
    }

}
