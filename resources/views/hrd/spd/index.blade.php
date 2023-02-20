@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>Official Travel Letter Data (SPD)</b>
    </span>
    <br>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('history-spd')}}">SPD History</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            <div style="margin-bottom: 20px">
                <a href="spd-report" class="btn btn-warning">Report SPD</a>
            </div>
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Reference No.</th>
                            <th>Form Date</th>
                            <th>Employee Name</th>
                            <th>Employee Number</th>
                            <th>Division</th>
                            <th>Travel Type</th>
                            <th>From</th>
                            <th>Destination</th>
                            <th>Date Departure</th>
                            <th>Date Return</th>
                            <th>Assignment Type</th>
                            <th>Purpose</th>
                            <th>Travel By</th>
                            <th>Advance Payment</th>
                            <th>Additional Cost</th>
                            <th>Sign Received</th>
                            <th>Approval User</th>
                            <th><center>File Upload</center></th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($spd as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->no_surat}}</td>
                            <td>{{date('d-M-Y', strtotime($d->form_date))}}</td>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->nik}}</td>
                            <td>{{$d->get_divisi->nama}}</td>
                            <td>{{$d->travel_type}}</td>
                            <td>{{$d->asal}}</td>
                            <td>{{$d->tujuan}}</td>
                            <td>{{date('d-M-Y', strtotime($d->tgl_keberangkatan))}}</td>
                            <td>{{date('d-M-Y', strtotime($d->tgl_pulang))}}</td>
                            <td>{{$d->assignment_type}}</td>
                            <td>{{$d->purpose}}</td>
                            <td>{{$d->travel_by}}</td>
                            <td>{{$d->advance_payment}}</td>
                            <td>
                                @if($d->idr == '')
                                    <span> </span>
                                @else 
                                    @rupiah($d->idr),00
                                    <!--{{$d->idr}}-->
                                @endif
                            </td>
                            <td>{{$d->sign_received}}</td>
                            <td> 
                                @if($d->spdApproval && $d->spdApproval->status == 0)
                                <span class="label label-warning">Waiting approval</span>
                              @elseif($d->spdApproval && $d->spdApproval->status == 1)
                                <span class="label label-success">Approved</span>
                              @else
                                <span class="label label-danger">Rejected</span>
                              @endif      
                            </td>

                            <td><a href="#" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;"> View File</a></td>
                            <td><a href="{{route('edit-spd',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a></td>
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
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function(){
   $('#data-table').DataTable();
});
</script>
@endpush
