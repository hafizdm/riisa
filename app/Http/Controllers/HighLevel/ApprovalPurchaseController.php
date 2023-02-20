<?php

namespace App\Http\Controllers\HighLevel;
use App\Http\Controllers\Controller;
use \App\RequestBarang;
use\App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use App\Mail\notifikasiPurchasedApprovalCFO;
use App\Mail\notifikasiPurchasedtoCFO;
use Illuminate\Support\Facades\Mail;
// use App\Mail\notifikasiPurchasedApprovalCEO;
use App\Mail\notifikasiPurchasedtoCEO;
use App\Mail\notifikasiPurchasedApprovalVP_PM;
use App\Mail\notifikasiPurchasedtoFinance;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Mail\notifikasistatusRejected;
use DB;


class ApprovalPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function CostControl()
    {
    //  $data['request_barang']= RequestBarang::where('status_pengajuan',3)
    //                          ->where('status_PO',0)
    //                          ->where('upload_po','!=','')->get();
    
    $data['request_barang']= RequestBarang::where('status_pengajuan',1)
                            ->where('status_PO', 0)
                            ->where('upload_po','!=','')
                            ->where('upload_tba','!=','')
                            ->where('upload_cba','!=','')
                            ->orderBy('updated_at','desc')
                            ->get();

     return view('/highlevel/purchase/co/index')->with($data);
    }

    public function editApprovalCO($id)
    {
        $data['approval'] = RequestBarang::find($id);
        return view('highlevel/purchase/co/edit')->with($data);
    }
    public function updateApprovalCO(Request $request, $id)
    {
        try{
            $role = Employee::where('nik', '=', Auth::user()->username)
                    ->select('nama')
                    ->first();
    
            $data =  RequestBarang::find($id);
            $data->status_PO = $request->get('status_PO');
            $data->keterangan_by_cc = $request->keterangan_by_cc;
            $data->updated_co_po_by = $role->nama;
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();

        if($data->status_pengajuan == 1 && $data->status_PO == 1){
        // Send approval to VP (khusus : HO)
            // if($data->nama_proyek == 3){
            //         $email = DB::table('karyawan')->leftJoin('users', function($join){
            //                     $join->on('karyawan.nik','=','users.username');
            //                     })->where('karyawan.divisi_id',$data->divisi_id)
            //                     ->where('users.role_id',4)
            //                     ->select('karyawan.email')
            //                     ->get();
            //     }
        // Send approval to PM (khusus: project)
            // else{
            //     $email = DB::table('karyawan')->leftJoin('users', function($join){
            //                 $join->on('karyawan.nik','=','users.username');
            //                 })->where('users.role_id',3)
            //                 ->where('karyawan.lokasi_id', $data->nama_proyek)
            //                 ->select('karyawan.email')
            //                 ->get();
            // }
            
            if($data->kode_barang == 11){
                    $email = DB::table('karyawan')->leftJoin('users', function($join){
                                    $join->on('karyawan.nik','=','users.username');
                                    })
                                    ->where('karyawan.divisi_id', 3)
                                    ->where('users.role_id',4)
                                    ->select('karyawan.email')
                                    ->get();
                }
                elseif($data->kode_barang == 24){
                    $email = DB::table('karyawan')->leftJoin('users', function($join){
                        $join->on('karyawan.nik','=','users.username');
                        })
                        ->where('karyawan.divisi_id', 1)
                        ->where('users.role_id',4)
                        ->select('karyawan.email')
                        ->get();
                }
                elseif($data->kode_barang == 25){
                    $email = DB::table('karyawan')->leftJoin('users', function($join){
                        $join->on('karyawan.nik','=','users.username');
                        })
                        ->where('karyawan.divisi_id', 2)
                        ->where('users.role_id', 4)
                        ->select('karyawan.email')
                        ->get();
                }
                else{
                    $email = DB::table('karyawan')->leftJoin('users', function($join){
                                    $join->on('karyawan.nik','=','users.username');
                                    })
                                    ->where('karyawan.lokasi_id', $data->masterKategori->kode_kebutuhan)
                                    ->where('users.role_id',3)
                                    ->select('karyawan.email')
                                    ->get();
                }
                
            Mail::to($email)->send(new notifikasiPurchasedApprovalVP_PM($data));
        
        }
        elseif($data->status_pengajuan == 1 && $data->status_PO == 4){
            $email = Employee::where('nik', $data->nik)
                    ->select('email')
                    ->get();
            Mail::to($email)->send(new notifikasistatusRejected($data));
        }
        else{
            $status = "PROSES";
        }

        return redirect('/po')->with('success', 'Persetujuan berhasil diupdate');
        }
        catch(\Exception $e){
                return redirect('/po')->with('failed', 'Persetujuan PO gagal diupdate');
        }
    }
    
    
    // PO for Project Manager
    public function indexApprovalPM(){
        $data['request_barang']= RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',1)
                                ->where('nama_proyek','!=',3)
                                ->where('upload_po','!=','')
                                ->get();              

        return view('highlevel/purchase/pm/index')->with($data);
    }

    public function editApprovalPM($id){
        $data['edit_pm'] = RequestBarang::find($id);
        return view('highlevel/purchase/pm/edit')->with($data);
    }

    public function updateApprovalPM(Request $request, $id){
        $role = Employee::where('nik', '=', Auth::user()->username)
                ->select('nama')
                ->first();
        try{
            $data = RequestBarang::find($id);
            $data->status_PO = $request->get('status_PO');
            $data->updated_pm_po_by = $role->nama;
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->status_paid = 0;
            $data->save();

            if($data->status_pengajuan == 1 && $data->status_PO == 2){
                $email_ceo = DB::table('karyawan')->leftJoin('users', function($join){
                        $join->on('karyawan.nik','=','users.username');
                        })->where('users.role_id',5)
                        ->where('karyawan.jabatan_id',78)
                        ->select('karyawan.email')
                        ->get();

                $email_cfo = DB::table('karyawan')->leftJoin('users', function($join){
                        $join->on('karyawan.nik','=','users.username');
                        })->where('users.role_id',9)
                        ->where('karyawan.jabatan_id',88)
                        ->select('karyawan.email')
                        ->get();

                $email_finance = Employee::where('nik','finance')
                        ->select('email')
                        ->get();

                Mail::to($email_finance)->send(new notifikasiPurchasedtoFinance($data));
                Mail::to($email_ceo)->send(new notifikasiPurchasedtoCEO($data));
                Mail::to($email_cfo)->send(new notifikasiPurchasedtoCFO($data));
            }
            elseif($data->status_pengajuan == 1 && $data->status_PO == 4){
                $email = Employee::where('nik', $data->nik)
                        ->select('email')
                        ->get();

                Mail::to($email)->send(new notifikasistatusRejected($data));
            }
            else{
                $status = "PROSES";
            }
            return redirect('/po-pm')->with('success', 'Persetujuan berhasil diupdate');
        }
        catch(\Exception $e){
            return redirect('/po-pm')->with('failed', 'Persetujuan gagal diupdate');
        }
    }

    // PO for VP
    public function indexApprovalVP(){
        // $data['request_barang']= RequestBarang::where('status_pengajuan',1)
        //                         ->where('status_PO',1)
        //                         ->where('nama_proyek',3)
        //                         ->where('divisi_id', Auth::user()->user_login->divisi_id)
        //                         ->where('upload_po','!=','')
        //                         ->get();
        
            if(Auth::user()->user_login->divisi_id == 3){
                $data['request_barang'] = RequestBarang::where('status_pengajuan','=',1)
                                        ->where('status_PO',1)
                                        ->where('nama_proyek',3)
                                        ->where('upload_po','!=','')
                                        ->where('matriks', 8)
                                        ->get();
                return view('/highlevel/purchase/vp/index')->with($data);
            }
            
            elseif(Auth::user()->user_login->divisi_id == 2 || Auth::user()->user_login->divisi_id == 4){
                $data['request_barang'] = RequestBarang::where('status_pengajuan','=',1)
                                        ->where('status_PO',1)
                                        ->where('nama_proyek',3)
                                        ->where('upload_po','!=','')
                                        ->where('matriks', 7)
                                        ->get();
                return view('/highlevel/purchase/vp/index')->with($data);
            }
            
            elseif(Auth::user()->user_login->divisi_id == 1){
                $data['request_barang'] = RequestBarang::where('status_pengajuan','=',1)
                                        ->where('status_PO',1)
                                        ->where('nama_proyek',3)
                                        ->where('upload_po','!=','')
                                        ->where('matriks', 6)
                                        ->get();
                return view('/highlevel/purchase/vp/index')->with($data);
            }
            
            else{
                return "tes";
            }
    }

    public function editApprovalVP($id){
        $data['edit_vp'] = RequestBarang::find($id);
        return view('highlevel/purchase/vp/edit')->with($data);
    }

    public function updateApprovalVP(Request $request, $id){
        $role = Employee::where('nik', '=', Auth::user()->username)
                ->select('nama')
                ->first();
        try{
            $data = RequestBarang::find($id);
            $data->status_PO = $request->get('status_PO');
            $data->updated_vp_po_by = $role->nama;
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->status_paid = 0;
            $data->save();

            if($data->status_pengajuan == 1 && $data->status_PO == 2){
                $email_ceo = DB::table('karyawan')->leftJoin('users', function($join){
                        $join->on('karyawan.nik','=','users.username');
                        })->where('users.role_id',5)
                        ->where('karyawan.jabatan_id',78)
                        ->select('karyawan.email')
                        ->get();
                // return $email_ceo; 
                
                $email_cfo = DB::table('karyawan')->leftJoin('users', function($join){
                        $join->on('karyawan.nik','=','users.username');
                        })->where('users.role_id',9)
                        ->where('karyawan.jabatan_id',88)
                        ->select('karyawan.email')
                        ->get();

                $email_finance = Employee::where('nik','finance')
                        ->select('email')
                        ->get();

                Mail::to($email_finance)->send(new notifikasiPurchasedtoFinance($data));
                Mail::to($email_ceo)->send(new notifikasiPurchasedtoCEO($data));
                Mail::to($email_cfo)->send(new notifikasiPurchasedtoCFO($data));
            }
            elseif($data->status_pengajuan == 1 && $data->status_PO == 4){
                $email = Employee::where('nik', $data->nik)
                        ->select('email')
                        ->get();

                Mail::to($email)->send(new notifikasistatusRejected($data));
            }
            else{
                $status = "PROSES";
            }
            return redirect('/po-vp')->with('success', 'Persetujuan berhasil diupdate');
        }
        catch(\Exception $e){
            return redirect('/po-vp')->with('failed', 'Persetujuan gagal diupdate');
        }
    }

    // public function cfo()
    // {
    //     $data['request_barang']= RequestBarang::where('status_pengajuan',3)
    //  ->where('status_PO',1)
    //  ->where('upload_po','!=','')->get();

    //  return view('/highlevel/purchase/cfo/index')->with($data);
    // }

    // public function cfoedit($id)
    // {
    //     $data['cfoedit'] = RequestBarang::find($id);
    //     return view('highlevel/purchase/cfo/edit')->with($data);
    // }

    // public function cfoupdate(Request $request, $id)
    // {
    //     $role = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('nama')
    //     ->first();

    //     $data =  RequestBarang::find($id);
    //     $data->status_PO = $request->get('status_PO');
    //     $data->updated_cfo_po_by = $role->nama;
    //     $data->updated_at = Carbon::now()->toDateTimeString();
    //     $data->save();

    //     if($data->status_pengajuan == 3 && $data->status_PO == 2){
    //         $email =  DB::table('karyawan')->leftJoin('users', function($join){
    //                 $join->on('karyawan.nik','=','users.username');
    //                 })->where('users.role_id',5)
    //                 ->where('karyawan.jabatan_id',78)
    //                 ->select('karyawan.email')
    //                 ->get();
    //         Mail::to($email)->send(new notifikasiPurchasedApprovalCEO($data));  
    //     }
    //     elseif($data->status_pengajuan == 3 && $data->status_PO == 4){
    //         $email = Employee::where('nik', $data->nik)
    //                 ->select('email')
    //                 ->get();
    //         Mail::to($email)->send(new notifikasistatusRejected($data));
    //     }
    //     else{
    //         $status = "PROSES";
    //     }
    //     return redirect('/po-cfo')->with('success', 'Persetujuan berhasil diupdate');
    // }
    // CEO

    // public function ceo()
    // {
    // $data['request_barang']= RequestBarang::where('status_pengajuan',3)
    //                         ->where('status_PO',2)
    //                         ->where('upload_po','!=','')->get();
    //  return view('/highlevel/purchase/ceo/index')->with($data);
    // }

    // public function ceoEdit($id)
    // {
    //     $data['ceo_edit'] = RequestBarang::find($id);
    //     return view('highlevel/purchase/ceo/edit')->with($data);
    // }

    // public function ceoUpdate(Request $request, $id)
    // {
    //     $role = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('nama')
    //     ->first();

    //     $data =  RequestBarang::find($id);
    //     $data->status_PO = $request->get('status_PO');
    //     $data->updated_ceo_po_by = $role->nama;
    //     $data->updated_at = Carbon::now()->toDateTimeString();
    //     $data->status_paid = 0;
    //     $data->save();

    //     if($data->status_pengajuan == 3 && $data->status_PO == 3){
    //         $email = Employee::where('nik','finance')
    //                 ->select('email')
    //                 ->get();
    //         Mail::to($email)->send(new notifikasiPurchasedtoFinance($data));
    //     }
    //     elseif($data->status_pengajuan == 3 && $data->status_PO == 4){
    //         $email = Employee::where('nik', $data->nik)
    //                 ->select('email')
    //                 ->get();
    //         Mail::to($email)->send(new notifikasistatusRejected($data));
    //     }
    //     else{
    //         $status = "PROSES";
    //     }
    //     return redirect('/po-CEO')->with('success', 'Persetujuan berhasil diupdate');
    // }

    // public function POManager()
    // {
    //     $roleVP = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('jabatan_id','divisi_id')
    //     ->first();
    //     // return $roleVP;

    //     if($roleVP->jabatan_id == 1 && $roleVP->divisi_id == 4){
    //         $data['request_barang']= RequestBarang::where('status_pengajuan',3)
    //         ->where('status_po',1)
    //         ->where('upload_po','!=','')->get();
    //      return view('/highlevel/purchase/PoManager/index')->with($data);
    //     }

    //     else{
    //         return view('/highlevel/purchase/index');
    //     }
        
    // }
    // public function POManagerEdit($id)
    // {
    //     $roleManager = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('jabatan_id','divisi_id')
    //     ->first();
    //     // return $roleVP;

    //     if($roleManager->jabatan_id == 1 && $roleManager->divisi_id == 4){
    //         $data['editPOManager'] = RequestBarang::find($id);
    //         return view('highlevel/purchase/PoManager/edit')->with($data);
    //     }

    //     else{
    //         return view('/highlevel/purchase/index');
    //     }
        
    // }

    // public function POManagerUpdate(Request $request, $id)
    // {
    //     $role = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('nama')
    //     ->first();

    //     $data =  RequestBarang::find($id);
    //     $data->status_PO = $request->get('status_PO');
    //     $data->updated_manager_po_by = $role->nama;
    //     $data->updated_at = Carbon::now()->toDateTimeString();
    //     $data->save();
    //     return redirect('/po')->with('success', 'Persetujuan berhasil diupdate');
    // }

    // public function povp(){
    //     $roleVP = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('jabatan_id','divisi_id')
    //     ->first();

    //     if($roleVP->jabatan_id == 3 && $roleVP->divisi_id == 6){
    //             $data['request_barang'] = RequestBarang::where('status_pengajuan','=',3)
    //             ->where('status_po',2)
    //             ->where(function($query) {
    //                 $query->where('divisi_id', 5)
    //                     ->orWhere('divisi_id', 9)
    //                     ->orWhere('divisi_id', 10);
    //             })->get();           
    //             return view('highlevel/purchase/vp/index_VP_Support_Finanace')->with($data);
    //     }
    //     else{
    //         $data['request_barang'] = RequestBarang::where('status_pengajuan','=',3)
    //         ->where('status_po',2)
    //         ->where(function($query) {
    //             $query->where('divisi_id','!=', 5)
    //                 ->orWhere('divisi_id','!=', 9)
    //                 ->orWhere('divisi_id','!=', 10)
    //                 ->orWhereNull('divisi_id');
    //         })->get();           
    //         return view('highlevel/purchase/vp/index_VP_Operational')->with($data);
    //     }
    // }
    // public function povedit($id)
    // {
    //     $data['vpedit'] = RequestBarang::find($id);
    //     return view('highlevel/purchase/vp/edit')->with($data);
    // }
    // public function povpupdate(Request $request, $id)
    // {
    //     $role = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('nama')
    //     ->first();

    //     $data =  RequestBarang::find($id);
    //     $data->status_PO = $request->get('status_PO');
    //     $data->updated_vp_po_by = $role->nama;
    //     $data->updated_at = Carbon::now()->toDateTimeString();
    //     $data->save();
    //     return redirect('/po-vp')->with('success', 'Persetujuan berhasil diupdate');
    // }

  

   

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

    public function editPasswordCO($id)
    {
        $data['reset'] = User::find($id);
        return view('resetpassword/resetpassword_co')->with($data);
    }

    public function updatePasswordCO(Request $request, $id)
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

    public function editPasswordCFO($id)
    {
        $data['reset'] = User::find($id);
        return view('resetpassword/resetpassword_cfo')->with($data);
    }

    public function updatePasswordCFO(Request $request, $id)
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
}
