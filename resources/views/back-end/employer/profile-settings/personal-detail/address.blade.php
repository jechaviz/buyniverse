@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="freelancer-profile wt-dbsectionspace" id="user_profile">
    
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
                            {!! Form::open(['url' => url('employer/store-address-settings'), 'class' =>'wt-userform', 'id' => 'employer_data']) !!}
                                <div class="form-group">
                                    {!! Form::text( 'name', $address->name, ['placeholder' => trans('lang.ph_first_name'), 'class' =>'form-control'.($errors->has('name') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'type', $address->type, ['placeholder' => trans('lang.type'), 'class' =>'form-control'.($errors->has('type') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'street', $address->street, ['placeholder' => trans('lang.street'), 'class' =>'form-control'.($errors->has('street') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('street'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'externalNumber', $address->externalNumber, ['placeholder' => trans('lang.externalNumber'), 'class' =>'form-control'.($errors->has('externalNumber') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('externalNumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('externalNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'internalNumber', $address->internalNumber, ['placeholder' => trans('lang.internalNumber'), 'class' =>'form-control'.($errors->has('internalNumber') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('internalNumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('internalNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'neighborhood', $address->neighborhood, ['placeholder' => trans('lang.neighborhood'), 'class' =>'form-control'.($errors->has('neighborhood') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('neighborhood'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('neighborhood') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'locality', $address->locality, ['placeholder' => trans('lang.locality'), 'class' =>'form-control'.($errors->has('locality') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('locality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('locality') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'reference', $address->reference, ['placeholder' => trans('lang.reference'), 'class' =>'form-control'.($errors->has('reference') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('reference'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reference') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'city', $address->city, ['placeholder' => trans('lang.city'), 'class' =>'form-control'.($errors->has('city') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'state', $address->state, ['placeholder' => trans('lang.state'), 'class' =>'form-control'.($errors->has('state') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'country', $address->country, ['placeholder' => trans('lang.country'), 'class' =>'form-control'.($errors->has('country') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'zipCode', $address->zipCode, ['placeholder' => trans('lang.zipCode'), 'class' =>'form-control'.($errors->has('zipCode') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('zipCode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('zipCode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'latitude', $address->latitude, ['placeholder' => trans('lang.latitude'), 'class' =>'form-control'.($errors->has('latitude') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('latitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'longitude', $address->longitude, ['placeholder' => trans('lang.longitude'), 'class' =>'form-control'.($errors->has('longitude') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('longitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'website', $address->website, ['placeholder' => trans('lang.website'), 'class' =>'form-control'.($errors->has('website') ? ' is-invalid' : '')] ) !!}
                                    @if ($errors->has('website'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('website') }}</strong>
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
