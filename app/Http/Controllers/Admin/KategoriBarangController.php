<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KategoriBarang;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori['kategori'] = KategoriBarang::orderBy('created_at','desc')->get();
        return view('admin/kategori_barang/index')->with($kategori);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        $data['kategori'] = KategoriBarang::all();
        return view('admin/kategori_barang/create');
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
        
        $kategori = new KategoriBarang();
        $kategori->id = $request->id;
        $kategori->nama_kategori=$request->get('nama_kategori');
        $kategori->kode_kategori=$request->get('kode_kategori');
        $kategori->created_at = Carbon::now()->toDateTimeString();
        $kategori->save();
        return redirect('/kategoribarang')->with('success', 'Data Cost Code berhasil ditambahkan');
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
    public function edit(kategoribarang $kategori_barang,$id)
    {
        //
        $data['kategoribarang'] = $kategori_barang::find($id);
        return view('admin/kategori_barang/edit')->with($data);
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
        $kategori =  KategoriBarang::find($id);
        // $kategori->id = $request->get('id');
        $kategori->nama_kategori=$request->get('nama_kategori');
        $kategori->kode_kategori=$request->get('kode_kategori');
        $kategori->updated_at = Carbon::now()->toDateTimeString();
        $kategori->save();
        return redirect('/kategoribarang')->with('success', 'Data Cost Code berhasil di Update');
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
        $kategori = KategoriBarang::destroy($id);
        if($kategori){
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
