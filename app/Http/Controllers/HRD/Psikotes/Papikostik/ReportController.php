<?php

namespace App\Http\Controllers\HRD\Psikotes\Papikostik;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Candidate;
use App\ScorePapikostik;
use DB; 
use App\KamusPapikostik;

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
        return view('hrd/psikotes/Papikostik/report/index')->with($data);
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
        $score      = ScorePapikostik::select('id_category',DB::raw('SUM(score) as score_result'))
                    ->where('id_candidate', $id)
                    ->groupBy('id_category')
                    ->get();

        $category   = ["N", "G", "A", "L", "P", "I","T","V","X","S","B","O","R","D","C","Z","E","K","F","W"];

        $dataChart = [];

        foreach($category as $ct){
            foreach ($score as $item){
                if($item->KategoriScoring->nama_kategori == $ct){
                    $dataChart[] = $item->score_result;
                }
            }
        }
        
        $description = [];
        foreach($score as $sc){
            $getKamus = KamusPapikostik::where('id_kategori', $sc->id_category)->where('nilai', $sc->score_result)->first();
            $description[] = $getKamus;
        }
        
        $result = array_filter($description, function($value) {
			  return !is_null($value);
			});
			
        // return count($description);
        // return $result;
        

        $data    = compact("candidate","score","category","dataChart","result");
        return view('hrd/psikotes/Papikostik/report/detail')->with($data);
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
