<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Employee;
use App\RequestBarang;

class navigation extends Controller
{
    // public static function countRequestCEO(){
    //     $countApprovalRequestCEO = RequestBarang::where('status_pengajuan','=', 2)
    //                                 ->count();

    //     return $countApprovalRequestCEO; 
    // }

    // public static function countPurchaseCEO(){
    //     $countApprovalPurchaseCEO = RequestBarang::where('status_pengajuan',1)
    //                                 ->where('status_PO',2)
    //                                 ->where('upload_po','!=','')
    //                                 ->count();

    //     return $countApprovalPurchaseCEO; 
    // }
    
    public static function countPurchaseVP(){
        $roleVP = Employee::where('nik', '=', Auth::user()->username)
                ->select('jabatan_id','divisi_id')
                ->first();

        // $countApprovalPurchaseCEO = RequestBarang::where('status_pengajuan',1)
        //                             ->where('nama_proyek', 3)
        //                             ->where('divisi_id', $roleVP->divisi_id)
        //                             ->where('status_PO',1)
        //                             ->where('upload_po','!=','')
        //                             ->count();
        
        $datas = RequestBarang::where('status_pengajuan',1)
                        ->where('nama_proyek', 3)
                        ->where('status_PO',1)
                        ->where('upload_po','!=','')
                        ->get();

        foreach($datas as $dt){
            if($dt->kode_barang == 11){
                $countApprovalPurchaseCEO = RequestBarang::where('status_pengajuan',1)
                                ->where('nama_proyek', 3)
                                ->where('divisi_id', 3)
                                ->where('status_PO',1)
                                ->where('upload_po','!=','')
                                ->count();
                return $countApprovalPurchaseCEO; 
            }
            elseif($dt->kode_barang == 24){
                $countApprovalPurchaseCEO = RequestBarang::where('status_pengajuan',1)
                                ->where('nama_proyek', 3)
                                ->where('divisi_id', 1)
                                ->where('status_PO',1)
                                ->where('upload_po','!=','')
                                ->count();
                return $countApprovalPurchaseCEO; 
            }
            elseif($dt->kode_barang == 25){
                $countApprovalPurchaseCEO = RequestBarang::where('status_pengajuan',1)
                                ->where('nama_proyek', 3)
                                ->where('divisi_id', 2)
                                ->where('status_PO',1)
                                ->where('upload_po','!=','')
                                ->count();
                return $countApprovalPurchaseCEO; 
            }
        }
    }

    public static function countPaymentCEO(){
        $countApprovalPaymentCEO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',2)
                                ->where('upload_po','!=','')
                                ->where('upload_invoice','!=','')
                                ->count(); 

        return $countApprovalPaymentCEO;
    }

    public static function countListInvoice(){
        $countUploadInvoice = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',0)
                                ->where('upload_invoice',null)
                                ->count();
        return $countUploadInvoice;
    }

    public static function countListPayment(){

        $countUploadPayment = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',3)
                                ->where('upload_bukti_bayar','')
                                ->count();

        return $countUploadPayment;
    }

    public static function countBarangKeluar(){
        $countBarangKeluar = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',5)
                                ->where('status_brg_keluar',1)
                                ->count();
        return $countBarangKeluar;
    }

    // CO
    public static function countPurchaseCO(){
        $countApprovalPurchaseCO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',0)
                                ->where('upload_po','!=','')
                                ->count();

        return $countApprovalPurchaseCO;
    }

    public static function countPaymentCO(){
        $countApprovalPaymentCO = RequestBarang::where('status_pengajuan',1)
                                ->where('status_PO',2)
                                ->where('status_paid',0)
                                ->where('upload_tba','!=','')
                                ->where('upload_cba','!=','')
                                ->where('upload_po','!=','')
                                ->where('upload_invoice','!=','')
                                ->count();   

        return $countApprovalPaymentCO;
    }
    
    public static function countPurchasePM(){
        $role = Employee::where('nik', '=', Auth::user()->username)
                ->select('nama','divisi_id','lokasi_id')
                ->first();

        $countApprovalPurchaseCFO = RequestBarang::where('nama_proyek', $role->lokasi->id)
                                    ->where('status_pengajuan',1)
                                    ->where('status_PO',1)
                                    ->where('nama_proyek', '!=', 3)
                                    ->where('upload_po','!=','')
                                    ->where('upload_tba','!=','')
                                    ->where('upload_cba','!=','')
                                    ->count();

        return $countApprovalPurchaseCFO;
    }
    
    // public static function countPurchaseCFO(){
    //     $countApprovalPurchaseCFO = RequestBarang::where('status_pengajuan',1)
    //     ->where('status_PO',1)
    //     ->where('upload_po','!=','')
    //     ->count();

    //     return $countApprovalPurchaseCFO;
    // }

    public static function countPaymentCFO(){
        $countApprovalPaymentCFO = RequestBarang::where('status_pengajuan',1)
        ->where('status_PO',2)
        ->where('status_paid',1)
        ->where('upload_po','!=','')
        ->where('upload_invoice','!=','')
        ->count();  

        return $countApprovalPaymentCFO;
    }

    public static function countRequestManager(){
        $role = Employee::where('nik', '=', Auth::user()->username)
                ->select('nama','divisi_id','lokasi_id')
                ->first();

        $countApprovalManager= RequestBarang::where('nama_proyek', $role->lokasi->id)
                            ->where('status_pengajuan','=', 0)
                            ->count();
        return $countApprovalManager;
    }

    public static function countRequestVP(){
        $roleVP = Employee::where('nik', '=', Auth::user()->username)
                ->select('jabatan_id','divisi_id')
                ->first();

        // $countApprovalRequestVP = RequestBarang::where('status_pengajuan','=',0)
        //                         ->where('nama_proyek', 3)
        //                         ->where('divisi_id',$roleVP->divisi_id)
        //                         ->count();

        // return $countApprovalRequestVP;
        
        // $datas = RequestBarang::where('status_pengajuan','=',0)
        //                         ->where('nama_proyek', 3)
        //                         ->get();
        
        // foreach($datas as $dt){
            if(Auth::user()->user_login->divisi_id == 3){
                $countApprovalRequestVP = RequestBarang::where('status_pengajuan','=',0)
                                        ->where('nama_proyek', 3)
                                        ->where('matriks', 8)
                                        ->count();
                return $countApprovalRequestVP;
            }
            elseif(Auth::user()->user_login->divisi_id == 2 || Auth::user()->user_login->divisi_id == 4){
                $countApprovalRequestVP = RequestBarang::where('status_pengajuan','=',0)
                                        ->where('nama_proyek', 3)
                                        ->where('matriks', 7)
                                        ->count();
                return $countApprovalRequestVP;
            }
            elseif(Auth::user()->user_login->divisi_id == 1){
                $countApprovalRequestVP = RequestBarang::where('status_pengajuan','=',0)
                                        ->where('nama_proyek', 3)
                                        ->where('matriks', 6)
                                        ->count();
                return $countApprovalRequestVP;
            }
            else{
                return "tes"; 
            }
        // }
    }
    public static function countAllRequest(){
        $countRequestAll = RequestBarang::where('nik', Auth::user()->username)
                            ->where('status_paid', 5)
                            ->where('status_brg_keluar','!=','')
                            ->orWhere('status_pengajuan',4)
                            ->orWhere('status_PO',4)
                            ->orWhere('status_paid',4)
                            ->count();

        return $countRequestAll;
    }

    public static function requestPembelian(){
        $countPengajuan = RequestBarang::where('nik', Auth::user()->username)
                        ->where('status_paid','!=', 5)
                        ->where('status_paid','!=', 4)
                        ->where('status_pengajuan','!=', 4)
                        ->where('status_PO','!=', 4)
                        ->count();
        return $countPengajuan;
    }

    public static function requestPengeluaran(){
        $countRequestPengeluaran = RequestBarang::where('nik', Auth::user()->username)->where('status_paid', 5)
                                    // ->where('status_brg_keluar',1)
                        ->where('status_brg_keluar',0)
                    ->count();
        return $countRequestPengeluaran;
    }
    // Admin
    public static function countUploadPO(){
        $countBarangPO = RequestBarang::where('status_pengajuan',1)
                        ->where('status_PO',0)
                        // ->where('upload_po','')
                        // ->where('upload_tba','')
                        // ->where('upload_cba','')
                        ->count();
        
        return $countBarangPO;
        
    }

    public static function countRequestProcurement(){
        $countProcurement = RequestBarang::where('status_paid',5)
                            ->orWhere('status_pengajuan',4)
                            ->orWhere('status_PO',4)
                            ->orWhere('status_paid',4)
                            ->count();

        return $countProcurement;
    }


}
