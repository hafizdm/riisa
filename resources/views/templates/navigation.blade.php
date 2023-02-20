<?php
  use \App\Http\Controllers\navigation;
  use App\Costaccount as CostAccount;
  $app_timesheet = [];
  $costaccount = CostAccount::all();

  foreach ($costaccount as $ca) {
      $app_timesheet[] = $ca->approved;
  }
?>


@if(!Auth::user())
<!-- jika belum ada session login -->
<script type="text/javascript">
    window.location.replace("{{ route('login') }}");
</script>
@else
<!-- jika sudah login -->
<header class="main-header">
  <!-- Logo -->
  <a href="{{ url('') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>RIISA</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>RII</b>SA</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!--<img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" class="user-image" alt="User Image">-->
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 10 || Auth::user()->role_id == 11 || Auth::user()->role_id == 12)
            <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" class="user-image" alt="User Image">
          @else
          <?php 
            $foto = Auth::user()->user_login->foto;
          ?>
            @if($foto == null)
              <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" class="user-image" alt="User Image">
            @else
              <img src="{{ asset('uploads/Karyawan/')."/".$foto}}" class="user-image" alt="User Image">
            @endif
        @endif
        
            <span class="hidden-xs">{{\Auth::user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <form method="post" action="{{ url('logout') }}" style="display: inline">
                    {{ csrf_field() }}
                    <button class="btn btn-default btn-flat" type="submit">Logout</button>
                  </form>
                </div>
              </li>
            </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="padding:15px 10px 75px 10px !important;">
      
      <div class="pull-left image">
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 10 || Auth::user()->role_id == 11 || Auth::user()->role_id == 12)
            <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
          @else
          <?php 
            $foto = Auth::user()->user_login->foto;
          ?>
            @if($foto == null)
              <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
            @else
              <img src="{{ asset('uploads/Karyawan/')."/".$foto}}" class="img-circle" alt="User Image">
            @endif
        @endif
      </div>

        <div class="pull-left info">
          @if(Auth::user()->username == "admin" || Auth::user()->username == "finance" || Auth::user()->username == "asset.management" || Auth::user()->username == "HRD")
            <p>{{\Auth::user()->name}}</p>
          @else
            <p>{{\Auth::user()->name}}</p>
            <p><i class="fa fa-id-badge" aria-hidden="true"></i> &nbsp; {{Auth::user()->user_login->nik}}</p>
            <p style="font-size: 13px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; {{Auth::user()->user_login->jabatan->jenis_jabatan}}</p>
            <!--<p style="font-size: 13px;"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; {{Auth::user()->user_login->lokasi->nama}}</p>-->
            
          @endif
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    {{-- @if(Auth::user()->role()->name == "Karyawan"){ --}}
    <!-- sidebar menu: : style can be found in sidebar.less -->

    @if(Auth::user()->role_id==1)
    <!--{{-- ROLE ADMIN --}}-->
    <ul class="sidebar-menu">
      <li class="header"><b>NAVIGATION MENU</b></li>
      <li class="treeview">
        <a href="{{ url('') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-database"></i> <span>Master Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <li class="">
            <a href="{{ url('listVendor') }}">
              <i class="fa fa-tasks"></i> <span>Vendor</span>
            </a>
          </li>
          <li class="">
            <a href="{{ url('divisi') }}">
              <i class="fa fa-tasks"></i> <span>Division</span>
            </a>
          </li>
          <li class="">
            <a href="{{ url('jabatan') }}">
              <i class="fa fa-tasks"></i> <span>Position</span>
            </a>
          </li>

  
          <li class="">
            <a href="{{ url('kategoribarang') }}">
              <i class="fa fa-tasks"></i> <span>Cost Code</span>
            </a>
          </li>
          <li class="">
            <a href="{{ url('barang') }}">
              <i class="fa fa-tasks"></i> <span>Items</span>
            </a>
          </li>
           
          <li class="">
            <a href="{{ url('proyek') }}">
              <i class="fa fa-tasks"></i> <span>Project</span>
            </a>
          </li>

          <!--<li class="">-->
          <!--  <a href="{{ url('karyawan') }}">-->
          <!--    <i class="fa fa-tasks"></i> <span>Karyawan</span>-->
          <!--  </a>-->
          <!--</li>-->
         
        </ul>
      </li>
        
        <li class="treeview">
            <a href="#">
              <i class="fa fa-database"></i> <span>Master Data Timesheet</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="">
                <a href="{{ url('resource') }}">
                  <i class="fa fa-user-circle-o"></i> <span>Resource</span>
                </a>
              </li>
              <li class="">
                <a href="{{ url('cost-account') }}">
                  <i class="fa fa-book"></i> <span>Scope of Work</span>
                </a>
              </li>
              <li class="">
                <a href="{{ url('general-work') }}">
                  <i class="fa fa-briefcase"></i> <span>Working Type</span>
                  </a>
              </li>
            </ul>
        </li>
             
      <li class="treeview">
      <a href="{{url('listPO')}}">
          <i class="fa fa-clock-o"></i>Upload Procurement
          <span class="pull-right-container">
            <span class="label label-warning pull-right"><?php echo navigation::countUploadPO()?></span>
          </span>
        </a>
      </li>

      <li class="treeview">
        <a href="{{url('list-procurement')}}">
            <i class="fa fa-list"></i>Procurement List
            
          </a>
        </li>

      </li>

      </li>
    </ul>
  
    @elseif(Auth::user()->role_id==2)
    <!--{{-- ROLE KARYAWAN --}}-->
      <ul class="sidebar-menu">
        <li class="header"><b> NAVIGATION MENU</b></li>
        <li class="treeview">
          <a href="{{ url('') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus-circle"></i> <span>Request of Items</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="">
              <a href="{{ url('request') }}">
                <i class="fa fa-edit"></i>Purchase of Item
                <span class="pull-right-container">
                  <span class="label label-warning pull-right"><?php echo navigation::requestPembelian()?></span>
                </span>
              </a>
            </li>

            <li class="">
              <a href="{{ url('request-barang-keluar') }}">
                <i class="fa fa-edit"></i>Outgoing Item
                <span class="pull-right-container">
                  <span class="label label-warning pull-right"><?php echo navigation::requestPengeluaran()?></span>
                </span>
              </a>
            </li>

          </ul>
        </li>

        <li class="treeview">
          <a href="{{ url('listRequest') }}">
             <i class="fa fa-list"></i><span>Item Request List</span>
          </a>
        </li>
        
        <!--Updated by cici-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Human Capital</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-address-card"></i>
                <span>My Profile</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ubah-data-diri')}}/{{Auth::user()->username}}"><i class="fa fa-user"></i>Change Profile</a></li>
                <li><a href="{{url('pengalaman')}}"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Experience</a></li>
                <li><a href="{{url('pendidikan')}}"><i class="fa fa-university" aria-hidden="true"></i>Education</a></li>
                <li><a href="{{url('upload-file')}}"><i class="fa fa-paperclip "></i>Upload Additional Files</a></li>
              </ul>
            </li>
          <!--  <li class="">-->
          <!--    <a href="{{url('time-sheet')}}">-->
          <!--    <i class="fa fa-clock-o"></i>Time Sheet-->
          <!--  </a>-->
          <!--</li>-->
          
           @if(in_array(Auth::user()->username, $app_timesheet))
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-address-card"></i>
                  <span>Timesheet</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('time-sheet')}}"><i class="fa fa-user"></i>Add Timesheet</a></li>
                  <li><a href="{{url('approval-timesheet')}}"><i class="fa fa-check-square-o" aria-hidden="true"></i>Timesheet Approval</a></li>
                </ul>
              </li>

            @else 
              <li class="">
                <a href="{{url('time-sheet')}}">
                  <i class="fa fa-clock-o"></i>Add Timesheet
                </a>
              </li>
            @endif
            
          <li class="treeview">
            <a href="{{ url('pengajuan-spd') }}">
              <i class="fa fa-file-text-o"></i><span>Add SPD Form</span>
            </a>
          </li>

          <li class="treeview">
            <a href="{{ url('spd-request') }}">
              <i class="fa fa-file-text-o"></i><span>SPD Request</span>
            </a>
          </li>
          
          <li class="treeview">
            <a href="{{ url('pengajuan-cuti') }}">
              <i class="fa fa-file-text-o"></i><span>Leave Form</span>
            </a>
          </li>
          </ul>
        </li>

        <li class="treeview">
          <a href="{{ url('ganti-password') }}/{{Auth::user()->id}}">
            <i class="fa fa-lock"></i> <span>Change Password</span>
          </a>
        </li>
      </ul>

    @elseif(Auth::user()->role_id==3)
    <!--{{-- ROLE MANAGER --}}-->
      <ul class="sidebar-menu">
        <li class="header"><b>NAVIGATION MENU</b></li>
        <li class="treeview">
          <a href="{{ url('') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('approvalManager') }}">
            <i class="fa fa-check-square-o"></i><span>Approval Request Barang</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right"><?php echo navigation::countRequestManager()?></span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('po-pm') }}">
            <i class="fa fa-check-square-o"></i><span>Approval Purchase Order</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right"><?php echo navigation::countPurchasePM()?></span>
            </span>
          </a>
        </li>
        
        <!--Updated by cici-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Human Capital</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-address-card"></i>
                <span>My Profile</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ubah-data-diri')}}/{{Auth::user()->username}}"><i class="fa fa-user"></i>Change Profile</a></li>
                <li><a href="{{url('pengalaman')}}"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Experience</a></li>
                <li><a href="{{url('pendidikan')}}"><i class="fa fa-university" aria-hidden="true"></i>Education</a></li>
                <li><a href="{{url('upload-file')}}"><i class="fa fa-paperclip "></i>Upload Additional File</a></li>
              </ul>
            </li>
            
             @if(in_array(Auth::user()->username, $app_timesheet))
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-address-card"></i>
                  <span>Timesheet</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('time-sheet')}}"><i class="fa fa-user"></i>Add Timesheet</a></li>
                  <li><a href="{{url('approval-timesheet')}}"><i class="fa fa-check-square-o" aria-hidden="true"></i>Timesheet Approval</a></li>
                </ul>
              </li>

            @else 
              <li class="">
                <a href="{{url('time-sheet')}}">
                  <i class="fa fa-clock-o"></i>Add Timesheet
                </a>
              </li>
            @endif
            
            <li class="treeview">
              <a href="{{ url('pengajuan-spd') }}">
                <i class="fa fa-file-text-o"></i><span>Add SPD Form</span>
              </a>
            </li>

            <li class="treeview">
              <a href="{{ url('spd-request') }}">
                <i class="fa fa-file-text-o"></i><span>SPD Request</span>
              </a>
            </li>
              
          <li class="treeview">
            <a href="{{ url('pengajuan-cuti') }}">
              <i class="fa fa-file-text-o"></i><span>Leave Form</span>
            </a>
          </li>
          
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('ganti-password-manager') }}/{{Auth::user()->id}}">
            <i class="fa fa-lock"></i> <span>Change Password</span>
          </a>
        </li>
       
      </ul>

    @elseif(Auth::user()->role_id == 4)
    <!--VP-->
       <ul class="sidebar-menu">
          <li class="header"><b>NAVIGATION MENU</b></li>
          <li class="treeview">
            <a href="{{ url('') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="treeview">
            <a href="{{ url('approvalVP') }}">
              <i class="fa fa-check-square-o"></i><span>Approval Request Barang</span>
              <span class="pull-right-container">
                <span class="label label-warning pull-right"><?php echo navigation::countRequestVP()?></span>
              </span>
            </a>
          </li>
          
         <li class="treeview">
            <a href="{{ url('po-vp') }}">
              <i class="fa fa-check-square-o"></i><span>Approval Purchase Order</span> 
              <span class="pull-right-container">
                <span class="label label-warning pull-right"><?php echo navigation::countPurchaseVP()?></span>
              </span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Human Capital</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-address-card"></i>
                  <span>My Profile</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('ubah-data-diri')}}/{{Auth::user()->username}}"><i class="fa fa-user"></i>Change Profile</a></li>
                  <li><a href="{{url('pengalaman')}}"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Experience</a></li>
                  <li><a href="{{url('pendidikan')}}"><i class="fa fa-university" aria-hidden="true"></i>Education</a></li>
                  <li><a href="{{url('upload-file')}}"><i class="fa fa-paperclip "></i>Upload Additional File</a></li>
                </ul>
              </li>
  
              @if(in_array(Auth::user()->username, $app_timesheet))
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-address-card"></i>
                    <span>Timesheet</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{url('time-sheet')}}"><i class="fa fa-user"></i>Add Timesheet</a></li>
                    <li><a href="{{url('approval-timesheet')}}"><i class="fa fa-check-square-o" aria-hidden="true"></i>Timesheet Approval</a></li>
                  </ul>
                </li>
  
              @else 
                <li class="">
                  <a href="{{url('time-sheet')}}">
                    <i class="fa fa-clock-o"></i>Add Timesheet
                  </a>
                </li>
              @endif
  
              <li class="treeview">
                <a href="{{ url('pengajuan-spd') }}">
                  <i class="fa fa-file-text-o"></i><span>Add SPD Form</span>
                </a>
              </li>

              <li class="treeview">
                <a href="{{ url('spd-request') }}">
                  <i class="fa fa-file-text-o"></i><span>SPD Request</span>
                </a>
              </li>
              
                
              <li class="treeview">
                <a href="{{ url('pengajuan-cuti') }}">
                  <i class="fa fa-file-text-o"></i><span>Leave Form</span>
                </a>
              </li>
          
            </ul>
          </li>
          <li class="treeview">
            <a href="{{ url('ganti-password-vp') }}/{{Auth::user()->id}}">
              <i class="fa fa-lock"></i> <span>Change Password</span>
            </a>
          </li>
        </ul>
        
    @elseif(Auth::user()->role_id==5)
    <!--{{-- Role CEO --}}-->
      <ul class="sidebar-menu">
        <li class="header"><b>NAVIGATION MENU</b></li>
        <li class="treeview">
          <a href="{{ url('') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('payment-ceo') }}">
            <i class="fa fa-check-square-o"></i><span>Approval Payment</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right"><?php echo navigation::countPaymentCEO()?></span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{url('approval-timesheet-ceo')}}">
              <i class="fa fa-check-square-o"></i><span>Approval Time Sheet</span>
            </a>
        </li>

        <li class="treeview">
          <a href="{{ url('spd-request') }}">
            <i class="fa fa-file-text-o"></i><span>SPD Request</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{ url('#') }}">
            <i class="fa fa-file-text-o"></i><span>Leave Request</span>
          </a>
        </li>
          
        <li class="treeview">
          <a href="{{ url('ganti-password-ceo') }}/{{Auth::user()->id}}">
            <i class="fa fa-lock"></i> <span>Change Password</span>
          </a>
        </li>

      </ul>

    @elseif(Auth::user()->role_id==8)
    <!--{{-- Role CO --}}-->
      <ul class="sidebar-menu">
        <li class="header"><b>NAVIGATION MENU</b></li>
        <li class="treeview">
          <a href="{{ url('') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('po') }}">
            <i class="fa fa-check-square-o"></i> <span>Approval Purchase Order</span>
              <span class="pull-right-container">
                <span class="label label-warning pull-right"><?php echo navigation::countPurchaseCO()?></span>
              </span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{ url('payment-co') }}">
            <i class="fa fa-check-square-o"></i><span>Approval Payment</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right"><?php echo navigation::countPaymentCO()?></span>
            </span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Human Capital</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-address-card"></i>
                <span>My Profile</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ubah-data-diri')}}/{{Auth::user()->username}}"><i class="fa fa-user"></i>Change Profile</a></li>
                <li><a href="{{url('pengalaman')}}"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Experience</a></li>
                <li><a href="{{url('pendidikan')}}"><i class="fa fa-university" aria-hidden="true"></i>Education</a></li>
                <li><a href="{{url('upload-file')}}"><i class="fa fa-paperclip "></i>Upload Additional File</a></li>
              </ul>
            </li>

            @if(in_array(Auth::user()->username, $app_timesheet))
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-address-card"></i>
                  <span>Timesheet</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('time-sheet')}}"><i class="fa fa-user"></i>Add Timesheet</a></li>
                  <li><a href="{{url('approval-timesheet')}}"><i class="fa fa-check-square-o" aria-hidden="true"></i>Timesheet Approval</a></li>
                </ul>
              </li>

            @else 
              <li class="">
                <a href="{{url('time-sheet')}}">
                  <i class="fa fa-clock-o"></i>Add Timesheet
                </a>
              </li>
            @endif

            <li class="treeview">
              <a href="{{ url('pengajuan-spd') }}">
                <i class="fa fa-file-text-o"></i><span>Add SPD Form</span>
              </a>
            </li>
            
              
          <li class="treeview">
            <a href="{{ url('pengajuan-cuti') }}">
              <i class="fa fa-file-text-o"></i><span>Leave Form</span>
            </a>
          </li>
          
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('ganti-password-co') }}/{{Auth::user()->id}}">
            <i class="fa fa-lock"></i> <span>Change Password</span>
          </a>
        </li>
      </ul>
      

    @elseif(Auth::user()->role_id == 9)
    <!--{{-- Role CFO --}}-->
      <ul class="sidebar-menu">
        <li class="header"><b>NAVIGATION MENU</b></li>
        <li class="treeview">
          <a href="{{ url('') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="{{ url('payment-cfo') }}">
            <i class="fa fa-check-square-o"></i><span>Approval Payment</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right"><?php echo navigation::countPaymentCFO()?></span>
            </span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Human Capital</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-address-card"></i>
                <span>My Profile</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ubah-data-diri')}}/{{Auth::user()->username}}"><i class="fa fa-user"></i>Change Profile</a></li>
                <li><a href="{{url('pengalaman')}}"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Experience</a></li>
                <li><a href="{{url('pendidikan')}}"><i class="fa fa-university" aria-hidden="true"></i>Education</a></li>
                <li><a href="{{url('upload-file')}}"><i class="fa fa-paperclip "></i>Upload Additional File</a></li>
              </ul>
            </li>

            @if(in_array(Auth::user()->username, $app_timesheet))
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-address-card"></i>
                  <span>Timesheet</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('time-sheet')}}"><i class="fa fa-user"></i>Add Timesheet</a></li>
                  <li><a href="{{url('approval-timesheet')}}"><i class="fa fa-check-square-o" aria-hidden="true"></i>Timesheet Approval</a></li>
                </ul>
              </li>

            @else 
              <li class="">
                <a href="{{url('time-sheet')}}">
                  <i class="fa fa-clock-o"></i>Add Timesheet
                </a>
              </li>
            @endif

            <li class="treeview">
              <a href="{{ url('pengajuan-spd') }}">
                <i class="fa fa-file-text-o"></i><span>Add SPD Form</span>
              </a>
            </li>
            
              
          <li class="treeview">
            <a href="{{ url('pengajuan-cuti') }}">
              <i class="fa fa-file-text-o"></i><span>Leave Form</span>
            </a>
          </li>
          
          </ul>
        </li>
        
        <li class="treeview">
          <a href="{{ url('ganti-password-cfo') }}/{{Auth::user()->id}}">
            <i class="fa fa-lock"></i> <span>Change Password</span>
          </a>
        </li>

      </ul>

      @elseif(Auth::user()->role_id == 10)
      <!--{{-- Role Finance --}}-->
        <ul class="sidebar-menu">
          <li class="header"><b>NAVIGATION MENU</b></li>
          <li class="treeview">
            <a href="{{ url('') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="treeview">
            <a href="{{url('list-invoice')}}">
                <i class="fa fa-check-square-o"></i><span>Upload Invoice</span>
                <span class="pull-right-container">
                  <span class="label label-warning pull-right"><?php echo navigation::countListInvoice()?></span>
                </span>
              </a>
          </li>

          <li class="treeview">
            <a href="{{url('ubah-status-paid')}}">
                <i class="fa fa-check-square-o"></i> <span>Change Payment Status</span>
                <span class="pull-right-container">
                  <span class="label label-warning pull-right"><?php echo navigation::countListPayment()?></span>
                </span>
              </a>
          </li>
          <li class="treeview">
            <a href="{{ url('ganti-password-finance') }}/{{Auth::user()->id}}">
              <i class="fa fa-lock"></i> <span>Change Password</span>
            </a>
          </li>

        </ul>

        @elseif(Auth::user()->role_id == 11)
        <!--{{-- Role Asset Management --}}-->
          <ul class="sidebar-menu">
            <li class="header"><b>NAVIGATION MENU</b></li>
            <li class="treeview">
              <a href="{{ url('') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
        
            <li class="treeview">
              <a href="{{url('list-approval-barang-keluar')}}">
                  <i class="fa fa-check-square-o"></i><span>Approval Outgoing Item</span>
                  <span class="pull-right-container">
                    <span class="label label-warning pull-right"><?php echo navigation::countBarangKeluar()?></span>
                  </span>
                </a>
            </li>
            <!-- <li class="treeview">-->
            <!--  <a href="{{url('list-asset')}}">-->
            <!--    <i class="fa fa-list-alt" aria-hidden="true"></i>List Asset-->
            <!--    </a>-->
            <!--</li>-->
            
            <li class="treeview">
              <a href="{{url('list-asset')}}">
                <i class="fa fa-list-alt" aria-hidden="true"></i><span>Asset List</span>
                </a>
            </li>
            
            <li class="treeview">
              <a href="{{ url('ganti-password-assetmanagement') }}/{{Auth::user()->id}}">
                <i class="fa fa-lock"></i> <span>Change Password</span>
              </a>
            </li>
  
          </ul>
          
          @else
          <!--Role HR-->
            <ul class="sidebar-menu">
              <li class="header"><b>NAVIGATION MENU</b></li>
              <li class="treeview">
                <a href="{{ url('') }}">
                  <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
              </li>
              <li class="treeview">
                <a href="{{ url('karyawan') }}">
                  <i class="fa fa-edit"></i> <span>Employee Data</span>
                </a>
              </li>
              <li class="treeview">
                <a href="{{ url('history-spd') }}">
                  <i class="fa fa-file"></i> <span>SPD History</span>
                </a>
              </li>
              
                <li class="treeview">
                    <a href="{{ url('histori-cuti') }}">
                      <i class="fa fa-history"></i> <span>Leave History</span>
                    </a>
                </li>
              
              <!--GET YEAR NOW-->
              <?php $year_now = date("Y"); ?>
              <?php $next_year = date('Y', strtotime('+1 year'));?>

              @if($year_now == $next_year)
                <li class="treeview">
                  <a href="#" onclick="alert('Sorry you cant use this feature because the year has not changed. Thankyou :)');">
                    <i class="fa fa-refresh" aria-hidden="true"></i> <span>Reset All Employee Leave</span>
                  </a>
                </li>
              @else 
                <li class="treeview">
                  <a href="{{ url('reset-cuti') }}">
                    <i class="fa fa-refresh" aria-hidden="true"></i> <span>Reset Leave All Employee</span>
                  </a>
                </li>
              @endif
              
               <li class="treeview">
                <a href="{{ url('list-talent-pool') }}">
                  <i class="fa fa-users"></i> <span>Talent Pool</span>
                </a>
              </li>
              <li class="treeview">
                <a href="{{ url('posisi-kerja') }}">
                  <i class="fa fa-briefcase"></i> <span>Master Job Position</span>
                </a>
              </li>
              
               <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i> <span>Psikotes</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{url('kandidat-psikotes')}}"><i class="fa fa-user"></i> User
                    </a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-check-circle-o"></i> Papikostick
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-edit"></i>Master Data
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{url('kategori-papikostik')}}"><i class="fa fa-minus fa-sm"></i>Category</a></li>
                        <li><a href="{{url('statement-papikostik')}}"><i class="fa fa-minus fa-sm"></i>Statement</a></li>
                        <li><a href="{{url('kamus-papikostik')}}"><i class="fa fa-minus fa-sm"></i>Dictionary</a></li>
                      </ul>
                      </li>
                      <li><a href="{{url('report-papikostik')}}"><i class="fa fa-bar-chart"></i>Report</a></li>
                    </ul>
                  </li>

                  <li>
                    <a href="#"><i class="fa fa-check-circle-o"></i> DISC
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-edit"></i>Master Data
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{url('kategori-disc')}}"><i class="fa fa-minus fa-sm"></i>Category</a></li>
                        <li><a href="{{url('statement-disc')}}"><i class="fa fa-minus fa-sm"></i>Statement</a></li>
                      </ul>
                      </li>
                      <li><a href="{{url('report-disc')}}"><i class="fa fa-bar-chart"></i>Report</a></li>
                    </ul>
                  </li>

                  <li>
                    <a href="#"><i class="fa fa-check-circle-o"></i> MSDT
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-edit"></i>Master Data
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{url('kategori-msdt')}}"><i class="fa fa-minus fa-sm"></i>Category</a></li>
                        <li><a href="{{url('statement-msdt')}}"><i class="fa fa-minus fa-sm"></i>Statement</a></li>
                      </ul>
                      </li>
                      <li><a href="{{url('report-msdt')}}"><i class="fa fa-bar-chart"></i>Report</a></li>
                    </ul>
                  </li>

                  <li>
                    <a href="#"><i class="fa fa-check-circle-o"></i> MBTI
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-edit"></i>Master Data
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{url('kategori-mbti')}}"><i class="fa fa-minus fa-sm"></i>Category</a></li>
                        <li><a href="{{url('statement-mbti')}}"><i class="fa fa-minus fa-sm"></i>Statement</a></li>
                      </ul>
                      </li>
                      <li><a href="{{url('report-mbti')}}"><i class="fa fa-bar-chart"></i>Report</a></li>
                    </ul>
                  </li>

                </ul>
              </li>
              
            </ul>
      
    @endif

  </section>
  <!-- /.sidebar -->
</aside>
@endif 