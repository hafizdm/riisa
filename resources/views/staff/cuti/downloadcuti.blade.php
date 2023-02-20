<!DOCTYPE html>
<head>
    <title>Leave Employee Form</title>
    <meta charset="utf-8">
    <style>
        .from-destination {
            float: left;
            width: 50%;
            }
        
        .col-1{
            float: left;
            width: 33%;
            height: 3.85%;
            border: 1px solid black;
        }
        .col-2{
            float: left;
            width: 66%;
            height: 3.85%;
            border: 1px solid black;
        }
        .col-3{
            float: left;
            width: 35%;
            height: 3.85%;
            border: 1px solid black;
        }

        .col-4{
            float: left;
            width: 8.63%;
            height: 3.85%;
            border: 1px solid black;
        }

        .col-5{
            float: left;
            width:98%;
            height: 20%;
            border: 1px solid black;
        }

        .col-6{
            float: left;
            width:30.7%;
            height: 22%;
            border: 1px solid black;
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
        .column8 {
            float: left;
            width: 66%;
            /* height: 8%; */
            border: 1px solid black;
            /* border: 1px solid black; */
        }

        .column9 {
            height: 2%;
            border: 1px solid black;
            width: 20px;
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

        .borderleft{
            border-left: 1px solid black;
            
        }
        .fnt{
           font-size:10px !important;
           line-height: 1.65;
        }

    </style>
</head>

<body>
    <div class="row">
        <div class="column1">
            <img src="{{asset('uploads/images/logo2.png')}}" style="height:34px" width="100px">
        </div>
        <div class="column2">
        </div>
        <div class="column3">
            <img src="{{asset('iso.png')}}" style="height:45px">
        </div>
      </div>

    &nbsp;&nbsp;&nbsp;
    <table style="line-height: 1.2;font-size:12px;font-family: Arial, Helvetica, sans-serif;">
        <tr>
            <td>&nbsp;Kepada &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: HRD 
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Dengan hormat</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;Berikut saya lampirkan form izin cuti karyawan</td>
        </tr>
    </table>
    <fieldset style="border:none;font-size:12px;font-family: Arial, Helvetica, sans-serif;">
        <div class="row">
            <div class="column5">
                <center><b>TICK ONE</b></center>
            </div>
            <div class="column8" style="border-left: none !important;">
                <center><b>COMPLETE FOR ITEM TICKED</b></center>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                <br>
                &nbsp;<b>ANNUAL LEAVE</b>
            </div>
            <div class="col-2" style="border-left: none !important">
                &nbsp; <b>PER ANNUAL VACATION SCHEDULE </b> 
                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                <b>YES</b><input type="checkbox" checked>

                &nbsp;&nbsp; <b>NO</b><input type="checkbox">
            </div>
        </div>

        <div class="row" style="font-family: Arial, Helvetica, sans-serif;">
            <div class="col-1">
                <br>
                &nbsp;<b>LONG SERVICE LEAVE</b>
            </div>
            <div class="col-2" style="border-left: none !important">
                &nbsp; <b>PER LSL VACATION SCHEDULE </b> 
                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>YES</b><input type="checkbox">

                &nbsp;&nbsp; <b>NO</b><input type="checkbox">
            </div>
        </div>

        <div class="row">
            <div class="col-1">
                <br>
                &nbsp;<b>R & R LEAVE</b>
            </div>
            <div class="col-2" style="border-left: none !important">
                &nbsp; <b>PER R & R SCHEDULE</b> 
                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>YES</b><input type="checkbox">
                &nbsp;&nbsp; <b>NO</b><input type="checkbox">
            </div>
        </div>

        <div class="row">
            <div class="col-1">
                &nbsp;<b>SICK LEAVE</b>
            </div>
            <div class="col-3" style="border-left: none !important">
                &nbsp; <b>ATTACH MEDICAL CERTIFICATE</b>
            </div>
            <div class="col-6" style="border-left:none !important;">
                &nbsp;<b><u>FOR HR OFFICE USE</u></b>
                <br>
                <br>
                &nbsp;<span class="fnt">TYPE OF LEAVE : &nbsp; AL<input type="checkbox"> LSL<input type="checkbox"> R&R<input type="checkbox"></span>
                <br>
                &nbsp;<span class="fnt">DATE OF HIRE :</span>
                <br>
                &nbsp;<span class="fnt">CURRENT ELIGIBILITY : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DAYS</span>
                <br>
                &nbsp;<span class="fnt">OUTSTANDING LEAVE : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DAYS</span>
                <br>
                &nbsp;<span class="fnt">ACCUMULATED LEAVE</span>
                <br>
                &nbsp;<span class="fnt">ENTITLEMENT : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DAYS</span>
                <br>
                &nbsp;<span class="fnt">LESS THIS LEAVE : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DAYS</span>
                <br>
                &nbsp;<span class="fnt">BALANCE : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;DAYS</span>
                <br>
                &nbsp;<span class="fnt">LEAVE PERIOD :</span>
                <br>
                &nbsp;<span class="fnt">POINT OF HIRE :</span>
            </div>
        </div>

        <div class="row" style="margin-top: -19% !important">
            <div class="col-1">
                &nbsp;<b>MATERNITY LEAVE</b>
            </div>
            <div class="col-3" style="border-left: none !important">
                &nbsp; <b>ATTACH DOCTOR CERTIFICATE</b>
            </div>
        </div>

        <div class="row">
            <div class="col-1">
                &nbsp;<b>UNPAID LEAVE</b>
            </div>
            <div class="col-3" style="border-left: none !important">
                &nbsp; <b>REASON:
                    @if($data->keterangan == "")

                    @else
                        {{$data->keterangan}}
                    @endif
                </b>
            </div>
        </div>

        <div class="row">
            <div class="col-1">
                &nbsp;<b>PERIOD OF LEAVE</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>Day</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>Month</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>Year</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>Remark</b>
            </div>
        </div>

        <div class="row">
            <div class="col-1">
                &nbsp;<b>FIRST DAY</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>{{ date('d', strtotime($data->dari_tanggal)) }}</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>{{ date('M', strtotime($data->dari_tanggal)) }}</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>{{ date('Y', strtotime($data->dari_tanggal)) }}</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b></b>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                &nbsp;<b>LAST DAY</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>{{ date('d', strtotime($data->sampai_tanggal)) }}</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>{{ date('M', strtotime($data->sampai_tanggal)) }}</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b>{{ date('Y', strtotime($data->sampai_tanggal)) }}</b>
            </div>
            <div class="col-4" style="border-left: none !important">
                &nbsp; <b></b>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                &nbsp;<b>DAYS LAPSED</b>
            </div>
            <div class="col-3" style="border-left: none !important">
                &nbsp; <b>{{$data->jumlah_hari}} days</b>
            </div>
        </div>

        <br>
        <br>
        <div class="row">
            <div class="col-1" style="border:none !important;">
                &nbsp;<b>APPLICANT NAME </b>
            </div>
            <div class="col-3" style="border:none !important;">
                : &nbsp; <b style="text-transform: uppercase">{{$data->nama_karyawan}}</b>
            </div>
            <div class="col-3" style="border:none !important;">
                &nbsp;<b>SIGNATURE/DATE :</b>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-1" style="border:none !important;">
                &nbsp;<b>ACKNOWLEDGE</b>
            </div>
            <div class="col-3" style="border:none !important;">
                : &nbsp; <b>KAMILA NURUL</b>
            </div>
            <div class="col-3" style="border:none !important;">
                &nbsp;<b>SIGNATURE/DATE :</b>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-1" style="border:none !important;">
                &nbsp;<b>*APPROVED / REJECTED BY </b>
            </div>
            <div class="col-3" style="border:none !important;">
                : &nbsp; <b></b>
            </div>
            <div class="col-3" style="border:none !important;">
                &nbsp;<b>SIGNATURE/DATE :</b>
            </div>
        </div>

        <br>
        <br>
        <div class="row">
            <div class="col-5">
                &nbsp; <u><b>REASON FOR REJECTION </b><i>(if rejected)</i></u> :
            </div>
        </div>

        <br>
        <br>
        <hr>
        <table style="line-height: 1.2;font-size:12px;font-family: Arial, Helvetica, sans-serif;width:100%">
            <tr>
                <td style="text-align: justify">(1)	Annual leave is due on completion of 1 year service. Entitlement after 1 year service is 12 work days. Annual leave must be 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spent within a period of 12 months after the entitlement to annual leave arises.								
                </td>
            </tr>
            <tr>
                <td style="text-align: justify">(2) The entitlement of annual leave/rest will be burned up within 12 (twelve) months since the entitlement of that annual leave/rest
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;arising.
                </td>
            </tr>
            <tr>
                <td style="text-align: justify">(3)	Long service leave is due for staff on completion of 5 years continuous service at 22 working days/for every 5 years. 
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LSL can only be taken several times at minimum 5 working days.								
                </td>
            </tr>
            <tr>
                <td style="text-align: justify">(4) The entitlement of annual leave/rest will be burned up if within 2 (two) years since the entitlement of that annual leave / rest 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; arising, the employee does not apply his/her entitlement not upon at the request of his/her Company Manager through an 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;official letter.
                </td>
            </tr>

            <tr>
                <td style="text-align: justify">(5) The entitlement of special leave (R&R) will be burned up if next special leave has arise and the Employee does not apply 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;his/her entitlement not upon at the request of his/her Company Manager through an official letter. 
                </td>
            </tr>

            <tr>
                <td style="text-align: justify">(6) Annual leave/rest can not be replaced by money (refundable), except for Employees that upon termination of employment with 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the company still  has the eligible to annual leave/ rest that has not been taken and yet burned. 
                </td>
            </tr>
            
        </table>

    </fieldset>
</body>

</html>
