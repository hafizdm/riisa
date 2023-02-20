@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts" style="font-size: large;">
     <b>Item Request List (Purchase and outgoing)</b>
    </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="{{url('listRequest')}}">Item Request List </a></li>
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
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Payment Number</th>
                            <th>Type of Purchase</th>
                            <th>Cost Code</th>
                            <th>Item Name</th>
                            <th>Purchase Amount(unit)</th>
                            <th>Estimated Unit Price</th>
                            <th>Payment Amount</th>
                            <th>Requirement Location</th>
                            <th>Description</th>
                            <th>Request date(Purchase)</th>
                            <th>Notes (VP/PM)</th>
                            <!--<th>Keterangan(CEO)</th>-->
                            <th>Approved By</th>
                            <th>Purchase Status</th>
                            <th>Approved Date</th>
                            <th>Outgoing Status</th>
                            <th>Item Release Date</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($request_barang as $k => $d)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              @if($d->no_payment != '')
                                <td>{{$d->no_payment}}</td>
                              @else
                                <td>-</td>
                              @endif
                              <td>{{$d->masterjenisbarang->nama}}</td>
                              <td>{{$d->masterKategori->kode_kategori}}/{{$d->masterKategori->nama_kategori}}</td>
                              <td>{{$d->nama_barang}}</td>
                              <td>{{$d->quantity}} {{$d->quantity_satuan}}</td>
                              <td>@rupiah($d->harga),00</td>
                              <td>@rupiah($d->total),00</td>
                              <td>{{$d->lokasiProyek->nama}}</td>
                              <td>{{$d->keterangan}}</td>
                              <td>{{ date('d-M-Y', strtotime($d->tanggal_pengajuan)) }}</td>      
                              <td>
                                  @if($d->komentar_vp != "")
                                    <span>{{$d->komentar_vp}}</span>
                                  @else 
                                    <span> - </span>
                                  @endif
                                </td>

                              <td>
                                @if($d->status_paid == 4)
                                    @if($d->updated_co_pay_by != "" && $d->updated_cfo_pay_by == "" && $d->updated_ceo_pay_by == "") 
                                        <span>{{$d->updated_co_pay_by}}</span>
                                    @elseif($d->updated_co_pay_by != "" && $d->updated_cfo_pay_by != "" && $d->updated_ceo_pay_by == "")
                                        <span>{{$d->updated_cfo_pay_by}}</span>
                                    @elseif($d->updated_co_pay_by != "" && $d->updated_cfo_pay_by != "" && $d->updated_ceo_pay_by != "") 
                                        <span>{{$d->updated_ceo_pay_by}}</span>
                                    @else
                                        <span> -  </span>
                                    @endif
                                @elseif($d->status_paid == 5)
                                    <span>Finance</span>
                                @else
                                    <span> - </span>
                                @endif
                              </td>
                            
                           <!--{{-- Status Pembelian--}}-->
                            @if($d->status_pengajuan == 4 || $d->status_PO == 4 || $d->status_paid == 4)
                                <td style="text-align: center"><span class="label label-danger"> REJECTED</span></td>
                            @elseif($d->status_pengajuan == 1 && $d->status_PO== 2 && $d->status_paid == 5)
                                <td style="text-align: center"><span class="label label-success" style="background-color: rgb(0, 123, 255) !important"> APPROVED</span></td>
                            @else
                                    <td></td>
                            @endif

                            <!--{{-- Approval Date Pembelian --}}-->
                            <td>{{ date('d-M-Y', strtotime($d->updated_at)) }}</td>

                            <!--{{-- Status Pengeluaran --}}-->
                            @if($d->status_brg_keluar == 0)
                                <td><a href="{{url('request-barang-keluar')}}/{{$d->id}}"><span class="label label-danger"><i class="fa fa-edit"></i> MAKE A REQUEST</span></a></td>
                            @elseif($d->status_brg_keluar == 1)
                                <td style="text-align: center"><span class="label label-warning">PROCESS</span></td>
                            @else
                                <td style="text-align: center"><span class="label label-success">APPROVED</span></td>
                            @endif

                          <!--{{-- Approval Date Barang Keluar --}}-->
                          @if($d->tanggal_pengeluaran == null || $d->tanggal_pengeluaran == '' )
                              <td></td>
                          @else
                              <td>{{ date('d-m-Y', strtotime($d->tanggal_pengeluaran)) }}</td>
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


