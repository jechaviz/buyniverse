<?php
/**
 * Class EmployerController.
 *
 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper;
use App\Department;
use App\Location;
use App\Profile;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\User;
use Session;
use App\Language;
use App\Category;
use App\Skill;
use App\Job;
use App\Proposal;
use DB;
use App\Package;
use App\EmailTemplate;
use App\Mail\ProviderEmailMailable;
use App\Invoice;
use App\Item;
use Carbon\Carbon;
use App\Message;
use App\SiteManagement;
use App\Service;
use App\Review;
use App\Payout;
use App\Employer;
use App\Address;
use App\Contact;

/**
 * Class EmployerController
 */
class EmployerController extends Controller
{

    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $employer
     */
    protected $employer;

    /**
     * Create a new controller instance.
     *
     * @param instance $employer instance
     *
     * @return void
     */
    public function __construct(Profile $employer)
    {
        $this->employer = $employer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = $this->employer::where('user_id', Auth::user()->id)
            ->get()->first();
        $employees = Helper::getEmployeesList();
        $departments = Department::all();
        $locations = Location::select('title', 'id')->get();
        // foreach($locations as $location)
        // {
        //     dd($location);
        // }
        //dd($locations);
        $gender = !empty($profile->gender) ? $profile->gender : '';
        $tagline = !empty($profile->tagline) ? $profile->tagline : '';
        $description = !empty($profile->description) ? $profile->description : '';
        $banner = !empty($profile->banner) ? $profile->banner : '';
        $avater = !empty($profile->avater) ? $profile->avater : '';
        //dd($avater);
        $address = !empty($profile->address) ? $profile->address : '';
        $longitude = !empty($profile->longitude) ? $profile->longitude : '';
        $latitude = !empty($profile->latitude) ? $profile->latitude : '';
        $no_of_employees = !empty($profile->no_of_employees) ? $profile->no_of_employees : '';
        $department_id = !empty($profile->department_id) ? $profile->department_id : '';
        $payout_id = !empty($profile->payout_id) ? $profile->payout_id : '';
        $packages = DB::table('items')->where('subscriber', Auth::user()->id)->count();
        $package_options = Package::select('options')->where('role_id', Auth::user()->id)->first();
        $options = !empty($package_options) ? unserialize($package_options['options']) : array();
        $register_form = SiteManagement::getMetaValue('reg_form_settings');
        $show_emplyr_inn_sec = !empty($register_form) && !empty($register_form[0]['show_emplyr_inn_sec']) ? $register_form[0]['show_emplyr_inn_sec'] : 'true';

        //address, employer, contacts
        $address = null;
        $contact = null;
        $employer = Employer::where('user_id', Auth::user()->id)->get()->first();
        if($employer)
        {
            $address = Address::where('employer_id', $employer->id)->first();
            $contact = Contact::where('employer_id', $employer->id)->first();
        }
        if (file_exists(resource_path('views/extend/back-end/employer/profile-settings/personal-detail/index.blade.php'))) {
            return view(
                'extend.back-end.employer.profile-settings.personal-detail.index',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'show_emplyr_inn_sec'
                )
            );
        } else {
            return view(
                'back-end.employer.profile-settings.personal-detail.index',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'show_emplyr_inn_sec'
                )
            );
        }
    }

    public function employerdetail()
    {
        $profile = $this->employer::where('user_id', Auth::user()->id)
            ->get()->first();
        $employees = Helper::getEmployeesList();
        $departments = Department::all();
        $locations = Location::pluck('title', 'id');
        $gender = !empty($profile->gender) ? $profile->gender : '';
        $tagline = !empty($profile->tagline) ? $profile->tagline : '';
        $description = !empty($profile->description) ? $profile->description : '';
        $banner = !empty($profile->banner) ? $profile->banner : '';
        $avater = !empty($profile->avater) ? $profile->avater : '';
        //dd($avater);
        $address = !empty($profile->address) ? $profile->address : '';
        $longitude = !empty($profile->longitude) ? $profile->longitude : '';
        $latitude = !empty($profile->latitude) ? $profile->latitude : '';
        $no_of_employees = !empty($profile->no_of_employees) ? $profile->no_of_employees : '';
        $department_id = !empty($profile->department_id) ? $profile->department_id : '';
        $payout_id = !empty($profile->payout_id) ? $profile->payout_id : '';
        $packages = DB::table('items')->where('subscriber', Auth::user()->id)->count();
        $package_options = Package::select('options')->where('role_id', Auth::user()->id)->first();
        $options = !empty($package_options) ? unserialize($package_options['options']) : array();
        $register_form = SiteManagement::getMetaValue('reg_form_settings');
        $show_emplyr_inn_sec = !empty($register_form) && !empty($register_form[0]['show_emplyr_inn_sec']) ? $register_form[0]['show_emplyr_inn_sec'] : 'true';

        //address, employer, contacts
        $address = null;
        $contact = null;
        $employer = Employer::where('user_id', Auth::user()->id)->get()->first();
        $modes = array('no taxer person' => 'no taxer person','taxer person' => 'taxer person','taxer company' => 'taxer company');
        //dd($modes);
        if($employer)
        {
            $address = Address::where('employer_id', $employer->id)->first();
            $contact = Contact::where('employer_id', $employer->id)->first();
        }
        else
        {
            $employer = new \stdClass();
            $employer->id = null;
            $employer->name = null;
            $employer->taxId = null;
            $employer->	taxPayerType = null;
            $employer->privateKey = null;
            $employer->publicKey = null;
            $employer->privateKeyPassword = null;
            $employer->licence = null;
            $employer->mode = null;
            
        }
        if (file_exists(resource_path('views/extend/back-end/employer/profile-settings/personal-detail/employer.blade.php'))) {
            return view(
                'extend.back-end.employer.profile-settings.personal-detail.employer',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'modes',
                    'show_emplyr_inn_sec'
                )
            );
        } else {
            return view(
                'back-end.employer.profile-settings.personal-detail.employer',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'modes',
                    'show_emplyr_inn_sec'
                )
            );
        }
    }

    public function addressdetail()
    {
        $profile = $this->employer::where('user_id', Auth::user()->id)
            ->get()->first();
        $employees = Helper::getEmployeesList();
        $departments = Department::all();
        $locations = Location::pluck('title', 'id');
        $gender = !empty($profile->gender) ? $profile->gender : '';
        $tagline = !empty($profile->tagline) ? $profile->tagline : '';
        $description = !empty($profile->description) ? $profile->description : '';
        $banner = !empty($profile->banner) ? $profile->banner : '';
        $avater = !empty($profile->avater) ? $profile->avater : '';
        //dd($avater);
        $address = !empty($profile->address) ? $profile->address : '';
        $longitude = !empty($profile->longitude) ? $profile->longitude : '';
        $latitude = !empty($profile->latitude) ? $profile->latitude : '';
        $no_of_employees = !empty($profile->no_of_employees) ? $profile->no_of_employees : '';
        $department_id = !empty($profile->department_id) ? $profile->department_id : '';
        $payout_id = !empty($profile->payout_id) ? $profile->payout_id : '';
        $packages = DB::table('items')->where('subscriber', Auth::user()->id)->count();
        $package_options = Package::select('options')->where('role_id', Auth::user()->id)->first();
        $options = !empty($package_options) ? unserialize($package_options['options']) : array();
        $register_form = SiteManagement::getMetaValue('reg_form_settings');
        $show_emplyr_inn_sec = !empty($register_form) && !empty($register_form[0]['show_emplyr_inn_sec']) ? $register_form[0]['show_emplyr_inn_sec'] : 'true';

        //address, employer, contacts
        $address = null;
        $contact = null;
        $employer = Employer::where('user_id', Auth::user()->id)->get()->first();
        if($employer)
        {
            $address = Address::where('employer_id', $employer->id)->first();
            $contact = Contact::where('employer_id', $employer->id)->first();
            if(!$address)
            {
                $address = new \stdClass();
                $address->name = null;
                $address->type = null;
                $address->street = null;
                $address->externalNumber = null;
                $address->internalNumber = null;
                $address->neighborhood = null;
                $address->locality = null;
                $address->reference = null;
                $address->city = null;
                $address->state = null;
                $address->country = null;
                $address->zipCode = null;
                $address->latitude = null;
                $address->longitude = null;
                $address->website = null;
            }
        }
        else
        {
            if(!$address)
            {
                $address = new \stdClass();
                $address->name = null;
                $address->type = null;
                $address->street = null;
                $address->externalNumber = null;
                $address->internalNumber = null;
                $address->neighborhood = null;
                $address->locality = null;
                $address->reference = null;
                $address->city = null;
                $address->state = null;
                $address->country = null;
                $address->zipCode = null;
                $address->latitude = null;
                $address->longitude = null;
                $address->website = null;
            }
            
        }
        if (file_exists(resource_path('views/extend/back-end/employer/profile-settings/personal-detail/address.blade.php'))) {
            return view(
                'extend.back-end.employer.profile-settings.personal-detail.address',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'show_emplyr_inn_sec'
                )
            );
        } else {
            return view(
                'back-end.employer.profile-settings.personal-detail.address',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'show_emplyr_inn_sec'
                )
            );
        }
    }

    public function contactdetail()
    {
        $profile = $this->employer::where('user_id', Auth::user()->id)
            ->get()->first();
        $employees = Helper::getEmployeesList();
        $departments = Department::all();
        $locations = Location::pluck('title', 'id');
        $gender = !empty($profile->gender) ? $profile->gender : '';
        $tagline = !empty($profile->tagline) ? $profile->tagline : '';
        $description = !empty($profile->description) ? $profile->description : '';
        $banner = !empty($profile->banner) ? $profile->banner : '';
        $avater = !empty($profile->avater) ? $profile->avater : '';
        //dd($avater);
        $address = !empty($profile->address) ? $profile->address : '';
        $longitude = !empty($profile->longitude) ? $profile->longitude : '';
        $latitude = !empty($profile->latitude) ? $profile->latitude : '';
        $no_of_employees = !empty($profile->no_of_employees) ? $profile->no_of_employees : '';
        $department_id = !empty($profile->department_id) ? $profile->department_id : '';
        $payout_id = !empty($profile->payout_id) ? $profile->payout_id : '';
        $packages = DB::table('items')->where('subscriber', Auth::user()->id)->count();
        $package_options = Package::select('options')->where('role_id', Auth::user()->id)->first();
        $options = !empty($package_options) ? unserialize($package_options['options']) : array();
        $register_form = SiteManagement::getMetaValue('reg_form_settings');
        $show_emplyr_inn_sec = !empty($register_form) && !empty($register_form[0]['show_emplyr_inn_sec']) ? $register_form[0]['show_emplyr_inn_sec'] : 'true';

        //address, employer, contacts
        $address = null;
        $contact = null;
        $employer = Employer::where('user_id', Auth::user()->id)->get()->first();
        if($employer)
        {
            $address = Address::where('employer_id', $employer->id)->first();
            $contact = Contact::where('employer_id', $employer->id)->first();
            if(!$contact)
            {
                $contact = new \stdClass();
                $contact->name = null;
                $contact->position = null;
                $contact->department = null;
                $contact->skype = null;
                $contact->facebook = null;
                $contact->twitter = null;
                $contact->personalWebSite = null;
            }
        }
        else
        {
            if(!$contact)
            {
                $contact = new \stdClass();
                $contact->name = null;
                $contact->position = null;
                $contact->department = null;
                $contact->skype = null;
                $contact->facebook = null;
                $contact->twitter = null;
                $contact->personalWebSite = null;
            }
            
        }
        if (file_exists(resource_path('views/extend/back-end/employer/profile-settings/personal-detail/contact.blade.php'))) {
            return view(
                'extend.back-end.employer.profile-settings.personal-detail.contact',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'show_emplyr_inn_sec'
                )
            );
        } else {
            return view(
                'back-end.employer.profile-settings.personal-detail.contact',
                compact(
                    'payout_id',
                    'employees',
                    'departments',
                    'locations',
                    'gender',
                    'tagline',
                    'description',
                    'banner',
                    'avater',
                    'address',
                    'longitude',
                    'latitude',
                    'no_of_employees',
                    'department_id',
                    'options',
                    'packages',
                    'employer',
                    'address',
                    'contact',
                    'show_emplyr_inn_sec'
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
        //dd($path);
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
            $image_size = array(
                'small' => array(
                    'width' => 350,
                    'height' => 172,
                ),
                'medium' => array(
                    'width' => 1140,
                    'height' => 400,
                ),
            );
            $profile_image = $request['hidden_banner_image'];
            return Helper::uploadTempImageWithSize($path, $profile_image, '', $image_size);
        }
    }

    /**
     * Store profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */

    public function storeemployerSettings(Request $request)
    {
        //dd($request->all());
        $employer = Employer::where('user_id', Auth::user()->id)->get()->first();
        if($employer)
        {
            $employer->name = $request->name;
            $employer->taxId = $request->taxId;
            $employer->	taxPayerType = $request->taxPayerType;
            $employer->privateKey = $request->privateKey;
            $employer->publicKey = $request->publicKey;
            $employer->privateKeyPassword = $request->privateKeyPassword;
            $employer->licence = $request->licence;
            $employer->mode = $request->mode;
            $employer->save();
        }
        else
        {
            Employer::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'taxId' => $request->taxId,
                'taxPayerType' => $request->taxPayerType,
                'privateKey' => $request->privateKey,
                'publicKey' => $request->publicKey,
                'privateKeyPassword' => $request->privateKeyPassword,
                'licence' => $request->licence,
                'mode' => $request->mode,
            ]);
        }
        return redirect()->route('employerPersonalDetail');

    }

    public function storeaddressSettings(Request $request)
    {
        //dd($request->all());
        $employer = Employer::where('user_id', Auth::user()->id)->get()->first();
        
        if($employer)
        {
            $address = Address::where('employer_id', $employer->id)->first();
            
            if($address)
            {   
                $address->name = $request->name;
                $address->type = $request->type;
                $address->street = $request->street;
                $address->externalNumber = $request->externalNumber;
                $address->internalNumber = $request->internalNumber;
                $address->neighborhood = $request->neighborhood;
                $address->locality = $request->locality;
                $address->reference = $request->reference;
                $address->city = $request->city;
                $address->state = $request->state;
                $address->country = $request->country;
                $address->zipCode = $request->zipCode;
                $address->latitude = $request->latitude;
                $address->longitude = $request->longitude;
                $address->website = $request->website;
                $address->save();
            }
            else
            {
                Address::create([
                    'employer_id' => $employer->id,
                    'name' => $request->name,
                    'type' => $request->type,
                    'street' => $request->street,
                    'externalNumber' => $request->externalNumber,
                    'internalNumber' => $request->internalNumber,
                    'neighborhood' => $request->neighborhood,
                    'locality' => $request->locality,
                    'reference' => $request->reference,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'zipCode' => $request->zipCode,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'website' => $request->website,
                ]);
            }
        }
        
        return redirect()->route('employerPersonalDetail');

    }

    public function storecontactSettings(Request $request)
    {
        $employer = Employer::where('user_id', Auth::user()->id)->get()->first();
        
        if($employer)
        {
            $contact = Contact::where('employer_id', $employer->id)->first();
            
            if($address)
            {   
                $contact->name = $request->name;
                $contact->position = $request->position;
                $contact->department = $request->department;
                $contact->skype = $request->skype;
                $contact->facebook = $request->facebook;
                $contact->twitter = $request->twitter;
                $contact->personalWebSite = $request->personalWebSite;
                $contact->save();
            }
            else
            {
                Contact::create([
                    'employer_id' => $employer->id,
                    'name' => $request->name,
                    'position' => $request->position,
                    'department' => $request->department,
                    'skype' => $request->skype,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'personalWebSite' => $request->personalWebSite,
                ]);
            }
        }
        
        return redirect()->route('employerPersonalDetail');

    }

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
        if (!empty($request)) {
            $user_id = Auth::user()->id;
            $this->employer->storeProfile($request, $user_id);
            $json['type'] = 'success';
            $json['process'] = trans('lang.saving_profile');
            return $json;
        }
    }

    /**
     * Show Employer Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function employerDashboard()
    {
        //dd('this is the test');
        if (Auth::user()) {
            $ongoing_jobs = array();
            $employer_id = Auth::user()->id;
            $package_item = Item::where('subscriber', $employer_id)->first();
            $package = !empty($package_item) ? Package::find($package_item->product_id) : array();
            $option = !empty($package) && !empty($package['options']) ? unserialize($package['options']) : '';
            $expiry = !empty($option) && !empty($package_item) ? $package_item->updated_at->addDays($option['duration']) : '';
            $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
            $message_status = Message::where('status', 0)->where('receiver_id', $employer_id)->count();
            $notify_class = $message_status > 0 ? 'wt-insightnoticon' : '';
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            $enable_package = !empty($currency) && !empty($currency[0]['employer_package']) ? $currency[0]['employer_package'] : 'true';
            $icons  = SiteManagement::getMetaValue('icons');
            $latest_proposals_icon = !empty($icons['hidden_latest_proposal']) ? $icons['hidden_latest_proposal'] : 'img-20.png';
            $latest_package_expiry_icon = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : 'img-21.png';
            $latest_new_message_icon = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : 'img-19.png';
            $latest_saved_item_icon = !empty($icons['hidden_saved_item']) ? $icons['hidden_saved_item'] : 'img-22.png';
            $latest_cancel_job_icon = !empty($icons['hidden_cancel_job']) ? $icons['hidden_cancel_job'] : 'img-16.png';
            $latest_ongoing_job_icon = !empty($icons['hidden_ongoing_job']) ? $icons['hidden_ongoing_job'] : 'img-17.png';
            $latest_completed_job_icon = !empty($icons['hidden_completed_job']) ? $icons['hidden_completed_job'] : 'img-18.png';
            $latest_posted_job_icon = !empty($icons['hidden_posted_job']) ? $icons['hidden_posted_job'] : 'img-15.png';
            $ongoing_jobs = Auth::user()->jobs->where('status', 'hired')->take(8);
            $cancelled_services_icon = !empty($icons['hidden_cancelled_services']) ? $icons['hidden_cancelled_services'] : 'decline.png';
            $completed_services_icon = !empty($icons['hidden_completed_services']) ? $icons['hidden_completed_services'] : 'completed-task.png';
            $ongoing_services_icon = !empty($icons['hidden_ongoing_services']) ? $icons['hidden_ongoing_services'] : 'onservice.png';
            $access_type = Helper::getAccessType();
            //dd($access_type);
            if (file_exists(resource_path('views/extend/back-end/employer/dashboard.blade.php'))) {
                return view(
                    'extend.back-end.employer.dashboard',
                    compact(
                        'access_type',
                        'ongoing_jobs',
                        'expiry_date',
                        'notify_class',
                        'symbol',
                        'latest_proposals_icon',
                        'latest_package_expiry_icon',
                        'latest_new_message_icon',
                        'latest_saved_item_icon',
                        'latest_cancel_job_icon',
                        'latest_ongoing_job_icon',
                        'latest_completed_job_icon',
                        'latest_posted_job_icon',
                        'cancelled_services_icon',
                        'completed_services_icon',
                        'ongoing_services_icon',
                        'enable_package',
                        'package'
                    )
                );
            } else {
                return view(
                    'back-end.employer.dashboard',
                    compact(
                        'access_type',
                        'ongoing_jobs',
                        'expiry_date',
                        'notify_class',
                        'symbol',
                        'latest_proposals_icon',
                        'latest_package_expiry_icon',
                        'latest_new_message_icon',
                        'latest_saved_item_icon',
                        'latest_cancel_job_icon',
                        'latest_ongoing_job_icon',
                        'latest_completed_job_icon',
                        'latest_posted_job_icon',
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
     * Show Employer Jobs.
     *
     * @param string $status job status
     *
     * @return \Illuminate\Http\Response
     */
    public function showJobsDetails($id)
    {
        $job = Job::findOrFail($id);
        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        //dd($job);
        return view(
            'back-end.employer.jobs.details',
            compact(
                'job',
                'symbol' 
            )
        );
    }
    public function showEmployerJobs($status)
    {
        $ongoing_jobs = array();
        $employer_id = Auth::user()->id;
        if (Auth::user()) {
            $ongoing_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'hired')->paginate(7);
            $completed_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'completed')->paginate(7);
            $cancelled_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'cancelled')->paginate(7);
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            if (!empty($status) && $status === 'hired') {
                if (file_exists(resource_path('views/extend/back-end/employer/jobs/ongoing.blade.php'))) {
                    return view(
                        'extend.back-end.employer.jobs.ongoing',
                        compact(
                            'ongoing_jobs',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.jobs.ongoing',
                        compact(
                            'ongoing_jobs',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'completed') {
                if (file_exists(resource_path('views/extend/back-end/employer/jobs/completed.blade.php'))) {
                    return view(
                        'extend.back-end.employer.jobs.completed',
                        compact(
                            'completed_jobs',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.jobs.completed',
                        compact(
                            'completed_jobs',
                            'symbol'
                        )
                    );
                }
            }
        }
    }

    /**
     * Show Employer Jobs.
     *
     * @param string $status job status
     *
     * @return \Illuminate\Http\Response
     */
    public function employerServices()
    {
        $ongoing_jobs = array();
        $employer_id = Auth::user()->id;
        if (Auth::user()) {
            $employer = User::find($employer_id);
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            $hired_services = $employer->purchasedServices;
            $completed_services = $employer->completedServices;
            $cancelled_services = $employer->cancelledServices;
            if (file_exists(resource_path('views/extend/back-end/employer/services/manage.blade.php'))) {
                return view(
                    'extend.back-end.employer.services.manage',
                    compact(
                        'hired_services',
                        'completed_services',
                        'cancelled_services',
                        'symbol'
                    )
                );
            } else {
                return view(
                    'back-end.employer.services.manage',
                    compact(
                        'hired_services',
                        'completed_services',
                        'cancelled_services',
                        'symbol'
                    )
                );
            }
            /*if (!empty($status) && $status === 'hired') {
                $services = $employer->purchasedServices;
                if (file_exists(resource_path('views/extend/back-end/employer/services/ongoing.blade.php'))) {
                    return view(
                        'extend.back-end.employer.services.ongoing',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.services.ongoing',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'completed') {
                $services = $employer->completedServices;
                if (file_exists(resource_path('views/extend/back-end/employer/services/completed.blade.php'))) {
                    return view(
                        'extend.back-end.employer.services.completed',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.services.completed',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'cancelled') {
                $services = $employer->cancelledServices;
                if (file_exists(resource_path('views/extend/back-end/employer/services/cancelled.blade.php'))) {
                    return view(
                        'extend.back-end.employer.services.cancelled',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.services.cancelled',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            }*/
        }
    }
    public function showEmployerServices($status)
    {
        $ongoing_jobs = array();
        $employer_id = Auth::user()->id;
        if (Auth::user()) {
            $employer = User::find($employer_id);
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            if (!empty($status) && $status === 'hired') {
                $services = $employer->purchasedServices;
                if (file_exists(resource_path('views/extend/back-end/employer/services/ongoing.blade.php'))) {
                    return view(
                        'extend.back-end.employer.services.ongoing',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.services.ongoing',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'completed') {
                $services = $employer->completedServices;
                if (file_exists(resource_path('views/extend/back-end/employer/services/completed.blade.php'))) {
                    return view(
                        'extend.back-end.employer.services.completed',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.services.completed',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                }
            } elseif (!empty($status) && $status === 'cancelled') {
                $services = $employer->cancelledServices;
                if (file_exists(resource_path('views/extend/back-end/employer/services/cancelled.blade.php'))) {
                    return view(
                        'extend.back-end.employer.services.cancelled',
                        compact(
                            'services',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.services.cancelled',
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
     * Service Detail.
     *
     * @param int    $id     id
     * @param string $status status
     *
     * @return \Illuminate\Http\Response
     */
    public function showServiceDetail($service_id, $pivot_id, $status)
    {
        if (Auth::user()) {
            $pivot_service = Helper::getPivotService($pivot_id);
            $service = Service::find($service_id);
            $seller = Helper::getServiceSeller($service->id);
            $provider = !empty($seller) ? User::find($seller->user_id) : '';
            $service_status = Helper::getProjectStatus();
            $review_options = DB::table('review_options')->get()->all();
            // $avg_rating = Review::where('receiver_id', $provider->id)->sum('avg_rating');

            $feedbacks = !empty($provider) ? Review::select('feedback')->where('receiver_id', $provider->id)->count() : '';
            $avg_rating = Review::where('receiver_id', $provider->id)->sum('avg_rating');
            $rating  = $avg_rating != 0 ? round($avg_rating/Review::count()) : 0;
            $reviews = Review::where('receiver_id', $provider->id)->get();
            $stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
            $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;


           

            $reviews = !empty($provider) ? Review::where('receiver_id', $provider->id)->where('job_id', $service_id)->where('project_type', 'service')->get() : '';
            $cancel_proposal_text = trans('lang.cancel_proposal_text');
            $cancel_proposal_button = trans('lang.send_request');
            $validation_error_text = trans('lang.field_required');
            $cancel_popup_title = trans('lang.reason');
            $attachment = Helper::getUnserializeData($service->attachments);
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            if (file_exists(resource_path('views/extend/back-end/employer/services/show.blade.php'))) {
                return view(
                    'extend.back-end.employer.services.show',
                    compact(
                        'average_rating_count',
                        'pivot_service',
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
                        'service_id',
                        'pivot_id',
                        'symbol'
                    )
                );
            } else {
                return view(
                    'back-end.employer.services.show',
                    compact(
                        'average_rating_count',
                        'pivot_service',
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
                        'service_id',
                        'pivot_id',
                        'symbol'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Employer Payment Process.
     *
     * @param string $id proposal ID
     *
     * @return \Illuminate\Http\Response
     */
    public function employerPaymentProcess($id)
    {
        if (Auth::user() && !empty($id)) {
            if (Auth::user()) {
                $user_id = Auth::user()->id;
                $employer = User::find($user_id);
                $proposal = Proposal::where('id', $id)->get()->first();
                $job = $proposal->job;
                $provider = User::find($proposal->provider_id);
                $provider_name = Helper::getUserName($proposal->provider_id);
                $profile = User::find($proposal->provider_id)->profile;
                $attachments = !empty($proposal->attachments) ? unserialize($proposal->attachments) : '';
                $user_image = !empty($profile) ? $profile->avater : '';
                $profile_image = !empty($user_image) ? '/uploads/users/' . $proposal->provider_id . '/' . $user_image : 'images/user-login.png';
                $payout_settings = SiteManagement::getMetaValue('commision');
                $payment_gateway = !empty($payout_settings) && !empty($payout_settings[0]['payment_method']) ? $payout_settings[0]['payment_method'] : null;
                $currency   = SiteManagement::getMetaValue('commision');
                $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                $stripe_settings = SiteManagement::getMetaValue('stripe_settings');
                $stripe_img = !empty($stripe_settings) ? $stripe_settings[0]['stripe_img'] : '';
                if (file_exists(resource_path('views/extend/back-end/employer/jobs/checkout.blade.php'))) {
                    return view(
                        'extend.back-end.employer.jobs.checkout',
                        compact(
                            'job',
                            'stripe_img',
                            'provider_name',
                            'profile_image',
                            'proposal',
                            'payment_gateway',
                            'symbol'
                        )
                    );
                } else {
                    return view(
                        'back-end.employer.jobs.checkout',
                        compact(
                            'job',
                            'stripe_img',
                            'provider_name',
                            'profile_image',
                            'proposal',
                            'payment_gateway',
                            'symbol'
                        )
                    );
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get employer payouts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayouts()
    {
        $payouts =  Payout::where('user_id', Auth::user()->id)->paginate(10);
        if (file_exists(resource_path('views/extend/back-end/employer/payouts.blade.php'))) {
            return view(
                'extend.back-end.employer.payouts.payouts',
                compact('payouts')
            );
        } else {
            return view(
                'back-end.employer.payouts.payouts',
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
            if (file_exists(resource_path('views/extend/back-end/employer/payouts/payout_settings.blade.php'))) {
                return view(
                    'extend.back-end.employer.payouts.payout_settings', compact('payrols', 'payout_settings')
                );
            } else {
                return view(
                    'back-end.employer.payouts.payout_settings', compact('payrols', 'payout_settings')
                );
            }
        } else {
            abort(404);
        }
    }
    public function buy()
    {
        $employer_id = Auth::user()->id;
        $package_item = Item::where('subscriber', $employer_id)->first();
        $package = !empty($package_item) ? Package::find($package_item->product_id) : array();
        $option = !empty($package) && !empty($package['options']) ? unserialize($package['options']) : '';
        $expiry = !empty($option) && !empty($package_item) ? $package_item->updated_at->addDays($option['duration']) : '';
        $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
        $message_status = Message::where('status', 0)->where('receiver_id', $employer_id)->count();
        $notify_class = $message_status > 0 ? 'wt-insightnoticon' : '';
        $currency   = SiteManagement::getMetaValue('commision');
        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        $enable_package = !empty($currency) && !empty($currency[0]['employer_package']) ? $currency[0]['employer_package'] : 'true';
        $icons  = SiteManagement::getMetaValue('icons');
        $latest_proposals_icon = !empty($icons['hidden_latest_proposal']) ? $icons['hidden_latest_proposal'] : 'img-20.png';
        $latest_package_expiry_icon = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : 'img-21.png';
        $latest_new_message_icon = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : 'img-19.png';
        $latest_saved_item_icon = !empty($icons['hidden_saved_item']) ? $icons['hidden_saved_item'] : 'img-22.png';
        $latest_cancel_job_icon = !empty($icons['hidden_cancel_job']) ? $icons['hidden_cancel_job'] : 'img-16.png';
        $latest_ongoing_job_icon = !empty($icons['hidden_ongoing_job']) ? $icons['hidden_ongoing_job'] : 'img-17.png';
        $latest_completed_job_icon = !empty($icons['hidden_completed_job']) ? $icons['hidden_completed_job'] : 'img-18.png';
        $latest_posted_job_icon = !empty($icons['hidden_posted_job']) ? $icons['hidden_posted_job'] : 'img-15.png';
        $ongoing_jobs = Auth::user()->jobs->where('status', 'hired')->take(8);
        $cancelled_services_icon = !empty($icons['hidden_cancelled_services']) ? $icons['hidden_cancelled_services'] : 'decline.png';
        $completed_services_icon = !empty($icons['hidden_completed_services']) ? $icons['hidden_completed_services'] : 'completed-task.png';
        $ongoing_services_icon = !empty($icons['hidden_ongoing_services']) ? $icons['hidden_ongoing_services'] : 'onservice.png';
        $access_type = Helper::getAccessType();

        //provider 
        $type= 'provider';
        $keyword = $request->query('s', '');
        $search_locations = $request->query('locations', []);
        $search_employees = $request->query('employees', []);
        $search_skills = $request->query('skills', []);
        $search_hourly_rates = $request->query('hourly_rate', []);
        $search_freelaner_types = $request->query('freelaner_type', []);
        $search_english_levels = $request->query('english_level', []);
        $search_languages = $request->query('languages', []);
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
        
        $categories = Category::all();
        //dd($users);

        //jobs
        $address = $request->query('addr', '');
        $search_project_lengths = $request->query('project_lengths', []);
        $completed_project_setting = !empty($project_settings) && !empty($project_settings['enable_completed_projects']) ? $project_settings['enable_completed_projects'] : 'true';
        $min_price = $request->query('minprice', 0);
        $max_price = $request->query('maxprice', 0);
        foreach($categories as $category)
        {
            //$search_categories = $category->slug;
            $search_categories = $request->query('category', []);
            $search_categories[0] = $category->slug;
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
            $category->jobs = $results['jobs'];
        }

        //dd($categories);
        //projects

        $job_details = Job::latest()->where('user_id', Auth::user()->id)->paginate(5);
        $employer_id = Auth::user()->id;
        if (Auth::user()) {
            $ongoing_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'hired')->paginate(7);
            $completed_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'completed')->paginate(7);
            $cancelled_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'cancelled')->paginate(7);
            $currency   = SiteManagement::getMetaValue('commision');
        }
        $currency   = SiteManagement::getMetaValue('commision');
        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();


        //services 
        $search_delivery_time = $request->query('delivery_time', []);
        $search_response_time = $request->query('response_time', []);
        $type = 'service';
        $search_categories = array();
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
        //dd($services);
        /*dd($services, $keyword,
        $search_categories,
        $search_locations,
        $search_languages,
        $search_delivery_time,
        $search_response_time,
        $min_price,
        $max_price);*/


        if (Auth::user()) {            
            if (file_exists(resource_path('views/extend/back-end/employer/payouts/payout_settings.blade.php'))) {
                return view(
                    'extend.back-end.employer.buy', compact('notify_class', 'latest_new_message_icon', 'access_type', 'latest_proposals_icon', 'latest_saved_item_icon', 'latest_cancel_job_icon', 'latest_ongoing_job_icon', 'latest_completed_job_icon', 'latest_posted_job_icon', 'ongoing_services_icon', 'completed_services_icon', 'cancelled_services_icon')
                );
            } else {
                return view(
                    'back-end.employer.buy', compact('notify_class', 'latest_new_message_icon', 'access_type', 'latest_proposals_icon', 'latest_saved_item_icon', 'latest_cancel_job_icon', 'latest_ongoing_job_icon', 'latest_completed_job_icon', 'latest_posted_job_icon', 'ongoing_services_icon', 'completed_services_icon', 'cancelled_services_icon', 'users', 'categories', 'job_details', 'ongoing_jobs', 'completed_jobs', 'cancelled_jobs', 'symbol', 'services')
                );
            }
        } else {
            abort(404);
        }
    }

    public function products()
    {
        $employer_id = Auth::user()->id;
        $package_item = Item::where('subscriber', $employer_id)->first();
        $package = !empty($package_item) ? Package::find($package_item->product_id) : array();
        $option = !empty($package) && !empty($package['options']) ? unserialize($package['options']) : '';
        $expiry = !empty($option) && !empty($package_item) ? $package_item->updated_at->addDays($option['duration']) : '';
        $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
        $message_status = Message::where('status', 0)->where('receiver_id', $employer_id)->count();
        $notify_class = $message_status > 0 ? 'wt-insightnoticon' : '';
        $currency   = SiteManagement::getMetaValue('commision');
        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        $enable_package = !empty($currency) && !empty($currency[0]['employer_package']) ? $currency[0]['employer_package'] : 'true';
        $icons  = SiteManagement::getMetaValue('icons');
        $latest_proposals_icon = !empty($icons['hidden_latest_proposal']) ? $icons['hidden_latest_proposal'] : 'img-20.png';
        $latest_package_expiry_icon = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : 'img-21.png';
        $latest_new_message_icon = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : 'img-19.png';
        $latest_saved_item_icon = !empty($icons['hidden_saved_item']) ? $icons['hidden_saved_item'] : 'img-22.png';
        $latest_cancel_job_icon = !empty($icons['hidden_cancel_job']) ? $icons['hidden_cancel_job'] : 'img-16.png';
        $latest_ongoing_job_icon = !empty($icons['hidden_ongoing_job']) ? $icons['hidden_ongoing_job'] : 'img-17.png';
        $latest_completed_job_icon = !empty($icons['hidden_completed_job']) ? $icons['hidden_completed_job'] : 'img-18.png';
        $latest_posted_job_icon = !empty($icons['hidden_posted_job']) ? $icons['hidden_posted_job'] : 'img-15.png';
        $ongoing_jobs = Auth::user()->jobs->where('status', 'hired')->take(8);
        $cancelled_services_icon = !empty($icons['hidden_cancelled_services']) ? $icons['hidden_cancelled_services'] : 'decline.png';
        $completed_services_icon = !empty($icons['hidden_completed_services']) ? $icons['hidden_completed_services'] : 'completed-task.png';
        $ongoing_services_icon = !empty($icons['hidden_ongoing_services']) ? $icons['hidden_ongoing_services'] : 'onservice.png';
        $access_type = Helper::getAccessType();
        
        //provider 
        $type= 'provider';
        $keyword = $request->query('s', '');
        $search_locations = $request->query('locations', []);
        $search_employees = $request->query('employees', []);
        $search_skills = $request->query('skills', []);
        $search_hourly_rates = $request->query('hourly_rate', []);
        $search_freelaner_types = $request->query('freelaner_type', []);
        $search_english_levels = $request->query('english_level', []);
        $search_languages = $request->query('languages', []);
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
        $categories = Category::all();
        //dd($users);

        //jobs
        $address = $request->query('addr', '');
        $search_project_lengths = $request->query('project_lengths', []);
        $completed_project_setting = !empty($project_settings) && !empty($project_settings['enable_completed_projects']) ? $project_settings['enable_completed_projects'] : 'true';
        $min_price = $request->query('minprice', 0);
        $max_price = $request->query('maxprice', 0);
        foreach($categories as $category)
        {
            //$search_categories = $category->slug;
            $search_categories = $request->query('category', []);
            $search_categories[0] = $category->slug;
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
            $category->jobs = $results['jobs'];
        }

        //dd($categories);
        //projects

        /*$job_details = Job::latest()->where('user_id', Auth::user()->id)->paginate(5);
        $employer_id = Auth::user()->id;
        if (Auth::user()) {
            $ongoing_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'hired')->paginate(7);
            $completed_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'completed')->paginate(7);
            $cancelled_jobs = Job::where('user_id', $employer_id)->latest()->where('status', 'cancelled')->paginate(7);
            $currency   = SiteManagement::getMetaValue('commision');
        }
        $currency   = SiteManagement::getMetaValue('commision');
        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();


        //services 
        $search_delivery_time = $request->query('delivery_time', []);
        $search_response_time = $request->query('response_time', []);
        $type = 'service';
        $search_categories = array();
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
        //dd($services);
        /*dd($services, $keyword,
        $search_categories,
        $search_locations,
        $search_languages,
        $search_delivery_time,
        $search_response_time,
        $min_price,
        $max_price);
        */

        if (Auth::user()) {            
            if (file_exists(resource_path('views/extend/back-end/employer/payouts/payout_settings.blade.php'))) {
                return view(
                    'extend.back-end.employer.products', compact('notify_class', 'latest_new_message_icon', 'access_type', 'latest_proposals_icon', 'latest_saved_item_icon', 'latest_cancel_job_icon', 'latest_ongoing_job_icon', 'latest_completed_job_icon', 'latest_posted_job_icon', 'ongoing_services_icon', 'completed_services_icon', 'cancelled_services_icon')
                );
            } else {
                return view(
                    'back-end.employer.products', compact('notify_class', 'latest_new_message_icon', 'access_type', 'latest_proposals_icon', 'latest_saved_item_icon', 'latest_cancel_job_icon', 'latest_ongoing_job_icon', 'latest_completed_job_icon', 'latest_posted_job_icon', 'ongoing_services_icon', 'completed_services_icon', 'cancelled_services_icon', 'users', 'categories')
                );
            }
        } else {
            abort(404);
        }
    }
}
