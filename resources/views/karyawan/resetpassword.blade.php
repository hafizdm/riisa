@extends('templates.header')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b>Change Password</b></h3>
                </div>
                <br>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @if(session()->get('success'))
                                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" name="formdata"  method="post" action="{{route('updatepassword', $reset->id)}}">
                                @method('PATCH') 
                                @csrf
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input name="old_password" type="password" class="form-control" id="old_password" value="{{$reset->password}}" readonly>
                                <span class="help-block" >{{ $errors->first('old_password') }} </span>
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input name="password" type="password" class="form-control" id="password" data-toggle="password" required>
                                <span class="help-block" >{{ $errors->first('password') }} </span>
                            </div>
    
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="/" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <section class="content">
    </section>
    @endsection
    @push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
    <script type="text/javascript">
        $("#password").password('toggle');
    </script>
    @endpush 

   
