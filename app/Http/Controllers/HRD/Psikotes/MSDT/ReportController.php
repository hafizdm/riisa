<?php

namespace App\Http\Controllers\HRD\Psikotes\MSDT;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Candidate;
use App\ScoreMSDT;
use DB; 
use App\StatementDISC;

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
        return view('hrd/psikotes/MSDT/report/index')->with($data);
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
        // return $candidate;
        
        $getdata = ScoreMSDT::where('id_candidate', $id)->count();
        
        if($getdata == 0){
            $dt = ["TO","RO", "E", "O"];
            $all = ["","","",""];
            $desc = "";
            $data2       = compact("candidate", "dt","desc","all");
        }
        else{
        // Baris
        $getscoreA1 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [1,8])->groupBy('id_kategori')->count();
        $getscoreA2 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [9,16])->groupBy('id_kategori')->count();
        $getscoreA3 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [17,24])->groupBy('id_kategori')->count();
        $getscoreA4 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [25,32])->groupBy('id_kategori')->count();
        $getscoreA5 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [33,40])->groupBy('id_kategori')->count();
        $getscoreA6 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [41,48])->groupBy('id_kategori')->count();
        $getscoreA7 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [49,56])->groupBy('id_kategori')->count();
        $getscoreA8 = ScoreMSDT::where('id_kategori',1)->where('id_candidate', $id)->whereBetween('id_soal', [57,64])->groupBy('id_kategori')->count();
        
        
        // Kolom
        $getscoreB1 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [1,9,17,25,33,41,49,57])->groupBy('id_kategori')->count();
        $getscoreB2 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [2,10,18,26,34,42,50,58])->groupBy('id_kategori')->count();
        $getscoreB3 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [3,11,19,27,35,43,51,59])->groupBy('id_kategori')->count();
        $getscoreB4 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [4,12,20,28,36,44,52,60])->groupBy('id_kategori')->count();
        $getscoreB5 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [5,13,21,29,37,45,53,61])->groupBy('id_kategori')->count();
        $getscoreB6 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [6,14,22,30,38,46,54,62])->groupBy('id_kategori')->count();
        $getscoreB7 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [7,15,23,31,39,47,55,63])->groupBy('id_kategori')->count();
        $getscoreB8 = ScoreMSDT::where('id_kategori',2)->where('id_candidate', $id)->whereIn('id_soal', [8,16,24,32,40,48,56,64])->groupBy('id_kategori')->count();

        $jumA = ($getscoreA1 + $getscoreB1)+1;
        $jumB = ($getscoreA2 + $getscoreB2)+2;
        $jumC = ($getscoreA3 + $getscoreB3)+1;
        $jumD = ($getscoreA4 + $getscoreB4)+0;
        $jumE = ($getscoreA5 + $getscoreB5)+3;
        $jumF = ($getscoreA6 + $getscoreB6)-1;
        $jumG = ($getscoreA7 + $getscoreB7)+0;
        $jumH = ($getscoreA8 + $getscoreB8)-4;

        // Kotak perhitungan
        $val_TO =$jumC + $jumD + $jumG + $jumH;
        $val_RO =$jumB + $jumD + $jumF + $jumH;
        $val_E  =$jumE + $jumF + $jumG + $jumH;
        $val_O  =$jumA;

        // $data = [];
        // $data["TO, RO, E, O"] = $val_TO.",".$val_RO.",".$val_E.",".$val_O;
        $data = [$val_TO, $val_RO, $val_E, $val_O];
        
        // return $data;
        
        $all = [];
        $res = "";
        foreach ($data as $item) {
            if($item >= 0 && $item <= 29){
                $res = 0;
            }
            elseif($item >= 30 && $item <= 31){
                $res = 0.6;
            }
            elseif($item == 32){
                $res = 1.2;
            }
            elseif($item == 33){
                $res = 1.8;
            }
            elseif($item == 34){
                $res =2.4;
            }
            elseif($item == 35){
                $res = 3.0;
            }
    
            elseif($item == 36 || $item == 37){
                $res = 3.6;
            }
            elseif($item >= 38){
                $res = 4.0;
            }
            else{
                $res = "";
            }
            $all[] = $res;
        }
        // return $all;
        

    
        $dt = ["TO","RO", "E", "O"];

        if($all[0] > 2 && $all[1] > 2 && $all[2] > 2){
            $desc = "Executive";
        }
        elseif($all[0] > 2 && $all[1] > 2 && $all[2] < 2){
            $desc = "Compromiser";
        }
        elseif($all[0] > 2 && $all[1] < 2 && $all[2] > 2){
            $desc = "Benevolent Autocrat";
        }
        elseif($all[0] > 2 && $all[1] < 2 && $all[2] < 2){
            $desc = "Autocrat";
        }

        elseif($all[0] < 2 && $all[1] > 2 && $all[2] > 2){
            $desc = "Developer";
        }

        elseif($all[0] < 2 && $all[1] > 2 && $all[2] < 2){
            $desc = "Missionary";
        }
        elseif($all[0] < 2 && $all[1] < 2 && $all[2] > 2){
            $desc = "Bureaucrat";
        }
        elseif($all[0] < 2 && $all[1] < 2 && $all[2] < 2){
            $desc = "Deserter";
        }
        $data2       = compact("candidate","all","desc","dt");
    }
    
        return view('hrd/psikotes/MSDT/report/detail')->with($data2);
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
