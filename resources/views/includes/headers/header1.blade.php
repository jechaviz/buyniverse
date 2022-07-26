<header id="wt-header" class="wt-header wt-haslayout wt-headervtwo">
    <div class="wt-navigationarea">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @auth
                        {{ Helper::displayEmailWarning() }}
                    @endauth
                    @if (!empty($logo) || Schema::hasTable('site_managements'))
                        <strong class="wt-logo"><a href="{{{ url('/') }}}"><img src="{{{ asset($logo) }}}" alt="{{{ trans('Logo') }}}"></a></strong>
                    @endif
                    @if (!empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' && Route::getCurrentRoute()->uri() != 'home')
                        <search-form
                        :placeholder="'{{ trans('lang.looking_for') }}'"
                        :freelancer_placeholder="'{{ trans('lang.search_filter_list.freelancer') }}'"
                        :employer_placeholder="'{{ trans('lang.search_filter_list.employers') }}'"
                        :job_placeholder="'{{ trans('lang.search_filter_list.jobs') }}'"
                        :service_placeholder="'{{ trans('lang.search_filter_list.services') }}'"
                        :no_record_message="'{{ trans('lang.no_record') }}'"
                        >
                        </search-form>
                    @endif
                    <div class="wt-rightarea">
                        @if (file_exists(resource_path('views/extend/includes/menu.blade.php'))) 
                            @include('extend.includes.menu', ['page_order' => $page_order])
                        @else 
                            @include('includes.menu', ['page_order' => $page_order])
                        @endif
                        @guest
                            <div class="wt-loginarea">
                                <div class="wt-loginoption">
                                    <a href="javascript:void(0);" id="wt-loginbtn" class="wt-loginbtn">{{{trans('lang.login') }}}</a>
                                    <div class="wt-loginformhold" @if ($errors->has('email') || $errors->has('password')) style="display: block;" @endif>
                                        <div class="wt-loginheader">
                                            <span>{{{ trans('lang.login') }}}</span>
                                            <a href="javascript:;"><i class="fa fa-times"></i></a>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}" class="wt-formtheme wt-loginform do-login-form">
                                            @csrf
                                            <fieldset>
                                                <div class="form-group">
                                                    <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                        placeholder="Email" required autofocus>
                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                        placeholder="Password" required>
                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="wt-logininfo">
                                                        <button type="submit" class="wt-btn do-login-button">{{{ trans('lang.login') }}}</button>
                                                    <span class="wt-checkbox">
                                                        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">{{{ trans('lang.remember') }}}</label>
                                                    </span>
                                                </div>
                                            </fieldset>
                                            <div class="wt-loginfooterinfo">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="wt-forgot-password">{{{ trans('lang.forget_pass') }}}</a>
                                                @endif
                                                <a href="{{{ route('register') }}}">{{{ trans('lang.create_account') }}}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <a href="{{{ route('register') }}}" class="wt-btn">{{{ trans('lang.join_now') }}}</a>
                            </div>
                        @endguest
                        @auth
                            @php
                                $user = !empty(Auth::user()) ? Auth::user() : '';
                                $role = !empty($user) ? $user->role : array();
                                $profile = \App\User::find(Auth::user()->id)->profile;
                                $user_image = !empty($profile) ? $profile->avater : '';
                                $employer_job = \App\Job::select('status')->where('user_id', Auth::user()->id)->first();
                                $profile_image = !empty($user_image) ? '/uploads/users/'.$user->id.'/'.$user_image : 'images/user-login.png';
                                //dd($profile_image);
                                $payment_settings = \App\SiteManagement::getMetaValue('commision');
                                $payment_module = !empty($payment_settings) && !empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
                                $employer_payment_module = !empty($payment_settings) && !empty($payment_settings[0]['employer_package']) ? $payment_settings[0]['employer_package'] : 'true';
                            @endphp
                                <div class="wt-userlogedin">
                                    <figure class="wt-userimg">
                                    <img src="{{{ asset(Helper::getProfileImage(Auth::user()->id, '')) }}}" alt="{{{ trans('lang.user_avatar') }}}">
                                        <!--<img src="{{{ asset(Helper::getImage('uploads/users/' . Auth::user()->id, $profile->avater, '' , 'user.jpg')) }}}" alt="{{{ trans('lang.user_avatar') }}}">-->
                                    </figure>
                                    <div class="wt-username">
                                        <h3>{{{ Helper::getUserName(Auth::user()->id) }}}</h3>
                                        <span>{{{ !empty(Auth::user()->profile->tagline) ? str_limit(Auth::user()->profile->tagline, 26, '') : Helper::getAuthRoleName() }}}</span>
                                        @if(!empty(Auth::user()->nickname))<span>{{ Auth::user()->nickname }}</span>@endif
                                    </div>
                                    @if (file_exists(resource_path('views/extend/back-end/includes/profile-menu.blade.php'))) 
                                        @include('extend.back-end.includes.profile-menu', ['styling' => $page_header_styling])
                                    @else 
                                        @include('back-end.includes.profile-menu', ['styling' => $page_header_styling])
                                    @endif
                                </div>
                        @endauth
                        @if (!empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' && Route::getCurrentRoute()->uri() != 'home')
                            <!--<div class="wt-respsonsive-search"><a href="javascript:;" class="wt-searchbtn"><i class="fa fa-search"></i></a></div>-->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@auth
@if (!empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' && Route::getCurrentRoute()->uri() != 'home')
<header id="wt-header1" class="wt-header wt-haslayout wt-headervtwo wt-search-have" style="border-top: 1px #e8e0e0 solid;border-bottom: 1px #e8e0e0 solid;z-index: 10;background-color: #005178">
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
                                    <!--<li style="line-height: 13px!important;font-size: small;">
                                        <a class="header-menu-a" onclick="opensidebar()" style="margin-top: 5px;margin-bottom: 5px;"><i class="ti-desktop"></i></a>
                                    </li>-->
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
                                            <!--<li><a href="{{ route('quiz.index') }}">{{ trans('lang.quiz') }}</a></li>-->
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
                                            <li><a href="{{url('search-results?type=job')}}">{{ trans('lang.project_list') }}</a></li>
                                        </ul>
                                    </li> 

                                    <!--<li style="line-height: 13px!important;font-size: small;">
                                        <a class="header-menu-a" href="#" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.products_store')}}<i class="ti-angle-down"></i></a>
                                    </li> -->
                                    <li style="line-height: 13px!important;font-size: small;">
                                        <a class="header-menu-a" href="{{url('search-results?type=service')}}" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.services_store')}}<i class="ti-angle-down"></i></a>
                                    </li> 
                                    @endif
                                    
                                    <!--<li style="line-height: 13px!important;font-size: small;">
                                        <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.courses')}}</a>
                                    </li> 
                                    <li style="line-height: 13px!important;font-size: small;">
                                        <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.travel')}}<i class="ti-angle-down"></i></a>
                                    </li> 
                                    <li style="line-height: 13px!important;font-size: small;">
                                        <a class="header-menu-a" href="" style="margin-top: 5px;margin-bottom: 5px;">{{ trans('lang.more')}}</a>
                                    </li> -->
                                    
                                </ul>
                            </div>
                        </nav>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endif
@endauth