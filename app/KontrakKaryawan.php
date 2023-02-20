<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KontrakKaryawan extends Model
{
    protected $table ="kontrak_karyawan";
    protected $fillable =[
        'nik_karyawan',
        'tgl_mulai_kontrak',
        'tgl_akhir_kontrak',
        'perpanjangan_ke'
    ];
    protected $primaryKey ='id';

    public function kontrakKaryawan()
    {
      return $this->belongsTo('App\Employee', 'nik_karyawan');
    }

}
