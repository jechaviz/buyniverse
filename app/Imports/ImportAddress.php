<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Employer;
use App\Address;
use Session;

class ImportAddress implements ToCollection, WithHeadingRow
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
                    Session::flash('message', 'Address upload failed! '. $row['email']. ' doesnt Exists');
                    return  redirect()->route('show_uploads');
                }
            }
            else
            {
                Session::flash('alert-class', 'failed');
                Session::flash('message', 'Address upload failed! '. $row['email']. ' doesnt Exists');
                return  redirect()->route('show_uploads');
            }
        }
        
        foreach ($rows as $row) {
            
            if(User::where('email', $row['email'])->exists())
            {
                //dd('exists');
                $user = User::where('email', $row['email'])->first();
                $employer = Employer::where('user_id', $user->id)->first();

                if(Address::where('employer_id', $employer->id)->exists())
                {
                    $address = Address::where('employer_id', $employer->id)->first();
                    $address->type = $row['type'];
                    $address->street = $row['street'];
                    $address->externalNumber = $row['externalNumber'];
                    $address->internalNumber = $row['internalNumber'];
                    $address->neighborhood = $row['neighborhood'];
                    $address->locality = $row['locality'];
                    $address->reference = $row['reference'];
                    $address->city = $row['city'];
                    $address->state = $row['state'];
                    $address->country = $row['country'];
                    $address->zipCode = $row['zipCode'];
                    $address->latitude = $row['latitude'];
                    $address->longitude = $row['longitude'];
                    $address->website = $row['website'];
                    $address->save();
                }
                else
                {
                    $address = Address::create([
                        'employer_id' => $employer->id,
                        'type' => $row['type'],
                        'street' => $row['street'],
                        'externalNumber' => $row['externalNumber'],
                        'internalNumber' => $row['internalNumber'],
                        'neighborhood' => $row['neighborhood'],
                        'city' => $row['city'],
                        'state' => $row['state'],
                        'country' => $row['country'],
                        'zipCode' => $row['zipCode'],
                        'latitude' => $row['latitude'],
                        'longitude' => $row['longitude'],
                        'website' => $row['website'],
                        'locality' => $row['locality'],
                        'reference' => $row['reference']                        
                    ]);
                }
            }
        }

        Session::flash('alert-class', 'success');
        Session::flash('message', 'Address Successfully Added !');
        return  redirect()->route('show_uploads');
    }
}
