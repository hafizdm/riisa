<?php

namespace App\Http\Controllers\Request;
use App\Http\Controllers\Controller;
use \App\User;
use \App\Proyek;
use \App\Employee;
use App\divisi;
use App\JenisBarang;
use \App\Barang;
use App\KategoriBarang;
use \App\RequestBarang;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\notifikasiSendRequest;
use App\Mail\notifikasiPengajuanPengeluaran;
use Illuminate\Support\Facades\Mail;

class ReqTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['request_barang'] = RequestBarang::where('nik','=', Auth::user                        ()->username)
                                ->where('status_paid','!=',5)
                                ->where('status_pengajuan','!=',4)
                                ->where('status_PO','!=',4)
                                ->where('status_paid','!=',4)
                                ->orderBy('created_at', 'desc')->get();
        return view('karyawan/request/index')->with($data);
    }

    public function listPengajuan(){
        $data['request_barang'] = RequestBarang::where(function ($query) {
                                $query->where('nik', '=', Auth::user()->username)
                                      ->where('status_paid', '=', 5);
                                })->orWhere(function ($query) {
                                $query->where('nik', '=', Auth::user()->username)
                                      ->where('status_pengajuan', '=', 4);
                                })->get();

        return view('karyawan/listPengajuan')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['user'] = User::where('id','=', Auth::id())->first();
        $data['barang'] = Barang::all();
        $data['kategori_barang'] = KategoriBarang::all();
        $data['jenis_barang'] = JenisBarang::all();
        
        $data['lokasi_project'] = Proyek::all();
        $data['karyawan'] = Employee::where('nik','=', Auth::user()->username)->first();
        // $data['divisi'] = divisi::all();
    
        return view('karyawan/request/create', $data);
        // return $data;
    }

    public function getBarangList(Request $request)
    {
        $getBarang = Barang::where('jenis_barang', $request->jenis_barang)
                    ->where('kode_barang',$request->kode_barang)
                    ->pluck('nama_barang');
                    // ->get();
        return response()->json($getBarang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = new RequestBarang();
            $data->nama = $request->get('nama');
            $data->nik = $request->get('nik');
            $data->kode_barang = $request->get('kode_barang');
            $data->jenis_barang = $request->get('jenis_barang');
            $data->nama_barang = $request->get('nama_barang');
            $data->harga = $request->get('harga');
            $data->quantity = $request->get('quantity');
            $data->quantity_satuan = $request->get('quantity_satuan');
            $data->total = $request->get('total');
            $data->nama_proyek = $request->get('nama_proyek');
            $data->keterangan = $request->get('keterangan');
            $data->status_pengajuan = 0;
            $data->status_PO = 0;
            $data->status_paid = 0;
            // $data->status_brg_keluar = 0;
            $data->tanggal_pengajuan = $request->get('tanggal_pengajuan');
            $data->divisi_id = $request->get('divisi_id');
            $data->created_at = Carbon::now()->toDateTimeString();
            
            // Updated by cici 
            // Finance and Support
            if($request->kode_barang == 11){
                $data->matriks = 8;
            }
            // Project & Service
            elseif($request->kode_barang == 24){
                $data->matriks = 6;
            }
            // SM & Busdev
            elseif($request->kode_barang == 25){
                $data->matriks = 7;
            }
            // Untuk project
            else{
                $data->matriks = 0;
            }
        
            $data->save();
    
            $ids = $data->id;
            
            if($data->jenis_barang != 3){
                RequestBarang::where('id', $ids)->update(
                    [
                        'no_request'=> "PR".'/'.$data->id.'/'.$data->lokasiProyek->code_loc.'/'. Carbon::createFromFormat('Y-m-d', $data->tanggal_pengajuan)->year
                    ]
                );
            }
            else{
                RequestBarang::where('id', $ids)->update(
                    [
                        'no_request'=> "SR".'/'.$data->id.'/'.$data->lokasiProyek->code_loc.'/'. Carbon::createFromFormat('Y-m-d', $data->tanggal_pengajuan)->year
                    ]
                );
            }
            
            if($request->kode_barang == 11){
                $emailmanager = DB::table('karyawan')->leftJoin('users', function($join){
                                $join->on('karyawan.nik','=','users.username');
                                })
                                ->where('karyawan.divisi_id', 3)
                                ->where('users.role_id',4)
                                ->select('karyawan.email')
                                ->get();
            }
            elseif($request->kode_barang == 24){
                $emailmanager = DB::table('karyawan')->leftJoin('users', function($join){
                    $join->on('karyawan.nik','=','users.username');
                    })
                    ->where('karyawan.divisi_id', 1)
                    ->where('users.role_id',4)
                    ->select('karyawan.email')
                    ->get();
            }
            elseif($request->kode_barang == 25){
                $emailmanager = DB::table('karyawan')->leftJoin('users', function($join){
                            $join->on('karyawan.nik','=','users.username');
                            })
                            ->where('karyawan.divisi_id', 2)
                            ->where('users.role_id', 4)
                            ->select('karyawan.email')
                            ->get();
            }
        
            else{
                $emailmanager = DB::table('karyawan')->leftJoin('users', function($join){
                                $join->on('karyawan.nik','=','users.username');
                                })
                                ->where('karyawan.lokasi_id', $data->masterKategori->kode_kebutuhan)
                                ->where('users.role_id',3)
                                ->select('karyawan.email')
                                ->get();
            }
        
        // if($data->nama_proyek == 3){
        //     // Email to VP
        //         $emailmanager = DB::table('karyawan')->leftJoin('users', function($join){
        //             $join->on('karyawan.nik','=','users.username');
        //         })
        //         ->where('karyawan.divisi_id',$data->divisi_id)
        //         ->where('users.role_id',4)
        //         ->select('karyawan.email')
        //         ->get();
        //     }

        // else{
        //     // Email to PM 
        //         $emailmanager = DB::table('karyawan')->leftJoin('users', function($join){
        //             $join->on('karyawan.nik','=','users.username');
        //         })
        //         ->where('karyawan.divisi_id',$data->divisi_id)
        //         ->where('karyawan.lokasi_id',$data->nama_proyek)
        //         ->where('users.role_id',3)
        //         ->select('karyawan.email')
        //         ->get();
        //     }
        
        
                // Email Manager
                // $emailmanager =  DB::table('karyawan')->leftJoin('users', function($join){$join->on('karyawan.nik','=','users.username');
                //         })
                //         ->where('karyawan.divisi_id',$data->divisi_id)
                //         ->where('users.role_id',3)
                //         ->where('lokasi_id', $data->nama_proyek)
                //         ->select('karyawan.email')
                //         ->get();
                
                Mail::to($emailmanager)->send(new notifikasiSendRequest($data));
    
            return redirect('/request')->with('success', 'Pengajuan request barang berhasil ditambahkan');
        }
        catch(\Exception $e){
            return redirect('/request')->with('failed', 'Pengajuan request barang gagal ditambahkan. Silahkan melakukan pengajuan kembali');
        }
    }

    public function indexRequestPengeluaran()
    {
        $data['request_barang_keluar'] = RequestBarang::where('nik','=', Auth::user()->username)
        ->where('status_paid',5)
        ->where('status_brg_keluar',0)
        ->orderBy('created_at', 'desc')->get();
        return view('karyawan/request-pengeluaran/index')->with($data);
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
    public function editRequestPengeluaran($id)
    {
        $data['request_brg_keluar'] = RequestBarang::find($id);
        return view('karyawan/request-pengeluaran/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRequestPengeluaran(Request $request, $id)
    {
       
        $data =  RequestBarang::find($id);
        $data->status_brg_keluar = $request->get('status_brg_keluar');
        $data->tgl_pengajuan_pengeluaran = Carbon::now()->toDateTimeString();
        $data->total_barang_pending = $data->quantity;
        $data->save();

        // Email Asset Management
        $sendPengajuan = Employee::where('nik','asset.management')
                        ->select('email')
                        ->get();

        Mail::to($sendPengajuan)->send(new notifikasiPengajuanPengeluaran($data));
        return redirect('/listRequest')->with('success', 'Request pengeluaran barang berhasil diajukan. Silahkan menunggu hingga status disetujui');
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
        $req = RequestBarang::destroy($id);
        if($req){
            return response()->json([
                'success'=> 'Request Pembelian berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Request Pembelian gagal dihapus'
            ]);
        }
        return response($response);
    }
    

    // public function chained_dropdown(Request $request){
    //     if ($request->kategori) {
    //         return $data = DB::table('barang')
    //             ->select('nama_barang')
    //             ->where('kode_barang', '=', $request->kategori)
    //             ->get();
    //     }
    //     else {
    //         return $data = DB::table('barang')
    //             ->select('kode_barang')
    //             ->where('id_barang', '=', $request->barang)
    //             ->get();
    //     }
    // }

}
