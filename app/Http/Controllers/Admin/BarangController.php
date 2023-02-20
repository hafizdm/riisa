<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Barang;
use \App\KategoriBarang;
use App\JenisBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["barang"] = Barang::orderBy('created_at','desc')->get();
        return view('admin/barang/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['jb'] = JenisBarang::all();
        $data['kb'] = KategoriBarang::all();
        return view('admin/barang/create', $data);
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
        $barang = new Barang();
        $barang->kode_barang = $request->get('kode_barang');
        $barang->nama_barang=$request->get('nama_barang');
        $barang->jenis_barang=$request->get('jenis_barang');
        $barang->created_at = Carbon::now()->toDateTimeString();
        $barang->save();
        return redirect('/barang')->with('success', 'Data Barang berhasil ditambahkan');
        // $data = Barang::where('id_barang','=',30)->get();
        //  return $barang;
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
    public function edit(barang $barang ,$id_barang)
    {
        $data['barang']= $barang::find($id_barang);
        $data['kb'] = KategoriBarang::all();
        $data['jb'] = JenisBarang::all();
        return view('admin/barang/edit')->with($data);

        
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_barang)
    {
        //
        $barang = Barang::find($id_barang);
        $barang->kode_barang=$request->get('kode_barang');
        $barang->jenis_barang=$request->get('jenis_barang');
        $barang->nama_barang=$request->get('nama_barang');
        $barang->updated_at = Carbon::now()->toDateTimeString();
        $barang->save();
        // return $barang;

         return redirect('/barang')->with('success', 'Data Barang berhasil diupdate');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        
        $barang = Barang::destroy($id_barang);
        if($barang){
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
