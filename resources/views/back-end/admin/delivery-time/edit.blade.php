@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="dpts-listing" id="delivery-time">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace">
        @php
			$user = !empty(Auth::user()) ? Auth::user() : '';
			$role = !empty($user) ? $user->role : array();
			@endphp
			<div class="row" style="margin-left: 10px;padding-bottom: 15px;">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                    <li><a href="{{{ url($role.'/delivery-time') }}}">{{ trans('lang.delivery_time')}}</a></li>
					<li class="active">{{ trans('lang.edit_delivery_time')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_delivery_time') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <form action="{{ url('admin/delivery-time/update-delivery-time/'.$delivery_time->id.'') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="delivery_time">
                            <!--<input type="hidden" name="_method" value="PUT">-->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="delivery_time_title" value="{{ $delivery_time['title'] }}" class="form-control {{($errors->has('delivery_time_title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_delivery_time_title') }}">
                                    @if ($errors->has('delivery_time_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('delivery_time_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group wt-btnarea">
                                    <input type="submit" value="{{ trans('lang.update_delivery_time') }}" class="wt-btn">
                                </div>
                            </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
