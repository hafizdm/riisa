@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <span class="fonts header-style">
    <b>Tambah Data Proyek</b>
</span>
    <ol class="breadcrumb">
      <<li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url("proyek")}}">Lokasi Proyek</a></li>
      <li class="active"><a href="#">Tambah Data</a></li>
      
    </ol>
  </section>
      <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-6">
                <form role="form" name="formdata" method="post" action="{{url("proyek/store")}}">
                        {{csrf_field()}}   
                        
                        <div class="form-group">
                            <label for="nama"> Nama Proyek</label>
                            <input name="nama" type="text" class="form-control" id="nama" placeholder="Masukan Nama Proyek">
                            <span class="help-block" >{{ $errors->first('nama') }} </span>
                        </div>
                        
                         <div class="form-group">
                            <label for="code_loc">Kode Proyek</label>
                            <input name="code_loc" type="text" class="form-control" id="code_loc" placeholder="Masukan Kode Proyek">
                            <span class="help-block" >{{ $errors->first('lokasi') }} </span>
                        </div>
                        
                        <div class="form-group">
                            <label for="lokasi">Lokasi Proyek</label>
                            <input name="lokasi" type="text" class="form-control" id="lokasi" placeholder="Masukan Lokasi Proyek">
                            <span class="help-block" >{{ $errors->first('lokasi') }} </span>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
	                      <a href="{{url("proyek")}}" class="btn btn-danger">Batal</a>
	              
                </form>
                </div>
            </div>
    </div>  
    <!-- Main content -->
    <section class="content">
     
    @endsection
    @push('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript" >
function reset(){
    $('.select2').val(null).trigger('change');
}

//Initialize Select2 Elements
$('.select2').select2()

</script>
@endpush

   
