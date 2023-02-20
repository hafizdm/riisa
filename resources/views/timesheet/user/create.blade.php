<?php
use Carbon\Carbon as Carbon;
use App\Resource;
use App\TimeSheetUser;
use Illuminate\Support\Facades\DB;
?>

@extends('templates.header')
@section('content')
<section class="content"> 
<div class="row">
        <div class="col-xs-12 col-xl-8 col-lg-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Timesheet Management</b></h3>
            </div>
            <br>
            <div class="box-body">
              <div id="notif" ></div>

            <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{url("time-sheet/store")}}">
            @csrf
            <div class="row">
              <div class="col-xs-12 col-xl-10 col-lg-10">
                  <input type="hidden" id="divisi_id" name="divisi_id" value="{{$karyawan->divisi_id}}">
                  <div class="form-group">
                    <label for="jenis_barang">Scope of Work</label>
                    {{-- <select name="cost_account_id" type="text" class="form-control select2" id="cost_account_id"  style="width: 100%;" onchange="showfield(this.options[this.selectedIndex].value)" required> --}}
                      <select name="cost_account_id" type="text" class="form-control select2" id="cost_account_id"  style="width: 100%;" required>
                        <option selected disabled>-- Pilih Scope of Work --</option>
                        @foreach($cost_account as $ca)
                            <option value="{{ $ca->id }}">{{ $ca->nama }}</option>
                        @endforeach
                    </select>
                    {{-- <span class="help-block" >{{ $errors->first('cost_account_id') }} </span> --}}
                </div>
                {{-- <div id="div1"></div>
                <div id="div2"></div> --}}
              </div>
            </div>
            
            <div class="row">
              <div class="col-xs-12 col-xl-10 col-lg-10">
                  <div class="form-group">
                    <label for="jenis_barang">Detail of Work</label>
                    <textarea class="form-control my-editor" placeholder="Enter detail of work" name="detail_of_work" id="detail_of_work"></textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-xl-10 col-lg-10">
                  <div class="form-group">
                    <label for="jenis_barang">Date of Work</label>
                    <div class="input-group date pickWeek">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    <input type="text" class="form-control" id="tanggal_kerja" name="tanggal_kerja" readonly value="{{ date("Y-m-d", strtotime(Carbon::now())) }}"/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                  <div class="col-xs-12 col-xl-5 col-lg-5">
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <select name="start_time" type="text" class="form-control select2" id="start_time"  style="width: 100%;" required>
                            <option selected disabled>-- Select start time --</option>
                            @foreach($timework as $tw)
                                <option value="{{ $tw->start_time }}">{{ date('H:i', strtotime($tw->start_time)) }} </option>
                            @endforeach
                        </select>
                        <span class="help-block" >{{ $errors->first('start_time') }} </span>
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-5 col-lg-5">
                    <div class="form-group">
                      <label for="end_time">End Time</label>
                      <select name="end_time" type="text" class="form-control select2" id="end_time"  style="width: 100%;" required>
                          <option selected disabled>-- Select end time --</option>
                          @foreach($timework as $tw)
                              <option value="{{ $tw->end_time }}"> {{ date('H:i', strtotime($tw->end_time)) }} </option>
                          @endforeach
                      </select>
                      <span class="help-block" >{{ $errors->first('end_time') }} </span>
                  </div>
                </div>

            </div>
            <div class="row">
              <div class="col-xs-12 col-xl-12 col-lg-12">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url("time-sheet")}}" class="btn btn-danger">Cancel</a> 
              </div>
            </div>
            </form>

          </div>
        </div>
      </div>
      </div>
      </section>
     
    @endsection
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="{{ asset('AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    {{-- <script src="https://cdn.tiny.cloud/1/j1ivozfjaqqnyz4pafn8n5mj5cij6xhty9nnn4vvbdms3v1f/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="{{asset('js/tinymce.min.js')}}" referrerpolicy="origin"></script>
    <script type="text/javascript" >
    // function reset(){
    //     $('.select2').val(null).trigger('change');
    // }
    $('.select2').select2();
    $(".timepicker").timepicker({
      showInputs: false,
      showMeridian: false
    });
    var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      entity_encoding : "raw",
      plugins: [
      "advlist lists",
      ],
      toolbar: "bold italic | alignleft alignjustify | bullist numlist | outdent indent",
      relative_urls: false,
      menubar:false,

      };

    tinymce.init(editor_config);

    $(function () {        
      $('.pickWeek').datepicker({
          locale: 'pt-br',
          format: "yyyy-mm-dd",
          autoclose: true,
          sideBySide: true,
          // daysOfWeekDisabled: [0,7],
          todayBtn: "linked",
          todayHighlight : true,
          // multidate:true,
          // startDate:moment().startOf('week').toDate(),
          // endDate:moment().endOf('week').toDate()
      });
      $('.select2').select2();
    });
  
    </script>
    @endpush

