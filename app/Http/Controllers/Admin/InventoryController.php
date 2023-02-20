<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\RequestBarang;
use\App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listinventory()
     {
     $data['inventory_barang']= RequestBarang::where('jenis_barang', 1)
    
     -> where('status_pengajuan',3)
     ->where('status_PO', 3)
     ->where('status_paid',5)
     ->where('upload_po','!=','')
     ->where('upload_invoice','!=','')
     ->where('upload_bukti_bayar','!=','')
     ->get();
     return view('/Inventory/asset/index')->with($data);
     }

     public function listnonasset()
     {
     $data['inventory_barang_nonasset']= RequestBarang::where('jenis_barang', 2)
    ->where('status_pengajuan',3)
     ->where('status_PO', 3)
     ->where('status_paid',5)
     ->where('upload_po','!=','')
     ->where('upload_invoice','!=','')
     ->where('upload_bukti_bayar','!=','')
     ->get();
     return view('/Inventory/NonAsset/index')->with($data);
     }

     public function listjasa()
     {
     $data['inventory_barang_jasa']= RequestBarang::where('jenis_barang', 3)
    ->where('status_pengajuan',3)
     ->where('status_po', 3)
     ->where('status_paid',5)
     ->where('upload_po','!=','')
     ->where('upload_invoice','!=','')
     ->where('upload_bukti_bayar','!=','')
     ->get();
     return view('/Inventory/jasa/index')->with($data);
     }
    public function index()
    {
        //
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
        //
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
}
