<?php

/**
 * Class ProviderController.
 *
 
 */
namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use App\Helper;
use App\Location;
use App\Skill;
use Session;
use App\Profile;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Proposal;
use App\Job;
use DB;
use App\Package;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use ValidateRequests;
use App\Item;
use Carbon\Carbon;
use App\Message;
use App\Payout;
use App\SiteManagement;
use App\Service;
use App\Review;
use App\Live_contest;
use App\Live_contest_participant;
use App\Team;
use App\Provider_type;
use App\English_level;
use App\Category;
use App\Language;
use App\Fteam;




/**
 * Class ProviderController
 *
 */
class ProviderController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $provider
     */
    protected $provider;

    /**
     * Create a new controller instance.
     *
     * @param instance $provider instance
     *
     * @return void
     */
    public function __construct(Profile $provider, Payout $payout)
    {
        $this->provider = $provider;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::pluck('title', 'id');
        $skills = Skill::pluck('title', 'id');
        $profile = $this->provider::where('user_id', Auth::user()->id)
            ->get()->first();
        $gender = !empty($profile->gender) ? $profile->gender : '';
        $hourly_rate = !empty($profile->hourly_rate) ? $profile->hourly_rate : '';
        $tagline = !empty($profile->tagline) ? $profile->tagline : '';
        $description = !empty($profile->description) ? $profile->description : '';
        $address = !empty($profile->address) ? $profile->address : '';
        $longitude = !empty($profile->longitude) ? $profile->longitude : '';
        $latitude = !empty($profile->latitude) ? $profile->latitude : '';
        $banner = !empty($profile->banner) ? $profile->banner : '';
        $avater = !empty($profile->avater) ? $profile->avater : '';
        $role_id =  Helper::getRoleByUserID(Auth::user()->id);
        $packages = DB::table('items')->where('subscriber', Auth::user()->id)->count();
        $package_options = Package::select('options')->where('role_id', $role_id)->first();
        $options = !empty($package_options) ? unserialize($package_options['options']) : array();
        $videos = !empty($profile->videos) ? Helper::getUnserializeData($profile->videos) : ''; 
        if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/personal-detail/index.blade.php'))) {
            return view(
                'extend.back-end.provider.profile-settings.personal-detail.index',
                compact(
                    'videos',
                    'locations',
                    'skills',
                    'profile',
                    'gender',
                    'hourly_rate',
                    'tagline',
                    'description',
                    'banner',
                    'address',
                    'longitude',
                    'latitude',
                    'avater',
                    'options'
                )
            );
        } else {
            return view(
                'back-end.provider.profile-settings.personal-detail.index',
                compact(
                    'videos',
                    'locations',
                    'skills',
                    'profile',
                    'gender',
                    'hourly_rate',
                    'tagline',
                    'description',
                    'banner',
                    'address',
                    'longitude',
                    'latitude',
                    'avater',
                    'options'
                )
            );
        }
    }

    /**
     * Upload Image to temporary folder.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadTempImage(Request $request)
    {
        $path = Helper::assetPath() . '/uploads/users/temp/';
        if (!empty($request['hidden_avater_image'])) {
            $profile_image = $request['hidden_avater_image'];
            $image_size = array(
                'small' => array(
                    'width' => 36,
                    'height' => 36,
                ),
                'medium-small' => array(
                    'width' => 60,
                    'height' => 60,
                ),
                'medium' => array(
                    'width' => 100,
                    'height' => 100,
                ),
                'listing' => array(
                    'width' => 255,
                    'height' => 255,
                ),
            );
            // return Helper::uploadTempImage($path, $profile_image);
            return Helper::uploadTempImageWithSize($path, $profile_image, '', $image_size);
        } elseif (!empty($request['hidden_banner_image'])) {
            $profile_image = $request['hidden_banner_image'];
            return Helper::uploadTempImage($path, $profile_image);
        } elseif (!empty($request['project_img'])) {
            $profile_image = $request['project_img'];
            return Helper::uploadTempImage($path, $profile_image);
        } elseif (!empty($request['award_img'])) {
            $profile_image = $request['award_img'];
            return Helper::uploadTempImage($path, $profile_image);
        }
    }

    /**
     * Store profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeProfileSettings(Request $request)
    {
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
                'first_name'    => 'required',
                'last_name'    => 'required',
                'gender'    => 'required',
            ]
        );
        if (!empty($request['latitude']) || !empty($request['longitude'])) {
            $this->validate(
                $request,
                [
                    'latitude' => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                    'longitude' => ['regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                ]
            ); 
        }
        if (Auth::user()) {
            $role_id = Helper::getRoleByUserID(Auth::user()->id);
            $packages = DB::table('items')->where('subscriber', Auth::user()->id)->count();
            $package_options = Package::select('options')->where('role_id', $role_id)->first();
            $options = !empty($package_options) ? unserialize($package_options['options']) : array();
            $skills = !empty($options) ? $options['no_of_skills'] : array();
            $payment_settings = SiteManagement::getMetaValue('commision');
            $package_status = '';
            if (empty($payment_settings)) {
                $package_status = 'true';
            } else {
                $package_status =!empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
            }
            if ($package_status === 'true') {
                if ($packages > 0) {
                    if (!empty($request['skills']) && count($request['skills']) > $skills) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.cannot_add_morethan') . '' . $options['no_of_skills'] . ' ' . trans('lang.skills');
                        return $json;
                    } else {
                        $profile =  $this->provider->storeProfile($request, Auth::user()->id);
                        if ($profile = 'success') {
                            $json['type'] = 'success';
                            $json['message'] = '';
                            return $json;
                        }
                    }
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.update_pkg');
                    return $json;
                }
            } else {
                $profile =  $this->provider->storeProfile($request, Auth::user()->id);
                if ($profile = 'success') {
                    $json['type'] = 'success';
                    $json['message'] = '';
                    return $json;
                }
            }
            Session::flash('message', trans('lang.update_profile'));
            return Redirect::back();
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Get provider skills.
     *
     * @return \Illuminate\Http\Response
     */
    public function getproviderSkills()
    {
        $json = array();
        if (Auth::user()) {
            $skills = User::find(Auth::user()->id)->skills()
                ->orderBy('title')->get()->toArray();
            if (!empty($skills)) {
                $json['type'] = 'success';
                $json['provider_skills'] = $skills;
                return $json;
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get top provider
     *
     * @return \Illuminate\Http\Response
     */
    public function getTopproviders()
    {
        $json = array();
        $providers = User::getTopProviders();
        $top_providers = array();
        if (!empty($providers)) {
            foreach ($providers as $key => $provider) {
                $user = User::find($provider->id);
                $top_providers[$key]['id'] = $provider->id;
                $top_providers[$key]['name'] = Helper::getUserName($provider->id);
                $top_providers[$key]['slug'] = $user->slug;
                $top_providers[$key]['image'] = asset(Helper::getProfileImage($provider->id));
                $top_providers[$key]['flag'] = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :'';
                $top_providers[$key]['location'] = !empty($user->location->title) ? $user->location->title :'';
                $top_providers[$key]['tagline'] = !empty($user->profile->tagline) ? $user->profile->tagline :'';
                $top_providers[$key]['hourly_rate'] = !empty($user->profile->hourly_rate) ? $user->profile->hourly_rate :'';
                $currency   = SiteManagement::getMetaValue('commision');
                $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                $top_providers[$key]['symbol'] = !empty($symbol['symbol']) ? $symbol['symbol'] : '$';
                $top_providers[$key]['average_rating_count'] = !empty($provider->total_reviews) ? $provider->rating/$provider->total_reviews : 0;
                $top_providers[$key]['total_reviews'] = !empty($provider->total_reviews) ? $provider->total_reviews : 0;
                $top_providers[$key]['save_providers'] = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $top_providers[$key]['skills'] = !empty($user->skills) ? $user->skills->pluck('title', 'id') : array();
            }
        }
        if (!empty($top_providers)) {
            $json['type'] = 'success';
            $json['providers'] = $top_providers;
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get all provider
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProviders()
    {
        $json = array();
        $providers = User::getAllProviders();
        $top_providers = array();
        if (!empty($providers)) {
            foreach ($providers as $key => $provider) {
                $user = User::find($provider->id);
                $top_providers[$key]['id'] = $provider->id;
                $top_providers[$key]['name'] = Helper::getUserName($provider->id);
                $top_providers[$key]['slug'] = $user->slug;
                $top_providers[$key]['image'] = asset(Helper::getProfileImage($provider->id));
                $top_providers[$key]['flag'] = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :'';
                $top_providers[$key]['location'] = !empty($user->location->title) ? $user->location->title :'';
                $top_providers[$key]['tagline'] = !empty($user->profile->tagline) ? $user->profile->tagline :'';
                $top_providers[$key]['hourly_rate'] = !empty($user->profile->hourly_rate) ? $user->profile->hourly_rate :'';
                $currency   = SiteManagement::getMetaValue('commision');
                $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                $top_providers[$key]['symbol'] = !empty($symbol['symbol']) ? $symbol['symbol'] : '$';
                $top_providers[$key]['average_rating_count'] = !empty($provider->total_reviews) ? $provider->rating/$provider->total_reviews : 0;
                $top_providers[$key]['total_reviews'] = !empty($provider->total_reviews) ? $provider->total_reviews : 0;
                $top_providers[$key]['save_providers'] = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $top_providers[$key]['skills'] = !empty($user->skills) ? $user->skills->pluck('title', 'id') : array();
            }
        }
        if (!empty($top_providers)) {
            $json['type'] = 'success';
            $json['providers'] = $top_providers;
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Show the form for creating and updating experiance and education settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function experienceEducationSettings()
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
        if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/experience-education/index.blade.php'))) {
            return view('extend.back-end.provider.profile-settings.experience-education.index', compact('weekdays', 'months'));
        } else {
            return view('back-end.provider.profile-settings.experience-education.index', compact('weekdays', 'months'));
        }
    }

    /**
     * Show the form for creating and updating projects & awards.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectAwardsSettings()
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
        if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/projects-awards/index.blade.php'))) {
            return view('extend.back-end.provider.profile-settings.projects-awards.index', compact('weekdays', 'months'));
        } else {
            return view('back-end.provider.profile-settings.projects-awards.index', compact('weekdays', 'months'));
        }
    }

    /**
     * Show the form for creating and updating experiance and education settings.
     *
     * @param mixed $request Request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeExperienceEducationSettings(Request $request)
    {
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
                'experience.*.job_title' => 'required',
                'experience.*.start_date' => 'required',
                'experience.*.end_date' => 'required',
                'experience.*.company_title' => 'required',
                'education.*.degree_title' => 'required',
                'education.*.start_date' => 'required',
                'education.*.end_date' => 'required',
                'education.*.institute_title' => 'required',
            ]
        );
        $user_id = Auth::user()->id;
        $update_experience_education = $this->provider->updateExperienceEducation($request, $user_id);
        if ($update_experience_education['type'] == 'success') {
            $json['type'] = 'success';
            $json['message'] = trans('lang.saving_profile');
            $json['complete_message'] = trans('lang.profile_update_success');
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.empty_fields_not_allowed');
        }
        return $json;
    }

    /**
     * Show the form with saved values.
     *
     * @return \Illuminate\Http\Response
     */
    public function getproviderExperiences()
    {
        $json = array();
        $user_id = Auth::user()->id;
        if (Auth::user()) {
            $profile = $this->provider::select('experience')
                ->where('user_id', $user_id)->get()->first();
            if (!empty($profile)) {
                $json['type'] = 'success';
                $json['experiences'] = unserialize($profile->experience);
                return $json;
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Show the form with saved values.
     *
     * @return \Illuminate\Http\Response
     */
    public function getproviderEducations()
    {
        $json = array();
        $user_id = Auth::user()->id;
        if (Auth::user()) {
            $profile = $this->provider::select('education')
                ->where('user_id', $user_id)->get()->first();
            if (!empty($profile)) {
                $json['type'] = 'success';
                $json['educations'] = unserialize($profile->education);
                return $json;
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }


    /**
     * Show the form for creating and updating projects and awards settings.
     *
     * @param mixed $request Request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeProjectAwardSettings(Request $request)
    {
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'award.*.award_title' => 'required',
                    'award.*.award_date'    => 'required',
                    'award.*.award_hidden_image'    => 'required',
                    'project.*.project_title' => 'required',
                    'project.*.project_url'    => 'required',
                ]
            );
            $user_id = Auth::user()->id;
            $store_awards_projects = $this->provider->updateAwardProjectSettings($request, $user_id);
            if ($store_awards_projects['type'] == 'success') {
                $json['type'] = 'success';
                $json['message'] = trans('lang.saving_profile');
                $json['complete_message'] = 'Profile Updated Successfully';
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.empty_fields_not_allowed');
            }
            return $json;
        }
    }

    /**
     * Get provider's projects
     *
     * @return \Illuminate\Http\Response
     */
    public function getproviderProjects()
    {
        $user_id = Auth::user()->id;
        $json = array();
        if (Auth::user()) {
            $profile = $this->provider::select('projects')
                ->where('user_id', $user_id)->get()->first();
            $profile_projects = array();
            if (!empty($profile)) {
                $projects = !empty($profile->projects) ? Helper::getUnserializeData($profile->projects) : array();
                if (!empty($projects)) {
                    foreach ($projects as $key => $project) {
                        $profile_projects[$key]['project_title'] = !empty($project['project_title']) ? $project['project_title'] : '';
                        $profile_projects[$key]['project_url'] = !empty($project['project_url']) ? $project['project_url'] : '';
                        $profile_projects[$key]['project_hidden_image'] = !empty($project['project_hidden_image']) ? url('/uploads/users/'.$user_id.'/projects/'.$project['project_hidden_image']) : '';
                        $profile_projects[$key]['project_image'] = !empty($project['project_hidden_image']) ? $project['project_hidden_image'] : '';
                    }
                }
                $json['type'] = 'success';
                $json['projects'] = $profile_projects;
                return $json;
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get provider's awards
     *
     * @return \Illuminate\Http\Response
     */
    public function getproviderAwards()
    {
        $user_id = Auth::user()->id;
        $json = array();
        if (Auth::user()) {
            $profile = $this->provider::select('awards')
                ->where('user_id', $user_id)->get()->first();
            $profile_awards = array();
            if (!empty($profile)) {
                $awards = !empty($profile->awards) ? Helper::getUnserializeData($profile->awards) : array();
                if (!empty($awards)) {
                    foreach ($awards as $key => $award) {
                        $profile_awards[$key]['award_title'] = $award['award_title'];
                        $profile_awards[$key]['award_date'] = $award['award_date'];
                        $profile_awards[$key]['award_hidden_image'] = url('/uploads/users/'.$user_id.'/awards/'.$award['award_hidden_image']);
                        $profile_awards[$key]['award_image'] = !empty($award['award_hidden_image']) ? $award['award_hidden_image'] : '';
                    }
                }
                $json['type'] = 'success';
                $json['awards'] = $profile_awards;
                return $json;
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Show provider Jobs.
     *
     * @param string $status job status
     *
     * @return \Illuminate\Http\Response
     */

    public function providerJobs ()
    {
        //dd('this is the test', $jobs);
        
        $ongoing_jobs = array();
        $provider_id = Auth::user()->id;
        
        
        $currency  = SiteManagement::getMetaValue('commision');
        $symbol    = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        if (Auth::user()) {
            $ongoing_jobs = Proposal::select('job_id')->latest()->where('provider_id', $provider_id)->where('status', 'hired')->paginate(7);
            $completed_jobs = Proposal::select('job_id')->latest()->where('provider_id', $provider_id)->where('status', 'completed')->paginate(7);
            $cancelled_jobs = Proposal::select('job_id')->latest()->where('provider_id', $provider_id)->where('status', 'cancelled')->paginate(7);
            $email = Auth::user()->email;
            $teams = Team::where('email', $email)->select('job_id')->get();
            $fteams = Fteam::where('email', $email)->select('user_id')->get();
            $fteams_jobs = Proposal::select('job_id')->latest()->whereIn('provider_id', $fteams)->where('status', 'hired')->get();
            //dd($fteams_jobs, $fteams);
            $team_jobs = Job::whereIn('id', $teams)->get();
            return view(
                'back-end.provider.jobs.index',
                compact(
                    'ongoing_jobs',
                    'completed_jobs',
                    'cancelled_jobs',
                    'fteams_jobs',
                    'team_jobs',
                    'symbol'
                )
            );
        }
                

        
    }

    public function providerJoblist()
    {
        
        $provider_id = Auth::user()->id;
        $currency  = SiteManagement::getMetaValue('commision');
        $symbol    = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        if (Auth::user()) {
            $type = 'jobs';
            $categories = array();
            $locations  = array();
            $languages  = array();
            $categories = Category::all();
            $locations  = Location::all();
            $languages  = Language::all();
            $skills     = Skill::all();
            $provider_skills = Helper::getProviderLevelList();
            $project_length = Helper::getJobDurationList();
            $current_date = Carbon::now()->toDateTimeString();
            $address = $request->query('addr', '');
            $keyword = $request->query('s', '');

            $search_categories = $request->query('category', []);
            $search_locations = $request->query('locations', []);
            $search_skills = $request->query('skills', []);
            $search_project_lengths = $request->query('project_lengths', []);
            $search_languages = $request->query('languages', []);
            $search_employees = $request->query('employees', []);
            $search_hourly_rates = $request->query('hourly_rate', []);
            $search_freelaner_types = $request->query('freelaner_type', []);
            $search_english_levels = $request->query('english_level', []);
            $search_delivery_time = $request->query('delivery_time', []);
            $search_response_time = $request->query('response_time', []);

            $min_price = $request->query('minprice', 0);
            $max_price = $request->query('maxprice', 0);
            $Jobs_total_records = Job::count();
            $job_list_meta_title = !empty($inner_page) && !empty($inner_page[0]['job_list_meta_title']) ? $inner_page[0]['job_list_meta_title'] : trans('lang.job_listing');
            $job_list_meta_desc = !empty($inner_page) && !empty($inner_page[0]['job_list_meta_desc']) ? $inner_page[0]['job_list_meta_desc'] : trans('lang.job_meta_desc');
            $show_job_banner = !empty($inner_page) && !empty($inner_page[0]['show_job_banner']) ? $inner_page[0]['show_job_banner'] : 'true';
            $job_inner_banner = !empty($inner_page) && !empty($inner_page[0]['job_inner_banner']) ? $inner_page[0]['job_inner_banner'] : null;
            $project_settings = !empty(SiteManagement::getMetaValue('project_settings')) ? SiteManagement::getMetaValue('project_settings') : array();
            $completed_project_setting = !empty($project_settings) && !empty($project_settings['enable_completed_projects']) ? $project_settings['enable_completed_projects'] : 'true';
            $results = Job::getSearchResult(
                $address,
                $keyword,
                $search_categories,
                $search_locations,
                $search_skills,
                $search_project_lengths,
                $search_languages,
                $completed_project_setting,
                $min_price,
                $max_price
            );
            $jobs = $results['jobs'];

            //dd($jobs);


            if (file_exists(resource_path('views/extend/back-end/provider/jobs/list.blade.php'))) {
                return view(
                    'extend.back-end.provider.jobs.list',
                    compact(
                        'address',
                        'jobs',
                        'categories',
                        'locations',
                        'languages',
                        'provider_skills',
                        'project_length',
                        'Jobs_total_records',
                        'keyword',
                        'skills',
                        'type',
                        'current_date',
                        'symbol',
                        'job_list_meta_title',
                        'job_list_meta_desc',
                        'show_job_banner',
                        'job_inner_banner'
                    )
                );
            } else {
                return view(
                    'back-end.provider.jobs.list',
                    compact(
                        'address',
                        'jobs',
                        'categories',
                        'locations',
                        'languages',
                        'provider_skills',
                        'project_length',
                        'Jobs_total_records',
                        'keyword',
                        'skills',
                        'type',
                        'current_date',
                        'symbol',
                        'job_list_meta_title',
                        'job_list_meta_desc',
                        'show_job_banner',
                        'job_inner_banner'
                    )
                );
            }
            
        }
    }

    public function showproviderJobs($status)
    {
        $ongoing_jobs = array();
        $provider_id = Auth::user()->id;
        $currency  = SiteManagement::getMetaValue('commision');
        $symbol    = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        if (Auth::user()) {
            $ongoing_jobs = Proposal::select('job_id')->latest()->where('provider_id', $provider_id)->where('status', 'hired')->paginate(7);
            $completed_jobs = Proposal::select('job_id')->latest()->where('provider_id', $provider_id)->where('status', 'completed')->paginate(7);
            $cancelled_jobs = Proposal::select('job_id')->latest()->where('provider_id', $provider_id)->where('status', 'cancelled')->paginate(7);
            if (!empty($status) && $status === 'hired') {
                if (file_exists(resource_path('views/extend/back-end/provider/jobs/ongoing.blade.php'))) {
                    return view(
                        'extend.back-end.provider.jobs.ongoing',
                        compact(
                            'ongoing_jobs',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.jobs.ongoing',
                        compact(
                            'ongoing_jobs',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'completed') {
                if (file_exists(resource_path('views/extend/back-end/provider/jobs/completed.blade.php'))) {
                    return view(
                        'extend.back-end.provider.jobs.completed',
                        compact(
                            'completed_jobs',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.jobs.completed',
                        compact(
                            'completed_jobs',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'cancelled') {
                if (file_exists(resource_path('views/extend/back-end/provider/jobs/cancelled.blade.php'))) {
                    return view(
                        'extend.back-end.provider.jobs.cancelled',
                        compact(
                            'cancelled_jobs',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.jobs.cancelled',
                        compact(
                            'cancelled_jobs',
                            'symbol'
                        )
                    );
                }
            }
        }
    }

    /**
     * Show provider Job Details.
     *
     * @param string $slug job slug
     *
     * @return \Illuminate\Http\Response
     */
    public function showOnGoingJobDetail($slug)
    {
        $job = array();
        if (Auth::user()) {
            $job = Job::where('slug', $slug)->first();

            $proposal = Job::find($job->id)->proposals()->select('id', 'status')->where('status', '!=', 'pending')
                ->first();
            if ($proposal->status == 'cancelled') {
                $proposal_job = Job::find($job->id);
                $cancel_reason = $job->reports->first();
            } else {
                $cancel_reason = '';
            }
            $employer_name = Helper::getUserName($job->user_id);
            $duration = !empty($job->duration) ? Helper::getJobDurationList($job->duration) : '';
            $profile = User::find(Auth::user()->id)->profile;
            $employer_profile = User::find($job->user_id)->profile;
            $employer_avatar = !empty($employer_profile) ? $employer_profile->avater : '';
            $user_image = !empty($profile) ? $profile->avater : '';
            $profile_image = !empty($user_image) ? '/uploads/users/' . Auth::user()->id . '/' . $user_image : 'images/user-login.png';
            $employer_image = !empty($employer_avatar) ? '/uploads/users/' . $job->user_id . '/' . $employer_avatar : 'images/user-login.png';
            $currency   = SiteManagement::getMetaValue('commision'); 
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();


            $providers = Provider_type::where('job_id', $job->id)->get();
            $project_provider = Helper::getProviderLevelList();
            foreach ($providers as $key => $value) {
                foreach ($project_provider as $key1 => $value1) {
                    //dd($value, $key1, $project_english);
                    if($value->provider_type == $key1)
                        $value->name = $value1;
                }   
            }
            $english = English_level::where('job_id', $job->id)->get();
            $project_english = Helper::getEnglishLevelList();
            foreach ($english as $key => $value) {
                foreach ($project_english as $key1 => $value1) {
                    //dd($value, $key1, $project_english);
                    if($value->english_level == $key1)
                        $value->name = $value1;
                }   
            }

            $project_duration = Helper::getJobDurationList();
            //$job = Job::find($id);
            $lang = $job->languages;
            $skills = $job->skills;

            if (file_exists(resource_path('views/extend/back-end/provider/jobs/show.blade.php'))) {
                return view(
                    'extend.back-end.provider.jobs.show',
                    compact(
                        'job',
                        'employer_name',
                        'duration',
                        'profile_image',
                        'employer_image',
                        'proposal',
                        'providers',
                        'project_duration',
                        'english',
                        'lang',
                        'skills',
                        'symbol',
                        'cancel_reason'
                    )
                );
            } else {
                return view(
                    'back-end.provider.jobs.show',
                    compact(
                        'job',
                        'employer_name',
                        'duration',
                        'profile_image',
                        'employer_image',
                        'proposal',
                        'providers',
                        'project_duration',
                        'english',
                        'lang',
                        'skills',
                        'symbol',
                        'cancel_reason'
                    )
                );
            }
        }
    }

    public function showOnGoingJobTeamDetail($slug)
    {
        $job = array();
        if (Auth::user()) {
            $job = Job::where('slug', $slug)->first();

            
            $employer_name = Helper::getUserName($job->user_id);
            $duration = !empty($job->duration) ? Helper::getJobDurationList($job->duration) : '';
            $profile = User::find(Auth::user()->id)->profile;
            $employer_profile = User::find($job->user_id)->profile;
            $employer_avatar = !empty($employer_profile) ? $employer_profile->avater : '';
            $user_image = !empty($profile) ? $profile->avater : '';
            
            $profile_image = !empty($user_image) ? '/uploads/users/' . Auth::user()->id . '/' . $user_image : 'images/user-login.png';
            $employer_image = !empty($employer_avatar) ? '/uploads/users/' . $job->user_id . '/' . $employer_avatar : 'images/user-login.png';
            $currency   = SiteManagement::getMetaValue('commision'); 
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();


            $providers = Provider_type::where('job_id', $job->id)->get();
            $project_provider = Helper::getProviderLevelList();
            foreach ($providers as $key => $value) {
                foreach ($project_provider as $key1 => $value1) {
                    //dd($value, $key1, $project_english);
                    if($value->provider_type == $key1)
                        $value->name = $value1;
                }   
            }
            $english = English_level::where('job_id', $job->id)->get();
            $project_english = Helper::getEnglishLevelList();
            foreach ($english as $key => $value) {
                foreach ($project_english as $key1 => $value1) {
                    //dd($value, $key1, $project_english);
                    if($value->english_level == $key1)
                        $value->name = $value1;
                }   
            }

            $project_duration = Helper::getJobDurationList();
            //$job = Job::find($id);
            $lang = $job->languages;
            $skills = $job->skills;

            if (file_exists(resource_path('views/extend/back-end/provider/jobs/show.blade.php'))) {
                return view(
                    'extend.back-end.provider.jobs.team',
                    compact(
                        'job',
                        'employer_name',
                        'duration',
                        'profile_image',
                        'employer_image',
                        'providers',
                        'project_duration',
                        'english',
                        'lang',
                        'skills',
                        'symbol',
                        
                    )
                );
            } else {
                return view(
                    'back-end.provider.jobs.team',
                    compact(
                        'job',
                        'employer_name',
                        'duration',
                        'profile_image',
                        'employer_image',
                        'providers',
                        'project_duration',
                        'english',
                        'lang',
                        'skills',
                        'symbol',
                        
                    )
                );
            }
        }
    }

    /**
     * Show provider proposals.
     *
     * @return \Illuminate\Http\Response
     */
    public function showproviderProposals()
    {
        
        $proposals = Proposal::select('job_id', 'status', 'id')->where('provider_id', Auth::user()->id)->latest()->paginate(7);
        $currency  = SiteManagement::getMetaValue('commision');
        $symbol    = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        $project_duration = Helper::getJobDurationList();
        foreach($proposals as $value)
        {
            //$duration = Helper::getJobDurationList($value->job->duration);
            //dd($duration);
            if(Live_contest::where('job_id', $value->job_id)->exists())
            {
                $value->contest = 'true';
                $live = Live_contest::where('job_id', $value->job_id)->first();
                $value->contestid = $live->id;
            }                
            else
                $value->contest = 'false';

            
        }
        //dd($proposals);
        if (file_exists(resource_path('views/extend/back-end/provider/proposals/index.blade.php'))) {
            return view(
                'extend.back-end.provider.proposals.index',
                compact(
                    'proposals',
                    'project_duration',
                    'symbol'
                )
            );
        } else {
            return view(
                'back-end.provider.proposals.index',
                compact(
                    'proposals',
                    'project_duration',
                    'symbol'
                )
            );
        }
    }

    /**
     * Show provider dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function providerDashboard()
    {
        //dd(Auth::user());
        if (Auth::user()) {
            $ongoing_jobs = array();
            $provider_id = Auth::user()->id;
            $ongoing_projects = Proposal::getProposalsByStatus($provider_id, 'hired');
            $cancelled_projects = Proposal::getProposalsByStatus($provider_id, 'cancelled');
            $package_item = Item::where('subscriber', $provider_id)->first();
            $package = !empty($package_item) ? Package::find($package_item->product_id) : array();
            $option = !empty($package) && !empty($package['options']) ? unserialize($package['options']) : '';
            $expiry = !empty($option) ? $package_item->updated_at->addDays($option['duration']) : '';
            $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
            $message_status = Message::where('status', 0)->where('receiver_id', $provider_id)->count();
            $notify_class = $message_status > 0 ? 'wt-insightnoticon' : '';
            $completed_projects = Proposal::getProposalsByStatus($provider_id, 'completed');
            $completed_projects_history = Proposal::getProposalsByStatus($provider_id, 'completed', 'completed');
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol     = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            $trail      = !empty($package) && $package['trial'] == 1 ? 'true' : 'false';
            $icons      = SiteManagement::getMetaValue('icons');
            $enable_package = !empty($currency) && !empty($currency[0]['enable_packages']) ? $currency[0]['enable_packages'] : 'true';
            $latest_proposals_icon = !empty($icons['hidden_latest_proposal']) ? $icons['hidden_latest_proposal'] : 'img-20.png';
            $latest_package_expiry_icon = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : 'img-21.png';
            $latest_new_message_icon = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : 'img-19.png';
            $latest_saved_item_icon = !empty($icons['hidden_saved_item']) ? $icons['hidden_saved_item'] : 'img-22.png';
            $latest_cancel_project_icon = !empty($icons['hidden_cancel_project']) ? $icons['hidden_cancel_project'] : 'img-16.png';
            $latest_ongoing_project_icon = !empty($icons['hidden_ongoing_project']) ? $icons['hidden_ongoing_project'] : 'img-17.png';
            $latest_pending_balance_icon = !empty($icons['hidden_pending_balance']) ? $icons['hidden_pending_balance'] : 'icon-01.png';
            $latest_current_balance_icon = !empty($icons['hidden_current_balance']) ? $icons['hidden_current_balance'] : 'icon-02.png';
            $published_services_icon = !empty($icons['hidden_published_services']) ? $icons['hidden_published_services'] : 'payment-method.png';
            $cancelled_services_icon = !empty($icons['hidden_cancelled_services']) ? $icons['hidden_cancelled_services'] : 'decline.png';
            $completed_services_icon = !empty($icons['hidden_completed_services']) ? $icons['hidden_completed_services'] : 'completed-task.png';
            $ongoing_services_icon = !empty($icons['hidden_ongoing_services']) ? $icons['hidden_ongoing_services'] : 'onservice.png';
            $access_type = Helper::getAccessType();
            if (file_exists(resource_path('views/extend/back-end/provider/dashboard.blade.php'))) {
                return view(
                    'extend.back-end.provider.dashboard',
                    compact(
                        'provider_id',
                        'completed_projects_history',
                        'access_type',
                        'ongoing_projects',
                        'cancelled_projects',
                        'expiry_date',
                        'notify_class',
                        'completed_projects',
                        'symbol',
                        'trail',
                        'latest_proposals_icon',
                        'latest_package_expiry_icon',
                        'latest_new_message_icon',
                        'latest_saved_item_icon',
                        'latest_cancel_project_icon',
                        'latest_ongoing_project_icon',
                        'latest_pending_balance_icon',
                        'latest_current_balance_icon',
                        'published_services_icon',
                        'cancelled_services_icon',
                        'completed_services_icon',
                        'ongoing_services_icon',
                        'enable_package',
                        'package'
                    )
                );
            } else {
                return view(
                    'back-end.provider.dashboard',
                    compact(
                        'provider_id',
                        'completed_projects_history',
                        'access_type',
                        'ongoing_projects',
                        'cancelled_projects',
                        'expiry_date',
                        'notify_class',
                        'completed_projects',
                        'symbol',
                        'trail',
                        'latest_proposals_icon',
                        'latest_package_expiry_icon',
                        'latest_new_message_icon',
                        'latest_saved_item_icon',
                        'latest_cancel_project_icon',
                        'latest_ongoing_project_icon',
                        'latest_pending_balance_icon',
                        'latest_current_balance_icon',
                        'published_services_icon',
                        'cancelled_services_icon',
                        'completed_services_icon',
                        'ongoing_services_icon',
                        'enable_package',
                        'package'
                    )
                );
            }
        }
    }

    /**
     * Show services.
     *
     * @param string $status job status
     *
     * @return \Illuminate\Http\Response
     */
    public function providerServices()
    {
        $provider_id = Auth::user()->id;
        if (Auth::user()) {
            $provider = User::find($provider_id);
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            $status_list = array_pluck(Helper::getProviderServiceStatus(), 'title', 'value');
            //if (!empty($status) && $status === 'posted') {
                //$services = $provider->services;
                $hired_services = Helper::getProviderServices('hired', Auth::user()->id);
                $completed_services = Helper::getProviderServices('completed', Auth::user()->id);
                $cancelled_services = Helper::getProviderServices('cancelled', Auth::user()->id);
                $attachment = Helper::getUnserializeData($completed_services[0]->attachments);
                //dd($completed_services);
                if (file_exists(resource_path('views/extend/back-end/provider/services/index.blade.php'))) {
                    return view(
                        'extend.back-end.provider.services.manage',
                        compact(
                            'hired_services',
                            'completed_services',
                            'cancelled_services',
                            'symbol',
                            'status_list'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.services.manage',
                        compact(
                            'hired_services',
                            'completed_services',
                            'cancelled_services',
                            'symbol',
                            'status_list'
                        )
                    );
                }
            
        }
    }
    public function showServices($status)
    {
        $provider_id = Auth::user()->id;
        if (Auth::user()) {
            $provider = User::find($provider_id);
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            $status_list = array_pluck(Helper::getProviderServiceStatus(), 'title', 'value');
            if (!empty($status) && $status === 'posted') {
                $services = $provider->services;
                if (file_exists(resource_path('views/extend/back-end/provider/services/index.blade.php'))) {
                    return view(
                        'extend.back-end.provider.services.index',
                        compact(
                            'services',
                            'symbol',
                            'status_list'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.services.index',
                        compact(
                            'services',
                            'symbol',
                            'status_list'
                        )
                    );
                }
            } else if (!empty($status) && $status === 'hired') {
                $services = Helper::getProviderServices('hired', Auth::user()->id);
                if (file_exists(resource_path('views/extend/back-end/provider/services/ongoing.blade.php'))) {
                    return view(
                        'extend.back-end.provider.services.ongoing',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.services.ongoing',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'completed') {
                $services = Helper::getProviderServices('completed', Auth::user()->id);
                //dd($services);
                if (file_exists(resource_path('views/extend/back-end/provider/services/completed.blade.php'))) {
                    return view(
                        'extend.back-end.provider.services.completed',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.services.completed',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'cancelled') {
                $services = Helper::getProviderServices('cancelled', Auth::user()->id);
                if (file_exists(resource_path('views/extend/back-end/provider/services/cancelled.blade.php'))) {
                    return view(
                        'extend.back-end.provider.services.cancelled',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.provider.services.cancelled',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            }
            
        }
    }

    /**
     * Service Details.
     *
     * @param int    $id     id
     * @param string $status status
     *
     * @return \Illuminate\Http\Response
     */
    public function showServiceDetail($id, $status)
    {
        //dd('show');
        if (Auth::user()) {
            $pivot_service = Helper::getPivotService($id);
            $pivot_id = $pivot_service->id;
            $service = Service::find($pivot_service->service_id);
            $seller = Helper::getServiceSeller($service->id);
            $purchaser = $service->purchaser->first();
            $provider = !empty($seller) ? User::find($seller->user_id) : ''; 
            $service_status = Helper::getProjectStatus();
            $review_options = DB::table('review_options')->get()->all();
            $avg_rating = !empty($provider) ? Review::where('receiver_id', $provider->id)->sum('avg_rating') : '';

            
            


            $provider_rating  = !empty($provider) && !empty($provider->profile->ratings) ? Helper::getUnserializeData($provider->profile->ratings) : 0;
            $rating = !empty($provider_rating) ? $provider_rating[0] : 0;
            $stars  =  !empty($provider_rating) ? $provider_rating[0] / 5 * 100 : 0;
            $reviews = !empty($provider) ? Review::where('receiver_id', $provider->id)->where('job_id', $id)->where('project_type', 'service')->get() : '';
            $feedbacks = !empty($provider) ? Review::select('feedback')->where('receiver_id', $provider->id)->count() : '';
            $cancel_proposal_text = trans('lang.cancel_proposal_text');
            $cancel_proposal_button = trans('lang.send_request');
            $validation_error_text = trans('lang.field_required');
            $cancel_popup_title = trans('lang.reason');
            $attachment = Helper::getUnserializeData($service->attachments);

            $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            if (file_exists(resource_path('views/extend/back-end/employer/services/show.blade.php'))) {
                return view(
                    'extend.back-end.provider.services.show',
                    compact(
                        'pivot_service',
                        'id',
                        'service',
                        'provider',
                        'service_status',
                        'attachment',
                        'review_options',
                        'stars',
                        'rating',
                        'feedbacks',
                        'cancel_proposal_text',
                        'cancel_proposal_button',
                        'validation_error_text',
                        'cancel_popup_title',
                        'pivot_id',
                        'purchaser',
                        'average_rating_count',
                        'symbol'
                    )
                );
            } else {
                return view(
                    'back-end.provider.services.show',
                    compact(
                        'pivot_service',
                        'id',
                        'service',
                        'provider',
                        'service_status',
                        'attachment',
                        'review_options',
                        'stars',
                        'rating',
                        'feedbacks',
                        'cancel_proposal_text',
                        'cancel_proposal_button',
                        'validation_error_text',
                        'cancel_popup_title',
                        'pivot_id',
                        'purchaser',
                        'average_rating_count',
                        'symbol'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get provider payouts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayouts()
    {
        $payouts =  Payout::where('user_id', Auth::user()->id)->paginate(10);
        if (file_exists(resource_path('views/extend/back-end/provider/payouts.blade.php'))) {
            return view(
                'extend.back-end.provider.payouts.payouts',
                compact('payouts')
            );
        } else {
            return view(
                'back-end.provider.payouts.payouts',
                compact('payouts')
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payoutSettings()
    {
        if (Auth::user()) {
            $payrols = Helper::getPayoutsList();
            $user = User::find(Auth::user()->id);
            $payout_settings = $user->profile->count() > 0 ? Helper::getUnserializeData($user->profile->payout_settings) : '';
            if (file_exists(resource_path('views/extend/back-end/provider/payouts/payout_settings.blade.php'))) {
                return view(
                    'extend.back-end.provider.payouts.payout_settings', compact('payrols', 'payout_settings')
                );
            } else {
                return view(
                    'back-end.provider.payouts.payout_settings', compact('payrols', 'payout_settings')
                );
            }
        } else {
            abort(404);
        }
    }
    public function contest($id)
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
                    $contest_user1->your_bid = $value->bid;
                    $contest_user1->your_rank = $rank;
                }
                if($rank == 1)
                    $contest_user1->best_bid = $value->bid;
                    
                $rank++;
            }
            //dd($contest_user1);
            return view('back-end.provider.jobs.contest', compact('contest', 'contest_user1', 'job'));
        }
        else
            return view('errors.503');//sent to unauthorize page
    }
}
