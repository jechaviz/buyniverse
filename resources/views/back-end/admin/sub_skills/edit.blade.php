@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="skills-listing" id="skill-list">
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
                    <li><a href="{{{ url($role.'/skills') }}}">{{ trans('lang.skills')}}</a></li>
					<li class="active">{{ trans('lang.edit_skill')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_skill') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                        <form action="{{ route('sub-skills.update', $sub_skills->id) }}" class="wt-haslayout" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    
                                    <input type="text" name="skill_title" value="{{ $sub_skills['sub_skill'] }}" class="form-control {{( $errors->has('skill_title') ? ' is-invalid' : '')}}">
                                    <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                    @if ($errors->has('skill_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('skill_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group wt-btnarea">
                                    
                                    <input type="submit" value="{{ trans('lang.update_skill') }}" class="wt-btn">
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
