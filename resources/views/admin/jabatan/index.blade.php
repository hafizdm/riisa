@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>Data Posisi - Jabatan</b>
    </span>
      <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="{{url('jabatan')}}">Jabatan</a></li>
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
          @endif

          {{--  sub menu  --}}
          <div style="margin-bottom: 20px">
               <a href="{{url('jabatan/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Tambah Jabatan</a>
          </div>
          {{--  end of sub menu  --}}

            {{--  table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Jabatan</th>
                            {{-- <th>Keterangan</th> --}}
                            <th>Divisi</th>
                            <th>Eat Perday Domestic</th>
                            <th>Eat Perday International</th>
                            <th>Allowance Domestic</th>
                            <th>Allowance International</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    </thead>
                    <tbody>
                    @foreach($jabatan as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->jenis_jabatan}}</td>
                            {{-- <td>{{$d->keterangan}}</td> --}}
                            @if($d->divisi_id == 0 || $d->divisi_id == '')
                              <td>-</td>
                            @else
                              <td>{{$d->getdivisi->nama}}</td>
                            @endif
                            <td>{{ 'Rp. '.number_format($d->eat_per_day_domestic, 0, ',', '.')  }}</td>
                            <td>{{ '$ '.number_format($d->eat_per_day_international, 0) }}</td>
                            <td>{{ 'Rp. '.number_format($d->allowance_per_day_domestic, 0, ',', '.') }}</td>
                            <td>{{ '$ '.number_format($d->allowance_per_day_international, 0) }}</td>
                            <td>
                                <a href="{{route('editjabatan',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>
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
          <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
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
$(function(){
   var mainTable = $('#data-table').DataTable();
   var selectedRow;

  $('#data-table').on('click', '.delete', function (e) {
    e.preventDefault();
    selectedRow = mainTable.row( $(this).parents('tr') );

    $("#modal-konfirmasi").modal('show');

    $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
    $("#konfirmasi-body").text("Hapus Jabatan?");
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
        url: "jabatan/"+id,
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
