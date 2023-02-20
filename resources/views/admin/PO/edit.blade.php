@extends('templates.header')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b>Upload File PO, TBE, CBE</b></h3>
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
                        <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{route('updateBuktiPO', $request_barang->id)}}" >
                            @method('PATCH') 
                            @csrf 
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama Karyawan</label>
                                    <input name="nama" type="text" class="form-control" id="nama" value="{{$request_barang->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nama') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input name="nik" type="text" class="form-control" id="nik" value="{{$request_barang->nik}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nik') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="divisi_id">Divisi</label>
                                    <input name="divisi_nama" type="text" class="form-control" id="divisi_nama" value="{{$request_barang->divisi_id != 0 ? $request_barang->request_divisi->nama : '-'}}" readonly>
                                    <input name="divisi_id" type="hidden" class="form-control" id="divisi_id" value="{{$request_barang->divisi_id}}" readonly>
                                    <span class="help-block" >{{ $errors->first('divisi_id') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="jenis_barang">Jenis Pembelian</label>
                                    <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" value="{{$request_barang->masterjenisbarang->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('jenis_barang') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="nama_barang">Cost Code</label>
                                    <input name="kode_barang" type="text" class="form-control" id="kode_barang" value="{{$request_barang->masterKategori->kode_kategori}}/{{$request_barang->masterKategori->nama_kategori}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$request_barang->nama_barang}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_proyek">Lokasi Kebutuhan</label>
                                    <input name="nama_proyek" type="text" class="form-control" id="nama_proyek" value="{{$request_barang->nama_proyek}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nama_proyek') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Jumlah Pembelian (satuan)</label>
                                    <input name="quantity" type="text" class="form-control" id="quantity" value="{{$request_barang->quantity}} {{$request_barang->quantity_satuan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('quantity') }} </span>
                                </div>                  
                            </div>
                            <div class="col-lg-5">
                                
                                {{-- <div class="form-group">
                                    <label for="quantity_satuan">Jenis Satuan</label>
                                    <input name="quantity_satuan" type="text" class="form-control" id="quantity_satuan" value="{{$request_barang->quantity_satuan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('quantity_satuan') }} </span>
                                </div> --}}
                                <div class="form-group">
                                    <label for="harga">Estimasi Harga Satuan</label>
                                    <input name="harga" type="text" class="form-control" id="harga" value="@rupiah($request_barang->harga),00" readonly>
                                    <span class="help-block" >{{ $errors->first('harga') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="total">Estimasi Total Pembayaran</label>
                                    <input name="total" type="text" class="form-control" id="total" value="@rupiah($request_barang->total),00" readonly>
                                    <span class="help-block" >{{ $errors->first('total') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_pengajuan">Tanggal Request</label>
                                    <input name="tanggal_pengajuan" type="text" class="form-control" id="tanggal_pengajuan" value="{{ date('d-m-Y', strtotime($request_barang->tanggal_pengajuan)) }}" readonly>
                                    <span class="help-block" >{{ $errors->first('tanggal_pengajuan') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$request_barang->keterangan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('keterangan') }} </span>
                                </div>
        
                                 <div class="form-group">
                                    <label for="upload_tba">Upload TBE </label>
                                    <input type="file" name="upload_tba" id="upload_tba" class="form-control" required>
                                    <div class="invalid-feedback">
                                    {{ $errors->first('upload_tba') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="upload_cba">Upload CBE</label>
                                    <input type="file" name="upload_cba" id="upload_cba" class="form-control" required>
                                    <div class="invalid-feedback">
                                    {{ $errors->first('upload_cba') }}
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="upload_po">Upload Bukti PO</label>
                                    <input type="file" name="upload_po" id="upload_po" class="form-control" required>
                                    <div class="invalid-feedback">
                                    {{ $errors->first('upload_po') }}
                                    </div>
                                </div>
                               
                              
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{url("listPO")}}" class="btn btn-danger">Batal</a>
                        </div>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    @endsection

