<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBarang extends Model
{
    protected $table ="request_barang";
    protected $fillable =['id','nama','nik','kode_barang','nama_barang','harga','quantity','total','nama_proyek','status_pengajuan','status_PO','status_paid','jenis_barang'];
    protected $primaryKey ='id';

    public function request_divisi()
    {
      return $this->belongsTo('App\divisi','divisi_id');
    } 
    
    public function masterjenisbarang()
    {
      return $this->belongsTo('App\JenisBarang', 'jenis_barang');
    }

    public function masterKategori()
    {
      return $this->belongsTo('App\KategoriBarang', 'kode_barang');
    }
    
    public function lokasiProyek(){
      return $this->belongsTo('App\Proyek', 'nama_proyek');
    }

    // public function dataKaryawan()
    // {
    //   return $this->hasMany('App\Employee', 'updated_manager_by','nama');
    // }


}
