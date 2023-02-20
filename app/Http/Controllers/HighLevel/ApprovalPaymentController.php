<?php

namespace App\Http\Controllers\HighLevel;
use App\Http\Controllers\Controller;
use \App\RequestBarang;
use\App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifikasiPaymentApprovalCFO;
use App\Mail\notifikasiPaymentApprovalCEO;
use App\Mail\notifikasiPaymenttoFinance;
use App\Mail\notifikasistatusRejected;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class ApprovalPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Payment CO
    public function paymentCO()
    {
     $data['request_barang']= RequestBarang::where('status_pengajuan',1)
     ->where('status_PO', 2)
     ->where('status_paid',0)
     ->where('upload_po','!=','')
     ->where('upload_invoice','!=','')
     ->get();
     return view('/highlevel/payment/co/index')->with($data);
    // return $data;

    }

    public function paymentCOEdit($id)
    {
        $data['edit_payment_co'] = RequestBarang::find($id);
        return view('highlevel/payment/co/edit')->with($data);
    }
    public function paymentCOUpdate(Request $request, $id)
    {
        $role = Employee::where('nik', '=', Auth::user()->username)
        ->select('nama')
        ->first();

        $data =  RequestBarang::find($id);
        $data->status_paid = $request->get('status_paid');
        $data->updated_co_pay_by = $role->nama;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();
        
        if($data->status_pengajuan == 1 && $data->status_PO == 2 && $data->status_paid == 1){
        // Sending Email
            // $email = Employee::where('jabatan_id',11)
            // ->where('divisi_id',12)
            // ->select('email')
            // ->get();
            
          $email = DB::table('karyawan')->leftJoin('users', function($join){
            $join->on('karyawan.nik','=','users.username');
            })->where('users.role_id',9)
            ->select('karyawan.email')
            ->get();

        Mail::to($email)->send(new notifikasiPaymentApprovalCFO($data));
        }
        elseif($data->status_pengajuan == 1 && $data->status_PO == 2 && $data->status_paid == 4){
            $email = Employee::where('nik', $data->nik)
                    ->select('email')
                    ->get();
            Mail::to($email)->send(new notifikasistatusRejected($data));
        }
        else{
            $status = "PROSES";
        }
        return redirect('/payment-co')->with('success', 'Persetujuan berhasil diupdate');
    }
     // CFO 
     public function paymentCFO()
     {
      $data['request_barang']= RequestBarang::where('status_pengajuan',1)
      ->where('status_PO', 2)
      ->where('status_paid',1)
      ->where('upload_po','!=','')
      ->where('upload_invoice','!=','')
      ->get();
      return view('/highlevel/payment/cfo/index')->with($data);
     }
 
     public function paymentCFOEdit($id)
     {
         $data['edit_payment_cfo'] = RequestBarang::find($id);
         return view('highlevel/payment/cfo/edit')->with($data);
     }
     public function paymentCFOUpdate(Request $request, $id)
     {
         $role = Employee::where('nik', '=', Auth::user()->username)
         ->select('nama')
         ->first();
 
         $data =  RequestBarang::find($id);
        //  $data->status_paid = $request->get('status_paid');
        
         if($data->total <= 50000000){
            $data->updated_ceo_pay_by = "CFO";
            if($request->status_paid == 0){
                $data->status_paid = 1;
            }
            elseif($request->status_paid == 2){
                $data->status_paid = 3;
            }
            else{
                $data->status_paid = 4;
            }
         }
         else{
            $data->status_paid = $request->get('status_paid');
         }
         
         $data->updated_cfo_pay_by = $role->nama;
         $data->updated_at = Carbon::now()->toDateTimeString();
         $data->save();

         if($data->status_pengajuan == 1 && $data->status_PO == 2 && $data->status_paid == 2){
            // $email = Employee::where('jabatan_id',2)
            // ->where('divisi_id',12)
            // ->select('email')
            // ->get();
            $email =  DB::table('karyawan')->leftJoin('users', function($join){
                    $join->on('karyawan.nik','=','users.username');
                    })->where('users.role_id',5)
                    ->where('karyawan.jabatan_id',78)
                    ->select('karyawan.email')
                    ->get();
 
            Mail::to($email)->send(new notifikasiPaymentApprovalCEO($data)); 
         }
         elseif($data->status_pengajuan == 1 && $data->status_PO == 2 && $data->status_paid == 4){
            $email = Employee::where('nik', $data->nik)
                    ->select('email')
                    ->get();
            Mail::to($email)->send(new notifikasistatusRejected($data));
        }
        else{
            $status = "PROSES";
        }

         return redirect('/payment-cfo')->with('success', 'Persetujuan berhasil diupdate');
     }
 
         // CEO
         public function paymentCEO()
         {
          $data['request_barang']= RequestBarang::where('status_pengajuan',1)
          ->where('status_PO', 2)
          ->where('status_paid',2)
          ->where('upload_po','!=','')
          ->where('upload_invoice','!=','')
          ->where('total', '>', '50000000')
          ->get();
          return view('/highlevel/payment/ceo/index')->with($data);
         }
     
         public function paymentCEOEdit($id)
         {
             $data['edit_payment_ceo'] = RequestBarang::find($id);
             return view('highlevel/payment/ceo/edit')->with($data);
         }
         public function paymentCEOUpdate(Request $request, $id)
         {
             $role = Employee::where('nik', '=', Auth::user()->username)
             ->select('nama')
             ->first();
     
             $data =  RequestBarang::find($id);
             $data->status_paid = $request->get('status_paid');
             $data->updated_ceo_pay_by = $role->nama;
             $data->updated_at = Carbon::now()->toDateTimeString();
             $data->save();

            // Send Email
            if($data->status_pengajuan == 1 && $data->status_PO == 2 && $data->status_paid == 3){
                $email = Employee::where('nik','finance')
                        ->select('email')
                        ->get();

                Mail::to($email)->send(new notifikasiPaymenttoFinance($data));
            }
            elseif($data->status_pengajuan == 1 && $data->status_PO == 2 && $data->status_paid == 4){
                $email = Employee::where('nik', $data->nik)
                        ->select('email')
                        ->get();

                Mail::to($email)->send(new notifikasistatusRejected($data));
            }
            else{
                $status = "PROSES";
            }

            return redirect('/payment-ceo')->with('success', 'Persetujuan berhasil diupdate');
         }

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
        $data['reset'] = User::find($id);
        return view('resetpassword')->with($data);
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
        $request->validate([
            'password' => 'required|
                            min:6|
                            max:8|'
                            
        ]);

        $data =  User::findOrNew($id);
        if(Hash::check($request->input('password'), $data->password)){
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();
            return back()->with('success', 'Kata Sandi anda sama seperti sebelumnya');
        }
        else{
            $data->password = Hash::make($request->get('password'));
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();
            return back()->with('success', 'Kata Sandi berhasil diubah');
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
