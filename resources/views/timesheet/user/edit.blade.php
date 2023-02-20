<?php
    use App\Resource;
    use App\Proposal;
?>
@extends('templates.header')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-xl-8 col-lg-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b>Edit Timesheet</b></h3>
                </div>
                <br>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-xl-12">
                            @if(session()->get('success'))
                                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif
                        </div>    
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-xl-12">
                        <form role="form" name="formdata" method="post" action="{{route('update-timesheet', $edit_timesheet->id)}}">
                            @method('PATCH') 
                            @csrf
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-xl-12">
                               
                                    <div class="form-group">
                                        <label>Date of Work</label>
                                        <input type="text" class="form-control" value="{{ $edit_timesheet->tanggal_kerja}}" id="tanggal_kerja" name="tanggal_kerja" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Scope of Work</label>
                                        <input type="text" class="form-control" value="{{$edit_timesheet->getCostAccount->nama}}" readonly>
                                        <input type="hidden" class="form-control" id="cost_account_id" name="cost_account_id" value="{{ $edit_timesheet->cost_account_id}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Detail of Work</label>
                                        @if($edit_timesheet->desc_of_project)
                                            <textarea class="form-control my-editor" id="detail_of_work" name="detail_of_work">{{$edit_timesheet->desc_of_project}}</textarea>
                                        @elseif($edit_timesheet->desc_of_proposal)
                                            <textarea class="form-control my-editor" id="detail_of_work" name="detail_of_work">{{$edit_timesheet->desc_of_proposal}}</textarea>
                                        @elseif($edit_timesheet->desc_of_ho)
                                            <textarea class="form-control my-editor" id="detail_of_work" name="detail_of_work">{{$edit_timesheet->desc_of_ho}}</textarea>
                                        @else
                                            <textarea class="form-control my-editor" id="detail_of_work" name="detail_of_work">{{$edit_timesheet->detail_of_work}}</textarea>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <div class="input-group">
                                        <input type="text" class="form-control timepicker"  id="start_time" name="start_time" value="{{ $edit_timesheet->start_time != '' ? date('H:i', strtotime($edit_timesheet->start_time)) : ''}}" readonly>
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>End Time</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" id="end_time" name="end_time" value="{{ $edit_timesheet->end_time != '' ? date('H:i', strtotime($edit_timesheet->end_time)) : ''}}" readonly>
                                            <div class="input-group-addon">
                                              <i class="fa fa-clock-o"></i>
                                            </div>
                                          </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{url("time-sheet")}}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    @endsection
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
        <script src="{{ asset('AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.css')}}">
        <script src="{{asset('js/tinymce.min.js')}}" referrerpolicy="origin"></script>
        <script type="text/javascript">
            $('.select2').select2()

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
            
        </script>
    @endpush
    
