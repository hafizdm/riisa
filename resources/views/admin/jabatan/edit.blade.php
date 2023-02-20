@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
		<span class="fonts header-style">
			<b>Edit Data Jabatan</b>
		</span>
      <ol class="breadcrumb">
        <li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url("jabatan")}}">Jabatan</a></li>
        <li class="active"><a href="#">Edit Data Jabatan</a></li>
      </ol>
    </section>
	<br>
	<div class="container">         
	  <div class="row">
			  <div class="col-lg-6">
				  
				<form role="form" method="post" action="{{route('updatejabatan', $jabatan->id)}}">
					@method('PATCH') 
				@csrf
					<div class="form-group">
						<label for="nama">Masukan Nama Jabatan</label>
						<input type="text" class="form-control" name="jenis_jabatan" id="jenis_jabatan" value="{{$jabatan->jenis_jabatan}}" placeholder="Masukan nama jabatan">
						<span class="help-block" >{{ $errors->first('jenis_jabatan') }} </span>
				  </div>
				  
				  <div class="form-group">
					<label for="divisi_id">Divisi</label>
					<select name="divisi_id" type="text" class="form-control select2" id="divisi_id" style="width: 100%;" required>
						<option selected disabled>--Pilih Divisi--</option>
						@foreach($divisi as $a )
							<option {{$jabatan->divisi_id == $a->id ? 'selected' : ''}} value="{{$a->id}}"> {{ $a->nama }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="nama">Masukan Eat Perday Domestic (Rp)</label>
					<input type="number" class="form-control" name="eat_per_day_domestic" id="eat_per_day_domestic" value="{{$jabatan->eat_per_day_domestic}}" placeholder="Masukan eat perday">
					<span class="help-block" >{{ $errors->first('eat_per_day_domestic') }} </span>
			  </div>
			  <div class="form-group">
					<label for="nama">Masukan Eat Perday International ($)</label>
					<input type="number" class="form-control" name="eat_per_day_international" id="eat_per_day_international" value="{{$jabatan->eat_per_day_international}}" placeholder="Masukan eat perday">
					<span class="help-block" >{{ $errors->first('eat_per_day_international') }} </span>
			  </div>
			  <div class="form-group">
				<label for="nama">Masukan Allowance Perday Domestic (Rp)</label>
				<input type="number" class="form-control" name="allowance_per_day_domestic" id="allowance_per_day_domestic" value="{{$jabatan->allowance_per_day_domestic}}" placeholder="Masukan Allowance perday">
				<span class="help-block" >{{ $errors->first('allowance_per_day_domestic') }} </span>
		      </div>
			  <div class="form-group">
				<label for="nama">Masukan Allowance International ($)</label>
				<input type="number" class="form-control" name="allowance_per_day_international" id="allowance_per_day_international" value="{{$jabatan->allowance_per_day_international}}" placeholder="Masukan Allowance perday">
				<span class="help-block" >{{ $errors->first('allowance_per_day_international') }} </span>
		  </div>
			  

	              {{-- <div class="form-group">
	                <label for="keterangan">Keterangan</label>
	                <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="{{$jabatan->keterangan}}">
	              </div> --}}
					  <button type="submit" class="btn btn-primary">Simpan</button>
					  <a href="{{url('jabatan')}}" class="btn btn-danger">Batal</a>
				
			  </form>
			  </div>
		  </div>
  </div>  
  <!-- Main content -->
  <section class="content">
   
  @endsection
  
    <!-- Main content -->
    {{-- <section class="content">
    	<div class="row">

	      <div class="col-lg-12">

	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Edit Jabatan</h3>
	          </div>
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" method="post" action="{{route('updatejabatan', $jabatan->id)}}">
	          	@method('PATCH') 
              @csrf
				  <div class="form-group">
	                <label for="nama">Masukan jenis Jabatan</label>
					<input type="text" class="form-control" name="jenis_jabatan" id="jenis_jabatan" value="{{$jabatan->jenis_jabatan}}" placeholder="Masukan jenis jabatan">
					<span class="help-block" >{{ $errors->first('jenis_jabatan') }} </span>
	              </div>
	              <div class="form-group">
	                <label for="keterangan">Keterangan</label>
	                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">{{$jabatan->keterangan}}</textarea>
	              </div>
	              
	         </div>
	            <!-- /.box-body -->

	            <div class="box-footer">
	              <a href="{{url("jabatan")}}" class="btn btn-danger">Cancel</a>
	              <button type="submit" name="submit" class="btn btn-success pull-right">Update</button>
	            </div>
	          </form>
	        </div>
	        <!-- /.box -->

	      </div>

	    </div>
    </section> --}}
    <!-- /.content -->
{{-- @endsection --}}

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