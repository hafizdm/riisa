<?php

namespace App\Http\Controllers\Finance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestBarang;
use Carbon\Carbon;
use App\Employee;
use App\Mail\notifikasiPurchasedApprovalCO;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifikasiPaymentApprovalCO;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['request_barang'] = RequestBarang::where('status_pengajuan', 1)
                                ->where('status_PO',2)
                                ->where('status_paid',0)
                                // ->where('upload_invoice','=','')
                                ->orderBy('updated_at','desc')
                                ->get();
        return view('finance/invoice/index')->with($data);
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
        return view('finance/invoice/edit')->with($data);
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
        // if($request->hasFile('upload_invoice')){
        //     $request->file('upload_invoice')->move('uploads/invoice/', $request->file('upload_invoice')->getClientOriginalName());
        //     $data->upload_invoice = $request->file('upload_invoice')->getClientOriginalName();
        // }

        if ($files = $request->file('upload_invoice')) {
            $destinationPath = 'uploads/invoice/' . $request->id; // upload path
            $file = "Invoice_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $file);
            $uploadInvoice = $request->id . "/" . $file;
        }
        $data->upload_invoice = $uploadInvoice;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();
        
        $ids = $data->id;
        RequestBarang::where('id', $ids)->update(
            [
                'no_payment'=> "PV".'/'.$data->id.'/'.$data->lokasiProyek->code_loc.'/'. Carbon::createFromFormat('Y-m-d', $data->tanggal_pengajuan)->year
            ]
        );
        
        // $email = Employee::where('jabatan_id',10)
        // ->where('divisi_id',12)
        // ->select('email')
        // ->get();
        $email = DB::table('karyawan')->leftJoin('users', function($join){
                $join->on('karyawan.nik','=','users.username');
                })->where('users.role_id',8)
                ->select('karyawan.email')
                ->get();

        Mail::to($email)->send(new notifikasiPaymentApprovalCO($data));
        
        return redirect('/list-invoice')->with('success', 'Invoice berhasil di upload');
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
