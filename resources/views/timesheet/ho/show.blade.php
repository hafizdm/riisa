<?php
use App\Employee;
?>
@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
      <b> Report Persentase Kerja Karyawan (%)</b>
    </span>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('persentase-timesheet')}}">Persentase kerja</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-5">
            <div class="box box-default">
                <div class="box-header with-border" style="background-color: #80808038;">
                    <h3 class="box-title" style="font-size:16px;">Filter Data</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-up"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                
                <form role="form" name="formdata" method="post" action="{{url('filters')}}/{{$get_id}}">
                    {{csrf_field()}}
                    <div class="box-body">
                        @if(session()->get('success'))
                            <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                        @elseif(session()->get('failed'))
                            <div class="alert alert-danger alert-dismissible fade in"> 
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <h4><i class="icon fa fa-ban"></i> Gagal !</h4>
                            {{ session()->get('failed') }}
                            </div>
                        @endif
                        <div class = "form-group">
                            <label for="jenis_record" class="col-sm-4 control-label"></label>
                            <select class="form-control" name="jenis_record" id="jenis_record" onchange="showfield(this.options[this.selectedIndex].value)" >
                                <option selected disabled> Pilih Jangka Waktu</option>
                                <option value = "perbulan">Per 1 bulan</option>
                                <option value = "per3bulan">Per 3 bulan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div id="div1" style="display: none;">
                                <select class="form-control select2" name="year" id="year">
                                    <?php
                                        $thn_skr = date('Y');
                                    for ($year = $thn_skr; $year <= 2025; $year++) {
                                        ?>
                                            <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="div2" style="display: none;">
                                <select class="form-control select2" name="month" id="month" style="width: 100%;">
                                    <?php
                                        for($i = 0 ; $i <= 11;$i++){
                                            $months = date('F',strtotime("first day of -$i month"));
                                            $bulan = date('m',strtotime("first day of -$i month"));
                                            echo "<option value=$bulan>$months</option> ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="div3" style="display: none;">
                                <select class="form-control" name="pertigabulan" id="pertigabulan">
                                    <option selected disabled> Pilih quadran</option>
                                    <option value = "q1">(Q1) Januari - Maret</option>
                                    <option value = "q2">(Q2) April - Juni</option>
                                    <option value = "q3">(Q3) Juli - September</option>
                                    <option value = "q4">(Q4) Oktober - Desember</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                
                <div class="box-footer">
                    <a href="{{url('all-timesheet')}}/{{$get_id}}" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a>
                    <button type="submit" class="btn btn-default" ><span class="fa fa-filter"></span> Filter</button>
                </div>
                <!-- /.box-body -->
            </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
    
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <h5 style="font-size: 15px"><b>{{$nama_bulan}}</b></h5>
            
            {{-- sub menu  --}}
           
            {{-- end of sub menu  --}}

            {{-- table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead style="background-color: #8080807a;">
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Persentase HO (%)</th>
                            <th>Persentase Proposal (%)</th>
                            <th>Persentase Project (%)</th>
                        </tr>
                    </thead>
                   <tbody>
                    
                    <tr>
                            <?php 
                                $names = Employee::where('nik', $get_id)->get();
                            ?>
                            @foreach ($names as $item)
                            <td>{{$item->nik}} / {{$item->nama}}</td>
                            @endforeach
                           
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar progress-bar-danger" style="width: {{$HO_format}}%"></div>
                                </div>
                                <span class="badge bg-red">{{$HO_format}} %</span>
                                {{-- <center><span class="badge bg-red">{{$HO_format}} %</span></center> --}}
                            </td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar progress-bar-primary" style="width: {{$Proposal_format}}%"></div>
                                </div>
                                <span class="badge bg-blue">{{$Proposal_format}} %</span>
                                {{-- <center><span class="badge bg-yellow">{{$Proposal_format}}%</span></center> --}}
                            </td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar progress-bar-success" style="width: {{$Project_format}}%"></div>
                                </div>
                                <span class="badge bg-green">{{$Project_format}} %</span>
                                {{-- <center><span class="badge bg-green">{{$Project_format}}%</span></center> --}}
                            </td>
                        
                    </tr>
                    
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

<!-- end of modal konfirmasi -->
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    

    // var year;
    // var thn_skr = date("Y");
function showfield(name){
    if(name == "perbulan" ){
        document.getElementById("div1").style.display = "block";
        document.getElementById("div2").style.display = "block";
        document.getElementById("div3").style.display = "none";
    }
    else{
        document.getElementById("div1").style.display = "none";
        document.getElementById("div2").style.display = "none";
        document.getElementById("div1").style.display = "block";
        document.getElementById("div3").style.display = "block";
    }
}

               
</script>
@endpush


