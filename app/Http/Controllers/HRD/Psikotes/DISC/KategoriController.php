<?php

namespace App\Http\Controllers\HRD\Psikotes\DISC;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KategoriDISC;
use Carbon\Carbon;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category'] = KategoriDISC::all();
        return view('hrd/psikotes/DISC/masterdata/kategori/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrd/psikotes/DISC/masterdata/kategori/create');
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
            $data                   = new KategoriDISC();
            $data->nama_kategori    = $request->nama_kategori;
            $data->created_at       = Carbon::now()->toDateTimeString();
            $data->save();

            return redirect('/kategori-disc')->with('success', 'Data successfully added');
        }
        catch(\Exception $e){
            return redirect('/kategori-disc')->with('failed', 'Please check your data again');
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
        $category = KategoriDISC::find($id);
        return response()->json([
            'data' => $category
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
            $category = $request->get('edit_nama_kategori');
            $ids = $request->get('id');

            KategoriDISC::updateOrCreate(
                [
                    'id' => $ids
                ], 
                [
                    'nama_kategori' => $category, 
                    'updated_at' => Carbon::now()->toDateTimeString() 
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
        $data = KategoriDISC::destroy($id);
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
