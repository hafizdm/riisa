<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleDivisi extends Model
{
    protected $table = 'role_divisi';
    protected $fillable = [
      'id',
      'nama_divisi',
      'role_id'
      ];

      public function role_divisi()
      {
        return $this->belongsTo('App\Role');
      }

      public function approved_divisi()
      {
        return $this->belongsTo('App\divisi', 'jenis_divisi');
      }
}
