<h4>
    <span>Dear Bapak/Ibu Cost Control(CC),</span>
    <br>
    <span>PT. Rapid Infrastruktur Indonesia</span>
</h4>
<span>
    Berikut adalah data pengajuan pembelian barang yang sudah masuk ke tahapan purchased order.
<br>
    Silahkan melakukan approval puchased order di sistem.
</span>
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
  </table>
<br>
<span>Untuk melihat informasi lebih detail, Silahkan klik <a href="https://riisa.rapidinfrastruktur.com"> link </a> berikut untuk login ke sistem</span>
<br>
<br>
<span>Terima Kasih</span>
<br>
<br>
<span>RII-SA Administration Team</span>

