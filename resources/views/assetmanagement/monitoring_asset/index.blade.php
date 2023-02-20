
@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Fixed Asset Summary</b>
    </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{url('list-asset')}}">Fixed Asset Summary</a></li>
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
              <h4><i class="icon fa fa-ban"></i> Pemberitahuan !</h4>
              {{ session()->get('failed') }}
            </div>
            @endif
            <div style="margin-bottom: 20px">
                <a href="{{url('list-asset/create')}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Tambah Data Asset</a>
            </div>
            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            {{-- <th style="width: 50px;"><center><input type="checkbox" id="selectAllApprove" name="selectAllApprove"></center><button class="btn btn-default btn-xs" id="btnSelectAll" name="btnSelectAll"><span><i class="fa fa-download"></i> Download QrCode</span></button></th> --}}
                            <th width="5%">No#</th>
                            <th>Asset Number</th>
                            <th>Asset Category</th>
                            <th>Asset Name</th>
                            <th>Acquisition Date</th>
                            <th>Initial Cost</th>
                            <th>Pengguna</th>
                            {{-- <th>Acc. Depreciation</th> --}}
                            {{-- <th>Book Value</th> --}}
                            <th>QRCode</th>
                            <th width="8%"><center>Aksi</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($asset as $k => $d)
                    <tr>
                        {{-- <td><center><input type="checkbox" name="deleteAll[]" onclick="partialSelected()" class="bulkSelectAll" id="bulkSelectName" value="{{$d->id}}"></center></td> --}}
                        <td>{{$loop->iteration}}</td>
                        <td>{{$d->asset_number}}</td>
                        <td>{{$d->assetCategories->nama}}</td>
                        <td>{{$d->asset_name}}</td>
                        <td>
                            @if($d->acquisition_date != NULL)
                                {{ date('d-M-Y', strtotime($d->acquisition_date)) }}
                            @else
                                <span></span>
                            @endif
                        </td>
                        <td>
                            @if($d->initial_cost != NULL)
                                {{$d->initial_cost}}
                            @else
                                <span></span>
                            @endif
                        </td>
                        <td>
                            @if($d->nama_pengguna == NULL)
                                <span> - </span>
                            @else
                                <span>{{$d->nama_pengguna}}</span>
                            @endif
                        </td>
                        {{-- <td>{{$d->acc_depreciation}}</td> --}}
                        {{-- <td>{{$d->book_value}}</td> --}}
                        <td><center>
                            <?php
                                $qr = $d->qrcode;
                                echo $qr;
                                
                                // header("Content-Type : image/png");
                                // $qrcd = QrCode::size(100)->generate($d->asset_number);
                                // echo $qrcd;
                            ?>
                            <a href="{{route('downloadqrcode', $d->id)}}" class="btn btn-outline-warning"><i class="fa fa-download"></i></a>
                            </center>
                        </td>
                        <td>
                            <center>
                                <a href="{{route('editasset', $d->uid)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></span></a>
                                <button class='btn btn-xs btn-danger delete' data-id="{{$d->id}}"><span class='glyphicon glyphicon-trash'></span></button></td>
                            </center>
                        </td>                    
                    </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
        <div class="box-footer"></div>
    </div>

</section>
<div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Data</h4>
      </div>
      <div class="modal-body" id="konfirmasi-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" data-id="" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Deleting..." id="confirm-delete">Delete</button>
      </div>
      </div>
    </div>
  </div>
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
        $("#konfirmasi-body").text("Hapus data asset?");
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
            url: "list-asset/"+id,
            type: 'POST',
            dataType: "JSON",
            data: {
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

$('#selectAllApprove').on('click', function(){
    ($('#selectAllApprove').is(':checked') == true) ? selectAll() : deselectAll();
});

function selectAll()
{
    var id = [];
    
    $('.bulkSelectAll').prop("checked", true);
    $('.bulkSelectAll:checked').each(function(){
            id.push($(this).val());
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
    $('.bulkSelectAll:checked').each(function(){
        id.push($(this).val());
    });
}

$('#btnSelectAll').on('click',function (e) {
    e.preventDefault();
    var id = [];

    $('.bulkSelectAll:checked').each(function(){
        id.push($(this).val());
        });

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      console.log("ids>>>", id);
    
      $.ajax(
      {
        url: "{{ url('downloadAllQrcode') }}",
        type: 'POST',
        dataType: "JSON",
        data: {
          "id": id,
        },
        success: function (response)
        {
          Swal.fire({
            title: response.message,
            type: 'success',
          })
        },
        // error: function(xhr) {
        //   console.log(xhr.responseText);
        // }
      });

  });
    var image = new Image();
    //Just getting the source from the span. It was messy in JS.
    image.src = document.getElementById('source').innerHTML;
    document.body.appendChild(image);

</script>
@endpush


