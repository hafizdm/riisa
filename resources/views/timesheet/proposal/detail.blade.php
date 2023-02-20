<?php
    use Carbon\Carbon as Carbon;
    use App\Resource;
    use App\TimeSheetUser;
    foreach($hari_libur  as $libur){
        $liburs = $libur->tanggal;
    }
?>
@extends('templates.header')

@section('content')
<section class="content-header">
    <span class="fonts" style="font-size:20px">
    <b>Detail Time Sheet 
        @foreach($proposal as $p)
            {{$p->nama}}
        @endforeach
    </b>
    </span>
    <ol class="breadcrumb">
    <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="#">Detail Time Sheet</a></li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            @endif
            {{-- table data of car  --}}
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#approvals" data-toggle="tab">Approval Time Sheet &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i></a></li>
                    <li><a href="#daily_report" data-toggle="tab">Daily Report &nbsp; <i class="fa fa-calendar-check-o" aria-hidden="true"></i></a></li>
                    <li><a href="#man_hours" data-toggle="tab">List Man Hours &nbsp; <i class="fa fa-users" aria-hidden="true"></i></a></li>
                  </ul>
                  <div class="tab-content">

                    <div class="active tab-pane" id="approvals">
                        <div class="table-responsive">
                            <table id="data-tables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Tanggal Kerja</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Deskripsi Pekerjaan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($approval as $k => $d)
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

                                            <td>{{$d->getNama->nama}}</td>
                                            <td>{{$d->getRes->nama_posisi}}</td>
                                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                                            <td>{!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}</td>
                                            
                                            @if($d->status == 0)
                                                <td><span class="label label-danger">Butuh Approval</span></td>
                                            @else 
                                                <td><span class="label label-danger">Disetujui</span></td>
                                            @endif


                                    <!--Aksi-->
                                            <td>
                                               <center>
                                                    <form name="formdata" method="post" action="{{route('update-status-timesheet', $d->id)}}">
                                                        @method('PATCH') 
                                                        @csrf
                                                        <input type="hidden" value="1" name="status" id="status">
                                                        <input type="hidden" value="{{$d->proposal_id}}" name="proposal_id">
                                                        <input type="hidden" value="{{$d->resource_id}}" name="resource_id">
                                                        <button type="submit" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-check" aria-hidden="true"></i> &nbsp; Approve </button>
                                                    </form>

                                                    <form name="formdata" method="post" action="{{route('update-status-timesheet', $d->id)}}">
                                                        @method('PATCH') 
                                                        @csrf
                                                        <input type="hidden" value="2" name="status" id="status">
                                                        <input type="hidden" value="{{$d->proposal_id}}" name="proposal_id">
                                                        <input type="hidden" value="{{$d->resource_id}}" name="resource_id">
                                                        <button type="submit" class="btn btn-default btn-xs" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Reject</button>
                                                    </form>
                                                </center> 
                                                
                                        <!--<a href="{{route('edit-status-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>Ubah Status</a>-->
                                            </td>

                                      </tr>
                                      @endforeach
                                  </tbody>
                            </table>
                            </div>
                    </div>

                    <div class="tab-pane" id="daily_report">
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-blue">
                                        @if((date('l', strtotime(Carbon::now()))) == "Monday")
                                            Senin, {{date('d M Y', strtotime(Carbon::now()))}}
                                        @elseif((date('l', strtotime(Carbon::now()))) == "Tuesday")
                                            Selasa, {{date('d M Y', strtotime(Carbon::now()))}}
                                        @elseif((date('l', strtotime(Carbon::now()))) == "Wednesday")
                                            Rabu, {{date('d M Y', strtotime(Carbon::now()))}}
                                        @elseif((date('l', strtotime(Carbon::now()))) == "Thursday")
                                            Kamis, {{date('d M Y', strtotime(Carbon::now()))}}
                                        @elseif((date('l', strtotime(Carbon::now()))) == "Friday")
                                            Jumat, {{date('d M Y', strtotime(Carbon::now()))}}
                                        @elseif((date('l', strtotime(Carbon::now()))) == "Saturday")
                                            Sabtu, {{date('d M Y', strtotime(Carbon::now()))}}
                                        @elseif((date('l', strtotime(Carbon::now()))) == "Sunday")
                                            Minggu, {{date('d M Y', strtotime(Carbon::now()))}}
                                        @elseif((date('l', strtotime(Carbon::now()))) == $liburs)
                                            Cuti Bersama/Libur Nasional
                                        @endif
                                    </span>
                                </li>
                               
                                    <li>
                                    <div class="timeline-item">
                                        @foreach($proposal as $p)
                                            <span class="time">
                                                {{-- <i class="fa fa-clock-o"></i> 12:05 --}}
                                            </span>
                                            <h3 class="timeline-header"><b>Total Man Hours/Resource</b></h3>
                                            <div class="timeline-body">
                                                <table class="text-muted">
                                                    {{-- <tr>
                                                        <td><b>List Resource &nbsp;</b></td>
                                                        <td>&nbsp; :</td>
                                                    </tr> --}}
                                                        @foreach(Resource::whereIn('id', explode(',', $p->resource_id))->get() as $item)
                                                        <tr>
                                                            <td><i class="fa fa-user" aria-hidden="true"></i> {{$item->nama_posisi}} </td>
                                                            <?php $hitung = 0;
                                                            ?>
                                                            @foreach($timesheet as $ts)
                                                                @if($ts->resource_id == $item->id)
                                                                    <?php
                                                                    $hitung += $ts->man_hours;
                                                                    ?>
                                                                @endif
                                                            @endforeach
                                                            <td>&nbsp; : 
                                                                <?php echo $hitung." "."jam"; ?>
                                                            </td>
                                                        </tr>
                                                        @endforeach 
                                                </table>
                                                
                                            </div>
                                        @endforeach
                                    </div>
                                    </li>
                            <!-- END timeline item -->
                           
                            <li>
                              <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                          </ul>
                    </div>
        
        <div class="tab-pane" id="man_hours">
                <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    @foreach($proposal as $p)
                        <li class="time-label">
                            <span class="bg-red">
                                @if($p->status == 1)
                                    {{ date('d M Y', strtotime($p->tgl_approved)) }} - {{ date('d M Y', strtotime(Carbon::now())) }} 
                                @elseif($p->status == 3)
                                    {{ date('d M Y', strtotime($p->tgl_approved)) }} - {{ date('d M Y', strtotime($p->tgl_open_close)) }} 
                                @endif
                            </span>
                        </li>
                    @endforeach
                    
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-clock-o bg-blue"></i>
                      <div class="timeline-item">
                        @foreach($proposal as $p)
                            <h3 class="timeline-header"><b>Detail Hours</b></h3>
                            <div class="timeline-body">
                                <table class="text-muted">
                                    <tr>
                                        <td>Total Man Hours &nbsp;</td>
                                    <td> : &nbsp; <b>
                                        <?php 
                                            $hari_kerja = $p->man_hours;
                                            $hari_libur = $p->holidays;
                                            $hitung = $hari_kerja + $hari_libur;
                                            echo $hitung." "."jam";
                                        ?>
                                    </b></td>
                                    </tr>
                                    <tr>
                                        <td>Hari Kerja &nbsp;</td>
                                        <td> : &nbsp; {{ $p->man_hours}} jam</td>
                                    </tr>
                                    <tr>
                                        <td>Hari Libur &nbsp;</td>
                                        <td> : &nbsp; {{ $p->holidays}} jam</td>
                                    </tr>
                                </table>
                            </div>
                            
                        @endforeach
                      </div>
                    </li>
                    <li>
                        <i class="fa fa-user bg-yellow"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header"><b> Detail Resource</b></h3>
                            <div class="timeline-body">
                                
                                    {{-- <table class="text-muted"> --}}
                                        @foreach($proposal as $p)
                                            <?php 
                                                $tgl_approved = date('yy-m-d', strtotime($p->tgl_approved));
                                                $tgl_now = date('yy-m-d', strtotime(Carbon::now()));
                                                $datas = TimeSheetUser::whereBetween('tanggal_kerja',[$tgl_approved, $tgl_now])
                                                        ->where('status',1)
                                                        ->where('cost_account_id',2)
                                                        ->where('proposal_id', $p->id)
                                                        ->get();
                                                // echo $datas;
                                            ?>
                                            <div class="row">
                                            @foreach(Resource::whereIn('id', explode(',', $p->resource_id))->get() as $item)
                                                <div class="col-md-6 col-xs-12 col-lg-6">
                                                    <div class="box box-default collapsed-box box-solid">
                                                        <div class="box-header with-border">
                                                        <h3 class="box-title" style="font-size: 14px;">{{$item->nama_posisi}}</h3>
                                                            <?php $hitung = 0;?>
                                                            @foreach($datas as $ts)
                                                                @if($ts->resource_id == $item->id)
                                                                    <?php
                                                                    $hitung += $ts->man_hours;
                                                                    ?>
                                                                @endif
                                                            @endforeach
                                                        <div class="box-tools pull-right">
                                                            <span class="label label-success"><?php echo $hitung." "."jam"; ?> </span> &nbsp;
                                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        <!-- /.box-tools -->
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <table class="text-muted">
                                                           
                                                            <?php
                                                                $detail_resource = TimeSheetUser::where('status',1)
                                                                                    ->where('cost_account_id',2)
                                                                                    ->where('proposal_id', $p->id)
                                                                                    ->where('resource_id',$item->id)
                                                                                    ->get();
                                                            ?>
                                                            
                                                            @foreach ($detail_resource as $det)
                                                            <tr>
                                                                <?php $hitung_man_hours = 0;
                                                                     $hitung_man_hours += $det->man_hours;
                                                                ?>
                                                                <td>{{$loop->iteration}}. {{$det->getNama->nama}} &nbsp; </td>
                                                                <td>: &nbsp; <?php echo $hitung_man_hours." "."jam" ?></td>
                                                            </tr>
                                                            @endforeach
                                                            
                                                            </table>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                </div>
                                           
                                            @endforeach 
                                        </div>
                                        @endforeach
                                    {{-- </table> --}}
                                    
                            </div>
                        </div>
                      </li> 
                      <li>
                        <i class="fa fa-bar-chart bg-green"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header"><b>Persentase Man Hours(%)</b></h3>
                            <div class="timeline-body">
                                    <div id="piechart" style="display: block;">
                                    </div>
                            </div>
                        </div>
                      </li> 
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                    <!-- END timeline item -->
                </ul>
            </div>
     
    <!-- /.box -->

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
$(function(){
  $("#data-tables").DataTable();
});

// Chart 
google.charts.load('current', {
  callback: function () {
    var container = document.getElementById('piechart');
    var chart = new google.visualization.PieChart(container);

    var data = google.visualization.arrayToDataTable([
        ['Role', 'Total Hours'],
           @php 
           foreach($chart_proposal as $cp) {
                echo "['".$cp->resourceName->nama_posisi."',".$cp->total_man_hours."],";
                }
           @endphp
    ]);

    var options = {
        width: '550',
        height: '450',
        chartArea: {
            width: '80%',
            height: '80%',
            left: 100,
      },
      pieSliceTextStyle: {
        color: 'white',
        fontSize: '12.5'
      },
      colors: ['#90c458', '#ff3f1a', '#ffce55', '#52c2e8'],
      title:"Persentase Total Man Hours(%)"
    //   is3D: true,
    };

    chart.draw(data, options);
  },
  packages: ['corechart']
});
</script>
@endpush


