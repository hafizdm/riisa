    <h4>
        <span>Dear Finance Team,</span>
        <br>
        <span>PT. Rapid Infrastruktur Indonesia</span>
    </h4>
    <span>
        Proses purchased order sudah disetujui.
    <br>
        Silahkan upload file invoice di sistem untuk proses selanjutnya.
    <br>
        Berikut ini adalah data request pembelian barang oleh karyawan:
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
            <td>Keterangan</td>
            <td>: {{$data['keterangan']}}</td>
        </tr>
        <tr>
            <td>Tanggal Pengajuan</td>
            <td>: {{$data['tanggal_pengajuan']}}</td>
        </tr>
        <tr><b>Request Approval</b></tr>
        <tr>
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
        </tr>
        <tr><b>Purchased Approval<b></tr>
        <tr>
            <td>Disetujui oleh CC</td>
            <td>: {{$data['updated_co_po_by']}}</td>
        </tr>
        <tr>
            <td>Disetujui oleh CFO</td>
            <td>: {{$data['updated_cfo_po_by']}}</td>
        </tr>
        <tr>
            <td>Disetujui oleh CEO</td>
            <td>: {{$data['updated_ceo_po_by']}}</td>
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
