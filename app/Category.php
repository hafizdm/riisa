<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ="master_vendor_category";
    protected $fillable =['name','description'];
    
    public function category()
    {
        return $this->hasMany('App\Vendor','category_id');
    }
}
