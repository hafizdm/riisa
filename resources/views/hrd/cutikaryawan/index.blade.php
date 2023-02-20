@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <br>
      <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('histori-cuti')}}">Leave History</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <span class="fonts header-style">
            <b>Leave History</b>
        </span>
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-md-10 col-xs-12 col-xl-10">
              @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              @elseif(session()->get('failed'))
                <div class="alert alert-danger alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4><i class="icon fa fa-ban"></i> Alert !</h4>
                  {{ session()->get('failed') }}
                </div>
              @endif
            </div>
          </div>

            {{--  table data of car  --}}
            <div class="table-responsive">
              <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                          <th width="5%">#</th>
                          <th width="10%">Action</th>
                          <th>No.</th>
                          <th>Employee's Name</th>
                          <th>Request Date</th>
                          <th>Total Days</th>
                          <th>First Date</th>
                          <th>Last Date</th>
                          <th>Type of Leave</th>
                          <th>Description</th>
                          <th><center>File</center></th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    </thead>
                    <tbody>
                    @foreach($cuti_karyawan as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                              <!--@if($d->status == 0)-->
                              <!--  <a href="{{route('editappcuti',$d->id)}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>-->
                              <!--@else-->
                              <!--  <a href="#" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>-->
                              <!--@endif-->
                                @if($d->status == 0)
                                      <div class="dropdown">
                                        <button type="button" class="btn btn-secondary dropdown-toggle btn-xs" data-toggle="dropdown">
                                          Action
                                          <span class="fa fa-caret-down"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a href="javascript:;" class="tApprove" data-id="<?php echo $d->id;?>" data-vals="<?php echo 1;?>"><i class="fa fa-check" aria-hidden="true" style="color:blue"></i>Approve</a></li>
                                          <li><a href="javascript:;" class="tReject" data-id="<?php echo $d->id;?>" data-vals="<?php echo 4;?>"><i class="fa fa-ban" style="color:red" aria-hidden="true"></i>Reject</a></li>
                                        </ul>
                                      </div>
                                  @else
    
                                  @endif
                            </td>
                            <td>{{$d->no_cuti}}</td>
                            <td>{{$d->nama_karyawan}}</td>
                            <td>{{ date('d-M-Y', strtotime($d->tgl_pengajuan)) }}</td>
                            <td>{{$d->jumlah_hari}} days</td>
                            <td>{{ date('d-M-Y', strtotime($d->dari_tanggal)) }}</td>
                            <td>{{ date('d-M-Y', strtotime($d->sampai_tanggal)) }}</td>
                            <td>{{$d->tipeCuti->nama}}</td>
                            <td>
                              @if($d->keterangan == "")
                                <center><span> - </span></center>
                              @else
                                {{$d->keterangan}}
                              @endif
                            </td>
                            <td>
                              @if($d->file_scan != NULL || $d->file_scan != "")
                                <a href="{{url('uploads/Cuti/'.$d->file_scan)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;"> View File</a>
                              @else

                              @endif 
                            </td>
                            <td>
                              @if($d->status == 0)
                                <span class="label label-danger">Waiting approval HC</span>
                              @elseif($d->status == 1)
                                <span class="label label-success">Approved by HC</span>
                              @else
                                <span class="label label-danger">Rejected by HC</span>
                              @endif
                            </td>
                           
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            {{--  end of car data  --}}
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
    {{-- @include('hrd.cutikaryawan.edit') --}}

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function(){
   var mainTable = $('#data-table').DataTable();
})

$('.tApprove').click(function(){
  var getData = $(this);
  var ids = getData.data("id");
  var values = getData.data("vals");
  
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax(
    {
      url: "histori-cuti/"+ids,
      type: 'POST',
      dataType: "JSON",
      data: {
        "ids": ids, 
        "values" : values
      },
      success: function(data){
        console.log(data);
        window.location.reload();
      }
});
})

$('.tReject').click(function(){
  var getData = $(this);
  var ids = getData.data("id");
  var values = getData.data("vals");
  
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax(
    {
      url: "histori-cuti/"+ids,
      type: 'POST',
      dataType: "JSON",
      data: {
        "ids": ids, 
        "values" : values
      },
      success: function(data){
        console.log(data);
        window.location.reload();
      }
});
})

</script>
@endpush
