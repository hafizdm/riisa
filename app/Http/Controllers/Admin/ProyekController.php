<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proyek;
use Carbon\Carbon;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["lokasi_project"] = Proyek::all();
        return view('admin/proyek/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["lokasi_project"] = Proyek::all();
        return view('admin/proyek/create');
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
        $proyek = new Proyek();
        $proyek->id = $request->id;
        $proyek->nama = $request->get('nama');
        $proyek->lokasi = $request->get('lokasi');
        $proyek->code_loc = $request->get('code_loc');
        $proyek->created_at = Carbon::now()->toDateTimeString();
        $proyek->save();
        return redirect('/proyek')->with('success', 'Data berhasil ditambahkan');
        }
        catch(\Exception $e){
            return redirect('/proyek')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
    public function edit(proyek $proyek, $id)
    {
        $data['lokasi_project'] = $proyek::find($id);
        return view('admin/proyek/edit')->with($data);
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
            $proyek =  Proyek::find($id);
            $proyek->nama = $request->get('nama');
            $proyek->code_loc = $request->get('code_loc');
            $proyek->lokasi = $request->get('lokasi');
            $proyek->updated_at = Carbon::now()->toDateTimeString();
            $proyek->save();
            return redirect('/proyek')->with('success', 'Data berhasil di Update');
        }
            catch(\Exception $e){
                return redirect('/proyek')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        $proyek = Proyek::destroy($id);
        if($proyek){
            return response()->json([
                'success'=> 'Lokasi Proyek berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Lokasi Proyek gagal dihapus'
            ]);
        }
        return response($response);
    }
}
