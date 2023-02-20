@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
      <b>Upload Additional Files</b>
    </span>
    <!--<ol class="breadcrumb">-->
    <!--  <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
    <!--  <li class="active"><a href="{{url('upload-file')}}"> Upload File Pendukung</a></li>-->
    <!--</ol>-->
</section>

<!-- Main content -->
<section class="content">
    {{-- <div class="row">
        <div class="col-lg-6">
            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
             @elseif(session()->get('failed'))
                <div class="alert alert-danger alert-dismissible fade in"> 
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4><i class="icon fa fa-ban"></i> Failed !</h4>
                  {{ session()->get('failed') }}
                </div>
            @endif
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-10">
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <i class="fa fa-paperclip"></i>
                <h3 class="box-title">CV/Resume</h3>
                <div class="box-tools pull-right">
                    @foreach($upload_file as $p)
                        @if($p->file_cv == '')
                            <a href="{{url('upload-cv/create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
                        @else
                            <a href="{{route('edit-cv',$p->nik)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                        @endif
                    @endforeach   
                    &nbsp;  
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="embed-responsive embed-responsive-16by9">
                    @if($p->file_cv != '')
                        <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$p->nik.'/'.'CV'.'/'.$p->file_cv)}}" width="100%" height="100%">
                        </iframe>
                    @else
                        <iframe class="embed-responsive-item" width="100%" height="100%">
                        </iframe>
                    @endif
                  </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <i class="fa fa-paperclip"></i>
                <h3 class="box-title">Certificate <small>(Last Diploma)</small></h3>
                <div class="box-tools pull-right">
                    
                    @foreach($upload_file as $p)
                        @if($p->file_ijazah == '')
                            <a href="{{url('upload-ijazah/create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
                        @else
                            <a href="{{route('edit-ijazah',$p->nik)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                        @endif
                    @endforeach   
                    &nbsp;   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                </div>
            </div>
            <div class="box-body">
                
                    @if($p->file_ijazah != '')
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$p->nik.'/'.'Ijazah/'.$p->file_ijazah)}}" width="100%" height="100%">
                            </iframe>
                        </div>
                    @else
                       <span>No uploaded file</span>
                    @endif
                  
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <i class="fa fa-paperclip"></i>
                <h3 class="box-title">Additional File</h3>
                <div class="box-tools pull-right">
                    <a href="{{url('upload-sertifikat/create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
                    &nbsp;  
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                </div>
            </div>
            <div class="box-body">
                @foreach($sertifikat as $s)
                    <div class="row">
                        <div class="col-md-12">
                        <div class="box box-solid collapsed-box">
                            <div class="box-header with-border">
                                <i class="fa fa-file"></i>
                                <h3 class="box-title" style="font-size: 16px;">Certificate &nbsp;{{$loop->iteration}}</h3>
                                <div class="box-tools pull-right">
                                    <button class='btn btn-xs btn-danger delete' data-token="{{ csrf_token() }}" data-id="{{$s->id}}"><i class="fa fa-trash"></i></button>   
                                    &nbsp;  
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                
                                    @if($s->file_sertifikat != '')
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$s->id_karyawan.'/'.'Sertifikat'.'/'.$s->file_sertifikat)}}" width="100%" height="100%">
                                            </iframe>
                                        </div>
                                    @else
                                        <span>No uploaded file</span>
                                    @endif
                                
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <i class="fa fa-line-chart" aria-hidden="true"></i>
                <h3 class="box-title">Performance Appraisal</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                </div>
            </div>
            <div class="box-body">
                @foreach($performances as $s)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-solid collapsed-box">
                                    <div class="box-header with-border">
                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                        <h3 class="box-title" style="font-size: 16px;">Performance &nbsp;{{$loop->iteration}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-eye"></i></button>
    
                                    </div>
                                </div>
                                <div class="box-body">
                                        @if($s->file_performance != '')
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{url('uploads/Karyawan/'.$s->id_karyawan.'/'.'Performance'.'/'.$s->file_performance)}}" width="100%" height="100%">
                                            </iframe>
                                         </div>
                                        @else
                                           <span>No uploaded file</span>
                                        @endif
                                   
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
            </div>

        </div>
        </div>
    </div>
    
        {{-- Upload Sertifikat Vaksin --}}
    <div class="row">
        <div class="col-md-10">
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <i class="fa fa-paperclip"></i>
                <h3 class="box-title">Vaccine Certificate</h3>
                <div class="box-tools pull-right">
                    @if($count_vaksin <= 1)
                        <a href="{{url('upload-vaksinasi/create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
                    @else
                       
                    @endif
                    &nbsp;  
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-angle-down"></i></button>
                </div>
            </div>
            <div class="box-body">
                @foreach($vaksinasi as $v)
                    <div class="row">
                        <div class="col-md-12">
                        <div class="box box-solid collapsed-box">
                            <div class="box-header with-border">
                                <i class="fa fa-file"></i>
                                <!--<a download="custom-filename.jpg" href="{{url('uploads/Karyawan/'.$v->id_karyawan.'/'.'Vaksinasi'.'/'.$v->file_vaksinasi)}}" title="Sertifikat Vaksinasi">-->
                                    <h3 class="box-title" style="font-size: 16px;">Vaccination dose &nbsp;{{$loop->iteration}}</h3>
                                <!--</a>-->
                                <div class="box-tools pull-right">
                                    <button type="submit" class="btn btn-xs btn-danger" onclick='window.open("{{url('uploads/Karyawan/'.$v->id_karyawan.'/'.'Vaksinasi'.'/'.$v->file_vaksinasi)}}")'><i class="fa fa-download"></i></button>
                                    <button class='btn btn-xs btn-danger delete_vaksinasi' data-token="{{ csrf_token() }}" data-id="{{$v->id}}"><i class="fa fa-trash"></i></button>   
                                </div>
                            </div>
                        
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        </div>
    </div>
    {{-- End Row Vaksinasi --}}
</section>

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
 
    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        confirm("Are you want to delete this data?");
        $.ajax({
            type: "delete",
            url: "{{ url('upload-sertifikat') }}" +'/' + id +'' ,
            data: {
                "id": id,
                "_method": 'delete',
                "_token": token,
            },
            success: function (data) {
                console.log(data.message);
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
    $('body').on('click', '.delete_vaksinasi', function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        confirm("Are you want to delete this data?");
        $.ajax({
            type: "delete",
            url: "{{ url('upload-vaksinasi') }}" +'/' + id +'' ,
            data: {
                "id": id,
                "_method": 'delete',
                "_token": token,
            },
            success: function (data) {
                console.log(data.message);
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endpush 


