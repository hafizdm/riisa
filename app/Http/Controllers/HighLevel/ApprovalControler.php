<?php

namespace App\Http\Controllers\HighLevel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestBarang;
use App\Employee;
use App\divisi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\notifikasiRequestApprovalVP;
use App\Mail\notifikasiRequestApprovalCEO;
use App\Mail\notifikasiRequestToAdmin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Mail\notifikasistatusRejected;

class ApprovalControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    // Manager
    public function approvalManager()
    {
        
        $role = Employee::where('nik', '=', Auth::user()->username)
                ->select('jabatan_id','divisi_id','lokasi_id')
                ->first();
        
        // Project Manager 
            $data['request_barang'] = RequestBarang::where('nama_proyek', $role                     ->lokasi->id)->where('status_pengajuan',0)
                                    ->orderBy('created_at','desc')
                                    ->get();
                                    
        return view('highlevel/approval-request/managerProjek/index')->with($data);

        // Manager HO 
        // if(Auth::user()->role_id == 3 && $role->lokasi_id == 3){
        //     $data['request_barang'] = RequestBarang::where('divisi_id',$role->divisi_id)
        //                             ->where('status_pengajuan',0)
        //                             ->get();
        //     return view('highlevel/approval-request/managerHO/indexManager')->with($data);
        // }

        // Manager Proyek
        // else{
        //     $data['request_barang'] = RequestBarang::where('nama_proyek','=', $role->lokasi->nama)
        //                             ->where('status_pengajuan','=',0)
        //                             ->get();
        //     return view('highlevel/approval-request/managerProjek/index')->with($data);
        // }
        
    }

    public function editApprovalManager($id)
    {
        $data['approval'] = RequestBarang::find($id);
    
        return view('highlevel/approval-request/managerHO/edit')->with($data);
    }

    public function updateApprovalManager(Request $request, $id)
    {
        $role = Employee::where('nik', '=', Auth::user()->username)
                ->select('nama','divisi_id')
                ->first();

        $data =  RequestBarang::find($id);
        $data->status_pengajuan = $request->get('status_pengajuan');
        $data->updated_manager_by = $role->nama;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        if($data->status_pengajuan == 1){
            $email = DB::table('karyawan')->leftJoin('users', function($join){
                $join->on('karyawan.nik','=','users.username');
                })->where('karyawan.divisi_id',$data->divisi_id)
                ->where('users.role_id',4)
                ->select('karyawan.email')
                ->get();

            Mail::to($email)->send(new notifikasiRequestApprovalVP($data));
        }
        elseif($data->status_pengajuan == 4){
            $email = Employee::where('nik', $data->nik)
                    ->select('email')
                    ->get();
            Mail::to($email)->send(new notifikasistatusRejected($data));
        }
        else{
            $status = "PROSES";
        }

        return redirect('/approvalManager')->with('success', 'Persetujuan berhasil diupdate');
    }

    // Manager Projek
    public function editApprovalManagerProjek($id)
    {
        $data['approval'] = RequestBarang::find($id);
        return view('highlevel/approval-request/managerProjek/edit')->with($data);
    }

    public function updateApprovalManagerProjek(Request $request, $id)
    {
        try{
            $role = Employee::where('nik', '=', Auth::user()->username)
                    ->select('nama')
                    ->first();
    
            $data =  RequestBarang::find($id);
            $data->status_pengajuan = $request->get('status_pengajuan');
            $data->updated_manager_by = $role->nama;
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();
            
            if($data->status_pengajuan == 1){
                $email = Employee::where('nik','=','admin')
                        ->select('email')
                        ->get();
                Mail::to($email)->send(new notifikasiRequestToAdmin($data));
                
                // $email = DB::table('karyawan')->leftJoin('users', function($join){
                //         $join->on('karyawan.nik','=','users.username');
                //         })->where('karyawan.divisi_id',$data->divisi_id)
                //         ->where('users.role_id',4)
                //         ->select('karyawan.email')
                //         ->get();
    
                // Mail::to($email)->send(new notifikasiRequestApprovalVP($data));
            }
    
            elseif($data->status_pengajuan == 4){
                $email = Employee::where('nik', $data->nik)
                        ->select('email')
                        ->get();
                Mail::to($email)->send(new notifikasistatusRejected($data));
            }
    
            else{
                $status = "PROSES";
            }
            return redirect('/approvalManager')->with('success', 'Persetujuan berhasil diupdate');
        }
         catch(\Exception $e){
            return redirect('/approvalManager')->with('failed', 'Persetujuan request gagal diupdate');
        }
    }

    // VP
    public function approvalVP()
    {
        // $roleVP = Employee::where('nik', '=', Auth::user()->username)
        //             ->select('jabatan_id','divisi_id')
        //             ->first();
        
        // $datas = RequestBarang::where('status_pengajuan','=',0)
        //                         ->where('nama_proyek',3)
        //                         ->where('divisi_id', $roleVP->divisi_id)
        //                         ->get();
                                
        // foreach($datas as $dt){
            if(Auth::user()->user_login->divisi_id == 3){
                $data['request_barang'] = RequestBarang::where('status_pengajuan','=',0)
                                        ->where('matriks', 8)
                                        ->get();
                return view('highlevel/approval-request/vp/index')->with($data);
            }
            elseif(Auth::user()->user_login->divisi_id == 2 || Auth::user()->user_login->divisi_id == 4){
                $data['request_barang'] = RequestBarang::where('status_pengajuan','=',0)
                                        ->where('matriks', 7)
                                        ->get();
                return view('highlevel/approval-request/vp/index')->with($data);
            }
            elseif(Auth::user()->user_login->divisi_id == 1){
                $data['request_barang'] = RequestBarang::where('status_pengajuan','=',0)
                                        ->where('matriks', 6)
                                        ->get();
                return view('highlevel/approval-request/vp/index')->with($data);
            }
            else{
               return "tes"; 
            }
        // }
        
        
    }

    public function editApprovalVP($id)
    {
        $data['approval'] = RequestBarang::find($id);
        return view('highlevel/approval-request/vp/edit')->with($data);
    }

    public function updateApprovalVP(Request $request, $id)
    {
        try{
            $role = Employee::where('nik', '=', Auth::user()->username)
            ->select('nama')
            ->first();
    
            $data =  RequestBarang::find($id);
            $data->status_pengajuan = $request->get('status_pengajuan');
            $data->updated_vp_by = $role->nama;
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->komentar_vp = $request->get('komentar');
            $data->save();
            
            // Email
            if($data->status_pengajuan == 1){
                $email = Employee::where('nik','=','admin')
                        ->select('email')
                        ->get();

                Mail::to($email)->send(new notifikasiRequestToAdmin($data));
            }

            elseif($data->status_pengajuan == 4){
                $email = Employee::where('nik', $data->nik)
                        ->select('email')
                        ->get();
                Mail::to($email)->send(new notifikasistatusRejected($data));
            }
            else{
                $status = "PROSES";
            }
            
        // Email
        // if($data->status_pengajuan == 2){
        //     $email = DB::table('karyawan')->leftJoin('users', function($join){
        //         $join->on('karyawan.nik','=','users.username');
        //         })->where('users.role_id',5)
        //         ->where('karyawan.jabatan_id',78)
        //         ->select('karyawan.email')
        //         ->get();
        //     Mail::to($email)->send(new notifikasiRequestApprovalCEO($data));
        // }

        // elseif($data->status_pengajuan == 4){
        //     $email = Employee::where('nik', $data->nik)
        //             ->select('email')
        //             ->get();
        //     Mail::to($email)->send(new notifikasistatusRejected($data));
        // }
        // else{
        //     $status = "PROSES";
        // }

        return redirect('/approvalVP')->with('success', 'Persetujuan request berhasil diupdate');
        }
        
        catch(\Exception $e){
            return redirect('/approvalVP')->with('failed', 'Persetujuan request gagal diupdate');
        }
        
    }

    // CEO
    // public function approvalCEO()
    // {
    //     $data['request_barang'] = RequestBarang::where('status_pengajuan','=', 2)
    //     ->get();
    //     return view('highlevel/approval-request/ceo/index')->with($data);
    // }

    // public function editApprovalCEO($id)
    // {
    //     $data['approval'] = RequestBarang::find($id);
    //     return view('highlevel/approval-request/ceo/edit')->with($data);
    // }

    // public function updateApprovalCEO(Request $request, $id)
    // {
    //     $role = Employee::where('nik', '=', Auth::user()->username)
    //     ->select('nama')
    //     ->first();

    //     $data =  RequestBarang::find($id);
    //     $data->status_PO = 0;
    //     $data->updated_ceo_by = $role->nama;
    //     $data->status_pengajuan = $request->get('status_pengajuan');
    //     $data->updated_at = Carbon::now()->toDateTimeString();
    //     $data->komentar_ceo = $request->get('komentar');
    //     $data->save();
        
    //     $ids = $data->id;
    //     RequestBarang::where('id', $ids)->update(
    //         [
    //             'no_po'=> "PO".'/'.$data->id.'/'.$data->lokasiProyek->code_loc.'/'. Carbon::createFromFormat('Y-m-d', $data->tanggal_pengajuan)->year
    //         ]
    //     );
        
    //     if($data->status_pengajuan == 3){
    //         $email = Employee::where('nik','=','admin')
    //                 ->select('email')
    //                 ->get();
    //         Mail::to($email)->send(new notifikasiRequestToAdmin($data));
    //     }
    //     elseif($data->status_pengajuan == 4){
    //         $email = Employee::where('nik', $data->nik)
    //                 ->select('email')
    //                 ->get();
    //         Mail::to($email)->send(new notifikasistatusRejected($data));
    //     }
    //     else{
    //         $status = "PROSES";
    //     }
    //     return redirect('/approvalCEO')->with('success', 'Persetujuan berhasil diupdate');
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

    public function editPasswordManager($id)
    {
        $data['reset'] = User::find($id);
        return view('resetpassword/resetpassword_manager')->with($data);
    }

    public function updatePasswordManager(Request $request, $id)
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

    public function editPasswordVP($id)
    {
        $data['reset'] = User::find($id);
        return view('resetpassword/resetpassword_vp')->with($data);
    }

    public function updatePasswordVP(Request $request, $id)
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

    public function editPasswordCEO($id)
    {
        $data['reset'] = User::find($id);
        return view('resetpassword/resetpassword_ceo')->with($data);
    }

    public function updatePasswordCEO(Request $request, $id)
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
