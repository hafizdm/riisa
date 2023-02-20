<?php

namespace App\Http\Controllers\HRD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Employee;
use \App\Jabatan;
use \App\divisi;
use App\Role;
use App\User;
use App\Proyek;
use Carbon\Carbon;
use Hash;
use File;
use DB;
use App\Pendidikan;
use App\Pengalaman;
use App\Sertifikat;
use Maatwebsite\Excel\Facades\Excel;
// Last updated
use App\KontrakKaryawan;
use App\Exports\KaryawanExport;

// Updated 11 May 2021
use \App\Performance;
use Auth;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //[]
        $data['karyawan'] = Employee::where('nik','!=','admin')
                                    ->where('nik','!=','finance')
                                    ->where('nik','!=','asset.management')
                                    ->where('nik','!=','HRD')
                                    ->orderBy('created_at','desc')->get();
        
        $data['jj'] = Jabatan::all();
        $data['dd'] = divisi::all();
        return view('hrd/karyawan/index')->with($data);
    }

    public function getJabatanDivisi(Request $request){
        $getjabatanDivisi = Jabatan::where('divisi_id',$request->divisi_id)
                            ->select('id','jenis_jabatan')
                            ->get();
                            
        // return response()->json($getjabatanDivisi);
        return $getjabatanDivisi;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['jj'] = Jabatan::all();
        $data['dd'] = divisi::all();
        $data['role'] = Role::where('id','!=', 1)
                            ->where('id','!=',10)
                            ->where('id','!=',11)
                            ->where('id','!=',12)
                            ->get();

        $data['proyek'] = Proyek::all();
        
        // Last Updated by cici
        $data['report'] = Employee::where('nik','!=','admin')
                        ->where('nik','!=','finance')
                        ->where('nik','!=','asset.management')
                        ->where('nik','!=','HRD')
                        ->get();
                        
        return view('hrd/karyawan/create', $data);
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
            $karyawan = new Employee();
            
            // Updated by cici
            $kontrak = new KontrakKaryawan();
            
            $karyawan->id = $request->id;
            $karyawan->nik=$request->get('nik');
            $karyawan->nama=$request->get('nama');
            if($request->foto == ''){
                $karyawan->foto = '';
            }
            else{
                if ($files = $request->file('foto')) {
                    $destinationPath = 'uploads/Karyawan/' . $request->nik; // upload path
                    $file = "Karyawan_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file);
                    $uploadfoto = $request->nik . "/" . $file;
                    $karyawan->foto = $uploadfoto;
                }
            }
            
            $karyawan->alamat=$request->get('alamat');
            $karyawan->npwp=$request->get('npwp');
            $karyawan->email=$request->get('email');
            $karyawan->handphone=$request->get('handphone');
            $karyawan->agama=$request->get('agama');
            $karyawan->email=$request->get('email');
            $karyawan->date_birth=$request->get('date_birth');
            $karyawan->date_resign=$request->get('date_resign');
            $karyawan->divisi_id=$request->get('divisi_id');
            $karyawan->jabatan_id=$request->get('jabatan_id');
            $karyawan->tempat_lahir=$request->get('tempat_lahir');
            $karyawan->jenis_kelamin=$request->get('jenis_kelamin');
            $karyawan->bpjs_kesehatan=$request->get('bpjs_kesehatan');
            $karyawan->bpjs_ketenagakerjaan=$request->get('bpjs_ketenagakerjaan');
            $karyawan->status_karyawan = $request->get('status');
            $karyawan->status_vaksinasi = $request->get('status_vaksinasi');
            $karyawan->lokasi_id=$request->get('lokasi_id');
            $karyawan->report_to=$request->get('report_to');
            $karyawan->spd_report_to=$request->get('spd_report_to');
            $karyawan->created_at = Carbon::now()->toDateTimeString();
            $karyawan->sisa_cuti = $request->get('sisa_cuti');
            
            if($request->status == 0){
                $kontrak->nik_karyawan = $karyawan->nik;
                $kontrak->tgl_mulai_kontrak = $request->get('tgl_mulai_kontrak');
                $kontrak->tgl_akhir_kontrak = $request->get('tgl_akhir_kontrak');
                $kontrak->perpanjangan_ke = 1;
                $kontrak->created_at = Carbon::now()->toDateTimeString();
            }
            else{
                $karyawan->date_joining = $request->get('date_joining');
            }

            $karyawan->save();
            $kontrak->save();
    
            $user = new User();
            $user->username = $request->nik;
            $user->name = $request->nama;
            $user->created_at = Carbon::now()->toDateTimeString();
            $user->last_login = Carbon::now()->toDateTimeString();
            $user->password = Hash::make('12345678');
            $user->role_id = $request->roles;
            $user->id_krywn = $karyawan->id;
            $user->save();
    
            return redirect('/karyawan')->with('success', 'Data berhasil ditambahkan');
        }
        catch(\Exception $e){
            return redirect('/karyawan')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
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
        // Updated by cici
        $data['report'] = Employee::where('nik','!=','admin')
                        ->where('nik','!=','finance')
                        ->where('nik','!=','asset.management')
                        ->where('nik','!=','HRD')
                        ->get();
                        
        $data['karyawan'] = Employee::find($id);
        $data['jj'] = Jabatan::all();
        $data['dd'] = divisi::all();
        $data['proyek'] = Proyek::all();
        $data['role'] = Role::where('id','!=', 1)
                        ->where('id','!=',10)
                        ->where('id','!=',11)
                        ->where('id','!=',12)
                        ->get();
                        
        $datas = Employee::where('id',$id)->first();
        
        $data['kontrakkaryawan']= DB::table('karyawan')->join('kontrak_karyawan','karyawan.nik','=','kontrak_karyawan.nik_karyawan')
                            ->where('kontrak_karyawan.nik_karyawan',  $datas->nik)
                            ->select('kontrak_karyawan.*')
                            // ->latest('updated_at')
                            ->groupBy('nik_karyawan','tgl_akhir_kontrak','perpanjangan_ke')
                            ->orderBy('updated_at','asc')
                            ->get();
        $data['get_tgl']= collect(DB::select("
                            SELECT max(kontrak.tgl_akhir_kontrak) as tgl_mulai from karyawan as e JOIN kontrak_karyawan as kontrak 
                            ON e.nik = kontrak.nik_karyawan
                            WHERE kontrak.nik_karyawan = '".$datas->nik."'
                            GROUP BY kontrak.nik_karyawan
                        "));

        $data['count'] = DB::table('karyawan')->join('kontrak_karyawan','karyawan.nik','=','kontrak_karyawan.nik_karyawan')
                        ->where('kontrak_karyawan.nik_karyawan',  $datas->nik)
                        ->count();
                            
        $data['pendidikans'] = DB::table('karyawan')->join('pendidikan','karyawan.nik','=','pendidikan.id_karyawan')
            ->where('pendidikan.id_karyawan',$datas->nik)
            ->select('pendidikan.*')
            ->get();
        
        $data['pengalamans'] = DB::table('karyawan')->join('pengalaman','karyawan.nik','=','pengalaman.id_karyawan')
            ->where('pengalaman.id_karyawan',$datas->nik)
            ->select('pengalaman.*')
            ->get();

        $data['sertifikats'] = DB::table('karyawan')->join('sertifikat','karyawan.nik','=','sertifikat.id_karyawan')
            ->where('sertifikat.id_karyawan',$datas->nik)
            ->select('sertifikat.*')
            ->get();
            
        // Updated on 11 May 2021
        $data['performances'] = DB::table('karyawan')->join('performance','karyawan.nik','=','performance.id_karyawan')
            ->where('performance.id_karyawan',$datas->nik)
            ->select('performance.*')
            ->get();

        // return $data;
        return view('hrd/karyawan/edit')->with($data);
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
            // $get_tgl = $request->tgl_mulai; 
            
            $karyawan = Employee::find($id);
            $karyawan->nik=$request->get('nik');
            $karyawan->nama=$request->get('nama');
            $karyawan->tempat_lahir=$request->get('tempat_lahir');
            $karyawan->date_birth=$request->get('date_birth');
            $karyawan->alamat=$request->get('alamat');
            $karyawan->agama=$request->get('agama');
            $karyawan->jenis_kelamin=$request->get('jenis_kelamin');
            $karyawan->email=$request->get('email');
            $karyawan->handphone=$request->get('handphone');
            $karyawan->npwp=$request->get('npwp');
            $karyawan->bpjs_ketenagakerjaan =$request->get('bpjs_ketenagakerjaan');
            $karyawan->bpjs_kesehatan =$request->get('bpjs_kesehatan');
            $karyawan->divisi_id=$request->get('divisi_id');
            $karyawan->jabatan_id=$request->get('jabatan_id');
            $karyawan->lokasi_id=$request->get('lokasi_id');
            $karyawan->status_karyawan=$request->get('status');
            $karyawan->status_vaksinasi = $request->get('status_vaksinasi');
            $karyawan->date_resign=$request->get('date_resign');
            $karyawan->report_to=$request->get('report_to');
            $karyawan->spd_report_to=$request->get('spd_report_to');
            $karyawan->updated_at = Carbon::now()->toDateTimeString();
            $karyawan->sisa_cuti = $request->get('sisa_cuti');
            $karyawan->save();
    
            $user = User::where('id_krywn',$id)->first();
            $user->username = $request->get('nik');
            $user->name = $request->get('nama');
            $user->role_id = $request->get('roles');
            $user->updated_at = Carbon::now()->toDateTimeString();
            $user->save();
            
            // Updated by cici
            $kontrak  = new KontrakKaryawan();
            $kontrak->nik_karyawan = $request->nik;

            if($request->status == 0){
                $kontrak->perpanjangan_ke = $request->perpanjangan_ke;
                $kontrak->tgl_mulai_kontrak = $request->tgl_mulai;
                $kontrak->tgl_akhir_kontrak = $request->tgl_akhir_kontrak;
                $kontrak->updated_at = Carbon::now()->toDateTimeString();
            }
            else{
                $kontrak->perpanjangan_ke = 0;
                Employee::where('id', $id)->update(
                    [
                        'date_joining'=> $request->tgl_akhir_kontrak,
                        'status_karyawan'=>$request->status
                    ]
                );
            }
            $kontrak->save();

            return redirect('/karyawan')->with('success', 'Data berhasil di Update');
        }
        catch(\Exception $e){
            return redirect('/karyawan')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        $karyawan = Employee::where('nik', $nik)->delete();
        $users = User::where('username', $nik)->delete();

        if($karyawan){
            return response()->json([
                'success'=> 'Data Karyawan berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Data Karyawan gagal dihapus'
            ]);
        }
        return response($response);
    }
    
    // Updated by cici
        public function destroyKontrak($id){
        DB::delete('delete from kontrak_karyawan where id = ?',[$id]);
        return back();
    }

    public function cetak_excel(){
        return Excel::download(new KaryawanExport, 'Data Karyawan RII.xlsx');
    }
    
    // Performance Appraisals
    public function storePerformance(Request $request){
        $data = new Performance();
        $path = 'uploads/Karyawan/'.$request->nik.'/'.'Performance';
        $files = $request->file('file_performance');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'Performance'; // upload path
        $file = "Performance_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadPeformance = $file;
        $data->id_karyawan = $request->nik;
        $data->file_performance = $uploadPeformance;
        $data->created_at = Carbon::now()->toDateTimeString();
        $data->save();
        
        return redirect('/karyawan')->with('success','File Performance berhasil diupload');
    }
    
    public function destroyPerformance($id){
        $performance = Performance::destroy($id);
        if($performance){
            return response()->json([
                'success'=> 'File performance berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'File performance gagal dihapus'
            ]);
        }
        return response($response);
    }
    
    
}
