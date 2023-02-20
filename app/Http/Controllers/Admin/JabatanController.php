<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Jabatan;
use App\divisi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data["jabatan"] = jabatan::orderBy('created_at','desc')->get();
        return view('admin/jabatan/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["jabatan"] = Jabatan::all();
        $data['divisi'] = divisi::all();
        return view('admin/jabatan/create', $data);
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
        $jabatan = new Jabatan();
        $jabatan->jenis_jabatan = $request->get('jenis_jabatan');
        $jabatan->keterangan=$request->get('jenis_jabatan');
        $jabatan->divisi_id=$request->get('divisi_id');
        $jabatan->eat_per_day_domestic=$request->get('eat_per_day_domestic');
        $jabatan->eat_per_day_international=$request->get('eat_per_day_international');
        $jabatan->allowance_per_day_domestic=$request->get('allowance_per_day_domestic');
        $jabatan->allowance_per_day_international=$request->get('allowance_per_day_international');
        $jabatan->created_at = Carbon::now()->toDateTimeString();
        $jabatan->save();
         return redirect('/jabatan')->with('success', 'Data berhasil ditambahkan');
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
    public function edit(jabatan $jabatan,$id)
    {

        $data['jabatan']= $jabatan::find($id);
        $data['divisi'] = divisi::all();
        return view('admin/jabatan/edit')->with($data);
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
        $jabatan = Jabatan::find($id);
        $jabatan->jenis_jabatan=$request->get('jenis_jabatan');
        // $jabatan->keterangan=$request->get('keterangan');
        $jabatan->divisi_id=$request->get('divisi_id');
        $jabatan->eat_per_day_domestic=$request->get('eat_per_day_domestic');
        $jabatan->eat_per_day_international=$request->get('eat_per_day_international');
        $jabatan->allowance_per_day_domestic=$request->get('allowance_per_day_domestic');
        $jabatan->allowance_per_day_international=$request->get('allowance_per_day_international');
        $jabatan->updated_at = Carbon::now()->toDateTimeString();
        $jabatan->save();
        // return $jabatan;

         return redirect('/jabatan')->with('success', 'Data berhasil diupdate');
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
        $jabatan = Jabatan::destroy($id);
        if($jabatan){
            return response()->json([
                'success'=> 'Barang berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Barang gagal dihapus'
            ]);
        }
        return response($response);
    }
}
