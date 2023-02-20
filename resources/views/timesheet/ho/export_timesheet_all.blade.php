<h3> SUMMARY TIMESHEET ALL EMPLOYEE ({{$month_name}} {{$yearss}}) </h3> 
<h4>PT. RAPID INFRASTRUKTUR INDONESIA</h4>
<br>

<table style="border:2px solid #000000">
    <thead>
        <tr>
            <th></th>
            <th><b>No</b></th>
            <th><b>Nama</b></th>
            <th><b>NIK</b></th>
            <th>Total Hari Kerja</th>
            <th>Total Pengisian Timesheet</th>
            <th>Persentase Pengisian Timesheet (%)</th>
            <th>Total Ketidakhadiran</th>
            <th>Persentase Ketidakhadiran (%)</th>
        </tr>
    </thead>
    <tbody>
    @foreach($summary as $d)
        <tr>
            <td></td>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->nama}}</td>
            <td>{{$d->nik}}</td>
            <td>22 hari</td>
            <td>{{$d->total_kehadiran}} hari</td>
            <td>
                <?php
                    $total_harikerja = 22;
                    $total_hadir = $d->total_kehadiran;
                    $persentase_kehadiran = ($total_hadir/$total_harikerja)*100;
                    echo number_format($persentase_kehadiran, 2, '.', '')."%";
                ?>
            </td>
            <td>
                <?php
                    $total_harikerja = 22;
                    $total_hadir = $d->total_kehadiran;
                    $ketidakhadiran = $total_harikerja - $total_hadir;
                    echo $ketidakhadiran." "."hari";
                ?>
            </td>
            <td>
                <?php
                    $total_harikerja = 22;
                    $total_hadir = $d->total_kehadiran;
                    $ketidakhadiran = $total_harikerja - $total_hadir;
                    $persentase_ketidakhadiran = ($ketidakhadiran/$total_harikerja)*100;
                    echo number_format($persentase_ketidakhadiran, 2, '.', '')."%";
                ?>
            </td>
    </tr>
    @endforeach
    </tbody>
</table>