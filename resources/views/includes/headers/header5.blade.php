<header id="wt-header" class="wt-header wt-headereleven">
    <div class="wt-navigationarea">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @if (!empty($logo) || Schema::hasTable('site_managements'))
                        <strong class="wt-logo"><a href="{{{ url('/') }}}"><img src="{{{ asset($logo) }}}" alt="{{{ trans('Logo') }}}"></a></strong>
                    @endif
                    <div class="wt-rightarea">
                        @if (file_exists(resource_path('views/extend/includes/menu.blade.php'))) 
                            @include('extend.includes.menu')
                        @else 
                            @include('includes.menu')
                        @endif
                        @guest
                            <div class="wt-loginarea">
                                <div class="wt-loginoption wt-loginoptionvtwo">
                                    <a href="javascript:void(0);" id="wt-loginbtn" class="wt-btn">{{{trans('lang.sign_in') }}}</a>
                                    <div class="wt-loginformhold">
                                        <div class="wt-loginheader">
                                            <span>{{{trans('lang.sign_in') }}}</span>
                                            <a href="javascript:;"><i class="fa fa-times"></i></a>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}"class="wt-formtheme wt-loginform do-login-form">
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
                                                    <button href="javascript:;"  type="submit" class="wt-btn do-login-button">{{{ trans('lang.sign_in') }}}</button>
                                                    <span class="wt-checkbox">
                                                        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">{{{ trans('lang.keep_me_logged_in') }}}</label>
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
                                </div>
                                @if (file_exists(resource_path('views/extend/back-end/includes/profile-menu.blade.php'))) 
                                    @include('extend.back-end.includes.profile-menu')
                                @else 
                                    @include('back-end.includes.profile-menu')
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-categoriesnav-holder">
        <div class="container-fluid">
            <div class="row">
                <nav class="wt-categories-nav navbar-expand-xl">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#catnavbarNav" aria-controls="catnavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="lnr lnr-menu"></i>
                    </button>
                    <div class="collapse navbar-collapse wt-categories-navbar" id="catnavbarNav">
                        <ul>
                            @if (!empty($categories))
                                @foreach ($categories as $index => $cat) 
                                    <li>
                                        <a href="{{{url('search-results?type=job&category%5B%5D='.$cat['slug'])}}}">{{$cat['title']}}</a>
                                    </li>
                                @endforeach
                                @if (count($categories) > 7)
                                    <li class="wt-catnav-children menu-item-has-children page_item_has_children ">
                                        <a href="javascript:void(0);">{{{ trans('lang.see_all_cats') }}}</a>
                                        <ul class="wt-catnav-submenu sub-menu">
                                            @foreach (array_slice($categories, 7) as $index => $cat) 
                                                <li>
                                                    <a href="{{{url('search-results?type=job&category%5B%5D='.$cat['slug'])}}}">{{$cat['title']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>