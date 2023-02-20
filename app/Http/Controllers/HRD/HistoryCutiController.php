<?php

namespace App\Http\Controllers\HRD;
use App\Http\Controllers\Controller;
use App\CutiKaryawan;
use DB;
use Illuminate\Http\Request;
use App\Employee;

class HistoryCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['cuti_karyawan'] = CutiKaryawan::all();
        return view('hrd/cutikaryawan/index')->with($data);
    }

    public function updateApprovalCuti(Request $request){

        $datas = CutiKaryawan::where('id', $request->ids)->first();
        $datas->status = $request->values;
        $datas->save();

        return response()->json($datas);
    }

    public function approveCuti(Request $request)
    {

        $img = $request->signed;
        $folderPath = public_path('uploads');
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $signature = uniqid() . '.'.$image_type;
        $file = $folderPath . $signature;
        file_put_contents($file, $image_base64);
 
        $dt = CutiKaryawan::where('id', $request->ids)->first();
        $dt->status = $request->status;
        $dt->signatureHRD = $signature;
        $dt->save();

        return redirect('histori-cuti');
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
        //
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
        $data['cuti'] = CutiKaryawan::find($id);
        return view('hrd/cutikaryawan/edit')->with($data);
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

    public function indexReset(){
        $dt = Employee::pluck('id');
        return view('hrd/resetcuti/index', compact('dt'));
    }

    public function resetAll(Request $request){
        $getdatas = Employee::whereIn('id', $request->id)->get();

        foreach($getdatas as $data) {
            $dt = Employee::findOrNew($data->id);
            $dt->sisa_cuti = 12;
            $dt->save();
        }
        
        if ($dt) {
            return response()->json([
                'status' => true,
                'message' => 'Data reset successfully'
            ]);
        }
    }
}
