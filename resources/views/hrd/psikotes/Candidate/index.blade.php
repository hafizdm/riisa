@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <span class="fonts header-style">
            <b>Candidate Data</b>
        </span>
        <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Psikotes</a></li>
        <li class="active"><a href="{{url('kandidat-psikotes')}}">Candidate</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
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

                <div style="margin-bottom: 20px">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalAdd">
                        <span class="glyphicon glyphicon-plus"></span> Add New Candidate
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="tb_candidate" class="table table-bordered table-striped" cellspacing="0" width="100%" style="white-space: nowrap !important;">
                        <thead>
                            <tr>
                                <th style="width: 5%"><center>#</center></th>
                                <th><center>Full Name</center></th>
                                <th><center>Last Education</center></th>
                                <th><center>Job Applied</center></th>
                                <th><center>Test Schedule</center></th>
                                <th><center>Username</center></th>
                                <th><center>Password</center></th>
                                <th><center>URL Login</center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidate as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->full_name}}</td>
                                    <td><center>{{$item->last_education}}</center></td>
                                    <td><center>{{$item->job_applied}}</center></td>
                                    <td><center>{{ date('d M Y H:i', strtotime($item->test_schedule)) }}</center></td>
                                    <td><center>{{$item->username}}</center></td>
                                    <td><center>{{$item->password_hash}}</center></td>
                                    <td><center>{{$item->url}}</center></td>
                                    <td>
                                        <center>
                                            <a href="" class="btn btn-warning btn-xs" id="editCandidate_" data-toggle="modal" data-target="#candidate_modal_" data-id="{{$item->id}}"><i class="fa fa-edit fa-1x"></i></a>
                                            <button class="btn btn-danger btn-xs delete" data-id="{{$item->id}}"><i class="fa fa-trash fa-1x"></i></button>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('hrd.psikotes.Candidate.create')
    @include('hrd.psikotes.Candidate.edit')

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

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    $(function(){
        var mainTable = $('#tb_candidate').DataTable();
        var selectedRow;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $('#tb_candidate').on('click', '.delete', function (e) {
            e.preventDefault();
            selectedRow = mainTable.row( $(this).parents('tr') );

            $("#modal-konfirmasi").modal('show');

            $("#modal-konfirmasi").find("#confirm-delete").data("id", $(this).data('id'));
            $("#konfirmasi-body").text("Are you sure you delete this data?");
        });

        $('#confirm-delete').click(function(){
            var deleteButton = $(this);
            var id           = deleteButton.data("id");

            deleteButton.button('loading');
            $.ajax(
            {
                url: "kandidat-psikotes/"+id,
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



        // edit data kategori 
        $('#tb_candidate').on('click', '#editCandidate_', function(e){
            e.preventDefault();

            var id = $(this).data('id');
            console.log("id>>>", id);

            $.get('kandidat-psikotes/'+id , function(data){
                $('editCandidateBtn').val("edit-candidate");
                $('candidate_modal').modal('show');
                $('#id').val(data.data.id);
                $('#edit_full_name').val(data.data.full_name);
                $('#edit_last_education').val(data.data.last_education);
                $('#edit_job_applied').val(data.data.job_applied);
                $('#edit_test_schedule').val(moment(data.data.test_schedule).format("YYYY-MM-DDTkk:mm"));
            })
        });

        $('#editCandidateBtn').click(function(e){
                e.preventDefault();
                var id                  = $("#id").val();
                var edit_full_name      =  $("#edit_full_name").val();
                var edit_last_education =  $("#edit_last_education").val();
                var edit_job_applied    =  $("#edit_job_applied").val();
                var edit_test_schedule  =  $("#edit_test_schedule").val(); 

                $.ajax({
                    url:"kandidat-psikotes/update/"+id,
                    type: "POST",
                    data: {
                        id                  : id,
                        edit_full_name      : edit_full_name,
                        edit_last_education : edit_last_education,
                        edit_job_applied    : edit_job_applied,
                        edit_test_schedule  : edit_test_schedule
                    },
                    dataType: 'json',
                    success: function (data){
                        $('#CandidateForm').trigger("reset");
                        $('#candidate_modal').modal('hide');
                        window.location.reload(true);
                    }, 
                    error: function (data){
                        console.log('Error:', data);
                        $('#editCandidateBtn').html('Update Changes');
                    }
                });
            })
        

    });
</script>

@endpush