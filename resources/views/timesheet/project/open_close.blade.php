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
                    <h3 class="box-title fonts"><b>Ubah Status Project</b></h3>
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
                        <form role="form" name="formdata" method="post" action="{{route('update-open-close-project', $open_close->id)}}">
                            @method('PATCH') 
                            @csrf
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-xl-6">
                                <div class="form-group">
                                    <label>Nama Proposal</label>
                                    <input type="text" class="form-control" value="{{ $open_close->nama}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" class="form-control" value="{{$open_close->getLoc_Project->lokasi}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Kebutuhan Resource</label>
                                    <textarea class="form-control" rows="5" disabled="">
                                        @foreach(Resource::whereIn('id', explode(',',$open_close->resource_id))->get() as $item)     
                                            {{$loop->iteration}} .&nbsp; {{$item->nama_posisi}}
                                        @endforeach
                                    </textarea>
                                </div>

                            </div>

                            <div class="col-lg-6 col-xs-12 col-xl-6">
                                <div class="form-group">
                                    <label>Tanggal Disetujui</label>
                                    <input type="text" class="form-control" value="{{ date('d M Y', strtotime($open_close->tgl_approved)) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Total Man Hours</label>
                                    <input type="text" class="form-control" value="{{$open_close->man_hours}} jam" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Status Proposal</label>
                                    <input type="text" class="form-control" value="{{$open_close->status == 1 && $open_close->status != 2 ? "AKTIF (OPEN)" : "TIDAK AKTIF (CLOSE)" }}" readonly>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label>Ubah Status </label>
                                    @if($open_close->status == 1)
                                        <select name="status" type="text" class="form-control" id="status" style="width: 100%;" required>
                                            <option selected disabled>--Pilih--</option>
                                            <option value="3"> TIDAK AKTIF (CLOSE)</option>
                                        </select>
                                    @elseif($open_close->status == 3)
                                        <select name="status" type="text" class="form-control" id="status" style="width: 100%;" required>
                                            <option selected disabled>--Pilih--</option>
                                            <option value="1"> AKTIF (OPEN) </option>
                                        </select>
                                    @endif
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                  <a href="{{url("timesheet-project")}}" class="btn btn-danger">Batal</a>
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

