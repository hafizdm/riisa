<?php
use Carbon\Carbon as Carbon;
use App\Resource;
foreach($hari_libur  as $libur){
    $liburs = $libur->tanggal;
  }
  
?>

@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
      <b>Time Sheet Project</b>
    </span>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('timesheet-project')}}"> Project </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div style="margin-bottom: 20px">
        <a href="{{url('timesheet-project/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Project </a>
    </div>
    <div class="row">
        <div class="col-lg-6">
            @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            @endif
        </div>
    </div>
    
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all" data-toggle="tab">All project</a></li>
          <li><a href="#per_project" data-toggle="tab">Per project</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="all">
                <div class="table-responsive">
                    <table id="all_projects" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Tanggal Kerja</th>
                                <th>Nama</th>
                                <th>Project</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Total Jam</th>
                                <th>Role</th>
                                <th>Deskripsi Pekerjaan</th>
                                <th>Status</th>
                                <th style="width:35px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @if(date('l', strtotime($d->tanggal_kerja)) == "Sunday" && $d->tanggal_kerja != $liburs)
                                <td>Minggu, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @elseif(date('l', strtotime($d->tanggal_kerja)) == "Monday" && $d->tanggal_kerja != $liburs)
                                    <td>Senin, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @elseif(date('l', strtotime($d->tanggal_kerja)) == "Tuesday" && $d->tanggal_kerja != $liburs)
                                    <td>Selasa, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @elseif(date('l', strtotime($d->tanggal_kerja)) == "Wednesday" && $d->tanggal_kerja != $liburs)
                                    <td>Rabu, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @elseif(date('l', strtotime($d->tanggal_kerja)) == "Thursday" && $d->tanggal_kerja != $liburs)
                                    <td>Kamis, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @elseif(date('l', strtotime($d->tanggal_kerja)) == "Friday" && $d->tanggal_kerja != $liburs)
                                    <td>Jumat, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @elseif(date('l', strtotime($d->tanggal_kerja)) == "Saturday" && $d->tanggal_kerja != $liburs)
                                    <td>Sabtu, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @else
                                    <td>Libur Nasional/Cuti Bersama, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                @endif
                                <td>{{$d->getNama->nama}}</td>
                                <td>{{$d->getLoc->nama}}</td>
                                <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                                <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                                <td>{{$d->man_hours}} jam</td>
                                <td>{{$d->getRes->nama_posisi}}</td>
                                <td>{!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}</td>
                                @if($d->status == 0)
                                    <td><span class="label label-danger">Butuh Approval</span></td>
                                @else 
                                    <td><span class="label label-danger">Disetujui</span></td>
                                @endif
                                <td>
                                    <center>
                                        <form name="formdata" method="post" action="{{route('update-status-timesheet-project', $d->id)}}">
                                            @method('PATCH') 
                                            @csrf
                                            <input type="hidden" value="1" name="status" id="status">
                                            <input type="hidden" value="{{$d->project_id}}" name="project_id">
                                            <input type="hidden" value="{{$d->resource_id}}" name="resource_id">
                                            <button type="submit" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-check" aria-hidden="true"></i> </button>
                                        </form>

                                    
                                        <form name="formdata" method="post" action="{{route('update-status-timesheet-project', $d->id)}}">
                                            @method('PATCH') 
                                            @csrf
                                            <input type="hidden" value="2" name="status" id="status">
                                            <input type="hidden" value="{{$d->project_id}}" name="project_id">
                                            <input type="hidden" value="{{$d->resource_id}}" name="resource_id">
                                            <button type="submit" class="btn btn-default btn-xs" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </form>
                                    </center>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <!--</div>-->
        
        <div class="tab-pane" id="per_project">
            @foreach ($project as $p)
                <div class="row">
                    <div class="col-md-6">
                    <div class="box box-solid collapsed-box">
                        <div class="box-header with-border">
                            <i class="fa fa-file-pdf-o"></i>
                            <h3 class="box-title" style="font-size: 16px"><b>{{$p->nama}}</b></h3>
                            <div class="box-tools pull-right">
                                {{-- <span class="label label-default">{{$p->man_hours}} jam</span> --}}
                                @if($p->status_approved == 0 && $p->status == 0)
                                    <span class="label label-warning"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; MENUNGGU PERSETUJUAN</span>
                                    &nbsp;
                                    <button class='btn btn-xs btn-danger delete' data-token="{{ csrf_token() }}" data-id="{{$p->id}}"><i class="fa fa-trash"></i></button>   
                                @elseif($p->status_approved == 1 && $p->status == 1)
                                    <span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp; AKTIF</span>
                                    <a href="{{url("detail-timesheet-project")}}/{{$p->lokasi_id}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
            
                                @elseif($p->status_approved == 1 && $p->status == 3)
                                    <span class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp; TIDAK AKTIF</span>
                                    <a href="{{url("detail-timesheet-project")}}/{{$p->lokasi_id}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
            
                                @elseif($p->status_approved == 2 && $p->status == 2)
                                    <span class="label label-danger"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; DITOLAK</span>
                                @endif
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <table class="text-muted">
                            @if($p->status_approved == 0)
                            <tr>
                                <td>Tanggal Pengajuan &nbsp;</td>
                                <td> : &nbsp; {{ date('d M Y', strtotime($p->created_at)) }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi &nbsp;</td>
                                <td> : &nbsp; {{ $p->getLoc_Project->lokasi}} </td>
                            </tr>
                            <tr>
                                <td>Kebutuhan Resource &nbsp;</td>
                                <td>: &nbsp;</td>
                                    @foreach(Resource::whereIn('id', explode(',',$p->resource_id))->get() as $item)
                                        <tr>
                                            <td></td>
                                            <td>&nbsp;&nbsp; {{$loop->iteration}} .&nbsp; {{$item->nama_posisi}}</td>
                                        </tr>
                                    @endforeach 
                            </tr>
            
                            @elseif($p->status_approved == 1)
                                <tr>
                                    <td>Tanggal Mulai &nbsp;</td>
                                    <td> : &nbsp; {{ date('d M Y', strtotime($p->tgl_approved)) }} </td>
                                </tr>
                                <tr>
                                    <td>Lokasi &nbsp;</td>
                                    <td> : &nbsp; {{ $p->getLoc_Project->lokasi}} </td>
                                </tr>
                                <tr>
                                    <td>Total Man Hours &nbsp;</td>
                                    <td> : &nbsp; {{ $p->man_hours}} jam</td>
                                </tr>
                                <tr>
                                    <td>Kebutuhan Resource &nbsp;</td>
                                    <td>: &nbsp;</td>
                                        @foreach(Resource::whereIn('id', explode(',',$p->resource_id))->get() as $item)
                                            <tr>
                                                <td></td>
                                                <td>&nbsp;&nbsp; {{$loop->iteration}} .&nbsp; {{$item->nama_posisi}}</td>
                                            </tr>
                                        @endforeach 
                                </tr>
                                @if($p->status == 1)
                                    <tr>
                                        <td>Aksi</td>
                                        <td>: &nbsp;<a href="{{route('edit-resource-project',$p->lokasi_id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>&nbsp; Edit Resource</a> 
                                        &nbsp;<a href="{{route('edit-open-close-project',$p->lokasi_id)}}" class="btn btn-default btn-xs" style="color: rgb(255, 30, 30);"><i class="fa fa-edit"></i>&nbsp; Ubah Status Project</a> 
                                        </td>
                                    </tr>
                                @elseif($p->status == 3)
                                    <tr>
                                        <td>Aksi</td>
                                        <td>:
                                        &nbsp;<a href="{{route('edit-open-close-project',$p->lokasi_id)}}" class="btn btn-default btn-xs" style="color: rgb(255, 30, 30);"><i class="fa fa-edit"></i>&nbsp; Ubah Status Project</a> 
                                        </td>
                                    </tr>
                                @endif
                            
                            @else
                                    <tr>
                                        <td>Tanggal Pengajuan &nbsp;</td>
                                        <td> : &nbsp; {{ date('d M Y', strtotime($p->created_at)) }} </td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi &nbsp;</td>
                                        <td> : &nbsp; {{ $p->getLoc_Project->lokasi}} </td>
                                    </tr>
                                    <tr>
                                        <td>Kebutuhan Resource &nbsp;</td>
                                        <td>: &nbsp;</td>
                                            @foreach(Resource::whereIn('id', explode(',',$p->resource_id))->get() as $item)
                                                <tr>
                                                    <td></td>
                                                    <td>&nbsp;&nbsp; {{$loop->iteration}} .&nbsp; {{$item->nama_posisi}}</td>
                                                </tr>
                                            @endforeach 
                                    </tr>
                            @endif
                        </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
    </div>
</section>

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    $(function(){
        var tb_all = $("#all_projects").DataTable();
    });

    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        confirm("Anda yakin untuk menghapus Project?");
        $.ajax({
            type: "delete",
            url: "{{ url('timesheet-project') }}" +'/' + id +'' ,
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


