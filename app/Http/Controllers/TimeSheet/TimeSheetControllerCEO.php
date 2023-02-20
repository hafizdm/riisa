<?php

namespace App\Http\Controllers\TimeSheet;
use App\Http\Controllers\Controller;
use App\Proyek;
use App\Employee;
use App\Resource;
use App\Proposal;
use App\Project;
use DB;
use App\TimeSheetUser;
use Carbon\Carbon;
use App\User;
use Auth;
use App\chartProposal;
use App\chartProject;
use Illuminate\Http\Request;

class TimeSheetControllerCEO extends Controller
{

    public function approvalAll(Request $request){
        $datas = [
            'status' => $request->status,
            'approved_by' => Auth::user()->user_login->nama,
            'tgl_approved' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ];
        $get_data = DB::table('time_sheet_user')->whereIn('id', $request->id)->update($datas);
        if ($get_data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Terpilih berhasil di ubah'
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function alltimesheet($id){

        $man_hoursHO = TimeSheetUser::where('id_karyawan',$id)
                                        ->where('cost_account_id',1)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
        // return $man_hoursHO;
        if(count($man_hoursHO) > 0){
            $hitungHO = 0;
            foreach($man_hoursHO as $HO){
                $hitungHO += $HO->man_hours;
            };

            $man_hoursproposal = TimeSheetUser::where('id_karyawan',$id)
                                            ->where('cost_account_id',2)->where('status',1)
                                            ->select('man_hours')
                                            ->get();
            $hitungproposal = 0;
            foreach($man_hoursproposal as $proposal){
                $hitungproposal += $proposal->man_hours;
            };

            $man_hoursproject = TimeSheetUser::where('id_karyawan',$id)
                                            ->where('cost_account_id',3)->where('status',1)
                                            
                                            ->select('man_hours')
                                            ->get();
            $hitungproject = 0;
            foreach($man_hoursproject as $project){
                $hitungproject += $project->man_hours;
            };
            
        $totalTimeSheet = $hitungHO + $hitungproposal + $hitungproject ;
        $presentaseHO = $hitungHO/$totalTimeSheet * 100;
        $presentaseProposal = $hitungproposal/$totalTimeSheet* 100;
        $presentaseProject = $hitungproject/$totalTimeSheet* 100;
        $HO_format = number_format($presentaseHO,2);
        $Proposal_format = number_format($presentaseProposal,2);
        $Project_format = number_format($presentaseProject,2);
        $get_id = $id;
        $getmonths = TimeSheetUser::where('id_karyawan', $id)
                        ->where('status',1)
                        ->oldest('tanggal_kerja')
                        ->first();

        $getyears = TimeSheetUser::where('id_karyawan', $id)
                    ->where('status',1)
                    ->latest('tanggal_kerja')
                    ->first();
        
        $convertA = date("F Y", strtotime($getmonths->tanggal_kerja));
        $convertB = date("F Y", strtotime($getyears->tanggal_kerja));
        // return $convertA;

        $nama_bulan = $convertA." "."-"." ".$convertB;
    }
        else{
            $HO_format = "0";
            $Proposal_format = "0";
            $Project_format = "0";
            $get_id = $id;
            $nama_bulan  = "";
        }
        
        $variables = compact("HO_format","Proposal_format","Project_format","get_id", "nama_bulan");
    
        return view('timesheet/ho/show-ceo')->with($variables);
    }

    public function filter(Request $request, $id){
     
        $month = $request->input('month');
        $year = $request->input('year');
        $jenis_records = $request->input('jenis_record');
        $ids = $id;
        if($jenis_records == ''){
            // return $this->alltimesheet($ids);
            return redirect('all-time-sheet/'.$id)->with('failed', 'Inputan anda belum lengkap. Silahkan periksa kembali inputan anda.');
        }
        
        elseif($jenis_records == "perbulan"){
            if($year == '' && $month == ''){
                return $this->alltimesheet($ids);
            }
            else{
            $valuemonth1 = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja',$month)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',1)->where('status',1)
                                        ->select('man_hours')
                                        // ->groupBy('tanggal_kerja')
                                        // ->selectRaw('MONTH(tanggal_kerja) as bulan')
                                        ->get();
            $hitungHO = 0;
            foreach($valuemonth1 as $HO){
                $hitungHO += $HO->man_hours;
            };

            $valuemonth2 = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja',$month)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',2)->where('status',1)
                                        ->select('man_hours')
                                        // ->groupBy('tanggal_kerja')
                                        // ->selectRaw('MONTH(tanggal_kerja) as bulan')
                                        ->get();
            $hitungproposal = 0;
            foreach($valuemonth2 as $proposal){
            $hitungproposal += $proposal->man_hours;
            };

            $valuemonth3 = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja',$month)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',3)->where('status',1)
                                        ->select('man_hours')
                                        // ->groupBy('tanggal_kerja')
                                        // ->selectRaw('MONTH(tanggal_kerja) as bulan')
                                        ->get();
            $hitungproject = 0;
            foreach($valuemonth3 as $project){
                $hitungproject += $project->man_hours;
            };
                try{
                    if($hitungHO == 0 && $hitungproposal == 0 && $hitungproject == 0){
                        $HO_format = "0";
                        $Proposal_format = "0";
                        $Project_format = "0";
                        $get_id = $id;
                        $get_name_month = date("F", mktime(0, 0, 0, $month, 1));
                        $nama_bulan = $get_name_month." ".$year;
                        $variables = compact("HO_format","Proposal_format","Project_format","get_id","nama_bulan");
                        return view('timesheet/ho/show-ceo')->with($variables);
                    }
                    else{
                        $totalTimeSheet = $hitungHO + $hitungproposal + $hitungproject ;
                        $presentaseHO = $hitungHO/$totalTimeSheet * 100;
                        $presentaseProposal = $hitungproposal/$totalTimeSheet* 100;
                        $presentaseProject = $hitungproject/$totalTimeSheet* 100;
                        $HO_format = number_format($presentaseHO,2);
                        $Proposal_format = number_format($presentaseProposal,2);
                        $Project_format = number_format($presentaseProject,2);
                        $get_id = $id;
                        $get_name_month = date("F", mktime(0, 0, 0, $month, 1));
                        $nama_bulan = $get_name_month." ".$year;
                        $variables = compact("HO_format","Proposal_format","Project_format","get_id", "nama_bulan");
                        return view('timesheet/ho/show-ceo')->with($variables);
                }
            }
            catch(\Exception $e){
                return redirect('all-time-sheet/'.$id)->with('failed', 'Silahkan Cek Kembali Inputan Filter Anda');
            }
         }
        }
        elseif($jenis_records == "per3bulan"){
            $q1 = $request->pertigabulan;
            if($year == '' && $q1 == ''){
                return $this->alltimesheet($ids);
            }
            elseif($year != '' && $q1 == ''){
                return redirect('all-time-sheet/'.$id)->with('failed', 'Inputan anda belum lengkap. Silahkan periksa kembali inputan anda.');
            }
            elseif($year != '' && $q1 == "q1"){
                $jan = "01";
                $mar = "03";
                // HO
                $ho = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $jan)
                                        ->whereMonth('tanggal_kerja', '<=', $mar)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',1)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungHO = 0;
                foreach($ho as $h){
                    $hitungHO += $h->man_hours;
                    };
                
                // Proposal
                $props = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $jan)
                                        ->whereMonth('tanggal_kerja', '<=', $mar)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',2)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproposal = 0;
                foreach($props as $p){
                    $hitungproposal += $p->man_hours;
                    };

                // Projek
                $projek = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $jan)
                                        ->whereMonth('tanggal_kerja', '<=', $mar)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',3)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproject = 0;
                foreach($projek as $pr){
                    $hitungproject += $pr->man_hours;
                    };

                $nama_bulan = "(Q1) Januari - Maret"." ".$year;
                }

            elseif($year != '' && $q1 == "q2"){
                $april = "04";
                $juni = "06";

               // HO
                $ho = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $april)
                                        ->whereMonth('tanggal_kerja', '<=', $juni)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',1)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungHO = 0;
                foreach($ho as $h){
                    $hitungHO += $h->man_hours;
                    };
                
                // Proposal
                $props = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $april)
                                        ->whereMonth('tanggal_kerja', '<=', $juni)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',2)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproposal = 0;
                foreach($props as $p){
                    $hitungproposal += $p->man_hours;
                    };

                // Projek
                $projek = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $april)
                                        ->whereMonth('tanggal_kerja', '<=', $juni)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',3)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproject = 0;
                foreach($projek as $pr){
                    $hitungproject += $pr->man_hours;
                    };

                $nama_bulan = "(Q2) April - Juni"." ".$year;
                }
            
            elseif($year != '' && $q1 == "q3"){
                $juli = "07";
                $sept = "09";

               // HO
                $ho = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $juli)
                                        ->whereMonth('tanggal_kerja', '<=', $sept)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',1)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungHO = 0;
                foreach($ho as $h){
                    $hitungHO += $h->man_hours;
                    };
                
                // Proposal
                $props = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $juli)
                                        ->whereMonth('tanggal_kerja', '<=', $sept)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',2)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproposal = 0;
                foreach($props as $p){
                    $hitungproposal += $p->man_hours;
                    };

                // Projek
                $projek = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $juli)
                                        ->whereMonth('tanggal_kerja', '<=', $sept)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',3)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproject = 0;
                foreach($projek as $pr){
                    $hitungproject += $pr->man_hours;
                    };

                $nama_bulan = "(Q3) Juli - September"." ".$year;
            }

            elseif($year != '' && $q1 == "q4"){
                $okt = "10";
                $des = "12";

               // HO
                $ho = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $okt)
                                        ->whereMonth('tanggal_kerja', '<=', $des)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',1)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungHO = 0;
                foreach($ho as $h){
                    $hitungHO += $h->man_hours;
                    };
                
                // Proposal
                $props = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $okt)
                                        ->whereMonth('tanggal_kerja', '<=', $des)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',2)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproposal = 0;
                foreach($props as $p){
                    $hitungproposal += $p->man_hours;
                    };

                // Projek
                $projek = TimeSheetUser::where('id_karyawan',$id)
                                        ->whereMonth('tanggal_kerja','>=', $okt)
                                        ->whereMonth('tanggal_kerja', '<=', $des)
                                        ->whereYear('tanggal_kerja',$year)
                                        ->where('cost_account_id',3)->where('status',1)
                                        ->select('man_hours')
                                        ->get();
                $hitungproject = 0;
                foreach($projek as $pr){
                    $hitungproject += $pr->man_hours;
                    };

                $nama_bulan = "(Q4) Oktober - Desember"." ".$year;
                }
                if($hitungHO == 0 && $hitungproposal == 0 && $hitungproject == 0){
                    $HO_format = "0";
                    $Proposal_format = "0";
                    $Project_format = "0";
                    $get_id = $id;
                    $variables = compact("HO_format","Proposal_format","Project_format","get_id", "nama_bulan");
                    return view('timesheet/ho/show-ceo')->with($variables);
                }
                else{
                $totalTimeSheet = $hitungHO + $hitungproposal + $hitungproject ;
                $presentaseHO = $hitungHO/$totalTimeSheet * 100;
                $presentaseProposal = $hitungproposal/$totalTimeSheet* 100;
                $presentaseProject = $hitungproject/$totalTimeSheet* 100;
                $HO_format = number_format($presentaseHO,2);
                $Proposal_format = number_format($presentaseProposal,2);
                $Project_format = number_format($presentaseProject,2);
                $get_id = $id;
                $variables = compact("HO_format","Proposal_format","Project_format","get_id", "nama_bulan");
                return view('timesheet/ho/show-ceo')->with($variables);
                }
    }
}
}
