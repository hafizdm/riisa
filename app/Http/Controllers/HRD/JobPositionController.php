<?php

namespace App\Http\Controllers\HRD;
use App\Http\Controllers\Controller;
use App\JobPositionTalentPoll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["job_position"] = JobPositionTalentPoll::orderBy('created_at','desc')->get();
        return view('hrd/job_position/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['job-position'] = JobPositionTalentPoll::all();
        return view('hrd/job_position/create', $data);
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

            $jp             = new JobPositionTalentPoll();
            $jp->nama       = $request->get('nama');
            $jp->created_at = Carbon::now()->toDateTimeString();
            $jp->save();

            return redirect('/posisi-kerja')->with('success', 'Data Posisi kerja berhasil ditambahkan');
        }
        catch(\Exception $e){
            return redirect('/posisi-kerja')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['job_position'] = JobPositionTalentPoll::find($id);
        return view('hrd/job_position/edit')->with($data);
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
        try{
            $jp         = JobPositionTalentPoll::find ($id);
            $jp->nama   = $request->get('nama');
            $jp->save();
            return redirect('posisi-kerja')->with('success update data');
        }
        catch(\Exception $e){
            return redirect('/posisi-kerja')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jp = JobPositionTalentPoll::destroy($id);
        
        if($jp){
            return response()->json([
                'success'=> 'data berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'data gagal dihapus'
            ]);
        }
        return response($response);
    }
}
