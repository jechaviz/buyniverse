<?php

/**
 * Class JobController.
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Language;
use App\Category;
use App\Skill;
use App\Location;
use App\Helper;
use App\Proposal;
use ValidateRequests;
use App\User;
use App\Profile;
use App\Package;
use DB;
use Spatie\Permission\Models\Role;
use App\SiteManagement;
use App\Mail\AdminEmailMailable;
use App\Mail\EmployerEmailMailable;
use App\EmailTemplate;
use App\Mail\InviteFreelancer;
use App\Mail\InviteRaw;
use App\Mail\TeamInvite;
use App\Mail\UserInvite;
use App\Item;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Quiz;
use App\Job_quiz;
use App\Team;
use App\Sub_job_skill;
use App\Sub_job_cat;
use App\Approver;
use App\Providerinvite;
use Illuminate\Support\Facades\Hash;
use App\Mail\Approverinvite;
use App\Mail\Approveruserinvite;

/**
 * Class JobController
 *
 */
class JobController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $job
     */
    protected $job;

    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $job
     */
    // public $email_settings;

    /**
     * Create a new controller instance.
     *
     * @param instance $job instance
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Post Job Form.
     *
     * @return post jobs page
     */
    public function postJob()
    {
        $weekdays =[
            trans('lang.weekdays.mon'),
            trans('lang.weekdays.tue'),
            trans('lang.weekdays.wed'),
            trans('lang.weekdays.thu'),
            trans('lang.weekdays.fri'),
            trans('lang.weekdays.sat'),
            trans('lang.weekdays.sun'),
        ];
        $months =[
            trans('lang.months.january'),
            trans('lang.months.february'),
            trans('lang.months.march'),
            trans('lang.months.april'),
            trans('lang.months.may'),
            trans('lang.months.june'),
            trans('lang.months.july'),
            trans('lang.months.august'),
            trans('lang.months.september'),
            trans('lang.months.october'),
            trans('lang.months.november'),
            trans('lang.months.december'),
        ];
        $quizzes = Quiz::where('user_id', Auth::user()->id)->get();
        $languages = Language::pluck('title', 'id');
        $locations = Location::pluck('title', 'id');
        $english_levels = Helper::getEnglishLevelList();
        $project_levels = Helper::getProjectLevel();
        $job_duration = Helper::getJobDurationList();
        $provider_level = Helper::getProviderLevelList();
        //dd($provider_level);
        $skills = Skill::pluck('title', 'id');
        $categories = Category::pluck('title', 'id');
        $role_id =  Helper::getRoleByUserID(Auth::user()->id);
        $package_options = Package::select('options')->where('role_id', $role_id)->first();
        $options = !empty($package_options) ? unserialize($package_options['options']) : array();
        if (file_exists(resource_path('views/extend/back-end/employer/jobs/create.blade.php'))) {
            return view(
                'extend.back-end.employer.jobs.create',
                compact(
                    'english_levels',
                    'languages',
                    'project_levels',
                    'job_duration',
                    'provider_level',
                    'skills',
                    'categories',
                    'locations',
                    'options',
                    'weekdays',
                    'months',
                    'quizzes'
                )
            );
        } else {
            return view(
                'back-end.employer.jobs.create',
                compact(
                    'english_levels',
                    'languages',
                    'project_levels',
                    'job_duration',
                    'provider_level',
                    'skills',
                    'categories',
                    'locations',
                    'options',
                    'weekdays',
                    'months',
                    'quizzes'
                )
            );
        }
    }

    public function draftJob($slug)
    {
        $weekdays =[
            trans('lang.weekdays.mon'),
            trans('lang.weekdays.tue'),
            trans('lang.weekdays.wed'),
            trans('lang.weekdays.thu'),
            trans('lang.weekdays.fri'),
            trans('lang.weekdays.sat'),
            trans('lang.weekdays.sun'),
        ];
        $months =[
            trans('lang.months.january'),
            trans('lang.months.february'),
            trans('lang.months.march'),
            trans('lang.months.april'),
            trans('lang.months.may'),
            trans('lang.months.june'),
            trans('lang.months.july'),
            trans('lang.months.august'),
            trans('lang.months.september'),
            trans('lang.months.october'),
            trans('lang.months.november'),
            trans('lang.months.december'),
        ];
        $job = Job::where('slug', $slug)->first();
        $quizzes = Quiz::where('user_id', Auth::user()->id)->get();
        $languages = Language::pluck('title', 'id');
        $locations = Location::pluck('title', 'id');
        $english_levels = Helper::getEnglishLevelList();
        $project_levels = Helper::getProjectLevel();
        $job_duration = Helper::getJobDurationList();
        $provider_level = Helper::getProviderLevelList();
        //dd($provider_level);
        $skills = Skill::pluck('title', 'id');
        $categories = Category::pluck('title', 'id');
        $role_id =  Helper::getRoleByUserID(Auth::user()->id);
        $package_options = Package::select('options')->where('role_id', $role_id)->first();
        $options = !empty($package_options) ? unserialize($package_options['options']) : array();
        if (file_exists(resource_path('views/extend/back-end/employer/jobs/draft.blade.php'))) {
            return view(
                'extend.back-end.employer.jobs.draft',
                compact(
                    'english_levels',
                    'languages',
                    'project_levels',
                    'job_duration',
                    'provider_level',
                    'skills',
                    'categories',
                    'locations',
                    'options',
                    'weekdays',
                    'months',
                    'quizzes',
                    'job'
                )
            );
        } else {
            return view(
                'back-end.employer.jobs.draft',
                compact(
                    'english_levels',
                    'languages',
                    'project_levels',
                    'job_duration',
                    'provider_level',
                    'skills',
                    'categories',
                    'locations',
                    'options',
                    'weekdays',
                    'months',
                    'quizzes',
                    'job'
                )
            );
        }
    }

    /**
     * Manage Jobs.
     *
     * @return manage jobs page
     */
    public function index()
    {
        //dd('this is the test');
        $job_details = $this->job->latest()->where('status', 'posted')->where('user_id', Auth::user()->id)->paginate(10);
        $employer_id = Auth::user()->id;

        if (Auth::user()) {
            $ongoing_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'hired')->get();
            $completed_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'completed')->get();
            $cancelled_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'cancelled')->get();
            $approval_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'approval')->get();
            $rejected_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'rejected')->get();
            $job_draft = Job::where('user_id', $employer_id)->latest()->where('status', 'draft')->get();
            $email = Auth::user()->email;
            $approvers = Approver::where('email', $email)->select('job_id')->get();
            $approver_jobs = Job::whereIn('id', $approvers)->where('status', 'approval')->latest()->get();
            $approver_reject_jobs = Job::whereIn('id', $approvers)->where('status', 'rejected')->latest()->get();

            $approval_jobs = $approval_jobs->merge($approver_jobs);
            $rejected_jobs = $rejected_jobs->merge($approver_reject_jobs);

            
            //dd($approval_jobs);
            $currency   = SiteManagement::getMetaValue('commision');
        }
        //dd(money_format($job_details[0]->price));
        $currency   = SiteManagement::getMetaValue('commision');
        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        if (file_exists(resource_path('views/extend/back-end/employer/jobs/index.blade.php'))) {
            return view('extend.back-end.employer.jobs.index', compact('job_details', 'symbol'));
        } else {
            return view('back-end.employer.jobs.index', compact('job_details', 'ongoing_jobs', 'completed_jobs', 'cancelled_jobs', 'approver_jobs', 'approval_jobs', 'rejected_jobs', 'symbol', 'job_draft')); 
        }
    }

    /**
     * Job Edit Form.
     *
     * @param integer $job_slug Job Slug
     *
     * @return show job edit page
     */
    public function approval($job_slug)
    {
        $job = Job::where('slug', $job_slug)->first();
        $id = Auth::user()->id;
        $user = User::find($id);
        $approver = Approver::where('job_id', $job->id)->where('email', $user->email)->first();
        //dd($approver);
        return View('back-end.employer.jobs.approval', compact('job', 'approver')); 
    }
    public function resetjob($job_slug)
    {
        //dd($job_slug);
        $job = Job::where('slug', $job_slug)->first();
        $job->status = 'approval';
        $job->save();
        $approvers = Approver::where('job_id', $job->id)->get();
        foreach($approvers as $value)
        {
            $value->status = 0;
            $value->save();
        }

        //dd($approver);
        return redirect()->route('employerManageJobs');
    }
    public function cancelled($job_slug)
    {
        $job = Job::where('slug', $job_slug)->first();
        $id = Auth::user()->id;
        $user = User::find($id);
        $approver = Approver::where('job_id', $job->id)->get();
        //dd($approver);
        return View('back-end.employer.jobs.cancelled', compact('job', 'approver'));
    }
    
    public function edit($job_slug)
    {
        if (!empty($job_slug)) {
            $job = Job::where('slug', $job_slug)->first();
            $quizzes = Quiz::where('user_id', Auth::user()->id)->get();
            if(Job_quiz::where('job_id', $job->id)->exists())
            $job_quiz = Job_quiz::where('job_id', $job->id)->get();
            else
            $job_quiz = null;
            $json = array();
            $languages = Language::pluck('title', 'id');
            $locations = Location::pluck('title', 'id');
            $skills = Skill::pluck('title', 'id');
            //dd($languages, $skills);
            $categories = Category::pluck('title', 'id');
            $project_levels = Helper::getProjectLevel();
            $english_levels = Helper::getEnglishLevelList();
            $job_duration = Helper::getJobDurationList();
            $provider_level_list = Helper::getProviderLevelList();
            $attachments = !empty($job->attachments) ? unserialize($job->attachments) : '';
            foreach($quizzes as $quiz)
            {
                if(Job_quiz::where('job_id', $job->id)->where('quiz_id', $quiz->id)->exists())
                    $quiz->selected = true;
                else
                    $quiz->selected = false;
            }
            //dd($quizzes);
            $weekdays =[
                trans('lang.weekdays.mon'),
                trans('lang.weekdays.tue'),
                trans('lang.weekdays.wed'),
                trans('lang.weekdays.thu'),
                trans('lang.weekdays.fri'),
                trans('lang.weekdays.sat'),
                trans('lang.weekdays.sun'),
            ];
            $months =[
                trans('lang.months.january'),
                trans('lang.months.february'),
                trans('lang.months.march'),
                trans('lang.months.april'),
                trans('lang.months.may'),
                trans('lang.months.june'),
                trans('lang.months.july'),
                trans('lang.months.august'),
                trans('lang.months.september'),
                trans('lang.months.october'),
                trans('lang.months.november'),
                trans('lang.months.december'),
            ];
            if (!empty($job)) {
                if (file_exists(resource_path('views/extend/back-end/employer/jobs/edit.blade.php'))) {
                    return View(
                        'extend.back-end.employer.jobs.edit',
                        compact(
                            'job',
                            'project_levels',
                            'english_levels',
                            'job_duration',
                            'provider_level_list',
                            'languages',
                            'categories',
                            'skills',
                            'locations',
                            'attachments',
                            'weekdays',
                            'months',
                            'quizzes',
                            'job_quiz'
                        )
                    );
                } else {
                    return View(
                        'back-end.employer.jobs.edit',
                        compact(
                            'job',
                            'project_levels',
                            'english_levels',
                            'job_duration',
                            'provider_level_list',
                            'languages',
                            'categories',
                            'skills',
                            'locations',
                            'attachments',
                            'weekdays',
                            'months',
                            'quizzes',
                            'job_quiz'
                        )
                    );
                }
            }
        }
    }

    /**
     * Get job attachment settings.
     *
     * @param integer $request $request->attributes
     *
     * @return show job single page
     */
    public function getAttachmentSettings(Request $request)
    {
        $json = array();
        if ($request['slug']) {
            $settings = Job::where('slug', $request['slug'])
                ->select('is_featured', 'show_attachments')->first();
            if (!empty($settings)) {
                $json['type'] = 'success';
                if ($settings->is_featured == 'true') {
                    $json['is_featured'] = 'true';
                }
                if ($settings->show_attachments == 'true') {
                    $json['show_attachments'] = 'true';
                }
            } else {
                $json['type'] = 'error';
            }
            return $json;
        }
    }

    /**
     * Upload image to temporary folder.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadTempImage(Request $request)
    {
        if (!empty($request['file'])) {
            $attachments = $request['file'];
            $path = 'uploads/jobs/temp/';
            return $this->job->uploadTempattachments($attachments, $path);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storejob(Request $request)
    {
        //dd($request->all());
        $random_number = Helper::generateRandomCode(8);
        $code = strtoupper($random_number);
        $slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
        $user_id = Auth::user()->id;
        return Job::create([
            'title' => $request->title,
            'slug' => $slug,
            'project_level' => '',
            'provider_type' => '',
            'english_level' => '',
            'code' => $code,
            'user_id' => $user_id
        ]);
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $json = array();
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (Helper::getAccessType() == 'services') {
            $json['type'] = 'job_warning';
            return $json;
        }
        if (Auth::user()->user_verified == 1) {
            $job = Job::find($request->job_id);
            if (!$job->title) {
                $json['type'] = 'error';
                $json['message'] = 'Title is required';
                return $json;
            }
            if (!$job->description) {
                $json['type'] = 'error';
                $json['message'] = 'Description is required';
                return $json;
            }
            if (!$job->project_level) {
                $json['type'] = 'error';
                $json['message'] = 'Project level is required';
                return $json;
            }
            if (!$job->price) {
                $json['type'] = 'error';
                $json['message'] = 'Cost is required';
                return $json;
            }
            if (!$job->expiry_date) {
                $json['type'] = 'error';
                $json['message'] = 'Delivery date is required';
                return $json;
            }
            /*validate job data is completed or not.
            title
            description
            project_levels
            job_duration
            provider_type
            english_level
            project_cost
            expiry_date
            
            */
            
            /*if (Schema::hasColumn('jobs', 'expiry_date')) {
                if ($request['expiry_date'] == trans('lang.project_expiry')) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.job_expiry_req');
                    return $json;
                }
                $expiry = Carbon::parse($request['expiry_date']);
                if ($expiry->lessThan(Carbon::now())) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.past_expiry_date');
                    return $json;
                }
                $this->validate($request, ['expiry_date' => 'required']);
            }*/
            
            $package_item = Item::where('subscriber', Auth::user()->id)->first();
            $package = !empty($package_item) ? Package::find($package_item->product_id) : '';
            if(!$package)
            {
                //dd('no package added');
                $json['type'] = 'error';
                $json['message'] = trans('lang.no_pkg_found');
                return $json;
            }
            $option = !empty($package) ? unserialize($package->options) : '';
            //dd($option);
            $expiry = !empty($option) ? $package_item->updated_at->addDays($option['duration']) : '';
            $expiry = !empty($option) ? $package_item->created_at->addDays($option['duration']) : '';
            $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->format('Y-m-d') : '';
            $current_date = Carbon::now()->format('Y-m-d');
            $posted_jobs = $this->job::where('user_id', Auth::user()->id)->where('created_at', '>',  $package->updated_at)->count();
            $posted_jobs = $this->job::where('user_id', Auth::user()->id)->count();
            $posted_featured_jobs = Job::where('user_id', Auth::user()->id)->where('is_featured', 'true')->count();
            $payment_settings = SiteManagement::getMetaValue('commision');
            $package_status = '';
            if (empty($payment_settings)) {
                $package_status = 'true';
            } else {
                $package_status = !empty($payment_settings[0]['employer_package']) ? $payment_settings[0]['employer_package'] : 'true';
            }
            if ($package_status === 'true') {
                /*if ($current_date > $expiry_date) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.need_to_purchase_pkg');
                    return $json;
                }*/
                /*if ($request['is_featured'] == 'true') {
                    if ($posted_featured_jobs >= intval($option['featured_jobs'])) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.sorry_can_only_feature')  .' '. $option['featured_jobs'] .' ' . trans('lang.jobs_acc_to_pkg');
                        return $json;
                    }
                }
                if ($posted_jobs >= intval($option['jobs'])) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.sorry_cannot_submit') .' '. $option['jobs'] .' ' . trans('lang.jobs_acc_to_pkg');
                    return $json;
                } else {*/
                    $job_post = $this->job->storeJobs($request);
                    //dd($job_post);

                    if ($job_post = 'success') {
                        $job->status = 'posted';
                        $job->save();
                        $json['type'] = 'success';
                        $json['status'] = 'posted';
                        $json['message'] = trans('lang.job_post_success');
                        $job = Job::where('user_id', Auth::user()->id)->latest()->first();
                        $user = User::find(Auth::user()->id);
                        $teams = $request->team;
                        //$approvers = Approver::where('job_id', $job->id)->exists();
                        if(Approver::where('job_id', $job->id)->exists())
                        {
                            $job->status = 'approval';
                            $json['status'] = 'approval';
                            $job->save();
                            /*foreach($approvers as $key => $approver)
                            {
                                //dd($team['name'], $key);
                                Approver::create([
                                    'name' => $approver[0],
                                    'email' => $approver[4],
                                    'lname' => $approver[1],
                                    'role' => $approver[2],
                                    'permission' => $approver[3],
                                    'job_id' => $job->id
                                ]);
                                
                                
                                if(User::where('email', $approver[4])->exists())
                                {
                                    //Mail::to($approver['email'])->send(new Approverinvite($job));
                                    //Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                                }
                                else{
                                    $user = new User;
                                    $user->first_name = $approver[0];
                                    $user->last_name = $approver[1];
                                    $user->slug = $approver[0].'-'.$approver[1];
                                    $user->user_verified = 1;
                                    $user->password = Hash::make('password');
                                    $user->email = $approver[4];
                                    $user->save();
                                    $user->assignRole('employer');
                                    $profile = new Profile();
                                    $profile->user()->associate($user->id);
                                    $profile->save();
                                    //Mail::to($user['email'])->send(new Approveruserinvite($user, $job));
                                    //Mail::to('sadiqueali786@gmail.com')->send(new Approveruserinvite($user, $job));
                                }
                                

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
                            }*/

                        }
                        /*if($teams)
                        {
                            foreach($teams as $key => $team)
                            {
                                //dd($team['name'], $key);
                                Team::create([
                                    'name' => $team[0],
                                    'lname' => $team[1],
                                    'role' => $team[2],
                                    'permission' => $team[3],
                                    'email' => $team[4],
                                    'job_id' => $job->id
                                ]);
                                
                                if($approvers)
                                {}
                                else {
                                    if(User::where('email', $team[4])->exists())
                                    {
                                        Mail::to($team[4])->send(new TeamInvite($job));
                                        Mail::to('sadiqueali786@gmail.com')->send(new TeamInvite($job));
                                    }
                                    else{
                                        $user = new User;
                                        $user->first_name = $team[0];
                                        $user->last_name = $team[1];
                                        $user->slug = $team[0].'-'.$team[1];
                                        $user->user_verified = 1;
                                        $user->password = Hash::make('password');
                                        $user->email = $team[4];
                                        $user->save();
                                        $user->assignRole('provider');
                                        $profile = new Profile();
                                        $profile->user()->associate($user->id);
                                        $profile->save();
                                        Mail::to($team[4])->send(new UserInvite($user, $job));
                                        Mail::to('sadiqueali786@gmail.com')->send(new UserInvite($user, $job));
                                    }
                                }

                            }
                        }*/
                        
                        // Send Email
                        /*if($approvers)
                        {
                            if($request->invited_providers)
                            {
                                foreach($request->invited_providers as $key => $email)
                                {
                                    $emails = $emails.", ".$email;
                                }
                            $providerinvite = new Providerinvite;
                            $providerinvite->providers = $request->emails;
                            $providerinvite->job_id = $job->id;
                            $providerinvite->email_text = $request->email_text;
                            $providerinvite->save();
                            }
                        }
                        else
                        {
                            if($request->invited_providers)
                            {
                                //$providerinvite = new Providerinvite;
                                //$providerinvite->providers = $emails;
                                //$providerinvite->job_id = $job->id;
                                //$providerinvite->email_text = $request->email_text;
                                //$providerinvite->save();
                                $emails = "";
                                
                                foreach($request->invited_providers as $key => $email)
                                {
                                    //Mail::to($email)->send(new Inviteprovider($user, $job->slug));
                                    $name = $user->first_name.' '.$user->last_name;
                                    $link = '<a href="http://worketic.apnahive.com/job/'. $job->slug .'">Link</a>';
                                    $messagex = str_replace('{name}', $name, $request->email_text);
                                    $messagex = str_replace('{Link}', $link, $messagex);
                                    $message1 = str_replace(array("\r","\n",'\r','\n'), "<br>", $messagex);
                                    $message1 = str_replace(array("<br><br>"), "<br>", $message1);
                                    Mail::to($email)->send(new Inviteraw($message1));
                                    Mail::to('sadiqueali786@gmail.com')->send(new Inviteraw($message1));
                                    //dd('email sent');
                                    $emails = $emails.", ".$email;
                                }
                                $providerinvite = new Providerinvite;
                                $providerinvite->providers = $emails;
                                $providerinvite->job_id = $job->id;
                                $providerinvite->email_text = $request->email_text;
                                $providerinvite->save();
                            }
                        }*/
                        //send email to admin
                        if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                            //$job = $this->job::where('user_id', Auth::user()->id)->latest()->first();
                            $email_params = array();
                            $new_posted_job_template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_new_job_posted')->get()->first();
                            $new_posted_job_template_employer = DB::table('email_types')->select('id')->where('email_type', 'employer_email_new_job_posted')->get()->first();
                            if (!empty($new_posted_job_template->id) || !empty(new_posted_job_template_employer)) {
                                $template_data = EmailTemplate::getEmailTemplateByID($new_posted_job_template->id);
                                $template_data_employer = EmailTemplate::getEmailTemplateByID($new_posted_job_template_employer->id);
                                $email_params['job_title'] = $job->title;
                                $email_params['posted_job_link'] = url('/job/' . $job->slug);
                                $email_params['name'] = Helper::getUserName(Auth::user()->id);
                                $email_params['link'] = url('profile/' . $user->slug);
                                Mail::to(config('mail.username'))
                                ->send(
                                    new AdminEmailMailable(
                                        'admin_email_new_job_posted',
                                        $template_data,
                                        $email_params
                                    )
                                );
                                if (!empty($user->email)) {
                                    Mail::to($user->email)
                                    ->send(
                                        new EmployerEmailMailable(
                                            'employer_email_new_job_posted',
                                            $template_data_employer,
                                            $email_params
                                        )
                                    );
                                }
                            }
                        }
                        return $json;
                    //}
                }
            } else {
                $job_post = $this->job->storeJobs($request);
                if ($job_post = 'success') {
                    $job->status = 'posted';
                    $job->save();
                    $json['type'] = 'success';
                    $json['status'] = 'posted';
                    $json['message'] = trans('lang.job_post_success');
                    // Send Email
                    $user = User::find(Auth::user()->id);
                    //send email to admin
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        //$job = $this->job::where('user_id', Auth::user()->id)->latest()->first();
                        $email_params = array();
                        $new_posted_job_template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_new_job_posted')->get()->first();
                        $new_posted_job_template_employer = DB::table('email_types')->select('id')->where('email_type', 'employer_email_new_job_posted')->get()->first();
                        if (!empty($new_posted_job_template->id) || !empty($new_posted_job_template_employer)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($new_posted_job_template->id);
                            $template_data_employer = EmailTemplate::getEmailTemplateByID($new_posted_job_template_employer->id);
                            $email_params['job_title'] = $job->title;
                            $email_params['posted_job_link'] = url('/job/' . $job->slug);
                            $email_params['name'] = Helper::getUserName(Auth::user()->id);
                            $email_params['link'] = url('profile/' . $user->slug);
                            Mail::to(config('mail.username'))
                            ->send(
                                new AdminEmailMailable(
                                    'admin_email_new_job_posted',
                                    $template_data,
                                    $email_params
                                )
                            );
                            if (!empty($user->email)) {
                                Mail::to($user->email)
                                ->send(
                                    new EmployerEmailMailable(
                                        'employer_email_new_job_posted',
                                        $template_data_employer,
                                        $email_params
                                    )
                                );
                            }
                        }
                    }
                    return $json;
                }
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.verify_accnt_post_job');
            return $json;
        }
    }
    public function store1(Request $request)
    {
        //dd($request->all());
        /*$link = '<a href="http://worketic.apnahive.com/job/one">Link</a>';
        $messagex = str_replace('{Link}', $link, $request->email_text);
        $message1 = str_replace(array("\r","\n",'\r','\n'), "<br>", $messagex);
        $message1 = str_replace(array("<br><br>"), "<br>", $message1);
        Mail::to('sadiqueali786@gmail.com')->send(new Inviteraw($message1));
        dd($message1);*/
        if($request->email_text)
        {}
        else{
            $request->email_text = "Hello Sir/Mam,\nI want to invite you to make a proposal for my project.\n\nFor the further information, please click the invitation below.\n\n{Link}\n\nThanks in advance,\n{name}";
        }
        
        //dd('email sent');
        
        
        //convert values
        $request->provider_type = $request->freelancer;
        $request->english_level = $request->english;
        $request->project_levels = $request->project_level;
        $request->job_duration = $request->project_duration;
        
        //$languages = $request->langs;
        //$request->languages = $languages;
        
        $request->sub_skill = $request->subskills;
        $request->categories = $request->category;
        $request->sub_cat = $request->subcategory;
        $request->team = $request->teams;
        $request->approver = $request->approvers;
        $request->job_duration = $request->project_duration;
        //dd($request->sub_skill);
        $json = array();
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (Helper::getAccessType() == 'services') {
            $json['type'] = 'job_warning';
            return $json;
        }
        if (Auth::user()->user_verified == 1) {
            $this->validate(
                $request,
                [
                    'title' => 'required',
                    //'project_levels'    => 'required',
                    //'job_duration'    => 'required',
                    //'provider_type'    => 'required',
                    //'english_level'    => 'required',
                    //'project_cost'    => 'required',
                    'description'    => 'required',
                ]
            );
            /*if (Schema::hasColumn('jobs', 'expiry_date')) {
                if ($request['expiry_date'] == trans('lang.project_expiry')) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.job_expiry_req');
                    return $json;
                }
                $expiry = Carbon::parse($request['expiry_date']);
                if ($expiry->lessThan(Carbon::now())) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.past_expiry_date');
                    return $json;
                }
                $this->validate($request, ['expiry_date' => 'required']);
            }*/
            if (!empty($request['latitude']) || !empty($request['longitude'])) {
                $this->validate(
                    $request,
                    [
                        'latitude' => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                        'longitude' => ['regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                    ]
                );
            }
            $package_item = Item::where('subscriber', Auth::user()->id)->first();
            $package = !empty($package_item) ? Package::find($package_item->product_id) : '';
            if(!$package)
            {
                //dd('no package added');
                $json['type'] = 'error';
                $json['message'] = trans('lang.no_pkg_found');
                return $json;
            }
            $option = !empty($package) ? unserialize($package->options) : '';
            $expiry = !empty($option) ? $package_item->updated_at->addDays($option['duration']) : '';
            $expiry = !empty($option) ? $package_item->created_at->addDays($option['duration']) : '';
            $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->format('Y-m-d') : '';
            $current_date = Carbon::now()->format('Y-m-d');
            $posted_jobs = $this->job::where('user_id', Auth::user()->id)->where('created_at', '>',  $package->updated_at)->count();
            $posted_jobs = $this->job::where('user_id', Auth::user()->id)->count();
            $posted_featured_jobs = Job::where('user_id', Auth::user()->id)->where('is_featured', 'true')->count();
            $payment_settings = SiteManagement::getMetaValue('commision');
            $package_status = '';
            if (empty($payment_settings)) {
                $package_status = 'true';
            } else {
                $package_status = !empty($payment_settings[0]['employer_package']) ? $payment_settings[0]['employer_package'] : 'true';
            }
            if ($package_status === 'true') {
                if ($current_date > $expiry_date) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.need_to_purchase_pkg');
                    return $json;
                }
                if ($request['is_featured'] == 'true') {
                    if ($posted_featured_jobs >= intval($option['featured_jobs'])) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.sorry_can_only_feature')  .' '. $option['featured_jobs'] .' ' . trans('lang.jobs_acc_to_pkg');
                        return $json;
                    }
                }
                if ($posted_jobs >= intval($option['jobs'])) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.sorry_cannot_submit') .' '. $option['jobs'] .' ' . trans('lang.jobs_acc_to_pkg');
                    return $json;
                } else {
                    $job_post = $this->job->storeJobs($request);
                    //dd($job_post);
                    if ($job_post = 'success') {
                        $json['type'] = 'success';
                        $json['message'] = trans('lang.job_post_success');
                        $job = Job::where('user_id', Auth::user()->id)->latest()->first();
                        $user = User::find(Auth::user()->id);
                        $teams = $request->team;
                        $approvers = $request->approver;
                        if($approvers)
                        {
                            $job->status = 'approval';
                            $job->save();
                            foreach($approvers as $key => $approver)
                            {
                                //dd($team['name'], $key);
                                Approver::create([
                                    'name' => $approver[0],
                                    'email' => $approver[4],
                                    'lname' => $approver[1],
                                    'role' => $approver[2],
                                    'permission' => $approver[3],
                                    'job_id' => $job->id
                                ]);
                                
                                
                                if(User::where('email', $approver[4])->exists())
                                {
                                    //Mail::to($approver['email'])->send(new Approverinvite($job));
                                    //Mail::to('sadiqueali786@gmail.com')->send(new Approverinvite($job));
                                }
                                else{
                                    $user = new User;
                                    $user->first_name = $approver[0];
                                    $user->last_name = $approver[1];
                                    $user->slug = $approver[0].'-'.$approver[1];
                                    $user->user_verified = 1;
                                    $user->password = Hash::make('password');
                                    $user->email = $approver[4];
                                    $user->save();
                                    $user->assignRole('employer');
                                    $profile = new Profile();
                                    $profile->user()->associate($user->id);
                                    $profile->save();
                                    //Mail::to($user['email'])->send(new Approveruserinvite($user, $job));
                                    //Mail::to('sadiqueali786@gmail.com')->send(new Approveruserinvite($user, $job));
                                }
                                

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

                        }
                        if($teams)
                        {
                            foreach($teams as $key => $team)
                            {
                                //dd($team['name'], $key);
                                Team::create([
                                    'name' => $team[0],
                                    'lname' => $team[1],
                                    'role' => $team[2],
                                    'permission' => $team[3],
                                    'email' => $team[4],
                                    'job_id' => $job->id
                                ]);
                                
                                if($approvers)
                                {}
                                else {
                                    if(User::where('email', $team[4])->exists())
                                    {
                                        Mail::to($team[4])->send(new TeamInvite($job));
                                        Mail::to('sadiqueali786@gmail.com')->send(new TeamInvite($job));
                                    }
                                    else{
                                        $user = new User;
                                        $user->first_name = $team[0];
                                        $user->last_name = $team[1];
                                        $user->slug = $team[0].'-'.$team[1];
                                        $user->user_verified = 1;
                                        $user->password = Hash::make('password');
                                        $user->email = $team[4];
                                        $user->save();
                                        $user->assignRole('provider');
                                        $profile = new Profile();
                                        $profile->user()->associate($user->id);
                                        $profile->save();
                                        Mail::to($team[4])->send(new UserInvite($user, $job));
                                        Mail::to('sadiqueali786@gmail.com')->send(new UserInvite($user, $job));
                                    }
                                }

                            }
                        }
                        
                        // Send Email
                        if($approvers)
                        {
                            if($request->invited_freelancers)
                            {
                                foreach($request->invited_freelancers as $key => $email)
                                {
                                    $emails = $emails.", ".$email;
                                }
                            $providerinvite = new Providerinvite;
                            $providerinvite->providers = $request->emails;
                            $providerinvite->job_id = $job->id;
                            $providerinvite->email_text = $request->email_text;
                            $providerinvite->save();
                            }
                        }
                        else
                        {
                            if($request->invited_freelancers)
                            {
                                /*$providerinvite = new Providerinvite;
                                $providerinvite->providers = $emails;
                                $providerinvite->job_id = $job->id;
                                $providerinvite->email_text = $request->email_text;
                                $providerinvite->save();*/
                                $emails = "";
                                
                                foreach($request->invited_freelancers as $key => $email)
                                {
                                    //Mail::to($email)->send(new InviteFreelancer($user, $job->slug));
                                    $name = $user->first_name.' '.$user->last_name;
                                    $link = '<a href="http://buyniverse.com/job/'. $job->slug .'">Link</a>';
                                    $messagex = str_replace('{name}', $name, $request->email_text);
                                    $messagex = str_replace('{Link}', $link, $messagex);
                                    $message1 = str_replace(array("\r","\n",'\r','\n'), "<br>", $messagex);
                                    $message1 = str_replace(array("<br><br>"), "<br>", $message1);
                                    Mail::to($email)->send(new Inviteraw($message1));
                                    Mail::to('sadiqueali786@gmail.com')->send(new Inviteraw($message1));
                                    //dd('email sent');
                                    $emails = $emails.", ".$email;
                                }
                                $providerinvite = new Providerinvite;
                                $providerinvite->providers = $emails;
                                $providerinvite->job_id = $job->id;
                                $providerinvite->email_text = $request->email_text;
                                $providerinvite->save();
                            }
                        }
                        //send email to admin
                        if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                            //$job = $this->job::where('user_id', Auth::user()->id)->latest()->first();
                            $email_params = array();
                            $new_posted_job_template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_new_job_posted')->get()->first();
                            $new_posted_job_template_employer = DB::table('email_types')->select('id')->where('email_type', 'employer_email_new_job_posted')->get()->first();
                            if (!empty($new_posted_job_template->id) || !empty(new_posted_job_template_employer)) {
                                $template_data = EmailTemplate::getEmailTemplateByID($new_posted_job_template->id);
                                $template_data_employer = EmailTemplate::getEmailTemplateByID($new_posted_job_template_employer->id);
                                $email_params['job_title'] = $job->title;
                                $email_params['posted_job_link'] = url('/job/' . $job->slug);
                                $email_params['name'] = Helper::getUserName(Auth::user()->id);
                                $email_params['link'] = url('profile/' . $user->slug);
                                Mail::to(config('mail.username'))
                                ->send(
                                    new AdminEmailMailable(
                                        'admin_email_new_job_posted',
                                        $template_data,
                                        $email_params
                                    )
                                );
                                if (!empty($user->email)) {
                                    Mail::to($user->email)
                                    ->send(
                                        new EmployerEmailMailable(
                                            'employer_email_new_job_posted',
                                            $template_data_employer,
                                            $email_params
                                        )
                                    );
                                }
                            }
                        }
                        return $json;
                    }
                }
            } else {
                $job_post = $this->job->storeJobs($request);
                if ($job_post = 'success') {
                    $json['type'] = 'success';
                    $json['message'] = trans('lang.job_post_success');
                    // Send Email
                    $user = User::find(Auth::user()->id);
                    //send email to admin
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $job = $this->job::where('user_id', Auth::user()->id)->latest()->first();
                        $email_params = array();
                        $new_posted_job_template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_new_job_posted')->get()->first();
                        $new_posted_job_template_employer = DB::table('email_types')->select('id')->where('email_type', 'employer_email_new_job_posted')->get()->first();
                        if (!empty($new_posted_job_template->id) || !empty($new_posted_job_template_employer)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($new_posted_job_template->id);
                            $template_data_employer = EmailTemplate::getEmailTemplateByID($new_posted_job_template_employer->id);
                            $email_params['job_title'] = $job->title;
                            $email_params['posted_job_link'] = url('/job/' . $job->slug);
                            $email_params['name'] = Helper::getUserName(Auth::user()->id);
                            $email_params['link'] = url('profile/' . $user->slug);
                            Mail::to(config('mail.username'))
                            ->send(
                                new AdminEmailMailable(
                                    'admin_email_new_job_posted',
                                    $template_data,
                                    $email_params
                                )
                            );
                            if (!empty($user->email)) {
                                Mail::to($user->email)
                                ->send(
                                    new EmployerEmailMailable(
                                        'employer_email_new_job_posted',
                                        $template_data_employer,
                                        $email_params
                                    )
                                );
                            }
                        }
                    }
                    return $json;
                }
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.verify_accnt_post_job');
            return $json;
        }
    }

    /**
     * Updated resource in DB.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $this->validate(
            $request,
            [
                'title' => 'required',
                'project_levels'    => 'required',
                'english_level'    => 'required',
                'project_cost'    => 'required',
            ]
        );
        if (Schema::hasColumn('jobs', 'expiry_date')) {
            if ($request['expiry_date'] == trans('lang.project_expiry')) {
                $json['type'] = 'error';
                $json['message'] = trans('lang.job_expiry_req');
                return $json;
            }
            $expiry = Carbon::parse($request['expiry_date']);
            if ($expiry->lessThan(Carbon::now())) {
                $json['type'] = 'error';
                $json['message'] = trans('lang.past_expiry_date');
                return $json;
            }
            $this->validate($request, ['expiry_date' => 'required']);
        }
        if (!empty($request['latitude']) || !empty($request['longitude'])) {
            $this->validate(
                $request,
                [
                    'latitude' => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                    'longitude' => ['regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                ]
            ); 
        }
        $id = $request['id'];
        $job_update = $this->job->updateJobs($request, $id);
        if ($job_update['type'] = 'success') {
            $json['type'] = 'success';
            $json['role'] = Auth::user()->getRoleNames()->first();
            $json['message'] = trans('lang.job_update_success');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $slug Job Slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $job = $this->job::all()->where('slug', $slug)->first();
        if (!empty($job)) {
            $submitted_proposals = $job->proposals->where('status', '!=', 'cancelled')->pluck('provider_id')->toArray();
            $employer_id = !empty($job->employer) ? $job->employer->id : '';
            $profile = !empty($employer_id) ? User::find($employer_id)->profile : '';
            $user_image = !empty($profile) ? $profile->avater : '';
            $profile_image = !empty($user_image) ? '/uploads/users/' . $job->employer->id . '/' . $user_image : 'images/user-login.png';
            $reasons = Helper::getReportReasons();
            $auth_profile = Auth::user() ? auth()->user()->profile : '';
            $save_jobs = !empty($auth_profile->saved_jobs) ? unserialize($auth_profile->saved_jobs) : array();
            $save_employers = !empty($auth_profile->saved_employers) ? unserialize($auth_profile->saved_employers) : array();
            $attachments  = unserialize($job->attachments);
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            $project_type  = Helper::getProjectTypeList($job->project_type);
            $breadcrumbs_settings = SiteManagement::getMetaValue('show_breadcrumb');
            $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';
            $inner_page  = SiteManagement::getMetaValue('inner_page_data');
            $job_inner_banner = !empty($inner_page) && !empty($inner_page[0]['job_inner_banner']) ? $inner_page[0]['job_inner_banner'] : null;
            if (file_exists(resource_path('views/extend/front-end/jobs/show.blade.php'))) {
                return view(
                    'extend.front-end.jobs.show',
                    compact(
                        'job',
                        'reasons',
                        'profile_image',
                        'submitted_proposals',
                        'save_jobs',
                        'save_employers',
                        'attachments',
                        'symbol',
                        'project_type',
                        'show_breadcrumbs',
                        'job_inner_banner'
                    )
                );
            } else {
                return view(
                    'front-end.jobs.show',
                    compact(
                        'job',
                        'reasons',
                        'profile_image',
                        'submitted_proposals',
                        'save_jobs',
                        'save_employers',
                        'attachments',
                        'symbol',
                        'project_type',
                        'show_breadcrumbs',
                        'job_inner_banner'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get job Skills.
     *
     * @param mixed $request $req->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobSkills(Request $request)
    {
        $json = array();
        if (!empty($request['slug'])) {
            $job = $this->job::where('slug', $request['slug'])->select('id')->first();
            if (!empty($job)) {
                $jobs = $this->job::find($job['id']);
                $skills = $jobs->skills->toArray();
                if (!empty($skills)) {
                    $json['type'] = 'success';
                    $json['skills'] = $skills;
                    return $json;
                } else {
                    $json['error'] = 'error';
                    return $json;
                }
            } else {
                $json['error'] = 'error';
                return $json;
            }
        }
    }

    /**
     * Display admin jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobsAdmin(Request $request)
    {
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $jobs = $this->job::where('title', 'like', '%' . $keyword . '%')->paginate(6)->setPath('');
            $pagination = $jobs->appends(
                array(
                    'keyword' => $request->get('keyword')
                )
            );
        } else {
            $jobs = $this->job->latest()->paginate(6);
        }
        $payment   = SiteManagement::getMetaValue('commision');
        $symbol = !empty($payment) && !empty($payment[0]['currency']) ? Helper::currencyList($payment[0]['currency']) : array();
        $payment_methods = Arr::pluck(Helper::getPaymentMethodList(), 'title', 'value');
        if (file_exists(resource_path('views/extend/back-end/admin/jobs/index.blade.php'))) {
            return view(
                'extend.back-end.admin.jobs.index',
                compact('jobs', 'symbol', 'payment', 'payment_methods')
            );
        } else {
            return view(
                'back-end.admin.jobs.index',
                compact('jobs', 'symbol', 'payment', 'payment_methods')
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listjobs()
    {
        $jobs = array();
        $categories = array();
        $locations = array();
        $languages = array();
        $jobs = $this->job->latest()->paginate(6);
        $categories = Category::all();
        $locations = Location::all();
        $languages = Language::all();
        $freelancer_skills = Helper::getProviderLevelList();
        $project_length = Helper::getJobDurationList();
        $skills = Skill::all();
        $keyword = '';
        $address = '';
        $Jobs_total_records = '';
        $type = 'job';
        $currency = SiteManagement::getMetaValue('commision');
        $symbol   = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        $job_list_meta_title = !empty($inner_page) && !empty($inner_page[0]['job_list_meta_title']) ? $inner_page[0]['job_list_meta_title'] : trans('lang.job_listing');
        $job_list_meta_desc = !empty($inner_page) && !empty($inner_page[0]['job_list_meta_desc']) ? $inner_page[0]['job_list_meta_desc'] : trans('lang.job_meta_desc');
        $show_job_banner = !empty($inner_page) && !empty($inner_page[0]['show_job_banner']) ? $inner_page[0]['show_job_banner'] : 'true';
        $job_inner_banner = !empty($inner_page) && !empty($inner_page[0]['job_inner_banner']) ? $inner_page[0]['job_inner_banner'] : null;
        if (file_exists(resource_path('views/extend/front-end/jobs/index.blade.php'))) {
            return view(
                'extend.front-end.jobs.index',
                compact(
                    'address',
                    'jobs',
                    'categories',
                    'locations',
                    'languages',
                    'freelancer_skills',
                    'project_length',
                    'keyword',
                    'Jobs_total_records',
                    'type',
                    'skills',
                    'symbol',
                    'job_list_meta_title',
                    'job_list_meta_desc',
                    'show_job_banner',
                    'job_inner_banner'
                )
            );
        } else {
            return view(
                'front-end.jobs.index',
                compact(
                    'address',
                    'jobs',
                    'categories',
                    'locations',
                    'languages',
                    'freelancer_skills',
                    'project_length',
                    'keyword',
                    'Jobs_total_records',
                    'type',
                    'skills',
                    'symbol',
                    'job_list_meta_title',
                    'job_list_meta_desc',
                    'show_job_banner',
                    'job_inner_banner'
                )
            );
        }
    }

    /**
     * Add job to whishlist.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function addWishlist(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            if (!empty($request['id'])) {
                $user_id = Auth::user()->id;
                $id = $request['id'];
                $profile = new Profile();
                $add_wishlist = $profile->addWishlist($request['column'], $id, $user_id);
                if ($add_wishlist == "success") {
                    $json['type'] = 'success';
                    $json['message'] = trans('lang.added_to_wishlist');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $json['type'] = 'authentication';
            $json['message'] = trans('lang.need_to_reg');
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['job_id'];
        if (!empty($id)) {
            $this->job->deleteRecord($id);
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Get Latest Jobs
     *
     * @return \Illuminate\Http\Response
     */
    public function getLatestJobs(Request $request)
    {
        $page = $request['page'];
        $per_page = $request['per_page'];
        $json = array();
        Paginator::currentPageResolver(
            function () use ($page) {
                return $page;
            }
        );
        $jobs = $this->job->latest()->paginate($per_page);
        $latest_jobs = array();
        if (!empty($jobs)) {
            foreach ($jobs as $key => $job) {
                if (Schema::hasColumn('jobs', 'expiry_date') && !empty($job->expiry_date)) {
                    $expiry = Carbon::parse($job->expiry_date);
                    if (Carbon::now()->lessThan($expiry)) {
                        $user = User::find($job->user_id);
                        $latest_jobs[$key]['id'] = $job->id;
                        $latest_jobs[$key]['slug'] = $job->slug;
                        $latest_jobs[$key]['user_slug'] = $user->slug;
                        $latest_jobs[$key]['user_name'] = Helper::getUserName($job->user_id);
                        $latest_jobs[$key]['title'] =!empty($job->title) ? $job->title :'';
                        $latest_jobs[$key]['user_image'] = asset(Helper::getProfileImage($job->user_id));
                        $latest_jobs[$key]['location'] = !empty($job->location->title) ? $job->location->title :'';
                        $latest_jobs[$key]['price'] = !empty($job->price) ? $job->price :'';
                        $latest_jobs[$key]['duration'] = !empty($job->duration) ?  Helper::getJobDurationList($job->duration) : '';
                        $currency   = SiteManagement::getMetaValue('commision');
                        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                        $latest_jobs[$key]['symbol'] = !empty($symbol['symbol']) ? $symbol['symbol'] : '$';
                        $latest_jobs[$key]['skills'] = !empty($job->skills) ? $job->skills->toArray() : array();
                        $latest_jobs[$key]['saved_jobs'] = !empty(auth()->user()->profile->saved_jobs) ? unserialize(auth()->user()->profile->saved_jobs) : array();
                        $latest_jobs[$key]['expiry_date'] = date('d-m-Y', strtotime($job->expiry_date));
                    }
                } else {
                    $user = User::find($job->user_id);
                    $latest_jobs[$key]['id'] = $job->id;
                    $latest_jobs[$key]['slug'] = $job->slug;
                    $latest_jobs[$key]['user_slug'] = $user->slug;
                    $latest_jobs[$key]['user_name'] = Helper::getUserName($job->user_id);
                    $latest_jobs[$key]['title'] =!empty($job->title) ? $job->title :'';
                    $latest_jobs[$key]['user_image'] = asset(Helper::getProfileImage($job->user_id));
                    $latest_jobs[$key]['location'] = !empty($job->location->title) ? $job->location->title :'';
                    $latest_jobs[$key]['price'] = !empty($job->price) ? $job->price :'';
                    $latest_jobs[$key]['duration'] = !empty($job->duration) ?  Helper::getJobDurationList($job->duration) :'';
                    $currency   = SiteManagement::getMetaValue('commision');
                    $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                    $latest_jobs[$key]['symbol'] = !empty($symbol['symbol']) ? $symbol['symbol'] : '$';
                    $latest_jobs[$key]['skills'] = !empty($job->skills) ? $job->skills->toArray() : array();
                    $latest_jobs[$key]['saved_jobs'] = !empty(auth()->user()->profile->saved_jobs) ? unserialize(auth()->user()->profile->saved_jobs) : array();
                }
            }
        }
        if (!empty($latest_jobs)) {
            $json['type'] = 'success';
            $json['jobs'] = $latest_jobs;
            $json['current_page'] = $jobs->currentPage();
            $json['last_page'] = $jobs->lastPage();
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
