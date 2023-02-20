<?php
    use App\Resource;
?>

@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
       <br>
      </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('approval-timesheet-ceo')}}">Timesheet Marketing</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            @elseif(session()->get('failed'))
                <div class="alert alert-danger alert-dismissible fade in"> 
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4><i class="icon fa fa-ban"></i> Pemberitahuan !</h4>
                  {{ session()->get('failed') }}
                </div>
            @endif

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                      
                    <li class="active"><a href="#approval_marketing" data-toggle="tab">Approval Marketing &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i></a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="approval_marketing">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Tanggal Kerja</th>
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th>Tipe Pekerjaan</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Deskripsi Pekerjaan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($app_marketing as $k => $d)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            @if((date('l', strtotime($d->tanggal_kerja))) == "Monday")
                                                <td>Senin, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Tuesday")
                                                <td>Selasa, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Wednesday")
                                                <td>Rabu, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Thursday")
                                                <td>Kamis, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Friday")
                                                <td>Jumat, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Saturday")
                                                <td>Sabtu, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td> 
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Sunday")
                                                <td>Minggu, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>      
                                            @endif

                                            <td>
                                                @if($d->id_user == "105")
                                                    <span>Yuniar Anggraeni                  </span>
                                                @else
                                                    {{$d->getNama->nama}}
                                                @endif
                                                </td>
                                            <td>{{$d->getDiv->nama}}</td>
                                            @if($d->proposal_id == 0)
                                                <td>Marketing</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                                             <td>{!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}</td>
                                            
                                            @if($d->status == 0)
                                                <td><span class="label label-danger">Butuh Approval</span></td>
                                            @else 
                                                <td><span class="label label-danger">Disetujui</span></td>
                                            @endif

                                            <td>
                                                <center>
                                                   <form name="formdata" method="post" action="{{route('update-status-timesheet-marketing', $d->id)}}">
                                            @method('PATCH') 
                                            @csrf
                                            <input type="hidden" value="1" name="status" id="status">
                                            <button type="submit" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Approve</button>
                                            </form>

                                            <form name="formdata" method="post" action="{{route('update-status-timesheet-marketing', $d->id)}}">
                                            @method('PATCH') 
                                            @csrf
                                            <input type="hidden" value="2" name="status" id="status">
                                            <button type="submit" class="btn btn-default btn-xs" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Reject</button>
                                                </form>
                                            </center>
                                                    
                                            <!--<a href="{{route('edit-status-timesheet-marketing',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>Ubah Status</a>-->
                                            </td>

                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                   
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
var dt;
$(function(){
   $('#data-table').DataTable();
});
</script>
@endpush


