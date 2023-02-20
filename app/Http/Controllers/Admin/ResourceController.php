<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Resource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['resource'] = Resource::orderBy('created_at', 'desc')->get();
       return view('admin/resource/index')->with($data);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['resource'] = Resource::all();
        return view('admin/resource/create', $data);
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
        try{
            $resource = new Resource();
            $resource->nama_posisi = $request->get('nama');
            $resource->created_at = Carbon::now()->toDateTimeString();
            $resource->save();
            return redirect('/resource')->with('success', 'Data Resource berhasil ditambahkan');
        }
        catch(\Exception $e){
            return redirect('/resource')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        $data['resource']= Resource::find($id);
        return view('admin/resource/edit')->with($data);
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
            $resource = Resource::find($id);
            $resource->nama_posisi = $request->get('nama');
            $resource->updated_at = Carbon::now()->toDateTimeString();
            $resource->save();
            return redirect('/resource')->with('success', 'Data Resource berhasil diupdate');
        }
        catch(\Exception $e){
            return redirect('/resource')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        $resource = Resource::destroy($id);
        if($resource){
            return response()->json([
                'success'=> 'Resource berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Resource gagal dihapus'
            ]);
        }
        return response($response);
    }
}
