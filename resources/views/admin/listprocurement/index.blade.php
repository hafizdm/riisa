@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts" style="font-size: large;">
     <b> List Procurement</b>
    </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('list-procurement')}}"> List Procurement </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            @endif
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
                            <th>Jumlah Pembelian(satuan)</th>
                            <th>Harga Satuan</th>
                            <th>Total Pembayaran</th>
                            <th>Lokasi Kebutuhan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Request(Pembelian)</th>
                            <th>Keterangan(VP)</th>
                            <th>Keterangan(CEO)</th>
                            <th>Keterangan(CC)</th>
                            <th>File TBE</th>
                            <th>File CBE</th>
                            <th>File PO</th>
                            <th>Terakhir Diproses Oleh</th>
                            <th>Tanggal diproses</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($list_procurement as $k => $d)
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
                            <td>{{$d->quantity}} {{$d->quantity_satuan}}</td>
                            <td>@rupiah($d->harga),00</td>
                            <td>@rupiah($d->total),00</td>
                            <td>{{$d->lokasiProyek->nama}}</td>
                            <td>{{$d->keterangan}}</td>
                            <td>{{date('d-m-Y', strtotime($d->tanggal_pengajuan))}}</td>      
                            <td>{{$d->komentar_vp}}</td>
                            <td>{{$d->komentar_ceo}}</td>
                            <td>{{$d->keterangan_by_cc}}</td>

                            @if($d->upload_tba != '')
                                <td><a href="{{url('uploads/TBA/'.$d->upload_tba)}}" target="_blank">Lihat File TBE</td>
                            @else
                                <td>Tidak ada file</td>
                            @endif

                            @if($d->upload_cba != '')
                                <td><a href="{{url('uploads/CBA/'.$d->upload_cba)}}" target="_blank">Lihat File CBE</td>
                            @else
                                <td>Tidak ada file</td>
                            @endif

                            @if($d->upload_po != '')
                                <td><a href="{{url('uploads/PO/'.$d->upload_po)}}" target="_blank">Lihat File PO</td>
                            @else
                                <td>Tidak ada file</td>
                            @endif

                          
                        <!--Diproses Oleh-->
                         @if($d->status_PO == 1 && $d->updated_co_po_by != '' && $d->status_paid == 0 || $d->status_PO == 4 && $d->updated_co_po_by != '' && $d->status_paid == 0)
                         <td>{{$d->updated_co_po_by}}</td>
                         
                         @elseif($d->status_PO == 2 && $d->updated_pm_po_by != '' && $d->status_paid == 0 || $d->status_PO == 4 && $d->updated_pm_po_by != '' && $d->status_paid == 0)
                         <td>{{$d->updated_pm_po_by}}</td>
                         
                         @elseif($d->status_PO == 2 && $d->updated_vp_po_by != '' && $d->status_paid == 0 || $d->status_PO == 4 && $d->updated_vp_po_by != '' && $d->status_paid == 0)
                         <td>{{$d->updated_vp_po_by}}</td>
                         
                         @elseif($d->status_PO == 2 && $d->status_paid == 1 && $d->updated_co_pay_by != '' || $d->status_paid == 4 && $d->updated_co_pay_by != '' )
                         <td>{{$d->updated_co_pay_by}}</td>
                         
                         @elseif($d->status_PO == 2 && $d->status_paid == 2 && $d->updated_cfo_pay_by != '' || $d->status_paid == 4 && $d->updated_cfo_pay_by != '')
                         <td>{{$d->updated_cfo_pay_by}}</td>
                         
                         @elseif($d->status_PO == 2 && $d->status_paid == 3 && $d->updated_cfo_pay_by != '' || $d->status_paid == 4 && $d->updated_cfo_pay_by != '')
                         <td>{{$d->updated_ceo_pay_by}}</td>
                         
                         @elseif($d->status_paid == 5)
                         <td>Finance Payment</td>
                         @endif
                         
                        
                        <td>{{ date('d-m-Y', strtotime($d->updated_at)) }}</td>
                        
                           <!--Status Pembelian-->
                            @if($d->status_PO == 4 || $d->status_paid == 4)
                                <td style="text-align: center"><span class="label label-danger"> DITOLAK</span></td>
                                
                            @elseif($d->status_PO == 0 && $d->status_paid == 0 || $d->status_PO == 1 && $d->status_paid == 0 || $d->status_PO == 2 && $d->status_paid == 0 )
                                <td style="text-align: center"><span class="label label-warning"><span>PURCHASED ORDER</span></td>
                                
                            @elseif($d->status_PO == 2 && $d->status_paid == 1 || $d->status_PO == 2 && $d->status_paid == 2)
                                <td style="text-align: center"><span class="label label-warning"> <span>PROSES PAYMENT</span></td>
                                
                            @elseif($d->status_PO == 2 && $d->status_paid == 3)
                                <td style="text-align: center"><span class="label label-danger"> <span>MENUNGGU PAYMENT</span></td>
                                
                            @elseif($d->status_PO == 2 && $d->status_paid == 5)
                                <td style="text-align: center"><span class="label label-success"><span>PAID</span></td>
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


