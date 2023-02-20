@extends('templates.header')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    <br>
      <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="{{url('histori-cuti')}}">Reset Leave</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <span class="fonts header-style">
            <b>Reset All Employee Leave</b>
        </span>

        <div class="box">
            <div class="box-body">
                {{-- <p>Dear user,</p> --}}
                <p>This feature is used to reset all employee leave.</p>
                <p>If you click this button, all employee leave is 0 days and you cannot restore it as before.</p>
                <p>Thank You :)</p>

                <br>
                <button id="resetAll" class="btn btn-md btn-danger"><i class="fa fa-refresh"></i> Reset All</button>
            </div>
        </div>
    </section>

@endsection

@push('script')

<script>
    var id = {!! json_encode($dt->toArray()) !!};
    var sisa_cuti = 0;

    $('#resetAll').click(function(){
        // console.log("ids>>>", id);

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax(
        {
            url: "reset-all-cuti",
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": id ,
                "sisa_cuti": sisa_cuti,
            },
            success: function(data){
            alert('Thankyou! Data reset successfully');
            window.location.reload();
            }
        });
    })
</script>
@endpush