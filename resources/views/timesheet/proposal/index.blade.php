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
      <b>Time Sheet Proposal</b>
    </span>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('time-sheet-proposal')}}"> Proposal </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div style="margin-bottom: 20px">
        <a href="{{url('time-sheet-proposal/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Proposal </a>
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
          <li class="active"><a href="#all_proposals" data-toggle="tab">All Proposal</a></li>
          <li><a href="#per_proposal" data-toggle="tab">Per Proposal</a></li>
        </ul>
        
        <div class="tab-content">
            <div class="active tab-pane" id="all_proposals">
                <div class="table-responsive">
                    <table id="tb_allproposal" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                {{-- <th style="width: 50px;"><center><input type="checkbox" id="selectAllApprove" name="selectAllApprove"></center><button class="btn btn-success btn-xs" id="btnSelectAll" name="btnSelectAll"><span>Approve All</span></button></th> --}}
                                <th width="5%">No.</th>
                                <th>Tanggal Kerja</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Proposal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Total Jam Kerja</th>
                                <th>Deskripsi Pekerjaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_proposals as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    @if((date('l', strtotime($d->tanggal_kerja))) == "Monday")
                                        <td>Senin, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                    @elseif((date('l', strtotime($d->tanggal_kerja))) == "Tuesday")
                                        <td>Selasa, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                    @elseif((date('l', strtotime($d->tanggal_kerja))) == "Wednesday")
                                        <td>Rabu, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                    @elseif((date('l', strtotime($d->tanggal_kerja))) == "Thursday")
                                        <td>Kamis, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                    @elseif((date('l', strtotime($d->tanggal_kerja))) == "Friday")
                                        <td>Jumat, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>
                                    @elseif((date('l', strtotime($d->tanggal_kerja))) == "Saturday")
                                        <td>Sabtu, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td> 
                                    @elseif((date('l', strtotime($d->tanggal_kerja))) == "Sunday")
                                        <td>Minggu, {{ date('d-m-Y', strtotime($d->tanggal_kerja)) }}</td>      
                                    @endif
                                    
                                    <td>{{$d->getNama->nama}}</td>
                                <td>{{$d->getRes->nama_posisi}}</td>
                                <td>{{$d->getProposal->nama}}</td>
                                <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                                <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                                <td>{{$d->man_hours}} jam</td>
                                <td>{!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}</td>
                                
                                @if($d->status == 0)
                                    <td><span class="label label-danger">Butuh Approval</span></td>
                                @else 
                                    <td><span class="label label-danger">Disetujui</span></td>
                                @endif

                                <td>
                                    <center>
                                        <form name="formdata" method="post" action="{{route('update-status-timesheet', $d->id)}}">
                                            @method('PATCH') 
                                            @csrf
                                            <input type="hidden" value="1" name="status" id="status">
                                            <input type="hidden" value="{{$d->proposal_id}}" name="proposal_id">
                                            <input type="hidden" value="{{$d->resource_id}}" name="resource_id">
                                            <button type="submit" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-check" aria-hidden="true"></i> </button>
                                        </form>
                                    
                                        <form name="formdata" method="post" action="{{route('update-status-timesheet', $d->id)}}">
                                            @method('PATCH') 
                                            @csrf
                                            <input type="hidden" value="2" name="status" id="status">
                                            <input type="hidden" value="{{$d->proposal_id}}" name="proposal_id">
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
            
            <div class="tab-pane" id="per_proposal">
                @foreach ($proposal as $p)
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
                                        <a href="{{url("detail-timesheet")}}/{{$p->id}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                
                                    @elseif($p->status_approved == 1 && $p->status == 3)
                                        <span class="label label-success" style="background: rgb(0, 195, 255) !important;"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp; TIDAK AKTIF</span>
                                        <a href="{{url("detail-timesheet")}}/{{$p->id}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                
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
                                    <td> : &nbsp; {{ $p->lokasi_id}} </td>
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
                                <tr>
                                        <td>Aksi</td>
                                        <td>: &nbsp;<a href="{{route('edit-resource-proposal',$p->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>&nbsp; Edit Resource</a></td>
                                    </tr>
                
                                {{-- <tr>
                                    <td>Status Proposal&nbsp;</td>
                                    <td> : &nbsp;<span class="label label-warning">MENUNGGU PERSETUJUAN</span> </td>
                                </tr> --}}
                
                
                                @elseif($p->status_approved == 1)
                                    <tr>
                                        <td>Tanggal Mulai &nbsp;</td>
                                        <td> : &nbsp; {{ date('d M Y', strtotime($p->tgl_approved)) }} </td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi &nbsp;</td>
                                        <td> : &nbsp; {{ $p->lokasi_id}} </td>
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
                                            <td>: &nbsp;<a href="{{route('edit-resource-proposal',$p->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>&nbsp; Edit Resource</a> 
                                                &nbsp;<a href="{{route('edit-close-proposal',$p->id)}}" class="btn btn-default btn-xs" style="color: rgb(255, 30, 30);"><i class="fa fa-edit"></i>Ubah Status</a> </td>
                                        </tr>
                                    @elseif($p->status == 3)
                                        <tr>
                                            <td>Aksi</td>
                                            <td>:
                                            &nbsp;<a href="{{route('edit-close-proposal',$p->id)}}" class="btn btn-default btn-xs" style="color: rgb(255, 30, 30);"><i class="fa fa-edit"></i>&nbsp; Ubah Status</a> 
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- <tr>
                                        <td>Ubah Status Proposal&nbsp;</td>
                                        @if($p->status == 1)
                                            <td> : &nbsp; <span class="label label-danger" style="background-color: rgb(0, 128, 47) !important">AKTIF</span> </td>
                                        @else
                                            <td> : &nbsp;<span class="label label-danger" style="background: rgb(0, 195, 255) !important;">TIDAK AKTIF</span> </td>
                                        @endif
                                    </tr> --}}
                                
                                    @else
                                        <tr>
                                            <td>Tanggal Pengajuan &nbsp;</td>
                                            <td> : &nbsp; {{ date('d M Y', strtotime($p->created_at)) }} </td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi &nbsp;</td>
                                            <td> : &nbsp; {{ $p->lokasi_id}} </td>
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
                        
                                        {{-- <tr>
                                            <td>Status Proposal&nbsp;</td>
                                            <td> : &nbsp;<span class="label label-danger">DITOLAK</span> </td>
                                        </tr> --}}
                                    
                
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
        var tb_all = $("#tb_allproposal").DataTable();
    });
    
    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        confirm("Anda yakin untuk menghapus Proposal?");
        $.ajax({
            type: "delete",
            url: "{{ url('time-sheet-proposal') }}" +'/' + id +'' ,
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


