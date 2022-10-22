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

class EmployerExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison
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
        return ['first_name', 'last_name', 'email', 'location', 'nickname', 'taxId', 'taxPayerType', 'privateKey', 'publicKey', 'privateKeyPassword', 'licence', 'mode', 'profile_id', 'frontLetter'];
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

                
                $configs = "no_taxerperson, taxer_person, taxer_company";
                
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
                for ( $i = 2; $i <= $this->nor +1; $i ++ ) {
                    $objValidation = $sheet->getCell('L'.$i)->getDataValidation();
                    $objValidation->setType(DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');

                    $objValidation->setFormula1('"' . $configs . '"');

                }
     
            },
        ];
    }
}
