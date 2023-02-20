<?php

namespace App\Http\Controllers\SPD;
use \PDF;
use App\SPD;
use \App\User;
use \App\Employee;
use App\SpdApproval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['spd'] = SPD::where('nik', Auth::user()->username)->orderBy('created_at', 'desc')->get();
        return view('spd/index')->with($data);
    }
    public function pdf()
    {
        $data['spd'] = SPD::all();
        return view('spd/pdf')->with($data);
    }

    public function downloadpdf($id) {
        $data = SPD::find($id);
        $pdf = PDF::loadview('spd/downloadpdf', compact('data'))->setPaper('a4','potrait');
        $fileName = $data->form_date;
        return $pdf->stream("Surat Perjalanan Dinas"." ".$fileName. '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['karyawan'] = Employee::where('nik','=', Auth::user()->username)->first();
        return view('spd/create')->with($data);
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
            $spd = new SPD();
            $spd->nama = $request->get('nama');
            $spd->no_surat = "";
            $spd->nik = $request->get('nik');
            $spd->divisi_id = $request->get('divisi_id');
            $spd->asal = $request->get('asal');
            $spd->tujuan = $request->get('tujuan');
            $spd->travel_type = $request->get('travel_type');
            $spd->tgl_keberangkatan = $request->get('tgl_keberangkatan');
            $spd->tgl_pulang = $request->get('tgl_pulang');
            $spd->form_date = $request->get('form_date');
            $spd->assignment_type = $request->get('assignment_type');
            $spd->purpose = $request->get('purpose');
            $spd->travel_by = $request->get('travel_by');
            $spd->advance_payment = $request->get('advance_payment');
            $spd->idr = $request->get('idr');
            $spd->sign_received = $request->get('sign_received');
            $spd->note = $request->get('note');
            if ($spd->travel_type == 'Domestic') {
                $spd->eat_per_day = auth()->user()->user_login->jabatan->eat_per_day_domestic;
                $spd->allowance = auth()->user()->user_login->jabatan->allowance_per_day_domestic;
            } else if ($spd->travel_type == 'International') {
                $spd->eat_per_day = auth()->user()->user_login->jabatan->eat_per_day_international;
                $spd->allowance = auth()->user()->user_login->jabatan->allowance_per_day_international;
            }
            $spd->save();

            $spdApproval = new SpdApproval();
            $spdApproval->spd_id = $spd->id;
            $spdApproval->karyawan_id = auth()->user()->user_login->spd_report_to;
            $spdApproval->status = 0; // request approval
            $spdApproval->save();

            $ids = $spd->id;
            SPD::where('id', $ids)->update(
                [
                    'no_surat'=>"SPD-00".$ids
                ]
            );
            return redirect('pengajuan-spd')->with('success', 'Data berhasil ditambahkan');
        }
        catch(\Exception $e){
           return redirect('pengajuan-spd')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        $data['spd'] = SPD::find($id);
        return view('spd/edit')->with($data);
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
            $spd =  SPD::find($id);
            $spd->form_date = $request->get('form_date');
            $spd->nama = $request->get('nama');
            $spd->nik = $request->get('nik');
            $spd->divisi_id = $request->get('divisi_id');
            $spd->asal = $request->get('asal');
            $spd->tujuan = $request->get('tujuan');
            $spd->travel_type = $request->get('travel_type');
            $spd->tgl_keberangkatan = $request->get('tgl_keberangkatan');
            $spd->tgl_pulang = $request->get('tgl_pulang');
            $spd->form_date = $request->get('form_date');
            $spd->assignment_type = $request->get('assignment_type');
            $spd->purpose = $request->get('purpose');
            $spd->travel_by = $request->get('travel_by');
            $spd->advance_payment = $request->get('advance_payment');
            $spd->idr = $request->get('idr');
            $spd->sign_received = $request->get('sign_received');
            $spd->note = $request->get('note');
            if ($spd->travel_type == 'Domestic') {
                $spd->eat_per_day = auth()->user()->user_login->jabatan->eat_per_day_domestic;
                $spd->allowance = auth()->user()->user_login->jabatan->allowance_per_day_domestic;
            } else if ($spd->travel_type == 'International') {
                $spd->eat_per_day = auth()->user()->user_login->jabatan->eat_per_day_international;
                $spd->allowance = auth()->user()->user_login->jabatan->allowance_per_day_international;
            }
            $spd->save();

            return redirect('/pengajuan-spd')->with('success', 'Data  berhasil di Update');
        }
        catch(\Exception $e){
            return redirect('pengajauan-spd')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
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
        $spd = SPD::destroy($id);
        if($spd){
            return response()->json([
                'success'=> 'SPD berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'SPD gagal dihapus'
            ]);
        }
        return response($response);
    }

    public function indexRequest()
    {
        // dd(Auth::user()->user_login->id);
        $data['spd'] = SPD::whereHas('employee', function ($query) {
            return $query->where('karyawan.spd_report_to', Auth::user()->user_login->id);
        })->get();

        // dd($data);

        return view('spdrequest.index')->with($data);
    }

    public function indexReport()
    {
        return view('spdreport.index');
    }

    public function addReport()
    {
        return view('spdreport.addreport');
    }

    public function spdApproved($id)
    {
        
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->status = 1; // status approved
        $spdApproval->save();
    }

    public function spdRejected($id)
    {
        $spd = SPD::find($id);
        $spdApproval = $spd->spdApproval;

        $spdApproval->status = 2; // status Rejected
        $spdApproval->save();
    }

}
