<?php

namespace App\Console\Commands;
use App\KontrakKaryawan;
use DB;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Mail\notifikasiKontrakKerja;

class sendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Reminder:Kontrak_Kerja';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder Kontak Kerja Karyawan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $datas = collect(DB::select("
            SELECT emp.nik as NIK, emp.nama as nama, kontrak.tgl_akhir_kontrak as habis_kontrak, 
            max(kontrak.perpanjangan_ke) as perpanjangan_ke, emp.email, divisi.nama as nama_divisi, jabatan.jenis_jabatan as jabatan
            from karyawan as emp JOIN kontrak_karyawan as kontrak ON emp.nik = kontrak.nik_karyawan
            JOIN master_divisi as divisi ON emp.divisi_id = divisi.id 
            JOIN master_jabatan as jabatan ON emp.jabatan_id = jabatan.id 
            WHERE CURDATE() = (SELECT (DATE_SUB(max(kontrak.tgl_akhir_kontrak), INTERVAL 1 MONTH)))
            GROUP BY kontrak.nik_karyawan
        "));

        if(count($datas) > 0){
        $email = Mail::to("cicikharismarozie97@gmail.com")->send(new notifikasiKontrakKerja($datas));
        }
        else{
            $email = Mail::to("cikarozie97@gmail.com")->send(new notifikasiKontrakKerja($datas));
            
        }
        return $email;
        $this->info('Reminder Untuk Karyawan Yang Habis Kontrak');
    }
}
