@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      {{-- <span class="fonts header-style">
        <b>SPD Submission Form (Official Travel Letter)</b>
    </span> --}}
    <br>
      <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('spd')}}">SPD</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-md-10 col-xs-12 col-xl-10">
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
            </div>
          </div>


          {{--  sub menu  --}}
          <div style="margin-bottom: 20px">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".tambahspd"><span class="glyphicon glyphicon-plus"></span> Add SPD</button>
               <a href="add-report" class="btn btn-warning">Report SPD</a>
               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#"><span class="#"></span>SPD Limit : 3</button>
          </div>
          {{--  end of sub menu  --}}

            {{--  table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Reference Number</th>
                            <th>Form Date</th>
                            <th>Travel Type</th>
                            <th>Assignment Type</th>
                            <th width="80%">Purpose</th>
                            <th>From</th>
                            <th>Destination</th>
                            <th>Date Departure</th>
                            <th>Date Return</th>
                            <th>Approval User</th>
                            <th>Upload File</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    </thead>
                    <tbody>
                    @foreach($spd as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->no_surat}}</td>
                            <td>{{ date('d-M-Y', strtotime($d->form_date)) }}</td>
                            <td>{{$d->travel_type}}</td>
                            <td>{{$d->assignment_type}}</td>
                            <td>{{$d->purpose}}</td>
                            <td>{{$d->asal}}</td>
                            <td>{{$d->tujuan}}</td>
                            <td>{{date('d-M-Y', strtotime($d->tgl_keberangkatan))}}</td>
                            <td>{{date('d-M-Y', strtotime($d->tgl_pulang))}}</td>
                            <td>
                                @if($d->spdApproval && $d->spdApproval->status == 0)
                                <span class="label label-warning">Waiting approval</span>
                              @elseif($d->spdApproval && $d->spdApproval->status == 1)
                                <span class="label label-success">Approved</span>
                              @else
                                <span class="label label-danger">Rejected</span>
                              @endif                   
                           </td>
                            <td>
                              @if($d->status == 0)
                              <span></span>
                              @elseif($d->status == 1)
                              <a href="#" class="btn btn-default btn-xs" style="color: dodgerblue;">Upload file</span></a>
                              <a href="#" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                              @else
                              @endif
                            </td>
                            <td>                      
                                <a href="{{url('downloadpdf',$d->id)}}" class="btn btn-primary btn-xs"><span class='glyphicon glyphicon-print'></span></a>
                                <a href="{{route('edit-spd',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>
                                <button class='btn btn-xs btn-danger delete' data-id="{{$d->id}}"><span class='glyphicon glyphicon-trash'></span></button></td>
                              
                            </td>

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
    <!-- /.content -->
    <!-- modal konfirmasi -->

    <div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body" id="konfirmasi-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" data-id="" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Deleting..." id="confirm-delete">Delete</button>
        </div>
        </div>
      </div>
    </div>
    <!-- end of modal konfirmais -->
    @include('spd.create')

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function(){
   var mainTable = $('#data-table').DataTable();
   var selectedRow;
  $('#data-table').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow = mainTable.row( $(this).parents('tr') );
    $("#modal-konfirmasi").modal('show');
    $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
    $("#konfirmasi-body").text("Are you sure to delete this data?");
  });
  
  $('#confirm-delete').click(function(){
      var deleteButton = $(this);
      var id           = deleteButton.data("id");
      console.log(id);
      deleteButton.button('loading');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "pengajuan-spd/"+id,
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

  if ($('#travel_type').val() == null) {
    $('.eat_per_day').hide();
    $('.allowance_per_day').hide();
  }
  $('#travel_type').on('change', function () {
    $('.eat_per_day').show();
    $('.allowance_per_day').show();
    if ($('#travel_type').val() == 'Domestic') {
        $('.domestic').show();
        $('.international').hide();
    }

    if ($('#travel_type').val() == 'International') {
        $('.domestic').hide();
        $('.international').show();
    }
    }); 
});
</script>
@endpush
