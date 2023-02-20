@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>List Approval Barang Keluar</b>
    </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{url('list-approval-barang-keluar')}}">List Barang Keluar</a></li>
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
                            <th>Jenis Pembelian</th>
                            <th>Cost Code</th>
                            <th>Nama Barang</th>
                            <th>Lokasi Kebutuhan</th>
                            <th>Jumlah Pembelian(satuan)</th>
                            <th>Harga Satuan</th>
                            <th>Total Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Tanggal Request Pembelian</th>
                            <th>Tanggal Disetujui</th>
                            <th>Status Request Pembelian</th>
                            <th>Total Barang Pending</th>
                            <th>Total Barang Diterima</th>
                            <th>Diproses Oleh</th>
                            <th>Tanggal Barang Keluar</th>
                            <th>Status Request Pengeluaran</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($request_barang as $k => $d)
                        <tr>
                           <td>{{$loop->iteration}}</td>
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
                        <td>{{ date('d-m-Y', strtotime($d->updated_at)) }}</td>

                        <!--{{-- Status Request Pembelian --}}-->
                        @if($d->status_paid == 5 && $d->upload_bukti_bayar != null 
                            && $d->parsial_pay1 == null
                            && $d->parsial_pay2 == null
                            && $d->parsial_pay3 == null
                            && $d->parsial_pay4 == null)
                            <td><span class='label label-success'>LUNAS</span></td>
                        @elseif($d->status_paid == 3 && $d->upload_bukti_bayar == null 
                            && $d->parsial_pay1 != null
                            && $d->parsial_pay2 == null
                            && $d->parsial_pay3 == null
                            && $d->parsial_pay4 == null)
                            <td><span class='label label-warning'> PEMBAYARAN PARSIAL KE-1</span></td>
                        @elseif($d->status_paid == 3 && $d->upload_bukti_bayar == null 
                            && $d->parsial_pay1 != null
                            && $d->parsial_pay2 != null
                            && $d->parsial_pay3 == null
                            && $d->parsial_pay4 == null)
                            <td><span class='label label-warning'> PEMBAYARAN PARSIAL KE-2</span></td>
                        @elseif($d->status_paid == 3 && $d->upload_bukti_bayar == null 
                            && $d->parsial_pay1 != null
                            && $d->parsial_pay2 != null
                            && $d->parsial_pay3 != null
                            && $d->parsial_pay4 == null)
                            <td><span class='label label-warning'> PEMBAYARAN PARSIAL KE-3</span></td>
                        @elseif($d->status_paid == 3 && $d->upload_bukti_bayar == null 
                            && $d->parsial_pay1 != null
                            && $d->parsial_pay2 != null
                            && $d->parsial_pay3 != null
                            && $d->parsial_pay4 != null)
                            <td><span class='label label-warning'> PEMBAYARAN PARSIAL KE-4</span></td>
                        @elseif($d->status_paid == 5 && $d->upload_bukti_bayar != null 
                            && $d->parsial_pay1 == null
                            && $d->parsial_pay2 == null
                            && $d->parsial_pay3 == null
                            && $d->parsial_pay4 == null)
                            <td><span class='label label-success'> LUNAS</span></td>
                        @elseif($d->status_paid == 5 && $d->upload_bukti_bayar == null 
                            && $d->parsial_pay1 != null
                            && $d->parsial_pay2 != null
                            && $d->parsial_pay3 != null
                            && $d->parsial_pay4 != null)
                            <td><span class='label label-success'> LUNAS</span></td>
                        @elseif($d->status_paid == 5 && $d->upload_bukti_bayar == null 
                            && $d->parsial_pay1 != null
                            && $d->parsial_pay2 != null
                            && $d->parsial_pay3 == null
                            && $d->parsial_pay4 == null)
                            <td><span class='label label-success'> LUNAS</span></td>
                        @elseif($d->status_paid == 5 && $d->upload_bukti_bayar == null 
                            && $d->parsial_pay1 != null
                            && $d->parsial_pay2 != null
                            && $d->parsial_pay3 != null
                            && $d->parsial_pay4 == null)
                            <td><span class='label label-success'> LUNAS</span></td>
                        @else
                            <td><span class='label label-danger'>DITOLAK</span></td>
                        @endif
                       
                        @if($d->status_brg_keluar == 1 && $d->status_paid == 3 && $d->barang_parsial == 1)
                            <td>
                                {{$d->total_barang_pending}} {{$d->quantity_satuan}}
                            </td>
                        @elseif($d->status_brg_keluar == 1 && $d->status_paid == 5 && $d->barang_parsial == 0)
                            <td>
                                {{$d->quantity}} {{$d->quantity_satuan}}
                            </td>
                        @elseif($d->status_brg_keluar == 1 && $d->status_paid == 5 && $d->barang_parsial == 1)
                            <td>
                                {{$d->total_barang_pending}} {{$d->quantity_satuan}}
                            </td>
                        @elseif($d->status_brg_keluar == 2 && $d->status_paid == 5 && $d->barang_parsial == 1)
                            <td>
                                {{$d->total_barang_pending}} {{$d->quantity_satuan}}
                            </td>
                        @elseif($d->status_brg_keluar == 2 && $d->status_paid == 3 && $d->barang_parsial == 1)
                            <td>
                                {{$d->total_barang_pending}} {{$d->quantity_satuan}}
                            </td>
                        @elseif($d->status_brg_keluar == 2 && $d->status_paid == 5 && $d->barang_parsial == 0)
                            <td>
                                {{$d->total_barang_pending}} {{$d->quantity_satuan}}
                            </td>
                        @endif

                        <td>
                            {{$d->total_barang_keluar}} {{$d->quantity_satuan}}
                        </td>

                        @if($d->updated_asset_by == null)
                            <td>-</td>
                        @else
                            <td>{{$d->updated_asset_by}}</td>
                        @endif

                        @if($d->tanggal_pengeluaran == null)
                            <td>-</td>
                        @else
                            <td>{{date('d-m-Y', strtotime($d->tanggal_pengeluaran))}}</td>
                        @endif
                        
                        <!--{{-- Status Request Pengeluaran --}}-->
                        @if($d->status_brg_keluar == 1 && $d->status_paid == 5 && $d->barang_parsial == 0)
                            <td><span class='label label-danger'>BUTUH APPROVAL</span></td>
                        @elseif($d->status_brg_keluar == 1 && $d->status_paid == 3 && $d->barang_parsial == 1)
                            <td><span class='label label-danger'> BUTUH APPROVAL</span></td>
                        @elseif($d->status_brg_keluar == 1 && $d->status_paid == 5 && $d->barang_parsial == 1)
                            <td><span class='label label-danger'> BUTUH APPROVAL</span></td>
                        @elseif($d->status_brg_keluar == 2 && $d->status_paid == 3 && $d->barang_parsial == 1)
                            <td><span class='label label-success'>DONE</span></td>
                        @elseif($d->status_brg_keluar == 2 && $d->status_paid == 5 && $d->barang_parsial == 0)
                            <td><span class='label label-success'>DONE</span></td>
                        @elseif($d->status_brg_keluar == 2 && $d->status_paid == 5 && $d->barang_parsial == 1)
                        <td><span class='label label-success' style="background-color: blue !important">DISETUJUI</span></td>
                        @endif
                        
                        @if($d->status_brg_keluar == 2)
                            <td>
                                <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></span></a>
                            </td> 
                        @else
                            <td>
                                <a href="{{route('editapprovalbrg',$d->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></span></a>
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


