@if(($data['status_pengajuan']== 4 && $data['status_PO']==0 && $data['status_paid'] == 0) ||
    ($data['status_pengajuan']== 3 && $data['status_PO']==4 && $data['status_paid'] == 0) ||
    ($data['status_pengajuan']== 3 && $data['status_PO']==3 && $data['status_paid'] == 4))
    <h4>
        <span>Dear Bapak/Ibu {{$data['nama']}}
    </h4>
    <br>
    <span>Pengajuan barang anda pada tanggal {{$data['tanggal_pengajuan']}} telah <b style="color: red">DITOLAK</b></span>
    <br>
    <br>
    <span>Untuk informasi lebih detail, silahkan klik <a href="https://riisa.rapidinfrastruktur.com">link</a> ini atau login ke sistem</span>
    <br>
    <br>
    <span>Terima Kasih</span>
    <br>
    <br>
    <span>RII-SA Administration Team</span>
@endif
