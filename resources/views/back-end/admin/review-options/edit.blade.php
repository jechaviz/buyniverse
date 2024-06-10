@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="dpts-listing" id="reviews">
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
                    <li><a href="{{{ url($role.'/review-options') }}}">{{ trans('lang.review_options')}}</a></li>
					<li class="active">{{ trans('lang.edit_review_options')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_review_options') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            
                            <form action="{{ url('admin/review-options/update-review-options/'.$review_options->id.'') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="review_options">
                            <!--<input type="hidden" name="_method" value="PUT">-->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    
                                    <input type="text" name="review_option_title" value="{{ $review_options['title'] }}" class="form-control {{( $errors->has('review_option_title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_review_option_title')}}">
                                    @if ($errors->has('review_option_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('review_option_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group wt-btnarea">
                                    
                                    <input type="submit" value="{{ trans('lang.update_review_options') }}" class="wt-btn">
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
