@extends('templates.header')

@section('content')

<section class="content-header">
    <span class="fonts" style="font-size:20px">
    <b>
        Timesheet 
    </b>
    </span>
    <ol class="breadcrumb">
    <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="#">Timesheet Approval</a></li>
    </ol>
</section>

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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#approvals" data-toggle="tab"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; Approval Timesheet</a></li>
                        @if(Auth::user()->username == "HO201902003")
                            <li><a href="#total_man_hours" data-toggle="tab"><i class="fa fa-bar-chart"></i>&nbsp; Report Timesheet</a></li>
                        @else

                        @endif
                  </ul>
                  <div class="tab-content">

                    {{-- Approval Timesheet --}}
                    <div class="active tab-pane" id="approvals">
                        <div class="table-responsive">
                            <table id="data-tables" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"><center><input type="checkbox" id="selectAllApprove" name="selectAllApprove"></center><button class="btn btn-success btn-xs" id="btnSelectAll" name="btnSelectAll"><span>Approve All</span></button></th>
                                        <th><center>No</center></th>
                                        <th>Date of Work</th>
                                        <th>Employee's name</th>
                                        <th>Scope of Work</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Detail of Work</th>
                                        <th>Status</th>
                                        <th><center>Action</center></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($timesheet as $d)
                                      <tr>
                                            <td><center><input type="checkbox" name="deleteAll[]" onclick="partialSelected()" class="bulkSelectAll" id="bulkSelectName" value="{{$d->id}}"></center></td>
                                            <td><center>{{$loop->iteration}}</center></td>
                                            @if((date('l', strtotime($d->tanggal_kerja))) == "Monday")
                                                <td>Monday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Tuesday")
                                                <td>Tuesday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Wednesday")
                                                <td>Wednesday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Thursday")
                                                <td>Thursday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Friday")
                                                <td>Friday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Saturday")
                                                <td>Saturday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td> 
                                            @elseif((date('l', strtotime($d->tanggal_kerja))) == "Sunday")
                                                <td>Sunday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>      
                                            @endif

                                            <td>{{$d->getNama ? $d->getNama->nama : ''}}</td>
                                            <td><center>{{$d->getCostAccount ? $d->getCostAccount->nama : ''}}</center></td>
                                            <td><center>{{ date('H:i', strtotime($d->start_time)) }}</center></td>
                                            <td><center>{{ date('H:i', strtotime($d->end_time)) }}</center></td>
                                            {{-- <td>{{$d->workingType->nama}}</td> --}}
                                            
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
                                                <td><span class="label label-danger">Waiting</span></td>
                                            @else 
                                                <td><span class="label label-success">Approved</span></td>
                                            @endif

                                            <td>
                                                <center>
                                                    <form name="formdata" method="post" action="{{route('update-timesheet-all', $d->id)}}" style="display: inline">
                                                        @method('PATCH') 
                                                        @csrf  
                                                        <input type="hidden" value="1" name="status" id="status">
                                                        <button type="submit" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-check" aria-hidden="true"></i> &nbsp; Approve</button>
                                                    </form>
                                                    {{-- <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-times" aria-hidden="true"></i></a> --}}
                                                
                                                    <form name="formdata" method="post" action="{{route('update-timesheet-all', $d->id)}}" style="display: inline">
                                                        @method('PATCH') 
                                                        @csrf 
                                                        <input type="hidden" value="2" name="status" id="status">
                                                        <button type="submit" class="btn btn-default btn-xs" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Reject</button>
                                                    </form>
                                                </center>
                                            {{-- <a href="{{route('edit-status-timesheet-ho',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>Ubah Status</a> --}}
                                            </td>

                                      </tr>
                                      @endforeach
                                  </tbody>
                            </table>
                            </div>
                    </div>
                    
                    {{--Report Timesheet--}}
                    <div class="tab-pane" id="total_man_hours">
                        <div class="row">
                            <div id="piechart_3d"></div>
                        </div>

                        <?php $month = date("m",strtotime(now())); 
                        if($month == 1){
                            $months = "January";
                        }
                        else if($month == 2){
                            $months = "February";
                        }
                        else if($month == 3){
                            $months = "March";
                        }
                        else if($month == 4){
                            $months = "April";
                        }
                        else if($month == 5){
                            $months = "May";
                        }
                        else if($month == 6){
                            $months = "June";
                        }
                        else if($month == 7){
                            $months = "July";
                        }
                        else if($month == 8){
                            $months = "August";
                        }
                        else if($month == 9){
                            $months = "September";
                        }
                        else if($month == 10){
                            $months = "October";
                        }
                        else if($month == 11){
                            $months = "November";
                        }
                        else{
                            $months = "December";
                        }
                    ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border" style="background-color: #80808038;">
                                <h3 class="box-title" style="font-size:14px;"><b>Manhours Percentage {{$month_name}}(%)</b></h3>
                                &nbsp;&nbsp; <a href="{{url('persentase-timesheet')}}" class="btn btn-default" style="float: right;margin-right: 38px;"><i class="fa fa-refresh"></i> Reset Filter</a>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-up"></i>
                                    </button>
                                </div>
                            </div>
                                      <table>
                                <tbody>
                                     <tr>
                                         <ul>
                                            <td><li><b> HO </b></li></td>
                                            <td>&nbsp; : &nbsp; <?php echo round($persentaseHO, 2); ?> % &nbsp;</td>
                                            <td>({{$total_manhours_HO}} jam )</td>
                                         </ul>
                                     </tr>
                                     <tr>
                                         <ul>
                                            <td><li><b> Proposal </b></li></td>
                                            <td>&nbsp; : &nbsp; <?php echo round($persentaseProposal, 2); ?> % &nbsp;</td>
                                            <td>
                                                @if($total_manhours_Proposal == 0)
                                                    ( 0 jam )
                                                @else
                                                    ({{$total_manhours_Proposal}} jam )
                                                @endif
                                            </td>
                                         </ul>
                                     </tr>
                                     <tr>
                                         <ul>
                                            <td><li><b> Project </b></li></td>
                                            <td>&nbsp; : &nbsp; <?php echo round($persentaseProject, 2); ?> % &nbsp; </td>
                                            <td>({{$total_manhours_Project}} jam )</td>
                                         </ul>
                                     </tr>
                                </tbody>
                             </table>
                             <br>
                             
                             <form role="form" name="formdata" method="post" action="{{url('filter_summary')}}">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class = "form-group">
                                        <label for="month" class="col-sm-4 control-label"></label>
                                        <select class="form-control select2" name="month1" id="month1" style="width: 100%;">
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
                                    <div class="form-group">
                                        <div id="div1">
                                            <select class="form-control select2" name="year1" id="year1" style="width: 100%;">
                                                <option selected disabled>Select year</option>
                                                <?php
                                                    $thn_skr = date("Y",strtotime("-2 year"));
                                                    for ($year = $thn_skr; $year <= 2027; $year++) {
                                                ?>
                                                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                                    <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" ><span class="fa fa-filter"></span> &nbsp; Filter</button>
                            </div>
                            <!-- /.box-body -->
                        </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border" style="background-color: #80808038;">
                                <h3 class="box-title" style="font-size:14px;"><b>Export Summary (.xlsx)</b></h3>
            
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-up"></i>
                                    </button>
                                </div>
                            </div>

                            <form role="form" name="formdata" method="post" action="{{url('summary-timesheet-ho')}}">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-group">
                                            <select class="form-control select2" name="year" id="year" style="width: 100%;" required>
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
                                            <select class="form-control select2" name="month" id="month" style="width: 100%;" required>
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
                                    <div class="form-group">
                                        <select class="form-control select2" name="nik" id="nik" style="width: 100%;" required>
                                            <option selected disabled> Select employee</option>
                                            <option value="all"> All</option>
                                            @foreach ($data_karyawan as $item)
                                                <option value= "{{$item->nik}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                            
                                <div class="box-footer">
                                    {{-- <a href="{{url('all-timesheet')}}/{{$get_id}}" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a> --}}
                                    <button type="submit" class="btn btn-primary" ><span class="fa fa-download"></span> &nbsp; Export Summary</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>

</section>

{{-- Modal --}}
<div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="font-size: 16px;">Status change confirmation</h4>
      </div>
      <div class="modal-body" id="konfirmasi-body">
        <div class="form-group">
            <label>Select status</label>
            <select name="status_approved" onchange="myFunction(this)" class="form-control" id="status_approved" style="width: 100%;" required>
                <option selected disabled>--Select--</option>
                <option value="1"> APPROVED </option>
                <option value="2"> REJECTED </option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" data-id="" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating..." id="confirm-approval">Update</button>
      </div>
      </div>
    </div>
  </div>
{{-- End Modal --}}
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">

    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart(){
        var data = google.visualization.arrayToDataTable([
            ['Scope of Work', 'Percentage'], 
            ['HO', <?php echo $persentaseHO; ?>],
            ['Proposal', <?php echo $persentaseProposal; ?>],
            ['Project', <?php echo $persentaseProject; ?>]
        ]);

        var options = {
            title:'Pie Chart Summary Timesheet ({{$month_name}})', 
            width: '370',
                height: '300',
                chartArea: {
                    width: '80%',
                    height: '80%',
                    left: 100,
                },
                pieSliceTextStyle: {
                    color: 'white',
                    fontSize: '14.5'
                },
                colors: ['#90c458', '#ff7f66', '#ffce55', '#52c2e8']
        }
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
        
    }
    
    $(function(){
        var data1 = $("#data-tables").DataTable();
    });

     // Approval All
    $('#selectAllApprove').on('click', function(){
        ($('#selectAllApprove').is(':checked') == true) ? selectAll() : deselectAll();
    });

    function selectAll(){
        var id = [];
        $('.bulkSelectAll').prop("checked", true);
        $('.bulkSelectAll:checked').each(function(){
            id.push($(this).val());
        });
    }

    function deselectAll(){
        $('.bulkSelectAll').prop("checked", false);
    }

    function partialSelected(){
        if($('#selectAllApprove').is(':checked')){
            $('#selectAllApprove').prop("checked", false);
        }
            
        var id = [];
        $('.bulkSelectAll:checked').each(function(){
            id.push($(this).val());
        });
    }

    var dt;
    function myFunction(event) {
        dt = event.options[event.selectedIndex].value;
        console.log("dt", event.options[event.selectedIndex].value);
    }

    $('#btnSelectAll').on('click',function (e) {
        e.preventDefault();
        $("#modal-konfirmasi").modal('show');
        var id = [];

        var mydataTable = $('#data-tables').DataTable();
        console.log(mydataTable.rows);
        console.log("dt>>>", dt);
        console.log("id>>>", id);

        $('.bulkSelectAll:checked').each(function(){
            id.push($(this).val());
        });

        console.log(id);

    $("#modal-konfirmasi").find("#confirm-approval").data("id", id.id);

    $('#confirm-approval').click(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "{{ url('approve-all') }}",
        type: 'POST',
        dataType: "JSON",
        data: {
          "id": id,
          "status": dt,
        },
        success: function (response)
        {
          $("#modal-konfirmasi").modal('hide');
          Swal.fire({
            title: response.message,
            type: 'success',
            confirmButtonText: 'Close',
            confirmButtonColor: '#AAA',
            onClose: function(){
            }
          })
            console.log("project_id>>>>", response);

            $('#data-tables').DataTable().destroy();
            location.reload();
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
    });
  });
    $('.select2').select2();
</script>
@endpush