<?php

namespace App\Http\Controllers\HRD;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\TalentPool;
// use App\KodeTelepon;
use App\JobPositionTalentPoll as JobPosition;

use Illuminate\Http\Request;

class TalentPoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['talent_pool'] = TalentPool::all();
        $data['job_position'] = JobPosition::all();
        return view('hrd.talentpool.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // $validated = $request->validate([
            //     'cv' => 'file|max:5120',
            //     'profile' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5120'
            // ]);

            $data                       = new TalentPool();
            $data->name                 = $request->name;
            $data->birth_place          = $request->birth_place;
            $data->birth_date           = $request->birth_date;
            $data->jk                   = $request->jk;
            $data->alamat               = $request->alamat;
            $data->city                 = $request->city;
            $data->state                = $request->state;
            $data->pendidikan_terakhir  = $request->pendidikan_terakhir;
            $data->email                = $request->email;
            $data->kode_telp            = $request->kode_telepon;
            $data->no_hp                = $request->no_hp;
            $data->linkedin             = $request->linkedin;
            $data->total_pengalaman_kerja   = $request->total_pengalaman_kerja;
            $data->jb_apply             = $request->jb_apply;


            $data->created_at   = Carbon::now()->toDateTimeString();
            $data->save();


            // Update file cv and profile
            $updateFile = TalentPool::find($data->id);

            $files = $request->file('cv');
            if(empty($files)){
                $saveCV = "";
            }
            else{
                $cvUploadURL    = 'uploads/TalentPool/'.$data->id;
                $file           = "CV"." ".$data->name."".Carbon::now()->timestamp ."." . $files->getClientOriginalExtension();
                $files->move($cvUploadURL, $file);
                $saveCV         = $file; 
            }

            $imageprofile = $request->file('profile'); 
            if(empty($imageprofile)){
                $saveImageProfile = "";
            }
            else{
                $ImageUploadURL = 'uploads/TalentPool/'.$data->id;
                $file2 = "Profile"." ".$data->name."".Carbon::now()->timestamp ."." . $imageprofile->getClientOriginalExtension();
                $imageprofile->move($ImageUploadURL, $file2);
                $saveImageProfile = $file2; 
            }

            $updateFile->cv         = $saveCV;
            $updateFile->profile    = $saveImageProfile;
            $updateFile->save();

            return redirect('/list-talent-pool')->with('success', 'Data berhasil ditambahkan');

        }
        catch(\Exception $e){
            return redirect('/list-talent-pool')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    public function showTalent($id){
        $data['talent_pool']= TalentPool::find($id);
        // $data['kode_telepon'] = KodeTelepon::all();
        $data['job_position'] = JobPosition::all();
        return view('hrd.talentpool.show')->with($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $talentPool = TalentPool::destroy($id);
        if($talentPool){
            return response()->json([
                'success'=> 'Talent Pool successfully deleted'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Talent Pool failed deleted'
            ]);
        }
        return response($response);
    }

    public function getProfile($id){
        $profile = TalentPool::find($id);
        return response()->json([
            'data' => $profile
          ]);
    }

    public function updateProfile(Request $request, $id){
        try{
            //  $validated = $request->validate([
            //     'profile' => 'image|mimes:jpg,png,jpeg,gif,svg'
            // ]);
            $files = $request->file('profile');
            $ids = $id;
            $dt = TalentPool::find($id);

            if($files){
                $ImageUploadURL = 'uploads/TalentPool/'.$dt->id;
                $file2 = "Profile"." ".$dt->name."".Carbon::now()->timestamp ."." . $files->getClientOriginalExtension();
                $files->move($ImageUploadURL, $file2);
                $saveImageProfile = $file2; 
            }

            TalentPool::updateOrCreate(
                [
                    'id' => $ids
                ], 
                [
                    'profile' => $saveImageProfile,
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]
            );

            return response()->json(['success' => true ]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }

    // Update Contact
    public function getContact($id){
        $contact = TalentPool::find($id);
        return response()->json([
            'data' => $contact
          ]);
    }

    public function updateContact(Request $request, $id){
        try{
            $kode_telepon   = $request->get('kode_telp');
            $no_telp        = $request->get('no_hp');
            $email          = $request->get('email');
            $linkedins      = $request->get('linkedin');

            // $data = TalentPool::find($id); 
            TalentPool::updateOrCreate(
                [
                    'id' => $id
                ], 
                [
                    'kode_telp'     => $kode_telepon, 
                    'no_hp'         => $no_telp,
                    'email'         => $email,
                    'linkedin'      => $linkedins,
                    'updated_at'    => Carbon::now()->toDateTimeString() 
                ],
            ); 

            return response()->json(['success' => true]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }

    // Update Score
    public function getScore($id){
        $score =  TalentPool::find($id);
        return response()->json([
            'data' => $score
          ]);
    }

    public function updateScore(Request $request, $id){
        try{
            $scoreHRD       = $request->get('interview_hrd');
            $scoreUser      = $request->get('interview_user');
            $scoreBOD       = $request->get('interview_bod');

            // $data = TalentPool::find($id); 
            TalentPool::updateOrCreate(
                [
                    'id' => $id
                ], 
                [
                    'interview_hrd'     => $scoreHRD, 
                    'interview_user'    => $scoreUser,
                    'interview_bod'     => $scoreBOD,
                    'updated_at'    => Carbon::now()->toDateTimeString() 
                ],
            ); 

            return response()->json(['success' => true]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }

    // Update Personal Info
    public function getPersonalInfo($id){
        $personalInfo =  TalentPool::find($id);
        return response()->json([
            'data' => $personalInfo
          ]);
    }

    public function updatePersonalInfo(Request $request, $id){
        try{
            $fullname       = $request->get('name');
            $birthplace     = $request->get('birth_place');
            $birthdate      = $request->get('birth_date');
            $gender         = $request->get('jk');
            $address        = $request->get('alamat');
            $city           = $request->get('city');
            $state          = $request->get('state');
            $last_education = $request->get('pendidikan_terakhir');
            $total_work_years = $request->get('total_pengalaman_kerja');
            $position_applied   = $request->get('jb_apply');


            // $data = TalentPool::find($id); 
            TalentPool::updateOrCreate(
                [
                    'id' => $id
                ], 
                [
                    'name'           => $fullname, 
                    'birth_place'    => $birthplace,
                    'birth_date'     => $birthdate,
                    'jk'             => $gender, 
                    'alamat'         => $address, 
                    'city'           => $city, 
                    'state'          => $state, 
                    'pendidikan_terakhir' => $last_education, 
                    'total_pengalaman_kerja' => $total_work_years, 
                    'jb_apply' => $position_applied,
                    'updated_at'    => Carbon::now()->toDateTimeString() 
                ],
            ); 

            return response()->json(['success' => true]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }

    // Update CV
    public function getCV($id){
        $cv =  TalentPool::find($id);
        return response()->json([
            'data' => $cv
          ]);
    }

    public function updateCV(Request $request, $id){
        try{
            // $validated = $request->validate([
            //     'cv' => 'file|max:5120',
            // ]);

            $files  = $request->file('file_cv');
            $ids    = $id;

            $dt = TalentPool::find($id);

            if($files){
                $CVUploadURL = 'uploads/TalentPool/'.$dt->id;
                $file2 = "CV"." ".$dt->name."".Carbon::now()->timestamp ."." . $files->getClientOriginalExtension();
                $files->move($CVUploadURL, $file2);
                $saveCV = $file2; 
            }

            TalentPool::updateOrCreate(
                [
                    'id' => $ids
                ], 
                [
                    'cv' => $saveCV,
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]
            );
    
            return response()->json(['success' => true ]);
        }

        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }

    // File score HRD
    public function getFileScoreHRD($id){
        $file_score_HRD =  TalentPool::find($id);
        return response()->json([
            'data' => $file_score_HRD
          ]);
    }

    public function updateFileScoreHRD(Request $request, $id){
        try{
            $files  = $request->file('file_score_hrd');
            $ids    = $id;

            $dt = TalentPool::find($id);

            if($files){
                $score_hrd_URL          = 'uploads/TalentPool/'.$dt->id;
                $file2                  = "Score Interview HRD"."".Carbon::now()->timestamp ."." . $files->getClientOriginalExtension();
                $files->move($score_hrd_URL, $file2);
                $save_file_score_HRD    = $file2; 
            }

            TalentPool::updateOrCreate(
                [
                    'id' => $ids
                ], 
                [
                    'file_score_HRD'    => $save_file_score_HRD,
                    'updated_at'        => Carbon::now()->toDateTimeString()
                ]
            );
    
            return response()->json(['success' => true ]);
        }

        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }
    // File score User
    public function getFileScoreUser($id){
        $file_score_user =  TalentPool::find($id);
        return response()->json([
            'data' => $file_score_user
          ]);
    }

    public function updateFileScoreUser(Request $request, $id){
        try{
            $files  = $request->file('file_score_user');
            $ids    = $id;

            $dt = TalentPool::find($id);

            if($files){
                $score_user_URL          = 'uploads/TalentPool/'.$dt->id;
                $file2                   = "Score Interview User"."".Carbon::now()->timestamp ."." . $files->getClientOriginalExtension();
                $files->move($score_user_URL, $file2);
                $save_file_score_User    = $file2; 
            }

            TalentPool::updateOrCreate(
                [
                    'id' => $ids
                ], 
                [
                    'file_score_user'    => $save_file_score_User,
                    'updated_at'         => Carbon::now()->toDateTimeString()
                ]
            );
    
            return response()->json(['success' => true ]);
        }

        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }

    // File score BOD
    public function getFileScoreBOD($id){
        $file_score_bod =  TalentPool::find($id);
        return response()->json([
            'data' => $file_score_bod
          ]);
    }

    public function updateFileScoreBOD(Request $request, $id){
        try{
            $files  = $request->file('file_score_bod');
            $ids    = $id;

            $dt = TalentPool::find($id);

            if($files){
                $score_bod_URL          = 'uploads/TalentPool/'.$dt->id;
                $file2                  = "Score Interview BOD"."".Carbon::now()->timestamp ."." . $files->getClientOriginalExtension();
                $files->move($score_bod_URL, $file2);
                $save_file_score_BOD    = $file2; 
            }

            TalentPool::updateOrCreate(
                [
                    'id' => $ids
                ], 
                [
                    'file_score_bod'    => $save_file_score_BOD,
                    'updated_at'         => Carbon::now()->toDateTimeString()
                ]
            );
    
            return response()->json(['success' => true ]);
        }

        catch(\Exception $e){
            return response()->json(['failed' => true]);
        }
    }

}
