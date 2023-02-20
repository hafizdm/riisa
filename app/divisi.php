<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class divisi extends Model
{
    use SoftDeletes;
    protected $table ="master_divisi";
    // protected $fillable =['nama_barang'];
    protected $primaryKey ='id';

    public function divisi()
    {
      return $this->hasMany('App\Employee', 'divisi_id');
    }

    public function request_divisi()
    {
      return $this->hasMany('App\RequestBarang','divisi_id');
    }

    public function getdivisi()
    {
        return $this->hasMany('App\Jabatan','divisi_id');
    }
    
    public function getDiv(){
      return $this->hasMany('App\TimeSheetUser', 'divisi_id');
    }
    
     public function get_divisi(){
        return $this->hasMany('App\SPD','divisi_id');
    }


}
