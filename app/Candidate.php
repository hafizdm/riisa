<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table ="candidate";
    protected $primaryKey ='id';

    protected $fillable = [
        'full_name',
        'last_education',
        'job_applied',
        'test_schedule',
        'url'
        ];
}
