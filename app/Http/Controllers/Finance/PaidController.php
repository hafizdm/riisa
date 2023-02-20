<?php

namespace App\Http\Controllers\Finance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestBarang;
use Carbon\Carbon;
use App\Employee;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifikasitoKaryawan;

class PaidController extends Controller
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
                                ->where('status_paid',3)
                                ->orWhere('status_paid',5)
                                // ->where('upload_bukti_bayar','=','')
                                // ->orWhere('upload_bukti_bayar','=','')
                                ->orderBy('updated_at','desc')
                                ->get();
        return view('finance/paid/index')->with($data);
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

        $data['paid'] = RequestBarang::find($id);
        return view('finance/paid/edit')->with($data);
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
            $data =  RequestBarang::findOrNew($id);
            $data->status_paid = $request->get('status_paid');
        
            if($request->jenis_pembayaran == "lunas"){
                $files = $request->file('upload_bukti_bayar');
                $destinationPath = 'uploads/buktibayar/' . $request->id; // upload path
                $file = "Payment_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $file);
                $uploadPayment = $request->id . "/" . $file;
                $data->upload_bukti_bayar = $uploadPayment;
                $data->status_paid = $request->buktibayarlunas;
                $data->status_brg_keluar = 0;
            }
            elseif($request->jenis_pembayaran == "parsial"){
                if($data->parsial_pay1 == null && $data->parsial_pay2 == null  && $data->parsial_pay3 == null && $data->parsial_pay4 == null){
                    $files = $request->file('parsial_pay1');
                    $destinationPath = 'uploads/buktibayar/' . $request->id; // upload path
                    $file = "Parsial(1)_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file);
                    $uploadPayment = $request->id . "/" . $file;
                    $data->parsial_pay1 = $uploadPayment;
                    $data->status_paid = $request->parsial1;
                    $data->barang_parsial = $request->barang_parsial;
                    $data->tgl_pengajuan_pengeluaran = Carbon::now()->toDateTimeString();
                   
                    if($request->barang_parsial == 1){
                        $data->status_brg_keluar = 1;
                    }
                    else{
                        $data->status_brg_keluar = 0;
                    }
                }
                elseif($data->parsial_pay1 != null && $data->parsial_pay2 == null  && $data->parsial_pay3 == null && $data->parsial_pay4 == null){
                    $files = $request->file('parsial_pay2');
                    $destinationPath = 'uploads/buktibayar/' . $request->id; // upload path
                    $file = "Parsial(2)_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file);
                    $uploadPayment = $request->id . "/" . $file;
                    $data->parsial_pay2 = $uploadPayment;
                    $data->status_paid = $request->parsial2;
                    $data->tgl_pengajuan_pengeluaran = Carbon::now()->toDateTimeString();
                    $data->barang_parsial = $request->barang_parsial;
                    if($request->barang_parsial == 1){
                        $data->status_brg_keluar = 1;
                    }
                    else{
                        $data->status_brg_keluar = 0;
                    }
                }
                elseif($data->parsial_pay1 != null && $data->parsial_pay2 != null && $data->parsial_pay3 == null && $data->parsial_pay4 == null){
                    $files = $request->file('parsial_pay3');
                    $destinationPath = 'uploads/buktibayar/' . $request->id; // upload path
                    $file = "Parsial(3)_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file);
                    $uploadPayment = $request->id . "/" . $file;
                    $data->parsial_pay3 = $uploadPayment;
                    $data->status_paid = $request->parsial3;
                    $data->barang_parsial = $request->barang_parsial;
                    $data->tgl_pengajuan_pengeluaran = Carbon::now()->toDateTimeString();
    
                    if($request->barang_parsial == 1){
                        $data->status_brg_keluar = 1;
                    }
                    else{
                        $data->status_brg_keluar = 0;
                    }
                }
                elseif($data->parsial_pay1 != null && $data->parsial_pay2 != null && $data->parsial_pay3 != null  && $data->parsial_pay4 == null){
                    $files = $request->file('parsial_pay4');
                    $destinationPath = 'uploads/buktibayar/' . $request->id; // upload path
                    $file = "Parsial(4)_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file);
                    $uploadPayment = $request->id . "/" . $file;
                    $data->parsial_pay4 = $uploadPayment;
                    $data->status_paid = $request->parsial4;
                    $data->barang_parsial = $request->barang_parsial;
                    $data->tgl_pengajuan_pengeluaran = Carbon::now()->toDateTimeString();
                    
                    if($request->barang_parsial == 1){
                        $data->status_brg_keluar = 1;
                    }
                    else{
                        $data->status_brg_keluar = 0;
                    }
                }
            }
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();
            if($data->status_paid == 5){
                $email = Employee::where('nik', $data->nik)
                        ->select('email')
                        ->get();
            
                Mail::to($email)->send(new notifikasitoKaryawan($data));
            }
            else{
                $status = "UNPAID";
            }
            return redirect('/ubah-status-paid')->with('success', 'Status berhasil di ubah');
            
        }
        catch(\Exception $e){
            return redirect('/ubah-status-paid')->with('failed', 'Update Gagal. Silahkan coba kembali');
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
}
