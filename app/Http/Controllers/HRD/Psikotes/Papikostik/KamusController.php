<?php

namespace App\Http\Controllers\HRD\Psikotes\Papikostik;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KategoriPapikostik;
use App\KamusPapikostik;
use Carbon\Carbon;

class KamusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category']   = KategoriPapikostik::all();
        $data['kamus']      = KamusPapikostik::orderBy('updated_at', 'desc')->get();
        return view('hrd/psikotes/Papikostik/masterdata/kamus/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrd/psikotes/Papikostik/masterdata/kamus/create');
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
            $data                   = new KamusPapikostik();
            $data->id_kategori      = $request->id_kategori;
            $data->nilai            = $request->nilai;
            $data->keterangan       = $request->keterangan;
            $data->created_at       = Carbon::now()->toDateTimeString();
            $data->save();

            return redirect('/kamus-papikostik')->with('success', 'Data successfully added');
        }
        catch(\Exception $e){
            return redirect('/kamus-papikostik')->with('failed', 'Please check your data again');
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
        $kamus = KamusPapikostik::find($id);
        return response()->json([
            'data' => $kamus
          ]);
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
            $id_kategori    = $request->get('edit_id_kategori');
            $nilai          = $request->get('edit_nilai');
            $keterangan     = $request->get('edit_keterangan');

            KamusPapikostik::updateOrCreate(
                [
                    'id' => $id
                ], 
                [
                    'id_kategori'   => $id_kategori, 
                    'nilai'         => $nilai,
                    'keterangan'    => $keterangan,
                    'updated_at'    => Carbon::now()->toDateTimeString() 
                ],
            ); 
            return response()->json(['success' => true ]);
        }
        catch(\Exception $e){
            return response()->json(['failed' => true]);
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
        $data = KamusPapikostik::destroy($id);
        if($data){
            return response()->json([
                'success'=> 'Data successfully deleted'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Data failed deleted'
            ]);
        }
        return response($response);
    }
}
