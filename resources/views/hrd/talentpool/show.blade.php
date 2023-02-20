@extends('templates.header')

@section('content')
<section class="content-header">
    {{-- <h1>
      Talent Information
    </h1> --}}
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Talent information</li>
    </ol>
  </section>
<br>
  <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12">
          <div class="box" style="border-top: none !important;">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-lg-12">
                 <center> <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> TALENT INFORMATION </b></h4></center>
                  <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 col-xs-12 col-lg-3">
                @if($talent_pool->profile == null)
                <img class="profile-user-img img-responsive img-circle" style="width: 140px !important;" src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" alt="User profile picture">
                @else
                  <img class="profile-user-img img-responsive img-circle" src="{{asset('uploads/TalentPool')."/".$talent_pool->id."/".$talent_pool->profile}}" alt="User profile picture">
                @endif
                <br>
                <center><b><span> {{$talent_pool->name}}</span></b></center>
                <center><b><span> {{$talent_pool->jb_apply}}</span></b></center>
                <!--{{-- <br> --}}-->
                <!--{{-- <center>-->
                  <button type="button" class="btn btn-primary btn-xs" style="margin-top: 8px">
                    <i class="fa fa-edit"></i><span> &nbsp; Change photo</span>
                  </button>
                  <!--</center> --}}-->
                  <!--{{-- <input id="change_photo" type="file"/> --}}-->
                  <center>
                    <!--{{-- <a href="" id="change_photo_profile" class="btn btn-primary btn-xs" style="margin-top: 8px"><i class="fa fa-edit"></i>&nbsp; <span> Change photo</span></a> --}}-->
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changeProfile" id="changeprofiles" data-id="{{ $talent_pool->id }}" style="margin-top: 8px">
                      <i class="fa fa-edit"></i> &nbsp; <span> Change photo </span>
                    </button>
                  </center>
              </div>

              <div class="col-md-7 col-xs-12 col-lg-7">
                <div class="row">
                  <div class="col-md-12 col-xs-12 col-lg-12">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title" style="font-size: 17px !important;">Personal Information</h3>
          
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                          </button>
                        </div>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <table width="100%">
                              <tr>
                                <td>Full name </td>
                                <td>: &nbsp; {{$talent_pool->name}} </td>
                              </tr>
                              <tr>
                                <td>Birthday </td>
                                <td>: &nbsp; 
                                  @if($talent_pool->birth_place != NULL && $talent_pool->birth_date != NULL)
                                    <span>{{$talent_pool->birth_place}}, {{date('d-m-Y', strtotime($talent_pool->birth_date))}}</span>
                                  @elseif($talent_pool->birth_place == NULL && $talent_pool->birth_date != NULL)
                                    <span> - , {{date('d-m-Y', strtotime($talent_pool->birth_date))}}</span>
                                  @elseif($talent_pool->birth_place != NULL && $talent_pool->birth_date == NULL)
                                    <span> {{$talent_pool->birth_place}} , - </span>
                                  @else
                                  <span> </span>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Gender </td>
                                <td>: &nbsp; {{$talent_pool->jk}}
                                </td>
                              </tr>
                              <tr>
                                <td>Address </td>
                                <td>: &nbsp; 
                                    @if($talent_pool->alamat == "" && $talent_pool->city == "" && $talent_pool->state == "")
                                        <span>-</span>
                                    @elseif($talent_pool->alamat != "" && $talent_pool->city == "" && $talent_pool->state == "")
                                        {{$talent_pool->alamat}}
                                    @elseif($talent_pool->alamat != "" && $talent_pool->city != "" && $talent_pool->state == "")
                                        {{$talent_pool->alamat}}, {{$talent_pool->city}}
                                    @elseif($talent_pool->alamat != "" && $talent_pool->city != "" && $talent_pool->state != "")
                                        {{$talent_pool->alamat}}, {{$talent_pool->city}}, {{$talent_pool->state}}
                                    @elseif($talent_pool->alamat == "" && $talent_pool->city != "" && $talent_pool->state != "")
                                        {{$talent_pool->city}}, {{$talent_pool->state}}
                                    @elseif($talent_pool->alamat != "" && $talent_pool->city == "" && $talent_pool->state != "")
                                        {{$talent_pool->alamat}}, {{$talent_pool->state}}
                                    @endif
                                </td>
                               
                              </tr>
                              <tr>
                                <td>Last Education </td>
                                <td>: &nbsp; {{$talent_pool->pendidikan_terakhir}} </td>
                              </tr>
                              <tr>
                                <td>Total work years </td>
                                <td>: &nbsp;
                                  @if($talent_pool->total_pengalaman_kerja == NULL)
                                    <span></span>
                                  @else
                                    <span>{{$talent_pool->total_pengalaman_kerja}} years</span>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Position applied</td>
                                <td>: &nbsp; {{$talent_pool->jb_apply}} </td>
                              </tr>
                              <tr>
                                <td>
                                  <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalPersonalInfo" style="margin-top: 10px;" id="updatePersonalInfo" data-id="{{$talent_pool->id}}">
                                    <i class="fa fa-edit"></i> Edit data
                                  </button>
                                </td>
                              </tr>
                          </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>
                  <div class="col-md-12 col-xs-12 col-lg-12">
                    <div class="box box-primary collapsed-box">
                      <div class="box-header with-border">
                        <h3 class="box-title" style="font-size: 17px !important;">Contact Information</h3>
          
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                          </button>
                        </div>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table width="100%">
                          <tr>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; <span><a href="tel:{{$talent_pool->kode_telepon}}{{$talent_pool->no_hp}}">(+62) {{$talent_pool->no_hp}}</a></span></td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; <span><a href="mailto:{{$talent_pool->email}}">{{$talent_pool->email}}</a></span></td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-linkedin" aria-hidden="true"></i> &nbsp; <span><a href="{{$talent_pool->linkedin}}">{{$talent_pool->linkedin}}</a></span></td>
                          </tr>
                          <td>
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalContactInformation" id="updateContact" data-id="{{ $talent_pool->id }}" style="margin-top: 10px;">
                              <i class="fa fa-edit"></i><span> Edit data </span>
                            </button>
                          </td>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>

                  <div class="col-md-12 col-xs-12 col-lg-12">
                    <div class="box box-primary collapsed-box">
                      <div class="box-header with-border">
                        <h3 class="box-title" style="font-size: 17px !important;">Additional Information</h3>
          
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                          </button>
                        </div>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        {{-- <a href="#" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Upload CV/Resume</a> --}}
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalUploadCV" id="updateCV" data-id="{{$talent_pool->id}}">
                          <i class="fa fa-upload"></i> Upload CV/Resume
                        </button>
                        @if($talent_pool->cv == NULL)

                        @else
                          <button type="submit" class="btn btn-xs btn-danger" onclick='window.open("{{url('uploads/TalentPool/'.$talent_pool->id.'/'.$talent_pool->cv)}}")'></i>
                            {{-- <button type="submit" class="btn btn-xs btn-danger" onclick='window.open("{{url('uploads/Karyawan/'.$v->id_karyawan.'/'.'Vaksinasi'.'/'.$v->file_vaksinasi)}}")'><i class="fa fa-download"></i></button> --}}
                            <i class="fa fa-download"></i> Preview CV/Resume
                          </button>
                        @endif

                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>
              </div>
              </div>
            </div>

          <br>
          <br>
          
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th colspan="4"><center>HISTORY SCORE INTERVIEW</center></th>
                    </tr>
                      <tr>
                        <th style="font-weight: normal;width:15%"><center>Action</center></th>
                        <th style="font-weight: normal;"><center>Interview HRD</center></th>
                        <th style="font-weight: normal;"><center>Interview User</center></th>
                        <th style="font-weight: normal;"><center>Interview BOD</center></th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <br>
                        <br>
                        <br>
                        <center>
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAddScore" id="addScore" data-id="{{$talent_pool->id}}">
                            <i class="fa fa-plus"></i><span> &nbsp; Add Score</span>
                          </button>
                        </center>
                        <br>
                        <br>
                        <br>
                      </td>
                      <td>
                          <br>
                          <br>
                          <br>
                          <center><span style="font-size: 18px;">{{$talent_pool->interview_hrd}}</span></center>
                          <br>
                          <br>
                          <br>
                          <center>
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#interviewHRD" id="id_interviewHRD" data-id="{{$talent_pool->id}}">
                              <i class="fa fa-upload"></i> &nbsp; <span> Upload file </span>
                            </button>

                            @if($talent_pool->file_score_HRD == NULL)

                            @else 
                            <button type="submit" class="btn btn-xs btn-danger" onclick='window.open("{{url('uploads/TalentPool/'.$talent_pool->id.'/'.$talent_pool->file_score_HRD)}}")'></i>
                              <i class="fa fa-download"></i> Preview file
                            </button>
                            @endif
                          </center>

                          {{-- <input id="upload_hrd" type="file"/>
                          <center><a href="" id="upload_link_hrd" class="btn btn-primary btn-xs"><i class="fa fa-upload"></i>&nbsp; <span> Upload file</span></a></center> --}}
                        <br>
                        </td>
                      <td>
                        <br>
                          <br>
                          <br>
                          <center><span style="font-size: 18px;">{{$talent_pool->interview_user}}</span></center>
                          <br>
                          <br>
                          <br>
                          <center>
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#interviewUser" id="id_interviewUser" data-id="{{$talent_pool->id}}">
                              <i class="fa fa-upload"></i> &nbsp; <span> Upload file </span>
                            </button>

                            @if($talent_pool->file_score_user == NULL)

                            @else 
                            <button type="submit" class="btn btn-xs btn-danger" onclick='window.open("{{url('uploads/TalentPool/'.$talent_pool->id.'/'.$talent_pool->file_score_user)}}")'></i>
                              <i class="fa fa-download"></i> Preview file
                            </button>
                            @endif

                          </center>
                          {{-- <input id="upload_user" type="file"/>
                          <center><a href="" id="upload_link_user" class="btn btn-primary btn-xs"><i class="fa fa-upload"></i>&nbsp; <span> Upload file</span></a></center> --}}
                        <br>
                      </td>
                      <td>
                        <br>
                          <br>
                          <br>
                          <center><span style="font-size: 18px;">{{$talent_pool->interview_bod}}</span></center>
                          <br>
                          <br>
                          <br>
                          <center>
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#interviewBOD" id="id_interviewBOD" data-id="{{$talent_pool->id}}">
                              <i class="fa fa-upload"></i> &nbsp; <span> Upload file </span>
                            </button>
                            @if($talent_pool->file_score_bod == NULL)

                            @else 
                            <button type="submit" class="btn btn-xs btn-danger" onclick='window.open("{{url('uploads/TalentPool/'.$talent_pool->id.'/'.$talent_pool->file_score_bod)}}")'></i>
                              <i class="fa fa-download"></i> Preview file
                            </button>
                            @endif
                          </center>
                          <br>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4" style="background-color: #3c8dbc;color: white;">
                        <br>
                        <center><b>
                          <?php $total = $talent_pool->interview_hrd + $talent_pool->interview_user + $talent_pool->interview_bod;?>
                          TOTAL SCORE : <?php echo $total;?> 
                        </b></center>
                        <br>
                      </td>
                    </tr>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>

      {{-- History Interview --}}
      {{-- <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12">
          <div class="box" style="border-top: none !important;">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-lg-12">
                 <center> <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> TALENT INFORMATION </b></h4></center>
                  <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-4">
              </div>
            </div>
          </div>
        </div>
      </div> --}}
  </section>
  
  @include('hrd.talentpool.modalTalentPool')
  {{-- @include('hrd.talentpool.modalContactInformation')
  @include('hrd.talentpool.modalScore') --}}
@endsection

@push('script')
  <script type="text/javascript">
  
    $(function(){
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
      // Change Profile
      $('body').on('click', '#changeprofiles', function(e){
        e.preventDefault();

        var id = $(this).data('id');
        console.log("id>>>", id);

        $.get('profiles/'+id , function(data){
            $('btnChangeProfile').val("update-profile");
            $('changeProfile').modal('show');
            $('#id_photo').val(data.data.id);
            // $('#profile').val(data.data.profile);
        });
      });

        $('#btnChangeProfile').click(function(e){
                e.preventDefault();
                var id = $("#id_photo").val();
                var profile = new FormData($("#formChangeProfile")[0]);
                
                $.ajax({
                    url:"profiles/update/"+id,
                    type: "POST",
                    data: profile,
                    dataType: 'JSON',
                    contentType : false,
                    processData : false,
                    success: function (data){
                        $('#profileForm').trigger("reset");
                        $('#changeProfile').modal('hide');
                        window.location.reload(true);
                    }, 
                    error: function (data){
                        console.log('Error:', data);
                        $('#changeProfile').html('Update Changes');
                    }
                });
            });
         

    // Update Contact
    $('body').on('click', '#updateContact', function(e){
        e.preventDefault();

        var id = $(this).data('id');
        console.log("id>>>", id);

        $.get('contact/'+id , function(data){
            $('btnUpdateContact').val("update-contact");
            $('modalContactInformation').modal('show');
            $('#id_contact').val(data.data.id);
            $('#kode_telp').val(data.data.kode_telp);
            $('#no_hp').val(data.data.no_hp);
            $('#email').val(data.data.email);
            $('#linkedin').val(data.data.linkedin);
            console.log(data)
        });
      });

      $('#btnUpdateContact').click(function(e){
        e.preventDefault();
        var id        = $("#id_contact").val();
        var kode_telp = $("#kode_telp").val();
        var no_hp     = $("#no_hp").val();
        var email     = $("#email").val();
        var linkedin  = $("#linkedin").val();

        console.log("ids>>>", id);
        console.log("kode_telp>>>", kode_telp);
        console.log("no hp>>>", no_hp);
        console.log("email>>>", email);
        console.log("linkedin>>>", linkedin);

        $.ajax({
            url:"contact/update/"+id,
            type: "POST",
            data: {
                id : id,
                kode_telp : kode_telp,
                no_hp : no_hp,
                email : email, 
                linkedin : linkedin
            },
            dataType: 'json',
            success: function (data){
                $('#contactForm').trigger("reset");
                $('#modalContactInformation').modal('hide');
                window.location.reload(true);
            }, 
            error: function (data){
                console.log('Error:', data);
                $('#modalContactInformation').html('Update Changes');
            }
        });
      });

      // Add Score
      $('body').on('click', '#addScore', function(e){
        e.preventDefault();

        var id = $(this).data('id');
        console.log("id>>>", id);

        $.get('score/'+id , function(data){
            $('btnAddScore').val("update-score");
            $('modalAddScore').modal('show');
            $('#id_score').val(data.data.id);
            $('#interview_hrd').val(data.data.interview_hrd);
            $('#interview_user').val(data.data.interview_user);
            $('#interview_bod').val(data.data.interview_bod);
            console.log(data)
        });
      });

      $('#btnAddScore').click(function(e){
        e.preventDefault();
        var id              = $("#id_score").val();
        var interview_hrd   = $("#interview_hrd").val();
        var interview_user  = $("#interview_user").val();
        var interview_bod   = $("#interview_bod").val();

        console.log("ids>>>", id);
        console.log("interview_hrd>>>", interview_hrd);
        console.log("interview_user>>>", interview_user);
        console.log("interview_bod>>>", interview_bod);

        $.ajax({
            url:"score/update/"+id,
            type: "POST",
            data: {
                id              : id,
                interview_hrd   : interview_hrd,
                interview_user  : interview_user,
                interview_bod   : interview_bod, 
            },
            dataType: 'json',
            success: function (data){
                $('#scoreForm').trigger("reset");
                $('#modalAddScore').modal('hide');
                window.location.reload(true);
            }, 
            error: function (data){
                console.log('Error:', data);
                $('#modalAddScore').html('Update Changes');
            }
        });
      });

      // Personal Information
      $('body').on('click', '#updatePersonalInfo', function(e){
        e.preventDefault();

        var id = $(this).data('id');
        console.log("id>>>", id);

        $.get('personalinfo/'+id , function(data){
            $('btnUpdatePersonalInfo').val("update-personalinfo");
            $('modalPersonalInfo').modal('show');
            $('#id_personalinfo').val(data.data.id);
            $('#name').val(data.data.name);
            $('#birth_place').val(data.data.birth_place);
            $('#birth_date').val(data.data.birth_date);
            $('#jk').val(data.data.jk);
            $('#alamat').val(data.data.alamat);
            $('#city').val(data.data.city);
            $('#state').val(data.data.state);
            $('#pendidikan_terakhir').val(data.data.pendidikan_terakhir);
            $('#total_pengalaman_kerja').val(data.data.total_pengalaman_kerja);
            $('#jb_apply').val(data.data.jb_apply);
            console.log(data.data.jk)
        });
      });

      $('#btnUpdatePersonalInfo').click(function(e){
        e.preventDefault();
        var id                        = $("#id_personalinfo").val();
        var name                      = $("#name").val();
        var birth_place               = $("#birth_place").val();
        var birth_date                = $("#birth_date").val();
        var jk                        = $("#jk").val();
        var alamat                    = $("#alamat").val();
        var city                      = $("#city").val();
        var state                     = $("#state").val();
        var pendidikan_terakhir       = $("#pendidikan_terakhir").val();
        var total_pengalaman_kerja    = $("#total_pengalaman_kerja").val();
        var jb_apply                  = $("#jb_apply").val();

        $.ajax({
            url         : "personalinfo/update/"+id,
            type        : "POST",
            data        : {
                id                  : id,
                name                : name,
                birth_place         : birth_place,
                birth_date          : birth_date, 
                jk                  : jk,
                alamat              : alamat, 
                city                : city,
                state               : state, 
                pendidikan_terakhir : pendidikan_terakhir, 
                total_pengalaman_kerja : total_pengalaman_kerja, 
                jb_apply            : jb_apply
            },
            dataType: 'json',
            success: function (data){
                $('#PersonalInfoForm').trigger("reset");
                $('#modalPersonalInfo').modal('hide');
                window.location.reload(true);
            }, 
            error: function (data){
                console.log('Error:', data);
                $('#modalPersonalInfo').html('Update Changes');
            }
        });
      });

      // Upload CV/Resume
      $('body').on('click', '#updateCV', function(e){
        e.preventDefault();

        var id = $(this).data('id');
        // console.log("id>>>", id);

        $.get('uploadcv/'+id , function(data){
            $('btnUploadCV').val("update-cv");
            $('modalUploadCV').modal('show');
            $('#id_upload').val(data.data.id);
            // $('#file_cv').val(data.data.name);
            // $('#file_cv').val($(this).data('cv'));
        });
      });

      $('#btnUploadCV').click(function(e){
        e.preventDefault();
        var id          = $("#id_upload").val();
        var myFormData  = new FormData($('#formuploadCV')[0])

        $.ajax({
            type        : "POST",
            // enctype     : "multipart/form-data",
            url         : "uploadcv/update/"+id,
            data        : myFormData,
            contentType : false,
            processData : false,
            dataType    : 'JSON',
            success     : function (data){
                $('#CVForm').trigger("reset");
                $('#modalUploadCV').modal('hide');
                console.log(data);
                window.location.reload(true);
            }, 
            error: function (data){
                console.log('Error:', data);
                $('#modalUploadCV').html('Update Changes');
            }
        });
      });


      // Upload File Score Interview HRD
      $('body').on('click', '#id_interviewHRD', function(e){
        e.preventDefault();

        var id = $(this).data('id');

        $.get('scoreHRD/'+id , function(data){
            $('btnUploadScoreHRD').val("update-score-hrd");
            $('interviewHRD').modal('show');
            $('#id_file_hrd').val(data.data.id);
            console.log(data);
        });
      });

      
      $('#btnUploadScoreHRD').click(function(e){
        e.preventDefault();
        var id          = $("#id_file_hrd").val();
        var hrd         = new FormData($('#formUploadScoreHRD')[0])

        $.ajax({
            type        : "POST",
            url         : "scoreHRD/update/"+id,
            data        : hrd,
            contentType : false,
            processData : false,
            dataType    : 'JSON',
            success     : function (data){
                $('#ScoreHRDForm').trigger("reset");
                $('#interviewHRD').modal('hide');
                console.log(data);
                window.location.reload(true);
            }, 
            error: function (data){
                console.log('Error:', data);
                $('#interviewHRD').html('Update Changes');
            }
        });
      });


      // Upload File Score Interview User
      $('body').on('click', '#id_interviewUser', function(e){
        e.preventDefault();

        var id = $(this).data('id');

        $.get('scoreuser/'+id , function(data){
            $('btnUploadScoreUser').val("update-score-user");
            $('interviewUser').modal('show');
            $('#id_file_user').val(data.data.id);
            console.log(data);
        });
      });

      
      $('#btnUploadScoreUser').click(function(e){
        e.preventDefault();
        var id          = $("#id_file_user").val();
        var user         = new FormData($('#formUploadScoreUser')[0])

        $.ajax({
            type        : "POST",
            url         : "scoreuser/update/"+id,
            data        : user,
            contentType : false,
            processData : false,
            dataType    : 'JSON',
            success     : function (data){
                $('#ScoreUserForm').trigger("reset");
                $('#interviewUser').modal('hide');
                console.log(data);
                window.location.reload(true);
            }, 
            error: function (data){
                console.log('Error:', data);
                $('#interviewUser').html('Update Changes');
            }
        });
      });

      // Upload File Score Interview BOD
      $('body').on('click', '#id_interviewBOD', function(e){
        e.preventDefault();

        var id = $(this).data('id');

        $.get('scorebod/'+id , function(data){
            $('btnUploadScoreBOD').val("update-score-bod");
            $('interviewBOD').modal('show');
            $('#id_file_bod').val(data.data.id);
            console.log(data);
        });
      });

      
      $('#btnUploadScoreBOD').click(function(e){
        e.preventDefault();
        var id          = $("#id_file_bod").val();
        var bod         = new FormData($('#formUploadScoreBOD')[0])
        console.log(bod);

        $.ajax({
            type        : "POST",
            url         : "scorebod/update/"+id,
            data        : bod,
            contentType : false,
            processData : false,
            dataType    : 'JSON',
            success     : function (data){
                $('#ScoreBODForm').trigger("reset");
                $('#interviewBOD').modal('hide');
                console.log(data);
                window.location.reload(true);
            }, 
            error: function (data){
                console.log('Error:', data);
                $('#interviewBOD').html('Update Changes');
            }
        });
      });

      // End Function
    });
  </script>
@endpush