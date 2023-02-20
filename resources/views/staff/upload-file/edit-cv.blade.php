@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Edit File CV</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-10 col-lg-10">
                    <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{route('update-cv',$cv->id)}}">
                    @method('PATCH') 
                    {{csrf_field()}}  
                      <div class="form-group">
                        {{-- <label for="type">File CV</label> --}}
                        <input type="hidden" name="nik" id="nik" value="{{Auth::user()->username}}">
                        <input type="file" name="file_cv" id="file_cv" class="form-control" value={{$cv->file_cv}} required>
                      </div>
                      {{-- <div class="form-group">
                        
                      </div> --}}
                      {{-- <div class="form-group">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src={{url('uploads/Karyawan/'.$cv->nik.'/'.'CV'.'/'.$cv->file_cv)}} id="preview_cv" name="preview_cv" width="100%" height="100%">
                        </iframe>
                        </div>
                      </div> --}}

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
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>

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
