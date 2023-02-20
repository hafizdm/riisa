@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Edit Work Experience</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-6 col-lg-6">
                    <form role="form" name="formdata" method="post" action="{{route('update-pengalaman',$pengalaman->id)}}">
                    @method('PATCH') 
                    {{csrf_field()}}  
                        <div class="form-group">
                            <label for="type">Company's name</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Enter company's name (Example: PT. ABC)" value="{{$pengalaman->nama_perusahaan}}" >
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_mulai">Start Date</label>
                        <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{$pengalaman->tgl_mulai}}">
                        </div>

                        <div class="form-group">
                            <label for="tgl_selesai">End Date</label>
                            <input type="text" autocomplete="off"  data-provide="datepicker" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{$pengalaman->tgl_selesai}}">
                        </div>

                        <div class="form-group">
                            <label for="posisi">Position</label>
                            <input type="text" class="form-control" id="posisi" name="posisi" value="{{$pengalaman->posisi}}" placeholder="Enter a position (Example: Bussiness Development)">
                        </div>

                        <!--<div class="form-group">-->
                        <!--    <label for="gaji">Gaji</label>-->
                        <!--    <input type="text" class="form-control" id="gaji" name="gaji" value="{{$pengalaman->gaji}}">-->
                        
                        <!--</div>-->
                       
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url("pengalaman")}}" class="btn btn-danger">Cancel</a>
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
