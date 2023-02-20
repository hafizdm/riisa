<?php 
    use App\KontrakKaryawan;
?>

@extends('templates.header')
@section('content')
<section class="content"> 

<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b><i class="fa fa-id-card-o"></i>&nbsp; Personal Information</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
               <div class = "row">
                  <div class="col-xs-12 col-xl-12 col-lg-12">
                      <p><h4><b>Note:</b></h4></p>
                      <p style="color:red">- Forms marked with an star(*) must be filled in</p>
                  </div>
              </div>
              <hr>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-lg-4 col-xl-4">
                    <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{route('updatekaryawan', $karyawan->id)}}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">
                        <label for="foto_karyawan">Employee's photo</label>
                        <div style="padding-bottom:10px">
                        </div>
                        @if($karyawan->foto != null)
                            <img src="{{ asset('uploads/Karyawan/')."/".$karyawan->foto}}" style="height: 100px" id="emp_foto" name="emp_foto" alt="Foto Karyawan" class="img-circle">
                        @else
                            <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" style="height: 100px" id="emp_foto" name="emp_foto" alt="Foto Karyawan" class="img-circle">
                        @endif
                      
                    </div>

                        <div class="form-group">
                            <label for="nik">NIK*</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="{{$karyawan->nik}}" required>
                            <span id="nik" class="help-block" >{{ $errors->first('nik') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="type">Full Name*</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{$karyawan->nama}}" required>
                            <!--<span id="nama" class="help-block" > {{ $errors->first('nama') }} </span>-->
                        </div>
                    
                        <div class="form-group">
                            <label for="tempat_lahir">Birth Place</label>
                            <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir"  placeholder=" "  value="{{$karyawan->tempat_lahir != '' ? $karyawan->tempat_lahir : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="date_birth">Birth Date</label>
                            <input type="date" class="form-control" id="date_birth" name="date_birth" placeholder="yyyy/mm/dd"  value="{{$karyawan->date_birth != '' ? $karyawan->date_birth : '' }}">
                        </div>

                        
                        <div class="form-group">
                            <label for="alamat">Address</label>
                            <textarea id="alamat" name="alamat" rows="4" cols="50" class="form-control">{{$karyawan->alamat}}</textarea>
                            
                        </div>
                    
                        
                </div>
                  <!-- end of bilah kiri -->
                  <!-- bilah tengah -->
                  <div class="col-xs-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="agama">Religion</label>
                        <!--<input type="text" class="form-control" id="agama" name="agama" value="{{$karyawan->agama}}">-->
                        <select name="agama" id="agama" class="form-control select2" style="width:100%">
                          <option selected disabled>--Select religion--</option>
                            <option value="islam" {{$karyawan->agama == 'islam' ? 'selected' : ''  }}>Islam</option>
                            <option value="hindu" {{$karyawan->agama == 'hindu' ? 'selected' : ''  }}>Hindu</option>
                            <option value="budha" {{$karyawan->agama == 'budha' ? 'selected' : ''  }}>Budha</option>
                            <option value="kristen" {{$karyawan->agama == 'kristen' ? 'selected' : ''  }}>Kristen</option>
                            <option value="katolik" {{$karyawan->agama == 'katolik' ? 'selected' : ''  }}>Katolik</option>
                            <option value="konghucu" {{$karyawan->agama == 'konghucu' ? 'selected' : ''  }}>Konghucu</option>
                        </select>
                        <!--<span id="agama" class="help-block" > {{ $errors->first('agama') }} </span>-->
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Gender</label>
                        <!--<input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{$karyawan->jenis_kelamin}}" readonly>-->
                        <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin" style="width: 100%;">
                        <option selected disabled>--Select gender--</option>
                        <option value="Laki-laki" {{$karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : ''  }}>Male</option>
                        <option value="Perempuan" {{$karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : ''  }}>Female</option> 
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$karyawan->email != '' ? $karyawan->email : '' }}">
                    
                    </div>
                  
                    <div class="form-group">
                        <label for="handphone">Phone Number</label>
                        <input type="text" class="form-control" id="handphone" name="handphone" value="{{$karyawan->handphone != '' ? $karyawan->handphone : ''}}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                    </div>

                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        {{-- <input type="text" class="form-control" id="npwp" name="npwp" placeholder="XX.XXX.XXX.X-XXX.XXX" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask value="{{$karyawan->npwp}}"> --}}
                        <input type="text" class="form-control" id="npwp" name="npwp" value="{{$karyawan->npwp != '' ? $karyawan->npwp : ''}}" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask/>
                    </div>

                     <div class="form-group">
                        <label for="bpjs_ketenagakerjaan">BPJS of Employment</label>
                        <input name="bpjs_ketenagakerjaan" type="text" class="form-control" id="bpjs_ketenagakerjaan"  placeholder=""  value="{{$karyawan->bpjs_ketenagakerjaan != '' ? $karyawan->bpjs_ketenagakerjaan : ''}}" data-inputmask="'mask' : ['9999999999999']" data-mask>
                    </div>
                    
                    <div class="form-group">
                        <label for="bpjs_kesehatan">BPJS of Health</label>
                        <input name="bpjs_kesehatan" type="text" class="form-control" id="bpjs_kesehatan"  placeholder=""  value="{{$karyawan->bpjs_kesehatan != '' ? $karyawan->bpjs_kesehatan : ''}}" data-inputmask="'mask' : ['9999999999999']" data-mask>
                    </div>

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

               
                    </div>
                    <div class="col-xs-12 col-lg-4 col-xl-4">
                        <!--<div class="form-group">-->
                        <!--    <label for="date_joining">Tanggal Bergabung</label>-->
                        <!--    <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="date_joining" name="date_joining" placeholder="yyyy/mm/dd" value="{{$karyawan->date_joining != '' ? $karyawan->date_joining : ''}}">-->
                        <!--</div>-->
                        
                        <div class="form-group">
                            <label for="lokasi_id">Placement*</label>
                            <select name="lokasi_id" class="form-control select2" id="lokasi_id"  style="width: 100%;" required>
                                <option selected disabled>----</option>
                                    @foreach($proyek as $a )
                                        <option {{$karyawan->lokasi_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{$a->nama}} </option>
                                    @endforeach
                            </select>
                        </div>

                        <!--<div class="form-group">-->
                        <!--    <label for="date_resign">Tanggal Keluar</label>-->
                        <!--    <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="date_resign" name="date_resign" placeholder="yyyy/mm/dd" value="{{$karyawan->date_resign != '' ? $karyawan->date_resign : ''}}">-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                        <!--    <label for="keterangan">Keterangan</label>-->
                        <!--    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"  value="{{$karyawan->keterangan != '' ? $karyawan->keterangan : ''}}" readonly>-->
                        <!--    <span id="keterangan" class="help-block" > {{ $errors->first('keterangan') }} </span>-->
                        <!--</div>-->
                        
                        <div class="form-group">
                                <div class="box direct-chat direct-chat-warning collapsed-box">
                                  <div class="box-header with-border">
                                    <h3 class="box-title" style="font-size: 14px;"><b>Contract History</b></h3>
                  
                                    <div class="box-tools pull-right">
                                      <!--<span data-toggle="tooltip" title="{{$count}} kali perpanjangan kontrak" class="badge bg-yellow">{{$count}}</span>-->
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                      </button>
                                    </div>
                                </div>
                                @if($count == 0)
                                    <div class="box-body">
                                        <span>No contract history</span>
                                    </div>
                                @else
                                  <div class="box-body">
                                        <table class="text-muted">
                                            @foreach($kontrakkaryawan as $a)
                                                    <tr>
                                                        @if($a->perpanjangan_ke == 0)
                                                            <td><b><span class='label label-success' style="font-size: 12px;">*Permanent</span></b></td>
                                        <td style="float: left;">
                                            &nbsp;&nbsp;
                                            <a href="{{url("hapus-kontrak")}}/{{$a->id}}" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                                            </td>
                                                                
                                        @else
                                            <td><b><span class='label label-danger' style="font-size: 12px;">* Contract - {{$a->perpanjangan_ke}} &nbsp;</b></td>
                                        <td style="float: left;">
                                            &nbsp;&nbsp;
                                        <a href="{{url("hapus-kontrak")}}/{{$a->id}}" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                                        </td>
                                        @endif
                                        </tr>
                                        @if($a->perpanjangan_ke == 0)
                                            <tr></tr>
                                        @else 
                                            <tr>
                                                <td>Start Date &nbsp;</td>
                                                <td> : &nbsp; 
                                                    {{ date('d-M-Y', strtotime($a->tgl_mulai_kontrak)) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>End Date &nbsp;</td>
                                                <td> : &nbsp; {{ date('d-M-Y', strtotime($a->tgl_akhir_kontrak)) }}
                                                </td>
                                            </tr>
                                        @endif
                                        @endforeach
                                        </table>
                                  </div>
                                  @endif
                                </div>
                        </div>
                        
                        <!--<div class="form-group">-->
                        <!--    <label for="status">Ubah Status Karyawan</label>-->
                        <!--    <select class="form-control select2" name="status" id="status" style="width: 100%;" onchange="getData(this.options[this.selectedIndex].value)">-->
                        <!--    <option selected disabled>--Pilih Status--</option>-->
                        <!--    <option value='0'>Kontrak</option>-->
                        <!--    <option value='1'>Permanent</option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        
                         
                            <?php 
                                $datass = KontrakKaryawan::where('nik_karyawan', $karyawan->nik)->latest()->first();
                            ?>
                            @if($datass)
                                @if($datass->perpanjangan_ke == 0)
                                 <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" value="{{$datass->perpanjangan_ke == 0 ? "Permanent" : "Kontrak" }}" style="background-color:white !important;" readonly>
                                </div>
                                @else 
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" value="{{$datass->perpanjangan_ke != 0 ? "Kontrak" : "Permanent" }}" style="background-color:white !important;" readonly>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="status">Change Employee Status*</label>
                                    <select class="form-control select2" name="status" id="status" style="width: 100%;" onchange="getData(this.options[this.selectedIndex].value)">
                                    <option selected disabled>--Select status--</option>
                                    <option value='0'>Contract</option>
                                    <option value='1'>Permanent</option>
                                    </select>
                                </div>
                                @endif
                            @else
                             <div class="form-group">
                                <label for="status">Change Employee Status*</label>
                                <select class="form-control select2" name="status" id="status" style="width: 100%;" onchange="getData(this.options[this.selectedIndex].value)">
                                <option selected disabled>--Select status--</option>
                                <option value='0'>Contract</option>
                                <option value='1'>Permanent</option>
                                </select>
                                 </div>
                            @endif
                       
                        
                        @if($count == 0)
                            <div class="form-group" id = "div3" style ="display:none">
                                <label for="date_resign">Contract Start Date*</label>
                                <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control">
                            </div>
                       @else
                            <div class="form-group" id = "div3" style ="display:none">
                                <label for="date_resign">Contract End Date*</label>
                                <input type="hidden" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?php foreach ($get_tgl as $get){ echo $get->tgl_mulai;}?>">
                                <input type="text" class="form-control" value="<?php foreach ($get_tgl as $get){ echo date('d-M-Y', strtotime($get->tgl_mulai));}?>" readonly>
                            </div>
                        @endif
                        
                        <div class="form-group" id = "div1" style ="display:none">
                            <label for="date_resign">Contract End Date*</label>
                            <input type="date" class="form-control" id="tgl_akhir_kontrak" name="tgl_akhir_kontrak" placeholder="yyyy/mm/dd">
                        </div>
                        <div class="form-group" id="div2" style ="display:none">
                            <label for="perpanjangan_ke">Contract to* </label>
                            <input name="perpanjangan_ke" type="number" class="form-control" id="perpanjangan_ke"  placeholder=" " >
                        </div>
                        
                        @if($karyawan->status_vaksinasi == 0)
                            <div class="form-group">
                                <label for="status_vaksinasi">Vaccine Status</label>
                                <input type="text" class="form-control" id="status_vaksinasi" name="status_vaksinasi" value="{{$karyawan->status_vaksinasi == '0' ? "Not vaccinated" : "Vaccinated" }}" style="background-color:white !important;" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status_vaksinasi">Change Vaccine Status</label>
                                <select name="status_vaksinasi" id="status_vaksinasi" class="form-control select2" style="width:100%">
                                  <option selected disabled>--Select vaccine status--</option>
                                    <option value="0" {{$karyawan->status_vaksinasi == '0' ? 'selected' : ''  }}>Not vaccinated</option>
                                    <option value="1" {{$karyawan->status_vaksinasi == '1' ? 'selected' : ''  }}>Vaccinated</option>
                                </select>
                            </div>
                            @else 
                            <div class="form-group">
                                <label for="status">Vaccine Status</label>
                                <input type="text" class="form-control" value="{{$karyawan->status_vaksinasi == '' ? "Not vaccinated" : "Vaccinated" }}" style="background-color:white !important;" readonly>
                            </div>
                        @endif
                        
                        
                        <div class="form-group">
                            <label for="date_resign">End Date</label>
                            <input type="date" class="form-control" id="date_resign" name="date_resign" placeholder="yyyy/mm/dd" value="{{$karyawan->date_resign != '' ? $karyawan->date_resign : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="report_to">Report To*</label>
                            <select class="form-control select2" name="report_to" id="report_to" style="width: 100%;" required>
                            <option selected disabled >Pilih Report To</option>
                            @foreach($report as $rp)
                                <option {{$rp->nama == $karyawan->report_to ? 'selected' :''}} value="{{$rp->nama}}">{{$rp->nama}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="spd_report_to">SPD Report To*</label>
                            <select class="form-control select2" name="spd_report_to" id="spd_report_to" style="width: 100%;" required>
                            <option selected disabled >Pilih SPD Report To</option>
                            @foreach($report as $rp)
                                <option {{$rp->id == $karyawan->spd_report_to ? 'selected' :''}} value="{{$rp->id}}">{{$rp->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label for="roles">Roles of Procurement*</label>
                          <select class="form-control select2" name="roles" id="roles" style="width: 100%;" required> 
                          <option selected disabled >--Select role--</option>
                          @foreach($role as $rs)
                              <option {{$karyawan->user_login->role_id == $rs->id ? 'selected' : ''}} value="{{$rs->id}}">{{$rs->name}}</option>
                          @endforeach
                          </select>
                      </div>
                      
                        <div class="form-group">
                            <label>Total Annual Leave</label>
                            <input type="number" id="sisa_cuti" name="sisa_cuti" class="form-control" value="{{$karyawan->sisa_cuti}}">
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
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b><i class="fa fa-graduation-cap"></i>&nbsp; Education</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
  @foreach($pendidikans as $p)
      <div class="row">
              <div class="col-md-6">
              <div class="box box-solid collapsed-box">
                  <div class="box-header with-border">
                      {{-- <i class="fa fa-university fa-xs"></i> --}}
                      <h3 class="box-title" style="font-size: 15px">{{$p->nama_institusi}}</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-eye"></i></button>
                      </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                  <table class="text-muted">
                      <tr>
                          <td>Start Date &nbsp;</td>
                          <td> : &nbsp; {{ date('Y', strtotime($p->tgl_masuk)) }} </td>
                      </tr>
                      <tr>
                          <td>End Date  &nbsp;</td>
                          <td> : &nbsp; {{ date('Y', strtotime($p->tgl_keluar)) }} </td>
                      </tr>
                      <tr>
                          <td>Education Level  &nbsp;</td>
                          <td>: &nbsp; {{$p->jenjang_pendidikan}}</td>
                      </tr>
                      <tr>
                          <td>Major  &nbsp;</td>
                          <td> : &nbsp; {{ $p->jurusan }} </td>
                      </tr>
                      <tr>
                          <td>Location of Institution  &nbsp;</td>
                          <td> : &nbsp; {{ $p->lokasi }} </td>
                      </tr>
                      <tr>
                          <td>IPK  &nbsp;</td>
                          <td> : &nbsp; {{ $p->ipk }} </td>
                      </tr>
                  </table>
                  </div>
                  <!-- /.box-body -->
              </div>
              </div>
          </div>
      @endforeach
            
          </div>
    </div>
 </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b><i class="fa fa-briefcase" aria-hidden="true"></i> &nbsp; Work Experience</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  @foreach($pengalamans as $ps)
                      <div class="row">
                              <div class="col-md-6">
                              <div class="box box-solid collapsed-box">
                                  <div class="box-header with-border">
                                      {{-- <i class="fa fa-building"></i> --}}
                                      <h3 class="box-title" style="font-size:16px;">{{$ps->nama_perusahaan}}</h3>
                                      <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-eye"></i></button>
                                      </div>
                                  </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                  <table class="text-muted">
                                <tr>
                                    <td>Start Date &nbsp;</td>
                                    <td> : &nbsp; {{ date('d M Y', strtotime($ps->tgl_mulai)) }} </td>
                                </tr>
                                <tr>
                                    <td>End Date  &nbsp;</td>
                                    <td> : &nbsp; {{ date('d M Y', strtotime($ps->tgl_selesai)) }} </td>
                                </tr>
                                <tr>
                                    <td>Position  &nbsp;</td>
                                    <td> : &nbsp; {{ $ps->posisi }} </td>
                                </tr>
                               
                            </table>
                                  </div>
                                  <!-- /.box-body -->
                              </div>
                              </div>
                          </div>
                      @endforeach
          </div>
      </div>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b><i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp; CV / Resume</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                      <div class="row">
                              <div class="col-md-12">
                              <div class="box box-solid">
                                  <div class="box-body">
                                    
                                        @if($karyawan->file_cv != '')
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$karyawan->nik.'/'.'CV'.'/'.$karyawan->file_cv)}}" width="100%" height="100%">
                                            </iframe>
                                            </div>
                                        @else
                                            <!--<iframe class="embed-responsive-item" width="100%" height="100%">-->
                                            <!--</iframe>-->
                                            <span>No uploaded file</span>
                                        @endif
                                    <!--</div>-->
                                </div>
                                  <!-- /.box-body -->
                              </div>
                              </div>
                          </div>
          </div>
      </div>
  </div>
</div>


<div class="row">
    <div class="col-xs-12">
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b> <i class="fa fa-paperclip" aria-hidden="true"></i> &nbsp; Certificate</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                      <div class="row">
                              <div class="col-md-12">
                              <div class="box box-solid">
                                  <div class="box-body">
                                    
                                        @if($karyawan->file_ijazah != '')
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$karyawan->nik.'/'.'Ijazah'.'/'.$karyawan->file_ijazah)}}" width="100%" height="100%">
                                            </iframe>
                                            </div>
                                        @else
                                        <span>No uploaded file</span>
                                            <!--<iframe class="embed-responsive-item" width="100%" height="100%">-->
                                            <!--</iframe>-->
                                        @endif
                                    <!--</div>-->
                                </div>
                                  <!-- /.box-body -->
                              </div>
                              </div>
                          </div>  
          </div>
      </div>
  </div>
</div>

<div class="row">
        <div class="col-xs-12">
            <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b><i class="fa fa-paperclip" aria-hidden="true"></i> &nbsp; Upload Performance Appraisal</b></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-xl-10 col-lg-10">
                                <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{url("upload-performance/store")}}">
                                    @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="nik" id="nik" value="{{$karyawan->nik}}">
                                            <input type="file" name="file_performance" id="file_performance" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{url("karyawan")}}" class="btn btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>      
                    </div>
                    <div class="box-body">
                        @foreach($performances as $p)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-solid collapsed-box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title" style="font-size:16px;">Performance &nbsp; {{$loop->iteration}}</h3>
                                            &nbsp; &nbsp; &nbsp; &nbsp; 
                                            <button class='btn btn-xs btn-danger delete' data-token="{{ csrf_token() }}" data-id="{{$p->id}}"><i class="fa fa-trash"></i></button>   
                                            &nbsp;  
                                            <button type="button" class="btn btn-xs btn-primary" data-widget="collapse"><i class="fa fa-eye"></i></button>
                                        </div>
                                        <div class="box-body">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                @if($p->file_performance != '')
                                                    <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$p->id_karyawan.'/'.'Performance'.'/'.$p->file_performance)}}" width="100%" height="100%">
                                                     </iframe>
                                                @else
                                                  <iframe class="embed-responsive-item" width="100%" height="100%">
                                                  </iframe>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b><i class="fa fa-paperclip" aria-hidden="true"></i> &nbsp; Additional Files</b></h3>
    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  @foreach($sertifikats as $p)
                      <div class="row">
                              <div class="col-md-12">
                              <div class="box box-solid collapsed-box">
                                <div class="box-header with-border">
                                    {{-- <i class="fa fa-building"></i> --}}
                                    <h3 class="box-title" style="font-size:16px;">Certificate &nbsp; {{$loop->iteration}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                                  <div class="box-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        @if($p->file_sertifikat != '')
                                            <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$p->id_karyawan.'/'.'Sertifikat'.'/'.$p->file_sertifikat)}}" width="100%" height="100%">
                                            </iframe>
                                        @else
                                            <iframe class="embed-responsive-item" width="100%" height="100%">
                                            </iframe>
                                        @endif
                                    </div>
                                </div>
                                  <!-- /.box-body -->
                              </div>
                              </div>
                          </div>
                      @endforeach
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
    
    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        confirm("Are you want to delete this data?");
        $.ajax({
            type: "delete",
            url: "{{ url('upload-performance') }}" +'/' + id +'' ,
            data: {
                "id": id,
                "_method": 'delete',
                "_token": token,
            },
            success: function (data) {
                console.log(data.message);
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
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

function getData(name){
        if(name == 0){
            document.getElementById("div1").style.display = "block";
            document.getElementById("div2").style.display = "block";
            document.getElementById("div3").style.display = "block";
        }
        else{
            document.getElementById("div1").style.display = "none";
            document.getElementById("div3").style.display = "none";
            document.getElementById("div2").style.display = "none";
            
        }
    }

</script>
@endpush
