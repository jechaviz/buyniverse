<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Profile;
use Session;
use Illuminate\Support\Facades\Hash;
//use Validator;

class ImportProvider implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function getValidate($data){
        $rules = [
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.email' => 'required',
            '*.location' => 'required',
            '*.department' => 'required',
            '*.provider_type' => 'required',
            '*.english_level' => 'required',
            '*.tagline' => 'required',
            '*.description' => 'required',
        ];
        $errmsg = [
            '*.first_name.required' => 'first name Cant be empty',
            '*.last_name.required' => 'last name Cant be empty',
            '*.email.required' => 'email Cant be empty',
            '*.location.required' => 'location Cant be empty',
            '*.department.required' => 'Department Cant be empty',
            '*.provider_type.required' => 'provider type Cant be empty',
            '*.english_level.required' => 'english level Cant be empty',
            '*.tagline.required' => 'tagline Cant be empty',
            '*.description.required' => 'description Cant be empty',            
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
            $location = explode('_',$row['location']);
            $department = explode('_',$row['department']);

            if(User::where('email', $row['email'])->exists())
            {
                //dd('exists');
                $user = User::where('email', $row['email'])->first();
                $user->first_name = $row['first_name'];
                $user->last_name = $row['last_name'];
                $user->location_id = $location[1];
                $user->nickname = $row['nickname'];
                $user->save();

                $profile = Profile::where('user_id', $user->id)->first();
                $profile->department_id = $department[1];
                $profile->provider_type = $row['provider_type'];
                $profile->english_level = $row['english_level'];
                $profile->hourly_rate = $row['hourly_rate'];
                $profile->gender = $row['gender'];
                $profile->tagline = $row['tagline'];
                $profile->description = $row['description'];
                $profile->save();
                
            }            
            else
            {
                $user = User::create([
                    'email' => $row['email'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'slug' => $row['first_name'].'-'.$row['last_name'],
                    'location_id' => $location[1],
                    'nickname' => $row['nickname'],
                    'user_verified' => 1,
                    'password' => Hash::make('password')
                ]);
                $user->assignRole('provider');
                $profile = new Profile();
                $profile->user()->associate($user->id);
                
                $profile->user_id = $user->id;
                $profile->department_id = $department[1];
                $profile->provider_type = $row['provider_type'];
                $profile->english_level = $row['english_level'];
                $profile->hourly_rate = $row['hourly_rate'];
                $profile->gender = $row['gender'];
                $profile->tagline = $row['tagline'];
                $profile->description = $row['description'];
                $profile->save();
            }
        }

        Session::flash('alert-class', 'success');
        Session::flash('message', 'Providers Successfully Added !');
        return  redirect()->route('show_uploads');
    }
}
