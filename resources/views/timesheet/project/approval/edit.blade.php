<?php
    use App\Resource;
?>
@extends('templates.header')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-xl-10 col-lg-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title fonts"><b>Approval Project</b></h3>
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
                        <form role="form" name="formdata" method="post" action="{{route('update-approval-project', $ubah_status->id)}}">
                            @method('PATCH') 
                            @csrf
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-xl-12">
                                <div class="form-group">
                                    <label>Nama Project</label>
                                    <input type="text" class="form-control" value="{{ $ubah_status->nama}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" class="form-control" value="{{$ubah_status->getLoc_Project->lokasi}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Kebutuhan Resource</label>
                                    <textarea class="form-control" rows="10" disabled="">
                                        @foreach(Resource::whereIn('id', explode(',',$ubah_status->resource_id))->get() as $item)     
                                            {{$loop->iteration}} .&nbsp; {{$item->nama_posisi}}
                                        @endforeach
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Pengajuan</label>
                                    <input type="text" class="form-control" value="{{ date('d M Y', strtotime($ubah_status->created_at)) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Ubah Status Persetujuan</label>
                                    <select name="status_approved" type="text" class="form-control" id="status_approved" style="width: 100%;" required>
                                        <option selected disabled>Pilih</option>
                                        <option value="1"> DISETUJUI </option>
                                        <option value="2"> DITOLAK </option>
                                    </select>
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{url("approval-timesheet-ceo")}}" class="btn btn-danger">Batal</a>
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

