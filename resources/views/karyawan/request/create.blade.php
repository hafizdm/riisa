@extends('templates.header')
@section('content')
<section class="content"> 
<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <b>Purchase Application Form</b></h3>
            </div>
            <br>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-6 col-lg-6">
                    <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{url("request/store")}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Employee's name</label>
                    <input type="text" class="form-control bg-input-form" id="nama" name="nama" value="{{$user->user_login->nama}}" placeholder="" readonly >
                    </div>
                        
                    <div class="form-group" id="nik">
                        <label for="nik">Employee Identification Number (NIK)</label>
                        <input type="text" class="form-control bg-input-form" id="nik" name="nik" value="{{$user->user_login->nik}}" placeholder="" readonly >
                        <span id="nik" class="help-block" > {{ $errors->first('nik') }} </span>
                    </div>

                    <div class="form-group">
                        <label for="divisi_nama">Division</label>
                    <input type="text" class="form-control bg-input-form" id="divisi_nama" name="divisi_nama" value="{{$karyawan->divisi_id != 0 ? $karyawan->divisi->nama : '-'}}" placeholder="" readonly >
                    <input type="hidden" class="form-control" id="divisi_id" name="divisi_id" value="{{$karyawan->divisi_id}}">
                    </div>

                    <div class="form-group">
                        <label for="jenis_barang">Type of Purchase</label>
                        <select name="jenis_barang" type="text" class="form-control select2" id="jenis_barang"  style="width: 100%;" onchange="getState()" required>
                            <option selected disabled>-- Select type of purchase --</option>
                            @foreach($jenis_barang as $a )
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kode_barang">Cost Code</label>
                        <select name="kode_barang" type="text" class="form-control select2" id="kode_barang"  style="width: 100%;" onchange="getState()" required>
                            <option selected disabled>-- Select cost code --</option>
                            @foreach($kategori_barang as $a )
                                <option value="{{ $a->id }}">{{ $a->kode_kategori }} / {{ $a->nama_kategori }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Item's name</label>
                        <select name="nama_barang" type="text" class="form-control select2" id="nama_barang" style="width: 100%;" required>
                            {{-- <option value=""></option> --}}
                            <option selected disabled>-- Select item --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_proyek">Location</label>
                        <select name="nama_proyek" type="text" class="form-control select2" id="nama_proyek"  style="width: 100%;" required>
                            <option selected disabled>-- Select location --</option>
                            @foreach($lokasi_project as $a )
                                <option value="{{ $a->id }}">{{ $a->nama}}</option>
                            @endforeach
                        </select>
                    </div> 

                </div>
                  <!-- end of bilah kiri -->

                  <!-- bilah tengah -->
                <div class="col-xs-12 col-xl-6 col-lg-6">
                  
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" onKeyup="hitung();" placeholder="Jumlah Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity_satuan">Select Unit</label>
                        <select class="form-control select2" name="quantity_satuan" id="quantity_satuan" style="width: 100%;" required>
                        <option selected disabled>-- Select unit -- </option>
                        <option value='unit'>Unit</option>
                        <option value='kotak'>box</option>
                        <option value='lusin'>dozen</option>
                        <option value='liter'>litre</option>
                        <option value='kg'>Kg</option>
                        <option value='pcs'>Pcs</option>
                        <option value='rim'>Rim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Estimated Unit Price</label>
                        <input type="text" class="form-control" id="harga" name="harga" onKeyup="hitung();" placeholder="Rp.000 (hanya input angka)" required>
                    </div>
                    <div class="form-group">
                        <label for="total">Estimated Total Price</label>
                        <input type="text" class="form-control bg-input-form" id="total" name="total" value="" placeholder="Rp.000 (total secara otomatis)" required>
                    </div>
                    
                    <div class="form-group" id="tgb">
                        <label for="tanggal_pengajuan">Date of Request</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan"  placeholder="yyyy/mm/dd" required >
                    </div>
                    <div class="form-group" id="ket_div">
                        <label for="keterangan">Description</label>
                        <textarea id="keterangan" name="keterangan" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url("request")}}" class="btn btn-danger">Cancel</a>
                        
                </div>
        </form>
              <!-- end of form karyawan -->
            </div>
          </div>
        </div>
      </div>
      </div>
      </section>
     
    @endsection
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    {{-- <script src="{{ asset('AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.js')}}" ></script>
    <script src="{{ asset('AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.date.extensions.js')}}" ></script>
    <script src="{{ asset('AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.extensions.js')}}" ></script> --}}
    <script type="text/javascript" >
    // $(document).ready(function(){
    //     $('[data-mask]').inputmask()
    // });
    function getState(val){
        var jenis_barang = $("#jenis_barang").val();
        var kode_barang = $("#kode_barang").val();

        console.log("jenis_pembelian>>", jenis_barang);
        console.log("cost_code>>>", kode_barang);

        if(jenis_barang == -1 && kode_barang == -1){
            alert('Pilih Jenis Pembelian dan Cost Code');
        }
        else{
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            $.ajax({
                type: "POST",
                url: "{{url('get-barang/store')}}",
                data:{"jenis_barang" : jenis_barang, "kode_barang":kode_barang},
                success: function(data){
                    console.log(data);
                    // $("#nama_barang").append('<option value=""></option>');
                    // $('#nama_barang').html(data);
                    // $('#nama_barang').val(data);
                    $("#nama_barang").empty();
                    $("#nama_barang").append('<option selected disabled>--Pilih Barang--</option>');
                    data.forEach(myFunction);
                    function myFunction(item){
                        $("#nama_barang").append('<option value="'+item+'">'+item+'</option>');
                        console.log('nama barang>>>', item);
                        }
                    }
                });
            }
    }

    function hitung()
        { 
            var qty = (document.getElementById('quantity').value == '' ? 0: document.getElementById('quantity').value);
            var harga = (document.getElementById('harga').value == '' ? 0:document.getElementById('harga').value);
            var result = parseInt(qty) * parseInt(harga);
            if (!isNaN(result)) {
            document.getElementById("total").value = result;
            }
        }

    function reset(){
        $('.select2').val(null).trigger('change');
    }


    $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: false,
        });
    $('.select2').select2();

    </script>
    @endpush

