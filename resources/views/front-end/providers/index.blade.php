@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@push('stylesheets')
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@section('title'){{ $f_list_meta_title }} @stop
@section('description', $f_list_meta_desc)
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('searchResults'); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php')))
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.providers'), 'inner_banner' => $f_inner_banner, 'show_banner' => $show_f_banner ]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.providers'), 'inner_banner' => $f_inner_banner, 'show_banner' => $show_f_banner ]
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
                                            <a class="header-menu-a" href="{{url('search-results?type=provider')}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.providers')}}</i></a>
                                        </li> 
                                        @endif

                                        @if($role === 'provider')
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.sell') }}<i class="ti-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="{{{ route('showproviderProposals') }}}">{{ trans('lang.proposals') }}</a></li>
                                                <li><a href="{{ route('providerPostService') }}">{{ trans('lang.services') }}</a></li>
                                            </ul>
                                        </li>
                                        <li style="line-height: 13px!important;font-size: small;">
                                            <a class="header-menu-a" href="{{{ route('providerJobs') }}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.project_contest') }}<i class="ti-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="{{{ route('providerJobs') }}}">{{ trans('lang.project_contest') }}</a></li>
                                                <li><a href="{{ route('providerJoblist') }}">{{ trans('lang.project_list') }}</a></li>
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
    <!--
    @if (!empty($categories) && $categories->count() > 0)
        <div class="wt-categoriesslider-holder wt-haslayout {{$show_f_banner == 'false' ? 'la-categorty-top-mt' : ''}}">
            <div class="wt-title">
                <h2>{{ trans('lang.browse_job_cats') }}</h2>
            </div>
            <div id="wt-categoriesslider" class="wt-categoriesslider owl-carousel">
                @foreach ($categories as $cat)
                    @php
                        $category = \App\Category::find($cat->id);
                        $selectedCategories = (array) request()->query('category', []);
                        $active = in_array($cat->id, $selectedCategories) ? 'active-category' : '';
                        $active_wrapper = in_array($cat->id, $selectedCategories) ? 'active-category-wrapper' : '';
                    @endphp
                    <div class="wt-categoryslidercontent item {{$active_wrapper}}">
                        <figure><img src="{{{ asset(Helper::getCategoryImage($cat->image)) }}}" alt="{{{ $cat->title }}}"></figure>
                        <div class="wt-cattitle">
                        <h3><a href="{{{url('search-results?type=job&category%5B%5D='.$cat->slug)}}}" class="{{$active}}">{{{ $cat->title }}}</a></h3>
                            <span>Items: {{{$category->jobs->count()}}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif -->
    <div class="wt-haslayout wt-main-section" id="user_profile">
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
                            @if (file_exists(resource_path('views/extend/front-end/providers/filters.blade.php'))) 
                                @include('extend.front-end.providers.filters')
                            @else 
                                @include('front-end.providers.filters')
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingholder wt-userlisting wt-haslayout">
                                <div class="wt-userlistingtitle">
                                    @if (!empty($users))
                                        <span>{{ trans('lang.01') }} {{$users->count()}} of {{\App\User::role('provider')->count()}} results @if (!empty($keyword)) for <em>"{{{$keyword}}}"</em> @endif</span>
                                    @endif
                                </div>
                                @if (!empty($users))
                                    @foreach ($users as $key => $provider)
                                        @php
                                            $user_image = !empty($provider->profile->avater) ?
                                                            '/uploads/users/'.$provider->id.'/'.$provider->profile->avater :
                                                            'images/user.jpg';
                                            $flag = !empty($provider->location->flag) ? Helper::getLocationFlag($provider->location->flag) :
                                                    '/images/img-01.png';
                                            $feedbacks = \App\Review::select('feedback')->where('receiver_id', $provider->id)->count();
                                            $avg_rating = App\Review::where('receiver_id', $provider->id)->sum('avg_rating');
                                            $rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                                            $reviews = \App\Review::where('receiver_id', $provider->id)->get();
                                            $stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                                            $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                                            $verified_user = \App\User::select('user_verified')->where('id', $provider->id)->pluck('user_verified')->first();
                                            $save_provider = !empty(auth()->user()->profile->saved_provider) ? unserialize(auth()->user()->profile->saved_provider) : array();
                                            $badge = Helper::getUserBadge($provider->id);
                                            if (!empty($enable_package) && $enable_package === 'true') {
                                                $feature_class = (!empty($badge) && $provider->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                                                $badge_color = !empty($badge) ? $badge->color : '';
                                                $badge_img  = !empty($badge) ? $badge->image : '';
                                            } else {
                                                $feature_class = 'wt-exp';
                                                $badge_color = '';
                                                $badge_img    = '';
                                            }
                                            $sym = $symbol['symbol'];
                                        @endphp
                                        <div class="wt-userlistinghold {{ $feature_class }}">
                                            @if(!empty($enable_package) && $enable_package === 'true')
                                                @if ($provider->expiry_date >= $current_date && !empty($provider->badge_id))
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
                                                <img src="{{{ asset(Helper::getImageWithSize('uploads/users/'.$provider->id, $provider->profile->avater, 'listing')) }}}" alt="{{ trans('lang.img') }}">
                                            </figure>
                                            <div class="wt-userlistingcontent">
                                                <div class="wt-contenthead">
                                                    <div class="wt-title">
                                                        <a href="{{{ url('profile/'.$provider->slug.'/provider') }}}" style="font-size: 18px;">
                                                            @if ($verified_user == 1)
                                                                <i class="fa fa-check-circle"></i>
                                                            @endif
                                                            {{{ Helper::getUserName($provider->id) }}}
                                                        </a>
                                                        @if (!empty($provider->profile->tagline))
                                                            <p style="font-size: 14px!important;"><a href="{{{ url('profile/'.$provider->slug.'/provider') }}}" style="text-decoration: none;color: black;">{{{ $provider->profile->tagline }}}</a></p>
                                                        @endif
                                                    </div>
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        @if (!empty($provider->profile->hourly_rate))
                                                            <li><span><i class="far fa-money-bill-alt"></i>
                                                                {{ (!empty($sym)) ? $sym : "$" }} {{ $provider->profile->hourly_rate }} 
                                                                {{ trans('lang.per_hour') }}</span>
                                                                
                                                            </li>
                                                        @endif
                                                        @if (!empty($provider->location))
                                                            <li><span><img src="{{{ asset($flag)}}}" alt="Flag"> {{{ !empty($provider->location->title) ? $provider->location->title : '' }}}</span></li>
                                                        @endif
                                                        @if (in_array($provider->id, $save_provider))
                                                            <!--<li class="wt-btndisbaled">
                                                                <a href="javascrip:void(0);" class="wt-clicksave wt-clicksave">
                                                                    <i class="fa fa-heart"></i>
                                                                    {{{ trans('lang.saved') }}}
                                                                </a>
                                                            </li>-->
                                                        @else
                                                            <!--<li v-cloak>
                                                                <a href="javascrip:void(0);" class="wt-clicklike" id="provider-{{$provider->id}}" @click.prevent="add_wishlist('provider-{{$provider->id}}', {{$provider->id}}, 'saved_provider', '{{trans("lang.saved")}}')">
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
                                            @if (!empty($provider->profile->description))
                                                <div class="wt-description">
                                                    <p>{!! html_entity_decode(nl2br(e(str_limit($provider->profile->description, 180)))) !!}</p>
                                                </div>
                                            @endif
                                            @if (!empty($provider->skills))
                                                <div class="wt-tag wt-widgettag">
                                                    @foreach($provider->skills as $skill)
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script>
            if (APP_DIRECTION == 'rtl') {
                var direction = true;
            } else {
                var direction = false;
            }
            
            jQuery("#wt-categoriesslider").owlCarousel({
                item: 6,
                rtl:direction,
                loop:true,
                nav:false,
                margin: 0,
                autoplay:true,
                center: true,
                responsiveClass:true,
                responsive:{
                    0:{items:1,},
                    481:{items:2,},
                    768:{items:3,},
                    1440:{items:4,},
                    1760:{items:6,}
                }
            });
        </script>
    @endpush
@endsection
