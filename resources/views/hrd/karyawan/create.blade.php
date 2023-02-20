@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Add Employee</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class = "row">
                  <div class="col-xs-12 col-xl-12 col-lg-12">
                      <p><h4><b>Note:</b></h4></p>
                      <p style="color:red">- Forms marked with an star(*) must be filled in</p>
                  </div>
              </div>
              <hr>
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-4 col-lg-4">
                    <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{url("karyawan/store")}}">
                    @csrf
                    <div class="form-group">
                        <label for="nik">NIK*</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="(HO/PRO)01234567891" maxlength="16" required>  
                        <span id="nik" class="help-block" >{{ $errors->first('nik') }}</span>
                    </div>

                        <div class="form-group">
                            <label for="type">Full Name*</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                            <span id="nama" class="help-block" > {{ $errors->first('nama') }} </span>
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir">Birth Place</label>
                            <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir">
                            <span class="help-block" >{{ $errors->first('insurance_claim') }} </span>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_birth">Birth Date</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="date_birth" name="date_birth" placeholder="yyyy/mm/dd">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Address</label>
                            <textarea id="alamat" name="alamat" rows="4" cols="50" class="form-control"></textarea>
                            <span id="stnk_no" class="help-block" > {{ $errors->first('alamat') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="agama">Religion</label>
                            <select class="form-control select2" name="agama" id="agama" style="width: 100%;">
                                <option selected disabled >--Select religion--</option>
                                <option value="islam">Islam</option>
                                <option value="hindu">Hindu</option>
                                <option value="budha">Budha</option>
                                <option value="kristen">Kristen</option>
                                <option value="katolik">Katolik</option>
                                <option value="konghucu">Kong Hu Cu</option>
                            </select>
                            <span id="agama" class="help-block" > {{ $errors->first('agama') }} </span>
                        </div>
                </div>
                  <!-- end of bilah kiri -->
                  <!-- bilah tengah -->
                  <div class="col-xs-12 col-xl-4 col-lg-4">
                    <div class="form-group">
                        <label for="jenis_kelamin">Gender</label>
                        <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin" style="width: 100%;">
                        <option selected disabled >--Select gender--</option>
                        <option value='laki'>Male</option>
                        <option value='wanita'>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="nama@mail.com" required>
                        <span id="email" class="help-block" > {{ $errors->first('email') }} </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="handphone">Phone Number</label>
                        <input type="text" class="form-control" id="handphone" name="handphone" placeholder="08123xxxxx" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        <span id="handphone" class="help-block" > {{ $errors->first('handphone') }} </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp" placeholder="XX.XXX.XXX.X-XXX.XXX" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask>
                        <span id="npwp" class="help-block" > {{ $errors->first('npwp') }} </span>
                    </div>
                    
                      <div class="form-group">
                        <label for="bpjs_ketenagakerjaan">BPJS of Employment</label>
                        <input name="bpjs_ketenagakerjaan" type="text" class="form-control" id="bpjs_ketenagakerjaan" placeholder="012345678912" data-inputmask="'mask' : ['9999999999999']" data-mask>
                        <span class="help-block" >{{ $errors->first('bpjs_ketenagakerjaan') }} </span>
                    </div>
                    <div class="form-group">
                        <label for="bpjs_kesehatan">BPJS of Health</label>
                        <input name="bpjs_kesehatan" type="text" class="form-control" id="bpjs_kesehatan" placeholder="012345678912" data-inputmask="'mask' : ['9999999999999']" data-mask>
                        <span class="help-block" >{{ $errors->first('bpjs_kesehatan') }} </span>
                    </div>

                    <div class="form-group">
                        <label for="divisi">Division*</label>
                        <select name="divisi_id" class="form-control select2" id="divisi_id"  style="width: 100%;" onchange="getState()" required>
                            <option selected disabled >--Select division--</option>
                            @foreach($dd as $a )
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                        <div class="form-group">
                            <label for="jabatan_id">Position*</label>
                            <select class="form-control select2" name="jabatan_id"  id="jabatan_id"  style="width: 100%;" required>
                
                                <option selected disabled>--Select position--</option>
                                {{-- @foreach($jj as $jb )
                                    <option value="{{ $jb->id }}">{{ $jb->jenis_jabatan }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-xl-4 col-lg-4">
                        <div class="form-group">
                            <label for="lokasi_id">Placement*</label>
                            <select class="form-control select2" name="lokasi_id" id="lokasi_id" style="width: 100%;" required>
                            <option selected disabled >--Select placement--</option>
                            @foreach($proyek as $pr)
                                <option value="{{$pr->id}}">{{$pr->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                     
                    <!--<div class="col-xs-12 col-xl-4 col-lg-4">-->
                    <!--    <div class="form-group">-->
                    <!--        <label for="date_joining">Tanggal Bergabung</label>-->
                    <!--        <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="date_joining" name="date_joining" placeholder="yyyy/mm/dd" >-->
                    <!--    </div>-->
                    
                    <div class="form-group">
                        <label for="agama">Vaccine Status*</label>
                        <select class="form-control select2" name="status_vaksinasi" id="status_vaksinasi" style="width: 100%;" required>
                            <option selected disabled >--Select vaccine status--</option>
                            <option value="0">Not vaccinated</option>
                            <option value="1">Vaccinated</option>
                        </select>
                        <span id="status_vaksinasi" class="help-block" > {{ $errors->first('status_vaksinasi') }} </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Employee Status*</label>
                        <select class="form-control select2" name="status" id="status" style="width: 100%;" onchange="getKontrak(this.options[this.selectedIndex].value)" required>
                        <option selected disabled >--Select status--</option>
                        <option value = "0">Contract</option>
                        <option value = "1">Permanent</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="div1" style="display: none">
                            <label for="tgl_mulai_kontrak">Contract Start Date*</label>
                            <input class="form-control" type="date" id="tgl_mulai_kontrak" name="tgl_mulai_kontrak">
                    </div>
                    
                    <div class="form-group" id="div2" style="display: none">
                            <label for="tgl_mulai_kontrak">Contract End Date*</label>
                            <input class="form-control" type="date" id="tgl_akhir_kontrak" name="tgl_akhir_kontrak">
                    </div>
                    
                    <div class="form-group" id="div3" style="display: none">
                            <label for="date_joining">Start Date</label>
                            <input type="date" class="form-control" id="date_joining" name="date_joining" >
                    </div>
                        
                        <!--<div class="form-group">-->
                        <!--    <label for="keterangan">Keterangan</label>-->
                        <!--    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" >-->
                        <!--    <span id="keterangan" class="help-block" > {{ $errors->first('keterangan') }} </span>-->
                        <!--</div>-->
                    <div class="form-group">
                            <label for="date_resign">End Date</label>
                            <input type="date" class="form-control" id="date_resign" name="date_resign">
                    </div>
                    
                    <div class="form-group">
                        <label for="report_to">Report To*</label>
                        <select class="form-control select2" name="report_to" id="report_to" style="width: 100%;" required>
                        <option selected disabled >--Select report to--</option>
                        @foreach($report as $rp)
                            <option value="{{$rp->nama}}">{{$rp->nama}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="spd_report_to">SPD Report To*</label>
                        <select class="form-control select2" name="spd_report_to" id="spd_report_to" style="width: 100%;" required>
                        <option selected disabled >--Select SPD report to--</option>
                        @foreach($report as $rp)
                            <option value="{{$rp->id}}">{{$rp->nama}}</option>
                        @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="role">Roles of Procurement*</label>
                        <select class="form-control select2" name="roles" id="roles" style="width: 100%;" required> 
                        <option selected disabled >--Select role--</option>
                        @foreach($role as $rs)
                            <option value="{{$rs->id}}">{{$rs->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto_karyawan">Upload Photo</label>
                        <div style="padding-bottom:10px">
                        </div>
                        
                        <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" style="height: 100px" id="emp_foto" name="emp_foto" alt="Foto Karyawan" class="img-circle">
                     
                        <div style="padding-bottom:10px">
                        </div>
                        <input type="file" name="foto" id="foto" class="form-control">
                        <div class="invalid-feedback">
                        {{ $errors->first('upload_tba') }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Total Annual Leave</label>
                        <input type="number" id="sisa_cuti" name="sisa_cuti" class="form-control" value="0">
                    </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url("karyawan")}}" class="btn btn-danger">Cancel</a>
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
                            $("#jabatan_id").append('<option value="'+row.id+'">'+row.jenis_jabatan+'</option>');
                            console.log('jabatan_id>>>', row.id);
                            console.log('nama>>>', row.jenis_jabatan);
                        });
                    }
                });
            }
    }

    $(document).ready(function(){
        $('[data-mask]').inputmask();
        $('#foto').change(function(){
            preview_foto(this);
        });
    
    });

    function reset(){
        $('.select2').val(null).trigger('change');
    }

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

    function getKontrak(name){
        if(name == 0){
             document.getElementById("div1").style.display = "block";
             document.getElementById("div2").style.display = "block";
             document.getElementById("div3").style.display = "none";
            }
        else{
                document.getElementById("div1").style.display = "none";
                document.getElementById("div2").style.display = "none";
                document.getElementById("div3").style.display = "block";
            }
    }
    
</script>
@endpush
