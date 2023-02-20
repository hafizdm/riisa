<h3> SUMMARY TIMESHEET ALL EMPLOYEE ({{$month_name}} {{$yearss}}) </h3> 
<h4>PT. RAPID INFRASTRUKTUR INDONESIA</h4>
<br>

<table style="border:2px solid #000000">
    <thead>
        <tr>
            <th></th>
            <th><b>No.</b></th>
            <th><b>Fullname</b></th>
            <th><b>NIK</b></th>
            <th>Total Working Days</th>
            <th>Total Attendance</th>
            <th>Attendance Percentage (%)</th>
            <th>Total Absence</th>
            <th>Absence Percentage (%)</th>
        </tr>
    </thead>
    <tbody>
    @foreach($summary as $d)
        <tr>
            <td></td>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->nama}}</td>
            <td>{{$d->nik}}</td>
            <td>22 days</td>
            <td>{{$d->total_kehadiran}} days</td>
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
                    echo $ketidakhadiran." "."days";
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