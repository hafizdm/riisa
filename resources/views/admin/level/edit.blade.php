@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Master Level
        {{--  <small>it all starts here</small>  --}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url("level")}}">Level</a></li>
        <li class="active"><a href="#">Edit</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="row">

	      <div class="col-md-6  col-md-offset-3">

	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Edit Level</h3>
	          </div>
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" method="post" action="{{route('levelupdate', [$level->id])}}">
			@method('PATCH') 
              @csrf
	            <div class="box-body">
				  <div class="form-group">
	                <label for="nama">Nama</label>
					<input type="text" class="form-control" name="nama" id="nama" value="{{$level->nama}}" placeholder="Masukan Level">
					<span class="help-block" >{{ $errors->first('nama') }} </span>
	              </div>
	              <div class="form-group">
	                <label for="keterangan">Keterangan</label>
					<textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">{{$level->keterangan}}</textarea>
					<span class="help-block" >{{ $errors->first('keterangan') }} </span>
				</div>
	              <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" {{$level->status == 1 ? "selected" : ""}}>Aktif</option>
                    <option value="0" {{$level->status == 0 ? "selected" : ""}}>Tidak Aktif</option>
                  </select>
                </div>
	            </div>
	            <!-- /.box-body -->

	            <div class="box-footer">
	              <a href="{{url("level")}}" class="btn btn-danger">Cancel</a>
	              <button type="submit" name="submit" class="btn btn-success pull-right">Update</button>
	            </div>
	          </form>
	        </div>
	        <!-- /.box -->

	      </div>

	    </div>
    </section>
    <!-- /.content -->
@endsection
