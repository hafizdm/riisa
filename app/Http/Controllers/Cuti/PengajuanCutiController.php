<?php

namespace App\Http\Controllers\Cuti;
use App\Http\Controllers\Controller;
use App\CutiKaryawan;
use \App\User;
use \App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\KategoriCuti;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use PDF;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuti_karyawan = CutiKaryawan::where('nik', Auth::user()->username)->orderBy('created_at', 'desc')->get();
        $kategori_cuti = KategoriCuti::all();
        $sisacuti   = Employee::select('sisa_cuti')->where('nik', Auth::user()->username)->first();
        
        $var = compact("cuti_karyawan","kategori_cuti","sisacuti");
        return view('staff/cuti/index')->with($var);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try{
        $startDate = Carbon::createFromFormat('Y-m-d', $request->dari_tanggal)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('Y-m-d', $request->sampai_tanggal)->format('Y-m-d');
        $period = CarbonPeriod::create($startDate, $endDate);

        $dates = [];
        $weekend = ["Saturday","Sunday"];
        foreach($period as $dt){
            $dtt = $dt->format('l');
            if(in_array($dtt, $weekend))
            {
            // echo "ada weekend";
            }
            else{
                $dates[] = $dt->format('Y-m-d');
            }
        }
        $total = count($dates);

        $first = reset($dates);
        $last = end($dates);
       
        // Menghitung selisih hari 
        // $dari       = $first;
        // $sampai     = $last;
        // $selisih    = strtotime($sampai) - strtotime($dari);
        // $selisih    = $selisih/86400;
        // $jml_hari   = 1 + $selisih;

        // Mengecek sisa cuti ke table karyawan
        $karyawan = Employee::where('nik', Auth::user()->username)->first();
        $get_sisa = $karyawan->sisa_cuti;

        if($total > $get_sisa){
            return redirect('/pengajuan-cuti')->with('failed','Please check the leave date again. Your remaining leave is "'.$get_sisa.'" days');
        }
        else{ 
            $total_sisa_cuti = $get_sisa - $total;
            $karyawan->sisa_cuti = $total_sisa_cuti;
            $karyawan->save();
            
            $cuti                   = new CutiKaryawan();
            $cuti->nik              = Auth::user()->username;
            $cuti->nama_karyawan    = Auth::user()->name;
            $cuti->tgl_pengajuan    = $request->tgl_pengajuan;
            $cuti->dari_tanggal     = $first;
            $cuti->sampai_tanggal   = $last;
            $cuti->jenis_cuti       = $request->jenis_cuti;
            $cuti->keterangan       = $request->description;
            $cuti->jumlah_hari      = $total;
            $cuti->status           = 0;
            $cuti->created_at       = Carbon::now()->toDateTimeString();
            $cuti->save();

            $getID                  = $cuti->id;
            $update_no              = CutiKaryawan::where('id', $getID)->first();
            $update_no->no_cuti     = "HO-".$getID;
            $update_no->updated_at  = Carbon::now()->toDateTimeString();
            $update_no->save();

            return redirect('/pengajuan-cuti')->with('Success', 'Data added successfully');
            }
        // }
        // catch(\Exception $e){
        //     return redirect('/pengajuan-cuti')->with('failed', 'Please check your input again');
        // }
     }

    //  public function storeFileCuti(Request $request,$id){            
    //  }

    //  public function getCuti($id){
    //     $cuti = CutiKaryawan::find($id);
    //     return response()->json([
    //         'data' => $cuti
    //       ]);
    //  }

    public function showUploadCuti($id){
        $data['cuti']= CutiKaryawan::find($id);
        return view('staff/cuti/upload_form_cuti')->with($data);
    }

    public function updateUploadCuti(Request $request,$id){
        $data = CutiKaryawan::find($id);

        
        $files = $request->file('file_scan');
        
        // return $files;
        $destinationPath = 'uploads/'.$request->nik.'/'.'Cuti'; // upload path
        $file = "Cuti_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadCuti= $file;

        $data->file_scan = $uploadCuti;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('pengajuan-cuti')->with('success', 'File successfully updated');
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
        $returnCuti = Employee::where('nik', Auth::user()->username)->first();
        $getSisa    = CutiKaryawan::where('id', $id)->first();
        
        // Sisa cuti di tabel karyawan
        $sisacutiAkhir = $returnCuti->sisa_cuti;

        // Jumlah cuti yang diajukan
        $sisacutiRequest = $getSisa->jumlah_hari;

        // Pengembalian cuti karena dibatalkan
        $totalReturnCuti = $sisacutiAkhir + $sisacutiRequest;

        $returnCuti->sisa_cuti = $totalReturnCuti;
        $returnCuti->save();

        $cuti = CutiKaryawan::destroy($id);
        if($cuti){
            return response()->json([
                'success'=> 'Data successfully deleted'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Data failed deleted'
            ]);
        }
        return response($response);
    }

    public function downloadCuti($id) {
        $data = CutiKaryawan::find($id);
        $pdf = PDF::loadview('staff/cuti/downloadcuti', compact('data'))->setPaper('a4','potrait');
        $fileName = $data->tgl_pengajuan;
        return $pdf->stream("Form Cuti"." ".$fileName. '.pdf');
    }
}
