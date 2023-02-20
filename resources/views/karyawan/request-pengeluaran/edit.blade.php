@extends('templates.header')

@section('content')
<style>
    .form-control[readonly]{
        background-color: #ffffff !important;
    }
</style>
<section class="content"> 

<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Form Pengajuan Pengeluaran Barang</b></h3>
            </div>
            <br>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-lg-12">
                    <form role="form" name="formdata" method="post" action="{{route('updaterequest-barang-keluar', $request_brg_keluar->id)}}">
                        @method('PATCH') 
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-xl-6 col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_barang">Jenis Pembelian</label>
                                    <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" value="{{$request_brg_keluar->masterjenisbarang->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('jenis_barang') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="nama_barang">Cost Code</label>
                                    <input name="kode_barang" type="text" class="form-control" id="kode_barang" value="{{$request_brg_keluar->masterKategori->kode_kategori}} / {{$request_brg_keluar->masterKategori->nama_kategori}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$request_brg_keluar->nama_barang}}" readonly>
                                </div>
        
                                <div class="form-group">
                                    <label for="nama_proyek">Lokasi Kebutuhan</label>
                                    <input name="nama_proyek" type="text" class="form-control" id="nama_proyek" value="{{$request_brg_keluar->lokasiProyek->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nama_proyek') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="quantity">Jumlah Pembelian (satuan)</label>
                                    <input type="text" class="form-control" value="{{$request_brg_keluar->quantity}} {{$request_brg_keluar->quantity_satuan}}" readonly>
                                    <input name="quantity" type="hidden" class="form-control" id="quantity" value="{{$request_brg_keluar->quantity}}">
                                    <input name="quantity_satuan" type="hidden" class="form-control" id="quantity_satuan" value="{{$request_brg_keluar->quantity_satuan}}">
                                    {{-- <span class="help-block" >{{ $errors->first('quantity') }} </span> --}}
                                </div>
                                
                            </div>
                            <div class="col-xs-12 col-xl-6 col-lg-6">
                                
                                <div class="form-group">
                                    <label for="harga">Harga Satuan</label>
                                    <input name="harga" type="text" class="form-control" id="harga" value="@rupiah($request_brg_keluar->harga),00" readonly>
                                    <span class="help-block" >{{ $errors->first('harga') }} </span>
                                </div>
                                                       
                                <div class="form-group">
                                    <label for="total">Total Pembayaran</label>
                                    <input name="total" type="text" class="form-control" id="total" value="@rupiah($request_brg_keluar->total),00" readonly>
                                    <span class="help-block" >{{ $errors->first('total') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="status">Status Pengajuan Pembelian</label>
                                    <input type="text" class="form-control"  value="{{$request_brg_keluar->status_paid == 5 ? "DISETUJUI": ""}}" readonly>
                                    <span class="help-block" >{{ $errors->first('status') }} </span>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="quantity_satuan">Jenis Satuan</label>
                                    <input name="quantity_satuan" type="text" class="form-control" id="quantity_satuan" value="{{$request_brg_keluar->quantity_satuan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('quantity_satuan') }} </span>
                                </div> --}}
        
                                <div class="form-group">
                                    <label for="status_brg_keluar">Ajukan Pengeluaran</label>
                                    <select class="form-control" name="status_brg_keluar" id="status_brg_keluar" style="width: 100%;">
                                        <option selected disabled>-- Pilih Opsi --</option>
                                        <option value = "1">AJUKAN</option>
                                        {{-- <option value = "">BATAL</option> --}}
                                    </select>
                                </div>
                   
                        
                        
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                    <a href="{{url("request-barang-keluar")}}" class="btn btn-danger">Batal</a>
                        
                </div>
        </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      </section>
     
    @endsection


