@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>Tambah Jabatan</b>
    </span>
      <ol class="breadcrumb">
        <li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url("jabatan")}}">Jabatan</a></li>
        <li class="active"><a href="#">Tambah</a></li>
      </ol>
    </section>
	<br>
	<div class="container">
        <div class="row">
                <div class="col-lg-6">
					<form role="form" name="formdata" method="post" action="{{url("jabatan/store")}}">
						@csrf  
                       
						<div class="form-group">
							<label for="nama">Masukan Nama Jabatan</label>
							<input type="text" class="form-control" name="jenis_jabatan" id="jenis_jabatan" value="{{old("jenis_jabatan")}}" placeholder="Masukan Nama Jabatan" required>
							<span class="help-block" >{{ $errors->first('jenis_jabatan') }} </span>  
            </div>
            <div class="form-group">
              <label for="divisi_id">Divisi/Departemen</label>
              <select name="divisi_id" type="text" class="form-control" id="divisi_id"  style="width: 100%;" required>
                  <option selected disabled>--Pilih Divisi--</option>
                  @foreach($divisi as $a )
                  <option value="{{ $a->id }}">{{ $a->nama }}</option>
                  @endforeach
              </select>
             </div>
             <div class="form-group">
							<label for="nama">Eat Perday Domestic</label>
							<input type="number" class="form-control" name="eat_per_day_domestic" id="eat_per_day_domestic" value="{{old("eat_per_day_domestic")}}" placeholder="Masukan Eat Per Day" required>
							<span class="help-block" >{{ $errors->first('eat_per_day_domestic') }} </span>  
            </div>
            <div class="form-group">
							<label for="nama">Eat Perday International</label>
							<input type="number" class="form-control" name="eat_per_day_international" id="eat_per_day_international" value="{{old("eat_per_day_international")}}" placeholder="Masukan Eat Per Day" required>
							<span class="help-block" >{{ $errors->first('eat_per_day_international') }} </span>  
            </div>
            <div class="form-group">
							<label for="nama">Allowance Perday Domestic</label>
							<input type="number" class="form-control" name="allowance_per_day_domestic" id="allowance_per_day_domestic" value="{{old("allowance_per_day_domestic")}}" placeholder="Masukan Allowance Per Day" required>
							<span class="help-block" >{{ $errors->first('allowance_per_day_domestic') }} </span>  
            </div>
            <div class="form-group">
							<label for="nama">Allowance Perday International</label>
							<input type="number" class="form-control" name="allowance_per_day_international" id="allowance_per_day_international" value="{{old("allowance_per_day_international")}}" placeholder="Masukan Allowance Per Day" required>
							<span class="help-block" >{{ $errors->first('allowance_per_day_international') }} </span>  
            </div>
						  {{-- <div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" class="form-control" name="keterangan" id="keterangan" value="{{old("keterangan")}}" placeholder="Keterangan" required>
						  </div> --}}

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

