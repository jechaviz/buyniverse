<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\TeamInvite;
use App\Mail\UserInvite;
use App\Mail\Approverinvite;
use App\Mail\Approveruserinvite;
use App\Mail\InviteRaw;
use App\Mail\Contestend;
use App\Job;
use App\User;
use App\Profile;
use App\Helper;
use App\Quiz;
use App\Job_quiz;
use Auth;
use App\Language;
use App\Skill;
use App\Team;
use App\Approver;
use App\English_level;
use App\Provider_type;
use App\Sub_skill;
use App\Sub_catetory; 
use App\Sub_job_skill;
use App\Sub_job_cat;
use App\Providerinvite;
use App\Live_contest;
use App\Live_contest_participant;
use App\Proposal;
use App\Contest_bid;
use App\JobInvite;
use App\Catable;
use App\Category;
use DB;
use Illuminate\Support\Facades\Hash;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobtitle($id)
    {
        $job = Job::find($id);
        $idu = Auth::user()->id;
        $data['title'] = $job->title;
        $data['canedit'] = ($job->user_id == $idu) ? true : false;        
        return $data;
    }
    public function postjobtitle(Request $request)
    {
        //dd($request->all());
        $job = Job::find($request->job_id);
        $job->title = $request->title;
        $job->save();
        return true;
    }

    public function sendinvitation($id)
    {
        $ids = explode('-', $id);
        if(JobInvite::where('job_id', $ids[0])->where('user_id', $ids[1])->exists())
        {}
        else
        {
            $idu = Auth::user()->id;
            $user = User::find($idu);
            //dd(secEnv('MAIL_USERNAME'), secEnv('MAIL_PASSWORD'));
            $invite = new JobInvite;
            $invite->job_id = $ids[0];
            $invite->user_id = $ids[1];
            $invite->save();
            $user1 = User::find($ids[1]);
            $job = Job::find($ids[0]);
            $email_text = "Hello Sir/Mam,
            I want to invite you to make a proposal for my project.
            
            For the further information, please click the invitation below.
            
            {Link}
            
            Thanks in advance,
            {name}";

            $name = $user->first_name.' '.$user->last_name;
            $link = '<a href="https://buyniverse.com/job/'. $job->slug .'">Link</a>';
            $messagex = str_replace('{name}', $name, $email_text);
            $messagex = str_replace('{Link}', $link, $messagex);
            //dd($messagex, $link);
            $message1 = str_replace(array("\r","\n",'\r','\n'), "<br>", $messagex);
            $message1 = str_replace(array("<br><br>"), "<br>", $message1);
            Mail::to($user1->email)->send(new InviteRaw($message1));
            Mail::to('sadiqueali786@gmail.com')->send(new InviteRaw($message1));
        }
        return true;
    }

    public function updateusercategory($id)
    {
        $user = Auth::user()->id;
        if(DB::table('catables')->where('catable_id', $user)->where('category_id', $id)->where('catable_type', 'App\User')->exists())
        {}
        else
        {   
            DB::table('catables')->insert([
                'category_id' => $id,
                'catable_id' => $user,
                'catable_type' => 'App\User'
            ]);
        }
        return true;
    }

    public function getusercategory()
    {
        //dd('Test');
        $user = Auth::user()->id;
        
        $categories = Catable::where('catable_id', $user)->where('catable_type', 'App\User')->get();
        foreach($categories as $cat)
        {
            $name = Category::find($cat->category_id);
            $cat->name = $name->title;
        }
        //$categories = DB::table('catables');
        //dd($categories);
        return $categories;
    }

    public function deleteusercategory($id)
    {
        if(DB::table('catables')->where('id', $id)->exists())
            DB::table('catables')->where('id', $id)->delete();
        
        return true;
    }


    public function get_search($id)
    {
        $data['skills'] = Skill::pluck('title', 'id');
        $data['categories'] = Category::pluck('title', 'id');
        $search_locations = null;
        $search_employees = null;
        $search_skills = null;
        $search_hourly_rates = null;
        $search_freelaner_types = null;
        $search_english_levels = null;
        $search_languages = null;
        $search_category = DB::table('catables')->where('catable_id', $id)->where('catable_type', 'App\Job')->select('category_id')->get();
        //dd($job);

        //Providers listing
        $keyword = $request->query('s', '');
        $search =  User::getSearchResult1(
            'provider',
            $keyword,
            $search_locations,
            $search_employees,
            $search_skills,
            $search_hourly_rates,
            $search_freelaner_types,
            $search_english_levels,
            $search_languages,
            $search_category
        );
        $users = count($search['users']) > 0 ? $search['users'] : '';

        if($users)
        {
            foreach($users as $user)
            {
                $user->user_image = !empty($user->profile->avater) ?
                                '/uploads/users/'.$user->id.'/'.$user->profile->avater :
                                'images/user.jpg';
                $user->flag = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :
                        '/images/img-01.png';
                $feedbacks = \App\Review::select('feedback')->where('receiver_id', $user->id)->count();
                $avg_rating = \App\Review::where('receiver_id', $user->id)->sum('avg_rating');
                $user->rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                $reviews = \App\Review::where('receiver_id', $user->id)->get();
                $user->stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                $user->average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                $user->verified_user = \App\User::select('user_verified')->where('id', $user->id)->pluck('user_verified')->first();
                $user->save_provider = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $user->badge = Helper::getUserBadge($user->id);
                if (!empty($enable_package) && $enable_package === 'true') {
                    $user->feature_class = (!empty($badge) && $user->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                    $user->badge_color = !empty($badge) ? $badge->color : '';
                    $user->badge_img  = !empty($badge) ? $badge->image : '';
                } else {
                    $user->feature_class = 'wt-exp';
                    $user->badge_color = '';
                    $user->badge_img    = '';
                }
                $user->image =  Helper::getImageWithSize('uploads/users/'.$user->id, $user->profile->avater, 'listing');
                $user->username = Helper::getUserName($user->id);
                $user->tagline = $user->profile->tagline;
                $user->hourly_rate = $user->profile->hourly_rate;
                $currency = \App\SiteManagement::getMetaValue('commision');
                $user->symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                if($user->location)
                $user->location_title = $user->location->title;
                if($user->profile)
                $user->description = $user->profile->description;
                $user->skills = $user->skills;

                $categories = Catable::where('catable_id', $user->id)->where('catable_type', 'App\User')->get();
                foreach($categories as $cat)
                {
                    $name = Category::find($cat->category_id);
                    //dd($name, $cat);
                    if($name)
                    $cat->name = $name->title;
                    else
                    $cat->name = null;
                }

                $user->categories = $categories;

                if(JobInvite::where('job_id', $id)->where('user_id', $user->id)->exists())
                    $user->invitation = true;
                else
                    $user->invitation = false;
            }
        }
        $data['keyword'] = '';
        $data['users'] = $users;
        
        return $data;
    }

    public function get_provider_search()
    {
        $data['skills'] = Skill::pluck('title', 'id');
        $data['categories'] = Category::pluck('title', 'id');
        $search_locations = null;
        $search_employees = null;
        $search_skills = null;
        $search_hourly_rates = null;
        $search_freelaner_types = null;
        $search_english_levels = null;
        $search_languages = null;
        $search_category = null;//DB::table('catables')->where('catable_id', $id)->where('catable_type', 'App\Job')->select('category_id')->get();
        //dd($job);

        //Providers listing
        $keyword = $request->query('s', '');
        $search =  User::getSearchResult1(
            'provider',
            $keyword,
            $search_locations,
            $search_employees,
            $search_skills,
            $search_hourly_rates,
            $search_freelaner_types,
            $search_english_levels,
            $search_languages,
            $search_category
        );
        $users = count($search['users']) > 0 ? $search['users'] : '';

        if($users)
        {
            foreach($users as $user)
            {
                $user->user_image = !empty($user->profile->avater) ?
                                '/uploads/users/'.$user->id.'/'.$user->profile->avater :
                                'images/user.jpg';
                $user->flag = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :
                        '/images/img-01.png';
                $feedbacks = \App\Review::select('feedback')->where('receiver_id', $user->id)->count();
                $avg_rating = \App\Review::where('receiver_id', $user->id)->sum('avg_rating');
                $user->rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                $reviews = \App\Review::where('receiver_id', $user->id)->get();
                $user->stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                $user->average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                $user->verified_user = \App\User::select('user_verified')->where('id', $user->id)->pluck('user_verified')->first();
                $user->save_provider = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $user->badge = Helper::getUserBadge($user->id);
                if (!empty($enable_package) && $enable_package === 'true') {
                    $user->feature_class = (!empty($badge) && $user->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                    $user->badge_color = !empty($badge) ? $badge->color : '';
                    $user->badge_img  = !empty($badge) ? $badge->image : '';
                } else {
                    $user->feature_class = 'wt-exp';
                    $user->badge_color = '';
                    $user->badge_img    = '';
                }
                $user->image =  Helper::getImageWithSize('uploads/users/'.$user->id, $user->profile->avater, 'listing');
                $user->username = Helper::getUserName($user->id);
                $user->tagline = $user->profile->tagline;
                $user->hourly_rate = $user->profile->hourly_rate;
                $currency = \App\SiteManagement::getMetaValue('commision');
                $user->symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                if($user->location)
                $user->location_title = $user->location->title;
                if($user->profile)
                $user->description = $user->profile->description;
                $user->skills = $user->skills;

                $categories = Catable::where('catable_id', $user->id)->where('catable_type', 'App\User')->get();
                foreach($categories as $cat)
                {
                    $name = Category::find($cat->category_id);
                    if($name)
                    $cat->name = $name->title;
                    else
                    $cat->name = null;
                }

                $user->categories = $categories;

                /*if(JobInvite::where('job_id', $id)->where('user_id', $user->id)->exists())
                    $user->invitation = true;
                else
                    $user->invitation = false;*/
            }
        }
        $data['keyword'] = '';
        $data['users'] = $users;
        
        return $data;
    }

    public function get_search_invited($id)
    {
        $data['skills'] = Skill::pluck('title', 'id');
        $data['categories'] = Category::pluck('title', 'id');
        $search_locations = null;
        $search_employees = null;
        $search_skills = null;
        $search_hourly_rates = null;
        $search_freelaner_types = null;
        $search_english_levels = null;
        $search_languages = null;

        //Providers listing
        $keyword = $request->query('s', '');
        $search =  User::getSearchResult(
            'provider',
            $keyword,
            $search_locations,
            $search_employees,
            $search_skills,
            $search_hourly_rates,
            $search_freelaner_types,
            $search_english_levels,
            $search_languages
        );
        $users = count($search['users']) > 0 ? $search['users'] : '';

        if($users)
        {
            foreach($users as $user)
            {
                $user->user_image = !empty($user->profile->avater) ?
                                '/uploads/users/'.$user->id.'/'.$user->profile->avater :
                                'images/user.jpg';
                $user->flag = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :
                        '/images/img-01.png';
                $feedbacks = \App\Review::select('feedback')->where('receiver_id', $user->id)->count();
                $avg_rating = \App\Review::where('receiver_id', $user->id)->sum('avg_rating');
                $user->rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                $reviews = \App\Review::where('receiver_id', $user->id)->get();
                $user->stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                $user->average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                $user->verified_user = \App\User::select('user_verified')->where('id', $user->id)->pluck('user_verified')->first();
                $user->save_provider = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $user->badge = Helper::getUserBadge($user->id);
                if (!empty($enable_package) && $enable_package === 'true') {
                    $user->feature_class = (!empty($badge) && $user->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                    $user->badge_color = !empty($badge) ? $badge->color : '';
                    $user->badge_img  = !empty($badge) ? $badge->image : '';
                } else {
                    $user->feature_class = 'wt-exp';
                    $user->badge_color = '';
                    $user->badge_img    = '';
                }
                $user->image =  Helper::getImageWithSize('uploads/users/'.$user->id, $user->profile->avater, 'listing');
                $user->username = Helper::getUserName($user->id);
                $user->tagline = $user->profile->tagline;
                $user->hourly_rate = $user->profile->hourly_rate;
                $currency = \App\SiteManagement::getMetaValue('commision');
                $user->symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                if($user->location)
                $user->location_title = $user->location->title;
                if($user->profile)
                $user->description = $user->profile->description;
                $user->skills = $user->skills;

                $categories = Catable::where('catable_id', $user->id)->where('catable_type', 'App\User')->get();
                foreach($categories as $cat)
                {
                    $name = Category::find($cat->category_id);
                    if($name)
                    $cat->name = $name->title;
                    else
                    $cat->name = null;
                }

                $user->categories = $categories;

                if(JobInvite::where('job_id', $id)->where('user_id', $user->id)->exists())
                    $user->invitation = true;
                else
                    $user->invitation = false;
            }
        }
        $data['keyword'] = '';
        $data['users'] = $users;
        
        return $data;
    }
    public function search_provider_filter(Request $request)
    {
        //dd($request->all());
        $data['skills'] = Skill::pluck('title', 'id');
        $data['categories'] = Category::pluck('title', 'id');
        $search_locations = null;
        $search_employees = null;
        $search_skills = $request->skill;
        $search_hourly_rates = null;
        $search_freelaner_types = null;
        $search_english_levels = null;
        $search_languages = null;
        $search_category = $request->category;//DB::table('catables')->where('catable_id', $id)->where('catable_type', 'App\Job')->select('category_id')->get();
        //Providers listing
        $keyword = !empty($request->s) ? $request->s : '';
        $search =  User::getSearchResult1(
            'provider',
            $keyword,
            $search_locations,
            $search_employees,
            $search_skills,
            $search_hourly_rates,
            $search_freelaner_types,
            $search_english_levels,
            $search_languages,
            $search_category
        );
        $users = count($search['users']) > 0 ? $search['users'] : '';
        //dd($users, $keyword, $request->s);
        
        if($users)
        {
            foreach($users as $user)
            {
                $user->user_image = !empty($user->profile->avater) ?
                                '/uploads/users/'.$user->id.'/'.$user->profile->avater :
                                'images/user.jpg';
                $user->flag = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :
                        '/images/img-01.png';
                $feedbacks = \App\Review::select('feedback')->where('receiver_id', $user->id)->count();
                $avg_rating = \App\Review::where('receiver_id', $user->id)->sum('avg_rating');
                $user->rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                $reviews = \App\Review::where('receiver_id', $user->id)->get();
                $user->stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                $user->average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                $user->verified_user = \App\User::select('user_verified')->where('id', $user->id)->pluck('user_verified')->first();
                $user->save_provider = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $user->badge = Helper::getUserBadge($user->id);
                if (!empty($enable_package) && $enable_package === 'true') {
                    $user->feature_class = (!empty($badge) && $user->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                    $user->badge_color = !empty($badge) ? $badge->color : '';
                    $user->badge_img  = !empty($badge) ? $badge->image : '';
                } else {
                    $user->feature_class = 'wt-exp';
                    $user->badge_color = '';
                    $user->badge_img    = '';
                }
                $user->image =  Helper::getImageWithSize('uploads/users/'.$user->id, $user->profile->avater, 'listing');
                $user->username = Helper::getUserName($user->id);
                $user->tagline = $user->profile->tagline;
                $user->hourly_rate = $user->profile->hourly_rate;
                $currency = \App\SiteManagement::getMetaValue('commision');
                $user->symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                if($user->location)
                $user->location_title = $user->location->title;
                if($user->profile)
                $user->description = $user->profile->description;

                $categories = Catable::where('catable_id', $user->id)->where('catable_type', 'App\User')->get();
                foreach($categories as $cat)
                {
                    $name = Category::find($cat->category_id);
                    if($name)
                    $cat->name = $name->title;
                    else
                    $cat->name = null;
                }

                $user->categories = $categories;

                
            }
        }
        $s_cat = array();
        $s_skill = array();
        if($search_category)
        {
            foreach($search_category as $cat)
            {
                array_push($s_cat, $cat);
                $cats = Category::find($cat);
                if($cats)
                {
                    foreach($cats->skills as $value)
                    array_push($s_skill, $value->id);
                }
            }
        }
        
        if($search_skills)
        {
            foreach($search_skills as $skill)
            {
                array_push($s_skill, $skill);
                /*$skills = Skill::find($skill);
                if($skills)
                {
                    foreach($skills->category as $value)
                    array_push($s_cat, $value->id);
                }*/           
            }
        }
        
        $data['keyword'] = $keyword;
        $data['users'] = $users;
        $data['category'] = array_unique($s_cat);
        $data['skill'] = array_unique($s_skill);
        //dd($data['category'], $data['skills']); 
        return $data;
    }
    public function search_filter(Request $request, $id)
    {
        //dd($request->all());
        $data['skills'] = Skill::pluck('title', 'id');
        $data['categories'] = Category::pluck('title', 'id');
        $search_locations = null;
        $search_employees = null;
        $search_skills = $request->skill;
        $search_hourly_rates = null;
        $search_freelaner_types = null;
        $search_english_levels = null;
        $search_languages = null;
        $search_category = $request->category;//DB::table('catables')->where('catable_id', $id)->where('catable_type', 'App\Job')->select('category_id')->get();
        //Providers listing
        $keyword = !empty($request->s) ? $request->s : '';
        $search =  User::getSearchResult1(
            'provider',
            $keyword,
            $search_locations,
            $search_employees,
            $search_skills,
            $search_hourly_rates,
            $search_freelaner_types,
            $search_english_levels,
            $search_languages,
            $search_category
        );
        $users = count($search['users']) > 0 ? $search['users'] : '';
        //dd($users, $keyword, $request->s);
        
        if($users)
        {
            foreach($users as $user)
            {
                $user->user_image = !empty($user->profile->avater) ?
                                '/uploads/users/'.$user->id.'/'.$user->profile->avater :
                                'images/user.jpg';
                $user->flag = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :
                        '/images/img-01.png';
                $feedbacks = \App\Review::select('feedback')->where('receiver_id', $user->id)->count();
                $avg_rating = \App\Review::where('receiver_id', $user->id)->sum('avg_rating');
                $user->rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                $reviews = \App\Review::where('receiver_id', $user->id)->get();
                $user->stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                $user->average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                $user->verified_user = \App\User::select('user_verified')->where('id', $user->id)->pluck('user_verified')->first();
                $user->save_provider = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $user->badge = Helper::getUserBadge($user->id);
                if (!empty($enable_package) && $enable_package === 'true') {
                    $user->feature_class = (!empty($badge) && $user->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                    $user->badge_color = !empty($badge) ? $badge->color : '';
                    $user->badge_img  = !empty($badge) ? $badge->image : '';
                } else {
                    $user->feature_class = 'wt-exp';
                    $user->badge_color = '';
                    $user->badge_img    = '';
                }
                $user->image =  Helper::getImageWithSize('uploads/users/'.$user->id, $user->profile->avater, 'listing');
                $user->username = Helper::getUserName($user->id);
                $user->tagline = $user->profile->tagline;
                $user->hourly_rate = $user->profile->hourly_rate;
                $currency = \App\SiteManagement::getMetaValue('commision');
                $user->symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                if($user->location)
                $user->location_title = $user->location->title;
                if($user->profile)
                $user->description = $user->profile->description;

                $categories = Catable::where('catable_id', $user->id)->where('catable_type', 'App\User')->get();
                foreach($categories as $cat)
                {
                    $name = Category::find($cat->category_id);
                    if($name)
                    $cat->name = $name->title;
                    else
                    $cat->name = null;
                }

                $user->categories = $categories;

                if(JobInvite::where('job_id', $id)->where('user_id', $user->id)->exists())
                    $user->invitation = true;
                else
                    $user->invitation = false;
            }
        }
        $s_cat = array();
        $s_skill = array();
        if($search_category)
        {
            foreach($search_category as $cat)
            {
                array_push($s_cat, $cat);
                $cats = Category::find($cat);
                if($cats)
                {
                    foreach($cats->skills as $value)
                    array_push($s_skill, $value->id);
                }
            }
        }
        
        if($search_skills)
        {
            foreach($search_skills as $skill)
            {
                array_push($s_skill, $skill);
                /*$skills = Skill::find($skill);
                if($skills)
                {
                    foreach($skills->category as $value)
                    array_push($s_skill, $value->id);
                }*/           
            }
        }
        
        $data['keyword'] = $keyword;
        $data['users'] = $users;
        $data['category'] = array_unique($s_cat);
        $data['skill'] = array_unique($s_skill);
        //dd($data['category'], $data['skills']); 
        return $data;
    }
    public function index()
    {
        //
    }
    public function updatecurrency($id)
    {
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->currency = $ids[1];
        $job->save(); 
        return true;
    }

    public function updatecategory($id)
    {
        $ids = explode('-', $id);
        //dd($id);
        if(DB::table('catables')->where('catable_id', $ids[0])->where('category_id', $ids[1])->where('catable_type', 'App\Job')->exists())
        {}
        else
        {   
            DB::table('catables')->insert([
                'category_id' => $ids[1],
                'catable_id' => $ids[0],
                'catable_type' => 'App\Job'
            ]);
        }
        return true;
    }

    public function deletecategory($id)
    {
        $ids = explode('-', $id);
        
        if(DB::table('catables')->where('catable_id', $ids[0])->where('category_id', $ids[1])->where('catable_type', 'App\Job')->exists())
            DB::table('catables')->where('catable_id', $ids[0])->where('category_id', $ids[1])->where('catable_type', 'App\Job')->delete();

        return true;
    }

    public function getcontest($id)
    {
        $contest = Live_contest::find($id); 
        $job = Job::find($contest->job_id);
        $user_id = Auth::user()->id;
        if(Live_contest_participant::where('live_id', $contest->id)->where('user_id', $user_id)->exists() )
        {            
            $contest_user = Live_contest_participant::where('live_id', $contest->id)->get();
            $rank = 1;
            foreach($contest_user as $value)
            {
                $user = User::find($value->user_id);
                $name = $user->first_name.' '.$user->last_name;
                $value->nickname = $user->nickname;
                $value->name = $name;
                $proposal = Proposal::where('job_id', $contest->job_id)->where('provider_id', $value->user_id)->first();
                $bid = $proposal->amount;
                $value->bid = $bid;
                
            }
            $contest_user1 = $contest_user->sortBy('bid');
            
            foreach($contest_user1 as $value)
            {
                $value->rank = $rank;
                $user = User::find($value->user_id);
                if($user_id == $user->id)
                {
                    $your_bid = $value->bid;
                    $your_rank = $rank;
                }
                if($rank == 1)
                    $best_bid = $value->bid;
                    
                $rank++;
            }
            //dd($contest_user1);
            return response()->json(['contest' => $contest, 'your_bid' => $your_bid, 'your_rank' => $your_rank, 'best_bid' => $best_bid, 'contest_user1' => $contest_user1]);
        }
        else
            return view('errors.503');
        
    }
    public function find_proposal($job)
    {
        $best = null;
        $temp = 0;
        $proposals = Proposal::where('job_id', $job)->get();
        foreach($proposals as $value)
        {
            if($temp == 0)
            {
                $best = $value;
                $temp = $value->amount;
                
            }                
            else
            {
                if($value->amount < $temp )
                {
                    $best = $value;
                    $temp = $value->amount;
                }
            }
        }        
        return $best;
    }
    public function newbid($id)
    {
        $ids = explode('-', $id);
        $user = Auth::user();
        $contest = Live_contest::find($ids[1]);
        $job = Job::find($contest->job_id);
        $best_proposal = $this->find_proposal($job->id);
        $bid = $ids[0];
        if($ids[0] < $best_proposal->amount)
        {
            $proposal = Proposal::where('job_id', $contest->job_id)->where('provider_id', $user->id)->first();
            $proposal->amount = $bid;
            $contest_bid = new Contest_bid;
            $contest_bid->bid = $bid;
            $contest_bid->contest_id = $contest->id;
            $contest_bid->user_id = $user->id;
            $contest_bid->status = 0;
            $contest_bid->save();
            $contest->flag = 1;
            $live = Live_contest_participant::where('live_id', $contest->id)->get();
            //dd($live);
            foreach($live as $value)
            {
                
                $value->status = 'yes';
                $value->save();
            }
            $contest->save();
            $proposal->save();
            return 'Your bid is updated. Now new bid is '.$contest_bid->bid;
        }
        else
            return 'Amount is above the best bid. please put low amount';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        //dd(Auth::user());
        $idu = Auth::user()->id;
        $ids = explode('-', $id);
        
        $job = Job::where('id', $ids[0])->get();
        $user = User::find($idu);
        if($job[0]->currency)
        {
            $currency = Helper::currencyList($job[0]->currency);
            $job[0]->curr = $currency;
        }
        
        $catable = $job[0]->categories;
        $job[0]->categories = $catable;
        //dd($catable);
        $email = $user->email;
        //dd($email);
        //dd(auth('api')->user());
        $job_id = Job::where('id', $ids[0])->first();
        if(Team::where('email', $email)->where('job_id', $job_id->id)->exists())
        {
            
            $team = Team::where('email', $email)->where('job_id', $job_id->id)->first();
            //dd($team);
            //$job->approver = $approver;
            $permission = $team->permission;
            //dd($permission);
        }
        elseif($job_id->user_id == $ids[1])
        {
            $permission = 2;
        }
        else{
            //dd($permission);
            $permission = 1;
        }
        
        if(!$permission)
        {
            $permission = 1;
        }

        //dd($job);
        $quizzes = Job_quiz::where('job_id', $ids[0])->get();
        foreach($quizzes as $quiz)
        {
            $quizx = Quiz::find($quiz->quiz_id);
            $quiz->title = $quizx->title;
        }
        //approver 

        //$job->quizzes = json($quizzes);
        //dd($job);
        return response()->json(['job' => $job, 'quizzes' => $quizzes, 'permission' => $permission]);
    }
    public function Language()
    {
        $languages = Language::pluck('title', 'id');
        return $languages;
    }
    public function Skill($id)
    {
        //dd('test');
        if($id == 'x')
            $skills = Skill::pluck('title', 'id');
        else
        {
            $job = Job::find($id);
            $skills = null;
            $categories = $job->categories;
            foreach($categories as $key => $cat)
            {                
                $skill = $cat->skills;
                if($skills == null)
                {   
                    $skills = $skill;
                }    
                else
                {
                    $skills = $skills->merge($skill);
                }
                
            }
            
        }
        
        return $skills;
    }
    public function getsubskill($id)
    {
        $sub = Sub_skill::where('skill_id', $id)->get();
        return $sub;
    }
    public function getskillstatus($id)
    {
        $ids = explode('-', $id);
        if(Sub_job_skill::where('job_id', $ids[0])->where('sub_skill_id', $ids[1])->exists())
            return 1;
        else
            return 0;
    }
    public function getcatstatus($id)
    {
        $ids = explode('-', $id);
        if(Sub_job_cat::where('job_id', $ids[0])->where('sub_cat_id', $ids[1])->exists())
            return 1;
        else
            return 0;
    }
    public function getsubcategory($id)
    {
        $sub = Sub_catetory::where('category_id', $id)->get();
        return $sub;
    }
    public function getLanguages($id)
    {
        $job = Job::find($id);
        $lang = $job->languages;
        return $lang;
    }
    public function getSkills($id)
    {
        $job = Job::find($id);
        $skills = $job->skills;
        return $skills;
    }
    public function getsubkills($id)
    {
        $sub = Sub_job_skill::where('job_id', $id)->get();
        
        foreach($sub as $value)
        {
            
            $name = Sub_skill::find($value->sub_skill_id);
            //dd($name);
            $value->name = $name->sub_skill;
        }
        return $sub;
    }
    public function getInvited($id)
    {
        
        $invitedf = array();
        if(Providerinvite::where('job_id', $id)->exists())
        {
            $providerinvite = Providerinvite::where('job_id', $id)->first();
            
            $emails = explode(', ', $providerinvite->providers);
            // dd($providerinvite);                        
            foreach($emails as $key => $email)
            {
                if(User::where('email', $email)->exists())
                {
                    $user = User::where('email', $email)->first();
                    //dd('exists');
                    $invitedf[$key]['name'] = $user->first_name.' '.$user->last_name;
                    $invitedf[$key]['email'] = $email;
                }
                else
                {
                    $invitedf[$key]['name'] = 'waiting to accept request';
                    $invitedf[$key]['email'] = $email;
                }
            }
        }
        return $invitedf;
    }
    public function deleteInvited($id)
    {
        $ids = explode('-', $id);
        //dd($id);
        $invite = Providerinvite::where('job_id', $ids[0])->first();
        $emails = explode(', ', $invite->providers);
        $providers = $invite->providers;
        if($ids[1] == $emails[0])
        {
            $ids[1] = $ids[1].', ';
        }
        else
        {
            $ids[1] = ', '.$ids[1];
        }
        
        
        
        $providers = str_replace($ids[1],"",$providers);
        $invite->providers = $providers;
        //dd($invite, $providers);
        $invite->save();
        return true;
        
    }
    public function postInvite(Request $request)
    {
        //dd($request->all());
        $email_text = "Hello Sir/Mam,

        I want to invite you to make a proposal for my project.
        
        For the further information, please click the invitation below.
        
        {Link}
        
        Thanks in advance,
        {name}";
        if(Providerinvite::where('job_id', $request->job_id)->exists())
        {
            $invite = Providerinvite::where('job_id', $request->job_id)->first();
        }
        else
        {
            $invite = new Providerinvite;
            $invite->job_id = $request->job_id;
            $invite->email_text = $email_text;
        }
        $providers = $invite->providers.', '.$request->email;
        $invite->providers = $providers;
        $invite->save();
        return true;
    }
    public function deletesubskill($id)
    {
        $sub = Sub_job_skill::find($id);
        $sub->delete();
        return true;
    }
    public function postsubskill($id)
    {
        
        $ids = explode('-', $id);
        if(Sub_job_skill::where('job_id', $ids[0])->where('sub_skill_id', $ids[1])->exists())
        {}
        else
        {
            $sub = new Sub_job_skill;
            $sub->job_id = $ids[0];
            $sub->sub_skill_id = $ids[1];
            $sub->save();
        }
        return true;
    }
    public function getTeam($id)
    {
        $teams = Team::where('job_id', $id)->get();
        return $teams;
    }
    public function postteam(Request $request)
    {
        //dd($request->all());
        $job = Job::find($request->job_id);


        if(User::where('email', $request->email)->exists())
        {
            Mail::to($request->email)->send(new TeamInvite($job));
            Mail::to('sadiqueali786@gmail.com')->send(new TeamInvite($job));
        }
        else{
            $user = new User;
            $user->first_name = $request->name;
            $user->last_name = $request->lname;
            $user->slug = $request->name.'-'.$request->lname;
            $user->nickname = $request->name;
            $user->user_verified = 1;
            $user->password = Hash::make('password');
            $user->email = $request->email;
            $user->save();
            $user->assignRole('provider');
            $profile = new Profile();
            $profile->user()->associate($user->id);
            $profile->save();
            Mail::to($request->email)->send(new UserInvite($user, $job));
            Mail::to('sadiqueali786@gmail.com')->send(new UserInvite($user, $job));
        }
        //Mail::to($request->email)->send(new TeamInvite($job));
        return Team::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'role' => $request->role,
            'permission' => $request->permission,
            'email' => $request->email,
            'job_id' => $request->job_id
        ]);
    }
    public function deleteteam($id)
    {
        $team = Team::find($id);
        $team->delete();
        return true;
    }

    public function getApprover($id)
    {
        $ids = explode('-', $id);
        
        //$job = Job::where('id', $ids[0])->get();
        $user = User::find($ids[1]);
        $approvers = Approver::where('job_id', $ids[0])->get();
        foreach($approvers as $key => $value)
        {
            if($value->email == $user->email && $value->status == 0)
                $value->update = 1;
            else
                $value->update = 0;
        }
        return $approvers;
    }
    public function approvejob($id)
    {
        //dd($id);
        $approver = Approver::find($id);
        $approver->status = 1;
        $approver->notes = null;
        $approver->save();
        $job_id = $approver->job_id;
        if(Approver::where('job_id', $job_id)->where('status', 0)->exists())
        {
            if(Approver::where('job_id', $job->id)->where('permission', 1)->where('status', 0)->exists())
            {
                $approverm = Approver::where('job_id', $job->id)->where('permission', 1)->where('status', 0)->get();
                foreach($approverm as $key => $value)
                {
                    Mail::to($value['email'])->send(new Approverinvite($job));
                    Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                }
            }
            else
            {
                if(Approver::where('job_id', $job->id)->where('permission', 2)->where('status', 0)->exists())
                {
                    $approverm = Approver::where('job_id', $job->id)->where('permission', 2)->where('status', 0)->get();
                    foreach($approverm as $key => $value)
                    {
                        Mail::to($value['email'])->send(new Approverinvite($job));
                        Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                    }
                }
                else
                {
                    if(Approver::where('job_id', $job->id)->where('permission', 3)->where('status', 0)->exists())
                    {
                        $approverm = Approver::where('job_id', $job->id)->where('permission', 3)->where('status', 0)->get();
                        foreach($approverm as $key => $value)
                        {
                            Mail::to($value['email'])->send(new Approverinvite($job));
                            Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                        }
                    }
                    else
                    {
                        if(Approver::where('job_id', $job->id)->where('permission', 4)->where('status', 0)->exists())
                        {
                            $approverm = Approver::where('job_id', $job->id)->where('permission', 4)->where('status', 0)->get();
                            foreach($approverm as $key => $value)
                            {
                                Mail::to($value['email'])->send(new Approverinvite($job));
                                Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                            }
                        }
                        else
                        {
                            if(Approver::where('job_id', $job->id)->where('permission', 5)->where('status', 0)->exists())
                            {
                                $approverm = Approver::where('job_id', $job->id)->where('permission', 5)->where('status', 0)->get();
                                foreach($approverm as $key => $value)
                                {
                                    Mail::to($value['email'])->send(new Approverinvite($job));
                                    Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                                }
                            }
                        }
                    }
                }   
            }
            return 0;
        }
        else
        {
            $job = Job::find($job_id);
            //invite provider
            /*$providerinvite = Providerinvite::where('job_id', $job_id)->first();
            if($providerinvite->providers)
            {
                $emails = explode(', ', $providerinvite->providers);
                
                $user1 = User::find($job->user_id);
                foreach($emails as $key => $email)
                {
                    //Mail::to($email)->send(new Inviteprovider($user, $job->slug));
                    
                    $name = $user1->first_name.' '.$user1->last_name;
                    $link = '<a href="http://worketic.apnahive.com/job/'. $job->slug .'">Link</a>';
                    $messagex = str_replace('{name}', $name, $providerinvite->email_text);
                    $messagex = str_replace('{link}', $link, $messagex);
                    $message1 = str_replace(array("\r","\n",'\r','\n'), "<br>", $messagex);
                    $message1 = str_replace(array("<br><br>"), "<br>", $message1);
                    Mail::to($email)->send(new Inviteraw($message1));
                    Mail::to('sadiqueali786@gmail.com')->send(new Inviteraw($message1));
                    //dd('email sent');
                }
            }*/

            //invite team

            $teams = Team::where('job_id', $job_id)->get();
            foreach($teams as $key => $team)
            {
                if(User::where('email', $team->email)->exists())
                {
                    Mail::to($team['email'])->send(new TeamInvite($job));
                    Mail::to('sadiqueali786@gmail.com')->send(new TeamInvite($job));
                }
                else{
                    $user = new User;
                    $user->first_name = $team['name'];
                    $user->last_name = $team['lname'];
                    $user->slug = $team['name'].'-'.$team['lname'];
                    $user->user_verified = 1;
                    $user->password = Hash::make('password');
                    $user->email = $team['email'];
                    $user->save();
                    $user->assignRole('provider');
                    $profile = new Profile();
                    $profile->user()->associate($user->id);
                    $profile->save();
                    Mail::to($team['email'])->send(new UserInvite($user, $job));
                    Mail::to('sadiqueali786@gmail.com')->send(new UserInvite($user, $job));
                }
            }
            //set job status to posted
            $job->status = 'posted';
            $job->save();

            return redirect()->back();
        }
    }
    public function rejectjob(Request $request, $id)
    {
        //dd($request->all(), $id);
        $approver = Approver::find($id);
        $approver->status = 2;
        $approver->notes = $request->note;
        $approver->save();
        $job_id = $approver->job_id;
        $job = Job::find($job_id);
        $job->status = 'rejected';
        $job->save();
        return redirect()->back();
        
    }
    public function restorejob($id)
    {
        //dd($id);
        $job = Job::find($id);
        $job->status = 'approval';
        $job->save();
        $approvers = Approver::where('job_id', $id)->get();
        foreach($approvers as $key => $value)
        {
            $value->status = 0;
            $value->save();

        }
        //Approver send mail 
        if(Approver::where('job_id', $job->id)->where('permission', 1)->exists())
        {
            $approverm = Approver::where('job_id', $job->id)->where('permission', 1)->get();
            foreach($approverm as $key => $value)
            {
                Mail::to($value['email'])->send(new Approverinvite($job));
                Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
            }
        }
        else
        {
            if(Approver::where('job_id', $job->id)->where('permission', 2)->exists())
            {
                $approverm = Approver::where('job_id', $job->id)->where('permission', 2)->get();
                foreach($approverm as $key => $value)
                {
                    Mail::to($value['email'])->send(new Approverinvite($job));
                    Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                }
            }
            else
            {
                if(Approver::where('job_id', $job->id)->where('permission', 3)->exists())
                {
                    $approverm = Approver::where('job_id', $job->id)->where('permission', 3)->get();
                    foreach($approverm as $key => $value)
                    {
                        Mail::to($value['email'])->send(new Approverinvite($job));
                        Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                    }
                }
                else
                {
                    if(Approver::where('job_id', $job->id)->where('permission', 4)->exists())
                    {
                        $approverm = Approver::where('job_id', $job->id)->where('permission', 4)->get();
                        foreach($approverm as $key => $value)
                        {
                            Mail::to($value['email'])->send(new Approverinvite($job));
                            Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                        }
                    }
                    else
                    {
                        if(Approver::where('job_id', $job->id)->where('permission', 5)->exists())
                        {
                            $approverm = Approver::where('job_id', $job->id)->where('permission', 5)->get();
                            foreach($approverm as $key => $value)
                            {
                                Mail::to($value['email'])->send(new Approverinvite($job));
                                Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                            }
                        }
                    }
                }
            }   
        }
        return redirect()->route('employerManageJobs');
        
    }
    public function postApprover(Request $request)
    {
        //dd($request->all());
        $job = Job::find($request->job_id);


        if(User::where('email', $request->email)->exists())
        {
            //dd('mail');
            Mail::to($request->email)->send(new Approverinvite($job));
            Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
        }
        else{
            //dd('new user');
            $user = new User;
            $user->first_name = $request->name;
            $user->last_name = $request->lname;
            $user->user_verified = 1;
            $user->password = Hash::make('password');
            $user->slug = $request->name.'-'.$request->lname;
            $user->nickname = $request->name;
            $user->email = $request->email;
            $user->save();
            $user->assignRole('employer');
            $profile = new Profile();
            $profile->user()->associate($user->id);
            $profile->save();
            Mail::to($request->email)->send(new Approveruserinvite($user, $job));
            Mail::to('sadiqueali786@gmail.com')->send(new Approveruserinvite($user, $job));
        }
        //Mail::to($request->email)->send(new TeamInvite($job));
        return Approver::create([
            'name' => $request->name,
            'email' => $request->email,
            'lname' => $request->lname,
            'role' => $request->role,
            'permission' => $request->permission,
            'job_id' => $request->job_id
        ]);
    }
    public function deleteApprover($id)
    {
        $approver = Approver::find($id);
        $approver->delete();
        return true;
    }


    public function getQuiz($id)
    {
        $ids = explode('-', $id);
        //dd(Auth::user());
        //$user_id = Auth::user()->id;
        if(Job_quiz::where('job_id', $ids[0])->exists())
        {
            $quizzes = Job_quiz::where('job_id', $ids[0])->select('quiz_id')->get();
            $quiz = Quiz::where('user_id', $ids[1])->whereNotIn('id', $quizzes)->get();
        }
        else
        {
            $quiz = Quiz::where('user_id', $ids[1])->get();
        }
        
        return response()->json($quiz);
    }
    public function updateskill($id)
    {
        $ids = explode('-', $id);
        if(DB::table('job_skill')->where('job_id', $ids[0])->where('skill_id', $ids[1])->exists())
        {}
        else
        {   
            DB::table('job_skill')->insert([
                'skill_id' => $ids[1],
                'job_id' => $ids[0]
            ]);
        }
        return true;
    }
    public function deleteskill($id)
    {
        //dd('delete');

        $ids = explode('-', $id);
        
        if(DB::table('job_skill')->where('job_id', $ids[0])->where('skill_id', $ids[1])->exists())
            DB::table('job_skill')->where('job_id', $ids[0])->where('skill_id', $ids[1])->delete();

        return true;
        
    }
    public function updatelang($id)
    {
        $ids = explode('-', $id);
        if(DB::table('langables')->where('language_id', $ids[1])->where('langable_id', $ids[0])->where('langable_type', 'App\Job')->exists())
        {}
        else
        {   
            DB::table('langables')->insert([
                'language_id' => $ids[1],
                'langable_id' => $ids[0],
                'langable_type' => 'App\Job'
            ]);
        }

        return true;
    }
    public function deletelang($id)
    {
        $ids = explode('-', $id);
        if(DB::table('langables')->where('language_id', $ids[1])->where('langable_id', $ids[0])->where('langable_type', 'App\Job')->exists())
            DB::table('langables')->where('language_id', $ids[1])->where('langable_id', $ids[0])->where('langable_type', 'App\Job')->delete();

        return true;
    }
    public function updatequiz($id)
    {
        $ids = explode('-', $id);
        $job_quiz = new Job_quiz;
        $job_quiz->quiz_id = $ids[1];
        $job_quiz->job_id = $ids[0];
        $job_quiz->save();

        return true;
    }
    public function deletequiz($id)
    {
        $ids = explode('-', $id);
        $job_quiz = Job_quiz::where('quiz_id', $ids[1])->where('job_id', $ids[0]);
        //dd($job_quiz);
        $job_quiz->delete();

        return true;
    }
    public function getEnglish($id)
    {
        $english = English_level::where('job_id', $id)->get();
        $project_english = Helper::getEnglishLevelList();
        foreach ($english as $key => $value) {
            foreach ($project_english as $key1 => $value1) {
                //dd($value, $key1, $project_english);
                if($value->english_level == $key1)
                    $value->name = $value1;
            }   
        }
        return $english;
    }
    public function getProvider($id)
    {
        $provider = Provider_type::where('job_id', $id)->get();
        $project_provider = Helper::getProviderLevelList();
        foreach ($provider as $key => $value) {
            foreach ($project_provider as $key1 => $value1) {
                //dd($value, $key1, $project_english);
                if($value->Provider_type == $key1)
                    $value->name = $value1;
            }   
        }
        return $provider;
    }
    public function deleteenglish($id)
    {
        $english = English_level::find($id);
        $english->delete();
        return true;
    }
    public function deleteProvider($id)
    {
        $provider = Provider_type::find($id);
        $provider->delete();
        return true;
    }
    public function getProjectLevel()
    {
        $project_levels = Helper::getProjectLevel();
        return response()->json($project_levels);
    }
    public function getProjectduration()
    {
        $project_duration = Helper::getJobDurationList();
        return response()->json($project_duration);
    }
    public function getProjectenglishlevel()
    {
        $project_english = Helper::getEnglishLevelList();
        return response()->json($project_english);
    }
    public function getProjectProviderlevel()
    {
        $project_provider = Helper::getProviderLevelList();
        return response()->json($project_provider);
    }
    public function postProjectLevel($id)
    {
        
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->project_level = $ids[1];
        $job->save(); 
        return true;
    }
    public function postProjectDuration($id)
    {
        
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->duration = $ids[1];
        $job->save(); 
        return true;
    }
    public function postProjecttype($id)
    {
        
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->type = $ids[1];
        $job->save(); 
        return true;
    }
    public function postquiz($id)
    {
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->quiz = $ids[1];
        $job->save();
        if($job->quiz = 'no')
        {
            if(Job_quiz::where('job_id', $job->id)->exists())
            {
                $job_quiz = Job_quiz::where('job_id', $job->id);
                $job_quiz->delete();
            }
        } 
        return true;
    }
    public function postProjectprice($id)
    {
        
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->price = $ids[1];
        $job->save(); 
        return true;
    }
    public function postProjectprovider($id)
    {
        
        $ids = explode('-', $id);
        if(Provider_type::where('job_id', $ids[0])->where('Provider_type', $ids[1])->exists())
        {}
        else
        {
            $provider = new Provider_type;
            $provider->job_id = $ids[0];
            $provider->Provider_type = $ids[1];
            $provider->save();
        }
        /*$job = Job::find($ids[0]);
        $job->Provider_type = $ids[1];
        $job->save(); */
        return true;
    }
    public function postProjectenglish($id)
    {
        //dd('posted');
        $ids = explode('-', $id);
        if(English_level::where('job_id', $ids[0])->where('english_level', $ids[1])->exists())
        {}
        else
        {
            $english = new English_level;
            $english->job_id = $ids[0];
            $english->english_level = $ids[1];
            $english->save();
        }
        return true;
        /*$job = Job::find($ids[0]);
        $job->english_level = $ids[1];
        $job->save(); */
    }
    public function postProjectexpirydate($id)
    {
        
        $ids = explode('_', $id);
        $job = Job::find($ids[0]);
        $job->expiry_date = $ids[1];
        $job->save(); 
        return true;
    }
    public function postProjectmonth($id)
    {   
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->month = $ids[1];
        $job->save(); 
        return true;
    }
    public function postProjectweek($id)
    {   
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->week = $ids[1];
        $job->save(); 
        return true;
    }
    public function postProjectday($id)
    {   
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->day = $ids[1];
        $job->save(); 
        return true;
    }
    public function postProjecthour($id)
    {   
        $ids = explode('-', $id);
        $job = Job::find($ids[0]);
        $job->hour = $ids[1];
        $job->save(); 
        return true;
    }
    public function postdescription(Request $request, $id)
    {
        //dd($request->all());
        $job = Job::find($request->job_id);
        $job->description = filter_var($request->description, FILTER_SANITIZE_STRING);
        //dd($job);
        $job->save();
        return true;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
