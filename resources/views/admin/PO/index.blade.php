@extends('templates.header')

@section('content')

<section class="content-header">
    <span class="fonts header-style">
        <b>Upload Dokumen Purchased Order</b>
      </span>
      <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="{{url('listPO')}}"> Upload Dokumen </a></li>
      </ol>
</section>

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
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nomor PO</th>
                            <th>Nama Karyawan</th>
                            <th>NIK</th>
                            <th>Divisi</th>
                            <th>Jenis Pembelian</th>
                            <th>Cost Code</th>
                            <th>Nama Barang</th>
                            <th>Lokasi Kebutuhan</th>
                            <th>Jumlah Pembelian(satuan)</th>
                            <th>Estimasi Harga Satuan</th>
                            <th>Estimasi Total Pembayaran</th>
                            <th>Tanggal Request</th>
                            <th>Keterangan</th>
                            <th>Status Upload</th>
                            <th width="15%">File TBE</th>
                            <th width="15%">File CBE</th>
                            <th width="15%">File PO</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($request_barang as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            @if($d->no_po != '')
                            <td>{{$d->no_po}}</td>
                            @else
                            <td style="color:red;">Belum tersedia</td>
                            @endif
                            
                            <td>{{$d->nama}}</td>
                            <td>{{$d->nik}}</td>
                            @if($d->divisi_id == 0)
                            <td> - </td>
                            @else 
                            <td>{{$d->request_divisi->nama}}</td>
                            @endif
                            <td>{{$d->masterjenisbarang->nama}}</td>
                            <td>{{$d->masterKategori->kode_kategori}}/{{$d->masterKategori->nama_kategori}}</td>
                            <td>{{$d->nama_barang}}</td>
                           <td>{{$d->lokasiProyek->nama}}</td>
                            <td>{{$d->quantity}} {{$d->quantity_satuan}}</td>
                            <td>@rupiah($d->harga),00</td>
                            <td>@rupiah($d->total),00 </td>
                            <td>{{ date('d-m-Y', strtotime($d->tanggal_pengajuan)) }}</td>
                            <td>{{$d->keterangan}}</td>
                            
                            @if($d->status_pengajuan == 1 && $d->status_PO == 0 && $d->upload_po == '' && $d->upload_tba== '' && $d->upload_cba == '')
                                <td>
                                    <span class='label label-danger'>BELUM UPLOAD FILE</span>
                                </td>
                            
                            @else
                                <td>
                                    <span class='label label-success'>SUDAH UPLOAD FILE</span>
                                </td>
                            @endif
                                
                            {{-- @if($d->status_pengajuan == 1 && $d->status_PO == 0 || $d->status_PO == 1 || $d->status_PO == 2)
                                <td>
                                    <span class='label label-warning'>PURCHASED ORDER</span>
                                </td>
                            @elseif($d->status_pengajuan == 1 && $d->status_PO == 3 && $d->status_paid == 0 || $d->status_paid == 1 || $d->status_paid == 2 || $d->status_paid == 3)
                                <td>
                                    <span class='label label-danger'>UNPAID</span>
                                </td>
                            @elseif($d->status_pengajuan == 1 && $d->status_PO == 4 || $d->status_paid == 4)
                                <td>
                                    <span class='label label-danger'>DITOLAK</span>
                                </td>
                            @endif --}}
                            
                            @if($d->upload_tba == '')
                                <td>File belum diupload</td>
                            @else
                                <td><a href="{{url('uploads/TBA/'.$d->upload_tba)}}" target="_blank">Lihat File TBE</td>
                            @endif

                            @if($d->upload_cba == '')
                                <td>File belum diupload</td>
                            @else
                                <td><a href="{{url('uploads/CBA/'.$d->upload_cba)}}" target="_blank">Lihat File CBE</td>
                            @endif
                            @if($d->upload_po == '')
                                <td>File belum diupload</td>
                            @else
                                <td><a href="{{url('uploads/PO/'.$d->upload_po)}}" target="_blank">Lihat File PO</td>
                            @endif

                            @if($d->upload_po != '' && $d->upload_cba != '' && $d->upload_tba != '')
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                </td>
                            @else
                                <td>
                                    <a href="{{route('editbuktiPO', $d->id)}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i><span>Upload File</span></a>
                                </td>
                            @endif
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


