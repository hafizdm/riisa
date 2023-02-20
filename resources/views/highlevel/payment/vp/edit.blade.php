@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Ubah Status Approval Payment
      {{--  <small>it all starts here</small>  --}}
    </h1>
  </section>
      <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                <form role="form" name="formdata" method="post" action="{{route('updateapprovalvp-payment', $edit_payment_vp->id)}}">
                @method('PATCH') 
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama">Nama Karyawan</label>
                            <input name="nama" type="text" class="form-control" id="nama" value="{{$edit_payment_vp->nama}}" readonly>
                            <span class="help-block" >{{ $errors->first('nama') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input name="nik" type="text" class="form-control" id="nik" value="{{$edit_payment_vp->nik}}" readonly>
                            <span class="help-block" >{{ $errors->first('nik') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="divisi_id">Divisi</label>
                            <input name="divisi_nama" type="text" class="form-control" id="divisi_nama" value="{{$edit_payment_vp->request_divisi->nama}}" readonly>
                            <input name="divisi_id" type="hidden" class="form-control" id="divisi_id" value="{{$edit_payment_vp->request_divisi->id}}" readonly>
                            <span class="help-block" >{{ $errors->first('divisi_id') }} </span>
                        </div>

                        {{-- <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input name="kode_barang" type="text" class="form-control" id="kode_barang" value="{{$approval->kode_barang}}" readonly>
                            <span class="help-block" >{{ $errors->first('kode_barang') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$approval->nama_barang}}" readonly>
                            <span class="help-block" >{{ $errors->first('nama_barang') }} </span>
                        </div> --}}

                        <div class="form-group">
                            <label for="nama_barang">Kode - Nama Barang</label>
                            <input  type="text" class="form-control" value="{{$edit_payment_vp->kode_barang}} - {{$edit_payment_vp->nama_barang}}" readonly>
                            <input name="kode_barang" type="hidden" class="form-control" id="kode_barang" value="{{$edit_payment_vp->kode_barang}}">
                            <input name="nama_barang" type="hidden" class="form-control" id="nama_barang" value="{{$edit_payment_vp->nama_barang}}">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input name="quantity" type="text" class="form-control" id="quantity" value="{{$edit_payment_vp->quantity}}" readonly>
                            <span class="help-block" >{{ $errors->first('quantity') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input name="harga" type="text" class="form-control" id="harga" value="{{$edit_payment_vp->harga}}" readonly>
                            <span class="help-block" >{{ $errors->first('harga') }} </span>
                        </div>
                                               
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input name="total" type="text" class="form-control" id="total" value="{{$edit_payment_vp->total}}" readonly>
                            <span class="help-block" >{{ $errors->first('total') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="quantity_satuan">Jenis Satuan</label>
                            <input name="quantity_satuan" type="text" class="form-control" id="quantity_satuan" value="{{$edit_payment_vp->quantity_satuan}}" readonly>
                            <span class="help-block" >{{ $errors->first('quantity_satuan') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="nama_proyek">Lokasi Kebutuhan</label>
                            <input name="nama_proyek" type="text" class="form-control" id="nama_proyek" value="{{$edit_payment_vp->nama_proyek}}" readonly>
                            <span class="help-block" >{{ $errors->first('nama_proyek') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                            <input name="tanggal_pengajuan" type="text" class="form-control" id="tanggal_pengajuan" value="{{$edit_payment_vp->tanggal_pengajuan}}" readonly>
                            <span class="help-block" >{{ $errors->first('tanggal_pengajuan') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$edit_payment_vp->keterangan}}" readonly>
                            <input name="updated_at" type="hidden" class="form-control" id="updated_at" value="{{Carbon\Carbon::now()->toDateTimeString()}}">
                            <span class="help-block" >{{ $errors->first('keterangan') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="status_paid">Ubah Status</label>
                            <select class="form-control" name="status_paid" id="status_paid" style="width: 100%;">
                                <option {{$edit_payment_vp->status_paid == 2 ? "selected":""}} value = "2">PROSES</option>
                                <option value = "3">DISETUJUI</option>
                                <option value = "6">DITOLAK</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Data</button>
	                      <a href="{{url("payment-vp")}}" class="btn btn-danger">Cancel</a>
                </div>
                </div>
                </form>
                </div>
            </div>
    </div>  
    <!-- Main content -->
    <section class="content">
     
    @endsection

   
