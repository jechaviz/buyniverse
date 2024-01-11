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
        
			
			<div class="row" style="margin-left: 10px;padding-bottom: 15px;">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                    <li><a href="{{{ url('/provider/teams') }}}">{{ trans('lang.team')}}</a></li>
					<li class="active">{{ trans('lang.edit_team')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_team') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                        <form action="{{ route('fteam.update', $team->id) }}" class="wt-haslayout" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                                <div class="form-group">
                                    {!! Form::text( 'name', e($team['name']), ['class' =>'form-control'.($errors->has('name') ? ' is-invalid' : '')] ) !!}
                                    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'email', e($team['email']), ['class' =>'form-control'.($errors->has('email') ? ' is-invalid' : '')] ) !!}
                                    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::text( 'role', e($team['role']), ['class' =>'form-control'.($errors->has('role') ? ' is-invalid' : '')] ) !!}
                                    
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group wt-btnarea">
                                    {!! Form::submit(trans('lang.update_team'), ['class' => 'wt-btn']) !!}
                                </div>
                            
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
