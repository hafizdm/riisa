<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetCategory extends Model
{
    protected $table ="asset_category";
    protected $primaryKey ='id';

    public function assetCategories()
    {
      return $this->hasMany('App\Asset', 'asset_category');
    }

}
