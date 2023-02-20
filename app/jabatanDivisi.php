<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jabatanDivisi extends Model
{
    protected $table = 'jabatan_divisi';
    // protected $fillable  = ['id', 'jabatan_id','divisi_id'];
    protected $primaryKey = 'id';

    public function getjabatan()
    {
      return $this->belongsTo('App\Jabatan', 'jabatan_id');
    }

    public function getdivisi()
    {
      return $this->belongsTo('App\divisi', 'divisi_id');
    }
}
