@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Edit Data Karyawan</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-4">
                    <form role="form" name="formdata" method="post" enctype="multipart/form-data">
                    @method('PATCH') 
                    @csrf
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="{{$karyawan->nik}}" data-inputmask="'mask' : ['9999999999999999']" data-mask>
                            <span id="nik" class="help-block" >{{ $errors->first('nik') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="type">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{$karyawan->nama}}">
                            <span id="nama" class="help-block" > {{ $errors->first('nama') }} </span>
                        </div>
                    
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Tanggal Lahir</label>
                            <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir"  placeholder=" "  value="{{$karyawan->tempat_lahir}}">
                            <span class="help-block" >{{ $errors->first('insurance_claim') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="date_birth">Tanggal Lahir</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="date_birth" name="date_birth" placeholder="yyyy/mm/dd"  value="{{$karyawan->date_birth}}">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            {{-- <input type="text" class="form-control" id="alamat" name="alamat" value="{{$karyawan->alamat}}"  > --}}
                            <textarea id="alamat" name="alamat" rows="4" cols="50" class="form-control">{{$karyawan->alamat}}</textarea>
                            <span id="stnk_no" class="help-block" > {{ $errors->first('alamat') }} </span>
                        </div>
                        
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control select2">
                              <option selected disabled>--Pilih Agama--</option>
                                <option value="islam" {{$karyawan->agama == 'islam' ? 'selected' : ''  }}>Islam</option>
                                <option value="hindu" {{$karyawan->agama == 'hindu' ? 'selected' : ''  }}>Hindu</option>
                                <option value="budha" {{$karyawan->agama == 'budha' ? 'selected' : ''  }}>Budha</option>
                                <option value="kristen" {{$karyawan->agama == 'kristen' ? 'selected' : ''  }}>Kristen</option>
                                <option value="katolik" {{$karyawan->agama == 'katolik' ? 'selected' : ''  }}>Katolik</option>
                                <option value="konghucu" {{$karyawan->agama == 'konghucu' ? 'selected' : ''  }}>Konghucu</option>
                            </select>
                            <span id="agama" class="help-block" > {{ $errors->first('agama') }} </span>
                        </div>
                        
                          
                        
                </div>
                  <!-- end of bilah kiri -->
                  <!-- bilah tengah -->
                  <div class="col-xs-4">
                      
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin" style="width: 100%;">
                        <option selected disabled>--Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{$karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : ''  }}>Laki-laki</option>
                        <option value="Perempuan" {{$karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : ''  }}>Perempuan</option>
                        {{-- <option value='laki'>Pria</option> --}}
                        {{-- <option value='wanita'>Wanita</option> --}}
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$karyawan->email}}" >
                        <span id="email" class="help-block" > {{ $errors->first('email') }} </span>
                    </div>
                  
                    <div class="form-group">
                        <label for="handphone">No. Telephone</label>
                        <input type="text" class="form-control" id="handphone" name="handphone" value="{{$karyawan->handphone}}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        <span id="handphone" class="help-block" > {{ $errors->first('handphone') }} </span>
                    </div>

                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        {{-- <input type="text" class="form-control" id="npwp" name="npwp" placeholder="XX.XXX.XXX.X-XXX.XXX" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask value="{{$karyawan->npwp}}"> --}}
                        <input type="text" class="form-control" id="npwp" name="npwp" value="{{$karyawan->npwp}}" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask>
                        <span id="npwp" class="help-block" > {{ $errors->first('npwp') }} </span>
                    </div>

                    <div class="form-group">
                        <label for="bpjs">BPJS</label>
                        <input name="bpjs" type="text" class="form-control" id="bpjs"  placeholder=""  value="{{$karyawan->bpjs}}" data-inputmask="'mask' : ['9999999999999']" data-mask>
                        <span class="help-block" >{{ $errors->first('bpjs') }} </span>
                    </div>

                    <div class="form-group">
                      <label for="divisi">Divisi</label>
                      <select name="divisi_id" class="form-control select2" id="divisi_id"  style="width: 100%;" onchange="getState()" required>
                          <option value="0" selected>--Pilih Divisi--</option>
                          @foreach($dd as $a )
                            <option {{$karyawan->divisi_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{$a->nama}} </option>
                          @endforeach
                      </select>
                  </div>
                    
                    <div class="form-group">
                        <label for="jabatan_id">Jabatan</label>
                        <select name="jabatan_id" class="form-control select2" id="jabatan_id"  style="width: 100%;" required>
                            {{-- <option selected></option> --}}
                            <option selected disabled>--Pilih Jabatan--</option>
                                @foreach($jj as $a )
                                    <option {{$karyawan->jabatan_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{$a->jenis_jabatan}} </option>
                                @endforeach
                        </select>
                    </div>

               
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="date_joining">Tanggal Bergabung</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="date_joining" name="date_joining" placeholder="yyyy/mm/dd" value="{{$karyawan->date_joining}}">
                        </div>
                        <div class="form-group">
                            <label for="lokasi_id">Lokasi Penempatan</label>
                            <select name="lokasi_id" class="form-control select2" id="lokasi_id"  style="width: 100%;">
                                {{-- <option selected></option> --}}
                                <option selected disabled>--Pilih Lokasi Penempatan--</option>
                                    @foreach($proyek as $a )
                                        <option {{$karyawan->lokasi_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{$a->nama}} </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date_resign">Tanggal Keluar</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="date_resign" name="date_resign" placeholder="yyyy/mm/dd" value="{{$karyawan->date_resign}}">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"  value="{{$karyawan->keterangan}}" >
                            <span id="keterangan" class="help-block" > {{ $errors->first('keterangan') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control select2" name="status" id="status" style="width: 100%;" value="{{$karyawan->status}}">
                            <option selected disabled>--Pilih Status--</option>
                            <option value='0' {{$karyawan->status == '0' ? 'selected' : ''  }}>Aktif</option>
                            <option value='1' {{$karyawan->status == '1' ? 'selected' : ''  }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="roles">Roles</label>
                          <select class="form-control select2" name="roles" id="roles" style="width: 100%;" required> 
                          <option selected disabled >--Pilih Roles--</option>
                          @foreach($role as $rs)
                              <option {{$karyawan->user_login->role_id == $rs->id ? 'selected' : ''}} value="{{$rs->id}}">{{$rs->name}}</option>
                          @endforeach
                          </select>
                      </div>

                        <div class="form-group">
                            <label for="foto_karyawan">Upload Foto</label>
                            <div style="padding-bottom:10px">
                            </div>
                            @if($karyawan->foto != null)
                                <img src="{{ asset('uploads/Karyawan/')."/".$karyawan->foto}}" style="height: 100px" id="emp_foto" name="emp_foto" alt="Foto Karyawan" class="img-circle">
                            @else
                                <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" style="height: 100px" id="emp_foto" name="emp_foto" alt="Foto Karyawan" class="img-circle">
                            @endif
                            <div style="padding-bottom:10px">
                            </div>
                          <input type="file" name="foto" id="foto" class="form-control">
                            <div class="invalid-feedback">
                            {{ $errors->first('upload_tba') }}
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{url("karyawan")}}" class="btn btn-danger">Batal</a>
                    </div>
                        
                <!-- end off bilah tengah -->
                
                <!-- end of footer button -->
            </form>
              <!-- end of form karyawan -->
            </div>
          </div>
          
        </div>
      </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Upload Document Pendukung</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                <div class="form-group">
                                    <label for="upload_tba">Upload CV Anda </label>
                                    <input type="file" name="upload_tba" id="upload_tba" class="form-control" required>
                                    <div class="invalid-feedback">
                                    {{ $errors->first('upload_tba') }}
                                    </div>
                           </div>

                          <div class="form-group">
                            <label for="upload_tba">Upload Izazah </label>
                            <input type="file" name="upload_tba" id="upload_tba" class="form-control" required>
                            <div class="invalid-feedback">
                            {{ $errors->first('upload_tba') }}
                            </div>
                         </div>
                         <div class="form-group">
                            <label for="upload_tba">Upload Sertifikat </label>
                            <input type="file" name="upload_tba" id="upload_tba" class="form-control" required>
                            <div class="invalid-feedback">
                            {{ $errors->first('upload_tba') }}
                            </div>
                         </div>
                  <!-- /.form-group -->
                 
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <!-- <div class="col-md-6"> -->
                  
                  <!-- /.form-group -->
                 
                  <!-- /.form-group -->
                <!-- </div> -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            
          </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Pendidikan</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="kampuss1">Nama Perguruan Tinggi (S1)</label>
                      <input name="kampuss1" type="text" class="form-control" id="kampuss1"  >
                      <span class="help-block" > </span>
                    </div>
                  <!-- /.form-group -->
                 
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                <div class="form-group">
                      <label for="kampuss1">Nama Perguruan Tinggi (S2)</label>
                      <input name="kampuss1" type="text" class="form-control" id="kampuss1"  >
                      <span class="help-block" > </span>
                    </div>
                  <!-- /.form-group -->
                 
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            
          </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Pengalaman</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  
                  <!-- /.form-group -->
                 
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  
                  <!-- /.form-group -->
                 
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            
          </div>
    </div>
</div>
       
      </section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{ asset('AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.js')}}" ></script>
<script src="{{ asset('AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.date.extensions.js')}}" ></script>
<script src="{{ asset('AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.extensions.js')}}" ></script>
<script type="text/javascript" >

    function getState(val){
        var divisi_id = $("#divisi_id").val();

        console.log("divisi_id>>", divisi_id);

        if(divisi_id == -1){
            alert('Pilih Jabatan');
        }
        else{
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            $.ajax({
                type: "POST",
                url: "{{url('get-jabatan-divisi/store')}}",
                data:{"divisi_id" : divisi_id},
                success: function(data){
                    console.log(data);
                    $("#jabatan_id").empty();
                    // data.forEach(myFunction);
                    $("#jabatan_id").append('<option selected disabled>--Pilih Jabatan--</option>');
                    // function myFunction(item){
                    //     $("#jabatan_id").append('<option value="'+item.id+'">'+item.nama+'</option>');
                    //     console.log('nama jabatan_id>>>', item);
                    // }
                    $.each(data,function(placement,row){
                      // {{$karyawan->jabatan_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"
                            $("#jabatan_id").append('<option value="'+row.id+'">'+row.jenis_jabatan+'</option>');
                            console.log('jabatan_id>>>', row.id);
                            console.log('nama>>>', row.jenis_jabatan);
                        });
                    }
                });
            }
    }

function reset(){
    $('.select2').val(null).trigger('change');
}
$(document).ready(function(){
  $('[data-mask]').inputmask();
  // ketika upload gambar maka preview
  $('#foto').change(function(){
        preview_foto(this);
    });
});

//Initialize Select2 Elements
$('.select2').select2()

$('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
      autoclose: true
    })


// fungsi preview foto karyawan
function preview_foto(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader(); 
        reader.onload = function(e){
            $('#emp_foto').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

</script>
@endpush
