@extends('templates.header')
@section('content')
<section class="content"> 
<div class="row">
        <div class="col-xs-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Tambah Project</b></h3>
            </div>
            <br>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-12 col-lg-12">
                    <form role="form" name="formdata" method="post" action="{{url("timesheet-project/store")}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_project">Nama Project</label>
                        <input type="text" class="form-control" id="nama_project" name="nama_project" placeholder="Masukkan Nama Project" required>
                    </div>

                    <div class="form-group">
                      <label for="lokasi">Kode Project</label>
                      <input type="text" class="form-control" id="code_loc" name="code_loc" placeholder="Masukkan Kode Project" required>
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi Project</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi Project" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control select2" multiple id="resource_id" name="resource_id[]" data-placeholder="Pilih Role" style="width: 100%;">
                            @foreach($resource as $r )
                                <option value="{{ $r->id }}">{{ $r->nama_posisi}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{url("timesheet-project")}}" class="btn btn-danger">Batal</a>
                        
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

