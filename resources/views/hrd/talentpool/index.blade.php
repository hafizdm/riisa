@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="fonts header-style">
        <b>Talent Pool</b>
    </span>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{url('list-talent-pool')}}">Talent pool</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      {{-- <div class="box" style="position: relative;z-index:100"> --}}
        <div class="box">
        <div class="box-body">
          @if(session()->get('success'))
              <div class="alert alert-success alert-dismissible fade in"> {{ session()->get('success') }} 
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
          @elseif(session()->get('failed'))
            <div class="alert alert-danger alert-dismissible fade in"> 
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <h4><i class="icon fa fa-ban"></i> Gagal !</h4>
              {{ session()->get('failed') }}
            </div>
          @endif
            <div style="margin-bottom: 20px">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalAdd">
                    <span class="glyphicon glyphicon-plus"></span> Add Talent
                </button>
            <!--{{-- <a href="{{url('list-talent-pool/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Talent</a> --}}-->
            </div>
            <!--{{--  table data of car  --}}-->
            <div class="table-responsive">
                <table id="tb_talentpool" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Applied</th>
                            <th>Talent's name</th>
                            <th>Work Experience</th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($talent_pool as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->jb_apply}}</td>
                                <td>{{$item->name}}</td>
                                <td><center>{{$item->total_pengalaman_kerja}} tahun </center></td>
                                <td>
                                    <center>
                                    <a href="{{route('talent_show',$item->id)}}"><i class="fa fa-eye fa-1x"></i></a>
                                     <button class='delete' data-id="{{$item->id}}" style="border: none;color: red;background-color: transparent;"><i class="fa fa-trash"></i></button>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--{{--  end of car data  --}}-->
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
      </div>
      <!--{{-- <div style="position: absolute;z-index: 2;">-->
      <button class='btn btn-lg btn-primary' style="border-radius: 50%"><i class="fa fa-plus"></i></button>
      <!--</div> --}}-->
    </section>

   @include('hrd.talentpool.create')
    <!-- modal konfirmasi -->

    <div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
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
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> --}}

<script>
$(function(){
   var mainTable = $('#tb_talentpool').DataTable();
   var selectedRow;
   
  $('#tb_talentpool').on('click', '.delete', function (e) {
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

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax(
      {
        url: "list-talent-pool/"+id,
        type: 'POST',
        dataType: "JSON",
        data: {
          // _method:"DELETE"
          // "id": id
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
});
</script>
@endpush
