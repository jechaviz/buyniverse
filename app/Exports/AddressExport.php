<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use App\Department;
use App\Helper;
use App\Location;

class AddressExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison
{
    function __construct($nor) {
        $this->nor = $nor;
    }

    public function collection()
    {
        //return collect();
        return $this->results;
    }
    public function headings(): array
    {
        //location, department, must be dropdown
        return ['email', 'type', 'street', 'externalNumber', 'internalNumber', 'neighborhood', 'locality', 'reference', 'city', 'state', 'country', 'zipCode', 'latitude', 'longitude', 'website'];
    }
    public function registerEvents(): array
    {
        $this->results = collect();
        
                //dd($configs);
        //dd($positions);
        //$len = count($positions);
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $sheet = $event->sheet;
                
                $sheet->getDelegate()->getColumnDimension('A')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('G')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('H')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('H')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('J')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('K')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('L')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('M')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('N')->setWidth(30);
                $sheet->getDelegate()->getColumnDimension('O')->setWidth(30);
                
            },
        ];
    }
}
