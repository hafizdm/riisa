<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalentPool extends Model
{
    protected $table = 'talent_pool';
    protected $primaryKey ='id';
    protected $fillable = [
        'name', 'birth_place', 'birth_date', 'jk', 'pendidikan_terakhir', 'alamat', 
        'email', 'no_hp', 'linkedin','cv', 'jb_apply', 
        'total_pengalaman_kerja', 'interview_hrd', 'interview_user', 
        'interview_bod', 'profile', 'city', 'state', 
        'file_score_HRD', 'file_score_user', 'file_score_bod', 'kode_telp'
    ];

}
