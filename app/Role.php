<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
  protected $table = 'role';
  protected $fillable = [
    'name',
    ];

    // public function permission()
    // {
    //   return $this->hasMany('App\RolePermission', 'role_id');
    // }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function role_divisi()
    {
      return $this->belongsToMany('App\RoleDivisi');
    }

    // public function roles_user()
    // {
    //   return $this->belongsTo('App\User','role_id');
    // }
    
}
