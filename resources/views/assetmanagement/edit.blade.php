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
                    <h3 class="box-title fonts"><b>Persetujuan Barang Keluar</b></h3>
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
                            <form role="form" name="formdata" method="post" action="{{route('updateapprovalbrg', $approval->id)}}">
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
                                    <input name="divisi_nama" type="text" class="form-control" id="divisi_nama" value="{{$approval->divisi_id != 0 ? $approval->request_divisi->nama : '-'}}" readonly>
                                    <input name="divisi_id" type="hidden" class="form-control" id="divisi_id" value="{{$approval->divisi_id}}" readonly>
                                    <span class="help-block" >{{ $errors->first('divisi_id') }} </span>
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
                                    <textarea class="form-control" readonly>{{$approval->nama_barang}}</textarea>
                                    <!--<input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$approval->nama_barang}}" readonly>-->
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
                     
                                <div class="form-group">
                                    <label for="harga">Harga Satuan</label>
                                    <input name="harga" type="text" class="form-control" id="harga" value="@rupiah($approval->harga),00" readonly>
                                    <span class="help-block" >{{ $errors->first('harga') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total Pembayaran</label>
                                    <input name="total" type="text" class="form-control" id="total" value="@rupiah($approval->total),00" readonly>
                                    <span class="help-block" >{{ $errors->first('total') }} </span>
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <label for="tanggal_pengajuan">Tanggal Pengajuan Pembelian</label>-->
                                <!--    <input name="tanggal_pengajuan" type="text" class="form-control" id="tanggal_pengajuan" value="{{ date('d-m-Y', strtotime($approval->tanggal_pengajuan)) }}" readonly>-->
                                <!--    <span class="help-block" >{{ $errors->first('tanggal_pengajuan') }} </span>-->
                                <!--</div>-->
                                
                                <!--<div class="form-group">-->
                                <!--    <label for="tanggal_disetujui">Tanggal Disetujui</label>-->
                                <!--    <input name="tanggal_disetujui" type="text" class="form-control" id="tanggal_disetujui" value="{{date('d-m-Y', strtotime($approval->updated_at))}}" readonly>-->
                                <!--    <span class="help-block" >{{ $errors->first('tanggal_disetujui') }} </span>-->
                                <!--</div>-->
                                @if($approval->status_paid == 5)
                                    <div class="form-group">
                                        <label for="tgl_pengajuan_pengeluaran">Tanggal Pengajuan Pengeluaran</label>
                                        <input name="tgl_pengajuan_pengeluaran" type="text" class="form-control" id="tgl_pengajuan_pengeluaran" value="{{$approval->tgl_pengajuan_pengeluaran != null ? date('d-m-Y', strtotime($approval->tgl_pengajuan_pengeluaran)) : ""}}" readonly>
                                        <span class="help-block" >{{ $errors->first('tgl_pengajuan_pengeluaran') }} </span>
                                    </div>
                                @else
                                
                                @endif
                                
                                {{-- kondisi saat pembayaran parsial pertama --}}
                                @if($approval->barang_parsial == 1 && $approval->parsial_pay1 != null && $approval->parsial_pay2 == null  && $approval->parsial_pay3 == null && $approval->parsial_pay4 == null)
                                    <div class="form-group">
                                        <label for="total"> Total Barang Keluar</label>
                                        <input type="text" class="form-control" id="total_barang_parsial" name="total_barang_parsial" onKeyup="hitung();"  placeholder="Masukkan jumlah barang keluar" required>
                                        <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_barang_pending">Sisa Barang Pending</label>
                                        <input type="text" class="form-control" id="total_barang_pending" name="total_barang_pending"  placeholder="Perhitungan Otomatis" readonly>
                                        <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                                    </div>

                                {{-- kondisi saat pembayaraan parsial ke 2 --}}

                                @elseif($approval->barang_parsial == 1 && $approval->parsial_pay1 != null && $approval->parsial_pay2 != null  && $approval->parsial_pay3 == null  && $approval->parsial_pay4 == null)
                                    <div class="form-group">

                                    {{-- sisa barang pending dari proses parsial pertama --}}
                                    <label for="total"> Total Barang Pending</label>
                                    <input type="text" class="form-control" id="pending_barang2" name="pending_barang2" value ="{{$approval->total_barang_pending}}" readonly>

                                    {{-- Get data dari database untuk sisa barang yang pending --}}
                                    <input type="hidden" class="form-control" id="total_barang_keluar" name="total_barang_keluar" value ="{{$approval->total_barang_keluar}}">

                                </div>
                                <div class="form-group">
                                    <label for="total_barang_pending">Total Barang Keluar </label>
                                    <input type="text" class="form-control" id="total_barang_pending" name="total_barang_pending"  placeholder=" Total Barang diterima " required onKeyup="hitung_parsial();">
                                    <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="total_barang_pending">Sisa Barang Pending</label>
                                    <input type="text" class="form-control" id="total_parsial2" name="total_parsial2"  placeholder=" Total Barang  " readonly>
                                    <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                                </div>




                                {{-- kondisi pembayaran parsial 3 --}}
                            @elseif($approval->barang_parsial == 1 && $approval->parsial_pay1 != null && $approval->parsial_pay2 != null  && $approval->parsial_pay3 != null && $approval->parsial_pay4 == null) 
                                <div class="form-group">
                                    <label for="total"> Total Barang Pending</label>
                                    {{-- sisa barang pending dari proses parsial ke 2 --}}
                                    <input type="text" class="form-control" id="pending_barang3" name="pending_barang3" value ="{{$approval->total_barang_pending}}" onKeyup="hitung_parsial3();" readonly>

                                    {{-- get data dari data base untuk sisa barang yang pending --}}
                                    <input type="hidden" class="form-control" id="total_barang_keluar" name="total_barang_keluar" value ="{{$approval->total_barang_keluar}}">
                                    <span id="total_barang_parsial_2" class="help-block" > {{ $errors->first('total') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="total_barang_pending">Total Barang Keluar</label>
                                    <input type="text" class="form-control" id="total_barang_pending" name="total_barang_pending"  placeholder=" Total Barang Keluar " required onKeyup="hitung_parsial3();">
                                    <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="total_barang_pending">Sisa Barang Pending </label>
                                    <input type="text" class="form-control" id="total_parsial3" name="total_parsial3"  placeholder=" Total Barang  " readonly>
                                    <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                                </div>

                            {{-- pembayaran parsial ke 4  --}}
                            @elseif($approval->barang_parsial == 1 && $approval->parsial_pay1 != null && $approval->parsial_pay2 != null && $approval->parsial_pay3 != null && $approval->parsial_pay4 != null)
                            <div class="form-group">
                                <label for="total"> Total Barang Pending</label>
                                {{-- sisa barang pending dari proses parsial ke 3 --}}
                                <input type="text" class="form-control" id="pending_barang4" name="pending_barang4" value ="{{$approval->total_barang_pending != null ? $approval->total_barang_pending : $approval->quantity." ". $approval->quantity_satuan}}" onKeyup="hitung_parsial4();" readonly>

                                {{-- get data dari data base untuk sisa barang yang pending --}}
                                <input type="hidden" class="form-control" id="total_barang_keluar" name="total_barang_keluar" value ="{{$approval->total_barang_keluar}}">
                                <span id="total_barang_parsial_2" class="help-block" > {{ $errors->first('total') }} </span>
                            </div>
                            <div class="form-group">
                                <label for="total_barang_pending">Total Barang Keluar</label>
                                <input type="text" class="form-control" id="total_barang_pending" name="total_barang_pending"  placeholder=" Total Barang diterima " required onKeyup="hitung_parsial4();">
                                <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                            </div>
                            <div class="form-group">
                                <label for="total_barang_pending">Sisa Barang Pending </label>
                                <input type="text" class="form-control" id="total_parsial4" name="total_parsial4"  placeholder=" Total Barang  " readonly>
                                <span id="total" class="help-block" > {{ $errors->first('total') }} </span>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="total"> Total Barang Pending</label>
                                <input type="text" class="form-control" id="barang_lunas" name="barang_lunas" value ="{{$approval->quantity}} {{$approval->quantity_satuan}}" readonly>
                            </div>
                            @endif
                                
                                <div class="form-group">
                                    <label for="status_brg_keluar">Ubah Status</label>
                                    <select class="form-control" name="status_brg_keluar" id="status_brg_keluar" style="width: 100%;" required>
                                        <option selected disabled>-- Ubah Status --</option>
                                        {{-- <option value = "1">PROSES</option> --}}
                                        <option value = "2">DISETUJUI</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="updated_asset_by">Diproses Oleh</label>
                                    <input name="updated_asset_by" type="text" class="form-control" id="updated_asset_by" required>
                                    <span class="help-block" >{{ $errors->first('updated_asset_by') }} </span>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{url("list-approval-barang-keluar")}}" class="btn btn-danger">Batal</a>
                               
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
    @push('script')
    <script type="text/javascript" >
       function hitung()
        {
                var qty = (document.getElementById('quantity').value == '' ? 0: document.getElementById('quantity').value);
                var barang = (document.getElementById('total_barang_parsial').value == '' ? 0:document.getElementById('total_barang_parsial').value);
                var result = parseInt(qty) - parseInt(barang);
                if (!isNaN(result)) {
                document.getElementById("total_barang_pending").value = result;
                }
                 
        }
        function hitung_parsial(){
                var barang_pending = (document.getElementById('pending_barang2').value == '' ? 0: document.getElementById('pending_barang2').value);
                var barang2 = (document.getElementById('total_barang_pending').value == '' ? 0:document.getElementById('total_barang_pending').value);
                var result = parseInt(barang_pending) - parseInt(barang2);
                if (!isNaN(result)) {
                document.getElementById("total_parsial2").value = result;
                }
        }

        function hitung_parsial3(){
                var barang_pending = (document.getElementById('pending_barang3').value == '' ? 0: document.getElementById('pending_barang3').value);
                var barang2 = (document.getElementById('total_barang_pending').value == '' ? 0:document.getElementById('total_barang_pending').value);
                var result = parseInt(barang_pending) - parseInt(barang2);
                if (!isNaN(result)) {
                document.getElementById("total_parsial3").value = result;
                }
        }
        function hitung_parsial4(){
                var barang_pending = (document.getElementById('pending_barang4').value == '' ? 0: document.getElementById('pending_barang4').value);
                var barang2 = (document.getElementById('total_barang_pending').value == '' ? 0:document.getElementById('total_barang_pending').value);
                var result = parseInt(barang_pending) - parseInt(barang2);
                if (!isNaN(result)) {
                document.getElementById("total_parsial3").value = result;
                }
        }
            
        function hitung()
         {
                 var qty = (document.getElementById('quantity').value == '' ? 0: document.getElementById('quantity').value);
                 var barang = (document.getElementById('total_barang_parsial').value == '' ? 0:document.getElementById('total_barang_parsial').value);
                 var result = parseInt(qty) - parseInt(barang);
                 if (!isNaN(result)) {
                 document.getElementById("total_barang_pending").value = result;
                 }
                  
         }
         function hitung_parsial(){
                 var barang_pending = (document.getElementById('pending_barang2').value == '' ? 0: document.getElementById('pending_barang2').value);
                 var barang2 = (document.getElementById('total_barang_pending').value == '' ? 0:document.getElementById('total_barang_pending').value);
                 var result = parseInt(barang_pending) - parseInt(barang2);
                 if (!isNaN(result)) {
                 document.getElementById("total_parsial2").value = result;
                 }
         }
         function hitung_parsial3(){
                 var barang_pending = (document.getElementById('pending_barang3').value == '' ? 0: document.getElementById('pending_barang3').value);
                 var barang2 = (document.getElementById('total_barang_pending').value == '' ? 0:document.getElementById('total_barang_pending').value);
                 var result = parseInt(barang_pending) - parseInt(barang2);
                 if (!isNaN(result)) {
                 document.getElementById("total_parsial3").value = result;
                 }
         }
         function hitung_parsial4(){
                 var barang_pending = (document.getElementById('pending_barang4').value == '' ? 0: document.getElementById('pending_barang4').value);
                 var barang2 = (document.getElementById('total_barang_pending').value == '' ? 0:document.getElementById('total_barang_pending').value);
                 var result = parseInt(barang_pending) - parseInt(barang2);
                 if (!isNaN(result)) {
                 document.getElementById("total_parsial4").value = result;
                 }
         }
             
     </script>
     @endpush

