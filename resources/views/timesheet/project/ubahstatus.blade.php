<?php
    use App\Resource;
?>

@extends('templates.header')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-xl-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b>Ubah Status Approval Timesheet</b></h3>
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
                        <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{route('update-status-timesheet-project', $approve->id)}}">
                            @method('PATCH') 
                            @csrf
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-xl-6">
                                <div class="form-group">
                                    <label>Tanggal Kerja</label>
                                    <input type="text" class="form-control" name="tanggal_kerja" id="tanggal_kerja" value="{{ date('d-M-Y', strtotime($approve->tanggal_kerja)) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Karyawan</label>
                                    <input type="text" class="form-control" value="{{$approve->getNama->nama}}" readonly>
                                    <input type="hidden" id="project_id" name="project_id" class="form-control" value="{{$approve->project_id}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                        @foreach(Resource::whereIn('id', explode(',',$approve->resource_id))->get() as $item)
                                            <input type="text" class="form-control" value="{{$item->nama_posisi}}" readonly>
                                        @endforeach
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Pekerjaan</label>
                                    <?php $replace = array('<p>','</p>'); ?>
                                    <textarea class="form-control" readonly>{{str_replace($replace, '' , ($approve->desc_for_project))}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 col-xl-6">
                                <input type="hidden" id="resource_id" name="resource_id" class="form-control" value="{{$approve->resource_id}}" readonly>

                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="text" class="form-control" value="{{ date('H:i', strtotime($approve->start_time)) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="text" class="form-control" value="{{ date('H:i', strtotime($approve->end_time)) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Total Jam</label>
                                    <input type="text" class="form-control" value="{{$approve->man_hours}} jam" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Ubah Status Persetujuan</label>
                                    <select name="status" type="text" class="form-control" id="status" style="width: 100%;" required>
                                        <option selected disabled>--Pilih--</option>
                                        <option value="1"> DISETUJUI </option>
                                        <option value="2"> DITOLAK </option>
                                    </select>
                                    <span id="status" class="help-block"> {{ $errors->first('status') }} </span>
                                </div>
                                <div class="form-group" id="inputKomentar">
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                  <a href="{{url("detail-timesheet-project")}}/{{$approve->project_id}}" class="btn btn-danger">Batal</a>
                        
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
        <script type="text/javascript">
            document.getElementById("status").onchange = function() {
                document.querySelector("#inputKomentar").innerHTML = '';
                if(document.getElementById("status").value == 2){ 
                    var input = document.createElement("TEXTAREA");
                    input.name = 'komentar';
                    input.required = true;
                    input.className = 'form-control';
                    input.placeholder = 'Tambahkan Keterangan';
                    input.maxLength = "1000";
                    input.cols = "80";
                    input.rows = "5";      
                    document.getElementById("inputKomentar").append(input);
    
                }
            }
        </script>
    @endpush

