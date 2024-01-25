@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@section('title'){{ $emp_list_meta_title }} @stop
@section('description', $emp_list_meta_desc)
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('searchResults'); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php')))
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.employers'), 'inner_banner' => $e_inner_banner, 'show_banner' => $show_emp_banner ]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.employers'), 'inner_banner' => $e_inner_banner, 'show_banner' => $show_emp_banner ]
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
                            @if (file_exists(resource_path('views/extend/front-end/employers/filters.blade.php'))) 
                                @include('extend.front-end.employers.filters')
                            @else 
                                @include('front-end.employers.filters')
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingtitle">
                                @if (!empty($users))
                                    <span>{{ trans('lang.01') }} {{$users->count()}} of {{\App\User::role('employer')->count()}} results @if (!empty($keyword)) for <em>"{{{$keyword}}}"</em> @endif</span>
                                @endif
                            </div>
                            <div class="wt-companysinfoholder">
                                <div class="row">
                                    @if (!empty($users))
                                        @foreach ($users as $employer)
                                            @php
                                                $verified_user = \App\User::select('user_verified')->where('id', $employer->id)->pluck('user_verified')->first();
                                                $user_image = !empty($employer->profile->avater) ?
                                                            '/uploads/users/'.$employer->id.'/'.$employer->profile->avater :
                                                            'images/user.jpg';
                                            @endphp
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                                <div class="wt-companysdetails">
                                                    <figure class="wt-companysimg">
                                                        <img src="{{{ asset(Helper::getUserProfileBanner($employer->id, 'small')) }}}" alt="Company">
                                                    </figure>
                                                    <div class="wt-companysinfo">
                                                        <figure><img src="{{{ asset($user_image) }}}" alt="Company"></figure>
                                                        <div class="wt-title">
                                                            <a href="{{{ url('profile/'.$employer->slug.'/employer') }}}">
                                                            @if ($verified_user === 1)
                                                                <i class="fa fa-check-circle"></i> {{ trans('lang.verified_company') }}</a>
                                                            @endif
                                                            <a href="{{{ url('profile/'.$employer->slug.'/employer') }}}"><h2>{{{ Helper::getUserName($employer->id) }}}</h2></a>
                                                        </div>
                                                        <ul class="wt-postarticlemeta">
                                                            <li>
                                                                <a href="{{ url('profile/'.$employer->slug.'/employer') }}">
                                                                    <span>{{ trans('lang.open_jobs') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{{ url('profile/'.$employer->slug.'/employer') }}}">
                                                                    <span>{{ trans('lang.full_profile') }}</span>
                                                                </a>
                                                            </li>
                                                            @if (in_array($employer->id, $save_employer))
                                                                <li class="wt-following wt-btndisbaled">
                                                                    <a href="javascript:void(0);">
                                                                        {{ trans('lang.following') }}
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <a href="javascript:void(0);" id="profile-{{$employer->id}}" @click.prevent="add_wishlist('profile-{{$employer->id}}', {{$employer->id}}, 'saved_employers', '{{trans("lang.following")}}')" v-cloak>
                                                                        <span>{{ trans('lang.click_to_follow') }}</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ( method_exists($users,'links') )
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 la-employerpagintaion">
                                                {{ $users->links('pagination.custom') }}
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
