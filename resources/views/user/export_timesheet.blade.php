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
            <th><b>Tanggal Kerja</b></th>
            <th>Cost Account</th>
            <th><b>Jam Mulai</b></th>
            <th><b>Jam Selesai</b></th>
            <th><b>Total Jam</b></th>
            <th><b>Role</b></th>
            <th><b>Deskripsi Pekerjaan</b></th>
            <th><b>Status</b></th>
        </tr>
    </thead>
    <tbody>
    @foreach($summary as $d)
        <tr>
            <td></td>
            <td>{{$loop->iteration}}</td>
            @if(date('l', strtotime($d->tanggal_kerja)) == "Sunday" && $d->tanggal_kerja != $liburs)
            <td>Minggu, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Monday" && $d->tanggal_kerja != $liburs)
            <td>Senin, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Tuesday" && $d->tanggal_kerja != $liburs)
            <td>Selasa, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Wednesday" && $d->tanggal_kerja != $liburs)
            <td>Rabu, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Thursday" && $d->tanggal_kerja != $liburs)
            <td>Kamis, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Friday" && $d->tanggal_kerja != $liburs)
            <td>Jumat, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @elseif(date('l', strtotime($d->tanggal_kerja)) == "Saturday" && $d->tanggal_kerja != $liburs)
                <td>Sabtu, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @else
                <td>Libur Nasional/Cuti Bersama, {{ date('d-M-Y', strtotime($d->tanggal_kerja)) }}</td>
            @endif

        @if($d->getCostAccount->id == 1)
            <td>General/Head Office</td>
        @elseif($d->getCostAccount->id == 2)
            @if($d->proposal_id == 0)
            <td>Marketing</td>
            @else
                <td>{{$d->getProposal->nama}}</td>
            @endif
        @else
                <td>Project ({{$d->getLoc->nama}})</td>
        @endif
        <td>{{ date('H:i', strtotime($d->start_time)) }}</td>
        <td>{{ date('H:i', strtotime($d->end_time)) }}</td>
        <td>{{$d->man_hours}} jam</td>

        @if($d->cost_account_id == 1)
            <td>{{$d->getDiv->nama}}</td>
            <td>{{$d->workingType->nama}}
            <br><b>Detail:</b>
               {{strip_tags($d->desc_for_ho)}}
            </td>
        @elseif($d->cost_account_id == 2)
            @if($d->proposal_id == 0)
                <td>Marketing</td>
            @else
                <td>{{$d->getRes->nama_posisi}}</td>
            @endif
                <td>{{$d->desc_for_proposal}}</td>
        @else
                <td>{{$d->getRes->nama_posisi}}</td>
                <td>{{$d->desc_for_project}}</td>
        @endif
                            
        @if($d->status == 0)
            <td><span class="label label-warning">Menunggu</span></td>
        @elseif($d->status == 1)
            <td><span class="label label-success">Disetujui</span></td>
        @else
         <td><span class="label label-danger">Ditolak</span></td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>