@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>Tambah Data Posisi-Jabatan</b>
    </span>
      <ol class="breadcrumb">
        <li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url("posisi-jabatan")}}">Posisi-Jabatan</a></li>
        <li class="active"><a href="#">Tambah Data</a></li>
      </ol>
    </section>
	<br>
	<div class="container">
        <div class="row">
                <div class="col-lg-6">
					<form role="form" name="formdata" method="post" action="{{url("posisi-jabatan/store")}}">
						@csrf  
                       
						<div class="form-group">
							<label for="nama">Pilih Jabatan</label>
							<select name="jabatan_id" type="text" class="form-control" id="jabatan_id"  style="width: 100%;" required>
                                <option selected disabled>--Pilih Jabatan--</option>
                                    @foreach($jabatan as $a )
                                    <option value="{{ $a->id }}">{{ $a->jenis_jabatan }}</option>
                                    @endforeach
              </select>
						</div>
						  <div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" class="form-control" name="keterangan" id="keterangan" value="{{old("keterangan")}}" placeholder="Keterangan" required>
						  </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
	                     <a href="{{url('jabatan')}}" class="btn btn-danger">Batal</a>
	              
                </form>
                </div>
            </div>
    </div>  
	<section class="content">
     
	@endsection
   

@push('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script type="text/javascript" >

      // fungsi reset all form
function reset(){
    $('.select2').val(null).trigger('change');
}

//Initialize Select2 Elements
$('.select2').select2()

$('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
      autoclose: true
    })
    </script>
@endpush

