<?php
    use App\Resource;
?>

@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b><br></b>
      </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('approval-timesheet-ceo')}}">Timesheet</a></li>
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

            {{-- table data of car  --}}
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#approval_proposal" data-toggle="tab">Approval Proposal &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i></a></li>
                    <li><a href="#approval_project" data-toggle="tab">Approval Project &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i></a></li>
                    {{-- <li><a href="#approval_ho" data-toggle="tab">Approval HO &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i></a></li> --}}
                    <li><a href="#total_man_hours" data-toggle="tab"><i class="fa fa-bar-chart"></i>&nbsp; Report Timesheet</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="approval_proposal">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th> Nama Proposal </th>
                                        <th> Lokasi </th>
                                        <th> Kebutuhan Resource </th>
                                        <th> Tanggal Pengajuan </th>
                                        <th> Status </th>
                                        <th> Tanggal Disetujui </th>
                                        <th>Aksi</th>     
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($new_proposal as $k => $d)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$d->nama}}</td>
                                        <td>{{$d->getLokasi->lokasi}}</td>
                                        <td>
                                            @foreach(Resource::whereIn('id', explode(',',$d->resource_id))->get() as $item)
                                            {{$loop->iteration}}.&nbsp;{{$item->nama_posisi}}
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ date('d M Y', strtotime($d->created_at)) }}</td>
                                        @if($d->status_approved == 0)
                                            <td><span class="label label-warning">BUTUH PERSETUJUAN</span></td>
                                        @elseif($d->status_approved == 1)
                                            <td><span class="label label-success">DISETUJUI</span></td>
                                        @else
                                            <td><span class="label label-danger">DITOLAK</span></td>
                                        @endif
                                        
                                        <td>{{ date('d M Y', strtotime($d->tgl_approved)) }}</td>
                                        
                                        @if($d->status_approved == 0)
                                            <td>
                                                <a href="{{route('edit-approval-proposal',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>&nbsp; Ubah Status</a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>&nbsp; Ubah Status</a>
                                            </td>
                                        @endif
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="approval_project">
                        <div class="table-responsive">
                            <table id="data-table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th> Nama Project </th>
                                        <th> Lokasi </th>
                                        <th> Kebutuhan Resource </th>
                                        <th> Tanggal Pengajuan </th>
                                        <th> Status </th>
                                        <th> Tanggal Disetujui </th>
                                        <th>Aksi</th>     
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($new_project as $k => $d)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$d->nama}}</td>
                                        <td>{{$d->getLoc_Project->lokasi}}</td>
                                        <td>
                                            @foreach(Resource::whereIn('id', explode(',',$d->resource_id))->get() as $item)
                                            {{$loop->iteration}}.&nbsp;{{$item->nama_posisi}}
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ date('d M Y', strtotime($d->created_at)) }}</td>
                                        @if($d->status_approved == 0)
                                            <td><span class="label label-warning">BUTUH PERSETUJUAN</span></td>
                                        @elseif($d->status_approved == 1)
                                            <td><span class="label label-success">DISETUJUI</span></td>
                                        @else
                                            <td><span class="label label-danger">DITOLAK</span></td>
                                        @endif

                                        @if($d->tgl_approved == '')
                                            <td>  </td>
                                        @else
                                            <td>{{ date('d M Y', strtotime($d->tgl_approved)) }}</td>
                                        @endif

                                        @if($d->status_approved == 0)
                                            <td>
                                                <a href="{{route('edit-approval-project',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>&nbsp; Ubah Status</a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>&nbsp; Ubah Status</a>
                                            </td>
                                        @endif
                                        
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="tab-pane" id="approval_ho">
                        <div class="table-responsive">
                            <table id="data-tables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"><center><input type="checkbox" id="selectAllApprove" name="selectAllApprove"></center><button class="btn btn-success btn-xs" id="btnSelectAll" name="btnSelectAll"><span>Approve All</span></button></th>
                                        <th width="5%">No.</th>
                                        <th>Tanggal Kerja</th>
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Deskripsi Pekerjaan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($timesheet as $k => $d)
                                      <tr>
                                            <td><center><input type="checkbox" name="deleteAll[]" onclick="partialSelected()" class="bulkSelectAll" id="bulkSelectName" value={{$d->id}}></center></td>
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

                                            <td>{{$d->getNama->nama}}</td>
                                            <td>{{$d->getDiv->nama}}</td>
                                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                                            <td>{{$d->workingType->nama}}</td>
                                            
                                            @if($d->status == 0)
                                                <td><span class="label label-danger">Butuh Approval</span></td>
                                            @else 
                                                <td><span class="label label-danger">Disetujui</span></td>
                                            @endif

                                            <td>
                                            <a href="{{route('edit-status-timesheet-ho',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>Ubah Status</a>
                                            </td>

                                      </tr>
                                      @endforeach
                                  </tbody>
                            </table>
                            </div>
                    </div> --}}
                    <div class="tab-pane" id="total_man_hours">
                        <div class="table-responsive">
                            <table id="data-tables2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Penempatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($data_karyawan as $d)
                                      <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d->nik}}</td>
                                            <td>{{$d->nama}}</td>
                                            <td>{{$d->lokasi->nama}}</td>
                                            <td>
                                            <a href="{{url('all-time-sheet')}}/{{$d->nik}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-eye"></i>&nbsp; Detail</a>
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

<div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="font-size: 16px;">Konfirmasi ubah status</h4>
      </div>
      <div class="modal-body" id="konfirmasi-body">
        <div class="form-group">
            <label>Pilih Status</label>
            <select name="status_approved" onchange="myFunction(this)" class="form-control" id="status_approved" style="width: 100%;" required>
                <option selected disabled>--Pilih--</option>
                <option value="1"> DISETUJUI </option>
                <option value="2"> DITOLAK </option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" data-id="" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating..." id="confirm-delete">Update</button>
      </div>
      </div>
    </div>
  </div>

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
var dt;
$(function(){
   $('#data-table').DataTable();
}

</script>
@endpush


