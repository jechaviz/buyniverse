@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@push('stylesheets')
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@section('title'){{ $service_list_meta_title }} @stop
@section('description', $service_list_meta_desc)
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('searchResults'); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php')))
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.services'), 'inner_banner' => $service_inner_banner, 'show_banner' => $show_service_banner ]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.services'), 'inner_banner' => $service_inner_banner, 'show_banner' => $show_service_banner ]
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
                                            <a class="header-menu-a" href="{{url('search-results?type=provider')}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.freelancers')}}</i></a>
                                        </li> 
                                        @endif

                                        @if($role === 'provider')
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
    <div class="wt-haslayout wt-main-section" id="services">
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
                            @if (file_exists(resource_path('views/extend/front-end/services/filters.blade.php'))) 
                                @include('extend.front-end.services.filters')
                            @else 
                                @include('front-end.services.filters')
                            @endif
                        </div>
                        <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
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
