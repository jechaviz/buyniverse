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
                            {!! Form::open(['url' => url('employer/store-employer-settings'), 'class' =>'wt-userform', 'id' => 'employer_data']) !!}
                                <div class="form-group">
                                    {!! Form::text( 'name', $employer->name, ['placeholder' => trans('lang.ph_first_name'), 'class' =>'form-control'.($errors->has('name') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'taxId', $employer->taxId, ['placeholder' => trans('lang.taxId'), 'class' =>'form-control'.($errors->has('taxId') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('taxId'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('taxId') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'taxPayerType', $employer->taxPayerType, ['placeholder' => trans('lang.taxPayerType'), 'class' =>'form-control'.($errors->has('taxPayerType') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('taxPayerType'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('taxPayerType') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'privateKey', $employer->privateKey, ['placeholder' => trans('lang.privateKey'), 'class' =>'form-control'.($errors->has('privateKey') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('privateKey'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('privateKey') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'publicKey', $employer->publicKey, ['placeholder' => trans('lang.publicKey'), 'class' =>'form-control'.($errors->has('publicKey') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('publicKey'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('publicKey') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'privateKeyPassword', $employer->privateKeyPassword, ['placeholder' => trans('lang.privateKeyPassword'), 'class' =>'form-control'.($errors->has('privateKeyPassword') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('privateKeyPassword'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('privateKeyPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'licence', $employer->licence, ['placeholder' => trans('lang.licence'), 'class' =>'form-control'.($errors->has('licence') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('licence'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('licence') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span class="wt-select">
                                        {!! Form::select('mode', $modes, $employer->mode ,array('class' => '', 'placeholder' => trans('lang.mode'))) !!}
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
                                    {!! Form::submit(trans('lang.btn_save_update'), ['class' => 'wt-btn', 'id'=>'submit-profile']) !!}
                                </div>
                            {!! form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
