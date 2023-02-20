@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <span class="fonts header-style">
            <b>Leave Form</b>
        </span>
    <br>
      <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('spd')}}">Leave</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12 col-xs-12 col-xl-12">
              @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              @elseif(session()->get('failed'))
                <div class="alert alert-danger alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4><i class="icon fa fa-ban"></i> Alert !</h4>
                  {{ session()->get('failed') }}
                </div>
              @endif
            </div>
          </div>


          {{--  sub menu  --}}
          <div style="margin-bottom: 20px">
              @if($sisacuti->sisa_cuti == 0)
                <button type="button" class="btn btn-danger" ><i class="fa Lfa-info-circle" aria-hidden="true"></i> Remaining Days Off : {{$sisacuti->sisa_cuti}} days</button>
              @else
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".tambahspd"><span class="glyphicon glyphicon-plus"></span> Add Request</button>
               <button type="button" class="btn btn-danger" ><i class="fa Lfa-info-circle" aria-hidden="true"></i> Remaining Days Off : {{$sisacuti->sisa_cuti}} days</button>
              @endif
          </div>
          {{--  end of sub menu  --}}

            {{--  table data of car  --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Action</th>
                            <th>No</th>
                            <th>Employee's Name</th>
                            <th>Request Date</th>
                            <th>Total Days</th>
                            <th>First Date</th>
                            <th>Last Date</th>
                            <th>Type of Leave</th>
                            <th>Description</th>
                            <th>Approval HC</th>
                            <th>Upload Scan File</th>
                        </tr>
                    </thead>
                    </thead>
                    <tbody>
                    @foreach($cuti_karyawan as $k => $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                              <center>
                                @if($d->status == 0)
                                    <button class='btn btn-xs btn-default delete' data-id="{{$d->id}}" style="color: dodgerblue;"><span class='glyphicon glyphicon-trash'></span></button>
                                @elseif($d->status == 1)
                                    <a href="{{url('downloadcuti',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;"><span class='glyphicon glyphicon-print'></span></a>
                                @else 
                                    
                                @endif
                              </center>
                            </td>
                            <td>{{$d->no_cuti}}</td>
                            <td>{{$d->nama_karyawan}}</td>
                            <td>{{ date('d-M-Y', strtotime($d->tgl_pengajuan)) }}</td>
                            <td>{{$d->jumlah_hari}} days</td>
                            <td>{{ date('d-M-Y', strtotime($d->dari_tanggal)) }}</td>
                            <td>{{ date('d-M-Y', strtotime($d->sampai_tanggal)) }}</td>
                            <td>{{$d->tipeCuti->nama}}</td>
                            <td>
                              @if($d->keterangan == "")
                                <center><span> - </span></center>
                              @else
                                {{$d->keterangan}}
                              @endif
                            </td>
                            <td>
                                @if($d->status == 0)
                                    <span class="label label-danger">Waiting approval HC</span>
                                @elseif($d->status == 1)
                                    <span class="label label-success">Approved by HC</span>
                                @else
                                    <span class="label label-danger">Rejected by HC</span>
                                @endif
                            </td>
                            <td>
                              <center>
                                <!--{{-- <a href="" id="uploadCuti" data-toggle="modal" class="btn btn-default btn-xs" style="color: dodgerblue;" data-target='#uploadFormCuti' data-id="{{$d->id}}"><i class="fa fa-upload"></i></a> --}}-->
                                @if($d->status == 0)
                                    <span></span>
                                @elseif($d->status == 1)
                                    <a href="{{route('showUpload',$d->id)}}" class="btn btn-default btn-xs" style="color: dodgerblue;">Upload file</span></a>
                                    @if($d->file_scan != NULL || $d->file_scan != "")
                                      <a href="{{url('uploads/Cuti/'.$d->file_scan)}}" target="_blank" class="btn btn-default btn-xs" style="color: dodgerblue;">View file</a>
                                    @else 
    
                                    @endif
                                    
                                @else
                                    <span></span>
                                @endif
                              </center>
                            </td>

                            {{-- <td>
                              @if($d->status == 0)
                                <span class="label label-danger">Waiting approval HC</span>
                              @elseif($d->status == 1)
                                <span class="label label-success">Approved by HC</span>
                              @elseif($d->status == 2)
                                <span class="label label-danger">Waiting approval User</span>
                              @elseif($d->status == 3)
                                <span class="label label-success">Approved by User</span>
                              @elseif($d->status == 4)
                                <span class="label label-danger">Rejected by HC</span>
                              @elseif($d->status == 5)
                                <span class="label label-danger">Rejected by User</span>
                              @endif
                            </td> --}}
                         
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            {{--  end of car data  --}}
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
    <!-- modal konfirmasi -->

    <div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body" id="konfirmasi-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" data-id="" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Deleting..." id="confirm-delete">Delete</button>
        </div>
        </div>
      </div>
    </div>
    <!-- end of modal konfirmais -->
    @include('staff.cuti.create')
    {{-- @include('staff.cuti.upload_form_cuti') --}}

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


<script type="text/javascript">
    $(function(){
        
    var mainTable = $('#data-table').DataTable();
    var selectedRow;
    $('#data-table').on('click', '.delete', function (e) {
        e.preventDefault();
        selectedRow = mainTable.row( $(this).parents('tr') );
        $("#modal-konfirmasi").modal('show');
        $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
        $("#konfirmasi-body").text("Are you sure to delete this data?");
    });
    $('#confirm-delete').click(function(){
        var deleteButton = $(this);
        var id           = deleteButton.data("id");
        console.log(id);

        deleteButton.button('loading');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
        {
            url: "pengajuan-cuti/"+id,
            type: 'POST',
            dataType: "JSON",
            data: {
            },
            success: function (response)
            {
            deleteButton.button('reset');
            selectedRow.remove().draw();
            $("#modal-konfirmasi").modal('hide');
            Swal.fire({
                title: response.success,
                // text: response.success,
                type: 'success',
                confirmButtonText: 'Close',
                confirmButtonColor: '#AAA',
                onClose: function(){
                }
            })
           
            },
            error: function(xhr) {
            console.log(xhr.responseText);
            }
        });
    });

    // $('body').on('click', '#uploadCuti', function(e){
    //         e.preventDefault();
    //         var id = $(this).data('id');

    //         $.get('upload-file-scan/'+id , function(data){
    //             $('btnUpload').val("file-scan");
    //             $('uploadFormCuti').modal('show');
    //             $('#ids').val(data.data.id);
    //         })
    // });

    // $('#btnUpload').click(function(e){
    //         e.preventDefault();

    //         $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //        });
    //         var id              = $("#ids").val();

    //         var file = document.getElementById('edit_file_scan').files[0];
    //         var form = $('form')[0];
    //         var formData = new FormData(form);
    //         formData.append("File", file);
            
    //         console.log(id);
    //         console.log(formData);

    //         $.ajax({
    //             url:"upload-file-scan/"+id,
    //             type: "POST",
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             data: {
    //                 id : id,
    //                 edit_file_scan : edit_file_scan,
    //             },
    //             dataType: 'json',
    //             success: function (data){
    //                 $('#cutiForm').trigger("reset");
    //                 $('#uploadFormCuti').modal('hide');
    //                 window.location.reload(true);
    //             }, 
    //             error: function (data){
    //                 console.log('Error:', data);
    //                 $('#btnUpload').html('Update Changes');
    //             }
    //         });
    //     })

    });
</script>
@endpush