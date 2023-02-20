@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>Employees Data</b>
    </span>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('karyawan')}}">Employees data</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          @if(session()->get('success'))
              <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }} 
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
          @elseif(session()->get('failed'))
            <div class="alert alert-danger alert-dismissible fade in"> 
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <h4><i class="icon fa fa-ban"></i> Failed !</h4>
              {{ session()->get('failed') }}
            </div>
          @endif
          {{--  sub menu  --}}
          <div style="margin-bottom: 20px">
               <a href="{{url('karyawan/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add Employee</a>
                <a href="karyawan/cetak_excel" class="btn btn-success " target="_blank"><i class="fa fa-download" aria-hidden="true"></i><span> Export to Excel</span></a>
               <!--<a href="karyawan/cetak_pdf" class="btn btn-primary" target="_blank"><i class="fa fa-file-pdf-o"></i><span> Cetak PDF </span></a>-->
               <!--<a href="karyawan/cetak_excel" class="btn btn-primary " target="_blank"><i class="fa fa-file-excel-o" ></i><span> Cetak Excel</span></a>-->
              
          </div>
          {{--  end of sub menu  --}}

            {{--  table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>NIK</th>
                            <th>Employee's name</th>
                            <th>Email</th>
                            <!--<th>Tanggal Bergabung</th>-->
                            <th>Division</th>
                            <th>Position</th>
                            <th>Placement</th>
                            <!--<th>Status</th>-->
                            <th style="10%">Action</th>
                        </tr>
                    </thead>
                    </thead>
                    <tbody>
                    @foreach($karyawan as $k => $d)
                        <tr>
                             <td>{{$loop->iteration}}</td>
                            <td>{{$d->nik}}</td>
                            <td>{{$d->nama}}</td>
                            @if($d->email != '')
                                <td>{{$d->email}}</td>
                            @else
                                <td></td>
                            @endif
                            
                            <!--@if($d->date_joining != '')-->
                            <!--    <td>{{date('d-m-Y', strtotime($d->date_joining))}}</td>-->
                            <!--@else-->
                            <!--    <td></td>-->
                            <!--@endif-->
                            
                            @if($d->divisi_id != 0)
                                <td>{{$d->divisi->nama}}</td>
                            @else
                              <td><span>-</span></td>
                            @endif
                            
                            @if($d->jabatan != '')
                                <td>{{$d->jabatan->jenis_jabatan}}</td>
                            @else
                                <td></td>
                            @endif
                            
                            @if($d->lokasi != '')
                                <td>{{$d->lokasi->nama}}</td>
                            @else
                                <td></td>
                            @endif
                            
                            <!--@if($d->status== 0)-->
                            <!--<td><span class="label label-success"> Kontrak</span></td>-->
                            <!--@else-->
                            <!--<td><span class="label label-danger"> Permanent</span></td>-->
                            <!--  @endif-->
                           
                            
                            <td>
                               {{-- <a href="#" class="btn btn-success btn-xs"><span class='glyphicon glyphicon-eye-open'></span></a> --}}
                                <a href="{{route('editkaryawan',$d->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                <button class='btn btn-xs btn-danger delete' data-id="{{$d->nik}}"><i class="fa fa-trash"></i></button></td>
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
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>

  // function exportTasks(_this) {
  //     let _url = $(_this).data('href');
  //     window.location.href = _url;
  //  }

$(function(){
   var mainTable = $('#data-table').DataTable();
   var selectedRow;
   
  $('#data-table').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow = mainTable.row( $(this).parents('tr') );

    $("#modal-konfirmasi").modal('show');

    $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
    $("#konfirmasi-body").text("Are you want to delete this data?");
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
        url: "karyawan/"+id,
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
});
</script>
@endpush
