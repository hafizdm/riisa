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
                    <h3 class="box-title fonts"><b>Upload File Pembayaran</b></h3>
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
                            <form role="form" name="formdata" enctype="multipart/form-data" method="post" action="{{route('updatepaid', $paid->id)}}">
                                @method('PATCH') 
                                @csrf
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 col-xl-4">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input name="nik" type="text" class="form-control" id="nik" value="{{$paid->nik}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nik') }} </span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama">Nama Karyawan</label>
                                    <input name="nama" type="text" class="form-control" id="nama" value="{{$paid->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nama') }} </span>
                                </div>

                                <div class="form-group">
                                    <label for="divisi_id">Divisi</label>
                                    <input name="divisi_nama" type="text" class="form-control" id="divisi_nama" value="{{$paid->divisi_id != 0 ? $paid->request_divisi->nama : '-'}}" readonly>
                                    <input name="divisi_id" type="hidden" class="form-control" id="divisi_id" value="{{$paid->divisi_id}}" readonly>
                                    <span class="help-block" >{{ $errors->first('divisi_id') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="jenis_barang">Jenis Pembelian</label>
                                    <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" value="{{$paid->masterjenisbarang->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('jenis_barang') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="nama_barang">Cost Code</label>
                                    <input name="kode_barang" type="text" class="form-control" id="kode_barang" value="{{$paid->masterKategori->kode_kategori}}/{{$paid->masterKategori->nama_kategori}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$paid->nama_barang}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-xl-4">
                                 <div class="form-group">
                                    <label for="nama_proyek">Lokasi Kebutuhan</label>
                                    <input name="nama_proyek" type="text" class="form-control" id="nama_proyek" value="{{$paid->lokasiProyek->nama}}" readonly>
                                    <span class="help-block" >{{ $errors->first('nama_proyek') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Jumlah Pembelian (satuan)</label>
                                    <input name="quantity" type="text" class="form-control" id="quantity" value="{{$paid->quantity}} {{$paid->quantity_satuan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('quantity') }} </span>
                                </div>  
                              
                                <div class="form-group">
                                    <label for="harga">Harga Satuan</label>
                                    <input name="harga" type="text" class="form-control" id="harga" value="@rupiah($paid->harga),00" readonly>
                                    <span class="help-block" >{{ $errors->first('harga') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total Pembayaran</label>
                                    <input name="total" type="text" class="form-control" id="total" value="@rupiah($paid->total),00" readonly>
                                    <span class="help-block" >{{ $errors->first('total') }} </span>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_pengajuan">Tanggal Request</label>
                                    <input name="tanggal_pengajuan" type="text" class="form-control" id="tanggal_pengajuan" value="{{ date('d-m-Y', strtotime($paid->tanggal_pengajuan)) }}" readonly>
                                    <span class="help-block" >{{ $errors->first('tanggal_pengajuan') }} </span>
                                </div>
        
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$paid->keterangan}}" readonly>
                                    <span class="help-block" >{{ $errors->first('keterangan') }} </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12 col-xl-4">
                                
                                
                                
                              <div class="form-group">
                                    <label for="jenis_pembayaran">Pilih Jenis Pembayaran</label>
                                    <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran" style="width: 100%;" onchange="showfield(this.options[this.selectedIndex].value)" >
                                        <option selected disabled>-- Pilih Jenis Pembayaran --</option>
                                        <option value = "lunas">LUNAS</option>
                                        <option value = "parsial">PARSIAL</option>
                                       
                                    </select>
                                </div>
                                <input type="hidden" value="{{$paid->parsial_pay1}}" id="payment1">
                                <input type="hidden" value="{{$paid->parsial_pay2}}" id="payment2">
                                <input type="hidden" value="{{$paid->parsial_pay3}}" id="payment3">
                                <input type="hidden" value="{{$paid->parsial_pay4}}" id="payment4">
                                <input type="hidden" value="{{$paid->total_barang_pending}}" id="barang_pending">
                                <div id="div1">
                                </div>
                                <div id="div2">
                                </div>        
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                  <a href="{{url("ubah-status-paid")}}" class="btn btn-danger">Batal</a>
                               
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
    
     <script type="text/javascript" >
        function showfield(name){
               if(name == "lunas" ){
                   document.getElementById("div1").innerHTML='<div class="form-group">'+        
                           '<label>Upload Bukti Bayar</label>'+
                           '<input type="file" name="upload_bukti_bayar" id="upload_bukti_bayar" class="form-control" required>'+'</div>'+
                           '<div class="form-group">'+
                                           '<label for="status_paid">Ubah Status</label>'+
                                           '<select class="form-control" style="width: 100%;" id="buktibayarlunas" name="buktibayarlunas">'+
                                              '<option selected disabled>-- Ubah Status --</option>' +
                                               '<option value ="5">PAID</option>'+
                                           '</select>'+
                           '</div>';
               }
            else if(name == "parsial"){
                   
                   var getFile = document.getElementById("payment1").value;
                   var getFile2 = document.getElementById("payment2").value;
                   var getFile3 = document.getElementById("payment3").value;
                   var getFile4 = document.getElementById("payment4").value;
                   var getPending = document.getElementById("barang_pending").value;

                   if(getFile == null || getFile == ''){
                           document.getElementById("div1").innerHTML=
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 1</label>'+
                           '<input type="file" name="parsial_pay1" id="parsial_pay1" class="form-control" required>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 2</label>'+
                           '<input type="text" placeholder="Upload file di tempat yang tersedia" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 3</label>'+
                           '<input type="text" placeholder="Upload file di tempat yang tersedia" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 4</label>'+
                           '<input type="text" placeholder="Upload file di tempat yang tersedia" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+
                                           '<label for="status_paid">Ubah Status</label>'+
                                           '<select class="form-control" style="width: 100%;" id="parsial1" name="parsial1">'+
                                              '<option selected disabled>-- Ubah Status --</option>' +
                                               '<option value = "3">PARSIAL</option>'+
                                           '</select>'+
                           '</div>'+
                           '<div class="form-group">'+
                           '<label for="barang_parsial"> Apakah ada pengambilan Barang </label>'+
                           '<select class="form-control" name="barang_parsial" id="barang_parsial" style="width: 100%;"  >'+
                               '<option selected disabled>-- Pilih --</option>'+
                               '<option value = "0">TIDAK</option>'+
                               '<option value = "1">YA</option>'+
                               
                           '</select>'+
                      ' </div>';
                       }
                       
                   
                   else if(getFile != null && getFile2 == null || getFile2 == ''){
                           document.getElementById("div1").innerHTML=
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 1</label>'+
                           '<input type="text" placeholder="File sudah diupload" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 2</label>'+
                           '<input type="file" name="parsial_pay2" id="parsial_pay2" class="form-control" required>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 3</label>'+
                           '<input type="text" placeholder="Upload File di tempat yang tersedia" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 4</label>'+
                           '<input type="text" placeholder="Upload File di tempat yang tersedia" class="form-control" readonly>'
                           +'</div>';
                           if(getPending == null || getPending == ""){
                           document.getElementById("div2").innerHTML=
                                '<div class="form-group">'+
                                                '<label for="status_paid">Ubah Status</label>'+
                                                '<select class="form-control" style="width: 100%;" id="parsial2" name="parsial2">'+
                                                    '<option selected disabled>-- Ubah Status --</option>' +
                                                    '<option value = "3">PARSIAL</option>'+
                                                '</select>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label for="barang_parsial"> Apakah ada pengambilan Barang </label>'+
                                    '<select class="form-control" name="barang_parsial" id="barang_parsial" style="width: 100%;"  >'+
                                        '<option selected disabled>-- Pilih --</option>'+
                                        '<option value = "0">TIDAK</option>'+
                                        '<option value = "1">YA</option>'+
                                        
                                    '</select>'+
                            '   </div>';
                       }
                       else{
                           document.getElementById("div2").innerHTML=
                           '<div class="form-group">'+
                                           '<label for="status_paid">Ubah Status</label>'+
                                           '<select class="form-control" style="width: 100%;" id="parsial2" name="parsial2">'+
                                              '<option selected disabled>-- Ubah Status --</option>' +
                                              '<option value = "5">PAID</option>'+
                                              '<option value = "3">PARSIAL</option>'+
                                           '</select>'+
                           '</div>'+
                           '<div class="form-group">'+
                               '<label for="barang_parsial"> Apakah ada pengambilan Barang </label>'+
                               '<select class="form-control" name="barang_parsial" id="barang_parsial" style="width: 100%;"  >'+
                                   '<option selected disabled>-- Pilih  --</option>'+
                                   '<option value = "0">TIDAK</option>'+
                                   '<option value = "1">YA</option>'+
                                   
                               '</select>'+
                      '   </div>';
                           
                       }
                       
                   }
                   else if(getFile != null && getFile2 != null && getFile3 == null || getFile3 ==''){
                           document.getElementById("div1").innerHTML=
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 1</label>'+
                           '<input type="text" placeholder="File sudah diupload" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 2</label>'+
                           '<input type="text" placeholder="File sudah diupload" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 3</label>'+
                           '<input type="file" name="parsial_pay3" id="parsial_pay3" class="form-control" required>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 4</label>'+
                           '<input type="text" placeholder="upload File di tempat tersedia" class="form-control" readonly>'
                           +'</div>';
                           if(getPending == null || getPending == ""){
                           document.getElementById("div2").innerHTML=
                           '<div class="form-group">'+
                                           '<label for="status_paid">Ubah Status</label>'+
                                           '<select class="form-control" style="width: 100%;" id="parsial3" name="parsial3">'+
                                              '<option selected disabled>-- Ubah Status --</option>' +
                                               '<option value = "3">PARSIAL</option>'+
                                           '</select>'+
                           '</div>'+
                           '<div class="form-group">'+
                               '<label for="barang_parsial"> Apakah ada pengambilan Barang </label>'+
                               '<select class="form-control" name="barang_parsial" id="barang_parsial" style="width: 100%;"  >'+
                                   '<option selected disabled>-- Pilih  --</option>'+
                                   '<option value = "0">TIDAK</option>'+
                                   '<option value = "1">YA</option>'+
                                   
                               '</select>'+
                      '   </div>';
                       }
                       else{
                           document.getElementById("div2").innerHTML=
                           '<div class="form-group">'+
                                           '<label for="status_paid">Ubah Status</label>'+
                                           '<select class="form-control" style="width: 100%;" id="parsial3" name="parsial3">'+
                                              '<option selected disabled>-- Ubah Status --</option>' +
                                              '<option value = "5">PAID</option>'+
                                              '<option value = "3">PARSIAL</option>'+
                                           '</select>'+
                           '</div>'+
                           '<div class="form-group">'+
                               '<label for="barang_parsial"> Apakah ada pengambilan Barang </label>'+
                               '<select class="form-control" name="barang_parsial" id="barang_parsial" style="width: 100%;"  >'+
                                   '<option selected disabled>-- Pilih  --</option>'+
                                   '<option value = "0">TIDAK</option>'+
                                   '<option value = "1">YA</option>'+
                                   
                               '</select>'+
                      '   </div>';
                       }
                   }
                   else if(getFile != null && getFile2 != null && getFile3 != null && getFile4 == null || getFile4 ==''){
                           document.getElementById("div1").innerHTML=
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 1</label>'+
                           '<input type="text" placeholder="File sudah diupload" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 2</label>'+
                           '<input type="text" placeholder="File sudah diupload" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 3</label>'+
                           '<input type="text" placeholder="File sudah diupload" class="form-control" readonly>'
                           +'</div>'+
                           '<div class="form-group">'+        
                           '<label>Bukti Bayar 4</label>'+
                           '<input type="file" name="parsial_pay4" id="parsial_pay4" class="form-control" required>'
                           +'</div>'+
                           '<div class="form-group">'+
                                           '<label for="status_paid">Ubah Status</label>'+
                                           '<select class="form-control" style="width: 100%;" id="parsial4" name="parsial4" required>'+
                                              '<option selected disabled>-- Ubah Status --</option>' +
                                              '<option value = "5">PAID</option>'+
                                            //   '<option value = "3">PARSIAL</option>'+
                                           '</select>'+
                           '</div>'+
                           '<div class="form-group">'+
                               '<label for="barang_parsial"> Apakah ada pengambilan Barang </label>'+
                               '<select class="form-control" name="barang_parsial" id="barang_parsial" style="width: 100%;" required>'+
                                   '<option selected disabled>-- Pilih  --</option>'+
                                   '<option value = "0">TIDAK</option>'+
                                   '<option value = "1">YA</option>'+
                                   
                               '</select>'+
                      '   </div>';
                   }
                       
             }
           }
           
       </script>

