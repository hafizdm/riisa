<?php

namespace App\Http\Controllers\Staff;
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
use App\jabatanDivisi;
use App\Pengalaman;
use App\Pendidikan;
use App\Sertifikat;
use Auth;
use DB;
use App\Performance;
use App\Vaksinasi;

class DatadiriController extends Controller
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
    public function editProfil($id)
    {
        //
        $data['karyawan'] = Employee::where('nik',$id)->first();
        // return $data;
        $data['jj'] = Jabatan::all();
        $data['dd'] = divisi::all();
        $data['proyek'] = Proyek::all();
        $data['role'] = Role::all();

        $datas = Employee::where('nik',$id)->first();

        $data['kontrakkaryawan']= DB::table('karyawan')->join('kontrak_karyawan','karyawan.nik','=','kontrak_karyawan.nik_karyawan')
                            ->where('kontrak_karyawan.nik_karyawan',  $datas->nik)
                            ->select('kontrak_karyawan.*')
                            // ->latest('updated_at')
                            ->groupBy('nik_karyawan','tgl_akhir_kontrak','perpanjangan_ke')
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
                    
        $data['vaksinasi'] = Vaksinasi::where('id_karyawan', $datas->nik)->count();
        
        return view('staff/profil/edit')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getJabatanDivisi(Request $request){
        $getjabatanDivisi = Jabatan::where('divisi_id',$request->divisi_id)
                            ->select('id','jenis_jabatan')
                            ->get();
                            
        // return response()->json($getjabatanDivisi);
        return $getjabatanDivisi;
    }
    
    public function updateProfil(Request $request, $id)
    {
        try{
            $datadiri = Employee::where('nik',$id)->first();
        
            if(empty($request->file('foto'))){
                $uploadfoto = $datadiri->foto;
            }
            else{
                $path = 'uploads/Karyawan/'.$request->nik;

                if(!File::exists($path)){
                    $files = $request->file('foto');
                    $destinationPath = 'uploads/Karyawan/' . $request->nik; // upload path
                    $file = "Karyawan_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file);
                    $uploadfoto = $request->nik . "/" . $file;
                }
                else{
                    unlink('uploads/Karyawan/'.$datadiri->foto);
                    $files = $request->file('foto');
                    $destinationPath = 'uploads/Karyawan/' . $request->nik; // upload path
                    $file = "Karyawan_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file);
                    $uploadfoto = $request->nik . "/" . $file;
                }
                
            }

            $datadiri->foto = $uploadfoto;
            $datadiri->nama= $request->get('nama');
            $datadiri->tempat_lahir = $request->get('tempat_lahir');
            $datadiri->date_birth = $request->get('date_birth');
            $datadiri->jenis_kelamin = $request->get('jenis_kelamin');
            $datadiri->agama = $request->get('agama');
            $datadiri->alamat = $request->get('alamat');
            $datadiri->email = $request->get('email');
            $datadiri->handphone = $request->get('handphone');
            $datadiri->npwp = $request->get('npwp');
            $datadiri->bpjs_ketenagakerjaan = $request->get('bpjs_ketenagakerjaan');
            $datadiri->bpjs_kesehatan = $request->get('bpjs_kesehatan');
            $datadiri->status_vaksinasi = $request->get('status_vaksinasi');
            $datadiri->divisi_id = $request->get('divisi_id');
            $datadiri->jabatan_id = $request->get('jabatan_id');
            $datadiri->lokasi_id = $request->get('lokasi_id');
            $datadiri->updated_at = Carbon::now()->toDateTimeString();
            $datadiri->save();

            $user = User::where('username',$id)->first();
            $user->name = $request->get('nama');
            $user->save();

            return redirect('/ubah-data-diri'.'/'.$datadiri->nik)->with('success', 'Data Profil berhasil di Perbaharui');
        }
        catch(\Exception $e){
            return redirect('/ubah-data-diri'.'/'.$datadiri->nik)->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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

    public function indexPengalaman(){

        $data['pengalaman'] = Pengalaman::where('id_karyawan', Auth::user()->username)->latest('tgl_selesai')->get();
        return view('staff/pengalaman/index')->with($data);
    }

    public function createPengalaman(){
        return view('staff/pengalaman/create');
    }

    public function storePengalaman(Request $request){
        
        $add_pengalaman = new Pengalaman();
        $add_pengalaman->id_karyawan = Auth::user()->username;
        $add_pengalaman->nama_perusahaan = $request->get('nama_perusahaan');
        $add_pengalaman->tgl_mulai = $request->get('tgl_mulai');
        $add_pengalaman->tgl_selesai = $request->get('tgl_selesai');
        $add_pengalaman->posisi = $request->get('posisi');
        $add_pengalaman->gaji = $request->get('gaji');
        $add_pengalaman->created_at = Carbon::now()->toDateTimeString();
        $add_pengalaman->save();

        return redirect('pengalaman')->with('success', 'Data Pengalaman berhasil ditambah');
    }

    public function editPengalaman($id)
    {
        $data['pengalaman'] = Pengalaman::find($id);
        return view('staff/pengalaman/edit')->with($data);

        // $pengalaman = Pengalaman::find($id);
        // return response()->json([
        //     'data' => $pengalaman
        //   ]);
    }

    public function updatePengalaman(Request $request, $id){
        // $pengalaman = Pengalaman::find($id);
        // $pengalaman->nama_perusahaan = $request->get('nama_perusahaan');
        // $pengalaman->tgl_mulai = $request->get('tgl_mulai');
        // $pengalaman->tgl_selesai = $request->get('tgl_selesai');
        // $pengalaman->posisi = $request->get('posisi');
        // $pengalaman->gaji = $request->get('gaji');
        // $pengalaman->updated_at = Carbon::now()->toDateTimeString();
        // $pengalaman->save();

        // return redirect('pengalaman')->with('success', 'Data Pengalaman berhasil diperbaharui');

        try{
            $nama_perusahaan = $request->get('edit_nama_perusahaan');
            $tgl_mulai =  $request->get('edit_tgl_mulai');
            $tgl_selesai =  $request->get('edit_tgl_selesai');
            $posisi =  $request->get('edit_posisi');
            $gaji =  $request->get('edit_gaji');

            Pengalaman::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'nama_perusahaan' => $nama_perusahaan,
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_selesai' => $tgl_selesai, 
                    'posisi' => $posisi, 
                    'gaji' => $gaji,
                    'updated_at' => Carbon::now()->toDateTimeString()
                ],
            );
            return response()->json(['success' => true ]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
            }
        }

    public function destroyPengalaman($id)
    {

        $pengalaman = Pengalaman::destroy($id);
        if($pengalaman){
            return response()->json([
                'success'=> 'Pengalaman berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Pengalaman gagal dihapus'
            ]);
        }
        return response($response);
    }

    // Pendidikan
    public function indexPendidikan(){
        $data['pendidikan'] = Pendidikan::where('id_karyawan', Auth::user()->username)->latest('tgl_keluar')->get();
        return view('staff/pendidikan/index')->with($data);
    }

    public function createPendidikan(){
        return view('staff/pendidikan/create');
    }

    public function storePendidikan(Request $request){
        $pendidikan = new Pendidikan();
        $pendidikan->id_karyawan = Auth::user()->username;
        $pendidikan->nama_institusi = $request->get('nama_institusi');
        $pendidikan->tgl_masuk = $request->get('tgl_masuk');
        $pendidikan->tgl_keluar = $request->get('tgl_keluar');
        $pendidikan->jenjang_pendidikan = $request->get('jenjang_pendidikan');
        $pendidikan->jurusan = $request->get('jurusan');
        $pendidikan->lokasi = $request->get('lokasi');
        $pendidikan->ipk = $request->get('ipk');
        $pendidikan->created_at = Carbon::now()->toDateTimeString();
        $pendidikan->save();

        return redirect('pendidikan')->with('success', 'Data Pendidikan berhasil ditambah');
    }
    public function destroyPendidikan($id)
    {

        $pendidikan = Pendidikan::destroy($id);
        if($pendidikan){
            return response()->json([
                'success'=> 'Pendidikan berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Pendidikan gagal dihapus'
            ]);
        }
        return response($response);
    }

    public function editPendidikan($id)
    {
        $data['pendidikan'] = Pendidikan::find($id);
        return view('staff/pendidikan/edit')->with($data);

        // $pendidikan = Pendidikan::find($id);
        // return response()->json([
        //     'data' => $pendidikan
        //   ]);
    }

    public function updatePendidikan(Request $request, $id){
        // $pendidikan = Pendidikan::find($id);
        // $pendidikan->nama_institusi = $request->get('nama_institusi');
        // $pendidikan->tgl_masuk = $request->get('tgl_masuk');
        // $pendidikan->tgl_keluar = $request->get('tgl_keluar');
        // $pendidikan->jenjang_pendidikan = $request->get('jenjang_pendidikan');
        // $pendidikan->jurusan = $request->get('jurusan');
        // $pendidikan->lokasi = $request->get('lokasi');
        // $pendidikan->ipk = $request->get('ipk');
        // $pendidikan->updated_at = Carbon::now()->toDateTimeString();
        // $pendidikan->save();

        // return redirect('pendidikan')->with('success', 'Data Pendidikan berhasil diperbaharui');

        try{
            $nama_institusi = $request->get('edit_nama_institusi');
            $tgl_masuk =  $request->get('edit_tgl_masuk');
            $tgl_keluar =  $request->get('edit_tgl_keluar');
            $jenjang_pendidikan =  $request->get('edit_jenjang_pendidikan');
            $jurusan =  $request->get('edit_jurusan');
            $lokasi =  $request->get('edit_lokasi');
            $ipk =  $request->get('edit_ipk');

            Pendidikan::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'nama_institusi' => $nama_institusi,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_keluar' => $tgl_keluar, 
                    'jenjang_pendidikan' => $jenjang_pendidikan, 
                    'jurusan' => $jurusan,
                    'lokasi' => $lokasi, 
                    'ipk' => $ipk,
                    'updated_at' => Carbon::now()->toDateTimeString()
                ],
            );
            return response()->json(['success' => true ]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
            }
    }

    
    public function indexUploadFile(){
        $upload_file        = Employee::where('nik', Auth::user()->username)->get();
        $sertifikat         = Sertifikat::where('id_karyawan', Auth::user()->username)->get();
        $performances       = Performance::where('id_karyawan', Auth::user()->username)->get();
        $vaksinasi          = Vaksinasi::where('id_karyawan', Auth::user()->username)->get();
        
        $count_vaksin       = Vaksinasi::where('id_karyawan', Auth::user()->username)->count();
        
        $var = compact('upload_file','sertifikat','performances','vaksinasi','count_vaksin');
        
        return view('staff/upload-file/index')->with($var);
    }

    // Upload CV
    public function createFileCV(){
        return view('staff/upload-file/create-cv');
    }

    public function storeFileCV(Request $request){

        $data = Employee::where('nik',Auth::user()->username)->first();
        $path = 'uploads/Karyawan/'.$request->nik.'/'.'CV';
        
        $files = $request->file('file_cv');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'CV'; // upload path
        $file = "CV_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadCV = $file;

        $data->file_cv = $uploadCV;
        $data->created_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('/upload-file')->with('success','File CV berhasil diupload');
    }

    public function editFileCV($id){

        // $data['cv'] = Employee::where('nik',Auth::user()->username)->first();
        // return view('staff/upload-file/edit-cv')->with($data);

        $cv = Employee::where('nik', Auth::user()->username)->first();
        return response()->json([
            'data' => $cv
          ]);
    }

    public function updateFileCV(Request $request, $id){
    
        // $data = Employee::find($id);

        // unlink('uploads/Karyawan/'.$request->nik.'/'.'CV'.'/'.$data->file_cv);
        // $files = $request->file('file_cv');
        // $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'CV'; // upload path
        // $file = "CV_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        // $files->move($destinationPath, $file);
        // $uploadCV = $file;

        // $data->file_cv = $uploadCV;
        // $data->updated_at = Carbon::now()->toDateTimeString();
        // $data->save();

        // return redirect('/upload-file')->with('success', 'File CV berhasil diupdate');
        
        // try{
            $data = Employee::find($id);
            $nik = $request->get('edit_nik'); 
            $files = $request->file('edit_file_cv');

            $file_path = 'uploads/Karyawan/'.$nik.'/'.'CV'.'/'.$data->file_cv;
            File::delete($file_path);
            $destinationPath = 'uploads/Karyawan/'.$nik.'/'.'CV'; // upload path
            $file = "CV_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $file);
            $uploadCV = $file;

            $data->file_cv = $uploadCV;
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();
            
            return response()->json(['success' => true ]);
        // }
        // catch(\Exception $e){
        //     return response()->json(['failed' => true]);
        //     }
    }

    // Upload Ijazah
    public function createFileIjazah(){
        return view('staff/upload-file/create-ijazah');
    }

    public function storeFileIjazah(Request $request){

        $data = Employee::where('nik',Auth::user()->username)->first();
        $path = 'uploads/Karyawan/'.$request->nik.'/'.'Ijazah';
        
        $files = $request->file('file_ijazah');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'Ijazah'; // upload path
        $file = "Ijazah_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadIjazah = $file;

        $data->file_ijazah = $uploadIjazah;
        $data->created_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('/upload-file')->with('success','File Ijazah berhasil diupload');
    }

    public function editFileIjazah(){

        $data['ijazah'] = Employee::where('nik',Auth::user()->username)->first();
        return view('staff/upload-file/edit-ijazah')->with($data);
    }

    public function updateFileIjazah(Request $request, $id){
    
        $data = Employee::find($id);

        unlink('uploads/Karyawan/'.$request->nik.'/'.'Ijazah'.'/'.$data->file_ijazah);
        $files = $request->file('file_ijazah');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'Ijazah'; // upload path
        $file = "Ijazah_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadIjazah = $file;

        $data->file_ijazah = $uploadIjazah;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('/upload-file')->with('success', 'File Ijazah berhasil diupdate');

    }
    
    // Sertifikat
    
    public function createFileSertifikat(){
        return view('staff/upload-file/create-sertifikat');
    }

    public function storeFileSertifikat(Request $request){

        $data = new Sertifikat();
        $path = 'uploads/Karyawan/'.$request->nik.'/'.'Sertifikat';
        $files = $request->file('file_sertifikat');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'Sertifikat'; // upload path
        $file = "Sertifikat_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadSertifikat = $file;
        $data->id_karyawan = $request->nik;
        $data->file_sertifikat = $uploadSertifikat;
        $data->created_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('/upload-file')->with('success','File Sertifikat berhasil diupload');
    }

    public function editFileSertifikat(){

        $data['sertifikat'] = Sertifikat::where('id_karyawan',Auth::user()->username)->first();
        return view('staff/upload-file/edit-sertifikat')->with($data);
    }

    public function updateFileSertifikat(Request $request, $id){
    
        $data = Sertifikat::find($id);

        unlink('uploads/Karyawan/'.$request->nik.'/'.'Sertifikat'.'/'.$data->file_sertifikat);
        $files = $request->file('file_sertifikat');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'Sertifikat'; // upload path
        $file = "Sertifikat_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadSertifikat = $file;

        $data->file_sertifikat = $uploadSertifikat;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('/upload-file')->with('success', 'File Ijazah berhasil diupdate');
    }

    public function destroySertifikat($id)
    {
        $sertifikat = Sertifikat::destroy($id);
        if($sertifikat){
            return response()->json([
                'success'=> 'Sertifikat berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Sertifikat gagal dihapus'
            ]);
        }
        return response($response);
    }
    
    
    
    // Vaksinasi
    public function createFileVaksinasi(){
        return view('staff/upload-file/create-vaksinasi');
    }

    public function storeFileVaksinasi(Request $request){

        $data = new Vaksinasi();
        $path = 'uploads/Karyawan/'.$request->nik.'/'.'Vaksinasi';
        $files = $request->file('file_vaksinasi');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'Vaksinasi'; // upload path
        $file = "Vaksinasi" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadVaksinasi = $file;
        $data->id_karyawan = $request->nik;
        $data->file_vaksinasi = $uploadVaksinasi;
        $data->created_at = Carbon::now()->toDateTimeString();
        $data->save();

        $update_vaksin = Employee::where('nik', $data->id_karyawan)->first();
        $update_vaksin->status_vaksinasi = 1;
        $update_vaksin->save();

        return redirect('/upload-file')->with('success','File Vaksinasi berhasil diupload');
    }

    public function editFileVaksinasi(){

        $data['vaksinasi'] = Vaksinasi::where('id_karyawan',Auth::user()->username)->first();
        return view('staff/upload-file/edit-vaksinasi')->with($data);
    }

    public function updateFileVaksinasi(Request $request, $id){
    
        $data = Vaksinasi::find($id);

        unlink('uploads/Karyawan/'.$request->nik.'/'.'Vaksinasi'.'/'.$data->file_vaksinasi);
        $files = $request->file('file_vaksinasi');
        $destinationPath = 'uploads/Karyawan/'.$request->nik.'/'.'Vaksinasi'; // upload path
        $file = "Vaksinasi_" . Carbon::now()->timestamp . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $file);
        $uploadVaksinasi = $file;

        $data->file_vaksinasi = $uploadVaksinasi;
        $data->updated_at = Carbon::now()->toDateTimeString();
        $data->save();

        return redirect('/upload-file')->with('success', 'File Vaksinasi berhasil diupdate');
    }

    public function destroyVaksinasi($id)
    {
        $vaksinasi = Vaksinasi::destroy($id);
        if($vaksinasi){
            return response()->json([
                'success'=> 'Vaksinasi berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Vaksinasi gagal dihapus'
            ]);
        }
        return response($response);
    }
}