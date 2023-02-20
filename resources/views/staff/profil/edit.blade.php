@extends('templates.header')

@section('content')

<section class="content"> 
@if(session()->get('success'))
      <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }} 
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </div>
@elseif(session()->get('failed'))
    <div class="alert alert-danger alert-dismissible fade in"> 
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <h4><i class="icon fa fa-ban"></i> Failed !</h4>
      {{ session()->get('failed') }}
    </div>
@endif
<div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Change Personal Data</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-md-4 col-lg-4">
                    <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{route('update-profil', $karyawan->nik)}}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">
                      <label for="foto_karyawan">Upload Photo</label>
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
                        <div class="form-group">
                            <label for="nik">NIK*</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="{{$karyawan->nik}}" maxlength="16" readonly style="background: white">
                            <span id="nik" class="help-block" >{{ $errors->first('nik') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="type">Full Name*</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{$karyawan->nama}}" required>
                            <span id="nama" class="help-block" > {{ $errors->first('nama') }} </span>
                        </div>
                    
                        <div class="form-group">
                            <label for="tempat_lahir">Birth Place</label>
                            <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir"  placeholder=" "  value="{{$karyawan->tempat_lahir}}">
                        </div>

                        <div class="form-group">
                            <label for="date_birth">Birth Date</label>
                            <input type="date" class="form-control" value="{{$karyawan->date_birth}}" name="date_birth" id="date_birth">
                        </div>

                        <div class="form-group">
                          <label for="jenis_kelamin">Gender</label>
                          <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin" style="width: 100%;">
                          <option selected disabled>--Pilih Jenis Kelamin</option>
                          <option value="Laki-laki" {{$karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : ''  }}>Male</option>
                          <option value="Perempuan" {{$karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : ''  }}>Female</option>
                          </select>
                      </div> 
                       
                        
                </div>
                  <!-- end of bilah kiri -->
                  <!-- bilah tengah -->
                  <div class="col-xs-12 col-md-4 col-lg-4">

                    <div class="form-group">
                      <label for="agama">Religion</label>
                      <select name="agama" id="agama" class="form-control select2" style="width: 100%">
                        <option selected disabled>--Select religion--</option>
                          <option value="islam" {{$karyawan->agama == 'islam' ? 'selected' : ''  }}>Islam</option>
                          <option value="hindu" {{$karyawan->agama == 'hindu' ? 'selected' : ''  }}>Hindu</option>
                          <option value="budha" {{$karyawan->agama == 'budha' ? 'selected' : ''  }}>Budha</option>
                          <option value="kristen" {{$karyawan->agama == 'kristen' ? 'selected' : ''  }}>Kristen</option>
                          <option value="katolik" {{$karyawan->agama == 'katolik' ? 'selected' : ''  }}>Katolik</option>
                          <option value="konghucu" {{$karyawan->agama == 'konghucu' ? 'selected' : ''  }}>Konghucu</option>
                      </select>
                      <span id="agama" class="help-block" > {{ $errors->first('agama') }} </span>
                    </div>
                    
                    <div class="form-group">
                      <label for="alamat">Address</label>
                      <textarea id="alamat" name="alamat" rows="4" cols="50" class="form-control">{{$karyawan->alamat}}</textarea>

                    </div>
                   
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$karyawan->email}}" required>
                        <span id="email" class="help-block" > {{ $errors->first('email') }} </span>
                    </div>
                  
                    <div class="form-group">
                        <label for="handphone">Phone Number*</label>
                        <input type="text" class="form-control" id="handphone" name="handphone" value="{{$karyawan->handphone}}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
                    
                    </div>

                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        {{-- <input type="text" class="form-control" id="npwp" name="npwp" placeholder="XX.XXX.XXX.X-XXX.XXX" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask value="{{$karyawan->npwp}}"> --}}
                        <input type="text" class="form-control" id="npwp" name="npwp" value="{{$karyawan->npwp}}" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask>
                        <span id="npwp" class="help-block" > {{ $errors->first('npwp') }} </span>
                    </div>

                   <div class="form-group">
                      <label for="bpjs_ketenagakerjaan">BPJS of Employment</label>
                      <input name="bpjs_ketenagakerjaan" type="text" class="form-control" id="bpjs_ketenagakerjaan"  value="{{$karyawan->bpjs_ketenagakerjaan}}" data-inputmask="'mask' : ['9999999999999']" data-mask>
                     
                    </div>

                    <div class="form-group">
                      <label for="bpjs_kesehatan">BPJS of Healthcare</label>
                      <input name="bpjs_kesehatan" type="text" class="form-control" id="bpjs_kesehatan" value="{{$karyawan->bpjs_kesehatan}}" data-inputmask="'mask' : ['9999999999999']" data-mask>
                     
                    </div>

                    </div>
                    <div class="col-xs-12 col-xl-4 col-lg-4">
                      <div class="form-group">
                        <label for="divisi">Division*</label>
                        <select name="divisi_id" class="form-control select2" id="divisi_id"  style="width: 100%;" onchange="getState()" required>
                            <option value="0" selected>--Select division--</option>
                            @foreach($dd as $a )
                              <option {{$karyawan->divisi_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{$a->nama}} </option>
                            @endforeach
                        </select>
                    </div>
                      
                      <div class="form-group">
                          <label for="jabatan_id">Position*</label>
                          <select name="jabatan_id" class="form-control select2" id="jabatan_id"  style="width: 100%;" required>
                              {{-- <option selected></option> --}}
                              <option selected disabled>--Select position--</option>
                                  @foreach($jj as $a )
                                      <option {{$karyawan->jabatan_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{$a->jenis_jabatan}} </option>
                                  @endforeach
                          </select>
                      </div>


                        <div class="form-group">
                            <label for="lokasi_id">Placement*</label>
                            <select name="lokasi_id" class="form-control select2" id="lokasi_id"  style="width: 100%;">
                                {{-- <option selected></option> --}}
                                <option selected disabled>--Select placement--</option>
                                    @foreach($proyek as $a )
                                        <option {{$karyawan->lokasi_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{$a->nama}} </option>
                                    @endforeach
                            </select>
                        </div>
                           <div class="form-group">
                          <div class="box direct-chat direct-chat-warning collapsed-box">
                            <div class="box-header with-border">
                              <h3 class="box-title" style="font-size: 14px;"><b>Contact History</b></h3>
            
                              <div class="box-tools pull-right">
                                <!--<span data-toggle="tooltip" title="{{$count}} kali perpanjangan kontrak" class="badge bg-yellow">{{$count}}</span>-->
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                              </div>
                          </div>
                            <div class="box-body">
                              <table class="text-muted">
                              @foreach($kontrakkaryawan as $a)
                              <tr>
                                  @if($a->perpanjangan_ke == 0)
                                      <td><b><span class='label label-success' style="font-size: 12px;">*Permanent</span></b></td>
                                  @else
                                      <td><b><span class='label label-danger' style="font-size: 12px;">* Contract - {{$a->perpanjangan_ke}} &nbsp;</b></td>
                                      
                                  @endif
                              </tr>
                              <tr>
                                  <td>Start Date &nbsp;</td>
                                  <td> : &nbsp; {{ date('d-M-Y', strtotime($a->tgl_mulai_kontrak)) }}</td>
                              </tr>
                              <tr>
                                  <td>End Date &nbsp;</td>
                                  <td> : &nbsp; {{ date('d-M-Y', strtotime($a->tgl_akhir_kontrak)) }}</td>
                              </tr>
                              @endforeach
                          </table>
                            </div>
                          </div>
                  </div>
                  
                        <div class="form-group">
                          <label for="status">Employment Status</label>
                          <input type="text" class="form-control"  value="{{$karyawan->status_karyawan == 0 ? 'Kontrak' : 'Permanent'}}" readonly style="background: white">
                      </div>
                      
                      
                      <!--@if($karyawan->status_vaksinasi == 0)-->
                      <!--      <div class="form-group">-->
                      <!--          <label for="status_vaksinasi">Status Vaksinasi</label>-->
                      <!--          <input type="text" class="form-control" id="status_vaksinasi" name="status_vaksinasi" value="{{$karyawan->status_vaksinasi == '0' ? "Belum Vaksin" : "Sudah Vaksin" }}" style="background-color:white !important;" readonly>-->
                      <!--      </div>-->
                      <!--      <div class="form-group">-->
                      <!--          <label for="status_vaksinasi">Ubah Status Vaksinasi</label>-->
                      <!--          <select name="status_vaksinasi" id="status_vaksinasi" class="form-control select2" style="width:100%">-->
                      <!--            <option selected disabled>--Pilih Status Vaksinasi--</option>-->
                      <!--              <option value="0" {{$karyawan->status_vaksinasi == '0' ? 'selected' : ''  }}>Belum Vaksin</option>-->
                      <!--              <option value="1" {{$karyawan->status_vaksinasi == '1' ? 'selected' : ''  }}>Sudah Vaksin</option>-->
                      <!--          </select>-->
                      <!--      </div>-->
                      <!--      @else -->
                      <!--      <div class="form-group">-->
                      <!--          <label for="status_vaksinasi">Status Vaksinasi</label>-->
                      <!--          <input type="text" class="form-control" value="{{$karyawan->status_vaksinasi == '0' ? "Belum Vaksin" : "Sudah Vaksin" }}" style="background-color:white !important;" readonly>-->
                      <!--      </div>-->
                      <!--  @endif-->
                    
                     <div class="form-group">
                          <label for="roles">Report To</label>
                          <input  type="text" class="form-control"  value="{{$karyawan->report_to}}" readonly style="background: white">
                      </div>
                      
                    @if($vaksinasi == 0 && $karyawan->status_vaksinasi == 1)
                    <div class="form-group">
                        <label for="status">Vaccine Status</label>
                        <input  type="text" class="form-control bg-input-form"  value="Silahkan upload file vaksin" readonly>
                     </div>
                    @else
                       <div class="form-group">
                            <label for="status">Vaccine Status</label>
                            <input  type="text" class="form-control bg-input-form"  value="Sudah Vaksin" readonly>
                       </div>
                    @endif
                      
                      <!--  <div class="form-group">-->
                      <!--    <label for="roles">Roles</label>-->
                      <!--    <input  type="text" class="form-control"  value="{{$karyawan->user_login->role->name}}" readonly>-->
                      <!--</div>-->

                     
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url('/') }}" class="btn btn-danger">Cancel</a>
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
                url: "{{url('get-jabatan-divisi_/store')}}",
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
