<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Costaccount;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class CostaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data['cost_account'] = Costaccount::orderBy('created_at', 'desc')->get();
        $data['cost_account'] = DB::table('cost_account')->leftJoin('karyawan', function($join){
                                $join->on('cost_account.approved','=','karyawan.nik');
                                })
                                ->select('cost_account.id as id','cost_account.nama as cost_account', 'karyawan.nama as nama_karyawan')
                                ->orderBy('cost_account.updated_at','DESC' )
                                ->get();
                                
        return view('admin/costaccount/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data['cost_account'] = Costaccount::all();
         $data['employee']  = Employee::where('nik','!=','admin')
                                    ->where('nik','!=','finance')
                                    ->where('nik','!=','asset.management')
                                    ->where('nik','!=','HRD')
                                    ->orderBy('created_at','desc')
                                    ->get();
        return view('admin/costaccount/create', $data);
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
            $ca= new Costaccount();
            $ca->nama=$request->get('nama');
            $ca->created_at = Carbon::now()->toDateTimeString();
            $ca->approved = $request->get('approved');
            $ca->chart_timesheet = $request->get('chart_timesheet');
            $ca->save();
            return redirect('/cost-account')->with('success', 'Data successfully added');
        }
        catch(\Exception $e){
            return redirect('/cost-account')->with('failed', 'Failed. Please check your data');
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
        //
        $data['cost_account']   = Costaccount::find($id);
        $data['employee']       = Employee::where('nik','!=','admin')
                                    ->where('nik','!=','finance')
                                    ->where('nik','!=','asset.management')
                                    ->where('nik','!=','HRD')
                                    ->orderBy('created_at','desc')
                                    ->get();
        
        return view('admin/costaccount/edit')->with($data);
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
            $ca = Costaccount::find($id);
            $ca->nama=$request->get('nama');
            $ca->approved = $request->get('approved');
            $ca->chart_timesheet = $request->get('chart_timesheet');
            $ca->updated_at = Carbon::now()->toDateTimeString();
            $ca->save();
            return redirect('/cost-account')->with('success', 'Data successfully added');
        }
        catch(\Exception $e){
            return redirect('/cost-account')->with('failed', 'Failed. Please check your data');
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
        $ca = Costaccount::destroy($id);
        if($ca){
            return response()->json([
                'success'=> 'Data successfully removed'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Failed to remove data'
            ]);
        }
        return response($response);
    }
}
