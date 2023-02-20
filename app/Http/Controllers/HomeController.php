<?php

namespace App\Http\Controllers;

use App\CutiKaryawan;
use App\SPD;
use App\Employee;
use App\RequestBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        
        if(Auth::user()->username == "admin"){
        // Admin
            
            $countBarangPO = RequestBarang::where('status_pengajuan',1)
                            ->where('status_PO',0)
                            ->count();
                            
            $countListProcurement = RequestBarang::where('status_paid',5)
            ->orWhere('status_paid',4)
            ->orWhere('status_PO',4)
            ->orWhere('status_pengajuan',4)
            ->count();

            return view('home', 
            [
                'countBarangPO'=>$countBarangPO,
                'countListProcurement'=>$countListProcurement
            ]);
        }
        elseif(Auth::user()->username == "finance"){
            $countUploadInvoice = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',0)
                                ->where('upload_invoice',null)
                                ->count();

            $countUploadPayment = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',3)
                                ->where('upload_bukti_bayar','')
                                ->count();
            return view('home',
            [
                'countUploadInvoice'=>$countUploadInvoice,
                'countUploadPayment'=>$countUploadPayment
            ]);
        }
        elseif(Auth::user()->username == "HRD"){
            $countKaryawan = Employee::all()->where('nik','!=','admin')
            ->where('nik','!=','finance')
            ->where('nik','!=','asset.management')
            ->count();

            $countSpd = SPD::all()->where('id')->count();
            $countCutiKaryawan = CutiKaryawan::all()->where('status', 1)->count();

            $spd = SPD::latest()
            ->limit(5)
            ->get();
                                
            return view('home',
            [
                'countKaryawan'=>$countKaryawan, 
                'countSpd' =>$countSpd,
                'countCutiKaryawan' => $countCutiKaryawan,
                'spd' => $spd,
            ]);
        }
        
        elseif(Auth::user()->username == "asset.management"){
            $countBarangKeluar = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',5)
                                ->where('status_brg_keluar',1)
                                ->count();
                                
            return view('home',
            [
                'countBarangKeluar'=>$countBarangKeluar,
            ]);
        }

        else{
        // Karyawan 
        $countRequestAll = RequestBarang::where('nik', Auth::user()->username)
                            ->where('status_paid', 5)
                            ->orWhere('status_pengajuan',4)
                            ->orWhere('status_PO',4)
                            ->orWhere('status_paid',4)
                            ->count();

        $countPengajuan = RequestBarang::where('nik', Auth::user()->username)
                        ->where('status_paid','!=', 5)
                        ->where('status_paid','!=', 4)
                        ->where('status_pengajuan','!=', 4)
                        ->where('status_PO','!=', 4)
                        ->count();
        
        $countRequestPengeluaran = RequestBarang::where('nik', Auth::user()->username)
                                    ->where('status_paid', 5)
                                    ->where('status_brg_keluar','!=',2)
                                    ->count();

        // $countApprovePengajuan = RequestBarang::where('nik', Auth::user()->username)
        //                         ->where('status_paid',5)
        //                         ->count();
        // $countRejectedPengajuan = RequestBarang::where('nik', Auth::user()->username)
        //                         ->where('status_pengajuan',4)
        //                         ->orWhere('status_PO',4)
        //                         ->orWhere('status_paid',4)
        //                         ->count();

        $role = Employee::where('nik', '=', Auth::user()->username)
                ->select('nama','divisi_id','lokasi_id')
                ->first();

        // return $role;

        $roleVP = Employee::where('nik', '=', Auth::user()->username)
                ->select('jabatan_id','divisi_id')
                ->first();
                
        // Manager 
        $countApprovalManager= RequestBarang::where('nama_proyek', $role->lokasi->id)
                             ->where('status_pengajuan','=', 0)
                             ->count();
                             
        // // VP
            // if(Auth::user()->user_login->divisi_id == 3){
            //     $countApprovalRequestVP = RequestBarang::where('status_pengajuan','=',0)
            //                             ->where('nama_proyek', 3)
            //                             ->where('matriks', 8)
            //                             ->count();
            // }
            // elseif(Auth::user()->user_login->divisi_id == 2 || Auth::user()->user_login->divisi_id == 4){
            //     $countApprovalRequestVP = RequestBarang::where('status_pengajuan','=',0)
            //                             ->where('nama_proyek', 3)
            //                             ->where('matriks', 7)
            //                             ->count();
            // }
            // elseif(Auth::user()->user_login->divisi_id == 1){
            //     $countApprovalRequestVP = RequestBarang::where('status_pengajuan','=',0)
            //                             ->where('nama_proyek', 3)
            //                             ->where('matriks', 6)
            //                             ->count();
            // }
            // else{
            //     return "tes"; 
            // }

        // CEO - Request
        $countApprovalRequestCEO = RequestBarang::where('status_pengajuan','=', 1)
                                ->count();
        
        // CEO Purchased
        $countApprovalPurchaseCEO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('upload_po','!=','')
                                ->count();
        // CEO Payment
        $countApprovalPaymentCEO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',2)
                                ->where('upload_po','!=','')
                                ->where('upload_invoice','!=','')
                                ->count(); 

        // CO-Purchase and payment
        $countApprovalPurchaseCO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',0)
                                ->where('upload_po','!=','')
                                ->count();

        $countApprovalPaymentCO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',0)
                                ->where('upload_po','!=','')
                                ->where('upload_invoice','!=','')
                                ->count();                                           
                                
        // CFO Purchase and Payment 
        $countApprovalPurchaseCFO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',1)
                                ->where('upload_po','!=','')
                                ->count();

        $countApprovalPaymentCFO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',1)
                                ->where('upload_po','!=','')
                                ->where('upload_invoice','!=','')
                                ->count();  

        return view('home', 
        [
        'role'=>$role,
        'roleVP'=>$roleVP,
        'countPengajuan'=>$countPengajuan,
        // 'countApprovePengajuan'=>$countApprovePengajuan, 
        // 'countRejectedPengajuan'=>$countRejectedPengajuan,
        'countApprovalManager'=> $countApprovalManager,
        // 'countApprovalRequestVP'=>$countApprovalRequestVP,
        // 'countApprovalRequestVPOperational'=>$countApprovalRequestVPOperational,
        'countApprovalRequestCEO'=>$countApprovalRequestCEO,
        'countApprovalPurchaseCEO'=>$countApprovalPurchaseCEO,
        'countApprovalPaymentCEO'=>$countApprovalPaymentCEO,
        'countApprovalPurchaseCO'=>$countApprovalPurchaseCO,
        'countApprovalPaymentCO'=>$countApprovalPaymentCO,
        'countApprovalPurchaseCFO'=>$countApprovalPurchaseCFO,
        'countApprovalPaymentCFO'=>$countApprovalPaymentCFO,
        'countRequestPengeluaran'=>$countRequestPengeluaran,
        'countRequestAll'=> $countRequestAll
        ]);
    }
}
}
