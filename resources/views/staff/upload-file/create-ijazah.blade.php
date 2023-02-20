@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title fonts"><b>Upload File Ijazah</b></h4>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-10 col-lg-10">
                    <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{url("upload-ijazah/store")}}">
                    @csrf
                        
                        <div class="form-group">
                            <input type="hidden" name="nik" id="nik" value="{{Auth::user()->username}}">
                            <input type="file" name="file_ijazah" id="file_ijazah" class="form-control" require>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{url("upload-file")}}" class="btn btn-danger">Batal</a>
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
