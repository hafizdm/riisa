{{-- <div class="modal fade"  id="uploadFormCuti" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><h4 class="modal-title fonts" id="exampleModalLabel"><b>Upload File Scan
        </div>
        
        <div class="modal-body">
          <form id="form" role="form" name="formdata" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <label class="fonts">File*</label>
                    <input type="hidden" name="ids" id="ids" value="" class="form-control">
                    <input type="file" name="edit_file_scan" id="edit_file_scan" class="form-control" value="" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" id="btnUpload">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
    </div>
  </div> --}}

@extends('templates.header')

@section('content')
<style>
  .box {
  position: relative;
  background: #ffffff;
  width: 100%;
}
.box-header {
  color: #444;
  display: block;
  padding: 10px;
  position: relative;
  border-bottom: 1px solid #f4f4f4;
  margin-bottom: 10px;
}
.box-tools {
  position: absolute;
  right: 10px;
  top: 5px;
}
    .dropzone-wrapper {
    border: 2px dashed #91b0b3;
    color: #92b0b3;
    position: relative;
    height: 250px;
  }
  .dropzone-desc {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    text-align: center;
    width: 40%;
    top: 50px;
    font-size: 16px;
  }
  .dropzone,
  .dropzone:focus {
    position: absolute;
    outline: none !important;
    width: 100%;
    height: 150px;
    cursor: pointer;
    opacity: 0;
  }
  .dropzone-wrapper:hover,
  .dropzone-wrapper.dragover {
    background: #ecf0f5;
  }
  .preview-zone {
    text-align: center;
  }
  .preview-zone .box {
    box-shadow: none;
    border-radius: 0;
    margin-bottom: 0;
  }

</style>


<section class="content"> 
<div class="row">
  <div class="col-xs-12 col-xs-12 col-xl-12 col-lg-12 col-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title fonts"><b>Form Upload File</b></h4>
      </div>
      <div class="box-body">
        <div id="notif" ></div>
        <!-- form karyawan -->
        <div class="row">
            <!-- bilah kiri -->
          <div class="col-xs-12 col-xl-12 col-lg-12 col-12">
            <form role="form" name="formdata" method="post" action="{{route('updateUpload', $cuti->id)}}" enctype="multipart/form-data">
              @method('PATCH') 
              @csrf  
               <div class="form-group">
               <label for="keterangan">File*</label>
               <input type="hidden" class="form-control" name="ids" id="ids" value="{{$cuti->id}}">
               {{-- <input type="file" class="form-control" name="file_scan" id="file_scan" required>
               </div> --}}
   
               <div class="preview-zone hidden">
                 <div class="box box-solid">
                  <div class="box-header with-border">
                   <div><b>Preview</b></div>
                   <div class="box-tools pull-right">
                    <button type="button" class="btn btn-danger btn-xs remove-preview">
                     <i class="fa fa-times"></i> Reset This Form
                    </button>
                   </div>
                  </div>
                  <div class="box-body"></div>
                 </div>
                </div>
   
               <div class="dropzone-wrapper">
                 <div class="dropzone-desc">
                  <i class="glyphicon glyphicon-download-alt"></i>
                  <p>Choose an image file or drag it here.</p>
                 </div>
                 <input type="file" name="file_scan" id="file_scan" class="dropzone form-control" >
                </div>
   
                <br>
               </br>
             <button type="submit" class="btn btn-primary">Save</button>
             <a href="{{url('pengajuan-cuti')}}" class="btn btn-danger">Cancel</a>
           
         </form>
          </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>

@endsection

@push('script')
    <script>
      function readFile(input) {
 if (input.files && input.files[0]) {
 var reader = new FileReader();
 
 reader.onload = function (e) {
 var htmlPreview = 
 '<img width="200" src="' + e.target.result + '" />'+
 '<p>' + input.files[0].name + '</p>';
 var wrapperZone = $(input).parent();
 var previewZone = $(input).parent().parent().find('.preview-zone');
 var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');
 
 wrapperZone.removeClass('dragover');
 previewZone.removeClass('hidden');
 boxZone.empty();
 boxZone.append(htmlPreview);
 };
 
 reader.readAsDataURL(input.files[0]);
 }
}
function reset(e) {
 e.wrap('<form>').closest('form').get(0).reset();
 e.unwrap();
}
$(".dropzone").change(function(){
 readFile(this);
});
$('.dropzone-wrapper').on('dragover', function(e) {
 e.preventDefault();
 e.stopPropagation();
 $(this).addClass('dragover');
});
$('.dropzone-wrapper').on('dragleave', function(e) {
 e.preventDefault();
 e.stopPropagation();
 $(this).removeClass('dragover');
});
$('.remove-preview').on('click', function() {
 var boxZone = $(this).parents('.preview-zone').find('.box-body');
 var previewZone = $(this).parents('.preview-zone');
 var dropzone = $(this).parents('.form-group').find('.dropzone');
 boxZone.empty();
 previewZone.addClass('hidden');
 reset(dropzone);
});
      </script>
@endpush

   
