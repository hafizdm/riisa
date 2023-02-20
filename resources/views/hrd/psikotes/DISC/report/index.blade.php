@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>DISC Score Report </b>
    </span>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('report-disc')}}">Report</a></li>
      </ol>
    </section>

    <section class="content">
        <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table id="tb_show_candidate" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 5%"><center>#</center></th>
                            <th>Candidate's Name</th>
                            <th>Job Applied</th>
                            <th>Test Status</th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidate as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->full_name}}</td>
                                <td>{{$item->job_applied}}</td>
                                <td>
                                    @if($item->status_psikotes2 == 0)
                                        <span>No</span>
                                    @else
                                        <span>Yes</span>
                                    @endif
                                </td>
                                <td>
                                    <center>
                                    <a href="{{route('show-report-disc',$item->id)}}"><i class="fa fa-eye fa-1x"></i></a>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer"></div>
      </div>
    </section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function(){
   var mainTable = $('#tb_show_candidate').DataTable();
});
</script>
@endpush
