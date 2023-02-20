<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\General;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['general_working_type'] = General::orderBy('created_at', 'desc')->get();
        return view('admin/general/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['general_working_type'] = General::all();
        return view('admin/general/create');
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
            $general= new General();
            $general->nama=$request->get('nama');
            $general->created_at = Carbon::now()->toDateTimeString();
            $general->save();
            return redirect('/general-work')->with('success', 'Data Working Type berhasil ditambahkan');
        }
        catch(\Exception $e){
            return redirect('/general-work')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        //
        $data['general_working_type']= General::find($id);
        
        return view('admin/general/edit')->with($data);
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
            $general = General::find($id);
            $general->nama=$request->get('nama');
            $general->updated_at = Carbon::now()->toDateTimeString();
            $general->save();
            return redirect('/general-work')->with('success', 'Data Working Type berhasil diupdate');
        }
        catch(\Exception $e){
            return redirect('/general-work')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        $general = General::destroy($id);
        if($general){
            return response()->json([
                'success'=> 'Working Type berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Working Type gagal dihapus'
            ]);
        }
        return response($response);
    }
}
