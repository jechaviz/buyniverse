@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="provider-profile wt-dbsectionspace" id="user_profile">
    
			<div class="row" style="margin-left: 10px;padding-bottom: 15px;">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
					<li class="active">{{ trans('lang.profile_detail')}}</li>
				</ol>
			</div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="wt-dashboardbox wt-dashboardtabsholder">
                    @if (file_exists(resource_path('views/extend/back-end/employer/profile-settings/tabs.blade.php')))
                        @include('extend.back-end.employer.profile-settings.tabs')
                    @else
                        @include('back-end.employer.profile-settings.tabs')
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
                        <div class="wt-personalskillshold lare-employer-profile tab-pane active fade show" id="wt-profile">
                            
                            <form action="{{ url('employer/store-contact-settings') }}" class="wt-userform" method="post" id="employer_data" @submit.prevent="submitEmployerProfile">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    
                                    <input type="text" name="name" value="{{ $contact->name }}" class="form-control {{( $errors->has('name') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_first_name')}}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="position" value="{{ $contact->position }}" class="form-control {{( $errors->has('position') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.position')}}">
                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="department" value="{{ $contact->department }}" class="form-control {{( $errors->has('department') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.department')}}">
                                    @if ($errors->has('department'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="skype" value="{{ $contact->skype }}" class="form-control {{( $errors->has('skype') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.skype')}}">
                                    @if ($errors->has('skype'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('skype') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="facebook" value="{{ $contact->facebook }}" class="form-control {{( $errors->has('facebook') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.facebook')}}">
                                    @if ($errors->has('facebook'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="twitter" value="{{ $contact->twitter }}" class="form-control {{( $errors->has('twitter') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.twitter')}}">
                                    @if ($errors->has('twitter'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('twitter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="personalWebSite" value="{{ $contact->personalWebSite }}" class="form-control {{( $errors->has('personalWebSite') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.personalWebSite')}}">
                                    @if ($errors->has('personalWebSite'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('personalWebSite') }}</strong>
                                        </span>
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
@endsection
