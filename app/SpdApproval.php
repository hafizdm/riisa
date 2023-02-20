<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpdApproval extends Model
{
    public function karyawan() {
        return $this->belongsTo('App\Employee');
    }
}
