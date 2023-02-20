@extends('templates.header')
@section('content')
<section class="content"> 
<div class="row">
        <div class="col-xs-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Tambah Proposal</b></h3>
            </div>
            <br>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-12 col-lg-12">
                    <form role="form" name="formdata" method="post" action="{{url("time-sheet-proposal/store")}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_proposal">Nama Proposal</label>
                        <input type="text" class="form-control" id="nama_proposal" name="nama_proposal" placeholder="Masukkan Nama Proposal" required>
                    </div>
                 
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                       <input type="text" class="form-control" id="lokasi_id" name="lokasi_id" placeholder="Masukkan Lokasi" required>
                       
                        {{-- <select name="lokasi_id" type="text" class="form-control select2" id="lokasi_id" style="width: 100%;" required>  
                          <option selected disabled>-- Pilih Lokasi --</option>
                            @foreach($lokasi_proyek as $lp )
                                <option value="{{ $lp->id }}">{{$lp->nama}} &nbsp; ({{ $lp->lokasi}})</option>
                            @endforeach
                        </select> --}}
                    </div>

                    <div class="form-group">
                        <label>Kebutuhan Resource</label>
                        <select class="form-control select2" multiple id="resource_id" name="resource_id[]" data-placeholder="-- Pilih Resource --" style="width: 100%;">
                            @foreach($resource as $r )
                                <option value="{{ $r->id }}">{{ $r->nama_posisi}}</option>
                            @endforeach
                        </select>
                      </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{url("time-sheet-proposal")}}" class="btn btn-danger">Batal</a>
                        
                </div>
                <!-- end off bilah tengah -->
                {{-- <div class="col-xs-4">
                    

                  
            </div> --}}
                  
                <!-- end of footer button -->
            {{-- </form> --}}
        </form>
              <!-- end of form karyawan -->
            </div>
          </div>
        </div>
      </div>
      </div>
      </section>
     
    @endsection
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.11/plugins/select2/select2.min.css') }}">
    <script src="{{asset('AdminLTE-2.3.11/plugins/select2/select2.full.min.js')}}"></script>

    <script type="text/javascript" >
    $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: false,
        });
    $('.select2').select2();
    
    // function showfield(name){
    //     if(name=='Other')
    //         document.getElementById('div1').innerHTML='<br> Lokasi Lainnya: <input type="text" name="lokasi_id" class="form-control" id="lokasi_id" placeholder="Masukkan Lokasi" required/>';
    //     else 
    //         document.getElementById('div1').innerHTML='';
    // }

    </script>
    @endpush

