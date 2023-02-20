<?php

namespace App\Http\Controllers\HRD\Psikotes\DISC;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Candidate;
use App\ScoreDISC;
use DB;
use App\KategoriDISC;
use App\ChartDISC;

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
        return view('hrd/psikotes/DISC/report/index')->with($data);
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
        $getVal     = ScoreDISC::select(DB::raw('SUM(score_plus) as score_plus'),DB::raw('SUM(score_minus) as score_minus') )
                    ->where('id_candidate', $id)
                    ->first();
        // return $getVal;
        
        $getData    = ScoreDISC::where('id_candidate', $id)->get();

        $kategori = KategoriDISC::get();
        $data_plus = [];
        $data_minus = [];
        $data_change = [];
        $datas = [];

        foreach($kategori as $dt){
                $plus   = ScoreDISC::where('id_kategori_plus', $dt->id)->where('id_candidate', $id)->count();
                $minus  = ScoreDISC::where('id_kategori_minus', $dt->id)->where('id_candidate', $id)->count();
                $change = $plus - $minus;
                $star   = $plus + $minus;

                $datas[$dt->id] = $dt->id." ".$plus." ".$minus." ".$change." ";
        }
        
        $most= [];
        $least = [];
        $change = [];

        foreach($datas as $item){
            $split = explode(" ", $item);
            $most[] = $split[1];
            $least[] = $split[2];
            $change[] = $split[3];
        }

        if($getVal->count() == 0){
            $result_D_most = "-";
            $result_I_most = "-";
            $result_S_most = "-";
            $result_C_most = "-";
            $result_D_least = "-";
            $result_I_least = "-";
            $result_S_least = "-";
            $result_C_least = "-";
            $result_D_change = "-";
            $result_I_change = "-";
            $result_S_change = "-";
            $result_C_change = "-";
            $datas = [];
        }

        else{
            $D_most = $most[0];
            $I_most = $most[1];
            $S_most = $most[2];
            $C_most = $most[3];
        
            $result_D_most = ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 1)
                                ->where('chart_name',1);
                        })->where(function ($query) use ($D_most)  {
                            $query->where('val1',$D_most)
                                ->orWhere('val2',$D_most)
                                ->orWhere('val3',$D_most)
                                ->orWhere('val4',$D_most)
                                ->orWhere('val5',$D_most);
                        })->select('skala')->first();
    
            $result_I_most = ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 2)
                                    ->where('chart_name',1);
                            })->where(function ($query) use ($I_most)  {
                                $query->where('val1',$I_most)
                                    ->orWhere('val2',$I_most)
                                    ->orWhere('val3',$I_most)
                                    ->orWhere('val4',$I_most)
                                    ->orWhere('val5',$I_most);
                            })->select('skala')->first();
     
    
            $result_S_most = ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 3)
                                    ->where('chart_name',1);
                            })->where(function ($query) use ($S_most)  {
                                $query->where('val1',$S_most)
                                    ->orWhere('val2',$S_most)
                                    ->orWhere('val3',$S_most)
                                    ->orWhere('val4',$S_most)
                                    ->orWhere('val5',$S_most);
                            })->select('skala')->first();
            
            $result_C_most =ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 4)
                                    ->where('chart_name',1);
                            })->where(function ($query) use ($C_most)  {
                                $query->where('val1',$C_most)
                                    ->orWhere('val2',$C_most)
                                    ->orWhere('val3',$C_most)
                                    ->orWhere('val4',$C_most)
                                    ->orWhere('val5',$C_most);
                            })->select('skala')->first();
            
                            
            $D_least    = $least[0];
            $I_least    = $least[1];
            $S_least    = $least[2];
            $C_least    = $least[3];
            
            $result_D_least =ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 1)
                                ->where('chart_name',2);
                        })->where(function ($query) use ($D_least)  {
                            $query->where('val1',$D_least)
                                ->orWhere('val2',$D_least)
                                ->orWhere('val3',$D_least)
                                ->orWhere('val4',$D_least)
                                ->orWhere('val5',$D_least);
                        })->select('skala')->first();
    
            $result_I_least =ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 2)
                                    ->where('chart_name',2);
                            })->where(function ($query) use ($I_least)  {
                                $query->where('val1',$I_least)
                                    ->orWhere('val2',$I_least)
                                    ->orWhere('val3',$I_least)
                                    ->orWhere('val4',$I_least)
                                    ->orWhere('val5',$I_least);
                            })->select('skala')->first();
    
            $result_S_least =ChartDISC::where(function ($query) {
                        $query->where('id_kategori', 3)
                                ->where('chart_name',2);
                        })->where(function ($query) use ($S_least)  {
                            $query->where('val1',$S_least)
                                ->orWhere('val2',$S_least)
                                ->orWhere('val3',$S_least)
                                ->orWhere('val4',$S_least)
                                ->orWhere('val5',$S_least);
                        })->select('skala')->first();
    
            $result_C_least =ChartDISC::where(function ($query) {
                        $query->where('id_kategori', 4)
                                ->where('chart_name',2);
                        })->where(function ($query) use ($C_least)  {
                            $query->where('val1',$C_least)
                                ->orWhere('val2',$C_least)
                                ->orWhere('val3',$C_least)
                                ->orWhere('val4',$C_least)
                                ->orWhere('val5',$C_least);
                        })->select('skala')->first();
    
            $D_change   = $change[0];
            $I_change   = $change[1];
            $S_change    = $change[2];
            $C_change    = $change[3];
            
            $result_D_change =ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 1)
                                ->where('chart_name',3);
                        })->where(function ($query) use ($D_change)  {
                            $query->where('val1',$D_change)
                                ->orWhere('val2',$D_change)
                                ->orWhere('val3',$D_change)
                                ->orWhere('val4',$D_change)
                                ->orWhere('val5',$D_change);
                        })->select('skala')->first();

            
            $result_I_change = ChartDISC::where(function ($query) {
                            $query->where('id_kategori', 2)
                                    ->where('chart_name',3);
                            })->where(function ($query) use ($I_change)  {
                                $query->where('val1',$I_change)
                                    ->orWhere('val2',$I_change)
                                    ->orWhere('val3',$I_change)
                                    ->orWhere('val4',$I_change)
                                    ->orWhere('val5',$I_change);
                            })->select('skala')->first();

            $result_S_change =ChartDISC::where(function ($query) {
                        $query->where('id_kategori', 3)
                                ->where('chart_name',3);
                        })->where(function ($query) use ($S_change)  {
                            $query->where('val1',$S_change)
                                ->orWhere('val2',$S_change)
                                ->orWhere('val3',$S_change)
                                ->orWhere('val4',$S_change)
                                ->orWhere('val5',$S_change);
                        })->select('skala')->first();
    
            $result_C_change =ChartDISC::where(function ($query) {
                        $query->where('id_kategori', 4)
                                ->where('chart_name',3);
                        })->where(function ($query) use ($C_change)  {
                            $query->where('val1',$C_change)
                                ->orWhere('val2',$C_change)
                                ->orWhere('val3',$C_change)
                                ->orWhere('val4',$C_change)
                                ->orWhere('val5',$C_change);
                        })->select('skala')->first();
            
            // Not in scale Change
            $D1_change = ChartDISC::where('id_kategori', 1)
                        ->where('chart_name',3)
                        ->get();

            $skala_D_change = [];
            foreach($D1_change as $d){
                array_push($skala_D_change, $d->val1, $d->val2, $d->val3, $d->val4, $d->val5);
                
            }
            $new = array_values(array_filter($skala_D_change, 'strlen'));
            
            $I1_change = ChartDISC::where('id_kategori', 2)
            ->where('chart_name',3)
            ->get();
            
            $skala_I_change = [];
            foreach($I1_change as $i){
                array_push($skala_I_change, $i->val1, $i->val2, $i->val3, $i->val4, $i->val5);
                
            }
            $new2 = array_values(array_filter($skala_I_change, 'strlen'));


            $S1_change = ChartDISC::where('id_kategori', 3)
            ->where('chart_name',3)
            ->get();
            
            $skala_S_change = [];
            foreach($S1_change as $s){
                array_push($skala_S_change, $s->val1, $s->val2, $s->val3, $s->val4, $s->val5);
                
            }
            $new3 = array_values(array_filter($skala_S_change, 'strlen'));


            $C1_change = ChartDISC::where('id_kategori', 4)
            ->where('chart_name',3)
            ->get();
            
            $skala_C_change = [];
            foreach($C1_change as $c){
                array_push($skala_C_change, $c->val1, $c->val2, $c->val3, $c->val4, $c->val5);
                
            }
            $new4 = array_values(array_filter($skala_C_change, 'strlen'));

            // Not in scale MOST
            $D1_most = ChartDISC::where('id_kategori', 1)
                        ->where('chart_name',1)
                        ->get();

            $skala_D_most = [];
            foreach($D1_most as $d){
                array_push($skala_D_most, $d->val1, $d->val2, $d->val3, $d->val4, $d->val5);
                
            }
            $newMostD = array_values(array_filter($skala_D_most, 'strlen'));
            
            $I1_most = ChartDISC::where('id_kategori', 2)
                    ->where('chart_name',1)
                    ->get();
            
            $skala_I_most = [];
            foreach($I1_most as $i){
                array_push($skala_I_most, $i->val1, $i->val2, $i->val3, $i->val4, $i->val5);
                
            }
            $newMostI = array_values(array_filter($skala_I_most, 'strlen'));


            $S1_most = ChartDISC::where('id_kategori', 3)
                        ->where('chart_name',1)
                        ->get();
            
            $skala_S_most = [];
            foreach($S1_most as $s){
                array_push($skala_S_most, $s->val1, $s->val2, $s->val3, $s->val4, $s->val5);
                
            }
            $newMostS = array_values(array_filter($skala_S_most, 'strlen'));


            $C1_most = ChartDISC::where('id_kategori', 4)
                        ->where('chart_name',1)
                        ->get();
                        
            $skala_C_most = [];
            foreach($C1_most as $c){
                array_push($skala_C_most, $c->val1, $c->val2, $c->val3, $c->val4, $c->val5);
                
            }
            $newMostC = array_values(array_filter($skala_C_most, 'strlen'));


            // Not in scale LEAST
            $D1_least = ChartDISC::where('id_kategori', 1)
            ->where('chart_name',2)
            ->get();

            $skala_D_least = [];
            foreach($D1_least as $d){
                array_push($skala_D_least, $d->val1, $d->val2, $d->val3, $d->val4, $d->val5);
                
            }
            $newLeastD = array_values(array_filter($skala_D_least, 'strlen'));
            
            $I1_least = ChartDISC::where('id_kategori', 2)
                    ->where('chart_name',2)
                    ->get();
            
            $skala_I_least = [];
            foreach($I1_least as $i){
                array_push($skala_I_least, $i->val1, $i->val2, $i->val3, $i->val4, $i->val5);
                
            }
            $newLeastI = array_values(array_filter($skala_I_least, 'strlen'));


            $S1_least = ChartDISC::where('id_kategori', 3)
                        ->where('chart_name',2)
                        ->get();
            
            $skala_S_least = [];
            foreach($S1_least as $s){
                array_push($skala_S_least, $s->val1, $s->val2, $s->val3, $s->val4, $s->val5);
                
            }
            $newLeastS = array_values(array_filter($skala_S_least, 'strlen'));


            $C1_least = ChartDISC::where('id_kategori', 4)
                        ->where('chart_name',2)
                        ->get();
                        
            $skala_C_least = [];
            foreach($C1_least as $c){
                array_push($skala_C_least, $c->val1, $c->val2, $c->val3, $c->val4, $c->val5);
                
            }
            $newLeastC = array_values(array_filter($skala_C_least, 'strlen'));
        }


        $data    = compact("candidate","getVal","data_plus", "data_minus","datas",
                     "result_D_most", "result_I_most","result_S_most","result_C_most", 
                     "result_D_least", "result_I_least","result_S_least","result_C_least", 
                     "result_D_change", "result_I_change","result_S_change","result_C_change", 
                     "D_change", "I_change", "S_change","C_change", 
                     "D_least", "I_least", "S_least","C_least", 
                     "D_most", "I_most", "S_most","C_most", 
                     "new", "new2","new3","new4",
                     "newMostD", "newMostI","newMostS","newMostC",
                     "newLeastD", "newLeastI","newLeastS","newLeastC", 
                    );

        return view('hrd/psikotes/DISC/report/detail')->with($data);
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
