@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="provider-profile wt-dbsectionspace la-admin-details" id="user_profile">
    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.admin_detail')}}</li>
                            </ol>
                        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="wt-dashboardbox wt-dashboardtabsholder">
                    <div class="wt-dashboardtabs">
                        <ul class="wt-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="{{{ \Request::route()->getName()==='adminProfile'? 'active': '' }}}" href="{{{ route('adminProfile') }}}">{{{ trans('lang.admin_detail') }}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="wt-tabscontent tab-content">
                        @if (Session::has('message'))
                            <div class="flash_msg">
                                <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                            </div>
                        @endif
                        @if ($errors->any())
                            <ul class="wt-jobalerts">
                                @foreach ($errors->all() as $error)
                                    <div class="flash_msg">
                                        <flash_messages :message_class="'danger'" :time='10' :message="'{{{ $error }}}'" v-cloak></flash_messages>
                                    </div>
                                @endforeach
                            </ul>
                        @endif
                        <div class="wt-personalskillshold tab-pane active show">
                            
                            <form action="" class="wt-userform" id="admin_data" @submit.prevent="submitAdminProfile">
                                <div class="wt-yourdetails wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{{ trans('lang.your_details') }}}</h2>
                                    </div>
                                    <div class="lara-detail-form">
                                        <fieldset>
                                            <div class="form-group form-group-half">
                                                
                                                <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control" placeholder="{{ trans('lang.ph_first_name')}}">
                                            </div>
                                            <div class="form-group form-group-half">
                                                
                                                <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control" placeholder="{{ trans('lang.ph_last_name')}}">
                                            </div>
                                            <div class="form-group">
                                                
                                                <input type="text" name="nickname" value="{{ Auth::user()->nickname }}" class="form-control" placeholder="{{ trans('lang.nickname')}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="{{ trans('lang.ph_email')}}">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="wt-profilephoto wt-tabsinfo">
                                    @if (file_exists(resource_path('views/extend/back-end/admin/profile-settings/personal-detail/profile_photo.blade.php'))) 
                                        @include('extend.back-end.admin.profile-settings.personal-detail.profile_photo')
                                    @else 
                                        @include('back-end.admin.profile-settings.personal-detail.profile_photo')
                                    @endif
                                </div>
                                <div class="wt-bannerphoto wt-tabsinfo">
                                    @if (file_exists(resource_path('views/extend/back-end/admin/profile-settings/personal-detail/profile_banner.blade.php'))) 
                                        @include('extend.back-end.admin.profile-settings.personal-detail.profile_banner')
                                    @else 
                                        @include('back-end.admin.profile-settings.personal-detail.profile_banner')
                                    @endif
                                </div>
                                <div class="wt-updatall la-updateall-holder">
                                    <i class="ti-announcement"></i>
                                    <span>{{{ trans('lang.save_changes_note') }}}</span> 
                                    
                                    <input type="submit" value="{{ trans('lang.btn_save_update') }}" class="wt-btn" id="submit-profile">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
