<h4>
    <span>Dear Bapak/Ibu Human Capital Management (HCM),</span>
    <br>
    <br>
    <span>PT. Rapid Infrastruktur Indonesia</span>
</h4>
<p>Berikut ini daftar masa habis kontrak karyawan:</p>
<table style="border: 1px solid black;border-collapse: collapse;width:100%;">
    <thead>
        <tr>
            <th style="border: 1px solid black;">NO</th>
            <th style="border: 1px solid black;">NIK</th>
            <th style="border: 1px solid black;">Nama</th>
            <th style="border: 1px solid black;">Divisi</th>
            <th style="border: 1px solid black;">Jabatan</th>
            <th style="border: 1px solid black;">Tanggal Akhir Kontrak</th>
            <th style="border: 1px solid black;">Perpanjangan Ke</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $dt)
        <tr> 
            <td style="border: 1px solid black;">{{$loop->iteration}}</td>
            <td style="border: 1px solid black;">{{$dt->NIK}}</td>
            <td style="border: 1px solid black;">{{$dt->nama}}</td>
            <td style="border: 1px solid black;">{{$dt->nama_divisi}}</td>
            <td style="border: 1px solid black;">{{$dt->jabatan}}</td>
            <td style="border: 1px solid black;"><center>{{$dt->habis_kontrak}}</center></td>
            <td style="border: 1px solid black;"><center>{{$dt->perpanjangan_ke}}</center></td>
          </tr>
        @endforeach
        
    </tbody>
</table>
<br>
<br>
<span>Best Regards,</span>
<br>
<br>
<span>RII-SA Administration Team</span>