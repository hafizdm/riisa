@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <<span class="fonts header-style">
      <b>Edit Data Cost Code</b>
  </span>>
    <ol class="breadcrumb">
      <<li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('kategoribarang')}}">Cost Code</a></li>
      <li class="active"><a href="#">Tambah Data</a></li>
      
    </ol>
  </section>
      <br>
    <div class="container">
            
        <div class="row">
                <div class="col-lg-6">
                
                <form role="form" name="formdata" method="post" action="{{route('updatekategori', $kategoribarang->id)}}">

                @method('PATCH') 
                @csrf
                          <div class="form-group">
                            <label for="kode_kategori">Cost Code</label>
                            <input name="kode_kategori" type="text" class="form-control" id="kode_kategori" value="{{$kategoribarang->kode_kategori}}" placeholder="Masukan Cost Code">
                            <span class="help-block" >{{ $errors->first('kode_kategori') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="nama_kategori">Keterangan</label>
                            <input name="nama_kategori" type="text" class="form-control" id="nama_kategori" value="{{$kategoribarang->nama_kategori}}" placeholder="Masukan Keterangan">
                            <span class="help-block" >{{ $errors->first('nama_kategori') }} </span>
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Simpan</button>
	                      <a href="{{url('kategoribarang')}}" class="btn btn-danger">Batal</a>
	              
                </form>
                </div>
            </div>
    </div>  
    <!-- Main content -->
    <section class="content">
     
    @endsection

   
