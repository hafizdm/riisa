@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Edit Education</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-6 col-lg-6">
                    <form role="form" name="formdata" method="post" action="{{route('update-pendidikan',$pendidikan->id)}}">
                    @method('PATCH') 
                    {{csrf_field()}}  
                        <div class="form-group">
                            <label for="type">Institution's name</label>
                        <input type="text" class="form-control" id="nama_institusi" name="nama_institusi" value="{{$pendidikan->nama_institusi}}" placeholder="Enter institution name (example: Institut Teknologi Bandung)">
                         
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_masuk">Start Date</label>
                        <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_masuk" name="tgl_masuk" value="{{$pendidikan->tgl_masuk}}">
                        </div>

                        <div class="form-group">
                            <label for="tgl_keluar">End Date</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_keluar" name="tgl_keluar" value="{{$pendidikan->tgl_keluar}}">
                        </div>

                        <div class="form-group">
                            <label for="jenjang_pendidikan">Education Level</label>
                            <select name="jenjang_pendidikan" id="jenjang_pendidikan" class="form-control select2">
                                <option selected disabled>--Select education level--</option>
                                <option value="D3" {{$pendidikan->jenjang_pendidikan == 'D3' ? 'selected' : ''  }}>D3</option>
                                <option value="D4" {{$pendidikan->jenjang_pendidikan == 'D4' ? 'selected' : ''  }}>D4</option>
                                <option value="S1" {{$pendidikan->jenjang_pendidikan == 'S1' ? 'selected' : ''  }}>S1</option>
                                <option value="S2" {{$pendidikan->jenjang_pendidikan == 'S2' ? 'selected' : ''  }}>S2</option>
                                <option value="S3" {{$pendidikan->jenjang_pendidikan == 'S3' ? 'selected' : ''  }}>S3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Major</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{$pendidikan->jurusan}}" placeholder="Enter major (example: Teknik Industri)">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Location</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{$pendidikan->lokasi}}" placeholder="Enter location (example: Jakarta)">
                        </div>

                        <div class="form-group">
                            <label for="ipk">IPK</label>
                            <input type="text" class="form-control" id="ipk" name="ipk" value="{{$pendidikan->ipk}}" placeholder="Enter grade point average(IPK) (example: 4.00)">
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url("pendidikan")}}" class="btn btn-danger">Cancel</a>
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

<script type="text/javascript" >
function reset(){
    $('.select2').val(null).trigger('change');
}

//Initialize Select2 Elements
$('.select2').select2()

$('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
      autoclose: true
})
@endpush
