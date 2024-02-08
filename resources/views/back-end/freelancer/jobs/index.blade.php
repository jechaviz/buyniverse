@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
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
	<div class="wt-haslayout wt-dbsectionspace la-manage-jobs-holder">
		<div class="manage-jobs">
			<div class="row">
				<h3 style="width:50%">{{ trans('lang.manage_projects') }}</h3>
			</div>
			<div class="row"  style="padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.manage_projects')}}</li>
                            </ol>
                        </div>
			<style>
				.btn {
				    background-color: #ffffff;
					color: #b4b1b1;
					font-size: 16px;
					border: 1px solid #b4b1b1;
					outline: none;
					border-radius: 0;
				}

				.dropdown {
				position: absolute;
				display: inline-block;
				}

				.dropdown-content {
				display: none;
				position: absolute;
				background-color: #f1f1f1;
				min-width: 160px;
				z-index: 1;
				}

				.dropdown-content a {
				color: black;
				padding: 12px 16px;
				text-decoration: none;
				display: block;
				}

				.dropdown-content a:hover {background-color: #ddd}

				.dropdown:hover .dropdown-content {
				display: block;
				}

				.btn:hover, .dropdown:hover .btn {
				background-color: #b4b1b1;
				color:white;
				}
				</style>
			<!--<div class="row" style="margin-top:30px;">
				{!! Form::open(['url' => url('search-results'), 'method' => 'get', 'class' => 'wt-formtheme wt-formsearch', 'id' => 'wt-formsearch']) !!}
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
				{!! form::close(); !!}
			</div>-->
			<div class="row" style="margin-top:30px;">
				<ul class="nav nav-tabs" style="width: 100%;">
					<li class="active"><a data-toggle="tab" href="#menu3">{{ trans('lang.ongoing_jobs')}}<span class="badge bg-danger">{{ $ongoing_jobs->count() }}</span></a></li>
					<li><a data-toggle="tab" href="#menu4">{{ trans('lang.completed')}} <span class="badge bg-danger">{{ $completed_jobs->count() }}</span></a> </li>
					<li><a data-toggle="tab" href="#menu5">{{ trans('lang.cancelled')}} <span class="badge bg-danger">{{ $cancelled_jobs->count() }}</span></a> </li>
					<li><a data-toggle="tab" href="#menu6">{{ trans('lang.team_jobs')}} <span class="badge bg-danger">{{ $team_jobs->count() }}</span></a> </li>
					<li><a data-toggle="tab" href="#menu7">{{ trans('lang.fteam_jobs')}} <span class="badge bg-danger">{{ $fteams_jobs->count() }}</span></a> </li>
				</ul>

				<div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e2dbd1 1px solid">
					<div id="menu3" class="tab-pane fade in active">
					<table class="wt-tablecategories">
						@if (!empty($ongoing_jobs) && $ongoing_jobs->count() > 0)
						<thead>
							<tr>
								<th>
									{{ trans('lang.id')}}
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.posted_by')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.project_bid')}}</th>								
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($ongoing_jobs as $job_id)
							@php
								$job = \App\Job::where('id', $job_id->job_id)->first();
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ url('provider/job/'.$job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
									<span>
										@if (!empty($user_name))
										<a href="{{{ url('profile/'.$job->employer->slug) }}}">@if($verified_user === 1)
											<i class="fa fa-check-circle"></i>@endif&nbsp;{{{ $user_name }}}</a>
										@endif
									</span>
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{Helper::getCurrencySymbol($job->currency)}} {{ $job->price  }}
								</span></td>
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('provider/job/'.$job->slug) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
						</tbody>
					</table>
					</div>
					<div id="menu4" class="tab-pane fade">
					<table class="wt-tablecategories">
						@if (!empty($completed_jobs) && $completed_jobs->count() > 0)
						<thead>
							<tr>
								<th>
								{{ trans('lang.id')}}
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.posted_by')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.project_bid')}}</th>								
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($completed_jobs as $job_id)
							@php
								$job = \App\Job::where('id', $job_id->job_id)->first();
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ url('provider/job/'.$job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
									<span>
										@if (!empty($user_name))
										<a href="{{{ url('profile/'.$job->employer->slug) }}}">@if($verified_user === 1)
											<i class="fa fa-check-circle"></i>@endif&nbsp;{{{ $user_name }}}</a>
										@endif
									</span>
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{Helper::getCurrencySymbol($job->currency)}} {{ $job_id->price  }}
								</span></td>
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('provider/job/'.$job->slug) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
						</tbody>
					</table>
					</div>
					<div id="menu5" class="tab-pane fade">
					<table class="wt-tablecategories">
						@if (!empty($cancelled_jobs) && $cancelled_jobs->count() > 0)
						<thead>
							<tr>
								<th>
								{{ trans('lang.id')}}
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.posted_by')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.project_bid')}}</th>								
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($ongoing_jobs as $job_id)
							@php
								$job = \App\Job::where('id', $job_id->job_id)->first();
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ url('provider/job/'.$job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
									<span>
										@if (!empty($user_name))
										<a href="{{{ url('profile/'.$job->employer->slug) }}}">@if($verified_user === 1)
											<i class="fa fa-check-circle"></i>@endif&nbsp;{{{ $user_name }}}</a>
										@endif
									</span>
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{Helper::getCurrencySymbol($job->currency)}} {{ $job_id->price  }}
								</span></td>
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('provider/job/'.$job->slug) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												<a href="{{{ url('provider/dispute/'.$job->slug) }}}" class="wt-btn">{{ trans('lang.raise_dispute') }}</a>
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
						</tbody>
					</table>
					</div>
					<div id="menu6" class="tab-pane fade">
					<table class="wt-tablecategories">
						@if (!empty($team_jobs) && $team_jobs->count() > 0)
						<thead>
							<tr>
								<th>
								{{ trans('lang.id')}}
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.posted_by')}}</th>
								<th>{{ trans('lang.type')}}</th>
																
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($team_jobs as $job)
							@php
								
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ url('provider/team/'.$job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
									<span>
										@if (!empty($user_name))
										<a href="{{{ url('profile/'.$job->employer->slug) }}}">@if($verified_user === 1)
											<i class="fa fa-check-circle"></i>@endif&nbsp;{{{ $user_name }}}</a>
										@endif
									</span>
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('provider/team/'.$job->slug) }}}"><button class="btn">View</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
						</tbody>
					</table>
					</div>
					<div id="menu7" class="tab-pane fade">
					<table class="wt-tablecategories">
						@if (!empty($fteams_jobs) && $fteams_jobs->count() > 0)
						<thead>
							<tr>
								<th>
									{{ trans('lang.id')}}
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.posted_by')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($fteams_jobs as $job_id)
							@php
								$job = \App\Job::where('id', $job_id->job_id)->first();
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ url('provider/job/'.$job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
									<span>
										@if (!empty($user_name))
										<a href="{{{ url('profile/'.$job->employer->slug) }}}">@if($verified_user === 1)
											<i class="fa fa-check-circle"></i>@endif&nbsp;{{{ $user_name }}}</a>
										@endif
									</span>
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('provider/job/'.$job->slug) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
						</tbody>
					</table>
					</div>
				</div>
			</div>

	
		</div>
	</div> 
@endsection
