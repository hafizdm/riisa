@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <br>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('request-barang-keluar')}}">Outgoing Items</a></li>
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
            @endif

            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Payment Number</th>
                            <th>Type of Puurchase</th>
                            <th>Cost Code</th>
                            <th>Item's Name</th>
                            <th>Requirement Location</th>
                            <th>Purchase Amount(unit)</th>
                            <th>Unit Price</th>
                            <th>Total of Payment</th>
                            <th>Description</th>
                            <th>Date of Request</th>
                            <th>Date of Approved</th>
                            <th>Approved By</th>
                            <th>Status of Request</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($request_barang_keluar as $k => $d)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              @if($d->no_payment != '')
                                <td>{{$d->no_payment}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{$d->masterjenisbarang->nama}}</td>
                              <td>{{$d->masterKategori->kode_kategori}}/{{$d->masterKategori->nama_kategori}}</td>
                              <td>{{$d->nama_barang}}</td>
                              <td>{{$d->lokasiProyek->nama}}</td>
                              <td>{{$d->quantity}} {{$d->quantity_satuan}}</td>
                              <td>@rupiah($d->harga),00</td>
                              <td>@rupiah($d->total),00 </td>
                              <td>{{$d->keterangan}}</td>
                              <td>{{ date('d-m-Y', strtotime($d->tanggal_pengajuan)) }}</td>
                              <td>{{ date('d-m-Y', strtotime($d->updated_at)) }}</td>
                              <!--<td>{{$d->updated_ceo_pay_by}}</td>-->
                              <td>Finance</td>

                              @if($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 5)
                              <td><span class="label label-success" style="background-color: rgb(0, 123, 255) !important">APPROVED</span></td>
                              @endif
                                
                                <td><a href="{{route('editrequest-barang-keluar',$d->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-edit"></i><span>Ajukan Pengeluaran</span></a></td>
                          </tr>
                          @endforeach
                      </tbody>
                    
                </table>
            </div>
            {{-- end of car data  --}}
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
<!-- end of modal konfirmasi -->
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
    $("#konfirmasi-body").text("Hapus Multi Request?");
  });
  $('#btnFilter').click(function() {
      //alert('dumbass');
      $('#data-table').DataTable().ajax.reload();
    });

    $('#resetFilter').click(function() {
      $('#formFilter')[0].reset();
      $('#data-table').DataTable().ajax.reload();
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
        url: id,
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


