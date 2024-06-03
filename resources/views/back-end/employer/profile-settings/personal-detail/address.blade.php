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
                            
                            <form action="{{ url('employer/store-address-settings') }}" class="wt-userform" method="post" id="employer_data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    
                                    <input type="text" name="name" value="{{ $address->name }} class="form-control {{( $errors->has('name') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_first_name')}}" >
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="type" value="{{ $address->type }} class="form-control {{( $errors->has('type') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.type')}}" >
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="street" value="{{ $address->street }} class="form-control {{( $errors->has('street') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.street')}}" >
                                    @if ($errors->has('street'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="externalNumber" value="{{ $address->externalNumber }} class="form-control {{( $errors->has('externalNumber') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.externalNumber')}}" >
                                    @if ($errors->has('externalNumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('externalNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="internalNumber" value="{{ $address->internalNumber }} class="form-control {{( $errors->has('internalNumber') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.internalNumber')}}" >
                                    @if ($errors->has('internalNumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('internalNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="neighborhood" value="{{ $address->neighborhood }} class="form-control {{( $errors->has('neighborhood') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.neighborhood')}}" >
                                    @if ($errors->has('neighborhood'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('neighborhood') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="locality" value="{{ $address->locality }} class="form-control {{( $errors->has('locality') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.locality')}}" >
                                    @if ($errors->has('locality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('locality') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="reference" value="{{ $address->reference }} class="form-control {{( $errors->has('reference') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.reference')}}" >
                                    @if ($errors->has('reference'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reference') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="city" value="{{ $address->city }} class="form-control {{( $errors->has('city') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.city')}}" >
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="state" value="{{ $address->state }} class="form-control {{( $errors->has('state') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.state')}}" >
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="country" value="{{ $address->country }} class="form-control {{( $errors->has('country') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.country')}}" >
                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="zipCode" value="{{ $address->zipCode }} class="form-control {{( $errors->has('zipCode') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.zipCode')}}" >
                                    @if ($errors->has('zipCode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('zipCode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="latitude" value="{{ $address->latitude }} class="form-control {{( $errors->has('latitude') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.latitude')}}" >
                                    @if ($errors->has('latitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="longitude" value="{{ $address->longitude }} class="form-control {{( $errors->has('longitude') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.longitude')}}" >
                                    @if ($errors->has('longitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" name="website" value="{{ $address->website }}" class="form-control {{( $errors->has('website') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.website')}}" >
                                    @if ($errors->has('website'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('website') }}</strong>
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
