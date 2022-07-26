@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @if (session()->has('type'))
        @php session()->forget('type'); @endphp
    @endif
    
    <div class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-saveitemholder">
                    
                    
                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        <h2>All Categories</h2>
                    </div>
                    <div class="wt-dashboardbox wt-dashboardtabsholder wt-saveitemholder">
                        <div class="wt-dashboardtabs"  style="width: 20%;">
                            <ul class="wt-tabstitle nav navbar-nav">
                                @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="@if($loop->index == 0) active @endif" data-toggle="tab" href="#wt-{{ $category->slug }}">{{ $category->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wt-tabscontent tab-content tab-savecontent" style="width: 8 0%;">
                            @foreach($categories as $category)
                            <div class="wt-personalskillshold tab-pane fade @if($loop->index == 0) show active in @endif" id="wt-{{ $category->slug }}" style="overflow-x: scroll;">
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
                                                                            <li style=pointer-events:none;><a href="javascript:void(0);" class="wt-clicklike wt-clicksave"><i class="fa fa-heart"></i> {{trans("lang.saved")}}</a></li>
                                                                        @else
                                                                            <li>
                                                                                <a href="javascrip:void(0);" class="wt-clicklike" id="job-{{$job->id}}" @click.prevent="add_wishlist('job-{{$job->id}}', {{$job->id}}, 'saved_jobs', '{{trans("lang.saved")}}')" v-cloak>
                                                                                    <i class="fa fa-heart"></i>
                                                                                    <span class="save_text">{{ trans('lang.click_to_save') }}</span>
                                                                                </a>
                                                                            </li>
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