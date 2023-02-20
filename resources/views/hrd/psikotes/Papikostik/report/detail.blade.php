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
                 <center> <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PAPIKOSTICK REPORT</b></h4></center>
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
                                          @if($candidate->status_psikotes1 == 0)
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
            <hr>
              <div class="row">
                <div class="col-md-3">
                    <h4><center><u><b>SCORE RESULT</b></u></center></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <th><center>Category</center></th>
                                <th><center>Score</center></th>
                            </thead>
                            <tbody>
                              @foreach($category as $ct)
                                  @foreach ($score as $item)
                                  <tr>
                                      @if($item->KategoriScoring->nama_kategori == $ct)
                                        <td><center>{{$ct}}</center></td>
                                        <td><center>{{$item->score_result}}</center></td>
                                      @endif
                                  </tr>
                                  @endforeach
                              @endforeach
                                {{-- @foreach($score as $item)
                                    <tr>
                                        <td><center>{{$item->KategoriScoring->nama_kategori}}</center></td>
                                        <td><center>{{$item->score_result}}</center></td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-9">
                    <h4><center><u><b>PAPIKOSTICK CIRCLE</b></u></center></h4>
                    <canvas id="marksChart" width="600" height="400"></canvas>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                  <div class="box box-widget collapsed-box">
                    <div class="box-header with-border" style="text-align: center;">
                      <h3 class="box-title"><b><u>PAPIKOSTICK DESCRIPTION</u></b></h3>
        
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead style="background:#3c8dbc">
                                <th>Category</th>
                                <th>Score</th>
                                <th><center>Description</center></th>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    @foreach($result as $des)
                                      @if($des->getNamaKategori2->nama_kategori == $item)
                                        <tr>
                                          <td><center><b>{{$des->getNamaKategori2->nama_kategori}}</b></center></td>
                                          <td><center>{{$des->nilai}}</center></td>
                                          <td style="text-align: justify;">{{$des->keterangan}}</td>
                                        </tr>
                                      @endif
                                  @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    var marksCanvas = document.getElementById("marksChart");

    var marksData = {
    labels: ["N", "G", "A", "L", "P", "I","T","V","X","S","B","O","R","D","C","Z","E","K","F","W"],
    datasets: [{
            label: "Total score",
            borderColor: "rgb(135,206,235)",
            data: @json($dataChart)
        }]
    };

    var radarChart = new Chart(marksCanvas, {
    type: 'radar',
    data: marksData
    });
</script>
@endpush