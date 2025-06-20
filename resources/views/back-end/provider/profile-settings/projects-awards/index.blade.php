@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="wt-dbsectionspace wt-haslayout la-aw-provider">
    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.project_awards')}}</li>
                            </ol>
                        </div>  
        <div class="provider-profile" id="user_profile">
            <div class="preloader-section" v-if="loading" v-cloak>
                <div class="preloader-holder">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="wt-dashboardbox wt-dashboardtabsholder">
                        @if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/tabs.blade.php'))) 
                            @include('extend.back-end.provider.profile-settings.tabs')
                        @else 
                            @include('back-end.provider.profile-settings.tabs')
                        @endif
                        <div class="wt-tabscontent tab-content">
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
                            <div class="wt-awardsholder" id="wt-awards">
                                
                                <form action="{{ url('provider/store-project-award-settings') }}" class="wt-formtheme wt-formprojectinfo wt-userform" method="post" id="awards_projects" @submit.prevent="submitAwardsProjects">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="wt-addprojectsholder wt-tabsinfo">
                                        @if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/projects-awards/projects.blade.php'))) 
                                            @include('extend.back-end.provider.profile-settings.projects-awards.projects')
                                        @else 
                                            @include('back-end.provider.profile-settings.projects-awards.projects')
                                        @endif
                                    </div>
                                    <div class="wt-addprojectsholder wt-tabsinfo la-awards">
                                        @if (file_exists(resource_path('views/extend/back-end/provider/profile-settings/projects-awards/awards.blade.php'))) 
                                            @include('extend.back-end.provider.profile-settings.projects-awards.awards') 
                                        @else 
                                            @include('back-end.provider.profile-settings.projects-awards.awards') 
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