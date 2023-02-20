<?php

namespace App\Http\Controllers\AssetManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestBarang;
use Carbon\Carbon;
use App\Employee;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifikasiPengeluaranToKaryawan;

class AssetManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['request_barang'] = RequestBarang::where('status_brg_keluar','!=',0)
                                ->orderBy('updated_at','desc')
                                ->get();

        return view('assetmanagement/index')->with($data);
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
        $data['approval'] = RequestBarang::find($id);
        return view('assetmanagement/edit')->with($data);
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
            $data =  RequestBarang::find($id);
            $data->status_brg_keluar = $request->get('status_brg_keluar');
            $data->updated_asset_by = $request->get('updated_asset_by');

            // update by Zul 
            if($data->parsial_pay1 == null && $data->parsial_pay2 == null && $data->parsial_pay3 == null && $data->parsial_pay4 == null){
                $data->total_barang_keluar = $request->get('barang_lunas');
                $data->total_barang_pending = 0;
            }
            elseif ($data->parsial_pay1 != null && $data->parsial_pay2 == null && $data->parsial_pay3 == null && $data->parsial_pay4 == null){
                $data->total_barang_keluar = $request->get('total_barang_parsial');
                $data->total_barang_pending = $request->get('total_barang_pending');
            }
    
            else if ($data->parsial_pay1 != null && $data->parsial_pay2 != null && $data->parsial_pay3 == null && $data->parsial_pay4 == null){
                $parsial_keluar1 =  $request->get('total_barang_keluar');
                $parsial_keluar2 =  $request->get('total_barang_pending');
                $hitung = $parsial_keluar1 + $parsial_keluar2;
                //  dd($hitung);
                $data->total_barang_keluar = $hitung;
                $data->total_barang_pending = $request->get('total_parsial2');
            }
            else if ($data->parsial_pay1 != null && $data->parsial_pay2 != null && $data->parsial_pay3 != null && $data->parsial_pay4 == null){
                $parsial_keluar3 =  $request->get('total_barang_keluar');
                $parsial_keluar4 =  $request->get('total_barang_pending');
                $hitung = $parsial_keluar3 + $parsial_keluar4;
                $data->total_barang_keluar = $hitung;
                $data->total_barang_pending = $request->get('total_parsial3');
            }
            else if ($data->parsial_pay1 != null && $data->parsial_pay2 != null && $data->parsial_pay3 != null && $data->parsial_pay4 != null){
                $parsial_keluar3 =  $request->get('total_barang_keluar');
                $parsial_keluar4 =  $request->get('total_barang_pending');
                $hitung = $parsial_keluar3 + $parsial_keluar4;
                $data->total_barang_keluar = $hitung;
                $data->total_barang_pending = $request->get('total_parsial4');
            }
            $data->tanggal_pengeluaran = Carbon::now()->toDateTimeString();
            $data->save();
        
            if($data->status_paid == 5 && $data->status_brg_keluar == 2){
                $email = Employee::where('nik', $data->nik)
                            ->select('email')
                            ->get();
    
                Mail::to($email)->send(new notifikasiPengeluaranToKaryawan($data));
            }
            
            else{
                $status = "PROSES";
            }
            return redirect('/list-approval-barang-keluar')->with('success', 'Persetujuan berhasil diupdate');
        }
        
        catch(\Exception $e){
            return redirect('/list-approval-barang-keluar')->with('failed', 'Update Gagal. Silahkan coba kembali');
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
