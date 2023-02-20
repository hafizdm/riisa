@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Data Vendor</b>
    </span>
    <ol class="breadcrumb">
    <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('listVendor')}}">Vendor</a></li>
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

            {{-- sub menu  --}}
            <div style="margin-bottom: 20px">
                <a href="{{url('vendor/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Vendor</a>
            </div>
            {{-- end of sub menu  --}}

            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <!--<th>Category</th>-->
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Contact Person</th>
                            <th>Phone</th>
                            <th>email</th>
                            <th>Bank 1</th>
                            <th>Bank Account 1</th>
                            <th>Bank Rekening  1</th>
                            <th>Bank  2</th>
                            <th>Bank Account 2</th>
                            <th>Bank Rekening 2</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vd as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <!--<td>{{$d->category['name']}}</td>-->
                            <td>{{$d->nama}}</td>
                            <td>{{$d->alamat}}</td>
                            <td>{{$d->contact_person}}</td>
                            <td>{{$d->phone_no}}</td>
                            <td>{{$d->email}}</td>
                            
                            @if($d->bank_1 != '')
                                <td>{{$d->bank_1}}</td>
                            @else
                                <td></td>
                            @endif
                            
                            @if($d->bank_account_1 != '')
                                <td>{{$d->bank_account_1}}</td>
                            @else
                                <td></td>
                            @endif
                            
                            @if($d->bank_rekening_1 != '')
                                <td>{{$d->bank_rekening_1}}</td>
                            @else
                                <td></td>
                            @endif
                            
                            <td>{{$d->bank_2}}</td>
                            <td>{{$d->bank_account_2}}</td>
                            <td>{{$d->bank_rekening_2}}</td>
                            <td>{{$d->keterangan}}</td>
                            <td>
                                <a href="{{route('editvendor',$d->id)}}" class="btn btn-warning btn-xs"><span class='glyphicon glyphicon-pencil'></span></a>
                                <button class='btn btn-xs btn-danger delete' data-id="{{$d->id}}"><span class='glyphicon glyphicon-trash'></span></button></td>
                            </td>
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
    $("#konfirmasi-body").text("Hapus Beban?");
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
        url: "vendor/"+id,
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


