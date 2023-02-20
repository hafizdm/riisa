@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <span class="fonts header-style">
    <b>Tambah Data Lokasi Proyek</b>
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
                <form role="form" name="formdata" method="post" action="{{route('updateproyek', $lokasi_project->id)}}">
                @method('PATCH') 
                @csrf
                        <div class="form-group">
                            <label for="nama">Masukan Nama Proyek</label>
                            <input name="nama" type="text" class="form-control" id="nama" value="{{$lokasi_project->nama}}" placeholder="Masukan Nama Proyek">
                            <span class="help-block" >{{ $errors->first('nama') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="code_loc">Masukan Kode Proyek </label>
                            <input name="code_loc" type="text" class="form-control" id="code_loc" value="{{$lokasi_project->code_loc}}" placeholder="Masukan Kode Proyek">
                            <span class="help-block" >{{ $errors->first('code_loc') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Masukan Lokasi Proyek </label>
                            <input name="lokasi" type="text" class="form-control" id="lokasi" value="{{$lokasi_project->lokasi}}" placeholder="Masukan Lokasi Proyek">
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

   
