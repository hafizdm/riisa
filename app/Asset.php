<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table ="master_asset";
    protected $primaryKey ='id';

    public function assetCategories()
    {
      return $this->belongsTo('App\assetCategory', 'asset_category');
    }
}
