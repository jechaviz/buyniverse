<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Employer;
use Session;
use Illuminate\Support\Facades\Hash;

class ImportEmployer implements ToCollection, WithHeadingRow
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
        $validator = $this->getValidate($rows->toArray());
        
        if ($validator->fails()) {
           
            return  redirect()->route('show_uploads')
                ->withErrors($validator)
                ->withInput();
        }
        foreach ($rows as $row) {
            
            if(User::where('email', $row['email'])->exists())
            {
                //dd('exists');
                $user = User::where('email', $row['email'])->first();
                $user->first_name = $row['first_name'];
                $user->last_name = $row['last_name'];
                $user->nickname = $row['nickname'];
                $user->save();


                $profile = Employer::where('user_id', $user->id)->first();
                $profile->taxId = $row['taxId'];
                $profile->taxPayerType = $row['taxPayerType'];
                $profile->privateKey = $row['privateKey'];
                $profile->publicKey = $row['publicKey'];
                $profile->privateKeyPassword = $row['privateKeyPassword'];
                $profile->licence = $row['licence'];
                $profile->mode = $row['mode'];
                $profile->profile_id = $row['profile_id'];
                $profile->frontLetter = $row['frontLetter'];
                $profile->save();
                
            }            
            else
            {
                $user = User::create([
                    'email' => $row['email'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'slug' => $row['first_name'].'-'.$row['last_name'],
                    'nickname' => $row['nickname'],
                    'user_verified' => 1,
                    'password' => Hash::make('password')
                ]);
                $user->assignRole('employer');
                $profile = new Profile();
                $profile->user()->associate($user->id);
                
                $profile->user_id = $user->id;
                
                $employer = Employer::where('user_id', $user->id)->first();
                $employer->taxId = $row['taxId'];
                $employer->taxPayerType = $row['taxPayerType'];
                $employer->privateKey = $row['privateKey'];
                $employer->publicKey = $row['publicKey'];
                $employer->privateKeyPassword = $row['privateKeyPassword'];
                $employer->licence = $row['licence'];
                $employer->mode = $row['mode'];
                $employer->profile_id = $row['profile_id'];
                $employer->frontLetter = $row['frontLetter'];
                $employer->save();
            }
        }

        Session::flash('alert-class', 'success');
        Session::flash('message', 'Employer Successfully Added !');
        return  redirect()->route('show_uploads');
    }
}
