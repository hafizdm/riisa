@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
      <b>Education</b>
    </span>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('pendidikan')}}"> Education </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div style="margin-bottom: 20px">
        <a href="{{url('pendidikan/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Education </a>
    </div>
    <div class="row">
        <div class="col-lg-6">
            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
             @elseif(session()->get('failed'))
                <div class="alert alert-danger alert-dismissible fade in"> 
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4><i class="icon fa fa-ban"></i> Failed !</h4>
                  {{ session()->get('failed') }}
                </div>
            @endif
        </div>
    </div>

    @foreach ($pendidikan as $p)
    <div class="row">
        <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <h3 class="box-title" style="font-size: 16px;">{{$p->nama_institusi}}</h3>
                <div class="box-tools pull-right">
                    
                    <a href="{{route('edit-pendidikan',$p->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                    {{-- <button data-toggle="tooltip" data-token="{{ csrf_token() }}" data-id="' + value.id + '" data-original-title="Delete" class="btn btn-md bg-black deletePendidikan"> --}}
                    <button class='btn btn-xs btn-danger delete' data-token="{{ csrf_token() }}" data-id="{{$p->id}}"><i class="fa fa-trash"></i></button>   
                    &nbsp;  
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="text-muted">
                <tr>
                    <td>Start Date &nbsp;</td>
                    <td> : &nbsp; {{ date('Y', strtotime($p->tgl_masuk)) }} </td>
                </tr>
                <tr>
                    <td>End Date  &nbsp;</td>
                    <td> : &nbsp; {{ date('Y', strtotime($p->tgl_keluar)) }} </td>
                </tr>
                <tr>
                    <td>Education Level &nbsp;</td>
                    <td>: &nbsp; {{$p->jenjang_pendidikan}}</td>
                </tr>
                <tr>
                    <td>Major  &nbsp;</td>
                    <td> : &nbsp; {{ $p->jurusan }} </td>
                </tr>
                <tr>
                    <td>Location  &nbsp;</td>
                    <td> : &nbsp; {{ $p->lokasi }} </td>
                </tr>
                <tr>
                    <td>IPK  &nbsp;</td>
                    <td> : &nbsp; {{ $p->ipk }} </td>
                </tr>
            </table>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </div>
    @endforeach

</section>

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>

    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        confirm("Anda yakin untuk menghapus Pendidikan?");
        $.ajax({
            type: "delete",
            url: "{{ url('pendidikan') }}" +'/' + id +'' ,
            data: {
                "id": id,
                "_method": 'delete',
                "_token": token,
            },
            success: function (data) {
                console.log(data.message);
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endpush 


