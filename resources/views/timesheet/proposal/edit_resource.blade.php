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
                    <h3 class="box-title fonts"><b>Edit Resource Proposal</b></h3>
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
                        <form role="form" name="formdata" method="post" action="{{route('update-resource-proposal', $res->id)}}">
                            @method('PATCH') 
                            @csrf
                                <div class="form-group">
                                    <label>Nama Proposal</label>
                                    <input type="text" class="form-control" value="{{$res->nama}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Lokasi Project</label>
                                    <input type="text" class="form-control" value="{{$res->lokasi_id}}" readonly>
                                </div>
                           
                                <div class="form-group">
                                    <label>Kebutuhan Resource</label>
                                    <select id="resource_id" name="resource_id[]" class="form-control select2" multiple>
                                        <?php  $datas = Proposal::where('id',$res->id)->first();
                                                $rp = explode(",", $datas->resource_id);
                                                $dts = Resource::whereIn('id', $rp)->pluck('id');
                                        ?>
                                     @foreach($resources as $r)
                                        @if(in_array($r->id, json_decode($dts)))
                                            @foreach ($dt as $item)
                                                @if($r->id == $item->id)
                                                    <option {{$r->id == $item->id ? 'selected' : ''}} value="{{$r->id}}">{{$r->nama_posisi}}</option>
                                                @else
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{$r->id}}">{{$r->nama_posisi}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{url("time-sheet-proposal")}}" class="btn btn-danger">Batal</a>
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
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.11/plugins/select2/select2.min.css') }}">
    <script src="{{asset('AdminLTE-2.3.11/plugins/select2/select2.full.min.js')}}"></script>

    <script type="text/javascript" >
    $('.select2').select2();
    
    </script>
    @endpush

