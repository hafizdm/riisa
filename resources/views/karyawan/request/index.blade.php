<?php 
  use App\User;
?>

@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <br>
    <!--<span class="fonts header-style">-->
    <!--  <b>Form Request Pembelian Barang</b>-->
    <!--</span>-->
    
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('request')}}">Purchase Items</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<!-- filter field -->

    <!-- end of filter field -->
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
              <h4><i class="icon fa fa-ban"></i> Alert !</h4>
              {{ session()->get('failed') }}
            </div>
            @endif

            {{-- sub menu  --}}
            <div style="margin-bottom: 20px">
                <a href="{{url('request/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Purchase Item Request</a>
            </div>
            {{-- end of sub menu  --}}

            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Reference Number</th>
                            <th>Type of Purchase</th>
                            <th>Cost Code</th>
                            <th>Item's Name</th>
                            <th>Requirement Location</th>
                            <th>Purchase Amount(unit)</th>
                            <th>Estimated Unit Price</th>
                            <th>Estimated Total Payment</th>
                            <th>Description</th>
                            <th>Date of Request</th>
                            <th>Status of Request</th>
                            <th>Next Process</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($request_barang as $k => $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                  @if($d->no_request != null && $d->no_po == null && $d->no_payment == null)
                                    <span>{{$d->no_request}}</span>
                                  @elseif($d->no_request != null && $d->no_po != null && $d->no_payment == null)
                                    <span>{{$d->no_po}}</span>
                                  @elseif($d->no_request != null && $d->no_po != null && $d->no_payment != null)
                                    <span>{{$d->no_payment}}</span>
                                  @else
                                     <span></span>
                                  @endif
                                </td>
                              
                                <td>{{$d->masterjenisbarang->nama}}</td>
                                <td>{{$d->masterKategori->kode_kategori}}/{{$d->masterKategori->nama_kategori}}</td>
                                <td>{{$d->nama_barang}}</td>
                                <td>{{$d->lokasiProyek->nama}}</td>
                                <td>{{$d->quantity}} {{$d->quantity_satuan}}</td>
                                <td>@rupiah($d->harga),00</td>
                                <td>@rupiah($d->total),00 </td>
                                <td>{{$d->keterangan}}</td>
                                <td>{{ date('d-M-Y', strtotime($d->tanggal_pengajuan)) }}</td>
                                <td>
                                    <center>
                                      @if($d->status_pengajuan == 0 || $d->status_pengajuan == 1 && $d->status_PO == 0)
                                          <span class="label label-warning">REQUEST PROCESS</span>
                                      
                                      @elseif($d->status_pengajuan == 1 && $d->status_PO == 0 || $d->status_PO == 1 || $d->status_PO == 2 && $d->status_paid == 0)
                                        <span class="label label-success"> PURCHASE ORDER</span>
                                  
                                      @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 0 || $d->status_paid == 1 || $d ->status_paid == 2 || $d->status_paid == 3)
                                        <span class="label label-danger"> PAYMENT PROCESS</span>
                                  
                                      @elseif($d->status_pengajuan == 4 || $d->status_PO == 4 || $d->status_paid == 4)
                                        <span class="label label-danger"> REJECTED</span>
                                      @else
                                          <span></span>
                                        @endif
                                    </center>
                                </td>
                              
                                <td>
                                <!--{{-- Request --}}-->
                                    @if($d->status_pengajuan != 4 || $d->status_PO != 4 || $d->status_paid != 4)
                                        @if($d->status_pengajuan == 0 && $d->status_PO == 0 && $d->status_paid == 0)
                                        <span>VP/PM</span>

                                    @elseif($d->status_pengajuan == 1 && $d->status_PO == 0 && $d->status_paid == 0)
                                          @if($d->upload_po == NULL && $d->upload_tba == "" && $d->upload_cba == "")
                                            <span>Admin Procurement</span>
                                          @else
                                            <span>
                                              <?php $dt = User::where('role_id', 8)->select('name')->first();
                                                echo $dt->name;?>
                                            </span>
                                          @endif
          
                                    <!--{{-- Purchased Order --}}-->
                                    @elseif($d->status_pengajuan == 1 && $d->status_PO == 1 && $d->status_paid == 0)
                                          @if($d->nama_proyek == 3)
                                            <span>{{$d->updated_vp_po_by}}</span>
                                          @else
                                              <span>{{$d->updated_pm_po_by}}</span>
                                          @endif

                                    @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 0)
                                        <span>Finance (upload invoice)</span>
                                    
                                    <!--{{-- Payment --}}-->
                                    @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 1)
                                      <span>
                                          CFO
                                      </span>

                                    @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 2)
                                      <span>
                                        CEO
                                      </span>
                                    @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 3)
                                      <span>Finance (upload bukti bayar)</span>
                                    @else
                                        <span></span>
                                    @endif
                                  
                                  @else 
                                      @if($d->status_pengajuan == 4 && $d->status_PO == 0 && $d->status_paid == 0)
                                          <span>VP/PM</span>
    
                                      <!--{{-- Purchased Order --}}-->
                                      @elseif($d->status_pengajuan == 1 && $d->status_PO == 4 && $d->status_paid == 0)
                                          @if($d->updated_co_po_by != "") 
                                            <span>{{$d->updated_co_po_by}}</span>
                                          @elseif($d->updated_pm_po_by != "")
                                            <span>{{$d->updated_pm_po_by}}</span>
                                          @else 
                                            <span>{{$d->updated_vp_po_by}}</span>
                                          @endif

                                      <!--{{-- Payment --}}-->
                                      @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 4)
                                          @if($d->updated_co_pay_by != "") 
                                            <span>{{$d->updated_co_pay_by}}</span>
                                          @elseif($d->updated_cfo_pay_by != "")
                                            <span>{{$d->updated_cfo_pay_by}}</span>
                                          @else 
                                            <span>{{$d->updated_ceo_pay_by}}</span>
                                          @endif
                                        @endif
                                    @endif
                                </td>
                            
                                
                                <td><center><button class='btn btn-xs btn-danger delete' data-id="{{$d->id}}"><span class='glyphicon glyphicon-trash'></span></button></center></td>
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
    $("#konfirmasi-body").text("Are you sure to remove this?");
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
        url: "requestpembelian/"+id,
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


