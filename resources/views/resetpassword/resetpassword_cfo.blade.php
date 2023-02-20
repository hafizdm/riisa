@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Reset Password
      {{--  <small>it all starts here</small>  --}}
    </h1>
  </section>
      <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                <form role="form" name="formdata"  method="post" action="{{route('updatepassword-cfo', $reset->id)}}">
                @method('PATCH') 
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="old_password">Kata Sandi Lama</label>
                            <input name="old_password" type="password" class="form-control" id="old_password" value="{{$reset->password}}" readonly>
                            <span class="help-block" >{{ $errors->first('old_password') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi Baru</label>
                            <input name="password" type="password" class="form-control" id="password" data-toggle="password" required>
                            <span class="help-block" >{{ $errors->first('password') }} </span>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="{{url("ganti-password")}}/{{Auth::user()->id}}" class="btn btn-danger">Batal</a>
                </div>
                </div>
                </form>
                </div>
            </div>
    </div>  
    <!-- Main content -->
    <section class="content">
     
    @endsection
    @push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
    <script type="text/javascript">
        $("#password").password('toggle');
    </script>
    @endpush 

   
