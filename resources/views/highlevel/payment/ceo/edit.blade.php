@extends('templates.header')

@section('content')


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b>Ubah Status Payment</b></h3>
                </div>
                <br>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @if(session()->get('success'))
                                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" name="formdata" method="post" action="{{route('updateapprovalceo-payment', $edit_payment_ceo->id)}}">
                                @method('PATCH') 
                                @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input name="nik" type="text" class="form-control" id="nik" value="{{$edit_payment_ceo->nik}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nik') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Karyawan</label>
                                    <input name="nama" type="text" class="form-control" id="nama" value="{{$edit_payment_ceo->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nama') }} </span>
                                </div>
                                
        
                                <div class="form-group">
                                    <label for="divisi_id">Divisi</label>
                                    <input name="divisi_nama" type="text" class="form-control" id="divisi_nama" value="{{$edit_payment_ceo->divisi_id != 0 ? $edit_payment_ceo->request_divisi->nama : '-'}}" readonly>
                                    <input name="divisi_id" type="hidden" class="form-control" id="divisi_id" value="{{$edit_payment_ceo->divisi_id}}" readonly>
                                    <span class="help-block" >{{ $errors->first('divisi_id') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="jenis_barang">Jenis Pembelian</label>
                                    <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" value="{{$edit_payment_ceo->masterjenisbarang->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('jenis_barang') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="nama_barang">Cost Code</label>
                                    <input name="kode_barang" type="text" class="form-control" id="kode_barang" value="{{$edit_payment_ceo->masterKategori->kode_kategori}}/{{$edit_payment_ceo->masterKategori->nama_kategori}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$edit_payment_ceo->nama_barang}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_proyek">Lokasi Kebutuhan</label>
                                    <input name="nama_proyek" type="text" class="form-control" id="nama_proyek" value="{{$edit_payment_ceo->lokasiProyek->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nama_proyek') }} </span>
                                </div>

                               
                                                       
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="quantity">Jumlah Pembelian (satuan)</label>
                                    <input name="quantity" type="text" class="form-control" id="quantity" value="{{$edit_payment_ceo->quantity}} {{$edit_payment_ceo->quantity_satuan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('quantity') }} </span>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="quantity_satuan">Jenis Satuan</label>
                                    <input name="quantity_satuan" type="text" class="form-control" id="quantity_satuan" value="{{$edit_payment_ceo->quantity_satuan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('quantity_satuan') }} </span>
                                </div> --}}
                                <div class="form-group">
                                    <label for="harga">Harga Satuan</label>
                                    <input name="harga" type="text" class="form-control" id="harga" value="@rupiah($edit_payment_ceo->harga),00" readonly>
                                    <span class="help-block" >{{ $errors->first('harga') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total Pembayaran</label>
                                    <input name="total" type="text" class="form-control" id="total" value="@rupiah($edit_payment_ceo->total),00" readonly>
                                    <span class="help-block" >{{ $errors->first('total') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_pengajuan">Tanggal Request</label>
                                    <input name="tanggal_pengajuan" type="text" class="form-control" id="tanggal_pengajuan" value="{{ date('d-m-Y', strtotime($edit_payment_ceo->tanggal_pengajuan)) }}" readonly>
                                    <span class="help-block" >{{ $errors->first('tanggal_pengajuan') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$edit_payment_ceo->keterangan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('keterangan') }} </span>
                                </div>
        
                                
                                
                                <div class="form-group">
                            <label for="status_paid">Ubah Status</label>
                            <select class="form-control" name="status_paid" id="status_paid" style="width: 100%;">
                                <option {{$edit_payment_ceo->status_paid == 2 ? "selected":""}} value = "2">PROSES</option>
                                <option value = "3">DISETUJUI</option>
                                <option value = "4">DITOLAK</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
	                      <a href="{{url("payment-ceo")}}" class="btn btn-danger">Batal</a>
                       
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <section class="content">
    </section>
    @endsection
