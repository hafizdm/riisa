<?php

namespace App\Http\Controllers\HRD\Psikotes\DISC;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StatementDISC;
use App\KategoriDISC;
use Carbon\Carbon;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category']   = KategoriDISC::all();
        $data['statement']  = StatementDISC::groupBy('id', 'id_soal')->orderBy('created_at', 'desc')->get();
        return view('hrd/psikotes/DISC/masterdata/statement/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $data                   = new StatementDISC();
            $data->pernyataan      = $request->pernyataan1;
            $data->kategori_plus   = $request->kategori_plus1;
            $data->kategori_minus  = $request->kategori_minus1;
            $data->id_soal          = $request->id_soal;
            $data->created_at       = Carbon::now()->toDateTimeString();
            $data->save();

            $data                   = new StatementDISC();
            $data->pernyataan       = $request->pernyataan2;
            $data->kategori_plus    = $request->kategori_plus2;
            $data->kategori_minus   = $request->kategori_minus2;
            $data->id_soal          = $request->id_soal;
            $data->created_at       = Carbon::now()->toDateTimeString();
            $data->save();

            $data                   = new StatementDISC();
            $data->pernyataan       = $request->pernyataan3;
            $data->kategori_plus    = $request->kategori_plus3;
            $data->kategori_minus   = $request->kategori_minus3;
            $data->id_soal          = $request->id_soal;
            $data->created_at       = Carbon::now()->toDateTimeString();
            $data->save();

            $data                   = new StatementDISC();
            $data->pernyataan       = $request->pernyataan4;
            $data->kategori_plus    = $request->kategori_plus4;
            $data->kategori_minus   = $request->kategori_minus4;
            $data->id_soal          = $request->id_soal;
            $data->created_at       = Carbon::now()->toDateTimeString();
            $data->save();

            return redirect('/statement-disc')->with('success', 'Data successfully added');
        }
        catch(\Exception $e){
            return redirect('/statement-disc')->with('failed', 'Please check your data again');
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
        $statement =  StatementDISC::find($id);
        return response()->json([
            'data' => $statement
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
            $pernyataan         = $request->get('edit_pernyataan');
            $kategori_plus      = $request->get('edit_id_kategoriA');
            $kategori_minus     = $request->get('edit_id_kategoriB');
            $id_soal            = $request->get('edit_id_soal');

            StatementDISC::updateOrCreate(
                [
                    'id' => $id
                ], 
                [
                    'pernyataan'        => $pernyataan, 
                    'kategori_plus'     => $kategori_plus,
                    'kategori_minus'    => $kategori_minus, 
                    'id_soal'           => $id_soal,
                    'updated_at'        => Carbon::now()->toDateTimeString() 
                ],
            ); 

            return response()->json(['success' => true]);
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
        $data = StatementDISC::destroy($id);
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
