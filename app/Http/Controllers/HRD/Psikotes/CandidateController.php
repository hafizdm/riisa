<?php

namespace App\Http\Controllers\HRD\Psikotes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Candidate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['candidate'] = Candidate::all();
        return view('hrd/psikotes/Candidate/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrd/psikotes/Candidate/create');
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
            $data                           = new Candidate();
            $data->full_name                = $request->full_name;
            $data->last_education           = $request->last_education;
            $data->job_applied              = $request->job_applied;
            $data->test_schedule            = $request->test_schedule;
            $data->username                 = Str::slug($request->get('full_name'));
            $data->password_hash            = str_random(8);
            $data->url                      = "psikotest.rapidinfrastruktur.com/";
            $data->created_at               = Carbon::now()->toDateTimeString();
            $data->save();

            $hashPass                       = Candidate::find($data->id);
            $hashPass->password             = Hash::make($data->password_hash);
            $hashPass->save();

            return redirect('/kandidat-psikotes')->with('success', 'Data successfully added');
        }
        catch(\Exception $e){
            return redirect('/kandidat-psikotes')->with('failed', 'Please check your data again');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        return response()->json([
            'data' => $candidate
          ]);
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
            $full_name                  = $request->get('edit_full_name');
            $last_education             = $request->get('edit_last_education');
            $job_applied                = $request->get('edit_job_applied');
            $test_schedule              = $request->get('edit_test_schedule');

            $data = Candidate::find($id);
            $data->full_name                = $full_name;
            $data->last_education           = $last_education;
            $data->job_applied              = $job_applied;
            $data->test_schedule            = $test_schedule;
            $data->username                 = Str::slug($full_name);
            $data->updated_at               = Carbon::now()->toDateTimeString();
            $data->save();

            return response()->json(['success' => true ]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
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
        $data = Candidate::destroy($id);
        if($data){
            return response()->json([
                'success'=> 'Data successfully deleted'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Data failed deleted'
            ]);
        }
        return response($response);
    }
}
