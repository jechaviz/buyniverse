<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Employer;
use App\Exports\ProviderExport;
use App\Exports\EmployerExport;
use App\Exports\AddressExport;
use App\Exports\ContactExport;
use App\Imports\ImportProvider;
use App\Imports\ImportEmployer;
use App\Imports\ImportAddress;
use App\Imports\ImportContact;
use App\Contact;
use App\Helper;
use Excel;
use Validator;

class UploadsController extends Controller
{
    public function show_uploads()
    {
        return view('back-end.admin.uploads.show');
    }
    public function provider_template()
    {
        ob_end_clean();
        return Excel::download(new ProviderExport(10), 'provider_template.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function employer_template()
    {
        ob_end_clean();
        return Excel::download(new EmployerExport(10), 'employer_template.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function address_template()
    {
        ob_end_clean();
        return Excel::download(new AddressExport(10), 'address_template.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function contact_template()
    {
        ob_end_clean();
        return Excel::download(new ContactExport(10), 'contact_template.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function getValidatei($data){
        $rules = [
            'excel_file'  => 'required|mimes:xls,xlsx'
        ];
        $errmsg = [
            'excel_file.required' => 'File is required.',
        ];
        return Validator::make($data, $rules, $errmsg);
    }

    public function upload_provider(Request $request)
    {
        //dd($request->all());
        $validator = $this->getValidatei($request->all());
        if ($validator->fails()) {
            return  redirect()->route('show_uploads')
                ->withErrors($validator)
                ->withInput();
        }
        $import = new ImportProvider;
        $path = $request->file('excel_file');
        $data = Excel::import($import, $path);
        
        //dd($data);
        return redirect()->route('show_uploads');        
    }

    public function upload_employer(Request $request)
    {
        //dd($request->all());
        $validator = $this->getValidatei($request->all());
        if ($validator->fails()) {
            return  redirect()->route('show_uploads')
                ->withErrors($validator)
                ->withInput();
        }
        $import = new ImportEmployer;
        $path = $request->file('excel_file');
        $data = Excel::import($import, $path);
        
        //dd($data);
        return redirect()->route('show_uploads');        
    }

    public function upload_address(Request $request)
    {
        //dd($request->all());
        $validator = $this->getValidatei($request->all());
        if ($validator->fails()) {
            return  redirect()->route('show_uploads')
                ->withErrors($validator)
                ->withInput();
        }
        $import = new ImportAddress;
        $path = $request->file('excel_file');
        $data = Excel::import($import, $path);
        
        //dd($data);
        return redirect()->route('show_uploads');        
    }

    public function upload_contact(Request $request)
    {
        //dd($request->all());
        $validator = $this->getValidatei($request->all());
        if ($validator->fails()) {
            return  redirect()->route('show_uploads')
                ->withErrors($validator)
                ->withInput();
        }
        $import = new ImportContact;
        $path = $request->file('excel_file');
        $data = Excel::import($import, $path);
        
        //dd($data);
        return redirect()->route('show_uploads');        
    }
    
    
    
}
