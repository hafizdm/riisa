@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Upload Payment/Bukti Bayar</b>
      </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('ubah-status-paid')}}">invoice</a></li>
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
                    <h5><i class="icon fa fa-ban"></i> Pemberitahuan !</h5>
                    {{ session()->get('failed') }}
                </div>
            @endif
            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nomor Payment</th>
                            <th>Nama Karyawan</th>
                            <th>NIK</th>
                            <th>Divisi</th>
                            <th>Jenis Pembelian</th>
                            <th>Cost Code</th>
                            <th>Nama Barang</th>
                            <th>Lokasi Kebutuhan</th>
                            <th>Jumlah Pembelian(satuan)</th>
                            <th>Harga Satuan</th>
                            <th>Total Pembayaran</th>
                            <th>Tanggal Request</th>
                            <th>Keterangan</th>
                            <th width="15%">File Invoice</th>
                            <th width="15%">File Payment</th>
                            <th>Status Request</th>
                            <!--<th>Total Barang Pending</th>-->
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($request_barang as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            @if($d->no_payment != '')
                                <td>{{$d->no_payment}}</td>
                            @else
                                <td></td>
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
                            <td><a href="{{url('uploads/invoice/'.$d->upload_invoice)}}" target="_blank">Lihat Invoice</td>
                            
                            <!--Updated by Zul-->
                            @if($d->upload_bukti_bayar != null)
                                <td><a href="{{url('uploads/buktibayar/'.$d->upload_bukti_bayar)}}" target="_blank">Lihat Bukti Bayar</td>
                            @else
                                @if($d->parsial_pay1 == null && $d->parsial_pay2 == null && $d->parsial_pay3 == null && $d->parsial_pay4 == null)
                                    <td><span style="color:red">Belum Upload File</span></td>
                                
                                {{-- Parsial 1 --}}
                                @elseif($d->parsial_pay1 != null && $d->parsial_pay2 == null && $d->parsial_pay3 == null && $d->parsial_pay4 == null)
                                    <td><a href="{{url('uploads/buktibayar/'.$d->parsial_pay1)}}" target="_blank">Pembayaran Parsial 1</td>
                                {{-- Parsial 2 --}}
                                @elseif( $d->parsial_pay1 != null && $d->parsial_pay2 != null && $d->parsial_pay3 == null && $d->parsial_pay4 == null)
                                    <td>
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay1)}}" target="_blank">Pembayaran Parsial 1
                                        <br>
                                        ---------------
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay2)}}" target="_blank">Pembayaran Parsial 2
                                    </td>
                                {{-- Parsial 3 --}}
                                @elseif( $d->parsial_pay1 != null && $d->parsial_pay2 != null && $d->parsial_pay3 != null && $d->parsial_pay4 == null)
                                    <td>
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay1)}}" target="_blank">Pembayaran Parsial 1
                                        <br>
                                        ---------------
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay2)}}" target="_blank">Pembayaran Parsial 2
                                        <br>
                                        ---------------
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay3)}}" target="_blank">Pembayaran Parsial 3
                                    </td>
                                {{-- Parsial 4 --}}
                                @elseif( $d->parsial_pay1 != null && $d->parsial_pay2 != null && $d->parsial_pay3 != null && $d->parsial_pay4 != null)
                                    <td>
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay1)}}" target="_blank">Pembayaran Parsial 1
                                            <br>
                                            ---------------
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay2)}}" target="_blank">Pembayaran Parsial 2
                                            <br>
                                            ---------------
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay3)}}" target="_blank">Pembayaran Parsial 3
                                            <br>
                                            ---------------
                                        <a href="{{url('uploads/buktibayar/'.$d->parsial_pay4)}}" target="_blank">Pembayaran Parsial 4
                                    </td>
                                @endif
                            @endif
                            
                            @if($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 3)
                                <td>
                                    <span class='label label-danger'>MENUNGGU PAYMENT</span>
                                </td>
                            @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 5)
                                <td>
                                    <span class='label label-success'>PAID</span>
                                </td>
                            @else
                                <td>
                                    <span class='label label-danger'>DITOLAK</span>
                                </td>
                            @endif
                            
                            <!--@if($d->total_barang_pending != null)-->
                            <!--    <td>{{$d->total_barang_pending}} {{$d->quantity_satuan}}</td>-->
                            <!--@else -->
                            <!--    <td>{{$d->quantity}} {{$d->quantity_satuan}}</td>-->
                            <!--@endif-->

                            @if($d->status_paid == 5)
                                <td>
                                    <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> </span></a>
                                </td>
                            @else
                                <td>
                                    <a href="{{route('editpaid',$d->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> </span></a>
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


