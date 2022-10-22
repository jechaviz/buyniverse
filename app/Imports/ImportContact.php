<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Employer;
use App\Contact;
use Session;

class ImportContact implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function getValidate($data){
        $rules = [
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.email' => 'required',
            '*.taxId' => 'required',
            
        ];
        $errmsg = [
            '*.first_name.required' => 'first name Cant be empty',
            '*.last_name.required' => 'last name Cant be empty',
            '*.email.required' => 'email Cant be empty',
            '*.taxId.required' => 'Tax Id Cant be empty',
        ];
      return Validator::make($data, $rules, $errmsg);
    }

    public function collection(Collection $rows)
    {
        /*$validator = $this->getValidate($rows->toArray());
        
        if ($validator->fails()) {
           
            return  redirect()->route('show_uploads')
                ->withErrors($validator)
                ->withInput();
        }*/
        foreach ($rows as $row) {
            if(User::where('email', $row['email'])->exists())
            {
                $user = User::where('email', $row['email'])->first();
                if(Employer::where('user_id', $user->id)->exists())
                {}
                else
                {
                    Session::flash('alert-class', 'failed');
                    Session::flash('message', 'Contact upload failed! '. $row['email']. ' doesnt Exists');
                    return  redirect()->route('show_uploads');
                }
            }
            else
            {
                Session::flash('alert-class', 'failed');
                Session::flash('message', 'Contact upload failed! '. $row['email']. ' doesnt Exists');
                return  redirect()->route('show_uploads');
            }
        }
        
        foreach ($rows as $row) {
            
            if(User::where('email', $row['email'])->exists())
            {
                //dd('exists');
                $user = User::where('email', $row['email'])->first();
                $employer = Employer::where('user_id', $user->id)->first();
                $department = explode('_',$row['department']);

                if(Contact::where('employer_id', $employer->id)->exists())
                {
                    $contact = Contact::where('employer_id', $employer->id)->first();
                    $contact->position = $row['position'];
                    $contact->department = $department[1];
                    $contact->skype = $row['skype'];
                    $contact->facebook = $row['facebook'];
                    $contact->twitter = $row['twitter'];
                    $contact->personalWebSite = $row['personalWebSite'];
                    $contact->save();
                }
                else
                {
                    $contact = Contact::create([
                        'employer_id' => $employer->id,
                        'position' => $row['position'],
                        'department' => $department[1],
                        'skype' => $row['skype'],
                        'facebook' => $row['facebook'],
                        'twitter' => $row['twitter'],
                        'personalWebSite' => $row['personalWebSite']
                    ]);
                }
            }
        }

        Session::flash('alert-class', 'success');
        Session::flash('message', 'Contacts Successfully Added !');
        return  redirect()->route('show_uploads');
    }
}
