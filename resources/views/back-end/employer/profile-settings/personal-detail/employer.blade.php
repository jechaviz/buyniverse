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
                            
                            <form action="{{ url('employer/store-employer-settings') }}" class="wt-userform" method="post" id="employer_data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    
                                    <input type="text" name="name" value="{{ $employer->name }}" class="form-control {{( $errors->has('name') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_first_name')}}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="taxId" value="{{ $employer->taxId }}" class="form-control {{( $errors->has('taxId') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.taxId')}}">
                                    @if ($errors->has('taxId'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('taxId') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="taxPayerType" value="{{ $employer->taxPayerType }}" class="form-control {{( $errors->has('taxPayerType') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.taxPayerType')}}">
                                    @if ($errors->has('taxPayerType'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('taxPayerType') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="privateKey" value="{{ $employer->privateKey }}" class="form-control {{( $errors->has('privateKey') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.privateKey')}}">
                                    
                                    @if ($errors->has('privateKey'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('privateKey') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="publicKey" value="{{ $employer->publicKey }}" class="form-control {{( $errors->has('publicKey') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.publicKey')}}">
                                    @if ($errors->has('publicKey'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('publicKey') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="privateKeyPassword" value="{{ $employer->privateKeyPassword }}" class="form-control {{( $errors->has('privateKeyPassword') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.privateKeyPassword')}}">
                                    @if ($errors->has('privateKeyPassword'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('privateKeyPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="licence" value="{{ $employer->licence }}" class="form-control {{( $errors->has('licence') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.licence')}}">
                                    @if ($errors->has('licence'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('licence') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span class="wt-select">
                                        
                                        <select name="mode" class="" placeholder="{{ trans('lang.mode') }}">
                                            @foreach ($modes as $mode)
                                                <option value="{{ $mode->id }}" @if ($mode->id == $employer->mode) selected @endif>{{ $mode->name }}</option>
                                            @endforeach
                                        </select>

                                    </span>
                                    @if ($errors->has('mode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mode') }}</strong>
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
