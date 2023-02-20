<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Employee;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\DB;

class KaryawanExport implements FromCollection,WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

            },
            
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            // 'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            
        ];
    }

    public function headings(): array {
        return [
            ['Data Karyawan PT. Rapid Infrastruktur Indonesia'],
            ["NIK","Nama Karyawan","NPWP", "Divisi", "Jabatan", "Tanggal Bergabung", "Tanggal Awal Kontrak","Tanggal Selesai Kontrak", "Kontrak ke-", "Status Karyawan"]
        ];
    }

    public function collection()
    {
        return collect(DB::select("
            SELECT emp.nik, emp.nama as nama_karyawan, emp.npwp as npwp, divisi.nama as divisi, 
                jabatan.jenis_jabatan as jabatan, 
                IF(emp.date_joining != '', emp.date_joining, '-') as date_joining,
                IF(emp.status_karyawan = 1, '', max(k.tgl_mulai_kontrak)) as tgl_mulai,
                IF(emp.status_karyawan = 1, '', max(k.tgl_akhir_kontrak)) as tgl_akhir,
                IF(emp.status_karyawan = 1, '', max(k.perpanjangan_ke)) as kontrak_ke,
                (CASE 
                    WHEN emp.status_karyawan = '' THEN '-'
                    WHEN emp.status_karyawan = 0 THEN 'Kontrak'
                    ELSE 'Permanent'
                END) as status
                from karyawan as emp 
                INNER JOIN master_divisi as divisi ON emp.divisi_id = divisi.id 
                INNER JOIN master_jabatan as jabatan ON emp.jabatan_id = jabatan.id 
                LEFT OUTER JOIN kontrak_karyawan as k ON emp.nik = k.nik_karyawan
                GROUP BY emp.nik ORDER BY emp.nama
        "));
    }
}
