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



class ProviderExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $results;
    protected $nor;
    

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
        return ['first_name', 'last_name', 'email', 'location', 'nickname', 'department', 'provider_type', 'english_level', 'hourly_rate', 'gender', 'tagline', 'description'];
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

                
                $drop_column = 'B';
                $provider_type = Helper::getFreelancerLevelList();
                $departments = Department::all();
                $locations = Location::all();
                $english_levels = Helper::getEnglishLevelList();
                
                foreach($departments as $key => $value)
                {
                    if($key == 0)
                    {
                        $configs = $value->title.'_'.$value->id;    
                    }
                    else
                    {
                        $configs = $configs.", ".$value->title.'_'.$value->id;
                    }
                }
                foreach($locations as $key => $value)
                {
                    if($key == 0)
                    {
                        $configs3 = $value->title.'_'.$value->id;    
                    }
                    else
                    {
                        $configs3 = $configs3.", ".$value->title.'_'.$value->id;
                    }
                }
                $count = 0;
                foreach($provider_type as $key => $value)
                {
                    if($count == 0)
                    {
                        $configs1 = $key; 
                        $count++;   
                    }
                    else
                    {
                        $configs1 = $configs1.", ".$key;
                    }
                }
                $count = 0;
                foreach($english_levels as $key => $value)
                {
                    if($count == 0)
                    {
                        $configs2 = $key; 
                        $count++;   
                    }
                    else
                    {
                        $configs2 = $configs2.", ".$key;
                    }
                }
                

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
                for ( $i = 2; $i <= $this->nor +1; $i ++ ) {
                    $objValidation = $sheet->getCell('F'.$i)->getDataValidation();
                    //$sheet->setCellValue('A'.$i, $industry);
                    //$sheet->setCellValue('B'.$i, $sector);
                    //$sheet->setCellValue('C'.$i, $position);
                
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

                    //freelancer type
                    $objValidation1 = $sheet->getCell('G'.$i)->getDataValidation();
                    $objValidation1->setType(DataValidation::TYPE_LIST);
                    $objValidation1->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation1->setAllowBlank(false);
                    $objValidation1->setShowInputMessage(true);
                    $objValidation1->setShowErrorMessage(true);
                    $objValidation1->setShowDropDown(true);
                    $objValidation1->setErrorTitle('Input error');
                    $objValidation1->setError('Value is not in list.');
                    $objValidation1->setPromptTitle('Pick from list');
                    $objValidation1->setPrompt('Please pick a value from the drop-down list.');

                    $objValidation1->setFormula1('"' . $configs1 . '"');
                    //English Level
                    $objValidation2 = $sheet->getCell('H'.$i)->getDataValidation();
                    $objValidation2->setType(DataValidation::TYPE_LIST);
                    $objValidation2->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation2->setAllowBlank(false);
                    $objValidation2->setShowInputMessage(true);
                    $objValidation2->setShowErrorMessage(true);
                    $objValidation2->setShowDropDown(true);
                    $objValidation2->setErrorTitle('Input error');
                    $objValidation2->setError('Value is not in list.');
                    $objValidation2->setPromptTitle('Pick from list');
                    $objValidation2->setPrompt('Please pick a value from the drop-down list.');

                    $objValidation2->setFormula1('"' . $configs2 . '"');
                    //Locations
                    $objValidation3 = $sheet->getCell('D'.$i)->getDataValidation();
                    $objValidation3->setType(DataValidation::TYPE_LIST);
                    $objValidation3->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation3->setAllowBlank(false);
                    $objValidation3->setShowInputMessage(true);
                    $objValidation3->setShowErrorMessage(true);
                    $objValidation3->setShowDropDown(true);
                    $objValidation3->setErrorTitle('Input error');
                    $objValidation3->setError('Value is not in list.');
                    $objValidation3->setPromptTitle('Pick from list');
                    $objValidation3->setPrompt('Please pick a value from the drop-down list.');

                    $objValidation3->setFormula1('"' . $configs3 . '"');


                }
     
            },
        ];
    }
}
