@extends('templates.header')

@section('content')
<section class="content-header">
    <span class="fonts" style="font-size:20px">
    <b>
        Time Sheet Management 
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
            @elseif(session()->get('failed'))
                <div class="alert alert-danger alert-dismissible fade in"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4><i class="icon fa fa-ban"></i> Pemberitahuan !</h4>
                {{ session()->get('failed') }}
                </div>
            @endif
            {{-- table data of car  --}}
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#approvals" data-toggle="tab"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; Approval Time Sheet</a></li>
                    <li><a href="#total_man_hours" data-toggle="tab"><i class="fa fa-bar-chart"></i>&nbsp; Report Timesheet</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="approvals">
                        <div class="table-responsive">
                            <table id="data-tables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"><center><input type="checkbox" id="selectAllApprove" name="selectAllApprove"></center><button class="btn btn-success btn-xs" id="btnSelectAll" name="btnSelectAll"><span>Approve All</span></button></th>
                                        <th width="5%">No.</th>
                                        <th>Tanggal Kerja</th>
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Deskripsi Pekerjaan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($timesheet as $k => $d)
                                      <tr>
                                          <td><center><input type="checkbox" name="deleteAll[]" onclick="partialSelected()" class="bulkSelectAll" id="bulkSelectName" value="{{$d->id}}"></center></td>
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
                                            <td>{{$d->getDiv->nama}}</td>
                                            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
                                            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
                                            <td>{{$d->workingType->nama}}
                                                <br>
                                                <b>Detail:</b>
                                                <br>{!! preg_replace("/<p>/", '-'.' ' , ($d->desc_for_ho)) !!}
                                            </td>
                                            
                                            @if($d->status == 0)
                                                <td><span class="label label-danger">Butuh Approval</span></td>
                                            @else 
                                                <td><span class="label label-danger">Disetujui</span></td>
                                            @endif

                                            <!--<td>-->
                                            <!--<a href="{{route('edit-status-timesheet-ho',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-edit"></i>Ubah Status</a>-->
                                            <!--</td>-->
                                            <td>
                                                <center>
                                                    <form name="formdata" method="post" action="{{route('update-status-timesheet-ho', $d->id)}}">
                                                        @method('PATCH') 
                                                        @csrf
                                                        <input type="hidden" value="1" name="status" id="status">
                                                        <button type="submit" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-check" aria-hidden="true"></i> &nbsp; Approve</button>
                                                    </form>
                                                    {{-- <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-times" aria-hidden="true"></i></a> --}}
                                                
                                        <form name="formdata" method="post" action="{{route('update-status-timesheet-ho', $d->id)}}">
                                        @method('PATCH') 
                                        @csrf
                                        <input type="hidden" value="2" name="status" id="status">
                                                        <button type="submit" class="btn btn-default btn-xs" style="color: red;">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp; Reject</button>
                                        </form>
                                         </center>
                                            
                                            </td>

                                      </tr>
                                      @endforeach
                                  </tbody>
                            </table>
                            </div>
                    </div>

                    <div class="tab-pane" id="total_man_hours">
                        <div class="row">
                            <div id="piechart_3d"></div>
                        </div>
                         <?php $month = date("m",strtotime(now())); 
                            if($month == 1){
                                $months = "Jan";
                            }
                            else if($month == 2){
                                $months = "Feb";
                            }
                            else if($month == 3){
                                $months = "Maret";
                            }
                            else if($month == 4){
                                $months = "April";
                            }
                            else if($month == 5){
                                $months = "Mei";
                            }
                            else if($month == 6){
                                $months = "Juni";
                            }
                            else if($month == 7){
                                $months = "Juli";
                            }
                            else if($month == 8){
                                $months = "Agustus";
                            }
                            else if($month == 9){
                                $months = "September";
                            }
                            else if($month == 10){
                                $months = "Oktober";
                            }
                            else if($month == 11){
                                $months = "November";
                            }
                            else{
                                $months = "Desember";
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="box box-default collapsed-box">
                                        <div class="box-header with-border" style="background-color: #80808038;">
                                            <h3 class="box-title" style="font-size:14px;"><b>Persentase Manhours (%) ({{$month_name}})</b></h3>
                                            &nbsp;&nbsp; <a href="{{url('persentase-timesheet')}}" class="btn btn-default"><i class="fa fa-refresh"></i> Reset Filter</a>
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
                                                        <td>({{$total_manhours_Proposal}} jam )</td>
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
                                                    <select class="form-control" name="month" id="month">
                                                        <option selected disabled> Pilih Bulan</option>
                                                        <option value = "01">Januari</option>
                                                        <option value = "02">Februari</option>
                                                        <option value = "03">Maret</option>
                                                        <option value = "04">April</option>
                                                        <option value = "05">Mei</option>
                                                        <option value = "06">Juni</option>
                                                        <option value = "07">Juli</option>
                                                        <option value = "08">Agustus</option>
                                                        <option value = "09">September</option>
                                                        <option value = "10">Oktober</option>
                                                        <option value = "11">November</option>
                                                        <option value = "12">Desember</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div id="div1">
                                                        <select class="form-control select2" name="year" id="year">
                                                            <option selected disabled>Pilih Tahun</option>
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
                                            <button type="submit" class="btn btn-default" ><span class="fa fa-filter"></span> Filter</button>
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
                                            <!-- /.box-tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        
                                        <form role="form" name="formdata" method="post" action="{{url('summary-timesheet-ho')}}">
                                            {{csrf_field()}}
                                            <div class="box-body">
                                                <div class="form-group">
                                                        <select class="form-control select2" name="year" id="year" style="width: 100%;" required>
                                                            <option selected disabled>Pilih Tahun</option>
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
                                                            <option selected disabled> Pilih Bulan</option>
                                                            <option value = "01">Januari</option>
                                                            <option value = "02">Februari</option>
                                                            <option value = "03">Maret</option>
                                                            <option value = "04">April</option>
                                                            <option value = "05">Mei</option>
                                                            <option value = "06">Juni</option>
                                                            <option value = "07">Juli</option>
                                                            <option value = "08">Agustus</option>
                                                            <option value = "09">September</option>
                                                            <option value = "10">Oktober</option>
                                                            <option value = "11">November</option>
                                                            <option value = "12">Desember</option>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control select2" name="nik" id="nik" style="width: 100%;" required>
                                                        <option selected disabled> Pilih Karyawan</option>
                                                        <option value="all"> All</option>
                                                        @foreach ($data_karyawan as $item)
                                                            <option value= "{{$item->nik}}">{{$item->nama}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            </div>
                                        
                                        <div class="box-footer">
                                            {{-- <a href="{{url('all-timesheet')}}/{{$get_id}}" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a> --}}
                                            <button type="submit" class="btn btn-default" ><span class="fa fa-download"></span> Download</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table id="data-tables2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Penempatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($data_karyawan as $d)
                                          <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$d->nik}}</td>
                                                <td>{{$d->nama}}</td>
                                                
                                                <td>
                                                @if($d->lokasi_id == '' || $d->lokasi_id == NULL)
                                               <span></span>
                                                @else
                                                <span>{{$d->lokasi->nama}}</span>
                                                @endif
                                                </td>
                                                
                                                <td>
                                                <a href="{{url('all-timesheet')}}/{{$d->nik}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><i class="fa fa-eye"></i>&nbsp; Detail</a>
                                                </td>
    
                                          </tr>
                                          @endforeach
                                      </tbody>
                                </table>
                                </div>
                        </div>
                    </div>

</section>

<div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="font-size: 16px;">Konfirmasi ubah status</h4>
      </div>
      <div class="modal-body" id="konfirmasi-body">
        <div class="form-group">
            <label>Pilih Status</label>
            <select name="status_approved" onchange="myFunction(this)" class="form-control" id="status_approved" style="width: 100%;" required>
                <option selected disabled>--Pilih--</option>
                <option value="1"> DISETUJUI </option>
                <option value="2"> DITOLAK </option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" data-id="" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating..." id="confirm-delete">Update</button>
      </div>
      </div>
    </div>
 </div>
  
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart () {
       var data = google.visualization.arrayToDataTable([  
            ['Cost Account', 'Persentase'],
            ['HO', <?php echo $persentaseHO; ?>],
            ['Proposal', <?php echo $persentaseProposal; ?>],
            ['Project', <?php echo $persentaseProject; ?>]
       ]);
       var options = {
                title:'Persentase Manhours {{$month_name}}',
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
    };
       var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
       chart.draw(data, options);
     }
     
    $(function(){
      var data1 = $("#data-tables").DataTable();
      var data2 = $("#data-tables2").DataTable();
    });


    // Approval All
    $('#selectAllApprove').on('click', function(){
        ($('#selectAllApprove').is(':checked') == true) ? selectAll() : deselectAll();
    });

    function selectAll(){
    var id = [];
    var project_id = [];
    var resource_id = [];
    
    // var ddlViewBy = document.getElementById('status_approved');
    // var value = ddlViewBy.options[ddlViewBy.selectedIndex].value;
    
    $('.bulkSelectAll').prop("checked", true);
    $('.bulkSelectAll:checked').each(function(){
                id.push($(this).val());
                // var idproj = document.getElementById("project-id");
                // project_id.push(idproj.innerText);
                // var idres = document.getElementById("resource-id");
                // resource_id.push(idres.innerText);

                // id.push({'id': $(this).val(), 'project_id': idproj.innerText, 'resource_id': idres.innerText});
            });
}

function deselectAll()
{
    $('.bulkSelectAll').prop("checked", false)
}

// partial selected
function partialSelected()
{
  if($('#selectAllApprove').is(':checked'))
        {
            $('#selectAllApprove').prop("checked", false);
        }
            
    var id = [];
    var project_id = [];
    var resource_id = [];

    // var ddlViewBy = document.getElementById('status_approved');
    // var value = ddlViewBy.options[ddlViewBy.selectedIndex].value;
    $('.bulkSelectAll:checked').each(function(){
                id.push($(this).val());
                // var idproj = document.getElementById("project-id");
                // project_id.push(idproj.innerText);
                // var idres = document.getElementById("resource-id");
                // resource_id.push(idres.innerText);

                // id.push({'id': $(this).val(), 'project_id': idproj.innerText, 'resource_id': idres.innerText});
            });
}

function myFunction(event) {
    dt = event.options[event.selectedIndex].value;
    console.log(event.options[event.selectedIndex].value);
}

// var globalVal;
// $( "#status_approved" ).change(function() {
//      globalVal = $( "#status_approved option:selected" ).val();
// });

$('#btnSelectAll').on('click',function (e) {
    e.preventDefault();
    $("#modal-konfirmasi").modal('show');
    // bulk edit menampung id kedalam array
    var id = [];
    var project_id = [];
    var resource_id = [];
    // var ddlViewBy = document.getElementById('status_approved');
    // var value = ddlViewBy.options[ddlViewBy.selectedIndex].value;

    var mydataTable = $('#data-tables').DataTable();
    console.log(mydataTable.rows);

    // document.getElementById('status_approved').addEventListener('change', function() {
    //         console.log('You selected: ', this.value);  
    //     });
    // console.log(myFunction(event));
    // console.log(dt);
    console.log("id>>>", id);
    $('.bulkSelectAll:checked').each(function(){
                id.push($(this).val());
                // var idproj = document.getElementById("project-id");
                // project_id.push(idproj.innerText);
                // var idres = document.getElementById("resource-id");
                // resource_id.push(idres.innerText);

                // id.push({'id': $(this).val(), 'project_id': idproj.innerText, 'resource_id': idres.innerText});
            });

    console.log(id);

    $("#modal-konfirmasi").find("#confirm-delete").data("id", id.id);


    $('#confirm-delete').click(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "{{ url('approve-ho') }}",
        type: 'POST',
        dataType: "JSON",
        data: {
          "id": id,
          "status": dt,
        //   "project_id" : project_id
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
      }); // end of ajax
    });
  });
  
    $('.select2').select2();
</script>
@endpush


