<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\jabatanDivisi;
use App\divisi;
use App\Jabatan;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class posisiJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jabatan_divisi'] = DB::table('jabatan_divisi')->leftJoin('master_jabatan', function($join){
            $join->on('jabatan_divisi.jabatan_id','=','master_jabatan.id');
        })->leftJoin('master_divisi', function($join){
            $join->on('jabatan_divisi.divisi_id','=','master_divisi.id');
        })->select('jabatan_divisi.*','master_jabatan.jenis_jabatan as jabatan','master_divisi.nama as divisi')
        ->orderBy('created_at','desc')
        ->get();

        return view('admin/posisi-jabatan/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['jabatan'] = Jabatan::all();
        $data['divisi'] = divisi::all();
        return view('admin/posisi-jabatan/create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posisi_jabatan = new jabatanDivisi();
        $posisi_jabatan->jabatan_id = $request->get('jabatan_id');
        $posisi_jabatan->divisi_id = $request->get('divisi_id');
        $posisi_jabatan->created_at = Carbon::now()->toDateTimeString();
        $posisi_jabatan->save();

        return redirect('/posisi-jabatan')->with('success', 'Posisi - Jabatan berhasil ditambahkan');
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
        //
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
