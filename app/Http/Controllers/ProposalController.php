<?php
/**
 * Class ProposalController
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Job;
use App\Team;
use App\Freelancerinvite;
use App\Helper;
use App\Mail\EmailVerificationMailable;
use ZipArchive;
use App\User;
use App\Profile;
use Storage;
use Response;
use Auth;
use Carbon\Carbon;
use DB;
use App\Package;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\SiteManagement;
use App\Mail\EmployerEmailMailable;
use App\Mail\FreelancerEmailMailable;
use App\EmailTemplate;
use App\Review;
use App\Quiz;
use App\Job_quiz;
use App\Live_contest;
use App\Live_contest_participant;
use App\Marks;
use App\Job_file;
use App\Job_note;
use App\Job_ticket;
use App\Tasks;
use App\Approver;
use App\Item;
use App\Mail\Contestend;
use Session;


/**
 * Class ProposalController
 *
 */
class ProposalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param instance $proposal instance
     *
     * @return void
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * View job proposal.
     *
     * @param int $job_slug jobslug
     *
     * @return \Illuminate\Http\Response
     */
    public function createProposal($job_slug)
    {
        if (!empty($job_slug)) {
            $job = Job::all()->where('slug', $job_slug)->first();

            if (Auth::user() && !empty(Auth::user()->id)) {
                $submitted_proposals_count = DB::table('proposals')
                    ->where('job_id', $job->id)
                    ->where('freelancer_id', Auth::user()->id)->first();
            }
            //dd($submitted_proposals_count);
            if($submitted_proposals_count)
            {
                return redirect()->route('editProposal', $job_slug);   
            }
            $job_quizzes = Job_quiz::where('job_id', $job->id)->get();
            foreach($job_quizzes as $value)
            {
                $quiz = Quiz::find($value->quiz_id);
                $value->quiz = $quiz->title;
            }
            if (!empty($job)) {
                $job_skills = $job->skills->pluck('id')->toArray();
                $check_skill_req = $this->proposal->getJobSkillRequirement($job_skills);
                $proposal_status = Job::find($job->id)->proposals()->where('status', 'hired')->first();
                $role_id =  Helper::getRoleByUserID(Auth::user()->id);
                $package = DB::table('items')->where('subscriber', Auth::user()->id)->select('product_id', 'updated_at')->first();
                if(!$package)
                {
                    //dd('no package added');
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.no_pkg_found');
                    return $json;
                    //return redirect()->back()->with('type', 'error')->with('message', trans('lang.no_pkg_found'));
                }
                $package_options = Package::select('options')->where('id', $package->product_id)->get()->first();
                $options = !empty($package_options) ? unserialize($package_options['options']) : array();
                $settings = SiteManagement::getMetaValue('settings');
                $required_connects = !empty($settings) && !empty($settings[0]['connects_per_job']) ? $settings[0]['connects_per_job'] : 2;
                $remaining_proposals = !empty($options) && !empty($options['no_of_connects']) ? $options['no_of_connects'] / $required_connects : 0;
                $submitted_proposals = $this->proposal::where('freelancer_id', Auth::user()->id)->where('created_at', '>',  $package->updated_at)->count();
                $duration =  Helper::getJobDurationList($job->duration);
                $job_completion_time = Helper::getJobDurationList();
                $commision_amount = SiteManagement::getMetaValue('commision');
                $commision = !empty($commision_amount) && !empty($commision_amount[0]["commision"]) ? $commision_amount[0]["commision"] : 0;
                $currency = SiteManagement::getMetaValue('commision');
                $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                $breadcrumbs_settings = SiteManagement::getMetaValue('show_breadcrumb');
                $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';
                
                
                if (file_exists(resource_path('views/extend/front-end/jobs/proposal.blade.php'))) {
                    return View(
                        'extend.front-end.jobs.proposal',
                        compact(
                            'job',
                            'proposal_status',
                            'duration',
                            'job_completion_time',
                            'commision',
                            'check_skill_req',
                            'remaining_proposals',
                            'submitted_proposals',
                            'symbol',
                            'submitted_proposals_count',
                            'show_breadcrumbs',
                            'job_quizzes'
                        )
                    );
                } else {
                    return View(
                        'front-end.jobs.proposal',
                        compact(
                            'job',
                            'proposal_status',
                            'duration',
                            'job_completion_time',
                            'commision',
                            'check_skill_req',
                            'remaining_proposals',
                            'submitted_proposals',
                            'symbol',
                            'submitted_proposals_count',
                            'show_breadcrumbs',
                            'job_quizzes'
                        )
                    );
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function editProposal($job_slug)
    {
        if (!empty($job_slug)) {
            $job = Job::all()->where('slug', $job_slug)->first();

            if (Auth::user() && !empty(Auth::user()->id)) {
                $submitted_proposals_count = DB::table('proposals')
                    ->where('job_id', $job->id)
                    ->where('freelancer_id', Auth::user()->id)->first();
            }
            //dd($submitted_proposals_count);
            $job_quizzes = Job_quiz::where('job_id', $job->id)->get();
            foreach($job_quizzes as $value)
            {
                $quiz = Quiz::find($value->quiz_id);
                $value->quiz = $quiz->title;
            }
            if (!empty($job)) {
                $job_skills = $job->skills->pluck('id')->toArray();
                $check_skill_req = $this->proposal->getJobSkillRequirement($job_skills);
                $proposal_status = Job::find($job->id)->proposals()->where('status', 'hired')->first();
                
                $role_id =  Helper::getRoleByUserID(Auth::user()->id);
                $package = DB::table('items')->where('subscriber', Auth::user()->id)->select('product_id', 'updated_at')->first();
                if(!$package)
                {
                    //dd('no package added');
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.no_pkg_found');
                    return $json;
                    //return redirect()->back()->with('type', 'error')->with('message', trans('lang.no_pkg_found'));
                }
                $package_options = Package::select('options')->where('id', $package->product_id)->get()->first();
                $options = !empty($package_options) ? unserialize($package_options['options']) : array();
                $settings = SiteManagement::getMetaValue('settings');
                $required_connects = !empty($settings) && !empty($settings[0]['connects_per_job']) ? $settings[0]['connects_per_job'] : 2;
                $remaining_proposals = !empty($options) && !empty($options['no_of_connects']) ? $options['no_of_connects'] / $required_connects : 0;
                $submitted_proposals = $this->proposal::where('freelancer_id', Auth::user()->id)->where('created_at', '>',  $package->updated_at)->count();
                $duration =  Helper::getJobDurationList($job->duration);
                $job_completion_time = Helper::getJobDurationList();
                $commision_amount = SiteManagement::getMetaValue('commision');
                $commision = !empty($commision_amount) && !empty($commision_amount[0]["commision"]) ? $commision_amount[0]["commision"] : 0;
                $currency = SiteManagement::getMetaValue('commision');
                $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
                $breadcrumbs_settings = SiteManagement::getMetaValue('show_breadcrumb');
                $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';
                
                
                if (file_exists(resource_path('views/extend/front-end/jobs/eproposal.blade.php'))) {
                    return View(
                        'extend.front-end.jobs.proposal',
                        compact(
                            'job',
                            'proposal_status',
                            'duration',
                            'job_completion_time',
                            'commision',
                            'check_skill_req',
                            'remaining_proposals',
                            'submitted_proposals',
                            'symbol',
                            'submitted_proposals_count',
                            'show_breadcrumbs',
                            'job_quizzes'
                        )
                    );
                } else {
                    return View(
                        'front-end.jobs.eproposal',
                        compact(
                            'job',
                            'proposal_status',
                            'duration',
                            'job_completion_time',
                            'commision',
                            'check_skill_req',
                            'remaining_proposals',
                            'submitted_proposals',
                            'symbol',
                            'submitted_proposals_count',
                            'show_breadcrumbs',
                            'job_quizzes'
                        )
                    );
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
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
        if (!empty($request['file'])) {
            $attachments = $request['file'];
            $path = 'uploads/proposals/temp/';
            return Helper::uploadTempMultipleAttachments($attachments, $path);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request req attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function estore(Request $request)
    {
        //dd($request->all());
        $this->validate(
            $request,
            [
                'amount' => 'required',
                'completion_time'    => 'required',
                'description'    => 'required',
            ]
        );
        $job = Job::find($request['id']);
        if ($job->status != 'posted') {
            $json['type'] = 'error';
            $json['message'] = trans('lang.job_not_avail');
            Session::flash('error', trans('lang.job_not_avail'));
            return redirect()->back();
            //return redirect()->back()->with('type', 'error')->with('message', trans('lang.job_not_avail'));
            //return redirect()->route('editProposal', $job->slug)->with('json', $json);
            
        }
        if (intval($request['amount']) > $job->price) {
            $json['type'] = 'error';
            $json['message'] = trans('lang.proposal_exceed');
            Session::flash('error', trans('lang.proposal_exceed'));
            return redirect()->back();
            //return redirect()->back()->with('type', 'error')->with('message', trans('lang.proposal_exceed'));
            //return redirect()->route('editProposal', $job->slug)->with('json', $json);
            
        }
        $submit_propsal = $this->proposal->updateProposal($request, $request['id']);
        if ($submit_propsal = 'success') {
            //$json['type'] = 'success';
            //$json['message'] = trans('lang.proposal_submitted');
            Session::flash('message', trans('lang.proposal_submitted'));
            return redirect()->route('showFreelancerProposals');
            //showFreelancerProposals
        }

    }
    public function store(Request $request)
    {
        //dd($request->all());
        if (Auth::user()) {
            $server = Helper::worketicIsDemoSiteAjax();
            if (!empty($server)) {
                $response['message'] = $server->getData()->message;
                return $response;
            }
            if (!empty($request)) {
                $json = array();
                $this->validate(
                    $request,
                    [
                        'amount' => 'required',
                        'completion_time'    => 'required',
                        'description'    => 'required',
                    ]
                );
                $job = Job::find($request['id']);
                if ($job->status != 'posted') {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.job_not_avail');
                    return $json;
                }
                if (intval($request['amount']) > $job->price) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.proposal_exceed');
                    return $json;
                }
                $package = DB::table('items')->where('subscriber', Auth::user()->id)->select('product_id', 'updated_at')->first();
                $proposals = $this->proposal::where('freelancer_id', Auth::user()->id)->where('created_at', '>',  $package->updated_at)->count();
                $settings = SiteManagement::getMetaValue('settings');
                $payment_settings = SiteManagement::getMetaValue('commision');
                $required_connects = !empty($settings) && !empty($settings[0]['connects_per_job']) ? $settings[0]['connects_per_job'] : 2;
                $package_status = '';
                if (Auth::user() && $request['user_id']) {
                    $proposal = DB::table('proposals')
                        ->where('job_id', $request['id'])
                        ->where('freelancer_id', $request['user_id'])->count();
                    if ($proposal > 0) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.proposal_already_submitted');
                        return $json;
                    }
                }
                if (!empty($payment_settings) && empty($payment_settings[0]['enable_packages'])) {
                    $package_status = 'true';
                } else {
                    $package_status = $payment_settings[0]['enable_packages'];
                }
                if (!empty($payment_settings) && $package_status === 'true') {
                    if (empty($package->product_id)) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.need_to_purchase_pkg');
                        return $json;
                    }
                    $package_options = Package::select('options')->where('id', $package->product_id)->get()->first();
                    $option = unserialize($package_options->options);
                    //static connects
                    $option['no_of_connects'] = 1000;
                    $allowed_proposals = $option['no_of_connects'] / $required_connects;
                    if ($proposals >= $allowed_proposals) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.not_enough_connects');
                        return $json;
                    } else {
                        //dd('Submitting');
                        $submit_propsal = $this->proposal->storeProposal($request, $request['id']);
                        //dd($submit_propsal);
                        if ($submit_propsal = 'success') {
                            $json['type'] = 'success';
                            $json['message'] = trans('lang.proposal_submitted');
                            $user = User::find(Auth::user()->id);
                            //send email
                            if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                                if (!empty($job->employer->email)) {
                                    $email_params = array();
                                    $proposal_received_template = DB::table('email_types')->select('id')->where('email_type', 'employer_email_proposal_received')->get()->first();
                                    $proposal_submitted_template = DB::table('email_types')->select('id')->where('email_type', 'freelancer_email_new_proposal_submitted')->get()->first();
                                    if (!empty($proposal_received_template->id)
                                        || !empty($proposal_submitted_template->id)
                                    ) {
                                        $template_data = EmailTemplate::getEmailTemplateByID($proposal_received_template->id);
                                        $template_submit_proposal = EmailTemplate::getEmailTemplateByID($proposal_submitted_template->id);
                                        $email_params['employer'] = Helper::getUserName($job->employer->id);
                                        $email_params['employer_profile'] = url('profile/' . $job->employer->slug);
                                        $email_params['freelancer'] = Helper::getUserName(Auth::user()->id);
                                        $email_params['freelancer_profile'] = url('profile/' . $user->slug);
                                        $email_params['title'] = $job->title;
                                        $email_params['link'] = url('job/' . $job->slug);
                                        $email_params['amount'] = number_format($request['amount']);
                                        $email_params['duration'] = Helper::getJobDurationList($request['completion_time']);
                                        $email_params['message'] = $request['description'];
                                        Mail::to($job->employer->email)
                                            ->send(
                                                new EmployerEmailMailable(
                                                    'employer_email_proposal_received',
                                                    $template_data,
                                                    $email_params
                                                )
                                            );
                                        Mail::to($user->email)
                                            ->send(
                                                new FreelancerEmailMailable(
                                                    'freelancer_email_new_proposal_submitted',
                                                    $template_submit_proposal,
                                                    $email_params
                                                )
                                            );
                                    } else {
                                        $json['type'] = 'error';
                                        $json['message'] = trans('lang.something_wrong');
                                        return $json;
                                    }
                                }
                            }
                            return $json;
                        } else {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.something_wrong');
                            return $json;
                        }
                    }
                } else {
                    $submit_propsal = $this->proposal->storeProposal($request, $request['id']);
                    if ($submit_propsal = 'success') {
                        $json['type'] = 'success';
                        $json['message'] = trans('lang.proposal_submitted');
                        $user = User::find(Auth::user()->id);
                        //send email
                        if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                            if (!empty($job->employer->email)) {
                                $email_params = array();
                                $proposal_received_template = DB::table('email_types')->select('id')->where('email_type', 'employer_email_proposal_received')->get()->first();
                                $proposal_submitted_template = DB::table('email_types')->select('id')->where('email_type', 'freelancer_email_new_proposal_submitted')->get()->first();
                                if (
                                    !empty($proposal_received_template->id)
                                    || !empty($proposal_submitted_template->id)
                                ) {
                                    $template_data = EmailTemplate::getEmailTemplateByID($proposal_received_template->id);
                                    $template_submit_proposal = EmailTemplate::getEmailTemplateByID($proposal_submitted_template->id);
                                    $email_params['employer'] = Helper::getUserName($job->employer->id);
                                    $email_params['employer_profile'] = url('profile/' . $job->employer->slug);
                                    $email_params['freelancer'] = Helper::getUserName(Auth::user()->id);
                                    $email_params['freelancer_profile'] = url('profile/' . $user->slug);
                                    $email_params['title'] = $job->title;
                                    $email_params['link'] = url('job/' . $job->slug);
                                    $email_params['amount'] = number_format($request['amount']);
                                    $email_params['duration'] = Helper::getJobDurationList($request['completion_time']);
                                    $email_params['message'] = $request['description'];
                                    Mail::to($job->employer->email)
                                        ->send(
                                            new EmployerEmailMailable(
                                                'employer_email_proposal_received',
                                                $template_data,
                                                $email_params
                                            )
                                        );
                                    Mail::to($user->email)
                                        ->send(
                                            new FreelancerEmailMailable(
                                                'freelancer_email_new_proposal_submitted',
                                                $template_submit_proposal,
                                                $email_params
                                            )
                                        );
                                } else {
                                    $json['type'] = 'error';
                                    $json['message'] = trans('lang.something_wrong');
                                    return $json;
                                }
                            }
                        }
                        return $json;
                    } else {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.something_wrong');
                        return $json;
                    }
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Get job proposal listing.
     *
     * @param string $slug jobSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobProposals($slug)
    {
        //dd('proposals');
        if (!empty($slug)) {
            $accepted_proposal = array();
            $job = Job::where('slug', $slug)->first();
            
            // $proposals = Job::latest()->find($job->id)->proposals;
            $proposals = Job::find($job->id)->proposals;
            $job_quizzes = Job_quiz::where('job_id', $job->id)->get();
            $proposals->quiz = $job->quiz;
            foreach($proposals as $proposal)
            {
                if(Live_contest::where('job_id', $job->id)->exists())
                {
                    $live1 = Live_contest::where('job_id', $job->id)->first();

                    if(Live_contest_participant::where('live_id', $live1->id)->where('user_id', $proposal->freelancer_id)->exists())
                        $proposal->sent = 'true';
                    else
                        $proposal->sent = 'false';
                }
                foreach($job_quizzes as $job_quiz)
                {
                    $quiz = Quiz::find($job_quiz->quiz_id);
                    if(Marks::where('quiz_id', $job_quiz->quiz_id)->where('user_id', $proposal->freelancer_id)->exists())
                    {
                        $marks = Marks::where('quiz_id', $job_quiz->quiz_id)->where('user_id', $proposal->freelancer_id)->first();
                        
                        $proposal->quiz_title = $quiz->title;
                        $proposal->marks = $marks;
                        $proposal->quiz_ans = 'true';
                    }
                    else
                    {
                        $proposal->quiz_title = $quiz->title;
                        $proposal->quiz_ans = 'false';
                    }
                }
            }
            if(Live_contest::where('job_id', $job->id)->exists())
            {
                $proposals->contest = 'true';
                $live = Live_contest::where('job_id', $job->id)->first();
                $proposals->contestid = $live->id;
            }                
            else
                $proposals->contest = 'false';
            //end    
            $accepted_proposal = Job::find($job->id)->proposals()->where('hired', 1)->first();
            //dd($accepted_proposal);
            $order = Job::getProjectOrder($job->id);
            $duration = !empty($job->duration) ? Helper::getJobDurationList($job->duration) : '';
            $currency   = SiteManagement::getMetaValue('commision');
            $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
            $payment_settings = SiteManagement::getMetaValue('commision');
            $enable_package = !empty($payment_settings) && !empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
            $mode = !empty($payment_settings) && !empty($payment_settings[0]['payment_mode']) ? $payment_settings[0]['payment_mode'] : 'true';
            if (file_exists(resource_path('views/extend/back-end/employer/proposals/index.blade.php'))) {
                return View(
                    'extend.back-end.employer.proposals.index',
                    compact(
                        'proposals',
                        'job',
                        'duration',
                        'accepted_proposal',
                        'symbol',
                        'enable_package',
                        'mode',
                        'order'
                    )
                );
            } else {
                return View(
                    'back-end.employer.proposals.index',
                    compact(
                        'proposals',
                        'job',
                        'duration',
                        'accepted_proposal',
                        'symbol',
                        'enable_package',
                        'mode',
                        'order'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Hire freelancer.
     *
     * @param \Illuminate\Http\Request $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function hiredFreelencer(Request $request)
    {
        $json = array();
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request['id'])) {
            $this->proposal->assignJob($request['id']);
            $json['type'] = 'success';
            $json['message'] = trans('lang.freelancer_hire');
            return $json;
        }
    }



    /**
     * Proposal Details.
     *
     * @param string $slug slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $status)
    {
        //dd('This is the test', $slug, $status);
        //$currenturl = \Route::fullUrl();
        //dd($currenturl);
        $profile = array();
        $accepted_proposal = array();
        $count = new \stdClass;
        $freelancer_name = '';
        $profile_image = '';
        $user_slug = '';
        $attachments = array();
        $job = Job::where('slug', $slug)->first();
        $accepted_proposal = Job::find($job->id)->proposals()->where('hired', 1)
            ->first();
        $proposals = Job::find($job->id)->proposals;
        $job_quizzes = Job_quiz::where('job_id', $job->id)->get();
        $order = Job::getProjectOrder($job->id);
        if($order)
        $item = Item::where('type', 'project')->where('product_id', $order->product_id)->get();
        else
        $item = null;
        //dd($item, $order);
        if($accepted_proposal)
        {
            $freelancer_name = Helper::getUserName($accepted_proposal->freelancer_id);
            $completion_time = !empty($accepted_proposal->completion_time) ?
            Helper::getJobDurationList($accepted_proposal->completion_time) : '';
            $profile = User::find($accepted_proposal->freelancer_id)->profile;
            $attachments = !empty($accepted_proposal->attachments) ? unserialize($accepted_proposal->attachments) : '';
            $profile_image = !empty($user_image) ? '/uploads/users/' . $accepted_proposal->freelancer_id . '/' . $user_image : 'images/user-login.png';
            $user_slug = User::find($accepted_proposal->freelancer_id)->slug;
            $feedbacks = Review::select('feedback')->where('receiver_id', $accepted_proposal->freelancer_id)->count();
            $avg_rating = Review::where('receiver_id', $accepted_proposal->freelancer_id)->sum('avg_rating');
            $reviews = Review::where('receiver_id', $accepted_proposal->freelancer_id)->get();
            $user_image = !empty($profile) ? $profile->avater : '';
            $rating  = $avg_rating != 0 ? round($avg_rating/Review::count()) : 0;
            $stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
            $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;

            

            foreach($job_quizzes as $job_quiz)
            {
                $quiz = Quiz::find($job_quiz->quiz_id);
                if(Marks::where('quiz_id', $job_quiz->quiz_id)->where('user_id', $accepted_proposal->freelancer_id)->exists())
                {
                    $marks = Marks::where('quiz_id', $job_quiz->quiz_id)->where('user_id', $accepted_proposal->freelancer_id)->first();
                    
                    $accepted_proposal->quiz_title = $quiz->title;
                    $accepted_proposal->marks = $marks;
                    $accepted_proposal->quiz_ans = 'true';
                }
                else
                {
                    $accepted_proposal->quiz_title = $quiz->title;
                    $accepted_proposal->quiz_ans = 'false';
                }
            }
        }
        else
        {
            $freelancer_name = '';
            $completion_time = '';
            $profile = '';
            $attachments = '';
            $profile_image = '';
            $user_slug = '';
            $feedbacks = '';
            $avg_rating = '';
            $reviews = '';
            $user_image = '';
            $rating  = '';
            $stars  = '';
            $average_rating_count = '';
        }
        
        
        $employer_name = Helper::getUserName($job->user_id);
        $project_status = Helper::getProjectStatus();
        $duration = !empty($job->duration) ? Helper::getJobDurationList($job->duration) : '';
        $review_options = DB::table('review_options')->get()->all();
        
        //providers listed here.

        $providersa = Approver::where('job_id', $job->id)->select('name', 'lname', 'email')->get()->toArray();
        
        $providerst = Team::where('job_id', $job->id)->select('name', 'lname', 'email')->get()->toArray();

        $providers = array();
        $providers['approvers'] = $providersa;
        $providers['team'] = $providerst;
        $invitedf = array();
        if(Freelancerinvite::where('job_id', $job->id)->exists())
        {
            $freelancerinvite = Freelancerinvite::where('job_id', $job->id)->first();
            
            $emails = explode(', ', $freelancerinvite->freelancers);
            // dd($freelancerinvite);                        
            foreach($emails as $key => $email)
            {
                if(User::where('email', $email)->exists())
                {
                    $user = User::where('email', $email)->first();
                    //dd('exists');
                    $invitedf[$key]['name'] = $user->first_name.' '.$user->last_name;
                    $invitedf[$key]['email'] = $email;
                }
            }
        }
        $providers['invited'] = $invitedf;
        //dd($invitedf);
        
        
        $currency   = SiteManagement::getMetaValue('commision');
        $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
        $cancel_proposal_text = trans('lang.cancel_proposal_text');
        $cancel_proposal_button = trans('lang.send_request');
        $validation_error_text = trans('lang.field_required');
        $cancel_popup_title = trans('lang.reason');


        //Approver
        $email = Auth::user()->email;
        if(Approver::where('email', $email)->where('job_id', $job->id)->exists())
        {
            $job->approver = 1;
        }
        else
        {
            $job->approver = 0;
        }
        //dd($job);
        foreach($proposals as $proposal)
        {
            if(Live_contest::where('job_id', $job->id)->exists())
            {
                $live1 = Live_contest::where('job_id', $job->id)->first();

                if(Live_contest_participant::where('live_id', $live1->id)->where('user_id', $proposal->freelancer_id)->exists())
                    $proposal->sent = 'true';
                else
                    $proposal->sent = 'false';
            }
            foreach($job_quizzes as $job_quiz)
            {
                $quiz = Quiz::find($job_quiz->quiz_id);
                if(Marks::where('quiz_id', $job_quiz->quiz_id)->where('user_id', $proposal->freelancer_id)->exists())
                {
                    $marks = Marks::where('quiz_id', $job_quiz->quiz_id)->where('user_id', $proposal->freelancer_id)->first();
                    
                    $proposal->quiz_title = $quiz->title;
                    $proposal->marks = $marks;
                    $proposal->quiz_ans = 'true';
                }
                else
                {
                    $proposal->quiz_title = $quiz->title;
                    $proposal->quiz_ans = 'false';
                }
            }
        }
        if(Live_contest::where('job_id', $job->id)->exists())
        {
            
            $live = Live_contest::where('job_id', $job->id)->first();
            $now =  Carbon::today();
            $end = Carbon::parse($live->end_date);
            $proposals->contest = 'true';
            $result = $now->lt($end); 
            //dd($now, $end, $result);
            if($result)
            {
                //dd($result);
                /*if($live->status == 'open') {
                $participant = Live_contest_participant::where('live_id', $live->id)->get();
                foreach($participant as $value)
                {
                    $user = User::find($value->user_id);
                    Mail::to($user->email)->send(new Contestend($job));
                }

                $live->status = "close";
                $live->save();
                }*/
                $proposals->over = 'true';
            }                
            else
                $proposals->over = 'false';
            $proposals->contestid = $live->id;
        }                
        else
            $proposals->contest = 'false';
        //end
        
        //count of the labels. files, proposals, tasks, tickets, notes
        $job->files = Job_file::where('job_id', $job->id)->get()->count();
        $job->proposals = $proposals->count();
        $job->tasks = Tasks::where('job_id', $job->id)->get()->count();
        $job->tickets = Job_ticket::where('job_id', $job->id)->get()->count();
        $job->notes    = Job_note::where('job_id', $job->id)->get()->count();
        //$count->files = $files;

        //proposals
        $chat = null;

        $payment_settings = SiteManagement::getMetaValue('commision');
        
        $mode = !empty($payment_settings) && !empty($payment_settings[0]['payment_mode']) ? $payment_settings[0]['payment_mode'] : 'true';

        //dd($accepted_proposal);

        
        $search_locations = null;
        $search_employees = null;
        $search_skills = null;
        $search_hourly_rates = null;
        $search_freelaner_types = null;
        $search_english_levels = null;
        $search_languages = null;

        //Providers listing
        $keyword = !empty($_GET['s']) ? $_GET['s'] : '';
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

        if (file_exists(resource_path('views/extend/back-end/employer/proposals/show.blade.php'))) {
            return view(
                'extend.back-end.employer.proposals.show',
                compact(
                    'average_rating_count',
                    'job',
                    'duration',
                    'accepted_proposal',
                    'project_status',
                    'employer_name',
                    'profile_image',
                    'completion_time',
                    'freelancer_name',
                    'attachments',
                    'review_options',
                    'user_slug',
                    'stars',
                    'rating',
                    'feedbacks',
                    'symbol',
                    'cancel_proposal_text',
                    'cancel_proposal_button',
                    'validation_error_text',
                    'proposals',
                    'count',
                    'item',
                    'chat',
                    'providers',
                    'cancel_popup_title',
                    'keyword',
                    'users'
                )
            );
        } else {
            return view(
                'back-end.employer.proposals.show',
                compact(
                    'average_rating_count',
                    'job',
                    'duration',
                    'accepted_proposal',
                    'project_status',
                    'employer_name',
                    'profile_image',
                    'completion_time',
                    'freelancer_name',
                    'attachments',
                    'review_options',
                    'user_slug',
                    'stars',
                    'rating',
                    'feedbacks',
                    'symbol',
                    'cancel_proposal_text',
                    'cancel_proposal_button',
                    'validation_error_text',
                    'proposals',
                    'count',
                    'item',
                    'mode',
                    'chat',
                    'providers',
                    'cancel_popup_title',
                    'keyword',
                    'users'
                )
            );
        }
    }
}
