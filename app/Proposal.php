<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';
    protected $primaryKey = 'id';
    protected $fillable =['id','nama','lokasi_id','resource_id','status','status_approved','tgl_approved','man_hours','created_at','updated_at'];
    
    public function getLokasi(){
        return $this->belongsTo('App\Proyek', 'lokasi_id');
    }

    public function getResource(){
        return $this->belongsTo('App\Resource', 'resource_id');
    }

    public function getProposal(){
        return $this->hasMany('App\TimeSheetUser', 'proposal_id');
    }
}
