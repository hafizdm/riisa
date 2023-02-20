@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     List Inventory
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#"></a></li>
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
            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                          <th width="5%">No.</th>
                          <th>Nama Karyawan</th>
                          <th>NIK</th>
                          <th>Divisi</th>
                          <th>Jenis Barang</th>
                          <th>Kode Barang</th>
                          <th>Qty</th>
                          <th>Harga</th>
                          <th>Total</th>
                          <th>Satuan</th>
                          <th>Lokasi</th>
                          <th>Tgl Pengajuan</th>
                          <th>Ket</th>
                          <th>Status Payment</th>
                          <th>Bukti PO</th>
                          <th>Bukti Invoice</th>
                          <th>Bukti Pembayaran</th>
                          <!-- <th width="15%">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($inventory_barang as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->nik}}</td>
                            @if($d->divisi_id == 0)
                            <td> - </td>
                            @else 
                            <td>{{$d->request_divisi->nama}}</td>
                            @endif
                            {{-- <td>{{$d->request_divisi->nama}}</td> --}}
                            <td>{{$d->masterjenisbarang->nama}}</td>
                            <td>{{$d->kode_barang}} - {{$d->nama_barang}}</td>
                            <td>{{$d->quantity}}</td>
                            <td>@rupiah($d->harga),00</td>
                              <td>@rupiah($d->total),00 </td>
                            <td>{{$d->quantity_satuan}}</td>
                            <td>{{$d->nama_proyek}}</td>
                            <td>{{ date('d-m-Y', strtotime($d->tanggal_pengajuan)) }}</td>
                            <td>{{$d->keterangan}}</td>
                            @if($d->status_pengajuan == 3 && $d->status_PO == 3 && $d->status_paid == 3)
                                <td>
                                    <span class='label label-danger'>UNPAID</span>
                                </td>
                            @elseif($d->status_pengajuan == 3 && $d->status_PO == 3 && $d->status_paid == 5)
                                <td>
                                    <span class='label label-success'>PAID</span>
                                </td>
                            @else
                                <td>
                                    <span class='label label-danger'>DITOLAK</span>
                                </td>
                            @endif
                            <td><a href="{{url('uploads/PO/'.$d->upload_po)}}" target="_blank">Lihat Bukti PO</td>
                        
                            <td><a href="{{url('uploads/invoice/'.$d->upload_invoice)}}">Lihat Invoice</td>

                            @if($d->upload_bukti_bayar == '')
                                <td> - </td>
                            @else
                                <td><a href="{{url('uploads/buktibayar/'.$d->upload_bukti_bayar)}}" target="_blank">Lihat Bukti Bayar</td>
                            @endif

                            <!-- @if($d->status_paid == 5)
                            <td>
                                <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> </span></a>
                            </td>
                            @else
                            <td>
                                <a href="{{route('editpaid',$d->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> </span></a>
                            </td>
                            @endif -->
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

{{-- <div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div> --}}
<!-- end of modal konfirmasi -->
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
$(function(){
   var mainTable = $('#data-table').DataTable();
   var selectedRow;
});
</script>
@endpush


