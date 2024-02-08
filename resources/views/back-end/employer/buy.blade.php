@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @if (session()->has('type'))
        @php session()->forget('type'); @endphp
    @endif
    
    <div class="wt-haslayout wt-dbsectionspace">
    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.buy')}}</li>
                            </ol>
                        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-saveitemholder">
                    <div class="wt-dashboardtabs" style="width: 20%;">
                        <ul class="wt-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="active show" data-toggle="tab" href="#wt-buy">{{ trans('lang.buy') }}</a>
                            </li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-project" class="">{{ trans('lang.project_contest') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-product" class="">{{ trans('lang.products') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-services" class="">{{ trans('lang.services') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-freelancer" class="">{{ trans('lang.freelancers') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-talent" class="">{{ trans('lang.talents') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-course" class="">{{ trans('lang.courses') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-travel" class="">{{ trans('lang.travel') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#wt-more" class="">{{ trans('lang.more') }}</a></li>
                        </ul>
                    </div>
                    <div class="wt-tabscontent tab-content tab-savecontent" style="width: 80%;">
                        <div class="wt-personalskillshold tab-pane fade active show" id="wt-buy">
                            <div class="row float-right" style="margin: 20px;">
                                <div class="wt-btnarea"><a href="{{{ url(route('employerPostJob')) }}}" class="wt-btn">{{{ trans('lang.post_job') }}}</a></div>
                            </div>
                            <div class="wt-yourdetails">
                                <div class="wt-dashboradsaveitem">    
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="wt-insightsitemholder">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                        <div class="wt-insightsitem wt-dashboardbox {{$notify_class}}">
                                                            <figure class="wt-userlistingimg">
                                                                {{ Helper::getImages('uploads/settings/icon',$latest_new_message_icon, 'book') }}
                                                            </figure>
                                                            <div class="wt-insightdetails">
                                                                <div class="wt-title">
                                                                    <h3>{{ trans('lang.new_msgs') }}</h3>
                                                                    <a href="{{ url('message-center') }}">{{ trans('lang.click_view') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($access_type == 'jobs' || $access_type== 'both')
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$latest_proposals_icon, 'layers') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{ trans('lang.latest_proposals') }}</h3>
                                                                        <a href="{{{ url('employer/dashboard/manage-jobs') }}}">{{ trans('lang.click_view') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (!empty($enable_package) && $enable_package === 'true')
                                                        @if (!empty($package))
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                                <div class="wt-insightsitem wt-dashboardbox user_current_package">
                                                                    <countdown
                                                                    date="{{$expiry_date}}"
                                                                    :image_url="'{{{ Helper::getDashExpiryImages('uploads/settings/icon',$latest_package_expiry_icon, 'img-21.png') }}}'"
                                                                    :title=trans('lang.check_pkg_expiry')
                                                                    :package_url="'{{url('dashboard/packages/employer')}}'"
                                                                    :current_package="'{{$package->title}}'"
                                                                    >
                                                                    </countdown>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                        <div class="wt-insightsitem wt-dashboardbox">
                                                            <figure class="wt-userlistingimg">
                                                                {{ Helper::getImages('uploads/settings/icon',$latest_saved_item_icon, 'lnr lnr-heart') }}
                                                            </figure>
                                                            <div class="wt-insightdetails">
                                                                <div class="wt-title">
                                                                    <h3>{{ trans('lang.view_saved_items') }}</h3>
                                                                    <a href="{{ url('employer/saved-items') }}">{{ trans('lang.click_view') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($access_type == 'jobs' || $access_type== 'both')
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$latest_cancel_job_icon, 'cross-circle') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{Helper::getTotalJobs('cancelled')}}</h3>
                                                                        <span>{{ trans('lang.total_cancelled_jobs') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$latest_ongoing_job_icon, 'cloud-sync') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{Helper::getTotalJobs('hired')}}</h3>
                                                                        <span>{{ trans('lang.total_ongoing_jobs') }}</span>
                                                                        <a href="{{{ url('employer/jobs/hired') }}}">{{ trans('lang.click_view') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$latest_completed_job_icon, 'checkmark-circle') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{Helper::getTotalJobs('completed')}}</h3>
                                                                        <span>{{ trans('lang.total_completed_jobs') }}</span>
                                                                        <a href="{{{ url('employer/jobs/completed') }}}">{{ trans('lang.click_view') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$latest_posted_job_icon, 'enter') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{Helper::getTotalJobs('posted')}}</h3>
                                                                        <span>{{ trans('lang.total_posted_jobs') }}</span>
                                                                        <a href="{{{ route('employerManageJobs') }}}">{{ trans('lang.click_view') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($access_type == 'services' || $access_type== 'both')
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$ongoing_services_icon, 'gift') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{{ Auth::user()->purchasedServices->count() }}}</h3>
                                                                        <span>{{ trans('lang.total_ongoing_services') }}</span>
                                                                        <a href="{{{ url('employer/services/hired') }}}">{{ trans('lang.click_view') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$completed_services_icon, 'gift') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{{ Auth::user()->completedServices->count() }}}</h3>
                                                                        <span>{{ trans('lang.total_completed_services') }}</span>
                                                                        <a href="{{{ url('employer/services/completed') }}}">{{ trans('lang.click_view') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="wt-insightsitem wt-dashboardbox">
                                                                <figure class="wt-userlistingimg">
                                                                    {{ Helper::getImages('uploads/settings/icon',$cancelled_services_icon, 'gift') }}
                                                                </figure>
                                                                <div class="wt-insightdetails">
                                                                    <div class="wt-title">
                                                                        <h3>{{{ Auth::user()->cancelledServices->count() }}}</h3>
                                                                        <span>{{ trans('lang.total_cancelled_services') }}</span>
                                                                        <a href="{{{ url('employer/services/cancelled') }}}">{{ trans('lang.click_view') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    @if ($access_type == 'jobs' || $access_type== 'both')
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="wt-dashboardbox wt-ongoingproject la-ongoing-projects wt-earningsholder">
                                                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                                                        <h2>{{ trans('lang.ongoing_project') }}</h2>
                                                    </div>
                                                    @if (!empty($ongoing_jobs) && $ongoing_jobs->count() > 0)
                                                        <div class="wt-dashboardboxcontent wt-hiredfreelance">
                                                            <table class="wt-tablecategories wt-freelancer-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{trans('lang.project_title')}}</th>
                                                                        <th>{{trans('lang.hired_freelancers')}}</th>
                                                                        <th>{{trans('lang.project_cost')}}</th>
                                                                        <th>{{trans('lang.actions')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($ongoing_jobs as $project)
                                                                        @php
                                                                            $proposal_freelancer = $project->proposals->where('status', 'hired')->pluck('provider_id')->first();
                                                                            $freelancer = !empty($proposal_freelancer) ? \App\User::find($proposal_freelancer) : ''; 
                                                                            $user_name = Helper::getUsername($proposal_freelancer);
                                                                        @endphp
                                                                        <tr>
                                                                            <td data-th="Project title"><span class="bt-content"><a target="_blank" href="{{{ url('job/'.$project->slug) }}}">{{{ $project->title }}}</a></span></td>
                                                                            @if (!empty($freelancer))
                                                                                <td data-th="Hired freelancer">
                                                                                    <span class="bt-content">
                                                                                        <a href="{{{url('profile/'.$freelancer->slug)}}}">
                                                                                            @if ($freelancer->user_verified)
                                                                                                <i class="fa fa-check-circle"></i>&nbsp;
                                                                                            @endif
                                                                                            {{{$user_name}}}
                                                                                        </a>
                                                                                    </span>
                                                                                </td>
                                                                            @endif
                                                                            <td data-th="Project cost"><span class="bt-content">{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{$project->price}}</span></td>
                                                                            <td data-th="Actions">
                                                                                <span class="bt-content">
                                                                                    <div class="wt-btnarea">
                                                                                        <a href="{{{ url('employer/dashboard/job/'.$project->slug.'/proposals') }}}" class="wt-btn">{{ trans('lang.view_detail') }}</a>
                                                                                    </div>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @else
                                                        @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                            @include('extend.errors.no-record')
                                                        @else 
                                                            @include('errors.no-record')
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif                                                            
                                </div>										
                            </div>
                        </div>
                        <div class="wt-educationholder tab-pane fade" id="wt-project">
                            <div class="wt-userexperience wt-followcompomy">
                                <div class="wt-focomponylist">  
                                    <div class="row" style="margin: 20px;">
                                        <div class="wt-btnarea "><a href="{{{ url(route('employerPostJob')) }}}" class="wt-btn float-right">{{{ trans('lang.post_job') }}}</a>
                                        </div>
                                    </div>
                                    
                                    <link rel="stylesheet" href="{{ asset('css/bootstrap1.min.css') }}">
                                    <style>
		@media (min-width: 992px)
		{
			
		.navbar-collapse.collapse {
			display: block!important;
			height: auto!important;
			padding-bottom: 0;
			overflow: visible!important;
		}
		}
	
                                        .btn {
                                            background-color: #ffffff;
                                            color: #b4b1b1;
                                            font-size: 16px;
                                            border: 1px solid #b4b1b1;
                                            outline: none;
                                            border-radius: 0;
                                        }

                                        .dropdown {
                                        position: absolute;
                                        display: inline-block;
                                        }

                                        .dropdown-content {
                                        display: none;
                                        position: absolute;
                                        background-color: #f1f1f1;
                                        min-width: 160px;
                                        z-index: 1;
                                        }

                                        .dropdown-content a {
                                        color: black;
                                        padding: 12px 16px;
                                        text-decoration: none;
                                        display: block;
                                        }

                                        .dropdown-content a:hover {background-color: #ddd}

                                        .dropdown:hover .dropdown-content {
                                        display: block;
                                        }

                                        .btn:hover, .dropdown:hover .btn {
                                        background-color: #b4b1b1;
                                        color:white;
                                        }
                                        </style>
                                    <div class="row" style="margin-top:30px;">
                                        <ul class="nav nav-tabs" style="width: 100%;">
                                            <!--<li><a data-toggle="tab" href="#home">Draft <span class="badge bg-danger">{{ $job_details->count() }}</span></a></li>-->
                                            <li class="active"><a data-toggle="tab" href="#menu1">{{ trans('lang.open') }} <span class="badge bg-danger">{{ $job_details->count() }}</span></a></li>
                                            <!--<li><a data-toggle="tab" href="#menu2">{{ trans('lang.paused') }} <span class="badge bg-danger"></span></a></li>-->
                                            <li><a data-toggle="tab" href="#menu3">{{ trans('lang.work_in_progress') }} <span class="badge bg-danger">{{ $ongoing_jobs->count() }}</span></a></li>
                                            <li><a data-toggle="tab" href="#menu4">{{ trans('lang.past') }} <span class="badge bg-danger">{{ $completed_jobs->count() }}</span></a> </li>
                                        </ul>

                                        <div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e2dbd1 1px solid">
                                                                                        <div id="menu1" class="tab-pane fade in active">
                                            <table class="wt-tablecategories">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            ID
                                                        </th>
                                                        
                                                        <th>{{ trans('lang.project_name') }}</th>
                                                        <th>{{ trans('lang.proposals') }}</th>
                                                        <th>{{ trans('lang.type') }}</th>
                                                        <th>{{ trans('lang.average_bid') }}</th>
                                                        <th>{{ trans('lang.budget') }}</th>
                                                        <!--<th>Bid End Date</th>-->
                                                        <th>{{ trans('lang.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (!empty($job_details) && $job_details->count() > 0)
                                                    @foreach ($job_details as $job)
                                                    @php
                                                        $image = '';
                                                        $duration  =  \App\Helper::getJobDurationList($job->duration);
                                                        $user_name = $job->employer->first_name.' '.$job->employer->last_name;
                                                        $proposals = \App\Proposal::where('job_id', $job->id)->where('status', '!=', 'cancelled')->get();
                                                        if($proposals->count() > 0)
                                                        {
                                                            $total = 0;
                                                            foreach($proposals as $proposal)
                                                            {
                                                                $total += $proposal->amount;
                                                            }
                                                            $avg = $total/$proposals->count();
                                                        }
                                                        
                                                        $employer_img = \App\Profile::select('avater')->where('user_id', $job->employer->id)->first();
                                                        $image = !empty($employer_img->avater) ? '/uploads/users/'.$job->employer->id.'/'.$employer_img->avater : '';
                                                        $verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
                                                        $project_type  = Helper::getProjectTypeList($job->project_type);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                        {{{ $job->id }}}	
                                                        </td>								
                                                        <td data-th="Name"><span class="bt-content"><a href="{{{ url('employer/dashboard/job/'.$job->slug.'/proposals') }}}">{{{ $job->title }}}</a></span></td>
                                                        <td data-th="Name"><span class="bt-content" style="display: flex;">
                                                        <h4>{{{ $proposals->count() }}}</h4>
                                                            @if ($proposals->count() > 0)
                                                                <ul class="wt-hireduserimgs">
                                                                    @foreach ($proposals as $proposal)
                                                                        @php
                                                                            $profile = \App\User::find($proposal->provider_id)->profile;
                                                                            $user_image = !empty($profile) ? $profile->avater : '';
                                                                            $profile_image = !empty($user_image) ? '/uploads/users/'.$proposal->provider_id.'/'.$user_image : 'images/user-login.png';
                                                                        @endphp
                                                                        <li><figure><img src="{{{ asset($profile_image) }}}" alt="{{ trans('lang.profile_img') }}" class="mCS_img_loaded"></figure></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                            @if (!empty($job->project_type))
                                                            <a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
                                                            @endif
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        @if ($proposals->count() > 0)
                                                            @if (!empty($job->price))
                                                                <span class="wt-dashboraddoller"><i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i> {{{ $avg }}}</span>
                                                            @endif
                                                        @else
                                                            No bid yet
                                                        @endif

                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        @if (!empty($job->price))
                                                            <span class="wt-dashboraddoller"><i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i> {{{ $job->price }}}</span>
                                                        @endif
                                                        </span></td>
                                                        <!--<td data-th="Slug"><span class="bt-content">{{{ $job->status }}}</span></td>-->
                                                        <td data-th="Action"><span class="bt-content">
                                                            <div class="">
                                                                <!--@if ($proposals->count() > 0)
                                                                    <a href="{{{ url('employer/dashboard/job/'.$job->slug.'/proposals') }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
                                                                @endif
                                                                <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
                                                                <a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
                                                                <a href="#"><button class="btn">{{ trans('lang.edit') }}</button></a>
                                                                <div class="dropdown">
                                                                    <button class="btn" style="border-left:1px solid #b4b1b1">
                                                                        <i class="fa fa-caret-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-content">
                                                                        @if ($proposals->count() > 0)
                                                                            <a href="{{{ url('employer/dashboard/job/'.$job->slug.'/proposals') }}}" >{{ trans('lang.view') }}</a>
                                                                        @endif
                                                                        <a href="#">{{ trans('lang.delete') }}</a>											
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                        @include('extend.errors.no-record')
                                                    @else 
                                                        @include('errors.no-record')
                                                    @endif
                                                @endif
                                                </tbody>
                                            </table>
                                            </div>
                                            <div id="menu2" class="tab-pane fade">
                                            <!-- Paused table here -->
                                            </div>
                                            <div id="menu3" class="tab-pane fade">
                                            <table class="wt-tablecategories">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            ID
                                                        </th>
                                                        
                                                        <th>{{ trans('lang.project_name') }}</th>
                                                        <th>{{ trans('lang.awarded_to') }}</th>
                                                        <th>{{ trans('lang.type') }}</th>
                                                        <th>{{ trans('lang.awarded_bid') }}</th>
                                                        <th>{{ trans('lang.released_milestones') }}</th>
                                                        <th>{{ trans('lang.deadline') }}</th>
                                                        <th>{{ trans('lang.progress') }}</th>
                                                        <th>{{ trans('lang.status') }}</th>
                                                        <th>{{ trans('lang.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (!empty($ongoing_jobs) && $ongoing_jobs->count() > 0)
                                                    @foreach ($ongoing_jobs as $job)
                                                    @php
                                                        $accepted_proposal = array();
                                                        $duration  =  \App\Helper::getJobDurationList($job->duration);
                                                        $user_name = $job->employer->first_name.' '.$job->employer->last_name;
                                                        $accepted_proposal = \App\Job::find($job->id)->proposals()->where('status', 'hired')->first();
                                                        $freelancer_name = \App\Helper::getUserName($accepted_proposal->provider_id);
                                                        $profile = \App\User::find($accepted_proposal->provider_id)->profile;
                                                        $user_image = !empty($profile) ? $profile->avater : '';
                                                        $profile_image = !empty($user_image) ? '/uploads/users/'.$accepted_proposal->provider_id.'/'.$user_image : 'images/user-login.png';
                                                        $verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
                                                        $project_type  = Helper::getProjectTypeList($job->project_type);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                        {{{ $job->id }}}	
                                                        </td>								
                                                        <td data-th="Name"><span class="bt-content"><a href="{{{  url('proposal/'.$job->slug.'/'.$job->status) }}}">{{{ $job->title }}}</a></span></td>
                                                        <td data-th="Name"><span class="bt-content" style="display: flex;">
                                                            <span>{{{ Helper::getUserName($accepted_proposal->provider_id) }}}</span>
                                                            <ul class="wt-hireduserimgs">
                                                                <li><figure><img src="{{{ asset(Helper::getProjectImage($user_image, $accepted_proposal->provider_id)) }}}" alt="{{{ trans('lang.freelancer') }}}"></figure></li>
                                                            </ul>
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                            @if (!empty($job->project_type))
                                                            <a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
                                                            @endif
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        {{ $accepted_proposal->amount  }}
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        {{ trans('lang.released_milestones') }}
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                            @if($job->delivery_type == 'date') 
                                                            @php 
                                                                $expiry = date('d-m-Y', strtotime($job->expiry_date));
                                                            @endphp
                                                            {{$expiry}}
                                                            @elseif($job->delivery_type == 'time') 
                                                            {{ trans('lang.month') }} : {{ $job->month }} <br> {{ trans('lang.week') }} : {{ $job->week }} <br>{{ trans('lang.day') }} : {{ $job->day }} <br>{{ trans('lang.hour') }} : {{ $job->hour }} 
                                                            @endif
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        {{ trans('lang.progress') }}
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                            {{$job->status}}
                                                        </span></td>
                                                        <td data-th="Action"><span class="bt-content">
                                                            <div class="">
                                                                <!--<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
                                                                <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
                                                                <a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
                                                                <a href="#"><button class="btn">{{ trans('lang.edit') }}</button></a>
                                                                <div class="dropdown">
                                                                    <button class="btn" style="border-left:1px solid #b4b1b1">
                                                                        <i class="fa fa-caret-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-content">
                                                                        <a href="{{{  url('proposal/'.$job->slug.'/'.$job->status) }}}" >{{ trans('lang.view') }}</a>
                                                                        <a href="#">{{ trans('lang.delete') }}</a>											
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                        @include('extend.errors.no-record')
                                                    @else 
                                                        @include('errors.no-record')
                                                    @endif
                                                @endif
                                                </tbody>
                                            </table>
                                            </div>
                                            <div id="menu4" class="tab-pane fade">
                                            <table class="wt-tablecategories">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            ID
                                                        </th>
                                                        
                                                        <th>{{ trans('lang.project_name') }}</th>
                                                        <th>{{ trans('lang.awarded_to') }}</th>
                                                        <th>{{ trans('lang.type') }}</th>
                                                        <th>{{ trans('lang.awarded_bid') }}</th>
                                                        <th>{{ trans('lang.released_milestones') }}</th>
                                                        <th>{{ trans('lang.finished_on') }}</th>
                                                        <th>{{ trans('lang.experience') }}</th>
                                                        <th>{{ trans('lang.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (!empty($completed_jobs) && $completed_jobs->count() > 0)
                                                    @foreach ($completed_jobs as $job)
                                                    @php
                                                        $accepted_proposal = \App\Job::find($job->id)->proposals()->where('status', 'completed')->first();
                                                        $profile = \App\User::find($accepted_proposal->provider_id)->profile;
                                                        $user_image = !empty($profile) ? $profile->avater : '';
                                                        $verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
                                                        $project_type  = Helper::getProjectTypeList($job->project_type);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                        {{{ $job->id }}}	
                                                        </td>								
                                                        <td data-th="Name"><span class="bt-content"><a href="{{{  url('proposal/'.$job->slug.'/'.$job->status) }}}">{{{ $job->title }}}</a></span></td>
                                                        <td data-th="Name"><span class="bt-content" style="display: flex;">
                                                            <span>{{{ Helper::getUserName($accepted_proposal->provider_id) }}}</span>
                                                            <ul class="wt-hireduserimgs">
                                                                <li><figure><img src="{{{ asset(Helper::getProjectImage($user_image, $accepted_proposal->provider_id)) }}}" alt="{{{ trans('lang.freelancer') }}}"></figure></li>
                                                            </ul>
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                            @if (!empty($job->project_type))
                                                            <a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
                                                            @endif
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        {{ $accepted_proposal->amount  }}
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        {{ trans('lang.released_milestones') }}
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                        {{ trans('lang.finished_on') }}
                                                        </span></td>
                                                        <td data-th="Slug"><span class="bt-content">
                                                            <span class="badge badge-secondary">4.9</span> <i class="fas fa-star"></i>
                                                        </span></td>
                                                        <td data-th="Action"><span class="bt-content">
                                                            <div class="">
                                                                <!--<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
                                                                <a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
                                                                <a href="#"><button class="btn">{{ trans('lang.edit') }}</button></a>
                                                                <div class="dropdown">
                                                                    <button class="btn" style="border-left:1px solid #b4b1b1">
                                                                        <i class="fa fa-caret-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-content">												
                                                                        <a href="#">{{ trans('lang.delete') }}</a>											
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                        @include('extend.errors.no-record')
                                                    @else 
                                                        @include('errors.no-record')
                                                    @endif
                                                @endif
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Project -->
                                </div>											
                            </div>
                        </div>
                        <div class="wt-awardsholder tab-pane fade" id="wt-product">
                            <div class="wt-addprojectsholder wt-likefreelan">
                                <div class="wt-likedfreelancers wt-haslayout">
                                    <!--products -->
                                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                                        <h2>{{ trans('lang.all_categories') }}</h2>
                                    </div>
                                    <div class="wt-dashboardbox wt-dashboardtabsholder wt-saveitemholder">
                                        <div class="wt-dashboardtabs">
                                            <ul class="wt-tabstitle nav navbar-nav">
                                                @foreach($categories as $category)
                                                <li class="nav-item">
                                                    <a class="" data-toggle="tab" href="#wt-{{ $category->slug }}">{{ $category->title }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="wt-tabscontent tab-content tab-savecontent">
                                            @foreach($categories as $category)
                                            <div class="wt-personalskillshold tab-pane fade " id="wt-{{ $category->slug }}" style="overflow-x: scroll;">
                                                <div class="wt-yourdetails" style="width: 1140px;">
                                                    <div class="wt-dashboradsaveitem">
                                                        <!-- Jobs started -->
                                                        @php
                                                            $jobs = $category->jobs;
                                                        @endphp
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-left">
                                                            <div class="wt-userlistingholder wt-haslayout">
                                                                @if (!empty($keyword))
                                                                    <div class="wt-userlistingtitle">
                                                                        <span>{{ trans('lang.01') }} {{$jobs->count()}} of {{$Jobs_total_records}} results for <em>"{{{$keyword}}}"</em></span>
                                                                    </div>
                                                                @endif
                                                                @if (!empty($jobs) && $jobs->count() > 0)
                                                                    @foreach ($jobs as $job)
                                                                        @php
                                                                            $job = \App\Job::find($job->id);
                                                                            //$description = strip_tags(stripslashes($job->description));
                                                                            $description = strip_tags(stripslashes($job->description));
                                                                            $featured_class = $job->is_featured == 'true' ? 'wt-featured' : '';
                                                                            $user = Auth::user() ? \App\User::find(Auth::user()->id) : '';
                                                                            $project_type  = Helper::getProjectTypeList($job->project_type);
                                                                        @endphp
                                                                        <div class="wt-userlistinghold wt-userlistingholdvtwo {{$featured_class}}">
                                                                            @if ($job->is_featured == 'true')
                                                                                <span class="wt-featuredtag"><img src="{{ asset('images/featured.png') }}" alt="{{{ trans('ph.is_featured') }}}" data-tipso="Plus Member" class="template-content tipso_style"></span>
                                                                            @endif
                                                                            <div class="wt-userlistingcontent">
                                                                                <div class="wt-contenthead">
                                                                                    <div class="wt-title">
                                                                                        @if (!empty($job->employer->slug))
                                                                                            <a href="{{ url('profile/'.$job->employer->slug) }}"><i class="fa fa-check-circle"></i> {{{ Helper::getUserName($job->employer->id) }}}</a>
                                                                                        @endif
                                                                                        <h2><a href="{{ url('job/'.$job->slug) }}">{{{$job->title}}}</a></h2>
                                                                                    </div>
                                                                                    <div class="wt-description">
                                                                                        <p>{{ str_limit(html_entity_decode($description), 200) }}</p>
                                                                                    </div>
                                                                                    @if (!empty($job->skills))
                                                                                        <div class="wt-tag wt-widgettag">
                                                                                            @foreach ($job->skills as $skill )
                                                                                                <a href="{{{url('search-results?type=job&skills%5B%5D='.$skill->slug)}}}">{{$skill->title}}</a>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="wt-viewjobholder">
                                                                                    <ul>
                                                                                        @if (!empty($job->project_level))
                                                                                            <li><span><i class="fa fa-dollar-sign wt-viewjobdollar"></i>{{{Helper::getProjectLevel($job->project_level)}}}</span></li>
                                                                                        @endif
                                                                                        @if (!empty($job->location->title))
                                                                                            <li><span><img src="{{{asset(Helper::getLocationFlag($job->location->flag))}}}" alt="{{{ trans('lang.location') }}}"> {{{ $job->location->title }}}</span></li>
                                                                                        @endif
                                                                                        <li><span><i class="far fa-folder wt-viewjobfolder"></i>{{{ trans('lang.type') }}} {{{$project_type}}}</span></li>
                                                                                        <li><span><i class="far fa-clock wt-viewjobclock"></i>{{{ Helper::getJobDurationList($job->duration)}}}</span></li>
                                                                                        <li><span><i class="fa fa-tag wt-viewjobtag"></i>{{{ trans('lang.job_id') }}} {{{$job->code}}}</span></li>
                                                                                        @if (!empty($user->profile->saved_jobs) && in_array($job->id, unserialize($user->profile->saved_jobs)))
                                                                                            <!--<li style=pointer-events:none;><a href="javascript:void(0);" class="wt-clicklike wt-clicksave"><i class="fa fa-heart"></i> {{trans("lang.saved")}}</a></li>-->
                                                                                        @else
                                                                                            <!--<li>
                                                                                                <a href="javascrip:void(0);" class="wt-clicklike" id="job-{{$job->id}}" @click.prevent="add_wishlist('job-{{$job->id}}', {{$job->id}}, 'saved_jobs', '{{trans("lang.saved")}}')" v-cloak>
                                                                                                    <i class="fa fa-heart"></i>
                                                                                                    <span class="save_text">{{ trans('lang.click_to_save') }}</span>
                                                                                                </a>
                                                                                            </li>-->
                                                                                        @endif
                                                                                        <li class="wt-btnarea"><a href="{{url('job/'.$job->slug)}}" class="wt-btn">{{{ trans('lang.view_job') }}}</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    @if ( method_exists($jobs,'links') )
                                                                        {{ $jobs->links('pagination.custom') }}
                                                                    @endif
                                                                @else
                                                                    @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                                        @include('extend.errors.no-record')
                                                                    @else 
                                                                        @include('errors.no-record')
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- Jobs ended -->
                                                    </div>										
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                    <!--end Products -->
                                </div>
                            </div>
                        </div>
                        <div class="wt-awardsholder tab-pane fade" id="wt-services">
                            <div class="wt-addprojectsholder wt-likefreelan">
                                <div class="wt-likedfreelancers wt-haslayout">
                                    <!-- services -->
                                    <!--<link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">-->
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left">
                                        <div class="row">
                                            <div class="wt-freelancers-holder la-freelancers-grid wt-service-listing-holder">
                                                @if (!empty($keyword))
                                                    <div class="wt-userlistingtitle">
                                                        <span>{{ trans('lang.01') }} {{$services->count()}} of {{$services_total_records}} results for <em>"{{{$keyword}}}"</em></span>
                                                    </div>
                                                @endif
                                                @if (!empty($services) && $services->count() > 0)
                                                    @foreach ($services as $service)
                                                        @php 
                                                            $service_reviews = $service->seller->count() > 0 ? Helper::getServiceReviews($service->seller[0]->id, $service->id) : ''; 
                                                            $service_rating=0;
                                                            if(!empty($service_reviews)) {
                                                                $service_rating = $service_reviews->sum('avg_rating') != 0 ? round($service_reviews->sum('avg_rating') / $service_reviews->count()) : 0;
                                                            }
                                                            $attachments = Helper::getUnserializeData($service->attachments);
                                                            $no_attachments = empty($attachments) ? 'la-service-info' : '';
                                                            $enable_slider = !empty($attachments) ? 'wt-servicesslider' : '';
                                                            $total_orders = Helper::getServiceCount($service->id, 'hired');
                                                        @endphp
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
                                                            <div class="wt-freelancers-info {{$no_attachments}}">
                                                                @if ($service->seller->count() > 0)
                                                                    @if (!empty($attachments))
                                                                        @php $enable_slider = count($attachments) > 1 ? 'wt-freelancerslider owl-carousel' : ''; @endphp
                                                                        <div class="wt-freelancers {{{$enable_slider}}}">
                                                                            @foreach ($attachments as $attachment)
                                                                                <figure class="item">
                                                                                    <a href="{{{ url('profile/'.$service->seller[0]->slug) }}}"><img src="{{{asset(Helper::getImage('uploads/services/'.$service->seller[0]->id, $attachment, 'medium-', 'medium-service.jpg'))}}}" alt="img description" class="item"></a>
                                                                                </figure>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                @if ($service->is_featured == 'true')
                                                                    <span class="wt-featuredtagvtwo">{{ trans('lang.featured') }}</span>
                                                                @endif
                                                                <div class="wt-freelancers-details">
                                                                    @if ($service->seller->count() > 0)
                                                                        <figure class="wt-freelancers-img">
                                                                            <img src="{{ asset(Helper::getProfileImage($service->seller[0]->id)) }}" alt="img description">
                                                                        </figure>
                                                                    @endif
                                                                    <div class="wt-freelancers-content">
                                                                        <div class="dc-title">
                                                                            @if ($service->seller->count() > 0)
                                                                                <a href="{{{ url('profile/'.$service->seller[0]->slug) }}}"><i class="fa fa-check-circle"></i> {{{Helper::getUserName($service->seller[0]->id)}}}</a>
                                                                            @endif
                                                                            <a href="{{{url('service/'.$service->slug)}}}"><h3>{{{$service->title}}}</h3></a>
                                                                            <span><strong>{{ (!empty($symbol['symbol'])) ? $symbol['symbol'] : '$' }}{{{$service->price}}}</strong> {{trans('lang.starting_from')}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="wt-freelancers-rating">
                                                                        <ul>
                                                                            <li><span><i class="fa fa-star"></i>{{{ $service_rating }}}/<i>5</i> ({{{!empty($service_reviews) ? $service_reviews->count() : ''}}})</span></li>
                                                                            <li>
                                                                                @if ($total_orders > 0)
                                                                                    <i class="fa fa-spinner fa-spin"></i>
                                                                                @endif
                                                                                {{{$total_orders}}} {{ trans('lang.in_queue') }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if ( method_exists($services,'links') )
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
                                                            {{ $services->links('pagination.custom') }}
                                                        </div>
                                                    @endif
                                                @else
                                                    @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                        @include('extend.errors.no-record')
                                                    @else 
                                                        @include('errors.no-record')
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end services -->
                                </div>
                            </div>
                        </div>
                        <div class="wt-awardsholder tab-pane fade" id="wt-freelancer">
                            <div class="wt-addprojectsholder wt-likefreelan">
                                <div class="wt-likedfreelancers wt-haslayout">
                                    <!--start Freelancer -->
                                    <div class="wt-userlistingholder wt-userlisting wt-haslayout">
                                        <div class="wt-userlistingtitle">
                                            @if (!empty($users))
                                                <span>{{ trans('lang.01') }} {{$users->count()}} of {{\App\User::role('provider')->count()}} results @if (!empty($keyword)) for <em>"{{{$keyword}}}"</em> @endif</span>
                                            @endif
                                        </div>
                                        @if (!empty($users))
                                            @foreach ($users as $key => $freelancer)
                                                @php
                                                    $user_image = !empty($freelancer->profile->avater) ?
                                                                    '/uploads/users/'.$freelancer->id.'/'.$freelancer->profile->avater :
                                                                    'images/user.jpg';
                                                    $flag = !empty($freelancer->location->flag) ? Helper::getLocationFlag($freelancer->location->flag) :
                                                            '/images/img-01.png';
                                                    $feedbacks = \App\Review::select('feedback')->where('receiver_id', $freelancer->id)->count();
                                                    $avg_rating = App\Review::where('receiver_id', $freelancer->id)->sum('avg_rating');
                                                    $rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                                                    $reviews = \App\Review::where('receiver_id', $freelancer->id)->get();
                                                    $stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                                                    $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                                                    $verified_user = \App\User::select('user_verified')->where('id', $freelancer->id)->pluck('user_verified')->first();
                                                    $save_freelancer = !empty(auth()->user()->profile->saved_freelancer) ? unserialize(auth()->user()->profile->saved_freelancer) : array();
                                                    $badge = Helper::getUserBadge($freelancer->id);
                                                    if (!empty($enable_package) && $enable_package === 'true') {
                                                        $feature_class = (!empty($badge) && $freelancer->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                                                        $badge_color = !empty($badge) ? $badge->color : '';
                                                        $badge_img  = !empty($badge) ? $badge->image : '';
                                                    } else {
                                                        $feature_class = 'wt-exp';
                                                        $badge_color = '';
                                                        $badge_img    = '';
                                                    }
                                                @endphp
                                                <div class="wt-userlistinghold {{ $feature_class }}">
                                                    @if(!empty($enable_package) && $enable_package === 'true')
                                                        @if ($freelancer->expiry_date >= $current_date && !empty($freelancer->badge_id))
                                                            <span class="wt-featuredtag" style="border-top: 40px solid {{ $badge_color }};">
                                                                @if (!empty($badge_img))
                                                                    <img src="{{{ asset(Helper::getBadgeImage($badge_img)) }}}" alt="{{ trans('lang.is_featured') }}" data-tipso="Plus Member" class="template-content tipso_style">
                                                                @else
                                                                    <i class="wt-expired fas fa-bold"></i>
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @endif
                                                    <figure class="wt-userlistingimg">
                                                        <img src="{{{ asset(Helper::getImageWithSize('uploads/users/'.$freelancer->id, $freelancer->profile->avater, 'listing')) }}}" alt="{{ trans('lang.img') }}">
                                                    </figure>
                                                    <div class="wt-userlistingcontent">
                                                        <div class="wt-contenthead">
                                                            <div class="wt-title">
                                                                <a href="{{{ url('profile/'.$freelancer->slug) }}}">
                                                                    @if ($verified_user == 1)
                                                                        <i class="fa fa-check-circle"></i>
                                                                    @endif
                                                                    {{{ Helper::getUserName($freelancer->id) }}}
                                                                </a>
                                                                @if (!empty($freelancer->profile->tagline))
                                                                    <h2><a href="{{{ url('profile/'.$freelancer->slug) }}}">{{{ $freelancer->profile->tagline }}}</a></h2>
                                                                @endif
                                                            </div>
                                                            <ul class="wt-userlisting-breadcrumb">
                                                                @if (!empty($freelancer->profile->hourly_rate))
                                                                    <li><span><i class="far fa-money-bill-alt"></i>
                                                                        {{ (!empty($symbol['symbol'])) ? $symbol['symbol'] : '$' }}{{{ $freelancer->profile->hourly_rate }}} {{ trans('lang.per_hour') }}</span>
                                                                    </li>
                                                                @endif
                                                                @if (!empty($freelancer->location))
                                                                    <li><span><img src="{{{ asset($flag)}}}" alt="Flag"> {{{ !empty($freelancer->location->title) ? $freelancer->location->title : '' }}}</span></li>
                                                                @endif
                                                                @if (in_array($freelancer->id, $save_freelancer))
                                                                    <!--<li class="wt-btndisbaled">
                                                                        <a href="javascrip:void(0);" class="wt-clicksave wt-clicksave">
                                                                            <i class="fa fa-heart"></i>
                                                                            {{ trans('lang.saved') }}
                                                                        </a>
                                                                    </li>-->
                                                                @else
                                                                    <!--<li v-cloak>
                                                                        <a href="javascrip:void(0);" class="wt-clicklike" id="freelancer-{{$freelancer->id}}" @click.prevent="add_wishlist('freelancer-{{$freelancer->id}}', {{$freelancer->id}}, 'saved_freelancer', '{{trans("lang.saved")}}')">
                                                                            <i class="fa fa-heart"></i>
                                                                            <span class="save_text">{{ trans('lang.click_to_save') }}</span>
                                                                        </a>
                                                                    </li>-->
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="wt-rightarea">
                                                            <span class="wt-stars"><span style="width: {{ $stars }}%;"></span></span>
                                                            <span class="wt-starcontent">
                                                                {{{ round($average_rating_count) }}}<sub>{{ trans('lang.5') }}</sub> <em>({{{ $feedbacks }}} {{ trans('lang.feedbacks') }})</em>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @if (!empty($freelancer->profile->description))
                                                        <div class="wt-description">
                                                            <p>{!! html_entity_decode(nl2br(e(str_limit($freelancer->profile->description, 180)))) !!}</p>
                                                        </div>
                                                    @endif
                                                    @if (!empty($freelancer->skills))
                                                        <div class="wt-tag wt-widgettag">
                                                            @foreach($freelancer->skills as $skill)
                                                                <a href="{{{url('search-results?type=job&skills%5B%5D='.$skill->slug)}}}">{{{ $skill->title }}}</a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                            @if ( method_exists($users,'links') )
                                                {{ $users->links('pagination.custom') }}
                                            @endif
                                        @else
                                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                @include('extend.errors.no-record')
                                            @else 
                                                @include('errors.no-record')
                                            @endif
                                        @endif
                                    </div>
                                    <!--end freelancer -->
                                </div>
                            </div>
                        </div>
                        <div class="wt-awardsholder tab-pane fade" id="wt-talent">
                            <div class="wt-addprojectsholder wt-likefreelan">
                                <div class="wt-likedfreelancers wt-haslayout">
                                </div>
                            </div>
                        </div>
                        <div class="wt-awardsholder tab-pane fade" id="wt-course">
                            <div class="wt-addprojectsholder wt-likefreelan">
                                <div class="wt-likedfreelancers wt-haslayout">
                                </div>
                            </div>
                        </div>
                        <div class="wt-awardsholder tab-pane fade" id="wt-travel">
                            <div class="wt-addprojectsholder wt-likefreelan">
                                <div class="wt-likedfreelancers wt-haslayout">
                                </div>
                            </div>
                        </div>
                        <div class="wt-awardsholder tab-pane fade" id="wt-more">
                            <div class="wt-addprojectsholder wt-likefreelan">
                                <div class="wt-likedfreelancers wt-haslayout">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script>
        var _wt_freelancerslider = jQuery('.wt-freelancerslider')
        _wt_freelancerslider.owlCarousel({
            items: 1,
            loop:true,
            rtl:true,
            nav:true,
            margin: 0,
            autoplay:false,
            navClass: ['wt-prev', 'wt-next'],
            navContainerClass: 'wt-search-slider-nav',
            navText: ['<span class="lnr lnr-chevron-left"></span>', '<span class="lnr lnr-chevron-right"></span>'],
        });
    </script>
@endpush