<!DOCTYPE html>
<html>
<head>
	<title>Master Data Karyawan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 5pt;
            table-layout:fixed;
            overflow: hidden;
		}
	</style>
	<center>
		<h5>Data Karyawan PT. Rapid Infrastruktur Indonesia</h5>
    </center>
    <br>
 
	<table class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5%">No.</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Tanggal Bergabung</th>
                <th>Jabatan</th>
                <th>Divisi</th>
                <th>Penempatan</th>
                <th>Status</th>
			</tr>
		</thead>
		<tbody>
            @foreach($karyawan as $k => $d)
			<tr>
				<td>{{$loop->iteration}}</td>
                <td>{{$d->nik}}</td>
                <td>{{$d->nama}}</td>
                <td>{{$d->alamat}}</td>
                <td>{{$d->handphone}}</td>
                <td>{{$d->email}}</td>
                <td>{{$d->date_joining}}</td>
                <td>{{$d->jabatan->jenis_jabatan}}</td>
                @if($d->divisi_id != 0)
                    <td>{{$d->divisi->nama}}</td>
                @else
                    <td><span>-</span></td>
                @endif
                @if($d->lokasi != '')
                    <td>{{$d->lokasi->nama}}</td>
                @else
                    <td></td>
                @endif
                @if($d->status==0)
                <td><span class="label label-success"> Aktif</span></td>
                @else
                <td><span class="label label-danger"> Tidak Aktif</span></td>
                @endif
                
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>