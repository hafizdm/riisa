<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
  protected $table = 'role_user';
  public $timestamps = false;

  // public function role()
  // {
  //   return $this->belongsTo('App\Role', 'role_id');
  // }

  // public function permission()
  // {
  //   return $this->belongsTo('App\Permission', 'permission_id');
  // }
  
  public function users()
  {
      return $this->belongsToMany('App\User');
  }
}
