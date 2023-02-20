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
use App\Exports\TimesheetHOExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SummaryPersonalTimesheet;
use Illuminate\Http\Request;
use App\Exports\SummaryAll;
use App\Costaccount;


class TimesheetApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Approval Timesheet
        $timesheet  = TimeSheetUser::leftJoin('cost_account', function($join){
                    $join->on('time_sheet_user.cost_account_id','=','cost_account.id');
                    })
                    ->where('time_sheet_user.status', 0)
                    ->where('cost_account.approved', Auth::user()->username)
                    ->select('time_sheet_user.*')
                    ->orderBy('time_sheet_user.created_at', 'DESC')
                    ->get();

        $scope_of_work = Costaccount::all();
        
        $data_karyawan  = Employee::where('nik', '!=', 'admin')
                        ->where('nik', '!=', 'finance')
                        ->where('nik', '!=', 'asset.management')
                        ->where('nik', '!=', 'HRD')
                        ->get();
                        
        $date       =  \Carbon\Carbon::now();
        $lastMonth  =  $date->subMonth()->format('m');
        $next_month =  date("m", strtotime("$date +1 month"));
        $this_year  =  $date->format('Y');

        $now        = Carbon::now()->toDateTimeString();
        $month_name = date("F Y", strtotime($now));

        $first_off      = $this_year."-".$lastMonth."-"."26";
        $last_cut_off   = $this_year."-".$next_month."-"."25";
        
        $chart_timesheet = Costaccount::select('chart_timesheet')->groupBy('chart_timesheet')->get();
        $dt     = [];
        $dt2    = [];
        
        foreach($chart_timesheet as $charts){
            $scope_of_work = Costaccount::where('chart_timesheet', $charts->chart_timesheet)->pluck('id')->toArray();
            $dt[$charts->chart_timesheet] = $scope_of_work;
        }
        
        foreach($dt as $key => $val){
            $timesheet2  = TimeSheetUser::select(DB::raw('SUM(man_hours) as manhours'))
                ->whereIn('cost_account_id', $val)
                ->where('status',1)
                ->whereDate('tanggal_kerja', '>=', $first_off)
                ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                ->get();

            $dt2[$key] = $timesheet2;
        }
        
        $total_manhours_HO = 0;
        $total_manhours_Proposal = 0;
        $total_manhours_Project = 0;

        foreach($dt2 as $man=> $val_manhours){
            if($man == "HO"){
                foreach($val_manhours as $ho){
                    $total_manhours_HO = $ho->manhours;
                }
                
            }
            elseif($man == "Proposal"){
                foreach($val_manhours as $proposal){
                    $total_manhours_Proposal = $proposal->manhours;
                }
            }
            else{
                foreach($val_manhours as $project){
                    $total_manhours_Project = $project->manhours;
                }
            }
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
        $last_cut_off2   = "25"."/".$next_month."/".$this_year;

        $var = compact('timesheet','data_karyawan','scope_of_work','chart_timesheet','persentaseHO', 'persentaseProposal', 'persentaseProject','first_off2','last_cut_off2', 'lastMonth','next_month','month_name', 'total_manhours_HO','total_manhours_Proposal', 'total_manhours_Project');
        
        return view('timesheet/approval/index')->with($var);
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
        try{
            $data = TimeSheetUser::find($id);
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->approved_by = Auth::user()->user_login->nama;
            $data->tgl_approved = Carbon::now()->toDateTimeString();
            $data->status = $request->status;
            $data->save();

            return redirect('approval-timesheet')->with('success', 'Successfully approved the timesheet');
        }
        catch(\Exception $e){
            return redirect('approval-timesheet')->with('failed', 'Failed approved the timesheet');
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
                'message' => 'Timesheet changed successfully'
            ]);
        }
    }

    public function downloadSummaryTimesheetPersonal(Request $request){
        
        $id     = $request->nik;
        $month  = $request->month;
        $year   = $request->year;

        $ls_month  = $month - 1;
        $ls_year   = $year - 1;

        // if($ls_month == 0){
        //     $months = 12;
        //     $years  = $ls_year;
        // }
        // else{
        //     $months = $month;
        //     $years  = $year;
        // }
        
        if($ls_month == 0){
            $months = 12;
            $years = $year;
            $first_off      = $ls_year."-".$months."-"."26";
            $last_cut_off   = $years."-".$month."-"."25";
        }
        else{
            $months = $month;
            $years  = $year;
            $first_off      = $years."-".$ls_month."-"."26";
            $last_cut_off   = $years."-".$month."-"."25";
        }
        
        // $first_off      = $years."-".$ls_month."-"."26";
        // $last_cut_off   = $years."-".$month."-"."25";

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
            return Excel::download(new SummaryAll($years,$month,$data, $employee, $first_off,$last_cut_off ), 'Summary Timesheet All Employee.xlsx');       
        }

        else{
            $nm_employee = Employee::where('nik', $id)->first();
            $employee = Employee::where('nik', $id)->get();
            $data = TimeSheetUser::where('id_karyawan', $id)
                    ->whereDate('tanggal_kerja', '>=', $first_off)
                    ->whereDate('tanggal_kerja', '<=', $last_cut_off)
                    ->orderBy('tanggal_kerja', 'asc')
                    ->get();
            return (new SummaryPersonalTimesheet($id, $data, $employee))->download("Summary Timesheet Personnel ".$nm_employee->nama.".xlsx");        
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
    
    
    // Filter Summary 
    public function FilterSummary(Request $request){

        $get_month  = $request->month1;
        $get_year   = $request->year1;

        // Get Name of Month 
        if($get_month ==  01){
            $month_name = "January"." ".$get_year;
        }
        else if($get_month ==  02){
            $month_name = "February"." ".$get_year;
        }
        else if($get_month ==  03){
            $month_name = "March"." ".$get_year;
        }
        else if($get_month ==  04){
            $month_name = "April"." ".$get_year;
        }
        else if($get_month ==  05){
            $month_name = "May"." ".$get_year;
        }
        else if($get_month ==  06){
            $month_name = "July"." ".$get_year;
        }
        else if($get_month ==  07){
            $month_name = "June"." ".$get_year;
        }
        else if($get_month ==  8){
            $month_name = "August"." ".$get_year;
        }
        else if($get_month ==  9){
            $month_name = "September"." ".$get_year;
        }
        else if($get_month ==  10){
            $month_name = "October"." ".$get_year;
        }
        else if($get_month ==  11){
            $month_name = "November"." ".$get_year;
        }
        else{
            $month_name = "December"." ".$get_year;
        }

        $lastMonth  =  $get_month - 1;

        $first_off      = $get_year."-"."0".$lastMonth."-"."26";
        $last_cut_off   = $get_year."-".$get_month."-"."25";

          // Approval Timesheet
        $timesheet  = TimeSheetUser::leftJoin('cost_account', function($join){
                    $join->on('time_sheet_user.cost_account_id','=','cost_account.id');
                    })
                    ->where('time_sheet_user.status', 0)
                    ->where('cost_account.approved', Auth::user()->username)
                    ->select('time_sheet_user.*')
                    ->get();

        $data_karyawan  = Employee::where('nik', '!=', 'admin')
                    ->where('nik', '!=', 'finance')
                    ->where('nik', '!=', 'asset.management')
                    ->where('nik', '!=', 'HRD')
                    ->get();

        // get id chart timesheet (HO, Proposal, Project)
        $chart_timesheet = Costaccount::select('chart_timesheet')->groupBy('chart_timesheet')->get();

        $dt     = [];
        $dt2    = [];
        
        // get scope of work yang termasuk ke masing-masing id chart timesheet
        foreach($chart_timesheet as $charts){
            $scope_of_work = Costaccount::where('chart_timesheet', $charts->chart_timesheet)->pluck('id')->toArray();
            $dt[$charts->chart_timesheet] = $scope_of_work;
        }

        // get timesheet sesuai dengan scope of work
        foreach($dt as $key => $val){
            $timesheet2  = TimeSheetUser::select(DB::raw('SUM(man_hours) as manhours'))
                ->whereIn('cost_account_id', $val)
                ->where('status',1)
                ->whereDate('tanggal_kerja', '>=', $first_off)
                ->whereDate('tanggal_kerja', '<=', $last_cut_off)                
                ->get();

            $dt2[$key] = $timesheet2;
        }

        // Calculate manhours
        
        $total_manhours_HO = 0;
        $total_manhours_Proposal = 0;
        $total_manhours_Project = 0;

        foreach($dt2 as $man=> $val_manhours){
            if($man == "HO"){
                foreach($val_manhours as $ho){
                    $total_manhours_HO = $ho->manhours;
                }
                
            }
            elseif($man == "Proposal"){
                foreach($val_manhours as $proposal){
                    $total_manhours_Proposal = $proposal->manhours;
                }
            }
            else{
                foreach($val_manhours as $project){
                    $total_manhours_Project = $project->manhours;
                }
            }
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

        $var = compact('timesheet','data_karyawan', 'scope_of_work','chart_timesheet','persentaseHO', 'persentaseProposal', 'persentaseProject','month_name','total_manhours_HO','total_manhours_Proposal', 'total_manhours_Project');

        return view('timesheet/approval/index')->with($var);
    }
    
}
