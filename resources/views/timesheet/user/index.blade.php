<?php
foreach($hari_libur  as $libur){
      $liburs = $libur->tanggal;
  }
?>

@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
      <b>Timesheet</b>
    </span>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('time-sheet')}}"> Timesheet </a></li>
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
              <h4><i class="icon fa fa-ban"></i> Alert !</h4>
              {{ session()->get('failed') }}
            </div>
            @endif

            <div class="col-md-12">
              <div style="margin-bottom: 20px">
                <a href="{{url('time-sheet/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Timesheet </a>
              </div>
              
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#all" data-toggle="tab">All</a></li>
                  <li><a href="#Senin" data-toggle="tab">Monday</a></li>
                  <li><a href="#Selasa" data-toggle="tab">Tuesday</a></li>
                  <li><a href="#Rabu" data-toggle="tab">Wednesday</a></li>
                  <li><a href="#Kamis" data-toggle="tab">Thursday</a></li>
                  <li><a href="#Jumat" data-toggle="tab">Friday</a></li>
                  <li><a href="#HariLibur" data-toggle="tab">Day Off</a></li>
                </ul>
                <div class="tab-content">
                    
        
            {{-- ALL --}}
            <div class="active tab-pane" id="all">
                <div class="row">
                <div class="col-md-3">
                    <div class="box box-default">
                        <div class="box-header with-border" style="background-color: #80808038;">
                            <h3 class="box-title" style="font-size:14px;"><b>Summary Timesheet</b></h3>
        
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-up"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        
                        <form role="form" name="formdata" method="post" action="{{url('summary-timesheet')}}/{{Auth::user()->username}}">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                        <select class="form-control select2" name="year" id="year" style="width: 100%;">
                                            <option selected disabled>Select year</option>
                                            <?php
                                                $thn_skr = date('Y', strtotime("-1 year"));
                                            for ($year = $thn_skr; $year <= 2025; $year++) {
                                                ?>
                                                    <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <select class="form-control select2" name="month" id="month" style="width: 100%;">
                                            <option selected disabled> Select month</option>
                                            <option value = "01">January</option>
                                            <option value = "02">February</option>
                                            <option value = "03">March</option>
                                            <option value = "04">April</option>
                                            <option value = "05">May</option>
                                            <option value = "06">June</option>
                                            <option value = "07">July</option>
                                            <option value = "08">August</option>
                                            <option value = "09">September</option>
                                            <option value = "10">October</option>
                                            <option value = "11">November</option>
                                            <option value = "12">December</option>
                                        </select>
                                </div>
                            </div>
                        
                        <div class="box-footer">
                            {{-- <a href="{{url('all-timesheet')}}/{{$get_id}}" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a> --}}
                            <button type="submit" class="btn btn-primary" ><span class="fa fa-download"></span>&nbsp; Export Summary</button>
                        </div>
                        <!-- /.box-body -->
                    </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            
            {{-- ALL DATA --}}
              <div class="table-responsive">
                <table id="all-data" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Date of Work</th>
                            <th>Scope of Work</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Manhours</th>
                            <th>Detail of Work</th>
                            <th>Status</th>
                            <th>Approved By</th>
                            <th style="width:35px;">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($time_sheet as $k => $d)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            {{-- <td>{{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td> --}}
                            
                              @if(date('l', strtotime($d->tanggal_kerja)) == "Sunday" && $d->tanggal_kerja != $liburs)
                                <td>Sunday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @elseif(date('l', strtotime($d->tanggal_kerja)) == "Monday" && $d->tanggal_kerja != $liburs)
                                <td>Monday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @elseif(date('l', strtotime($d->tanggal_kerja)) == "Tuesday" && $d->tanggal_kerja != $liburs)
                                <td>Tuesday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @elseif(date('l', strtotime($d->tanggal_kerja)) == "Wednesday" && $d->tanggal_kerja != $liburs)
                                <td>Wednesday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @elseif(date('l', strtotime($d->tanggal_kerja)) == "Thursday" && $d->tanggal_kerja != $liburs)
                                <td>Thursday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @elseif(date('l', strtotime($d->tanggal_kerja)) == "Friday" && $d->tanggal_kerja != $liburs)
                                <td>Friday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @elseif(date('l', strtotime($d->tanggal_kerja)) == "Saturday" && $d->tanggal_kerja != $liburs)
                                  <td>Saturday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @else
                                  <td>National holiday/Mass leave, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                              @endif

                            <td><center>{{$d->getCostAccount->nama}}</center></td>
                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                            <td>{{$d->man_hours}} hours</td>
                            <td>
                                @if($d->desc_for_project != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}
                                @elseif($d->desc_for_proposal != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}
                                @elseif($d->desc_for_ho != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                                @else 
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->detail_of_work)) !!}
                                @endif
                            </td>

                            @if($d->status == 0)
                              <td><span class="label label-warning">Waiting</span></td>
                            @elseif($d->status == 1)
                              <td><span class="label label-success">Approved</span></td>
                            @else
                            <td><span class="label label-danger">Rejected</span></td>
                            @endif
                            <td>{{$d->approved_by}}</td>
                            @if($d->status == 0)
                              <td>
                                <center>
                                  <a href="{{route('edit-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                  <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                </center>
                              </td>
                            @else
                            <td>
                              <center>
                                <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                <button class='btn btn-xs btn-default' data-id="#" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                              <center>
                              </td>
                            @endif
                          </tr>
                          @endforeach
                      </tbody>
                </table>
                </div>
            </div>

{{-- SENIN --}}
        <div class="tab-pane" id="Senin">
          <div class="table-responsive">
            <table id="senin" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                <thead>
                    <tr>
                        <th>Date of Work</th>
                        <th>Scope of Work</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Manhours</th>
                        <th>Detail of Work</th>
                        <th>Status</th>
                        <th>Approved By</th>
                        <th style="width:35px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($time_sheet as $k => $d)
                    @if(date('l', strtotime($d->tanggal_kerja)) == "Monday" && $d->tanggal_kerja != $liburs)
                      <tr>
                        <td>{{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}
                        <td><center>{{$d->getCostAccount->nama}}</center></td>
                        <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                        <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                        <td>{{$d->man_hours}} hours</td>
                        <td>
                            @if($d->desc_for_project != NULL)
                                {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}
                            @elseif($d->desc_for_proposal != NULL)
                                {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}
                            @elseif($d->desc_for_ho != NULL)
                                {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                            @else 
                                {!! preg_replace("/<p>/", '-'.' ' , ($d->detail_of_work)) !!}
                            @endif
                        </td>
                        @if($d->status == 0)
                          <td><span class="label label-warning">Waiting</span></td>
                        @elseif($d->status == 1)
                          <td><span class="label label-success">Approved</span></td>
                        @else
                            <td><span class="label label-danger">Rejected</span></td>
                        @endif
                        <td>{{$d->approved_by}}</td>
                        @if($d->status == 0)
                          <td>
                            <center>
                              <a href="{{route('edit-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                              <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                            </center>
                            </td>
                        @else
                          <td>
                            <center>
                              <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                              <button class='btn btn-xs btn-default' data-id="#" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                            </center>
                            </td>
                        @endif
                        
                      </tr>
                      @endif
                      @endforeach
                  </tbody>
            </table>
            </div>
            </div>

{{-- SELASA --}}
            <div class="tab-pane" id="Selasa">
              <div class="table-responsive">
                <table id="selasa" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th>Date of Work</th>
                            <th>Scope of Work</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Manhours</th>
                            <th>Detail of Work</th>
                            <th>Status</th>
                            <th>Approved By</th>
                            <th style="width:35px;">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($time_sheet as $k => $d)
                        @if(date('l', strtotime($d->tanggal_kerja)) == "Tuesday" && $d->tanggal_kerja != $liburs)
                          <tr>
                            <td>{{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}
                            <td><center>{{$d->getCostAccount->nama}}</center></td>
                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                            <td>{{$d->man_hours}} hours</td>
                            <td>
                                @if($d->desc_for_project != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}
                                @elseif($d->desc_for_proposal != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}
                                @elseif($d->desc_for_ho != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                                @else 
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->detail_of_work)) !!}
                                @endif
                            </td>
                            
                            @if($d->status == 0)
                              <td><span class="label label-warning">Waiting</span></td>
                            @elseif($d->status == 1)
                              <td><span class="label label-success">Approved</span></td>
                            @else
                            <td><span class="label label-danger">Rejected</span></td>
                            @endif

                            <td>{{$d->approved_by}}</td>
                            @if($d->status == 0)
                            <td>
                              <center>
                                <a href="{{route('edit-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                              </center>
                            </td>
                          @else
                            <td>
                              <center>
                                <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                <button class='btn btn-xs btn-default' data-id="#" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                              </center>
                              </td>
                          @endif
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                </table>
                </div>
            </div>

{{-- RABU --}}
            <div class="tab-pane" id="Rabu">
              <div class="table-responsive">
                <table id="rabu" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                          <th>Date of Work</th>
                          <th>Scope of Work</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Manhours</th>
                          <th>Detail of Work</th>
                          <th>Status</th>
                          <th>Approved By</th>
                          <th style="width:35px;">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($time_sheet as $k => $d)
                        @if(date('l', strtotime($d->tanggal_kerja)) == "Wednesday" && $d->tanggal_kerja != $liburs)
                          <tr>
                            <td>{{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}
                            <td><center>{{$d->getCostAccount->nama}}</center></td>
                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                            <td>{{$d->man_hours}} hours</td>
                            <td>
                                @if($d->desc_for_project != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}
                                @elseif($d->desc_for_proposal != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}
                                @elseif($d->desc_for_ho != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                                @else 
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->detail_of_work)) !!}
                                @endif
                            </td>
                            @if($d->status == 0)
                              <td><span class="label label-warning">Waiting</span></td>
                            @elseif($d->status == 1)
                              <td><span class="label label-success">Approved</span></td>
                            @else
                            <td><span class="label label-danger">Rejected</span></td>
                            @endif
                            <td>{{$d->approved_by}}</td>
                            @if($d->status == 0)
                              <td>
                                <center>
                                  <a href="{{route('edit-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                  <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                </center>
                                </td>
                            @else
                              <td>
                                <center>
                                  <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                  <button class='btn btn-xs btn-default' data-id="#" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                </center>
                                </td>
                            @endif
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                </table>
                </div>
            </div>

{{-- KAMIS --}}
            <div class="tab-pane" id="Kamis">
              <div class="table-responsive">
                <table id="kamis" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                          <th>Date of Work</th>
                          <th>Scope of Work</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Manhours</th>
                          <th>Detail of Work</th>
                          <th>Status</th>
                          <th>Approved By</th>
                          <th style="width:35px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($time_sheet as $k => $d)
                        @if(date('l', strtotime($d->tanggal_kerja)) == "Thursday" && $d->tanggal_kerja != $liburs)
                          <tr>
                              <td>{{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}
                              <td><center>{{$d->getCostAccount->nama}}</center></td>
                              <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                              <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                              <td>{{$d->man_hours}} hours</td>
                              <td>
                                    @if($d->desc_for_project != NULL)
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}
                                    @elseif($d->desc_for_proposal != NULL)
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}
                                    @elseif($d->desc_for_ho != NULL)
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                                    @else 
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->detail_of_work)) !!}
                                    @endif
                              </td>
                              @if($d->status == 0)
                                <td><span class="label label-warning">Waiting</span></td>
                              @elseif($d->status == 1)
                                <td><span class="label label-success">Approved</span></td>
                              @else
                              <td><span class="label label-danger">Rejected</span></td>
                              @endif
                              <td>{{$d->approved_by}}</td>
                              @if($d->status == 0)
                                <td>
                                  <center>
                                    <a href="{{route('edit-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                  </center>
                                </td>
                              @else
                                <td>
                                    <center>
                                      <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                      <button class='btn btn-xs btn-default' data-id="#" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                    </center>
                                </td>
                              @endif
                            </tr>
                            @endif
                          @endforeach
                      </tbody>
                </table>
              </div>
            </div>


{{-- JUMAT --}}
            <div class="tab-pane" id="Jumat">
              <div class="table-responsive">
                <table id="jumat" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                          <th>Date of Work</th>
                          <th>Scope of Work</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Manhours</th>
                          <th>Detail of Work</th>
                          <th>Status</th>
                          <th>Approved By</th>
                          <th style="width:35px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($time_sheet as $k => $d)
                        @if(date('l', strtotime($d->tanggal_kerja)) == "Friday" && $d->tanggal_kerja != $liburs)
                          <tr>
                              <td>{{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}
                              <td><center>{{$d->getCostAccount->nama}}</center></td>
                              <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                              <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                              <td>{{$d->man_hours}} hours</td>
                              <td>
                                    @if($d->desc_for_project != NULL)
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}
                                    @elseif($d->desc_for_proposal != NULL)
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}
                                    @elseif($d->desc_for_ho != NULL)
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                                    @else 
                                        {!! preg_replace("/<p>/", '-'.' ' , ($d->detail_of_work)) !!}
                                    @endif
                              </td>

                              @if($d->status == 0)
                                <td><span class="label label-warning">Waiting</span></td>
                              @elseif($d->status == 1)
                                <td><span class="label label-success">Approved</span></td>
                              @else
                              <td><span class="label label-danger">Rejected</span></td>
                              @endif
                              <td>{{$d->approved_by}}</td>
                            
                              @if($d->status == 0)
                                <td>
                                  <center>
                                    <a href="{{route('edit-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                  </center>
                                  </td>
                              @else
                                <td>
                                  <center>
                                    <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <button class='btn btn-xs btn-default' data-id="#" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                  </center>
                                </td>
                              @endif
                            </tr>
                          @endif
                          @endforeach
                      </tbody>
                </table>
                </div>
            </div>

    {{-- HARI LIBUR --}}
            <div class="tab-pane" id="HariLibur">
              <div class="table-responsive">
                <table id="libur" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th>Date of Work</th>
                            <th>Day</th>
                            <th>Scope of Work</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Manhours</th>
                            <th>Detail of Work</th>
                            <th>Status</th>
                            <th>Approved By</th>
                            <th style="width:35px;">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                     
                      @foreach($time_sheet as $k => $d)
                        @if(date('l', strtotime($d->tanggal_kerja)) == "Sunday" || date('l', strtotime($d->tanggal_kerja)) == "Saturday" || $d->tanggal_kerja == $liburs)
                          <tr>
                            <td>{{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}
                            @if(date('l', strtotime($d->tanggal_kerja)) == "Sunday")
                                <td>Sunday</td>
                            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Saturday")
                                <td>Saturday</td>
                            @elseif($d->tanggal_kerja == $liburs)
                                <td>National Holidays/Collective Leave</td>
                            @endif

                            <td><center>{{$d->getCostAccount->nama}}</center></td>
                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                            <td>{{$d->man_hours}} hours</td>

                            <td>
                                @if($d->desc_for_project != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_project)) !!}
                                @elseif($d->desc_for_proposal != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_proposal)) !!}
                                @elseif($d->desc_for_ho != NULL)
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                                @else 
                                    {!! preg_replace("/<p>/", '-'.' ' , ($d->detail_of_work)) !!}
                                @endif
                            </td>
                            @if($d->status == 0)
                              <td><span class="label label-warning">Waiting</span></td>
                            @elseif($d->status == 1)
                              <td><span class="label label-success">Approved</span></td>
                            @else
                            <td><span class="label label-danger">Rejected</span></td>
                            @endif
                            <td>{{$d->approved_by}}</td>
                            @if($d->status == 0)
                              <td>
                                <center>
                                  <a href="{{route('edit-timesheet',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                  <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                </center>
                              </td>
                             @else
                              <td>
                                <center>
                                  <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class="glyphicon glyphicon-pencil"></span></a>
                                  <button class='btn btn-xs btn-default' data-id="#" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                </center>
                              </td>
                              @endif
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                </table>
                </div>
            </div>

                </div>
              </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->

@include('timesheet.user.confirm')

<!-- end of modal konfirmasi -->
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="{{ asset('AdminLTE-2.3.11/plugins/select2/select2.min.css') }}">
<script src="{{asset('AdminLTE-2.3.11/plugins/select2/select2.full.min.js')}}"></script>

<script>
$('.select2').select2();

$(function(){
   var mainTable = $('#senin').DataTable();
   var tb_selasa = $("#selasa").DataTable();
   var tb_rabu = $("#rabu").DataTable();
   var tb_kamis = $("#kamis").DataTable();
   var tb_jumat = $("#jumat").DataTable();
   var tb_libur = $("#libur").DataTable();
   var tb_all = $("#all-data").DataTable();

   var selectedRow;
   var selectedRow1;
   var selectedRow2;
   var selectedRow3;
   var selectedRow4;
   var selectedRow5;
   var selectedRow6;

  $('#senin').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow = mainTable.row( $(this).parents('tr') );

    $("#modal-konfirmasi").modal('show');

    $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
    $("#konfirmasi-body").text("Hapus TimeSheet?");
  });

  $('#confirm-delete').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "time-sheet/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');

          selectedRow.remove().draw();

          $("#modal-konfirmasi").modal('hide');

          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
               
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });

  $('#selasa').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow1 = tb_selasa.row( $(this).parents('tr') );

    $("#modal-konfirmasi2").modal('show');

    $("#modal-konfirmasi2").find("#confirm-delete2").data("id", $(this).data('id'));
    $("#konfirmasi-body2").text("Hapus TimeSheet?");
  });

  $('#confirm-delete2').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "time-sheet/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');

          selectedRow1.remove().draw();

          $("#modal-konfirmasi2").modal('hide');

          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
               
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });

  $('#rabu').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow2 = tb_rabu.row( $(this).parents('tr') );

    $("#modal-konfirmasi3").modal('show');

    $("#modal-konfirmasi3").find("#confirm-delete3").data("id", $(this).data('id'));
    $("#konfirmasi-body3").text("Hapus TimeSheet?");
  });

  $('#confirm-delete3').click(function(){
      var deleteButton = $(this);
      var id        = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "time-sheet/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');

          selectedRow2.remove().draw();

          $("#modal-konfirmasi3").modal('hide');

          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
               
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });

  $('#kamis').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow3 = tb_kamis.row( $(this).parents('tr') );

    $("#modal-konfirmasi4").modal('show');

    $("#modal-konfirmasi4").find("#confirm-delete4").data("id", $(this).data('id'));
    $("#konfirmasi-body").text("Hapus TimeSheet?");
  });

  $('#confirm-delete4').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "time-sheet/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');

          selectedRow3.remove().draw();

          $("#modal-konfirmasi4").modal('hide');

          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
               
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });

  $('#jumat').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow4 = tb_jumat.row( $(this).parents('tr') );

    $("#modal-konfirmasi5").modal('show');

    $("#modal-konfirmasi5").find("#confirm-delete5").data("id", $(this).data('id'));
    $("#konfirmasi-body5").text("Hapus TimeSheet?");
  });

  $('#confirm-delete5').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "time-sheet/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');

          selectedRow4.remove().draw();

          $("#modal-konfirmasi5").modal('hide');

          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
               
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });


  $('#libur').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow5 = tb_libur.row( $(this).parents('tr') );

    $("#modal-konfirmasi6").modal('show');

    $("#modal-konfirmasi6").find("#confirm-delete6").data("id", $(this).data('id'));
    $("#konfirmasi-body6").text("Hapus TimeSheet?");
  });

  $('#confirm-delete6').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "time-sheet/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');

          selectedRow5.remove().draw();

          $("#modal-konfirmasi6").modal('hide');

          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
               
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });

  $('#all-data').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow6 = tb_all.row( $(this).parents('tr') );

    $("#modal-konfirmasi7").modal('show');

    $("#modal-konfirmasi7").find("#confirm-delete7").data("id", $(this).data('id'));
    $("#konfirmasi-body7").text("Hapus TimeSheet?");
  });

  $('#confirm-delete7').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");

      deleteButton.button('loading');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "time-sheet/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
        },
        success: function (response)
        {
          deleteButton.button('reset');

          selectedRow6.remove().draw();

          $("#modal-konfirmasi7").modal('hide');

          Swal.fire({
            title: response.success,
            // text: response.success,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
               
            }
          })
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
  });

});
</script>
@endpush 