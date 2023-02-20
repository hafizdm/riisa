<?php

namespace App\Exports;
use App\TimeSheetUser;
use Carbon\Carbon;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SummaryPersonalTimesheet implements FromView, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $id;
    protected $data;
    protected $employee;

    function __construct($id, $data, $employee) {
        $this->id = $id;
        $this->data = $data;
        $this->employee = $employee;
    }

    public function view(): View{
        $idss = $this->id;
        $datas = $this->data;
        $employees = $this->employee;
        $hari_libur = DB::table('master_libur')->get();
        $karyawan = $employees;
        $summary = $datas;
        $variabel = compact("karyawan","summary","hari_libur");

        return view('timesheet/user/export_timesheet')->with($variabel);
    }

    public function registerEvents(): array
    {
    
        return [
            AfterSheet::class    => function(AfterSheet $event) {
        
                $styleArray = [
                    'font' => [
                        'bold'  =>  true,
                    ], 
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                            'color' => ['argb' => '000000']
                        ]
                    ], 
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ],
                ];

                $styleArray2 = [
                    'font' => [
                        'size'  =>'10',
                    ], 
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000']
                        ]
                    ],

                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ],

                ];
                

                $styleArray3 = [
                    'font' => [
                        'bold'  =>  true,
                    ], 
                ];

                $styleArray4 = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#808080']
                        ]
                    ]
                ];

                

                $cellNama   = 'C4:E4';
                $cellNik    = 'C5:E5';
                $cellPosisi = 'C6:E6';
                $bg = 'B4:B6';
                $outline = 'B4:E6';

                $cellHeader = 'A1:J1';
                $cellHeader2 = 'A2:J2';
                $to = $event->sheet->getDelegate()->getHighestRowAndColumn();
                $cellRange = 'B9:J9'; // All headers
                
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getColor()
                             ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                             ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                             ->getStartColor()->setARGB('FF17a2b8');

                $event->sheet->getDelegate()->getStyle($bg)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FF17a2b8');
                           
                $event->sheet->getStyle($cellHeader)->applyFromArray(array(
                    'fill' => array(
                        'type'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => array('rgb' => '#D7D7D7')
                    )
                ));

                $event->sheet->setAutoFilter($cellRange);
                // $event->sheet->setAutoSize(true);
                // $event->sheet->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
                $event->sheet->getDelegate()->getStyle('B4')->applyFromArray($styleArray3);
                $event->sheet->getDelegate()->getStyle('B5')->applyFromArray($styleArray3);
                $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($styleArray3);
                $event->sheet->getDelegate()->mergeCells($cellHeader);
                $event->sheet->getDelegate()->mergeCells($cellHeader2);
                $event->sheet->getDelegate()->mergeCells($cellNama);
                $event->sheet->getDelegate()->mergeCells($cellNik);
                $event->sheet->getDelegate()->mergeCells($cellPosisi);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle($outline)->applyFromArray($styleArray4);
                $event->sheet->getDelegate()->getStyle('B9:J9')->getFont()->setSize(11);

                $event->sheet->getDelegate()->getStyle('B10:'.'J'.$to['row'])->applyFromArray($styleArray2);
            },
        ];
    }

}
