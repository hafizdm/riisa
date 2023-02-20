<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    // use SoftDeletes;
    protected $table = 'master_jabatan';
    // protected $fillable  = ['id', 'jenis_jabatan','keterangan'];
    protected $primaryKey = 'id';

    public function jabatan()
    {
      return $this->hasOne('App\Employee', 'jabatan_id');
    }

    public function getjabatan()
    {
      return $this->hasMany('App\jabatanDivisi', 'jabatan_id');
    }
    public function getdivisi()
    {
        return $this->belongsTo('App\divisi','divisi_id');
    }

}
