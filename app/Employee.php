<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    // use table karyawan
    protected $table= "karyawan";
    protected $primaryKey ='id';

    public function user_login()
    {
      return $this->belongsTo('App\User','nik','username');
    }

    public function jabatan()
    {
      return $this->belongsTo('App\Jabatan', 'jabatan_id');
    }

    public function divisi()
    {
      return $this->belongsTo('App\divisi', 'divisi_id');
    }

    public function lokasi()
    {
      return $this->belongsTo('App\Proyek', 'lokasi_id');
    }
    
    public function getNama(){
        return $this->belongsTo('App\TimeSheetUser','id_user');
    }

    // public function dataKaryawan()
    // {
    //   return $this->belongsTo('App\RequestBarang', 'updated_manager_by','nama');
    // }

    // public function request_divisi()
    // {
    //   return $this->hasOne('App\divisi', 'divisi_id');
    // }
    
}
