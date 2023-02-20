<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TimeSheetUser;
use App\Resource;
use App\Proposal;
use App\General;
use App\Costaccount;
use App\User;
use App\Proyek;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Employee;
use Illuminate\Support\Facades\DB;
use App\TimeWork;
use App\ResourceProject;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SummaryPersonalTimesheet;

class TimeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['time_sheet'] = TimeSheetUser::where('id_karyawan',Auth::user()->username)->orderBy('tanggal_kerja', 'desc')->orderBy('start_time','desc')->get();
        $data['hari_libur'] = DB::table('master_libur')->get();
        return view('timesheet/user/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['resource'] = Resource::all();
        $data['proposal'] = Proposal::where('status_approved',1)
                            ->where('status','!=',3)
                            ->get();
        $data['work_type'] = General::all();
        $data['cost_account'] = Costaccount::all();
        $data['karyawan'] = Employee::where('nik', Auth::user()->username)->first();
        $data['project'] = Proyek::where('nama', '!=','Head Office')->get();

        // For input start date and end date
        $date = date('yy-m-d', strtotime(Carbon::now()));

        $data['timesheet'] = TimeSheetUser::where('tanggal_kerja', $date)->pluck('tanggal_kerja')->first();
        $data['timework'] = TimeWork::all();

        // $ts = TimeSheetUser::select('tanggal_kerja')->groupBy('tanggal_kerja')->get();

        // foreach($ts as $timeshet){
        //     $arr[] = $timeshet->tanggal_kerja;
        // }
       
        $data['datas']= DB::select("
        SELECT time_sheet_user.tanggal_kerja,time_work.start_time FROM time_work JOIN time_sheet_user ON time_work.start_time != time_sheet_user.start_time
        WHERE time_work.start_time BETWEEN time_sheet_user.start_time and time_sheet_user.end_time
        ");

        // $datas = DB::table('time_work')->join('time_sheet_user', 'time_work.start_time','=','time_sheet_user.start_time')
        //         ->where('time_work.start_time','>','time_sheet_user.start_time')
        //         ->where('time_work.start_time','<','time_sheet_user.end_time')
        //         ->select('time_sheet_user.tanggal_kerja','time_work.start_time')
        //         ->get();

        // dd($datas);
        // $result = array_map(function ($value) {
        //     return (array)$value;
        // }, $datas);

        // $arrays = [];
        // foreach($result as $object)
        //     {
        //         $arrays[] = [$object['tanggal_kerja'],$object['between_time']];
        //     }

        // $data['time_a'] = TimeWork::whereNotIn('start_time', $arrays)->get();
        // $data['time_b'] = TimeWork::get();

        // $timework = TimeWork::pluck('start_time')->toArray();
        // if(in_array($arrays , $timework)){
        //     $data['start_times1'] = TimeWork::whereNotIn('start_time', $arrays)->select('start_time')->get();
        //     dd($data);
        // }
        // else{
        //     $data['start_times2']= TimeWork::get();
        // }

        return view('timesheet/user/create')->with($data);
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
            $tgl_kerja = $request->tanggal_kerja;
            $datas = TimeSheetUser::where('tanggal_kerja', $tgl_kerja)
                    ->get();
            
            // $get_start_time = $request->start_time;
            // $get_end_time = $request->end_time;
            
            $get_start_time = date('H:i:s', strtotime($request->start_time));
            $get_end_time = date('H:i:s', strtotime($request->end_time));

            $data_start_time = DB::select("
                SELECT time_work.start_time FROM time_work JOIN time_sheet_user ON time_work.start_time != time_sheet_user.start_time
                WHERE time_work.start_time > time_sheet_user.start_time AND time_work.start_time < time_sheet_user.end_time
                AND time_sheet_user.tanggal_kerja = '".$tgl_kerja."'
            "); 
            // return $data_start_time; 

            $result = array_map(function ($value) {
                return (array)$value;
            }, $data_start_time);

            $arrays = [];
            foreach($result as $object)
                {
                    $arrays[] = $object['start_time'];
                }

            $master_libur = DB::table('master_libur')->get();
            $tgl_libur = [];
            $start_time_work = [];

            foreach($master_libur  as $libur){
                $tgl_libur[] = $libur->tanggal;
            }

        if(!$datas->isEmpty()){
            foreach($datas  as $starts){
                $start_time_work[] = $starts->start_time;
                $end_time_work[] = $starts->end_time;
            }
            
            // if(in_array($get_start_time, $start_time_work) || in_array($get_start_time, $arrays)){
            //     return redirect('time-sheet')->with('failed', 'Gagal menyimpan. Periksa inputan jam anda');
            // }
            // else if(in_array($get_end_time, $end_time_work) || in_array($get_end_time, $arrays)){
            //     return redirect('time-sheet')->with('failed', 'Gagal menyimpan. Periksa inputan jam anda');
            // }
            // else{
                $cost_acc = $request->cost_account_id;

                $timesheet = new TimeSheetUser();
                $timesheet->id_karyawan = Auth::user()->username;
                $timesheet->start_time = $request->get('start_time');
                $timesheet->end_time = $request->get('end_time');
                $start_times = Carbon::parse($request->start_time);
                $end_times = Carbon::parse($request->end_time);
                $timesheet->tanggal_kerja = $request->get('tanggal_kerja');
                $timesheet->cost_account_id = $request->get('cost_account_id');
                $timesheet->created_at = Carbon::now()->toDateTimeString();
                $timesheet->man_hours = $start_times->diffInHours($end_times);
                $timesheet->status = 0;
                $timesheet->approved_by = "";
                $timesheet->tgl_approved = "";
                $timesheet->id_user = Auth::user()->id_krywn;

            
                // if($request->cost_account_id == 1){
                    // if(in_array($tgl_kerja, $tgl_libur) || date('l', strtotime($tgl_kerja)) == "Sunday"){
                        if(in_array($tgl_kerja, $tgl_libur)){
                        return redirect('time-sheet')->with('failed', 'Sorry, the date you entered is a HOLIDAY');
                    }
                    else{
                        $timesheet->divisi_id = $request->get('divisi_id');
                        // $timesheet->working_type_id = $request->get('type');
                        // $timesheet->resource_id = "";
                        // $timesheet->proposal_id = "";
                        // $timesheet->desc_for_proposal = "";
                        // $timesheet->desc_for_ho = $request->get('desc_for_ho');
                        // $timesheet->ket = 1;
                        $timesheet->detail_of_work = $request->detail_of_work;
                        $timesheet->save();
                        return redirect('time-sheet')->with('success', 'Timesheet successfully added. Please wait for approval');
                    }

                // }
                // else if($request->cost_account_id == 2){
                //     $timesheet->divisi_id = $request->get('divisi_id');
                //     $timesheet->working_type_id = "";
                //     $timesheet->desc_for_proposal = $request->deskripsi_pekerjaan;
                //     $timesheet->resource_id = $request->resource_id;
                //     $timesheet->proposal_id = $request->proposal_id;

                //     if(date('l', strtotime($tgl_kerja)) == "Sunday" || date('l', strtotime($tgl_kerja)) == "Saturday" || in_array($tgl_kerja, $tgl_libur)){
                //         $timesheet->ket = 2; 
                //     }
                //     else{
                //         $timesheet->ket = 1; 
                //     }

                //     $timesheet->save();
                //     return redirect('time-sheet')->with('success', 'Timesheet hari ini berhasil ditambahkan'); 
                // }
                // else{
                //     $timesheet->divisi_id = $request->get('divisi_id');
                //     $timesheet->desc_for_proposal = "";
                //     $timesheet->working_type_id = "";
                //     $timesheet->resource_id = $request->get('resource_id');
                //     $timesheet->proposal_id = "";
                //     $timesheet->project_id = $request->project_id;
                //     $timesheet->desc_for_project = $request->desc_for_project;
                    
                //     if(date('l', strtotime($tgl_kerja)) == "Sunday" || date('l', strtotime($tgl_kerja)) == "Saturday" || in_array($tgl_kerja, $tgl_libur)){
                //         $timesheet->ket = 2;
                //     }
                //     else{
                //         $timesheet->ket = 1;
                //     }

                //     $timesheet->save();
                //     return redirect('time-sheet')->with('success', 'Timesheet hari ini berhasil ditambahkan');  
                // }
            // }
        }
        else{
            $cost_acc = $request->cost_account_id;
            $timesheet = new TimeSheetUser();
            $timesheet->id_karyawan = Auth::user()->username;
            $timesheet->start_time = $request->get('start_time');
            $timesheet->end_time = $request->get('end_time');
            $start_times = Carbon::parse($request->start_time);
            $end_times = Carbon::parse($request->end_time);
            $timesheet->tanggal_kerja = $request->get('tanggal_kerja');
            $timesheet->cost_account_id = $request->get('cost_account_id');
            $timesheet->created_at = Carbon::now()->toDateTimeString();
            $timesheet->man_hours = $start_times->diffInHours($end_times);
            $timesheet->status = 0;
            $timesheet->approved_by = "";
            $timesheet->tgl_approved = "";
            $timesheet->id_user = Auth::user()->id_krywn;

            // if($request->cost_account_id == 1){
                // if(in_array($tgl_kerja, $tgl_libur) || date('l', strtotime($tgl_kerja)) == "Sunday"){
                if(in_array($tgl_kerja, $tgl_libur)){
                    return redirect('time-sheet')->with('failed', 'Sorry, the date you entered is a HOLIDAY');
                }
                else{
                    $timesheet->divisi_id = $request->get('divisi_id');
                    // $timesheet->working_type_id = $request->get('type');
                    // $timesheet->desc_for_ho = $request->get('desc_for_ho');
                    // $timesheet->resource_id = "";
                    // $timesheet->proposal_id = "";
                    // $timesheet->desc_for_proposal = "";
                    // $timesheet->ket = 1;
                    $timesheet->detail_of_work = $request->detail_of_work;
                    $timesheet->save();
                    return redirect('time-sheet')->with('success', 'Timesheet successfully added');  
                }
            // }
            // else if($request->cost_account_id == 2){
            //         $timesheet->divisi_id = $request->get('divisi_id');
            //         $timesheet->working_type_id = "";
            //         $timesheet->desc_for_proposal = $request->deskripsi_pekerjaan;
            //         $timesheet->resource_id = $request->resource_id;
            //         $timesheet->proposal_id = $request->proposal_id;

            //     if(date('l', strtotime($tgl_kerja)) == "Sunday" || date('l', strtotime($tgl_kerja)) == "Saturday" || in_array($tgl_kerja, $tgl_libur)){
            //         $timesheet->ket = 2; 
            //     }
            //     else{
            //         $timesheet->ket = 1; 
            //     }

            //     $timesheet->save();
            //     return redirect('time-sheet')->with('success', 'Timesheet hari ini berhasil ditambahkan');  
            // }
            // else{
            //     $timesheet->divisi_id = $request->get('divisi_id');
            //     $timesheet->desc_for_proposal = "";
            //     $timesheet->working_type_id = "";
            //     $timesheet->resource_id = $request->resource_id;
            //     $timesheet->proposal_id = "";
            //     $timesheet->project_id = $request->project_id;
            //     $timesheet->desc_for_project = $request->desc_for_project;

            //     if(date('l', strtotime($tgl_kerja)) == "Sunday" || date('l', strtotime($tgl_kerja)) == "Saturday" || in_array($tgl_kerja, $tgl_libur)){
            //         $timesheet->ket = 2;
            //     }
            //     else{
            //         $timesheet->ket = 1;
            //     }

            //     $timesheet->save();
            //     return redirect('time-sheet')->with('success', 'Timesheet hari ini berhasil ditambahkan');  
            //     }
            }
        }
            catch(\Exception $e){
                return redirect('/time-sheet')->with('failed', 'Failed to save. An error occured while inputting. Please try again');
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
        $data['edit_timesheet'] = TimeSheetUser::find($id);
        $data['work_type'] = General::all();
        $data['resource'] = Resource::all();
        $data['project'] = Proyek::where('nama', '!=','Head Office')->get();
        return view('timesheet/user/edit')->with($data);
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
            $tgl_kerja = $request->tanggal_kerja;
            $datas = TimeSheetUser::where('tanggal_kerja', $tgl_kerja)
                    ->get();
            
            $get_start_time = date('H:i:s', strtotime($request->start_time));
            $get_end_time = date('H:i:s', strtotime($request->end_time));

            // $get_start_time = $request->start_time;
            // $get_end_time = $request->end_time;
            // return $get_end_time; 

            $data_start_time = DB::select("
                SELECT time_work.start_time FROM time_work JOIN time_sheet_user ON time_work.start_time != time_sheet_user.start_time
                WHERE time_work.start_time > time_sheet_user.start_time AND time_work.start_time < time_sheet_user.end_time
                AND time_sheet_user.tanggal_kerja = '".$tgl_kerja."'
            "); 
            // return $data_start_time;

            $result = array_map(function ($value) {
                return (array)$value;
            }, $data_start_time);

            $arrays = [];
            foreach($result as $object)
                {
                    $arrays[] = $object['start_time'];
                }

            $master_libur = DB::table('master_libur')->get();
            $tgl_libur = [];
            $start_time_work = [];

            foreach($master_libur  as $libur){
                $tgl_libur[] = $libur->tanggal;
            }

            foreach($datas  as $starts){
                $start_time_work[] = $starts->start_time;
                $end_time_work[] = $starts->end_time;
            }
            
            // if(in_array($get_start_time, $start_time_work) || in_array($get_start_time, $arrays)){
            //     return redirect('time-sheet')->with('failed', 'Gagal diperbaharui. Periksa inputan jam anda');
            // }
            // else if(in_array($get_end_time, $end_time_work) || in_array($get_end_time, $arrays) ){
            //     return redirect('time-sheet')->with('failed', 'Gagal diperbaharui. Periksa inputan jam anda');
            // }
            // else{
                $data = TimeSheetUser::find($id);
                $data->start_time = $request->start_time;
                $data->end_time = $request->end_time;
                $data->updated_at = Carbon::now()->toDateTimeString();
                $data->detail_of_work = $request->detail_of_work;
                // $req = $request->get('cost_account_id');

                // if($req == 1){
                //     $data->working_type_id = $request->get('working_type_id');
                //     $data->desc_for_ho = $request->desc_for_ho;
                // }
                // elseif($req== 2){
                //     $data->resource_id = $request->resource_id;
                //     $data->desc_for_proposal = $request->desc_for_proposal;
                // }
                // else{
                //     $data->project_id = $request->project_id;
                //     $data->desc_for_project = $request->desc_for_project;
                // }
                $data->save();
                return redirect('time-sheet')->with('success', 'Timesheet successfully updated. Please wait for approval');
        // }
            
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timesheet = TimeSheetUser::destroy($id);
        if($timesheet){
            return response()->json([
                'success'=> 'Timesheet successfully deleted'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Timesheet failed to delete'
            ]);
        }
        return response($response);
    }

    // public function destroyRabu($id)
    // {
    //     $timesheet = TimeSheetUser::destroy($id);
    //     if($timesheet){
    //         return response()->json([
    //             'success'=> 'Time Sheet berhasil dihapus'
    //         ]);
    //     }
    //     else{
    //         return response()->json([
    //             'failes'=> 'Time Sheet gagal dihapus'
    //         ]);
    //     }
    //     return response($response);
    // }

    public function getProposalList(Request $request)
    {
        $getProposal = Proposal::where('id',$request->proposal_id)
                    ->with('getLokasi')
                    ->get(['lokasi_id','resource_id']);

        return response()->json($getProposal);
    }
    
    public function downloadSummaryTimesheet(Request $request, $id){
        $ids = $id;
        $month = $request->month;
        $year = $request->year;
        
        
        $ls_month  = $month - 1;
        $ls_year   = $year - 1;
        
        
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
        // return $last_cut_off;
        
        $data = TimeSheetUser::where('id_karyawan', $ids)
                ->whereDate('tanggal_kerja', '>=', $first_off)
                ->whereDate('tanggal_kerja', '<=', $last_cut_off)
                ->orderBy('tanggal_kerja', 'asc')
                ->get();
        $employee = Employee::where('nik', $ids)->get();
        // return $data;
        
        return (new SummaryPersonalTimesheet($id, $data, $employee))->download("Summary Timesheet Personnel ".Auth::user()->name.".xlsx");
    }

}
