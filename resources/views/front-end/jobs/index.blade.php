@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@section('title'){{ $job_list_meta_title }} @stop
@section('description', $job_list_meta_desc)
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('searchResults'); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php')))
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.jobs'), 'inner_banner' => $job_inner_banner, 'show_banner' => $show_job_banner]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.jobs'), 'inner_banner' => $job_inner_banner, 'show_banner' => $show_job_banner ]
        )
    @endif        
    @if (Auth::user())
    @php
        $user = !empty(Auth::user()) ? Auth::user() : '';
        $role = !empty($user) ? $user->role : array();
        
    @endphp
    <!--<header id="wt-header1" class="wt-header wt-haslayout wt-headervtwo wt-search-have" style="border-top: 1px #e8e0e0 solid;border-bottom: 1px #e8e0e0 solid;z-index: 10;background-color: #005178">
        <div class="wt-navigationarea">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">  
                        <div class="">
                            <nav id="wt-nav1" class="wt-nav navbar-expand-lg wt-blue-nav">
                                <button type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" style="color: white;border-color: white;margin: 10px;"><i class="lnr lnr-menu"></i></button> 
                                <div id="navbarNav1" class="collapse navbar-collapse wt-navigation" style="float: right;background-color: rgb(0, 81, 120);">
                                    <ul class="navbar-nav"> 
                                        @if ($role === 'employer')  
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.buy') }}<i class="ti-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="{{{ route('employerPostJob') }}}">{{ trans('lang.new_project') }}</a></li>
                                                <li><a href="{{url('search-results?type=service')}}">{{ trans('lang.services') }}</a></li>
                                            </ul>
                                        </li>
                                        @endif 
                                        
                                        @if ($role === 'admin')  
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.project_contest') }}<i class="ti-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="{{{ route('allJobs') }}}">{{ trans('lang.project_contest') }}</a></li>
                                                <li><a href="{{ route('quiz.index') }}">{{ trans('lang.quiz') }}</a></li>
                                            </ul>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.products') }}<i class="ti-angle-down"></i></a>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{{ route('allServices') }}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.services') }}<i class="ti-angle-down"></i></a>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{{ route('userListing') }}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.users') }}</i></a>
                                        </li> 
                                        @endif

                                        @if ($role === 'employer')  
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{{ route('employerManageJobs') }}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.project_contest')}}<i class="ti-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="{{{ route('employerPostJob') }}}">{{ trans('lang.new_project') }}</a></li>
                                                <li><a href="{{ route('employerManageJobs') }}">{{ trans('lang.project_list') }}</a></li>
                                                
                                            </ul>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{{ route('products') }}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.products')}}<i class="ti-angle-down"></i></a>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{{ route('employerServices') }}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.services')}}<i class="ti-angle-down"></i></a>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{url('search-results?type=freelancer')}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.freelancers')}}</i></a>
                                        </li> 
                                        @endif

                                        @if($role === 'freelancer')
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.sell') }}<i class="ti-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="{{{ route('showFreelancerProposals') }}}">{{ trans('lang.proposals') }}</a></li>
                                                <li><a href="{{ route('freelancerPostService') }}">{{ trans('lang.services') }}</a></li>
                                            </ul>
                                        </li>
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{{ route('freelancerJobs') }}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.project_contest') }}<i class="ti-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="{{{ route('freelancerJobs') }}}">{{ trans('lang.project_contest') }}</a></li>
                                                <li><a href="{{ route('freelancerJoblist') }}">{{ trans('lang.project_list') }}</a></li>
                                            </ul>
                                        </li> 

                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="#" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.products_store')}}<i class="ti-angle-down"></i></a>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{url('search-results?type=service')}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.services_store')}}<i class="ti-angle-down"></i></a>
                                        </li> 
                                        @endif
                                        
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.courses')}}</a>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.travel')}}<i class="ti-angle-down"></i></a>
                                        </li> 
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.more')}}</a>
                                        </li> 
                                        
                                    </ul>
                                </div>
                            </nav>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>-->
    @endif
    <div class="wt-haslayout wt-main-section" id="jobs">
        @if (Session::has('payment_message'))
            @php $response = Session::get('payment_message') @endphp
            <div class="flash_msg">
                <flash_messages :message_class="'{{{$response['code']}}}'" :time ='5' :message="'{{{ $response['message'] }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                            @if (file_exists(resource_path('views/extend/front-end/jobs/filters.blade.php'))) 
                                @include('extend.front-end.jobs.filters')
                            @else 
                                @include('front-end.jobs.filters')
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
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
                                            //dd($project_type);
                                        @endphp
                                        <div class="wt-userlistinghold wt-userlistingholdvtwo {{$featured_class}}">
                                            @if ($job->is_featured == 'true')
                                                <span class="wt-featuredtag"><img src="images/featured.png" alt="{{{ trans('ph.is_featured') }}}" data-tipso="Plus Member" class="template-content tipso_style"></span>
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
                                                        @if (!empty($job->duration))
                                                        <li><span><i class="far fa-clock wt-viewjobclock"></i>{{{ Helper::getJobDurationList($job->duration)}}}</span></li>
                                                        @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
