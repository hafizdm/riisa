<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Validator;

class resetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $data['reset'] = User::find($id);
        return view('karyawan/resetpassword')->with($data);
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
        $request->validate([
            'password' => 'required|
                            min:6|
                            max:8|'
                            
        ]);

        $data =  User::findOrNew($id);
        if(Hash::check($request->input('password'), $data->password)){
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();
            return back()->with('success', 'Kata Sandi anda sama seperti sebelumnya');
        }
        else{
            $data->password = Hash::make($request->get('password'));
            $data->updated_at = Carbon::now()->toDateTimeString();
            $data->save();
            return back()->with('success', 'Kata Sandi berhasil diubah');
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
    }
}
