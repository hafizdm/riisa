<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\divisi;
use Carbon\Carbon;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data["divisi"] = divisi::orderBy('created_at','desc')->get();
        return view('admin/divisi/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["divisi"] = divisi::all();
        return view('admin/divisi/create', $data);
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
        $divisi = new divisi();
        $divisi->nama = $request->get('nama');
        $divisi->keterangan=$request->get('keterangan');
        $divisi->created_at = Carbon::now()->toDateTimeString();
        $divisi->save();
         return redirect('/divisi')->with('success', 'Data berhasil ditambahkan');
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
    public function edit(divisi $divisi,$id)
    {
        //
        $data['divisi']= $divisi::find($id);
        return view('admin/divisi/edit')->with($data);
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
        $divisi = divisi::find($id);
        $divisi->nama=$request->get('nama');
        $divisi->keterangan=$request->get('keterangan');
        $divisi->updated_at = Carbon::now()->toDateTimeString();
        $divisi->save();
        // return $divisi;

         return redirect('/divisi')->with('success', 'Data berhasil diupdate');
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
        $divisi = divisi::destroy($id);
        if($divisi){
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
