@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <span class="fonts header-style">
    <b>Tambah Data Cost Code</b>
</span>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('kategoribarang')}}">Cost Code</a></li>
      <li class="active"><a href="#">Tambah Data</a></li>
      
    </ol>
  </section>
      <br>
    <div class="container">
            
        <div class="row">
                <div class="col-lg-10">
                <form role="form" name="formdata" method="post" action="{{url("kategoribarang/store")}}">
                        {{csrf_field()}}   
                        
                        
                        <div class="form-group">
                            <label for="kode_kategori"> Cost Code </label>
                            <input name="kode_kategori" type="text" class="form-control" id="kode_kategori" value="{{old("kode_kategori")}}" placeholder="Masukan Kode kategori">
                            <span class="help-block" >{{ $errors->first('kode_kategori') }} </span>
                        </div>

                        <div class="form-group">
                          <label for="nama_kategori"> Keterangan</label>
                          <input name="nama_kategori" type="text" class="form-control" id="nama_kategori" value="{{old("nama_kategori")}}" placeholder="Masukan Nama kategori">
                          <span class="help-block" >{{ $errors->first('nama_kategori') }} </span>
                      </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
	                      <a href="{{url("kategoribarang")}}" class="btn btn-danger">Batal</a>
	              
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

   
