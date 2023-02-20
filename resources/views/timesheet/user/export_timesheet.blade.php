<?php 
foreach($hari_libur  as $libur){
        $liburs = $libur->tanggal;
    }
?>
<h3> SUMMARY TIMESHEET </h3> 
<h4>PT. RAPID INFRASTRUKTUR INDONESIA</h4>
<br>
<table>
    @foreach($karyawan as $p)
        <tr>
            <td></td>
            <td>Nama</td>
            <td>: &nbsp; {{$p->nama}}</td>
        </tr>
        <tr>
            <td></td>
            <td>NIK</td>
            <td>: &nbsp; {{$p->nik}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Posisi</td>
            <td>: &nbsp; {{$p->jabatan->jenis_jabatan}}</td>
        </tr>
    @endforeach
</table>
<br>

<table style="border:2px solid #000000">
    <thead>
        <tr>
            <th></th>
            <th><b>No</b></th>
            <th><b>Date of Work</b></th>
            <th><b>Scope of Work</b></th>
            <th><b>Start Time</b></th>
            <th><b>End Time</b></th>
            <th><b>Manhours</b></th>
            <th><b>Detail of Work</b></th>
            <th><b>Status</b></th>
            <th><b>Approved By</b></th>
        </tr>
    </thead>
    <tbody>
    @foreach($summary as $d)
        <tr>
            <td></td>
            <td>{{$loop->iteration}}</td>
            @if(date('l', strtotime($d->tanggal_kerja)) == "Sunday" && $d->tanggal_kerja != $liburs)
            <td>Sunday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Monday" && $d->tanggal_kerja != $liburs)
            <td>Monday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Tuesday" && $d->tanggal_kerja != $liburs)
            <td>Tuesday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Wednesday" && $d->tanggal_kerja != $liburs)
            <td>Wednesday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Thursday" && $d->tanggal_kerja != $liburs)
            <td>Thursday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Friday" && $d->tanggal_kerja != $liburs)
            <td>Friday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Saturday" && $d->tanggal_kerja != $liburs)
                <td>Saturday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @else
                <td>National Holiday, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @endif

            <td><center>{{$d->getCostAccount->nama}}</center></td>
            <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
            <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
            <td>{{$d->man_hours}} jam</td>

            <td> 
                <br><b>Detail:</b>
                    @if($d->desc_for_ho != NULL)
                        {!! nl2br(@$d->desc_for_ho) !!}
                    @elseif($d->desc_for_project != NULL)
                        {!! nl2br(@$d->desc_for_project) !!}
                    @elseif($d->desc_for_proposal != NULL)
                        {!! nl2br(@$d->desc_for_proposal) !!}
                    @else
                        {!! nl2br(@$d->detail_of_work) !!}
                    @endif
            </td>
                                
            @if($d->status == 0)
                <td><span class="label label-warning">Waiting</span></td>
            @elseif($d->status == 1)
                <td><span class="label label-success">Approved</span></td>
            @else
             <td><span class="label label-danger">Rejected</span></td>
            @endif
            <td>{{$d->approved_by}}</td>
    </tr>
    @endforeach
    </tbody>
</table>