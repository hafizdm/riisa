@extends('templates.header')

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Score & Chart</li>
    </ol>
  </section>
<br>
  <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12">
          <div class="box" style="border-top: none !important;">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-lg-12">
                 <center> <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>DISC REPORT</b></h4></center>
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
                                          @if($candidate->status_psikotes2 == 0)
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
                    <h4><center><b>SCORE RESULT</b></center></h4>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                          <thead>
                              <th width="5%"><center>Chart</center></th>
                              <th width="15%"></th>
                              <th><center>D</center></th>
                              <th><center>I</center></th>
                              <th><center>S</center></th>
                              <th><center>C</center></th>
                              <th><center>*</center></th>
                              <th><center>Total</center></th>
                              <th width="10%"></th>
                          </thead>
                          <tbody>
                            <tr>
                              <td style="text-align:-webkit-center;">
                                <table>
                                    <tr><td>1</td></tr>
                                    <tr><td>2</td></tr>
                                    <tr><td>3</td></tr>
                                </table>
                              </td>
                              <td>
                                <table>
                                    <tr><td><b>MOST</b></td></tr>
                                    <tr><td><b>LEAST</b></td></tr>
                                    <tr><td><b>CHANGE</b></td></tr>
                                </table>
                              </td>
                              @if($datas == [])
                                <td style="text-align:-webkit-center;">
                                  <table>
                                    <tr><td>-</td></tr>
                                    <tr><td>-</td></tr>
                                    <tr>
                                      <td>
                                        <span>-</span>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <td style="text-align:-webkit-center;">
                                  <table>
                                    <tr><td>-</td></tr>
                                    <tr><td>-</td></tr>
                                    <tr>
                                      <td>
                                        <span>-</span>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <td style="text-align:-webkit-center;">
                                  <table>
                                    <tr><td>-</td></tr>
                                    <tr><td>-</td></tr>
                                    <tr>
                                      <td>
                                        <span>-</span>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <td style="text-align:-webkit-center;">
                                  <table>
                                    <tr><td>-</td></tr>
                                    <tr><td>-</td></tr>
                                    <tr>
                                      <td>
                                        <span>-</span>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <td style="text-align:-webkit-center;">
                                  <table>
                                    <tr><td>-</td></tr>
                                    <tr><td>-</td></tr>
                                    <tr>
                                      <td>
                                        <span>-</span>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                

                              @else
                                  @foreach ($datas as $item)
                                    <td style="text-align:-webkit-center;">
                                      <table>
                                        <?php $split = explode(" ", $item);?>
                                        <tr><td>{{$split[1]}}</td></tr>
                                        <tr><td>{{$split[2]}}</td></tr>
                                        <tr>
                                          <td>
                                            @if($split[0] == 6)
                                              <?php 
                                                $star = $split[1] + $split[2];
                                                echo $star;
                                              ?>
                                            @else
                                              {{$split[3]}}
                                            @endif
                                          </td>
                                        </tr>
                                    </table>
                                    </td>
                                  @endforeach
                                @endif
                              <td style="text-align:-webkit-center;">
                                <table>
                                  <tr><td>{{$getVal->score_plus}}</td></tr>
                                  <tr><td>{{$getVal->score_minus}}</td></tr>
                                  <tr><td></td></tr>
                                </table>
                              </td>
                              <td>
                                <table>
                                  <tr><td><center>Must Equal 24</center></td></tr>
                                  <tr><td><center>Must Equal 24</center></td></tr>
                                  <tr><td></td></tr>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                  <div class="col-md-12">
                      <h4><center><b>SCALE RESULT</b></center></h4>
                          <table class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th colspan="4" style="background-color: #ddd"><center>Mask, Public Self (MOST)</center></th>
                                </tr>
                                <tr>
                                  <th><center>D-Scale</center></th>
                                  <th><center>I-Scale</center></th>
                                  <th><center>S-Scale</center></th>
                                  <th><center>C-Scale</center></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <center>
                                      @if($result_D_most == "-")
                                        {{$result_D_most}}
                                      @else
                                        @foreach ($newMostD as $item)
                                          @if($D_most == $item)
                                              {{$result_D_most->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      @if($result_I_most == "-")
                                        {{$result_I_most}}
                                      @else
                                        @foreach ($newMostI as $item)
                                          @if($I_most == $item)
                                              {{$result_I_most->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      @if($result_S_most == "-")
                                        {{$result_S_most}}
                                      @else
                                        @foreach ($newMostS as $item)
                                          @if($S_most == $item)
                                              {{$result_S_most->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      @if($result_C_most == "-")
                                        {{$result_C_most}}
                                      @else
                                        @foreach ($newMostC as $item)
                                          @if($C_most == $item)
                                              {{$result_C_most->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                </tr>
                             
                              </tbody>
                          </table>

                          <table class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th colspan="4" style="background-color: #ddd"><center>Core Private Self (LEAST)</center></th>
                                </tr>
                                <tr>
                                  <th><center>D-Scale</center></th>
                                  <th><center>I-Scale</center></th>
                                  <th><center>S-Scale</center></th>
                                  <th><center>C-Scale</center></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <center>
                                      @if($result_D_least == "-")
                                        {{$result_D_least}}
                                      @else
                                        @foreach ($newLeastD as $item)
                                          @if($D_least == $item)
                                              {{$result_D_least->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      @if($result_I_least == "-")
                                        {{$result_I_least}}
                                      @else
                                        @foreach ($newLeastI as $item)
                                          @if($I_least == $item)
                                              {{$result_I_least->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      @if($result_S_least == "-")
                                        {{$result_S_least}}
                                      @else
                                        @foreach ($newLeastS as $item)
                                          @if($S_least == $item)
                                              {{$result_S_least->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      @if($result_C_least == "-")
                                        {{$result_C_least}}
                                      @else
                                        @foreach ($newLeastC as $item)
                                          @if($C_least == $item)
                                              {{$result_C_least->skala}}
                                          @else 
                                              
                                          @endif
                                        @endforeach
                                      @endif
                                    </center>
                                  </td>
                                </tr>
                              </tbody>
                          </table>

                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th colspan="4" style="background-color: #ddd"><center>Mirror, Perceived Self (CHANGE)</center></th>
                              </tr>
                              <tr>
                                <th><center>D-Scale</center></th>
                                <th><center>I-Scale</center></th>
                                <th><center>S-Scale</center></th>
                                <th><center>C-Scale</center></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <center>
                                        @if($result_D_change == "-")
                                          {{$result_D_change}}
                                        @else
                                          @foreach ($new as $item)
                                            @if($D_change == $item)
                                                {{$result_D_change->skala}}
                                            @else 
                                                
                                            @endif
                                          @endforeach
                                        @endif
                                  </center>
                                </td>
                                <td>
                                  <center>
                                    @if($result_I_change == "-")
                                          {{$result_I_change}}
                                    @else
                                      @foreach ($new2 as $item)
                                        @if($I_change == $item)
                                            {{$result_I_change->skala}}
                                        @else 
                                            
                                        @endif
                                      @endforeach
                                    @endif
                                  </center>
                                </td>
                                <td>
                                  <center>
                                    @if($result_S_change == "-")
                                          {{$result_S_change}}
                                    @else
                                      @foreach ($new3 as $item)
                                        @if($S_change == $item)
                                            {{$result_S_change->skala}}
                                        @else 
                                            
                                        @endif
                                      @endforeach
                                    @endif
                                  </center>
                                </td>
                                <td>
                                  <center>
                                    @if($result_C_change == "-")
                                          {{$result_C_change}}
                                    @else
                                      @foreach ($new4 as $item)
                                        @if($C_change == $item)
                                            {{$result_C_change->skala}}
                                        @else 
                                            
                                        @endif
                                      @endforeach
                                    @endif
                                  </center>
                                </td>
                              </tr>
                            </tbody>
                        </table>
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