@extends('templates.header')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b>Form Persetujuan Request</b></h3>
                </div>
                <br>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" name="formdata" id="formdata" method="post" action="{{route('updateapprovalvp', $approval->id)}}">
                                @method('PATCH') 
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input name="nik" type="text" class="form-control" id="nik" value="{{$approval->nik}}" readonly>
                                            <span class="help-block" >{{ $errors->first('nik') }} </span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="nama">Nama Karyawan</label>
                                            <input name="nama" type="text" class="form-control" id="nama" value="{{$approval->nama}}" readonly>
                                            <span class="help-block" >{{ $errors->first('nama') }} </span>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="divisi_id">Divisi</label>
                                            <input name="divisi_nama" type="text" class="form-control" id="divisi_nama" value="{{$approval->request_divisi->nama}}" readonly>
                                            <input name="divisi_id" type="hidden" class="form-control" id="divisi_id" value="{{$approval->divisi_id}}">
                                            <span class="help-block" >{{ $errors->first('nik') }} </span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="jenis_barang">Jenis Pembelian</label>
                                            <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" value="{{$approval->masterjenisbarang->nama}}" readonly>
                                            <span class="help-block" >{{ $errors->first('jenis_barang') }} </span>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="nama_barang">Cost Code</label>
                                            <input name="kode_barang" type="text" class="form-control" id="kode_barang" value="{{$approval->masterKategori->kode_kategori}}/{{$approval->masterKategori->nama_kategori}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$approval->nama_barang}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_proyek">Lokasi Kebutuhan</label>
                                            <input name="nama_proyek" type="text" class="form-control" id="nama_proyek" value="{{$approval->lokasiProyek->nama}}" readonly>
                                            <span class="help-block" >{{ $errors->first('nama_proyek') }} </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="quantity">Jumlah Pembelian (satuan)</label>
                                            <input name="quantity" type="text" class="form-control" id="quantity" value="{{$approval->quantity}} {{$approval->quantity_satuan}}" readonly>
                                            <span class="help-block" >{{ $errors->first('quantity') }} </span>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="quantity_satuan">Jenis Satuan</label>
                                            <input name="quantity_satuan" type="text" class="form-control" id="quantity_satuan" value="{{$approval->quantity_satuan}}" readonly>
                                            <span class="help-block" >{{ $errors->first('quantity_satuan') }} </span>
                                        </div> --}}
                
                                        <div class="form-group">
                                            <label for="harga">Estimasi Harga Satuan</label>
                                            <input name="harga" type="text" class="form-control" id="harga" value="@rupiah($approval->harga),00" readonly>
                                            <span class="help-block" >{{ $errors->first('harga') }} </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Estimasi Total Pembayaran</label>
                                            <input name="total" type="text" class="form-control" id="total" value="@rupiah($approval->total),00" readonly>
                                            <span class="help-block" >{{ $errors->first('total') }} </span>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="tanggal_pengajuan">Tanggal Request</label>
                                            <input name="tanggal_pengajuan" type="text" class="form-control" id="tanggal_pengajuan" value="{{ date('d-m-Y', strtotime($approval->tanggal_pengajuan)) }}" readonly>
                                            <span class="help-block" >{{ $errors->first('tanggal_pengajuan') }} </span>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$approval->keterangan}}" readonly>
                                            <span class="help-block" >{{ $errors->first('keterangan') }} </span>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="status_pengajuan">Ubah Status</label>
                                            <select class="form-control select2" name="status_pengajuan" id="status_pengajuan" style="width: 100%;">
                                                <option selected disabled>--Ubah Status--</option>
                                                
                                                <option value = "1">DISETUJUI</option>
                                                <option value = "4">DITOLAK</option>
                                                <option value = "0">PROSES</option>
                                            </select>
                                        </div>
                
                                        <div class="form-group" id="inputKomentar">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                          <a href="{{url("approvalVP")}}" class="btn btn-danger">Cancel</a>
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
    
    @push('script')
    <script type="text/javascript">
        document.getElementById("status_pengajuan").onchange = function() {
            document.querySelector("#inputKomentar").innerHTML = '';
            if(document.getElementById("status_pengajuan").value == 2 || document.getElementById("status_pengajuan").value == 4){ 
                var input = document.createElement("TEXTAREA");
                input.required = true;
                input.name = 'komentar';
                input.className = 'form-control';
                input.placeholder = 'Tambah Keterangan';
                input.maxLength = "1000";
                input.cols = "80";
                input.rows = "5";      
                document.getElementById("inputKomentar").append(input);

                // document.getElementById("inputKomentar").append('<div class="form-group"><label for="komentar">Komentar</label><input name="komentar" type="text" class="form-control" id="komentar"></div>');
            }
        }
    </script>
    @endpush


   
