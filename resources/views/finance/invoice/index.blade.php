@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Upload Invoice</b>
      </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('list-invoice')}}">Upload Invoice</a></li>
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
                            <th>Status Request</th>
                            <th>File Invoice</th>
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
                            @if($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 0 && $d->upload_invoice == '')
                                <td>
                                    <span class='label label-danger'>BELUM UPLOAD INVOICE</span>
                                </td>
                            @elseif($d->status_pengajuan == 1 && $d->status_PO == 2 && $d->status_paid == 0 && $d->upload_invoice != '')
                                <td>
                                    <span class='label label-success'>SUDAH UPLOAD INVOICE</span>
                                </td>
                            @else
                                <td>
                                    <span class='label label-success'>PAID</span>
                                </td>
                            @endif
                         
                            @if($d->upload_invoice == '')
                                <td><span> - </span></td>
                            @else
                            <td><a href="{{url('uploads/invoice/'.$d->upload_invoice)}}" target="_blank">Lihat Invoice</td>
                            @endif
                        
                            @if($d->upload_invoice != '')
                                <td>
                                    <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-upload"></i></a>
                                </td>
                            @else
                                <td>
                                    <a href="{{route('editbuktiinvoice',$d->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-upload"></i></a>
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


