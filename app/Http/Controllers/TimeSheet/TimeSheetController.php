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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SummaryPersonalTimesheet;
use App\Exports\SummaryAll;

class TimeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timesheetProposal()
    {
        $data['all_proposals'] = TimeSheetUser::where('status',0)
                            ->where('proposal_id', '!=', 0)
                            ->where('cost_account_id',2)
                            ->orderBy('tanggal_kerja', 'desc')
                            ->get();
                            
        $data['proposal'] = Proposal::orderBy('created_at','desc')->get();
        $data['hari_libur'] = DB::table('master_libur')->get();
        return view('timesheet/proposal/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTimeSheetProposal()
    {
        $data['lokasi_proyek']= Proyek::all();
        $data['resource'] = Resource::all();
        return view('timesheet/proposal/create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTimesheetProposal(Request $request)
    {
        $input = $request->all();
        $resource = $input['resource_id'];
        $resource = implode(',', $resource);
        Proposal::create([
            'nama'=> $request->nama_proposal,
            'lokasi_id'=> $request->lokasi_id,
            'status' => 0,
            'status_approved'=>0,
            'created_at'=> Carbon::now()->toDateTimeString(),
            'resource_id'=> $resource
        ]);

        // $lokasi = new Proyek();
        // $lokasi->nama = $request->lokasi_id;
        // $lokasi->lokasi = $request->lokasi_id;
        // $lokasi->code_loc = $request->lokasi_id;
        // $lokasi->created_at = Carbon::now()->toDateTimeString();
        // $lokasi->save();

        return redirect('time-sheet-proposal')->with('success', 'Berhasil Tambah Proposal. Silahkan Menunggu Proposal Disetujui');
    }

    public function destroyTimesheetProposal($id){
        $proposal = Proposal::destroy($id);
        if($proposal){
            return response()->json([
                'success'=> 'Proposal berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failed'=> 'Proposal gagal dihapus'
            ]);
        }
        return response($response);
    }

    public function detailTimeSheetProposal($id){
        $dates = date('Y-m-d', strtotime(Carbon::now()));

        $data['proposal'] = Proposal::where('id', $id)->get();

        $data['approval'] = TimeSheetUser::where('proposal_id', $id)
                            ->where('status',0)
                            ->where('cost_account_id',2)
                            ->orderBy('tanggal_kerja', 'desc')
                            ->get();
                            
        $data['timesheet'] = TimeSheetUser::where('proposal_id', $id)
                            ->where('status',1)
                            ->where('cost_account_id',2)
                            ->where('tanggal_kerja', $dates)
                            // ->groupBy('resource_id')
                            ->get();

        $data['chart_proposal'] = chartProposal::where('proposal_id', $id)->get();
        
        $data['hari_libur'] = DB::table('master_libur')->get();

        return view('timesheet/proposal/detail')->with($data);
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
    public function ubahApprovalTimesheet($id)
    {
        $data['approve'] = TimeSheetUser::find($id);
        return view('timesheet/proposal/approval/edit')->with($data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateApprovalTimesheet(Request $request, $id)
    {
        $error = $request->validate([
            'status' => 'required',
        ]);
        
    if($error){
        $data = TimeSheetUser::findOrNew($id);
        $data->status = $request->status;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->approved_by = Auth::user()->user_login->nama;
        $data->tgl_approved = Carbon::now()->toDateTimeString();
        $data->save();
        
        $get_man_hours = TimeSheetUser::where('status',1)
                        ->where('ket',1)
                        ->where('proposal_id', $request->proposal_id)
                        ->get();
        $get_man_hours2 = TimeSheetUser::where('status',1)
                        ->where('ket',2)
                        ->where('proposal_id', $request->proposal_id)
                        ->get();

        $count_man_hours = Proposal::where('id', $request->proposal_id)->first();
        
        if($data->ket == 1){
            $hitung = 0;
            foreach($get_man_hours as $manhours){
                $hitung += $manhours->man_hours;
            }
            $count_man_hours->man_hours = $hitung;
            $count_man_hours->save();
        }

        elseif($data->ket == 2){
            $hitungholiday = 0;
            foreach($get_man_hours2 as $manhours2){
                $hitungholiday += $manhours2->man_hours;
            }
            $count_man_hours->holidays = $hitungholiday;
            $count_man_hours->save();
        }

        $chart = chartProposal::where('proposal_id', $request->proposal_id)
                ->where('resource_id', $request->resource_id)
                ->first();

        $hitung = 0;
        if(!empty($chart)){
            if($chart->proposal_id == $data->proposal_id && $chart->resource_id == $data->resource_id){
                $datas = TimeSheetUser::where('id',$id)->get();
                // return $datas;
                $hitungs = $chart->total_man_hours;

                foreach($datas as $ts){
                    if($ts->resource_id == $chart->resource_id){
                        if($hitungs != 0){
                            $hitungs += $ts->man_hours;
                        }
                    }
                }
                $chart->total_man_hours = $hitungs;
                $chart->updated_at = Carbon::now()->toDateTimeString();
                $chart->save();
            }
        }

        else{
            $save_chart = new chartProposal();
            $save_chart->resource_id = $data->resource_id;
            $save_chart->cost_account_id = 2;
            $save_chart->proposal_id = $data->proposal_id;
            $save_chart->id_karyawan = $data->id_karyawan;
            $save_chart->total_man_hours = $data->man_hours;
            $save_chart->created_at = Carbon::now()->toDateTimeString();
            $save_chart->save();
        }

        // return redirect('detail-timesheet/'.$data->proposal_id)->with('success', 'Status timesheet berhasil diubah');
        return redirect('time-sheet-proposal')->with('success', 'Status timesheet berhasil diubah');
        
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
        //
    }

    // Approval by CEO 
    public function approvalTimesheetProposal(){
        $data['new_proposal'] = Proposal::orderBy('created_at','desc')->get();

        $data['new_project'] = Project::orderBy('created_at','desc')->get();
        
        $data['timesheet'] = TimeSheetUser::where('cost_account_id', 1)
                            ->where('status',0)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $data['data_karyawan'] = Employee::where('nik', '!=', 'admin')
                            ->where('nik', '!=', 'finance')
                            ->where('nik', '!=', 'asset.management')
                            ->where('nik', '!=', 'HRD')
                            ->get();
                            
        return view('timesheet/proposal/approval/index_approval_by_ceo')->with($data);
    }

    public function ubahApprovalTimesheetProposal($id){
        $data['ubah_status'] = Proposal::find($id);
        return view('timesheet/proposal/approval/approval_by_ceo')->with($data);
    }

    public function updateApprovalTimesheetProposal(Request $request, $id){
        try{
            $data = Proposal::findOrNew($id);
            $data->status_approved = $request->status_approved;
            $data->tgl_approved = Carbon::now()->toDateTimeString();
            $data->updated_at = Carbon::now()->toDateTimeString();
            // $data->tgl_open_close = Carbon::now()->toDateTimeString();
            if($request->status_approved == 1){
                $data->status = 1;
            }
            else{
                $data->status = 2;
            }
            $data->save();
            return redirect('approval-timesheet-ceo')->with('success', 'Status approval berhasil diubah');
        }
        catch(\Exception $e){
            return redirect('approval-timesheet-ceo')->with('failed', 'Status approval gagal diubah');
        }
    }

    public function ubahApprovalTimesheetProject($id){
            $data['ubah_status'] = Project::find($id);
            return view('timesheet/project/approval/edit')->with($data);
    }

    public function updateApprovalTimesheetProject(Request $request, $id){
        try{
            $data = Project::findOrNew($id);
            $data->status_approved = $request->status_approved;
            $data->tgl_approved = Carbon::now()->toDateTimeString();
            $data->updated_at = Carbon::now()->toDateTimeString();

            if($request->status_approved == 1){
                $data->status = 1;
            }
            else{
                $data->status = 2;
            }
            $data->save();

            return redirect('approval-timesheet-ceo')->with('success', 'Status approval berhasil diubah');
        }

        catch(\Exception $e){
            return redirect('approval-timesheet-ceo')->with('failed', 'Status approval gagal diubah');
        }

    }

    // Open Close Proposal 
    public function editCloseProposal($id){
        $data['close'] = Proposal::find($id);
        return view('timesheet/proposal/ubah_status')->with($data);
    }

    public function updateCloseProposal(Request $request, $id){
        $data = Proposal::findOrNew($id);
        $data->status = $request->status;
        $data->tgl_open_close = Carbon::now()->toDateTimeString();
        $data->save();
        return redirect('time-sheet-proposal')->with('success', 'Status Proposal Berhasil Diubah');
    }

    // Approval Timesheet General-Head Office
    public function timesheetHO(){
        $date       =  \Carbon\Carbon::now();
        $lastMonth  =  $date->subMonth()->format('m');
        $next_month =  date("m", strtotime("$date +1 month"));
        $this_year  =  $date->format('Y');

        $now        = Carbon::now()->toDateTimeString();
        $month_name = date("M", strtotime($now));

        $first_off      = $this_year."-".$lastMonth."-"."26";
        $last_cut_off   = $this_year."-".$next_month."-"."25";
        
        $timesheet = TimeSheetUser::where('cost_account_id', 1)
                            ->where('status',0)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $data_karyawan = Employee::where('nik', '!=', 'admin')
                            ->where('nik', '!=', 'finance')
                            ->where('nik', '!=', 'asset.management')
                            ->where('nik', '!=', 'HRD')
                            ->get();
        
        $man_hoursHO    = TimeSheetUser::select(DB::raw('SUM(man_hours) as HO_manhours'))
                            ->where('cost_account_id',1)->where('status',1)
                            ->whereDate('tanggal_kerja', '>=', $first_off)
                            ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                            ->groupBy('cost_account_id')
                            ->get();
        
        $man_hoursProposal = TimeSheetUser::select(DB::raw('SUM(man_hours) as Proposal_manhours'))
                            ->where('cost_account_id',2)->where('status',1)
                            ->whereDate('tanggal_kerja', '>=', $first_off)
                            ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                            ->groupBy('cost_account_id')
                            ->get();
                       
        $man_hoursProject = TimeSheetUser::select(DB::raw('SUM(man_hours) as Project_manhours'))
                            ->where('cost_account_id',3)->where('status',1)
                            ->whereDate('tanggal_kerja', '>=', $first_off)
                            ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                            ->groupBy('cost_account_id')
                            ->get();
        
        $total_manhours_HO = 0;
        $total_manhours_Proposal = 0;
        $total_manhours_Project = 0;

        foreach($man_hoursHO as $man){
            $total_manhours_HO = $man->HO_manhours;
        }
        foreach($man_hoursProposal as $man){
            $total_manhours_Proposal = $man->Proposal_manhours;
        }
        foreach($man_hoursProject as $man){
            $total_manhours_Project = $man->Project_manhours;
        }
        $totalAll = $total_manhours_HO + $total_manhours_Proposal + $total_manhours_Project;
        
        if($totalAll == 0){
            $persentaseHO = 0;
            $persentaseProposal = 0;
            $persentaseProject = 0;
        }
        else{
            $persentaseHO = ($total_manhours_HO/$totalAll) * 100;
            $persentaseProposal = ($total_manhours_Proposal/$totalAll) * 100;
            $persentaseProject = ($total_manhours_Project/$totalAll) * 100;
        }


        $first_off2      = "26"."/".$lastMonth."/".$this_year;
        $last_cut_off2   = "25"."/".$next_month."/".$this_year;;

        $var = compact('timesheet','data_karyawan', 'persentaseHO', 'persentaseProposal', 'persentaseProject','first_off2','last_cut_off2', 'lastMonth','next_month','month_name', 'total_manhours_HO','total_manhours_Proposal', 'total_manhours_Project');
        
        return view('timesheet/ho/index')->with($var);
    }
    
    // Approval Timesheet General-Head Office
        public function timesheetHO_CEO(){
            $data['timesheet'] = TimeSheetUser::where('cost_account_id', 1)
                                ->where('status',0)
                                ->orderBy('created_at', 'desc')
                                ->get();
            $data['data_karyawan'] = Employee::where('nik', '!=', 'admin')
                                ->where('nik', '!=', 'finance')
                                ->where('nik', '!=', 'asset.management')
                                ->where('nik', '!=', 'HRD')
                                ->get();
                                
        
            return view('timesheet/ho/index2')->with($data);
        }

    public function ubahApprovalTimesheetHO($id){
        $data['approve'] = TimeSheetUser::find($id);
        return view('timesheet/ho/approval/edit')->with($data);
    }

    public function updateApprovalTimesheetHO(Request $request, $id){
        // $req = $request->status;
        // $request->validate([
        //     'status' => 'required'                   
        // ]);

        // if($req != ''){
        //         $data = TimeSheetUser::find($id);
        //         $data->status = $request->status;
        //         $data->updated_at = Carbon::now()->toDateTimeString();
        //         $data->approved_by = Auth::user()->user_login->nama;
        //         $data->tgl_approved = Carbon::now()->toDateTimeString();
        //         $data->save();
        //         return redirect('persentase-timesheet')->with('success', 'Status Time Sheet Berhasil Diubah');
        // }
        
        // else{
        //     return redirect('persentase-timesheet')->with('failed', 'Status Time Sheet Gagal Diubah. Anda belum mengubah status approval');
        // }

        try{
            $data = TimeSheetUser::find($id);
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->approved_by = Auth::user()->user_login->nama;
            $data->tgl_approved = Carbon::now()->toDateTimeString();
            $data->status = $request->status;
            $data->save();

            return redirect('persentase-timesheet')->with('success', 'Status Time Sheet Berhasil Diubah');
        }
        catch(\Exception $e){
            return redirect('persentase-timesheet')->with('failed', 'Status Time Sheet Gagal Diubah. Anda belum mengubah status approval');
        }
    }

    public function filter(Request $request, $id){
     
            $month = $request->input('month');
            $year = $request->input('year');
            $jenis_records = $request->input('jenis_record');
            $ids = $id;
            if($jenis_records == ''){
                // return $this->alltimesheet($ids);
                return redirect('all-timesheet/'.$id)->with('failed', 'Inputan anda belum lengkap. Silahkan periksa kembali inputan anda.');
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
                            return view('timesheet/ho/show')->with($variables);
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
                            return view('timesheet/ho/show')->with($variables);
                    }
                }
                catch(\Exception $e){
                    return redirect('all-timesheet/'.$id)->with('failed', 'Silahkan Cek Kembali Inputan Filter Anda');
                }
             }
            }
            elseif($jenis_records == "per3bulan"){
                $q1 = $request->pertigabulan;
                if($year == '' && $q1 == ''){
                    return $this->alltimesheet($ids);
                }
                elseif($year != '' && $q1 == ''){
                    return redirect('all-timesheet/'.$id)->with('failed', 'Inputan anda belum lengkap. Silahkan periksa kembali inputan anda.');
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
                        return view('timesheet/ho/show')->with($variables);
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
                    return view('timesheet/ho/show')->with($variables);
                    }
        }
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
    
        return view('timesheet/ho/show')->with($variables);
    }

//   --------------------TIMESHEET PROJECT----------------------------------------

    public function TimesheetProject(){
        $data['project'] = Project::orderBy('created_at','desc')->get();
        $data['all_data']   = TimeSheetUser::where('status',0)
                            ->where('cost_account_id',3)
                            ->orderBy('tanggal_kerja', 'desc')
                            ->get();
        $data['hari_libur'] = DB::table('master_libur')->get();
        
        return view('timesheet/project/index')->with($data);
    }
    
    public function Create_Timesheet_project(){
        $data['lokasi_proyek']= Proyek::all();
        $data['resource'] = Resource::all();
        return view('timesheet/project/create')->with($data);
    }

    public function storeTimesheetProject(Request $request)
    {
        $input = $request->all();
        $resource = $input['resource_id'];
        $resource = implode(',', $resource);
        
        // Save to table Master Project
        $master_project = new Proyek();
        $master_project->nama = $request->nama_project;
        $master_project->lokasi = $request->lokasi;
        $master_project->code_loc = $request->code_loc;
        $master_project->created_at = Carbon::now()->toDateTimeString();
        $master_project->save();
        
        $ids = $master_project->id;
        
        // Save to table project
        $project = new Project();
        $project->nama = $request->nama_project;
        $project->lokasi_id = $ids;
        $project->resource_id = $resource;
        $project->created_at = Carbon::now()->toDateTimeString();
        $project->status = 0;
        $project->status_approved = 0;
        $project->save();

        return redirect('timesheet-project')->with('success', 'Berhasil Tambah Project. Silahkan Menunggu Project Disetujui');
    }
    public function destroyTimesheetProject($id){
        $project = Project::destroy($id);
        if($project){
            return response()->json([
                'success'=> 'Project berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failed'=> 'Project gagal dihapus'
            ]);
        }
        return response($response);
    }

    public function detailTimeSheetProject($id){
        $dates = date('Y-m-d', strtotime(Carbon::now()));

        $data['project'] = Project::where('lokasi_id', $id)->get();

        $data['approval'] = TimeSheetUser::where('project_id', $id)
                            ->where('status',0)
                            ->where('cost_account_id',3)
                            ->orderBy('tanggal_kerja', 'desc')
                            ->get();
                            
        $data['timesheet'] = TimeSheetUser::where('project_id', $id)
                            ->where('status',1)
                            ->where('cost_account_id',3)
                            ->where('tanggal_kerja', $dates)
                            ->get();
        // return $id;

        $data['chart_project'] = chartProject::where('project_id', $id)->get();

        $data['hari_libur'] = DB::table('master_libur')->get();

        return view('timesheet/project/detail')->with($data);
    }
    
    // Approval Timesheet project by VP
    public function editTimesheetPR($id){
        $data['approve'] = TimeSheetUser::find($id);
        return view('timesheet/project/ubahstatus')->with($data);
    }

    public function updateTimesheetPR(Request $request, $id){
        $error = $request->validate([
            'status' => 'required',
        ]);
        
    if($error){
        $data = TimeSheetUser::findOrNew($id);
        $data->status = $request->status;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->approved_by = Auth::user()->user_login->nama;
        $data->tgl_approved = Carbon::now()->toDateTimeString();
        $data->save();
        
        $get_man_hours = TimeSheetUser::where('status',1)
                        ->where('ket',1)
                        ->where('project_id', $request->project_id)
                        ->get();
        $get_man_hours2 = TimeSheetUser::where('status',1)
                        ->where('ket',2)
                        ->where('project_id', $request->project_id)
                        ->get();

        $count_man_hours = Project::where('lokasi_id', $request->project_id)->first();
        
        if($data->ket == 1){
            $hitung = 0;
            foreach($get_man_hours as $manhours){
                $hitung += $manhours->man_hours;
            }
            $count_man_hours->man_hours = $hitung;
            $count_man_hours->save();
        }

        elseif($data->ket == 2){
            $hitungholiday = 0;
            foreach($get_man_hours2 as $manhours2){
                $hitungholiday += $manhours2->man_hours;
            }
            $count_man_hours->holidays = $hitungholiday;
            $count_man_hours->save();
        }

        $chart = chartProject::where('project_id', $request->project_id)
                ->where('resource_id', $request->resource_id)
                ->first();

        $hitung = 0;
        if(!empty($chart)){
            if($chart->project_id == $data->project_id && $chart->resource_id == $data->resource_id){
                $datas = TimeSheetUser::where('id',$id)->get();
                // return $datas;
                $hitungs = $chart->total_man_hours;

                foreach($datas as $ts){
                    if($ts->resource_id == $chart->resource_id){
                        if($hitungs != 0){
                            $hitungs += $ts->man_hours;
                        }
                    }
                }
                $chart->total_man_hours = $hitungs;
                $chart->updated_at = Carbon::now()->toDateTimeString();
                $chart->save();
            }
        }

        else{
            $save_chart = new chartProject();
            $save_chart->resource_id = $data->resource_id;
            $save_chart->cost_account_id = 3;
            $save_chart->project_id = $data->project_id;
            $save_chart->id_karyawan = $data->id_karyawan;
            $save_chart->total_man_hours = $data->man_hours;
            $save_chart->created_at = Carbon::now()->toDateTimeString();
            $save_chart->save();
        }

        // return redirect('detail-timesheet-project/'.$data->project_id)->with('success', 'Status timesheet berhasil diubah');
        return redirect('timesheet-project')->with('success', 'Status timesheet berhasil diubah');
        }
    }

    public function editResourceProject($id){
        $data['res'] = Project::where('lokasi_id', $id)->first();
        $datas = Project::where('lokasi_id',$id)->first();
        
        $res_project = explode(",", $datas->resource_id);
        $data['master_resource'] = Resource::pluck('id');

        $data['dt'] = Resource::whereIn('id', $res_project)->get();
        $data['resources'] = Resource::all();
        
        return view('timesheet/project/edit_resource')->with($data);
    }

    public function updateResourceProject(Request $request, $id){
        try{
            $data = Project::findOrNew($id);
            $input = $request->all();
            $resource = $input['resource_id'];
            $resource = implode(',', $resource);
            $data->resource_id = $resource;
            $data->save();
            return redirect('timesheet-project')->with('success', 'Resource berhasil diperbaharui');
        }
        catch(\Exception $e){
            return redirect('/timesheet-project')->with('failed', 'Inputan gagal disimpan. Silahkan periksa kembali inputan anda');
        }
    }

    // Open Close Project
    public function editCloseProject($id){
        $data['open_close'] = Project::where('lokasi_id', $id)->first();
        return view('timesheet/project/open_close')->with($data);
    }

    public function updateCloseProject(Request $request, $id){
        $data = Project::findOrNew($id);
        $data->status = $request->status;
        $data->tgl_open_close = Carbon::now()->toDateTimeString();
        $data->save();
        return redirect('timesheet-project')->with('success', 'Status Project Berhasil Diubah');
    }

    // Edit dan Update Resource Proposal
    public function editResourceProposal($id){
        $data['res'] = Proposal::where('id', $id)->first();
        $datas = Proposal::where('id',$id)->first();
        
        $res_proposal = explode(",", $datas->resource_id);
        $data['master_resource'] = Resource::pluck('id');

        $data['dt'] = Resource::whereIn('id', $res_proposal)->get();
        $data['resources'] = Resource::all();
        
        return view('timesheet/proposal/edit_resource')->with($data);
    }

    public function updateResourceProposal(Request $request, $id){
        try{
            $data = Proposal::findOrNew($id);
            $input = $request->all();
            $resource = $input['resource_id'];
            $resource = implode(',', $resource);
            $data->resource_id = $resource;
            $data->save();
            return redirect('time-sheet-proposal')->with('success', 'Resource berhasil diperbaharui');
        }
        catch(\Exception $e){
            return redirect('/time-sheet-proposal')->with('failed', 'Inputan gagal disimpan. Silahkan periksa kembali inputan anda');
        }
    }

    
    public function TimesheetMarketing(){
        $data['app_marketing'] = TimeSheetUser::where('cost_account_id', 2)
                                        ->where('status',0)
                                        ->where('proposal_id',0)
                                        ->orderBy('tanggal_kerja', 'desc')
                                        ->get();
        return view('timesheet/proposal/approval_marketing')->with($data);
    }
    
    public function editTimesheetMarketing($id){
        $data['marketing'] = TimeSheetUser::find($id);
        return view('timesheet/proposal/edit_approval_marketing')->with($data);
    }
    
    public function updateTimesheetMarketing(Request $request, $id){
        try{
            $data = TimeSheetUser::findOrNew($id);
            $data->status = $request->status;
            $data->approved_by = Auth::user()->user_login->nama;
            $data->tgl_approved = Carbon::now()->toDateTimeString();
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();

            return redirect('time-sheet-marketing')->with('success', 'Status approval berhasil diubah');
        }

        catch(\Exception $e){
            return redirect('time-sheet-marketing')->with('failed', 'Status approval gagal diubah');
        }
        
    }
    
        public function approvalAllHO(Request $request){
        $getdatas = TimeSheetUser::whereIn('id', $request->id)->get();
        // dd($getdatas);

        foreach($getdatas as $data) {
            // $get_data = DB::table('time_sheet_user')->where('id', $data['id'])->update($datas);
            $get_data = TimeSheetUser::findOrNew($data->id);
            $get_data->status = $request->status;
            $get_data->updated_at = Carbon::now()->toDateTimeString();
            $get_data->approved_by = Auth::user()->user_login->nama;
            $get_data->tgl_approved = Carbon::now()->toDateTimeString();
            $get_data->save();
        }
        
        if ($get_data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Terpilih berhasil di ubah'
            ]);
        }
    }
    
        // Filter Summary 
    public function FilterSummary(Request $request){
        $get_month  = $request->month;
        $get_year   = $request->year;
        

        // Get Name of Month 
        if($get_month ==  01){
            $month_name = "Jan";
        }
        else if($get_month ==  02){
            $month_name = "Feb";
        }
        else if($get_month ==  03){
            $month_name = "Mar";
        }
        else if($get_month ==  04){
            $month_name = "Apr";
        }
        else if($get_month ==  05){
            $month_name = "May";
        }
        else if($get_month ==  06){
            $month_name = "July";
        }
        else if($get_month ==  07){
            $month_name = "June";
        }
        else if($get_month ==  8){
            $month_name = "Augst";
        }
        else if($get_month ==  9){
            $month_name = "Sep";
        }
        else if($get_month ==  10){
            $month_name = "Okt";
        }
        else if($get_month ==  11){
            $month_name = "Nov";
        }
        else{
            $month_name = "Des";
        }

        $lastMonth  =  $get_month - 1;

        $first_off      = $get_year."-"."0".$lastMonth."-"."26";
        $last_cut_off   = $get_year."-".$get_month."-"."25";

        // return $first_off." "."s/d"." ".$last_cut_off;
        $timesheet = TimeSheetUser::where('cost_account_id', 1)
                    ->where('status',0)
                    ->orderBy('created_at', 'desc')
                    ->get();

        $data_karyawan = Employee::where('nik', '!=', 'admin')
                        ->where('nik', '!=', 'finance')
                        ->where('nik', '!=', 'asset.management')
                        ->where('nik', '!=', 'HRD')
                        ->get();

        // Summary Report by Cost Account
        $man_hoursHO = TimeSheetUser::select(DB::raw('SUM(man_hours) as HO_manhours'))
                        ->where('cost_account_id',1)->where('status',1)
                        ->whereDate('tanggal_kerja', '>=', $first_off)
                        ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                        ->groupBy('cost_account_id')
                        ->get();

        $man_hoursProposal = TimeSheetUser::select(DB::raw('SUM(man_hours) as Proposal_manhours'))
                        ->where('cost_account_id',2)->where('status',1)
                        ->whereDate('tanggal_kerja', '>=', $first_off)
                        ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                        ->groupBy('cost_account_id')
                        ->get();
                       
        $man_hoursProject = TimeSheetUser::select(DB::raw('SUM(man_hours) as Project_manhours'))
                        ->where('cost_account_id',3)->where('status',1)
                        ->whereDate('tanggal_kerja', '>=', $first_off)
                        ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                        ->groupBy('cost_account_id')
                        ->get();

        

        $total_manhours_HO = 0;
        $total_manhours_Proposal = 0;
        $total_manhours_Project = 0;

        foreach($man_hoursHO as $man){
            $total_manhours_HO = $man->HO_manhours;
        }
        foreach($man_hoursProposal as $man){
            $total_manhours_Proposal = $man->Proposal_manhours;
        }
        foreach($man_hoursProject as $man){
            $total_manhours_Project = $man->Project_manhours;
        }

        $totalAll = $total_manhours_HO + $total_manhours_Proposal + $total_manhours_Project;
        
        if($totalAll == 0){
            $persentaseHO = 0;
            $persentaseProposal = 0;
            $persentaseProject = 0;
        }
        else{
            $persentaseHO = ($total_manhours_HO/$totalAll) * 100;
            $persentaseProposal = ($total_manhours_Proposal/$totalAll) * 100;
            $persentaseProject = ($total_manhours_Project/$totalAll) * 100;
        }

        $var = compact('timesheet','data_karyawan', 'persentaseHO', 'persentaseProposal', 'persentaseProject','month_name','total_manhours_HO','total_manhours_Proposal', 'total_manhours_Project');
        return view('timesheet/ho/index')->with($var);

    }
    
    // Export Excel timesheet
    public function downloadSummaryTimesheetPersonal(Request $request){
        
        $id     = $request->nik;
        $month  = $request->month;
        $year   = $request->year;

        $ls_month  = $month - 1;
        $ls_year   = $year - 1;

        if($ls_month == 0){
            $months = 12;
            $years  = $ls_year;
        }
        else{
            $months = $month;
            $years  = $year;
        }
        
        $first_off      = $years."-".$ls_month."-"."26";
        $last_cut_off   = $years."-".$month."-"."25";

        if($id == "all"){
            $employee = Employee::where('nik', '!=', 'admin')
                        ->where('nik', '!=', 'finance')
                        ->where('nik', '!=', 'asset.management')
                        ->where('nik', '!=', 'HRD')
                        ->get();
            
            $data = DB::table('karyawan')->join('time_sheet_user', function($join){
                    $join->on('karyawan.nik','=','time_sheet_user.id_karyawan');
                    })
                    ->whereDate('time_sheet_user.tanggal_kerja', '>=', $first_off)
                    ->whereDate('time_sheet_user.tanggal_kerja', '<=', $last_cut_off)
                    ->select('karyawan.nama', 'karyawan.nik', 
                        DB::raw('COUNT(DISTINCT(time_sheet_user.tanggal_kerja)) as total_kehadiran'))
                    ->groupBy('karyawan.id')
                    ->get();

            // return (new SummaryAll($id, $data, $employee))->download("Summary Timesheet All Employee.xlsx"); 
            return Excel::download(new SummaryAll($years,$month,$data, $employee), 'Summary Timesheet All Employee.xlsx');       
        }

        else{
            $nm_employee = Employee::where('nik', $id)->first();
            $employee = Employee::where('nik', $id)->get();
            $data = TimeSheetUser::where('id_karyawan', $id)
                    ->whereDate('tanggal_kerja', '>=', $first_off)
                    ->whereDate('tanggal_kerja', '<=', $last_cut_off)
                    ->get();
            return (new SummaryPersonalTimesheet($id, $data, $employee))->download("Summary Timesheet Personnel ".$nm_employee->nama.".xlsx");        
        }
         
    }

}
