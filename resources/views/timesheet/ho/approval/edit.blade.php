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
                        <form role="form" name="formdata" method="post" action="{{route('update-status-timesheet-ho', $approve->id)}}">
                            @method('PATCH') 
                            @csrf
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-xl-6">
                                <div class="form-group">
                                    <label>Nama Karyawan</label>
                                    <input type="text" class="form-control" value="{{$approve->getNama->nama}}" readonly>
                                    <input type="hidden" id="proposal_id" name="proposal_id" class="form-control" value="{{$approve->proposal_id}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <input type="text" class="form-control" value="{{$approve->getDiv->nama}}" readonly>
                                    {{-- <input type="hidden" id="proposal_id" name="proposal_id" class="form-control" value="{{$approve->proposal_id}}" readonly> --}}
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kerja</label>
                                    <input type="text" class="form-control" value="{{ date('l, d-M-Y', strtotime($approve->tanggal_kerja)) }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="text" class="form-control" value="{{ date('H:i', strtotime($approve->start_time)) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="text" class="form-control" value="{{ date('H:i', strtotime($approve->end_time)) }}" readonly>
                                </div>
                                </div>
                                <div class="col-lg-6 col-xs-12 col-xl-6">
                                <div class="form-group">
                                    <label>Total Jam Kerja</label>
                                    <input type="text" class="form-control" value="{{$approve->man_hours}} jam" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Pekerjaan</label>
                                    <input type="text" class="form-control" value="{{$approve->workingType->nama}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Ubah Status Persetujuan</label>
                                    <select name="status" type="text" class="form-control" id="status" style="width: 100%;" required>
                                        <option selected disabled>--Pilih--</option>
                                        <option value="1"> DISETUJUI </option>
                                        <option value="2"> DITOLAK </option>
                                    </select>
                                    <span class="help-block" >{{ $errors->first('status') }} </span>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                  <a href="{{url("persentase-timesheet")}}" class="btn btn-danger">Batal</a>
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

