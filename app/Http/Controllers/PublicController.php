<?php

/**
 * Class PublicController
 *
 
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\User;
use App\Language;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMailable;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Redirect;
use Hash;
use Auth;
use DB;
use App\Helper;
use App\Profile;
use App\Category;
use App\Location;
use App\Skill;
use Session;
use Storage;
use App\Report;
use App\Job;
use App\Proposal;
use App\EmailTemplate;
use App\Mail\GeneralEmailMailable;
use App\Mail\AdminEmailMailable;
use App\SiteManagement;
use App\Review;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Payout;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Service;
use App\DeliveryTime;
use App\ResponseTime;
use App\Article;
use App\Employer;
use App\Address;
use App\Contact;
use App\Invoice;

/**
 * Class PublicController
 *
 */
class PublicController extends Controller
{

    /**
     * User Login Function
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $json = array();
        if (Session::has('user_id')) {
            $id = Session::get('user_id');
            $user = User::find($id);
            Auth::login($user);
            $json['type'] = 'success';
            $json['role'] = $user->getRoleNames()->first();
            session()->forget('user_id');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Step1 Registeration Validation
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStep1Validation(Request $request)
    {
        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
            ]
        );
    }

    /**
     * Step2 Registeration Validation
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStep2Validation(Request $request)
    {
        $this->validate(
            $request,
            [
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
                'termsconditions' => 'required',
                'role' => 'not_in:admin',
            ]
        );
    }

    /**
     * Single Form validation
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function singleFormValidation(Request $request)
    {
        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
                'termsconditions' => 'required',
                'role' => 'not_in:admin',
            ]
        );
    }

    /**
     * Set slug before saving in DB
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyUserCode(Request $request)
    {
        $json = array();
        if (Session::has('user_id')) {
            $id = Session::get('user_id');
            $email = Session::get('email');
            $password = Session::get('password');
            $user = User::find($id);
            if (!empty($request['code'])) {
                if ($request['code'] === $user->verification_code) {
                    $user->user_verified = 1;
                    $user->verification_code = null;
                    $user->save();
                    $json['type'] = 'success';
                    //send mail
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $email_params = array();
                        $template = DB::table('email_types')->select('id')->where('email_type', 'new_user')->get()->first();
                        if (!empty($template->id)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                            $email_params['name'] = Helper::getUserName($id);
                            $email_params['email'] = $email;
                            $email_params['password'] = $password;
                            Mail::to($email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'new_user',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        }
                        $admin_template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_registration')->get()->first();
                        if (!empty($template->id)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($admin_template->id);
                            $email_params['name'] = Helper::getUserName($id);
                            $email_params['email'] = $email;
                            $email_params['link'] = url('profile/' . $user->slug);
                            Mail::to(config('mail.username'))
                                ->send(
                                    new AdminEmailMailable(
                                        'admin_email_registration',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        }
                    }
                    session()->forget('password');
                    session()->forget('email');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.invalid_verify_code');
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.verify_code');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.session_expire');
            return $json;
        }
    }

    /**
     * Download file.
     *
     * @param \Illuminate\Http\Request $request request attributes
     * @param integer $id       id
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    function getFile($id, Request $request)
    {
        $filename = $request->get('attachment');
        $type = $request->get('type');
        if (!empty($type) && !empty($filename) && !empty($id)) {
            if (Storage::disk('local')->exists('uploads/' . $type . '/' . $id . '/' . $filename)) {
                return Storage::download('uploads/' . $type . '/' . $id . '/' . $filename);
            } else {
                Session::flash('error', trans('lang.file_not_found'));
                return Redirect::back();
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show user profile.
     *
     * @param string $slug slug
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserProfile($slug, $role)
    {
        //dd($slug, $role);
        $user = User::select('id')->where('slug', $slug)->first();
        if (!empty($user)) {
            $user = User::find($user->id);
            if ($user->is_disabled == 'true') {
                abort(404);
            }
            $skills = $user->skills()->get();
            $job = Job::where('user_id', $user->id)->get();
            $profile = Profile::all()->where('user_id', $user->id)->first();
            $reasons = Helper::getReportReasons();
            $avatar = Helper::getProfileImage($profile->user_id, 'medium-small-');
            $banner = !empty($profile->banner) ? '/uploads/users/' . $profile->user_id . '/' . $profile->banner : Helper::getUserProfileBanner($user->id);
            $auth_user = Auth::user() ? true : false;
            $user_name = Helper::getUserName($profile->user_id);
            $current_date = Carbon::now()->format('M d, Y');
            $tagline = !empty($profile) ? $profile->tagline : '';
            $desc = !empty($profile) ? $profile->description : '';
            //if ($user->getRoleNames()->first() === 'provider') {
            if ($role === 'provider') {

                $services = array();
                if (Schema::hasTable('services') && Schema::hasTable('service_user')) {
                    $services = $user->services;
                }
                $reviews = Review::where('receiver_id', $user->id)->get();
                $awards = !empty($profile->awards) ? unserialize($profile->awards) : array();
                $projects = !empty($profile->projects) ? unserialize($profile->projects) : array();
                $experiences = !empty($profile->experience) ? unserialize($profile->experience) : array();
                $education = !empty($profile->education) ? unserialize($profile->education) : array();
                $provider_rating  = !empty($user->profile->ratings) ? Helper::getUnserializeData($user->profile->ratings) : 0;
                $rating = !empty($provider_rating) ? $provider_rating[0] : 0;
                $joining_date = !empty($profile->created_at) ? Carbon::parse($profile->created_at)->format('M d, Y') : '';
                $jobs = Job::select('title', 'id')->get()->pluck('title', 'id');
                $save_provider = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                $badge = Helper::getUserBadge($user->id);
                $feature_class = !empty($badge) ? 'wt-featured' : '';
                $badge_color = !empty($badge) ? $badge->color : '';
                $badge_img  = !empty($badge) ? $badge->image : '';
                $amount = Payout::where('user_id', $user->id)->select('amount')->pluck('amount')->first();
                $employer_projects = Auth::user() ? Helper::getEmployerJobs(Auth::user()->id) : array();
                $payment_settings = SiteManagement::getMetaValue('commision');
                $currency_symbol  = !empty($payment_settings) && !empty($payment_settings[0]['currency']) ? Helper::currencyList($payment_settings[0]['currency']) : array();
                $symbol = !empty($currency_symbol['symbol']) ? $currency_symbol['symbol'] : '$';
                $settings = !empty(SiteManagement::getMetaValue('settings')) ? SiteManagement::getMetaValue('settings') : array();
                $display_chat = !empty($settings[0]['chat_display']) ? $settings[0]['chat_display'] : false;
                $enable_package = !empty($payment_settings) && !empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
                $videos = !empty($profile->videos) ? Helper::getUnserializeData($profile->videos) : '';
                $feedbacks = Review::select('feedback')->where('receiver_id', $user->id)->count(); 
                $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                $show_earnings = !empty($settings) && !empty($settings[0]['show_earnings']) ? $settings[0]['show_earnings'] : true;
                //dd($videos);
                if (file_exists(resource_path('views/extend/front-end/users/provider-show.blade.php'))) {
                    return View(
                        'extend.front-end.users.provider-show',
                        compact(
                            'show_earnings',
                            'average_rating_count',
                            'videos',
                            'services',
                            'profile',
                            'amount',
                            'skills',
                            'user',
                            'job',
                            'reasons',
                            'reviews',
                            'avatar',
                            'banner',
                            'user_name',
                            'jobs',
                            'rating',
                            'education',
                            'experiences',
                            'projects',
                            'awards',
                            'joining_date',
                            'save_provider',
                            'auth_user',
                            'badge',
                            'feature_class',
                            'badge_color',
                            'badge_img',
                            'employer_projects',
                            'currency_symbol',
                            'current_date',
                            'symbol',
                            'tagline',
                            'desc',
                            'display_chat',
                            'enable_package'
                        )
                    );
                } else {
                    return View(
                        'front-end.users.provider-show',
                        compact(
                            'show_earnings',
                            'average_rating_count',
                            'videos',
                            'services',
                            'profile',
                            'amount',
                            'skills',
                            'user',
                            'job',
                            'reasons',
                            'reviews',
                            'avatar',
                            'banner',
                            'user_name',
                            'jobs',
                            'rating',
                            'education',
                            'experiences',
                            'projects',
                            'awards',
                            'joining_date',
                            'save_provider',
                            'auth_user',
                            'badge',
                            'feature_class',
                            'badge_color',
                            'badge_img',
                            'employer_projects',
                            'currency_symbol',
                            'current_date',
                            'symbol',
                            'tagline',
                            'desc',
                            'display_chat',
                            'enable_package'
                        )
                    );
                }
            } elseif ($role === 'employer') {
            //} elseif ($user->getRoleNames()->first() === 'employer') {

                $jobs = Job::where('user_id', $profile->user_id)->latest()->paginate(7);
                $categories = Job::where('user_id', $profile->user_id)->get();
                $cats = array();
                foreach($categories as $category)
                {
                    foreach($category->categories as $cate)
                    {
                        array_push($cats, $cate->title);
                        
                    }
                }
                $user->scategories = array_unique($cats);

                $followers = DB::table('followers')->where('following', $profile->user_id)->get();
                $save_employer = !empty(auth()->user()->profile->saved_employers) ? unserialize(auth()->user()->profile->saved_employers) : array();
                $save_jobs = !empty(auth()->user()->profile->saved_jobs) ? unserialize(auth()->user()->profile->saved_jobs) : array();
                $currency = SiteManagement::getMetaValue('commision');
                $symbol   = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                $breadcrumbs_settings = SiteManagement::getMetaValue('show_breadcrumb');
                $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';

                $invoices = Invoice::where('payer_email', $user->email)->get();
                $total = 0;
                $currrency = '$';
                foreach($invoices as $invoice)
                {
                    $currrency = $invoice->currency_code;
                    $total = $total + $invoice->price;
                }
                
                //dd($scategories);

                $employer = Employer::where('user_id', $profile->user_id)->get()->first();
                if($employer)
                {
                    $address = Address::where('employer_id', $employer->id)->first();
                    $contact = Contact::where('employer_id', $employer->id)->first();
                }
                else
                {
                    $address = null;
                    $contact = null;
                }
                if (file_exists(resource_path('views/extend/front-end/users/employer-show.blade.php'))) {
                    return View(
                        'extend.front-end.users.employer-show',
                        compact(
                            'profile',
                            'skills',
                            'user',
                            'job',
                            'reasons',
                            'avatar',
                            'banner',
                            'user_name',
                            'jobs',
                            'followers',
                            'save_employer',
                            'save_jobs',
                            'auth_user',
                            'current_date',
                            'symbol',
                            'tagline',
                            'desc',
                            'employer',
                            'address',
                            'contact',
                            'show_breadcrumbs',
                            'total',
                            'currrency',
                            //'scategories'
                        )
                    );
                } else {
                    return View(
                        'front-end.users.employer-show',
                        compact(
                            'profile',
                            'skills',
                            'user',
                            'job',
                            'reasons',
                            'avatar',
                            'banner',
                            'user_name',
                            'jobs',
                            'followers',
                            'save_employer',
                            'save_jobs',
                            'auth_user',
                            'current_date',
                            'symbol',
                            'tagline',
                            'desc',
                            'employer',
                            'address',
                            'contact',
                            'show_breadcrumbs',
                            'total',
                            'currrency',
                            //'scategories'
                        )
                    );
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get filtered list.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFilterlist()
    {
        $json = array();
        $filters = Helper::getSearchFilterList();
        if (!empty($filters)) {
            $json['type'] = 'success';
            $json['result'] = $filters;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get filter Options.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFilterOptions()
    {
        $json = array();
        $locations  = array();
        $filters = Helper::getSearchFilterList();
        // $locations  = Location::all();
        // dd($locations);
        if (!empty($filters)) {
            $json['type'] = 'success';
            $json['result'] = $filters;
            // $json['locations'] = $locations;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get home services tabs
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getLocationList()
    {
        $json  = array();
        $locations = Helper::displaySearchLocationV2();
        if (!empty($roles)) {
            $json['locations'] = $locations;
            return $json;
        } 
    }

    /**
     * Get searchable data.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearchableData(Request $request)
    {
        $json = array();
        if (!empty($request['type'])) {
            $searchables = Helper::getSearchableList($request['type']);
            if (!empty($searchables)) {
                $json['type'] = 'success';
                $json['searchables'] = $searchables;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

      /**
     * Get searchable data.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearchableDataV2(Request $request)
    {
        $json = array();
        if (!empty($request['type'])) {
            $searchables = Helper::getSearchableListV2($request['type'], $request['location']);
            if (!empty($searchables)) {
                $json['type'] = 'success';
                $json['searchables'] = $searchables;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.no_record_found');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get search result.
     *
     * @param string $search_type search type
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearchResult($search_type = "")
    {
        
        $categories = array();
        $locations  = array();
        $languages  = array();
        $categories = Category::all();
        $locations  = Location::all();
        $languages  = Language::all();
        $skills     = Skill::all();
        $currency   = SiteManagement::getMetaValue('commision');
        $symbol     = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        $provider_skills = Helper::getProviderLevelList();
        $project_length = Helper::getJobDurationList();
        $address = $request->query('addr', '');
        $keyword = $request->query('s', '');
        $type = $request->query('type', $search_type);
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
        $current_date = Carbon::now()->toDateTimeString();
        $currency = SiteManagement::getMetaValue('commision');
        $symbol   = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        $inner_page  = SiteManagement::getMetaValue('inner_page_data');
        $payment_settings = SiteManagement::getMetaValue('commision');
        $enable_package = !empty($payment_settings) && !empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
        $breadcrumbs_settings = SiteManagement::getMetaValue('show_breadcrumb');
        $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';
        //dd($symbol);
        if ($request->filled('type')) {
            if ($type == 'employer' || $type == 'provider') {
                $users_total_records = User::count();
                $search =  User::getSearchResult(
                    $type,
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
                $save_provider = !empty(auth()->user()->profile->saved_provider) ?
                    unserialize(auth()->user()->profile->saved_provider) : array();
                $save_employer = !empty(auth()->user()->profile->saved_employers) ?
                    unserialize(auth()->user()->profile->saved_employers) : array();
                if ($type === 'employer') {
                    $emp_list_meta_title = !empty($inner_page) && !empty($inner_page[0]['emp_list_meta_title']) ? $inner_page[0]['emp_list_meta_title'] : trans('lang.emp_listing');
                    $emp_list_meta_desc = !empty($inner_page) && !empty($inner_page[0]['emp_list_meta_desc']) ? $inner_page[0]['emp_list_meta_desc'] : trans('lang.emp_meta_desc');
                    $show_emp_banner = !empty($inner_page) && !empty($inner_page[0]['show_emp_banner']) ? $inner_page[0]['show_emp_banner'] : 'true';
                    $e_inner_banner = !empty($inner_page) && !empty($inner_page[0]['e_inner_banner']) ? $inner_page[0]['e_inner_banner'] : null;
                    if (file_exists(resource_path('views/extend/front-end/employers/index.blade.php'))) {
                        return view(
                            'extend.front-end.employers.index',
                            compact(
                                'users',
                                'locations',
                                'languages',
                                'provider_skills',
                                'project_length',
                                'keyword',
                                'type',
                                'users_total_records',
                                'save_employer',
                                'current_date',
                                'emp_list_meta_title',
                                'emp_list_meta_desc',
                                'show_emp_banner',
                                'e_inner_banner',
                                'enable_package',
                                'show_breadcrumbs'
                            )
                        );
                    } else {
                        return view(
                            'front-end.employers.index',
                            compact(
                                'users',
                                'locations',
                                'languages',
                                'provider_skills',
                                'project_length',
                                'keyword',
                                'type',
                                'users_total_records',
                                'save_employer',
                                'current_date',
                                'emp_list_meta_title',
                                'emp_list_meta_desc',
                                'show_emp_banner',
                                'e_inner_banner',
                                'enable_package',
                                'show_breadcrumbs'
                            )
                        );
                    }
                } elseif ($type === 'provider') {
                    //dd('providers', $symbol);
                    
                    $f_list_meta_title = !empty($inner_page) && !empty($inner_page[0]['f_list_meta_title']) ? $inner_page[0]['f_list_meta_title'] : trans('lang.provider_listing');
                    $f_list_meta_desc = !empty($inner_page) && !empty($inner_page[0]['f_list_meta_desc']) ? $inner_page[0]['f_list_meta_desc'] : trans('lang.provider_meta_desc');
                    $show_f_banner = !empty($inner_page) && !empty($inner_page[0]['show_f_banner']) ? $inner_page[0]['show_f_banner'] : 'true';
                    $f_inner_banner = !empty($inner_page) && !empty($inner_page[0]['f_inner_banner']) ? $inner_page[0]['f_inner_banner'] : null;
                    return view('front-end.providers.search_provider',
                    compact(
                        'type',
                        'users',
                        'categories',
                        'locations',
                        'languages',
                        'skills',
                        'project_length',
                        'keyword',
                        'users_total_records',
                        'save_provider',
                        'symbol',
                        'current_date',
                        'f_list_meta_title',
                        'f_list_meta_desc',
                        'show_f_banner',
                        'f_inner_banner',
                        'enable_package',
                        'show_breadcrumbs'
                    ));
                    if (file_exists(resource_path('views/extend/front-end/providers/index.blade.php'))) {
                        return view(
                            'extend.front-end.providers.index',
                            compact(
                                'type',
                                'users',
                                'categories',
                                'locations',
                                'languages',
                                'skills',
                                'project_length',
                                'keyword',
                                'users_total_records',
                                'save_provider',
                                'symbol',
                                'current_date',
                                'f_list_meta_title',
                                'f_list_meta_desc',
                                'show_f_banner',
                                'f_inner_banner',
                                'enable_package',
                                'show_breadcrumbs'
                            )
                        );
                    } else {
                        return view(
                            'front-end.providers.index',
                            compact(
                                'type',
                                'users',
                                'categories',
                                'locations',
                                'languages',
                                'skills',
                                'project_length',
                                'keyword',
                                'users_total_records',
                                'save_provider',
                                'symbol',
                                'current_date',
                                'f_list_meta_title',
                                'f_list_meta_desc',
                                'show_f_banner',
                                'f_inner_banner',
                                'enable_package',
                                'show_breadcrumbs'
                            )
                        );
                    }
                } else {
                    abort(404);
                }
            } elseif ($type == 'service') {
                $service_list_meta_title = !empty($inner_page) && !empty($inner_page[0]['service_list_meta_title']) ? $inner_page[0]['service_list_meta_title'] : trans('lang.service_listing');
                $service_list_meta_desc = !empty($inner_page) && !empty($inner_page[0]['service_list_meta_desc']) ? $inner_page[0]['service_list_meta_desc'] : trans('lang.service_meta_desc');
                $show_service_banner = !empty($inner_page) && !empty($inner_page[0]['show_service_banner']) ? $inner_page[0]['show_service_banner'] : 'true';
                $service_inner_banner = !empty($inner_page) && !empty($inner_page[0]['service_inner_banner']) ? $inner_page[0]['service_inner_banner'] : null;
                // $services= Service::all();
                $delivery_time = DeliveryTime::all();
                $response_time = ResponseTime::all();
                $services_total_records = Service::count();
                $min_price = $request->query('minprice', 0);
                $max_price = $request->query('maxprice', 0);
                $results = Service::getSearchResult(
                    $keyword,
                    $search_categories,
                    $search_locations,
                    $search_languages,
                    $search_delivery_time,
                    $search_response_time,
                    $min_price,
                    $max_price
                );
                $services = $results['services'];
                if (file_exists(resource_path('views/extend/front-end/services/index.blade.php'))) {
                    return view(
                        'extend.front-end.services.index',
                        compact(
                            'services_total_records',
                            'type',
                            'services',
                            'symbol',
                            'keyword',
                            'categories',
                            'locations',
                            'languages',
                            'delivery_time',
                            'response_time',
                            'service_list_meta_title',
                            'service_list_meta_desc',
                            'show_service_banner',
                            'service_inner_banner',
                            'show_breadcrumbs'
                        )
                    );
                } else {
                    return view(
                        'front-end.services.index',
                        compact(
                            'services_total_records',
                            'type',
                            'services',
                            'symbol',
                            'keyword',
                            'categories',
                            'locations',
                            'languages',
                            'delivery_time',
                            'response_time',
                            'service_list_meta_title',
                            'service_list_meta_desc',
                            'show_service_banner',
                            'service_inner_banner',
                            'show_breadcrumbs'
                        )
                    );
                }
            } else {
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
                if (!empty($jobs)) {
                    if (file_exists(resource_path('views/extend/front-end/jobs/index.blade.php'))) {
                        return view(
                            'extend.front-end.jobs.index',
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
                                'job_inner_banner',
                                'show_breadcrumbs'
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
                                'job_inner_banner',
                                'show_breadcrumbs'
                            )
                        );
                    }
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Pass Reset Form
     *
     * @param mixed $verification_code verification_code
     *
     * @access public
     *
     * @return View
     */
    public function resetPasswordView($verification_code)
    {
        if (!empty($verification_code)) {
            session()->put(['verification_code' => $verification_code]);
            if (file_exists(resource_path('views/extend/front-end/reset-password.blade.php'))) {
                return View('extend.front-end.reset-password');
            } else {
                return View('front-end.reset-password');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Reset user password.
     *
     * @param mixed $request req->attr
     *
     * @access public
     *
     * @return View
     */
    public function resetUserPassword(Request $request)
    {
        if (Session::has('verification_code')) {
            $verification_code = Session::get('verification_code');
            if (!empty($request)) {
                $this->validate(
                    $request,
                    [
                        'new_password' => 'required',
                        'confirm_password' => 'required',
                    ]
                );
                $user_id = User::select('verification_code', 'id')
                    ->where('verification_code', $verification_code)
                    ->pluck('id')->first();
                $user = User::find($user_id);
                if ($request->new_password === $request->confirm_password) {
                    if ($verification_code === $user->verification_code) {
                        $user->password = Hash::make($request->confirm_password);
                        $user->verification_code = null;
                        $user->save();
                        Auth::logout();
                        session()->forget('verification_code');
                        return Redirect::to('/');
                    } else {
                        Session::flash('error', trans('lang.invalid_verify_code'));
                        return Redirect::back();
                    }
                } else {
                    Session::flash('error', trans('lang.pass_mismatched'));
                    return Redirect::back();
                }
            } else {
                Session::flash('error', trans('lang.something_wrong'));
                return Redirect::back();
            }
        } else {
            Session::flash('error', trans('lang.invalid_verify_code'));
            return Redirect::back();
        }
    }

    /**
     * Check user authorization.
     *
     * @access public
     *
     * @return View
     */
    public function checkProposalAuth()
    {
        $json = array();
        if (Auth::user() && Auth::user()->role === 'provider') {
            $json['auth'] = true;
            return $json;
        } else {
            $json['auth'] = false;
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Check user authorization.
     *
     * @access public
     *
     * @return View
     */
    public function checkServiceAuth()
    {
        $json = array();
        if (Auth::user() && Auth::user()->role === 'employer') {
            $json['auth'] = true;
            return $json;
        } else {
            $json['auth'] = false;
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Check user authorization.
     *
     * @access public
     *
     * @return unserialize array
     */
    public function getProviderExperience(Request $request)
    {
        $json = array();
        $id = $request['id'];
        $provider = User::find($id);
        if (!empty($provider)) {
            $json['type'] = 'success';
            $json['experience'] = unserialize($provider->profile->experience);
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Check user authorization.
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getProviderEducation(Request $request)
    {
        $json = array();
        $id = $request['id'];
        $provider = User::find($id);
        if (!empty($provider)) {
            $json['type'] = 'success';
            $json['education'] = unserialize($provider->profile->education);
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Check user authorization.
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getProviderService(Request $request)
    {
        $json = array();
        $id = $request['id'];
        $provider = User::find($id);
        if (!empty($provider)) {
            $json['type'] = 'success';
            $json['user'] = $provider;
            $json['services'] = Helper::getUnserializeData($provider->services);
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * get video
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getVideo($video)
    {
        $json = array();
        if (!empty($video)) {
            $width 	= 367;
            $height = 206;
            $url = parse_url($video);
            if (isset($url['host']) && ($url['host'] == 'vimeo.com' || $url['host'] == 'player.vimeo.com')) {
                $content_exp = explode("/", $url);
                $content_vimo = array_pop($content_exp);
                $json['video_content'] = '<iframe width="' . intval($width) . '" height="' . intval($height) . '" src="https://player.vimeo.com/video/' . $content_vimo . '" 
        ></iframe>';
            } else {
                $json['video'] = '<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.str_replace("v=", '', $url['query']).'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get article data
     *
     * @return \Illuminate\Http\Response
     */
    public function getArticles()
    {
        $json = array();
        $articles = Article::get()->toArray();
        $aticle_list = array();
        if (!empty($articles)) {
            foreach ($articles as $key => $article) {
                $article_obj = Article::find($article['id']);
                $aticle_list[$key]['id'] = $article['id'];
                $aticle_list[$key]['title'] = $article['title'];
                $aticle_list[$key]['slug'] = $article['slug'];
                $aticle_list[$key]['banner'] = asset(Helper::getImage('uploads/articles', $article['banner'], 'small-', 'small-default-article.png'));
                $aticle_list[$key]['published_date'] = $article['created_at'];
                $aticle_list[$key]['description'] = $article['description'];
                $aticle_list[$key]['name'] = Helper::getUserName($article['user_id']);
                $aticle_list[$key]['image'] = asset(Helper::getProfileImage($article['user_id']));
                if (!empty($article_obj->categories) && $article_obj->categories->count() > 0) {
                    foreach ($article_obj->categories as $cat_key => $category) {
                        $aticle_list[$key]['cat'][$cat_key]['title'] = $category->title;
                        $aticle_list[$key]['cat'][$cat_key]['slug'] = $category->slug;
                    }
                }
            }
            if (!empty($aticle_list)) {
                $json['type'] = 'success';
                $json['articles'] = $aticle_list;
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
     * Get filter Options.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPriceLimit()
    {
        $json = array();
        
        $general_settings = !empty(SiteManagement::getMetaValue('settings')) ? SiteManagement::getMetaValue('settings') : array();
		$price_range = !empty($general_settings) && !empty($general_settings[0]['price_range']) ? $general_settings[0]['price_range'] : 1000;
        return $price_range;
    }
}
