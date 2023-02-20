<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheetUser extends Model
{
    protected $table = 'time_sheet_user';
    protected $primaryKey = 'id';

    public function getCostAccount(){
        return $this->belongsTo('App\Costaccount', 'cost_account_id');
    }
    public function getDiv(){
        return $this->belongsTo('App\divisi', 'divisi_id');
    }

    public function workingType(){
        return $this->belongsTo('App\General', 'working_type_id');
    }

    public function getRes(){
        return $this->belongsTo('App\Resource', 'resource_id');
    }

    public function getProposal(){
        return $this->belongsTo('App\Proposal', 'proposal_id');
    }

    public function getNama(){
        return $this->belongsTo('App\Employee','id_user');
    }

    public function getLoc(){
        return $this->belongsTo('App\Proyek','project_id');
    }
}
