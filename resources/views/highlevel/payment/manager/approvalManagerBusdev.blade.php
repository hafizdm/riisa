@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Approval Payment
        <small> - Manager BusDev</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">approval payment</a></li>
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
                          <th>Kode Barang</th>
                          <th>Qty</th>
                          <th>Harga</th>
                          <th>Total</th>
                          <th>Satuan</th>
                          <th>Lokasi</th>
                          <th>Tgl Pengajuan</th>
                          <th>Ket</th>
                          <th>Status</th>
                          <th width="15%">Bukti PO</th>
                          <th width="15%">Invoice</th>
                          <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($request_barang as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->nik}}</td>
                            <td>{{$d->request_divisi->nama}}</td>
                            <td>{{$d->kode_barang}} - {{$d->nama_barang}}</td>
                            <td>{{$d->quantity}}</td>
                            <td>@rupiah($d->harga),00</td>
                            <td>@rupiah($d->total),00 </td>
                            <td>{{$d->quantity_satuan}}</td>
                            <td>{{$d->nama_proyek}}</td>
                            <td>{{ date('d-m-Y', strtotime($d->tanggal_pengajuan)) }}</td>
                            <td>{{$d->keterangan}}</td>
                            @if($d->status_pengajuan == 3 && $d->status_PO == 5 && $d->status_paid == 1)
                                <td>
                                <span class='label label-warning'>UNPAID</span>
                                </td>
                            @endif

                            @if($d->upload_po != '')
                                <td><a href="{{url('uploads/PO/'.$d->upload_po)}}">Lihat Bukti PO</td>
                            @endif

                            @if($d->upload_po != '')
                                <td><a href="{{url('uploads/invoice/'.$d->upload_invoice)}}">Lihat Invoice</td>
                            @endif
                            <td>
                                <a href="{{route('editapprovalmanagerho-payment',$d->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> </span></a>
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


