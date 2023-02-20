<!DOCTYPE html>
<head>
    <title>Surat Perjalanan Dinas</title>
    <meta charset="utf-8">
    <style>
        .from-destination {
            float: left;
            width: 50%;
            }

        .column4 {
            float: left;
            width: 33%;
            height: 30%;
            border: 1px solid black;
            /* border: 1px solid black; */
        }
        .coloumn7{
            float: left;
            width: 100%;
        }
        .column6 {
            float: left;
            width: 33%;
            height: 50%;
            border: 1px solid black;
        }
        .column5 {
            float: left;
            width: 33%;
            /* height: 8%; */
            border: 1px solid black;
            /* border: 1px solid black; */
        }

        .column1 {
            float: left;
            width: 33.33%;
        }

        .column2 {
            float: left;
            width: 40.33%;
        }

        .column3 {
            float: left;
            width: 50.33%;
        }

            /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        p {
            display: block;
            margin-top: 1px;
            margin-bottom: 1px;
            margin-left: 0;
            margin-right: 0;
        }

        fieldset {
            background-color: white;
            border: black;
            padding: 0px 0px 2px 2px;
        }

        legend {
            background-color: black;
            color: black;
            padding: 5px 3px;
        }

        input {
            margin: 5px;
        }

    </style>
</head>

<body>
    <div class="row">
        <div class="column1">
            <img src="{{asset('uploads/images/logo2.png')}}" style="height:34px" width="100px">
        </div>
        <div class="column2">
            {{-- <b style="font-size:20px"> --}}

                <br>
                <div style="width:98%; text-align: left; float: right;">
                    <p style="font-family:Comic Sans Ms"><b style="font-size:20px;"><font face ="Comic Sans Ms">Surat Perjalanan Dinas</font></b></p>
                </div><br>
                <div style="width: 98%; line-height: 35px; text-align: left; float: right;">
                    <p style="font-family:arial"><b style="font-size:20px;">(Business Travel Form)</b></p>
                </div>



                {{-- <>(Business Travel Form)</> --}}
        </div>
        <div class="column3">
            <img src="{{asset('uploads/images/iso.png')}}" style="height:45px">
            <img src="{{asset('uploads/images/iso.png')}}" style="height:45px">
            <img src="{{asset('uploads/images/iso.png')}}" style="height:45px">
        </div>
      </div>

    &nbsp;&nbsp;&nbsp;
    <table style="line-height: 1.2;">
        <tr>
            <td>&nbsp;Form Date</td>
            <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ date('d-M-Y', strtotime($data->form_date)) }} </td>
        </tr>
    </table>
    <form action="/action_page.php">
        <fieldset>
            <table style="line-height: 1.5;">
                <tr>
                    <td>Name</td>
                    <td> &nbsp; : {{$data->nama}}</td>
                </tr>
                <tr>
                    <td>Employee Number</td>
                    <td> &nbsp; : {{$data->nik}} </td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td> &nbsp; : {{$data->get_divisi->nama}}</td>
                </tr>
                <tr>
                    <td>Company</td>
                    <td> &nbsp; : PT. Rapid Infrastruktur Indonesia </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <table style="line-height: 1.5;">
                <tr>
                    <td>Travel Type</td>
                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$data->travel_type}}</td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <table style="line-height: 1.8;">
                <tr>
                    <td>Assignment Type &nbsp;&nbsp;&nbsp;&nbsp;: {{$data->assignment_type}} </td>
                </tr>
                <tr>
                    <td><span style="font-size: 12px;"><i style="color: red">*Note: Checklist based on the assignment</i></span></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%;">
                        <tr>
                            <td style="word-wrap:break-word;"><span>Purpose &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{$data->purpose}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <tr>
                            <td><span style="font-size: 12px;"><i style="color: red"><br>*Note: Report of daily activities must be submitted after returning
                                from assignment, including Timesheet approved by Field Manager</i></span></td>
                            <td> &nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="row">
                <div class="from-destination">
                    <table style="line-height: 1.5;">
                        <tr>
                            <td>From</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$data->asal}}</td>
                        </tr>
                        <tr>
                            <td><br>Date Depature</td>
                            <td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ date('d-M-Y', strtotime($data->tgl_keberangkatan)) }}</td>
                        </tr>

                    </table>
                </div>

                <div class="from-destination">
                    <table style="line-height: 1.5;">
                        <tr>
                            <td>Destination</td>
                            <td> &nbsp;: {{$data->tujuan}}</td>
                        </tr>
                        <tr>
                            <td><br>Date Return</td>
                            <td><br>&nbsp;: {{ date('d-M-Y', strtotime($data->tgl_pulang)) }}</td>
                        </tr>
                    </table>
                </div>
              </div>
        </fieldset>
        <fieldset style="margin-top:-5px;">
            <table style="line-height: 1.5;">
                <tr>
                    <td>Travel By</td>
                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$data->travel_by}} </td>
                </tr>
            </table>
        </fieldset>

        <fieldset style="border:none;">
            <div class="row">
                <div class="column5">
                    <center>Requested by</center>
                </div>
                <div class="column5" style="border-left: none !important;">
                    <center>Checked by</center>
                </div>

                <div class="column5" style="border-left: none !important;width:33.3% !important;">
                    <center>Approved By</center>
                </div>
            </div>
        </fieldset>

        <fieldset style="border:none; margin-top:-6px;">
            <div class="row">
                <div class="column4">

                </div>
                <div class="column4" style="border-left: none !important;">

                </div>
                <div class="column4" style="border-left: none !important;width:33.3% !important;">

                </div>
            </div>
    </fieldset>
    <fieldset style="border:none;margin-top:-6px;">
        <div class="row">
            <div class="column5">
                <center>{{$data->nama}}</center>
            </div>
            <div class="column5" style="border-left: none !important;">
                <center>HRD</center>
            </div>
            <div class="column5" style="border-left: none !important;width:33.3% !important;">
                @if(Auth::user()->user_login->report_to == "")
                    <center> - </center>
                @else 
                    <center> {{Auth::user()->user_login->report_to}} </center>
                @endif
            </div>
        </div>
    </fieldset>
    <fieldset style="border:none;margin-top:-6px;">
        <div class="row">
            <div class="column6" style="border-right: none !important;">
                <br>
                &nbsp; Advance Payment : {{$data->advance_payment}}
            </div>
            <div class="column6" style="border-right: none !important;border-left: none !important;">
                <br>
                @if($data->idr == '')
                    <span>IDR : - </span>
                @else
                    <span>IDR : @rupiah($data->idr),00 </span>
                @endif
                    <hr style="width:80%;margin-left:30px">
                
            </div>
            <div class="column6" style="border-left: none !important;width:33.6% !important;">
                <br>
                Sign Received : {{$data->sign_received}}
                <hr style="width:60%;margin-right:2px;">
            </div>
        </div>
        <div class="row" style="margin-top:-20px;">
            <div class="coloumn7">
                <span style="font-size: 12px;"><i style="color: red"> &nbsp; *Reminder: Expense Report must be prepared within one week after return</i></span>
            </div>
        </div>
    </fieldset>
    <div style="margin-left: 50px">
        <br>
        @if($data->note == '')
            <span> Note : </span>
        @else
            <span> Note : {{$data->note}}</span>
        @endif
            <hr style="width:93%; margin-left:40px">
    </div>
    <fieldset style="height: 2%">
    </fieldset>
</form>
</body>

</html>
