@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @php
        $verified_user = \App\User::select('user_verified')
        ->where('id', $job->employer->id)->pluck('user_verified')->first();
    @endphp
    <section class="wt-haslayout wt-dbsectionspace la-dbproposal" id="jobs">
        @if (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <link rel="stylesheet" href="{{ asset('css/bootstrap1.min.css') }}">
        <style>
		@media (min-width: 992px)
		{
			
		.navbar-collapse.collapse {
			display: block!important;
			height: auto!important;
			padding-bottom: 0;
			overflow: visible!important;
		}
		}
	</style>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                @if ($proposal->status == "cancelled" && !empty($cancel_reason))
                    <div class="wt-jobalertsholder">
                        <ul class="wt-jobalerts">
                            <li class="alert alert-danger alert-dismissible fade show">
                                <span><em>{{ trans('lang.sorry') }}</em> {{ trans('lang.job_cancelled') }}</span>
                                <a href="javascript:void(0)" class="wt-alertbtn danger" v-on:click.prevent="viewReason('{{$cancel_reason->description}}')" >{{ trans('lang.reason') }}</a>
                                <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                    </div>
                @endif


                <!--<div class="wt-dashboardbox">
                    <div class="wt-dashboardboxtitle">
                        <h2>{{ trans('lang.job_dtl') }}</h2>
                    </div>
                    <div class="wt-dashboardboxcontent wt-jobdetailsholder">
                        <div class="wt-providerholder wt-tabsinfo">
                            <div class="wt-jobdetailscontent">
                                <div class="wt-userlistinghold wt-featured wt-userlistingvtwo">
                                    @if (!empty($job->is_featured) && $job->is_featured === 'true')
                                        <span class="wt-featuredtag">
                                            <img src="{{{ asset('images/featured.png') }}}" alt="{{ trans('lang.is_featured') }}"
                                                data-tipso="Plus Member" class="template-content tipso_style">
                                        </span>
                                    @endif
                                    <div class="wt-userlistingcontent">
                                        <div class="wt-contenthead">
                                            @if (!empty($employer_name) || !empty($job->title) )
                                                <div class="wt-title">
                                                    @if (!empty($employer_name))
                                                        <a href="{{{ url('profile/'.$job->employer->slug) }}}">
                                                            @if($verified_user === 1)
                                                                <i class="fa fa-check-circle"></i>&nbsp;
                                                            @endif
                                                            {{{ $employer_name }}}
                                                        </a>
                                                    @endif
                                                    @if (!empty($job->title))
                                                        <h2>{{{ $job->title }}}</h2>
                                                    @endif
                                                </div>
                                            @endif
                                            <ul class="wt-userlisting-breadcrumb">
                                                @if (!empty($job->price))
                                                    <li><span><i class="far fa-money-bill-alt"></i> {{ !empty($symbol) ? $symbol['symbol'] : '$' }}{{{ $job->price }}}</span></li>
                                                @endif
                                                @if (!empty($job->location->title))
                                                    <li>
                                                        <span>
                                                            <img src="{{{asset(Helper::getLocationFlag($job->location->flag))}}}"
                                                            alt="{{ trans('lang.img') }}"> {{{ $job->location->title }}}
                                                        </span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="wt-rightarea">
                                            <div class="wt-hireduserstatus">
                                                <figure><img src="{{{ asset($employer_image) }}}" alt="{{ trans('lang.profie_img') }}"></figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wt-projecthistory">
                            <div class="wt-tabscontenttitle">
                                <h2>{{ trans('lang.project_history') }}</h2>
                            </div>
                            <div class="wt-historycontent">
                                <private-message :ph_job_dtl="'{{ trans('lang.ph_job_dtl') }}'" :upload_tmp_url="'{{url('proposal/upload-temp-image')}}'" :id="'{{$proposal->id}}'" :recipent_id="'{{$job->user_id}}'"></private-message>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- New design -->
                @php
			$user = !empty(Auth::user()) ? Auth::user() : '';
			$role = !empty($user) ? $user->role : array();
			@endphp
			<div class="row">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                    <li><a href="{{{ url($role.'/jobs') }}}">{{ trans('lang.jobs')}}</a></li>
					<li class="active">{{ trans('lang.job')}}</li>
				</ol>
			</div>
                <div class="row">
                    <div class="md-2" style="font-size: 70px;color: gold;">
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <div class="md-10" style="margin-left: 15px;">
                        <h2> {{{ $job->title }}}</h2>
                        
                        <h4>{{ trans('lang.project_id')}} : # {{{ $job->id }}} </h4>
                    </div>
                </div>
                
                <div class="row" style="margin-top:30px;">
                    
                    <form action="{{ url('search-results') }}" class="wt-formtheme wt-formsearch"  id="wt-formsearch">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="wt-widgetcontent">
                        <div class="wt-formtheme wt-formsearch">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="s" class="form-control" placeholder="{{ trans('lang.ph_search_jobs') }}" value="">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <input type="submit" value="Apply Filters" class="wt-btn" style="display: none;">
                    </form>
                </div>

                <div class="row" style="margin-top:30px;">
                    <ul class="nav nav-tabs" style="width: 100%;">
                        <li class="active"><a data-toggle="tab" href="#home">{{ trans('lang.overview')}} <span class="badge bg-danger"></span></a></li>
                        <!--<li><a data-toggle="tab" href="#menu1">Details <span class="badge bg-danger"></span></a></li>-->
                        <li><a data-toggle="tab" href="#menu2">{{ trans('lang.files')}} <span class="badge bg-danger">{{$job->files}}</span></a></li>
                        
                        <!--<li><a data-toggle="tab" href="#menu4">{{ trans('lang.payments')}} <span class="badge bg-danger"></span></a> </li>-->
                        <li><a data-toggle="tab" href="#task-component">{{ trans('lang.tasks')}} <span class="badge bg-danger">{{$job->tasks}}</span></a> </li>
                        <!--<li><a href="{{{ route('message') }}}">{{ trans('lang.chats')}} <span class="badge bg-danger"></span></a> </li>-->
                        <li><a data-toggle="tab" href="#menu7">{{ trans('lang.tickets')}} <span class="badge bg-danger">{{$job->tickets}}</span></a> </li>
                        <li><a data-toggle="tab" href="#menu8">{{ trans('lang.notes')}} <span class="badge bg-danger">{{$job->notes}}</span></a> </li>
                        <!--<li><a data-toggle="tab" href="#menu9">{{ trans('lang.financial')}} <span class="badge bg-danger"></span></a> </li>-->
                    </ul>

                    <div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e4dede 5px solid;">
                        <div id="home" class="tab-pane fade in active">
                        <div class="wt-dashboardbox">
                                <div class="wt-dashboardboxtitle">
                                    <div class="col-md-6">
                                        <h2>{{ trans('lang.job_detail') }}</h2>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row float-right">
                                            <b>{{ trans('lang.code') }}</b> : {{ $job->code}}
                                        </div>
                                        <br>
                                        <div class="row float-right">
                                            @php 
                                                $created = date('d-m-Y', strtotime($job->created_at));
                                            @endphp
                                            <b>{{ trans('lang.created_at') }}</b> : {{ $created }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row"  style="width: 100%;">
                                    <div class="col-md-7">
                                        <div style="margin: 30px;">
                                            {!! $job->description !!}
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        
                                        <table style="margin-top: 30px;">
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.posted_by')}}</b></td>
                                                <td class="job-details">{{ Helper::getUserName($job->employer->id) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.project_levelx')}}</b></td>
                                                <td class="job-details">{{ $job->project_level}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.status')}}</b></td>
                                                <td class="job-details">{{ $job->status}}</td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.duration')}}</b></td>
                                                <td class="job-details">
                                                @foreach($project_duration as $key => $value)
                                                    @if($key == $job->duration)
                                                    <span >{{ $value }}</span>
                                                    @endif
                                                @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.budget')}}</b></td>
                                                <td class="job-details">{{ Helper::getCurrencySymbol($job->currency) }} {{ $job->price}}</td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.categories')}}</b></td>
                                                <td class="job-details">
                                                @foreach ($job->categories as $cat)
                                                    <span>
                                                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ $cat->title }} </span>
                                                    </span>
                                                @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.skills')}}</b></td>
                                                <td class="job-details">
                                                @foreach ($job->skills as $cat)
                                                    <span>
                                                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ $cat->title }} </span>
                                                    </span>
                                                @endforeach
                                                </td>
                                            </tr>
                                            <!--<tr>
                                                <td class="job-details"><b>{{ trans('lang.provider_typex')}}</b></td>
                                                <td class="job-details">
                                                @foreach ($providers as $provider)
                                                    <span>
                                                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ $provider->name }} </span>
                                                    </span>
                                                @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.english_level')}}</b></td>
                                                <td class="job-details">
                                                    @foreach($english as $value)
                                                    <span>
                                                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ $value->name }} </span>
                                                    </span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.project_type')}}</b></td>
                                                <td class="job-details">{{ $job->project_type}}</td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.langs')}}</b></td>
                                                <td class="job-details">
                                                    @foreach($lang as $value)
                                                    <span>
                                                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ $value->title }} </span>
                                                    </span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.skills')}}</b></td>
                                                <td class="job-details">
                                                    @foreach($skills as $value)
                                                    <span>
                                                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ $value->title }} </span>
                                                    </span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.featured')}}</b></td>
                                                <td class="job-details">@if($job->is_featured == 'false') {{ trans('lang.no')}} @else {{ trans('lang.yes')}} @endif</td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.quiz')}}</b></td>
                                                <td class="job-details">{{ $job->quiz}}</td>
                                            </tr>-->
                                            <tr>
                                                <td class="job-details"><b>{{ trans('lang.delivery')}} @if($job->delivery_type == 'date') {{ trans('lang.date')}} @elseif($job->delivery_type == 'time') {{ trans('lang.time')}} @endif</b></td>
                                                <td class="job-details">@if($job->delivery_type == 'date')
                                                    @php 
                                                        $expiry = date('d-m-Y', strtotime($job->expiry_date));
                                                    @endphp
                                                    {{$expiry}} 
                                                    
                                                    @elseif($job->delivery_type == 'time') {{ trans('lang.month')}} : {{ $job->month }} <br> {{ trans('lang.week')}} : {{ $job->week }} <br>{{ trans('lang.day')}} : {{ $job->day }} <br>{{ trans('lang.hour')}} : {{ $job->hour }} @endif </td>
                                            </tr>
                                            
                                        </table>
                                        <!--<div class="row"  style="margin: 30px;">
                                            <div class="col-md-6">
                                                Project Level
                                            </div>
                                            <div class="col-md-6">
                                                {{$job->project_level}}
                                            </div>
                                        </div>-->

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!--<div id="menu1" class="tab-pane fade">
                        </div>-->
                        <div id="menu2" class="tab-pane fade">
                            <job_file jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_file>
                        </div>
                        
                        <!--<div id="menu4" class="tab-pane fade">
                        </div>-->
                        <div id="task-component" class="tab-pane fade">
                            <link href="{{ asset('css/tasks.css') }}" rel="stylesheet">
                            <tasks jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}" jobtitle = "{{ $job->title }}"></tasks>
                        </div>
                        <!--<div id="menu6" class="tab-pane fade">
                            <message-center 
                                :empty_field="'{{ trans('lang.empty_field') }}'" 
                                :host="'{{!empty($chat_settings['host']) ? $chat_settings['host'] : ''}}'" 
                                :port="'{{!empty($chat_settings['port']) ? $chat_settings['port'] : ''}}'">
                            </message-center>
                        </div>-->
                        <div id="menu7" class="tab-pane fade">
                            <job_ticket jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_ticket>
                        </div>
                        <div id="menu8" class="tab-pane fade">
                            <job_note jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_note>
                        </div>
                        <!--<div id="menu9" class="tab-pane fade">
                            <table class="wt-tablecategories">
                                <thead>
                                    <tr>
                                        <th>{{ trans('lang.description')}} <i class="fa fa-pencil" aria-hidden="true"></i></th>
                                        <th>{{ trans('lang.features')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            </div>
        </div>
    </section>
@endsection
