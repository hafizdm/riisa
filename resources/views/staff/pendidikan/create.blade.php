@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Add Education</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-6 col-lg-6">
                    <form role="form" name="formdata" method="post" action="{{url("pendidikan/store")}}">
                    @csrf
                        
                        <div class="form-group">
                            <label for="type">Institution's name</label>
                            <input type="text" class="form-control" id="nama_institusi" name="nama_institusi" placeholder="Enter institution's name (example: Institut Teknologi Bandung)" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_masuk">Start Date</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="yyyy/mm/dd" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_keluar">End Date</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_keluar" name="tgl_keluar" placeholder="yyyy/mm/dd" required>
                        </div>

                        <div class="form-group">
                            <label for="posisi">Education Level</label>
                            <select class="form-control" name="jenjang_pendidikan" id="jenjang_pendidikan" type="text"  style="width: 100%;" required>
                                <option selected disabled>--Select education level--</option>
                                <option value="D3"> D3 </option>
                                <option value="D4"> D4 </option>
                                <option value="S1"> S1 </option>
                                <option value="S2"> S2 </option>
                                <option value="S3"> S3 </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Major</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Enter major (exmaple: Teknik Industri)" required>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Location</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Enter location (example: Jakarta)" required>
                        </div>
                        <div class="form-group">
                            <label for="ipk">IPK</label>
                            <input type="text" class="form-control" id="ipk" name="ipk" placeholder="Enter grade point average (IPK) (example: 4.00)">
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
