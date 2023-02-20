<h4>
    <span>Dear Admin Procurement,</span>
    <br>
    <span>PT. Rapid Infrastruktur Indonesia</span>
</h4>
<p>Berikut ini adalah data request pembelian barang oleh:</p>
<table>
    <tr>
        <td>Nama</td>
        <td>: {{$data['nama']}}</td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>: {{$data['nik']}}</td>
    </tr>
    <tr>
        <td>Divisi</td>
        <td>: {{$data->request_divisi->nama}}</td>
    </tr>
    <tr>
        <td>Jenis Pembelian</td>
        <td>: {{$data->masterjenisbarang->nama}}</td>
    </tr>
    <tr>
        <td>Cost Code</td>
        <td>: {{$data->masterKategori->kode_kategori}} - {{$data->masterKategori->nama_kategori}}</td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td>: {{$data['nama_barang']}}</td>
    </tr>
    <tr>
        <td>Lokasi Kebutuhan</td>
         <td>: {{$data->lokasiProyek->nama}}</td>
    </tr>
    <tr>
        <td>Jumlah Pembelian</td>
        <td>: {{$data['quantity']}} {{$data['quantity_satuan']}} </td>
    </tr>
    <tr>
        <td>Tanggal Request</td>
        <td>: {{$data['tanggal_pengajuan']}}</td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td>: {{$data['keterangan']}}</td>
    </tr>
    @if($data->nama_proyek == 3)
        <tr>
            <td>Disetujui oleh VP</td>
            <td>: {{$data['updated_vp_by']}}</td>
        </tr>
    @else
        <tr>
            <td>Disetujui oleh PM</td>
            <td>: {{$data['updated_manager_by']}}</td>
        </tr>
    @endif
    
  </table>
<br>
<span>Silahkan Upload dokumen yang diperlukan. Klik <a href="https://riisa.rapidinfrastruktur.com">link</a> ini untuk login ke sistem</span>
<br>
<br>
<span>Terima Kasih</span>
<br>
<br>
<span>RII-SA Administration Team</span>

