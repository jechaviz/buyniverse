<?php

/**
 * Class Job.
 *
 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Storage;
use DB;
use Auth;
use App\Proposal;
use App\Location;
use App\Language;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Quiz;
use App\Helper;
use App\Job_quiz;
use App\Sub_job_skill;
use App\Sub_job_cat;
/**
 * Class Job
 *
 */
class Job extends Model
{
     /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'expiry_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = ['title', 'slug', 'project_level', 'provider_type', 'english_level', 'code', 'user_id'];
    /**
     * Get all of the categories for the job.
     *
     * @return relation
     */
    public function categories()
    {
        return $this->morphToMany('App\Category', 'catable');
    }

    /**
     * Get all of the languages for the user.
     *
     * @return relation
     */
    public function languages()
    {
        return $this->morphToMany('App\Language', 'langable');
    }

    /**
     * The skills that belong to the job.
     *
     * @return relation
     */
    public function skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    /**
     * Get the location that owns the job.
     *
     * @return relation
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Get the employer that owns the job.
     *
     * @return relation
     */
    public function employer()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function symbols()
    {
        return $this->belongsTo('App\Currency', 'currency');
    }

    /**
     * Get the proposals associated with job.
     *
     * @return relation
     */
    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }

    /**
     * Get all of the job's reports.
     *
     * @return relation
     */
    public function reports()
    {
        return $this->morphMany('App\Report', 'reportable');
    }

    /**
     * Uppload Attcahments.
     *
     * @param mixed $uploadedFile uploaded file
     *
     * @return relation
     */
    public function uploadTempattachments($uploadedFile, $path)
    {
        $filename = $uploadedFile->getClientOriginalName();
        if (!file_exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        Storage::disk('local')->putFileAs(
            $path,
            $uploadedFile,
            $filename
        );
        return 'success';
    }

    /**
     * Set slug before saving in DB
     *
     * @param string $value value
     *
     * @access public
     *
     * @return string
     */
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $temp = str_slug($value, '-');
            if (!Job::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Job::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Store Jobs.
     *
     * @param mixed $request request->attr
     *
     * @return relation
     */
    public function storeJobs($request)
    {
        //dd($request->all());
        //return 'job in model';
        $json = array();
        if (!empty($request)) {
            $random_number = Helper::generateRandomCode(8);
            $code = strtoupper($random_number);
            $user_id = Auth::user()->id;
            $location = $request['locations'];
            $this->location()->associate($location);
            $this->employer()->associate($user_id);
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->price = filter_var($request['price'], FILTER_SANITIZE_STRING);
            $this->project_level = filter_var($request['project_level'], FILTER_SANITIZE_STRING);
            $this->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $this->english_level = filter_var($request['english'], FILTER_SANITIZE_STRING);
            $this->duration = filter_var($request['project_duration'], FILTER_SANITIZE_STRING);
            $this->provider_type = filter_var($request['provider_type'], FILTER_SANITIZE_STRING);
            $this->is_featured = filter_var($request['is_featured'], FILTER_SANITIZE_STRING);
            $this->show_attachments = filter_var($request['show_attachments'], FILTER_SANITIZE_STRING);
            $this->address = filter_var($request['address'], FILTER_SANITIZE_STRING);
            $this->longitude = filter_var($request['longitude'], FILTER_SANITIZE_STRING);
            $this->latitude = filter_var($request['latitude'], FILTER_SANITIZE_STRING);
            /*if (Schema::hasColumn('jobs', 'expiry_date')) {
                $this->expiry_date = $request['expiry_date'];
            }*/
            $old_path = 'uploads\jobs\temp';
            $job_attachments = array();
            if (!empty($request['attachments'])) {
                $attachments = $request['attachments'];
                foreach ($attachments as $key => $attachment) {
                    if (Storage::disk('local')->exists($old_path . '/' . $attachment)) {
                        $new_path = 'uploads/jobs/' . $user_id;
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $attachment;
                        Storage::move($old_path . '/' . $attachment, $new_path . '/' . $filename);
                        $job_attachments[] = $filename;
                    }
                }
                $this->attachments = serialize($job_attachments);
            }
            $this->code = $code;
            //Delivery time
            if($request->delivery_type == 'date')
            {
                $this->delivery_type = $request['delivery_type'];
                $this->expiry_date = $request['expiry_date'];
            }
            else
            {
                $this->delivery_type = $request['delivery_type'];
                $this->month = $request['time_month'];
                $this->week = $request['time_week'];
                $this->day = $request['time_day'];
                $this->hour = $request['time_hour'];
            }
            $this->payment = $request['payment'];
            if($this->payment == 'fixed')
                $this->project_type = 'fixed';
            else
                $this->project_type = 'hourly';

            if($request->quiz)
                $this->quiz = 'yes';
            else
                $this->quiz = 'no';
            //$this->save();
            $job_id = $this->id;
            $skills = $request['skills'];
            $sub_skills = $request['subskills'];
            $sub_cats = $request['subcategory'];
            //dd($skills);
            //$this->skills()->detach();
            if (!empty($skills)) {
                foreach ($skills as $key => $skill) {
                    //$this->skills()->attach($skill['id']);
                    DB::table('job_skill')->insert([
                        'job_id' => $job_id,
                        'skill_id' => $skill
                    ]);
                }
            }
            if (!empty($sub_skills)) {
                foreach ($sub_skills as $key => $skill) {
                    $sub_job_skill = new Sub_job_skill;
                    $sub_job_skill->job_id = $job_id;
                    $sub_job_skill->sub_skill_id = $skill;
                    $sub_job_skill->save();
                }
            }
            if (!empty($sub_cats)) {
                foreach ($sub_cats as $key => $cat) {
                    $sub_job_cat = new Sub_job_cat;
                    $sub_job_cat->job_id = $job_id;
                    $sub_job_cat->sub_cat_id = $cat;
                    $sub_job_cat->save();
                }
            }
            $english = $request['english'];
            if (!empty($english)) {
                foreach ($english as $key => $value) {
                    //$this->skills()->attach($skill['id']);
                    DB::table('english_levels')->insert([
                        'job_id' => $job_id,
                        'english_level' => $value
                    ]);
                }
            }
            $provider_type = $request['provider'];
            if (!empty($provider_type)) {
                foreach ($provider_type as $key => $value) {
                    //$this->skills()->attach($skill['id']);
                    DB::table('provider_types')->insert([
                        'job_id' => $job_id,
                        'provider_type' => $value
                    ]);
                }
            }
            $job = Job::find($job_id);
            /*$languages = $request['langs'];
            $job->languages()->sync($languages);
            $categories = $request['category'];
            $job->categories()->sync($categories);*/
            /*if($request['emails'])
            {
                $emails = explode(', ', $request['emails']);
                $user = User::find(Auth::user()->id);
                //$job = Job::where('user_id', Auth::user()->id)->latest()->first();
                foreach($emails as $key => $email)
                {
                    Mail::to($email)->send(new InviteProvider($user, $job->slug));
                }
            }*/

            //quiz code here
            if($this->quiz == 'on')
            {
                //$quizzes = Quiz::where('user_id', $user_id)->get();
                foreach($request->selectquiz as $quiz)
                {
                    //$value = 'quiz-'.$quiz->id;
                    if(Quiz::whereIn('id', $quiz)->exists())
                    {                        
                        $job_quiz = new Job_quiz;
                        $job_quiz->quiz_id = $quiz;
                        $job_quiz->job_id = $job_id;
                        $job_quiz->save();
                    }
                    
                }
                
            }
            
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Update Jobs.
     *
     * @param mixed   $request request
     * @param integer $id      ID
     *
     * @return $request, ID
     */
    public function updateJobs($request, $id)
    {
        $json = array();
        if (!empty($request)) {
            $job = self::find($id);
            $random_number = Helper::generateRandomCode(8);
            $user_id = $job->user_id;
            $location = $request['locations'];
            $job->location()->associate($location);
            $job->employer()->associate($user_id);
            if ($job->title != $request['title']) {
                $job->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $job->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $job->price = filter_var($request['project_cost'], FILTER_SANITIZE_STRING);
            $job->project_level = filter_var($request['project_levels'], FILTER_SANITIZE_STRING);
            $job->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $job->english_level = filter_var($request['english_level'], FILTER_SANITIZE_STRING);
            $job->duration = filter_var($request['job_duration'], FILTER_SANITIZE_STRING);
            $job->provider_type = filter_var($request['provider_type'], FILTER_SANITIZE_STRING);
            $job->is_featured = filter_var($request['is_featured'], FILTER_SANITIZE_STRING);
            $job->show_attachments = filter_var($request['show_attachments'], FILTER_SANITIZE_STRING);
            $job->address = filter_var($request['address'], FILTER_SANITIZE_STRING);
            $job->longitude = filter_var($request['longitude'], FILTER_SANITIZE_STRING);
            $job->latitude = filter_var($request['latitude'], FILTER_SANITIZE_STRING);
            if (Schema::hasColumn('jobs', 'expiry_date')) {
                $job->expiry_date = $request['expiry_date'];
            }
            $old_path = 'uploads\jobs\temp';
            $job_attachments = array();
            if (!empty($request['attachments'])) {
                $attachments = $request['attachments'];
                foreach ($attachments as $key => $attachment) {
                    $filename = $attachment;
                    if (Storage::disk('local')->exists($old_path . '/' . $attachment)) {
                        $new_path = 'uploads/jobs/' . $user_id;
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $attachment;
                        Storage::move($old_path . '/' . $attachment, $new_path . '/' . $filename);
                    }
                    $job_attachments[] = $filename;
                }
                $job->attachments = serialize($job_attachments);
            } else {
                $job->attachments = null;
            }
            if (empty($job->code)) {
                $code = strtoupper($random_number);
                $job->code = $code;
            }

            //Delivery time
            if($request->delivery_type == 'date')
            {
                $job->delivery_type = $request['delivery_type'];
                $job->expiry_date = $request['expiry_date'];
            }
            else
            {
                $job->delivery_type = $request['delivery_type'];
                $job->month = $request['time_month'];
                $job->week = $request['time_week'];
                $job->day = $request['time_day'];
                $job->hour = $request['time_hour'];
            }
            $job->payment = $request['payment'];
            //dd($request->quiz == 'on');
            if($request->quiz == 'on')
                $job->quiz = 'yes';
            else
                $job->quiz = 'no';

            $job->save();
            //dd($job, $request->quiz, $this->quiz);
            $job_id = $job->id;
            $skills = $request['skills'];
            //$job->skills()->detach();
            if (!empty($skills)) {
                foreach ($skills as $skill) {
                    //$job->skills()->attach($skill['id']);
                    if(DB::table('job_skill')->where('job_id', $job_id)->where('skill_id', $skill)->exists())
                    {}
                    else {
                        DB::table('job_skill')->insert([
                            'job_id' => $job_id,
                            'skill_id' => $skill
                        ]);
                    }
                    
                }
                if(DB::table('job_skill')->where('job_id', $job_id)->whereNotIn('skill_id', $skills)->exists())
                    DB::table('job_skill')->where('job_id', $job_id)->whereNotIn('skill_id', $skills)->delete();
                
            }
            else{
                DB::table('job_skill')->where('job_id', $job_id)->delete();
            }
            $sub_skills = $request['sub_skill'];
            
            if (!empty($sub_skills)) {
                foreach ($sub_skills as $key => $skill) {
                    
                    if(Sub_job_skill::where('job_id', $job_id)->where('sub_skill_id', $skill)->exists())
                    {}
                    else {
                        
                        $sub_job_skill = new Sub_job_skill;
                        $sub_job_skill->job_id = $job_id;
                        $sub_job_skill->sub_skill_id = $skill;
                        $sub_job_skill->save();
                        //dd($skill);
                    }
                }
                if(Sub_job_skill::where('job_id', $job_id)->whereNotIn('sub_skill_id', $sub_skills)->exists())
                    Sub_job_skill::where('job_id', $job_id)->whereNotIn('sub_skill_id', $sub_skills)->delete();
            }
            else{
                $sub_job_skill = Sub_job_skill::where('job_id', $job_id)->delete();
            }
            $sub_cats = $request['sub_cat'];
            if (!empty($sub_cats)) {
                foreach ($sub_cats as $key => $cat) {

                    if(Sub_job_cat::where('job_id', $job_id)->where('sub_cat_id', $cat)->exists())
                    {}
                    else {
                        $sub_job_cat = new Sub_job_cat;
                        $sub_job_cat->job_id = $job_id;
                        $sub_job_cat->sub_cat_id = $cat;
                        $sub_job_cat->save();
                    }
                }
                if(Sub_job_cat::where('job_id', $job_id)->whereNotIn('sub_cat_id', $sub_cats)->exists())
                    Sub_job_cat::where('job_id', $job_id)->whereNotIn('sub_cat_id', $sub_cats)->delete();
            }
            else{
                $sub_job_cat = Sub_job_cat::where('job_id', $job_id)->delete();
            }
            $job = Job::find($job_id);
            $languages = $request['languages'];
            $job->languages()->sync($languages);
            $categories = $request['categories'];
            $job->categories()->sync($categories);

            //dd($request->quiz);
            //quiz code here
            if($request->quiz)
            {
                //$quizzes = Quiz::where('user_id', $user_id)->get();
                foreach($request->selectquiz as $quiz)
                {
                    //dd($quiz);
                    //$value = 'quiz-'.$quiz->id;
                    if(Quiz::where('id', $quiz)->exists())
                    {
                        if(Job_quiz::where('job_id', $job_id)->where('quiz_id', $quiz)->exists())
                        {}
                        else 
                        {
                            $job_quiz = new Job_quiz;
                            $job_quiz->quiz_id = $quiz;
                            $job_quiz->job_id = $job_id;
                            $job_quiz->save();
                        }                       
                        
                    }                  
                }
                if(Job_quiz::where('job_id', $job_id)->whereNotIn('quiz_id', $request->selectquiz)->exists())
                    Job_quiz::where('job_id', $job_id)->whereNotIn('quiz_id', $request->selectquiz)->delete();
            }
            else
            {
                
                if(Job_quiz::where('job_id', $job->id)->exists())
                {

                    $job_quiz = Job_quiz::where('job_id', $job->id);
                    $job_quiz->delete();
                }
                
            }
            //dd('test');
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get all of the categories for the job.
     *
     * @param string $keyword                keyword
     * @param string $search_categories      search_categories
     * @param string $search_locations       search_locations
     * @param string $search_skills          search_skills
     * @param string $search_project_lengths search_project_lengths
     * @param string $search_languages       search_languages
     *
     * @return relation
     */
    public static function getSearchResult(
        $address,
        $keyword,
        $search_categories,
        $search_locations,
        $search_skills,
        $search_project_lengths,
        $search_languages,
        $display_completed_projects,
        $min_price,
        $max_price
    ) {
        $json = array();
        $jobs = Job::select('*');
        
        //$jobs = Job::where('status', 'posted');
        
        //$jobs->where('status', '=', 'posted');
        $job_id = array();
        $filters = array();
        $filters['type'] = 'job';
        if (!empty($keyword)) {
            $filters['s'] = $keyword;
            $jobs->where('title', 'like', '%' . $keyword . '%');
        };
        
        if (!empty($address)) {
            $filters['addr'] = $address;
            $jobs->where('address', 'like', '%' . $address . '%');
        };
        
        if (!empty($search_categories)) {
            $filters['category'] = $search_categories;
            foreach ($search_categories as $key => $search_category) {
                $categor_obj = Category::where('slug', $search_category)->first();
                $category = !empty($categor_obj) && !empty($categor_obj->id) ? Category::find($categor_obj->id) : '';
                if (!empty($category) && !empty($category->jobs)) {
                    $category_jobs = $category->jobs->pluck('id')->toArray();
                    foreach ($category_jobs as $id) {
                        $job_id[] = $id;
                    }
                }
            }
            $jobs->whereIn('id', $job_id);
        }
        
        if (!empty($search_locations)) {
            $locations = array();
            $filters['locations'] = $search_locations;
            if (is_array($search_locations)) {
                $locations = Location::select('id')->whereIn('slug', $search_locations)->get()->pluck('id')->toArray();
            } else {
                $locations = Location::select('id')->where('slug', $search_locations)->get()->pluck('id')->toArray();
            }
            $jobs->whereIn('location_id', $locations);
        }
        
        if (!empty($search_skills)) {
            $filters['skills'] = $search_skills;
            foreach ($search_skills as $key => $search_skill) {
                $skill_obj = Skill::where('slug', $search_skill)->first();
                $skill = Skill::find($skill_obj->id);
                if (!empty($skill->jobs)) {
                    $skill_jobs = $skill->jobs->pluck('id')->toArray();
                    foreach ($skill_jobs as $id) {
                        $job_id[] = $id;
                    }
                }
            }
            $jobs->whereIn('id', $job_id);
        }
        
        if (!empty($search_project_lengths)) {
            $filters['project_lengths'] = $search_project_lengths;
            $jobs->whereIn('duration', $search_project_lengths);
        }
        
        if (!empty($search_languages)) {
            $filters['languages'] = $search_languages;
            $languages = Language::whereIn('slug', $search_languages)->get();
            foreach ($languages as $key => $language) {
                if (!empty($language->jobs[$key]->id)) {
                    $job_id[] = $language->jobs[$key]->id;
                }
            }
            $jobs->whereIn('id', $job_id);
        }
        if (!empty($max_price)) {
            $jobs->whereBetween('price', [$min_price, $max_price]);
        }
        if ($display_completed_projects == 'false') {
            $jobs = $jobs->where('status', '!=', 'completed');
        }
        $jobs = $jobs->where('status', '!=', 'draft');
        //dd($jobs->get());
        if (Schema::hasColumn('jobs', 'expiry_date')) {
            $jobs = $jobs->WhereNull('expiry_date')->orWhereDate('expiry_date', '>', date('Y-m-d'));
        }
        $jobs->where('status', '=', 'posted');
        $jobs->where('type', 'public');
        //dd($jobs->get());
        //dd($jobs->get());
        $jobs = $jobs->orderByRaw("is_featured DESC, updated_at DESC")->paginate(7)->setPath('');
        foreach ($filters as $key => $filter) {
            $pagination = $jobs->appends(
                array(
                    $key => $filter
                )
            );
        }
        
        
        $json['jobs'] = $jobs;
        return $json;
    }

    /**
     * Delete recoed from storage
     *
     * @param int $id id
     *
     * @return relation
     */
    public static function deleteRecord($id)
    {
        $job = self::find($id);
        if (!empty($job->proposals)) {
            foreach ($job->proposals as $key => $proposal) {
                $proposal = Proposal::find($proposal->id);
                $proposal->delete();
            }
        }
        $job->skills()->detach();
        $job->languages()->detach();
        $job->categories()->detach();
        return $job->delete();
    }

    /**
     * Get order
     *
     * @param int   $project_id project_id
     *
     * @return response
     */
    public static function getProjectOrder($project_id)
    {
        return DB::table('orders')
            ->join('proposals', 'orders.product_id', '=', 'proposals.id')
            ->join('jobs', 'proposals.job_id', '=', 'jobs.id')
            ->select('orders.product_id')
            ->where('orders.type', 'job')
            ->where('jobs.id', $project_id)
            ->first();
    }
}
