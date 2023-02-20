@extends('templates.header')
<?php
use App\ScoreMBTI;
$checkdata = ScoreMBTI::where('id_candidate', $candidate->id)->count();
?>
@section('content')
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Score</li>
    </ol>
  </section>
<br>
  <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12">
          <div class="box" style="border-top: none !important;">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-lg-12">
                 <center> <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MBTI REPORT</b></h4></center>
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
                                          @if($candidate->status_psikotes4 == 0)
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
                  <div class="col-md-12">
                    <h4><center><b>DIMENSION</b></center></h4>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                            <tr>
                                <td style="text-align: right"><span><b>INTROVERT (I)</b></span></td>
                                <td>
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$I[1]}}%
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$E[1]}}%</td>
                                    @endif
                                <td><b>EXTROVERT (E)</b></td>
                            </tr>

                            <tr>
                                <td style="text-align: right"><b>SENSING (S)</b></td>
                                <td>
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$S[1]}}%
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$N[1]}}%
                                    @endif
                                </td>
                                <td><b>INTUITION (N)</b></td>
                            </tr>

                            <tr>
                                <td style="text-align: right"><b>THINKING (T)</b></td>
                                <td>
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$T[1]}}%
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$F[1]}}%
                                    @endif
                                </td>
                                <td><b>FEELING (F)</b></td>
                            </tr>

                            <tr>
                                <td style="text-align: right"><b>JUDGING (J)</b></td>
                                <td>
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$J[1]}}%
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if($checkdata ==0)
                                        0%
                                    @else
                                        {{$P[1]}}%</td>
                                    @endif
                                <td><b>PERCEIVING (P)</b></td>
                            </tr>

                      </table>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4><center><u><b>PERSONALITY TYPE RESULT:</b></u></center></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-2">
                        <center>
                            @if($resAll == "-")
                                <h2 style="background-color: rgba(204, 17, 17, 0.815)"><b>{{$resAll}}</b></h2>
                            @else
                                <h2 style="background-color: rgb(98, 216, 98)"><b>{{$resAll}}</b></h2>
                            @endif
                        </center>
                    </div>
                    <div class="col-md-5">

                    </div>
                </div>
                <br>
            </div>
          </div>
        </div>
      </div>
  </section>

@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endpush