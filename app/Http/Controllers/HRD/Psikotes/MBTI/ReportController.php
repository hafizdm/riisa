<?php

namespace App\Http\Controllers\HRD\Psikotes\MBTI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Candidate;
use App\ScoreMBTI;
use DB; 
use App\StatementMBTI;
use App\KategoriMBTI;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['candidate'] = Candidate::all();
        return view('hrd/psikotes/MBTI/report/index')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $candidate  = Candidate::where('id', $id)->first();

        $checkdata = ScoreMBTI::where('id_candidate', $id)->count();
        
        if($checkdata == 0){
            $resAll = "-";
            $data2 = compact('candidate','resAll');
        }
        else{

            $getkategori = KategoriMBTI::pluck('id','nama_kategori');
            
            $getscore = ScoreMBTI::select('id_kategori', DB::raw('COUNT(id_kategori) as total'))
                        ->groupBy('id_kategori')
                        ->where('id_candidate', $id)
                        ->get();
            
            // $getscore = ScoreMBTI::where('id_candidate', $id)->get();
            // return $getscore;
            
            $totals = [];
            foreach($getscore as $p){
                $res = $p->total/15 ;
                $rounds = round($res,2);
                $totals[] = $p->id_kategori." ".$rounds*100;
            }
     
            // return $getscore;
            
            $desc1 = "";
            $desc2 = "";
            $desc3 = "";
            $desc4 = "";

            $I = explode(" ", $totals[0]);
            $E = explode(" ", $totals[1]);
            $S = explode(" ", $totals[2]);
            $N = explode(" ", $totals[3]);
            $T = explode(" ", $totals[4]);
            $F = explode(" ", $totals[5]);
            $J = explode(" ", $totals[6]);
            $P = explode(" ", $totals[7]);

            if($I[1] < $E[1]){
                $desc1 = "E";
            }
            // elseif($I[1] > $E[1]){
            else{
                $desc1 = "I";
            }

            $has1 = $desc1;

            if($S[1] < $N[1]){
                $desc2 = "N";
            }

            // elseif($S[1] > $N[1]){
            else{
                $desc2 = "S";
            }

            $has2 = $desc2;

            if($T[1] < $F[1]){
                $desc3 = "F";
            }

            // elseif($T[1] > $F[1]){
            else{
                $desc3 = "T";
            }

            $has3 = $desc3;

            if($J[1] < $P[1]){
                $desc4 = "P";
            }

            // elseif($J[1] > $P[1]){
            else{
                $desc4 = "J";
            }
            $has4 = $desc4;

            $resAll = $has1." ".$has2." ".$has3." ".$has4;

            $data2 = compact('candidate','resAll','I','E','S','N','T','F','J','P');
            
        }
            return view('hrd/psikotes/MBTI/report/detail')->with($data2);
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
        //
    }
}
