@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <!--<span class="fonts" style="font-size:20px">-->
    <!--    <b>Approval Purchase Order</b>-->
    <!--   </span>-->
    <br>
    <ol class="breadcrumb">
    <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{url('po')}}">Approval Purchased Order</a></li>
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
                            <th>Harga Satuan</th>
                            <th>Total Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Tanggal Request</th>
                            <th>Keterangan (VP/PM)</th>
                            <!--<th>Keterangan (CEO)</th>-->
                            <!--<th width="15%">File TBE</th>-->
                            <!--<th width="15%">File CBE</th>-->
                            <!--<th width="15%">File PO</th>-->
                            <th>Status Request</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($request_barang as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            @if($d->no_po != '')
                                <td>{{$d->no_po}}</td>
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
                            <td>{{$d->keterangan}}</td>
                            <td>{{ date('d-m-Y', strtotime($d->tanggal_pengajuan)) }}</td>
                            <td>{{$d->komentar_vp}}</td>
                            <!--<td>{{$d->komentar_ceo}}</td>-->
                            <!--<td><a href="{{url('uploads/TBA/'.$d->upload_tba)}}" target="_blank">Lihat File TBE</td>-->
                            <!--<td><a href="{{url('uploads/CBA/'.$d->upload_cba)}}" target="_blank">Lihat File CBE</td>-->
                            <!--<td><a href="{{url('uploads/PO/'.$d->upload_po)}}" target="_blank">Lihat File PO</td>-->
                            @if($d->status_pengajuan == 1 && $d->status_PO == 0)
                                <td>
                                    <span class='label label-warning'>PURCHASED ORDER</span>
                                </td>
                            @endif
                            <td>
                                <a href="{{route('editapprovalco-po',$d->id)}}" class="btn btn-danger btn-xs"><span class='glyphicon glyphicon-pencil'>Butuh Approval</span></a>
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


