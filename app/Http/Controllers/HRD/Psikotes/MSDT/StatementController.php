<?php

namespace App\Http\Controllers\HRD\Psikotes\MSDT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StatementMSDT;
use App\KategoriMSDT;
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
        $data['category'] = KategoriMSDT::all();
        $data['statement'] = StatementMSDT::orderBy('created_at', 'desc')->get();
        return view('hrd/psikotes/MSDT/masterdata/statement/index')->with($data);
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
            $data                    = new StatementMSDT();
            $data->id_kategoriA      = $request->id_kategoriA;
            $data->pernyataanA       = $request->pernyataanA;
            $data->id_kategoriB      = $request->id_kategoriB;
            $data->pernyataanB       = $request->pernyataanB;
            $data->id_soal           = $request->id_soal;
            $data->created_at        = Carbon::now()->toDateTimeString();
            $data->save();

            return redirect('/statement-msdt')->with('success', 'Data successfully added');
        }
        catch(\Exception $e){
            return redirect('/statement-msdt')->with('failed', 'Please check your data again');
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
        $statement =  StatementMSDT::find($id);
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
            $id_kategoriA       = $request->get('edit_id_kategoriA');
            $statementA         = $request->get('edit_pernyataanA');
            $id_kategoriB       = $request->get('edit_id_kategoriB');
            $statementB         = $request->get('edit_pernyataanB');
            $id_soal            = $request->get('edit_id_soal');

            StatementMSDT::updateOrCreate(
                [
                    'id' => $id
                ], 
                [
                    'id_kategoriA'   => $id_kategoriA, 
                    'pernyataanA'    => $statementA,
                    'id_kategoriB'   => $id_kategoriB, 
                    'pernyataanB'    => $statementB,
                    'id_soal'       => $id_soal,
                    'updated_at'    => Carbon::now()->toDateTimeString() 
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
        $data = StatementMSDT::destroy($id);
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
