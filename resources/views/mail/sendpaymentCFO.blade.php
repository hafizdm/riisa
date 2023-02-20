<h4>
    <span>Dear Bapak/Ibu Chief Finance Officer (CFO),</span>
    <br>
    <span>PT. Rapid Infrastruktur Indonesia</span>
</h4>
<p>Berikut ini adalah data pengajuan barang oleh karyawan:</p>
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
        <td>Jumlah</td>
        <td>: {{$data['quantity']}} {{$data['quantity_satuan']}} </td>
    </tr>
    <tr>
        <td>Lokasi Kebutuhan</td>
        <td>: {{$data->lokasiProyek->nama}}</td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td>: {{$data['keterangan']}}</td>
    </tr>
    <tr>
        <td>Tanggal Pengajuan</td>
        <td>: {{$data['tanggal_pengajuan']}}</td>
    </tr>
    {{-- <tr>
        <td>Disetujui oleh Manager</td>
        <td>: {{$data['updated_manager_by']}}</td>
    </tr>
    <tr>
        <td>Disetujui oleh VP</td>
        <td>: {{$data['updated_vp_by']}}</td>
    </tr>
    <tr>
        <td>Disetujui oleh CEO</td>
        <td>: {{$data['updated_ceo_by']}}</td>
    </tr> --}}
    {{-- <tr>
        <td>Disetujui oleh Cost Control</td>
        <td>: {{$data['updated_co_po_by']}}</td>
    </tr> --}}
  </table>
<br>
<span>Untuk informasi detail pengajuan, silahkan klik <a href="https://riisa.rapidinfrastruktur.com">link</a> ini untuk login ke sistem</span>
<br>
<span>Terima Kasih</span>
<br>
<br>
<span>RII-SA Administration Team</span>

