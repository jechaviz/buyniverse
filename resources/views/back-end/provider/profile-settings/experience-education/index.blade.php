@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="wt-dbsectionspace wt-haslayout la-ed-provider">
    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.experience_education')}}</li>
                            </ol>
                        </div>  
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <div class="provider-profile" id="user_profile">
                    <div class="preloader-section" v-if="loading" v-cloak>
                        <div class="preloader-holder">
                            <div class="loader"></div>
                        </div>
                    </div>
                    @if (Session::has('message'))
                        <div class="flash_msg">
                            <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                        </div>
                    @endif
                    @if ($errors->any())
                        <ul class="wt-jobalerts">
                            @foreach ($errors->all() as $error)
                                <div class="flash_msg">
                                    <flash_messages :message_class="'danger'" :time ='10' :message="'{{{ $error }}}'" v-cloak></flash_messages>
                                </div>
                            @endforeach
                        </ul>
                    @endif
                    <div class="wt-dashboardbox wt-dashboardtabsholder">
                        @if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/tabs.blade.php'))) 
                            @include('extend.back-end.provider.profile-settings.tabs')
                        @else 
                            @include('back-end.provider.profile-settings.tabs')
                        @endif
                        <div class="wt-tabscontent tab-content">
                            <div class="wt-educationholder" id="wt-education">
                                
                                <form action="{{ url('provider/store-experience-settings') }}" class="wt-formtheme wt-userform" method="post" id="experience_form" @submit.prevent="submitExperienceEduction">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="wt-userexperience wt-tabsinfo">
                                        @if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/experience-education/experience.blade.php'))) 
                                            @include('extend.back-end.provider.profile-settings.experience-education.experience')
                                        @else 
                                            @include('back-end.provider.profile-settings.experience-education.experience')
                                        @endif
                                    </div>
                                    <div class="wt-userexperience wt-tabsinfo">
                                        @if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/experience-education/education.blade.php'))) 
                                            @include('extend.back-end.provider.profile-settings.experience-education.education')
                                        @else 
                                            @include('back-end.provider.profile-settings.experience-education.education')
                                        @endif
                                    </div>
                                    <div class="wt-updatall">
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
    </div>
@endsection
@section('bootstrap_script')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
@stop
