<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestBarang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Mail\notifikasiPurchasedApprovalCO;
use Illuminate\Support\Facades\Mail;
use App\Employee;
use DB; 
class POController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $dt = ['status_pengajuan'=> 3, 'status_PO'=>0];
        $data['request_barang'] = RequestBarang::where('status_pengajuan',1)
                                ->orderBy('updated_at','desc')
                                ->get();
        return view('admin/PO/index')->with($data);
        // return $data;
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
        $data['request_barang'] = RequestBarang::find($id);
        return view('admin/PO/edit')->with($data);
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
        $data =  RequestBarang::findOrNew($id);

        // if($request->hasFile('upload_po')){
        //     $request->file('upload_po')->move('uploads/PO/', $request->file('upload_po')->getClientOriginalName());
        //     $data->upload_po = $request->file('upload_po')->getClientOriginalName();
        // }

        if ($files = $request->file('upload_po')) {
            $destinationPath = 'uploads/PO/' . $request->id; // upload path
            $file = "PO_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $file);
            $uploadPO = $request->id . "/" . $file;
        }
        if ($filesCBA = $request->file('upload_cba')) {
            $destinationPathCBA = 'uploads/CBA/' . $request->id; // upload path
            $fileCBA = "CBA_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
            $filesCBA->move($destinationPathCBA, $fileCBA);
            $uploadCBA = $request->id . "/" . $fileCBA;
        }
        if ($filesTBA = $request->file('upload_tba')) {
            $destinationPathTBA = 'uploads/TBA/' . $request->id; // upload path
            $fileTBA = "TBA_" . Carbon::now()->timestamp . "." . $filesTBA->getClientOriginalExtension();
            $filesTBA->move($destinationPathTBA, $fileTBA);
            $uploadTBA = $request->id . "/" . $fileTBA;
        }
        $data->upload_po = $uploadPO;
        $data->upload_cba = $uploadCBA;
        $data->upload_tba = $uploadTBA;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        // $email = Employee::where('jabatan_id',2)
        //         ->where('divisi_id',12)
        //         ->select('email')
        //         ->get();
    
        $email = DB::table('karyawan')->leftJoin('users', function($join){
                $join->on('karyawan.nik','=','users.username');
                })->where('users.role_id',8)
                ->select('karyawan.email')
                ->get();
                
        Mail::to($email)->send(new notifikasiPurchasedApprovalCO($data));
        return redirect('/listPO')->with('success', 'File  PO Dan Pendukung lainya berhasil di upload');
    
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
