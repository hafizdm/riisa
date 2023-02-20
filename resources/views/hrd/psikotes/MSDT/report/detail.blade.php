@extends('templates.header')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Report</li>
    </ol>
  </section>
<br>
  <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12">
          <div class="box" style="border-top: none !important;">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-lg-12">
                 <center> <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MSDT REPORT</b></h4></center>
                  <hr>
              </div>
            </div>
                <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6 col-xs-12 col-lg-6">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title" style="font-size: 17px !important;"><b>CANDIDATE INFORMATION</b></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <table width="100%">
                                  <tr>
                                      <td>Full Name </td>
                                      <td>: &nbsp; {{$candidate->full_name}} </td>
                                  </tr>
      
                                  <tr>
                                      <td>Last Education </td>
                                      <td>: &nbsp; {{$candidate->last_education}} </td>
                                  </tr>
      
                                  <tr>
                                      <td>Job Applied </td>
                                      <td>: &nbsp; {{$candidate->job_applied}} </td>
                                  </tr>
      
                                  <tr>
                                      <td>Test Schedule</td>
                                      <td>: &nbsp; {{ date('d M Y H:i', strtotime($candidate->test_schedule)) }}</td>
                                  </tr>
      
                                  <tr>
                                      <td>Test Status</td>
                                      <td>: &nbsp; 
                                          @if($candidate->status_psikotes3 == 0)
                                              <span>No</span>
                                          @else
                                              <span>Yes</span>
                                          @endif
                                      </td>
                                  </tr>
      
                              </table>
                            </div>
                            <!-- /.box-body -->
                          </div>
                        </div>
      
                        <div class="col-md-3">
                      </div>
                </div>
                <div class="row">
                  <div class="col-md-9">
                    <h4><center><b>SCORE</b></center></h4>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                          <thead>
                             @foreach ($dt as $items)
                                <th> <center>{{$items}} </center></th> 
                             @endforeach
                          </thead>
                          <tbody>
                            <tr>
                              @foreach ($all as $item)
                                  <td> <center>{{$item}} </center></td>
                              @endforeach
                            </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <h4><center><b>RESULT</b></center></h4>
                    <hr>
                    <span style="font-size: 20px;color:red"><center><b>
                        @if($desc == "")
                            -
                        @else
                            "{{$desc}}"
                        @endif
                        </b></center></span>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
  </section>

@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endpush