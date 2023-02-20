@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Tambah Data Barang</b>
    </span>
    <ol class="breadcrumb">
      <<li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url("barang")}}">Barang</a></li>
      <li class="active"><a href="#">Tambah Data</a></li>
      
    </ol>
  </section>
  <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-6">
                <form role="form" name="formdata" method="post" action="{{url("barang/store")}}">
                        {{csrf_field()}}   
                        <div class="form-group">
                            <label for="id">Jenis Barang</label>
                            <select name="jenis_barang" type="text" class="form-control" id="jenis_barang"  style="width: 100%;" required>
                                {{-- <option selected></option> --}}
                                <option selected disabled>--Pilih Jenis Barang--</option>
                                @foreach($jb as $a )
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id">Cost Code</label>
                            <select name="kode_barang" type="text" class="form-control" id="kode_barang"  style="width: 100%;" required>
                                <option selected disabled>--Pilih Cost Code--</option>
                                @foreach($kb as $a )
                                <option value="{{ $a->id }}">{{ $a->kode_kategori }}/{{$a->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="nama_barang" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang" required>
                            <span id="email" class="help-block" > {{ $errors->first('nama_barang') }} </span>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
	                      <a href="{{url('barang')}}" class="btn btn-danger">Batal</a>
	              
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
// $('.select2').select2()

</script>
@endpush

   
