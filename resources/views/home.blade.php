@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <span class="fonts" style="font-size: 20px">
            <b>Dashboard</b>
        </span>
    </section>

    <section class="content">
{{-- Admin --}}
      @if(Auth::user()->role_id==1)
        <div class="row">
          
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
              <h3>{{$countBarangPO}}</h3>
  
              <span><b>List of Document Upload</b>
              <br>(TBE, CBE, PO)
              </span>
              </div>
              <div class="icon">
                <i class="ion ion-ios-upload-outline"></i>
              </div>
              <a href="{{url('listPO')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
              <h3>{{$countListProcurement}}</h3>
  
              <span><b>List of Procurement</b>
              <br>(Approved/Rejected)
              </span>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list"></i>
              </div>
              <a href="{{url('list-procurement')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

{{-- Karyawan --}}
        @elseif(Auth::user()->role_id==2)
        <div class="row">
          {{-- <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow-active">
              <div class="inner">
              <h3>{{$countRequestAll}}</h3>
  
              <span><b>Item Request List</b>
              <br>(Approved/Rejected)</span>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
            <a href="{{url('listRequest')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red-active">
                <div class="inner">
                <h3>{{$countPengajuan}}</h3>
    
                  <span><b>Purchase Item Request List</b>
                  <br>(Pending)</span>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
              <a href="{{url('request')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <h3>{{$countRequestPengeluaran}}</h3>
    
                <span><b>Outgoing Item Request List</b>
                <br>(Pending)</span>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
              <a href="{{url('request-barang-keluar')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <!-- ./col -->
            {{-- <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <h3>{{$countApprovePengajuan}}</h3>
    
                  <p>Approval Request List</p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark"></i>
                </div>
              <a href="{{url('listPengajuan')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                <h3>{{$countRejectedPengajuan}}</h3>
    
                  <p>Rejected Request List</p>
                </div>
                <div class="icon">
                  <i class="ion ion-close"></i>
                </div>
              <a href="{{url('listPengajuan')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div> --}}

          </div>

{{-- Manager --}}
        @elseif(Auth::user()->role_id == 3)
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua-active">
                <div class="inner">
                <h3>{{$countApprovalManager}}</h3>
    
                  <span><b>Approval Request List</b>
                    <br>(Purchase Request)
                  </span>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-compose"></i>
                </div>
                <a href="{{url('approvalManager')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
      

      {{-- VP --}}
          @elseif(Auth::user()->role_id == 4)
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua-active">
                    <div class="inner">
                   
                    <span><b>Approval Request List</b>
                      <br>(Purchase Request)
                    </span>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-compose"></i>
                    </div>
                    <a href="{{url('approvalVP')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
          {{-- @elseif(Auth::user()->role_id == 4 && Auth::user()->user_login->jabatan_id == 3 && Auth::user()->user_login->divisi_id != 6)
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-active">
                  <div class="inner">
                  <h3>{{$countApprovalRequestVPOperational}}</h3>
                    <span><b>Approval Request List</b>
                      <br>(Purchase Request)
                    </span>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-compose"></i>
                  </div>
                  <a href="{{url('approvalVP')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div> --}}

    {{-- CEO --}}
        @elseif(Auth::user()->role_id == 5)
            <div class="row">
                <!--<div class="col-lg-3 col-xs-6">-->
                  <!-- small box -->
                <!--  <div class="small-box bg-aqua-active">-->
                <!--    <div class="inner">-->
                <!--      <h3>{{$countApprovalRequestCEO}}</h3>-->
        
                <!--      <span><b>List Persetujuan</b>-->
                <!--        <br>(Request Pembelian)-->
                <!--      </span>-->
                <!--    </div>-->
                <!--    <div class="icon">-->
                <!--      <i class="ion ion-ios-compose"></i>-->
                <!--    </div>-->
                <!--  <a href="{{url('approvalCEO')}}" class="small-box-footer">Lihat Detail &nbsp;<i class="fa fa-arrow-circle-right"></i></a>-->
                <!--  </div>-->
                <!--</div>-->

                <!--<div class="col-lg-3 col-xs-6">-->
                  <!-- small box -->
                <!--  <div class="small-box bg-green-active">-->
                <!--    <div class="inner">-->
                <!--      <h3>{{$countApprovalPurchaseCEO}}</h3>-->
                <!--        <span><b>List Persetujuan</b>-->
                <!--          <br>(Request Purchased Order)-->
                <!--        </span>-->
                <!--    </div>-->
                <!--    <div class="icon">-->
                <!--      <i class="ion ion-android-cart"></i>-->
                <!--    </div>-->
                <!--  <a href="{{url('po-CEO')}}" class="small-box-footer">Lihat Detail &nbsp;<i class="fa fa-arrow-circle-right"></i></a>-->
                <!--  </div>-->
                <!--</div>-->
              <!--{{-- </div> --}}-->

              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red-active">
                  <div class="inner">
                    <h3>{{$countApprovalPaymentCEO}}</h3>
      
                    <span><b>Approval Request List</b>
                    <br>(Payment Request)
                  </span>
                  </div>
                  <div class="icon">
                    <i class="ion ion-cash"></i>
                  </div>
                <a href="{{url('payment-ceo')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

      {{-- CO --}}
        @elseif(Auth::user()->role_id == 8)
              <div class="row">
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua-active">
                      <div class="inner">
                        <h3>{{$countApprovalPurchaseCO}}</h3>
          
                        <span><b>Approval Request List</b>
                          <br>(Purchased Order)
                        </span>
                      </div>
                      <div class="icon">
                        <i class="ion ion-android-cart"></i>
                      </div>
                    <a href="{{url('po')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue-active">
                      <div class="inner">
                        <h3>{{$countApprovalPaymentCO}}</h3>
          
                        <span><b>Approval Request List</b>
                          <br>(Payment)
                        </span>
                      </div>
                      <div class="icon">
                        <i class="ion ion-cash"></i>
                      </div>
                    <a href="{{url('payment-co')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>

    {{-- CFO --}}
          @elseif(Auth::user()->role_id == 9)
          <div class="row">
              <!--<div class="col-lg-3 col-xs-6">-->
                <!-- small box -->
              <!--  <div class="small-box bg-aqua-active">-->
              <!--    <div class="inner">-->
              <!--      <h3>{{$countApprovalPurchaseCFO}}</h3>-->
              <!--      <span><b>List Persetujuan</b>-->
              <!--        <br>(Purchased Order)-->
              <!--      </span>-->
              <!--    </div>-->
              <!--    <div class="icon">-->
              <!--      <i class="ion ion-android-cart"></i>-->
              <!--    </div>-->
              <!--  <a href="{{url('po-cfo')}}" class="small-box-footer">Lihat Detail &nbsp;<i class="fa fa-arrow-circle-right"></i></a>-->
              <!--  </div>-->
              <!--</div>-->

              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue-active">
                  <div class="inner">
                    <h3>{{$countApprovalPaymentCFO}}</h3>
                    <span><b>Approval Request List</b>
                      <br>(Payment)
                    </span>
                  </div>
                  <div class="icon">
                    <i class="ion ion-cash"></i>
                  </div>
                <a href="{{url('payment-cfo')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

      {{-- Finance --}}
        @elseif(Auth::user()->role_id == 10)
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua-active">
                    <div class="inner">
                      <h3>{{$countUploadInvoice}}</h3>
        
                      <span><b>Invoice Upload List</b>
                        <br>
                        <br>
                      </span>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-list-outline"></i>
                    </div>
                  <a href="{{url('list-invoice')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
  
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-blue-active">
                    <div class="inner">
                      <h3>{{$countUploadPayment}}</h3>
        
                      <span><b>Payment Upload List</b>
                        <br>
                        <br>
                      </span>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-list"></i>
                    </div>
                  <a href="{{url('ubah-status-paid')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>

      {{-- Asset Management --}}
        @elseif(Auth::user()->role_id == 11)
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua-active">
                <div class="inner">
                  <h3>{{$countBarangKeluar}}</h3>
    
                  <span><b>Item Request List</b>
                    <br>
                    (Pengeluaran)
                  </span>
                </div>
                <div class="icon">
                  <i class="ion ion-android-checkbox-outline"></i>
                </div>
              <a href="{{url('list-approval-barang-keluar')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          
          @elseif(Auth::user()->role_id == 12)
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>{{$countKaryawan}}</h3>
      
                    <span><b>Total Employees</b>
                    <br>
                    </span>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="{{url('karyawan')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>10</h3>
      
                    <span><b>Total HO Employees</b>
                    <br>
                    </span>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="{{url('karyawan')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>10</h3>
      
                    <span><b>Total Site Employees</b>
                    <br>
                    </span>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="{{url('karyawan')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
          
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-lime">
                  <div class="inner">
                    <h3>{{$countSpd}}</h3>
      
                    <span><b>Total Pengajuan SPD</b>
                    <br>
                    </span>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="ion ion-plane"></i>
                  </div>
                  <a href="{{url('history-spd')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>{{$countCutiKaryawan}}</h3>
      
                    <span><b>Total Pengajuan Cuti</b>
                    <br>
                    </span>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="ion ion-log-out"></i>
                  </div>
                  <a href="{{url('histori-cuti')}}" class="small-box-footer">See more &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

            </div>
            <section class="content-header">
              <span class="fonts" style="font-size: 20px">
                  <b>SPD Request Update</b>
              </span>
            </section>
            <section class="content">
              <div class="box">
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                        <thead>
                            <tr>
                              <th>No.</th>
                              <th>Reference No.</th>
                              <th>Form Date</th>
                              <th>Employee Name</th>
                              <th>Employee Number</th>
                              <th>Division</th>
                              <th>Travel Type</th>
                              <th>From</th>
                              <th>Destination</th>
                              <th>Status Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($spd as $k => $d)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->no_surat}}</td>
                            <td>{{date('d-M-Y', strtotime($d->form_date))}}</td>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->nik}}</td>
                            <td>{{$d->get_divisi->nama}}</td>
                            <td>{{$d->travel_type}}</td>
                            <td>{{$d->asal}}</td>
                            <td>{{$d->tujuan}}</td>
                            <td><button class="btn-x btn-success">Approved</button></td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <a href="{{url('history-spd')}}" class="btn btn-primary">View More &nbsp;<i class=""></a>
                  </div>
                </div class="box-footer">
              </div>
            </section>
            

        </section>
        
        @endif
@endsection