<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Vendor extends Model
{
    //
    use SoftDeletes;
    protected $table ="master_vendor";
    protected $fillable =['category_id','nama','alamat','contact_person','phone_no','email','bank_1','bank_account_1','bank_rekening_1','bank_2','bank_account_2','bank_rekening_2','keterangan'];
    
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
}
