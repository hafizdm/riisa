{{-- @extends('templates.header')

@section('content')

<style>
    .kbw-signature { 
        width: 100%; height: 200px;
    }
    #sig canvas{
        width: 100% !important;
        height: auto;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Leave Approval</b>
      </span>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="#">Leave Approval</a></li>
      
    </ol>
  </section>
  <br>
      
    <div class="container">         
        <div class="row">
                <div class="col-lg-6">
                <form method="POST" action="{{ route('approvalcuti', $cuti->id) }}" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <input type="hidden" id="ids" name="ids" value="{{$cuti->id}}">

                            <label for="nik">Signature*</label>
                            <div id="sig"></div>
                            <br>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature" name="signed" style="display: none"></textarea>
                        </div>                   
                        <div class="form-group">
                            <label>Approval Status</label>
                            <select id="status" name="status" class="form-control">
                                <option disabled>-- Choose --</option>
                                <option value="1">Approved</option>
                                <option value="4">Rejected</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Save</button>	              
                </form>
                </div>
            </div>
    </div>  
    <!-- Main content -->
    <section class="content">
     
    @endsection

    @push('script')

    <link type="text/css" 
    href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> 
    </script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"> 
    </script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

    <script type="text/javascript" >
        var sig = $('#sig').signature(
            {
                syncField: '#signature', 
                syncFormat: 'PNG'
            }
        );
        $('#clear').click(function (e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature").val('');
        });
    </script>
@endpush
    --}}
