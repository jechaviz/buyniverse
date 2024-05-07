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
			@php
				$user = !empty(Auth::user()) ? Auth::user() : '';
				$role = !empty($user) ? $user->role : array();
			@endphp
			<div class="row">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
					<li><a href="{{{ url($role.'/dashboard') }}}">{{ trans('lang.dashboard') }}</a></li>
					<li class="active">{{ trans('lang.manage_projects')}}</li>
				</ol>
			</div>
			<div class="row">
				<h3 style="width:50%">{{ trans('lang.manage_projects')}}
				</h3>
				@if (Helper::getAccessType() == 'both' || Helper::getAccessType() == 'jobs')
                        <div class="" style="width: 50%; text-align: end;"><a href="{{{ url(route('employerPostJob')) }}}" class="wt-btn">{{{ trans('lang.post_job') }}}</a></div>
				@endif
			</div>
			
			<div class="row" style="margin-top:30px;">
				<ul class="nav nav-tabs" style="width: 100%;">
					<li><a data-toggle="tab" href="#draft">{{ trans('lang.draft')}} </a></li>
					<li><a data-toggle="tab" href="#menu5">{{ trans('lang.pending_approval')}} <!--<span class="badge bg-danger">{{ $completed_jobs->count() }}</span>--></a> </li>
					<li><a data-toggle="tab" href="#menu6">{{ trans('lang.rejected_approval')}} <!--<span class="badge bg-danger">{{ $completed_jobs->count() }}</span>--></a> </li>
					<li class="active"><a data-toggle="tab" href="#menu1">{{ trans('lang.open')}} <!--<span class="badge bg-danger">{{ $job_details->count() }}</span>--></a></li>
					<!--<li><a data-toggle="tab" href="#menu2">{{ trans('lang.paused')}} <span class="badge bg-danger"></span></a></li>-->
					<li><a data-toggle="tab" href="#menu3">{{ trans('lang.work_in_progress')}} <!--<span class="badge bg-danger">{{ $ongoing_jobs->count() }}</span>--></a></li>
					<li><a data-toggle="tab" href="#menu4">{{ trans('lang.past')}} <!--<span class="badge bg-danger">{{ $completed_jobs->count() }}</span>--></a> </li>
					<li><a data-toggle="tab" href="#cancelled">{{ trans('lang.cancelled')}} <!--<span class="badge bg-danger">{{ $completed_jobs->count() }}</span>--></a> </li>
					
				</ul>

				<div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e2dbd1 1px solid">
					<div id="draft" class="tab-pane fade">
					@if (!empty($job_draft) && $job_draft->count() > 0)
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<!--<th>{{ trans('lang.proposals')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.average_bid')}}</th>-->
								<th>{{ trans('lang.budget')}}</th>
								<!--<th>Bid End Date</th>-->
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($job_draft as $job)
							@php
								$image = '';
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$proposals = \App\Proposal::where('job_id', $job->id)->where('status', '!=', 'cancelled')->get();
								if($proposals->count() > 0)
								{
									$total = 0;
									foreach($proposals as $proposal)
									{
										$total += $proposal->amount;
									}
									$avg = $total/$proposals->count();
									$avg = round($avg, 2);
								}
								
								$employer_img = \App\Profile::select('avater')->where('user_id', $job->employer->id)->first();
								$image = !empty($employer_img->avater) ? '/uploads/users/'.$job->employer->id.'/'.$employer_img->avater : '';
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{ route('employerdraftJob', $job->slug) }}">{{{ $job->title }}}</a></span></td>
								<!--<td data-th="Name"><span class="bt-content" style="display: flex;">
								<h4>{{{ $proposals->count() }}}</h4>
									@if ($proposals->count() > 0)
										<ul class="wt-hireduserimgs">
											@foreach ($proposals as $proposal)
												@php
													$profile = \App\User::find($proposal->provider_id)->profile;
													$user_image = !empty($profile) ? $profile->avater : '';
													$profile_image = !empty($user_image) ? '/uploads/users/'.$proposal->provider_id.'/'.$user_image : 'images/user-login.png';
												@endphp
												<li><figure><img src="{{{ asset($profile_image) }}}" alt="{{ trans('lang.profile_img') }}" class="mCS_img_loaded"></figure></li>
											@endforeach
										</ul>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if ($proposals->count() > 0)
									@if (!empty($job->price))
										<span class="wt-dashboraddoller"><i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i> {{{ number_format($avg) }}}</span>
									@endif
								@else
									{{ trans('lang.no_bid_yet')}}
								@endif

								</span></td>-->
								<td data-th="Slug"><span class="bt-content">
								@if (!empty($job->price))
									<span class="wt-dashboraddoller"><i>{{ Helper::getCurrencySymbol($job->currency) }}</i> {{{ number_format($job->price) }}}</span>
								@endif
								</span></td>
								<!--<td data-th="Slug"><span class="bt-content">{{{ $job->status }}}</span></td>-->
								<td data-th="Action"><span class="bt-content">
									<div class="">
										
										<a href="{{ route('employerdraftJob', $job->slug) }}"><button class="btn">{{ trans('lang.edit')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												@if ($proposals->count() > 0)
													<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" >{{ trans('lang.view')}}</a>
												@endif
												<a href="#">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						
						</tbody>
						
					</table>
					@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
					</div>
					<!--<div id="home" class="tab-pane fade ">
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>Project Name</th>
								<th>Type</th>
								<th>Budget</th>
								<th>Duration</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@if (!empty($job_details) && $job_details->count() > 0)
							@foreach ($job_details as $job)
							@php
								$image = '';
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$proposals = \App\Proposal::where('job_id', $job->id)->where('status', '!=', 'cancelled')->get();
								$employer_img = \App\Profile::select('avater')->where('user_id', $job->employer->id)->first();
								$image = !empty($employer_img->avater) ? '/uploads/users/'.$job->employer->id.'/'.$employer_img->avater : '';
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ url('job/'.$job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder"> {{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if (!empty($job->price))
									<span class="wt-dashboraddoller"><i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i> {{{ $job->price }}}</span>
								@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if (!empty($job->duration)  && !is_array($duration))
									<span class="wt-dashboradclock"><img class="wt-job-icon" src="{{asset('images/job-icons/job-duration.png')}}"> {{ trans('lang.duration') }} {{{ $duration }}}</span>
								@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">{{{ $job->status }}}</span></td>
								<td data-th="Action"><span class="bt-content">
									<div class="">
										
										<a href="#"><button class="btn">Edit</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												<a href="#">Delete</a>											
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
					</div>-->
					<div id="menu1" class="tab-pane fade in active">
					@if (!empty($job_details) && $job_details->count() > 0)
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.proposals')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.average_bid')}}</th>
								<th>{{ trans('lang.budget')}}</th>
								<!--<th>Bid End Date</th>-->
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($job_details as $job)
							@php
								$image = '';
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$proposals = \App\Proposal::where('job_id', $job->id)->where('status', '!=', 'cancelled')->get();
								if($proposals->count() > 0)
								{
									$total = 0;
									foreach($proposals as $proposal)
									{
										$total += $proposal->amount;
									}
									$avg = $total/$proposals->count();
									$avg = round($avg, 2);
								}
								
								$employer_img = \App\Profile::select('avater')->where('user_id', $job->employer->id)->first();
								$image = !empty($employer_img->avater) ? '/uploads/users/'.$job->employer->id.'/'.$employer_img->avater : '';
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
								<h4>{{{ $proposals->count() }}}</h4>
									@if ($proposals->count() > 0)
										<ul class="wt-hireduserimgs">
											@foreach ($proposals as $proposal)
												@php
													$profile = \App\User::find($proposal->provider_id)->profile;
													$user_image = !empty($profile) ? $profile->avater : '';
													$profile_image = !empty($user_image) ? '/uploads/users/'.$proposal->provider_id.'/'.$user_image : 'images/user-login.png';
												@endphp
												<li><figure><img src="{{{ asset($profile_image) }}}" alt="{{ trans('lang.profile_img') }}" class="mCS_img_loaded"></figure></li>
											@endforeach
										</ul>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if ($proposals->count() > 0)
									@if (!empty($job->price))
										<span class="wt-dashboraddoller"><i>{{ Helper::getCurrencySymbol($job->currency) }}</i> {{{ number_format($avg) }}}</span>
									@endif
								@else
									{{ trans('lang.no_bid_yet')}}
								@endif

								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if (!empty($job->price))
									<span class="wt-dashboraddoller"><i>{{ Helper::getCurrencySymbol($job->currency) }}</i> {{{ number_format($job->price) }}}</span>
								@endif
								</span></td>
								<!--<td data-th="Slug"><span class="bt-content">{{{ $job->status }}}</span></td>-->
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--@if ($proposals->count() > 0)
											<a href="{{{ url('employer/dashboard/job/'.$job->slug.'/proposals') }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										@endif
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												@if ($proposals->count() > 0)
													<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" >{{ trans('lang.view')}}</a>
												@endif
												<a href="#">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						
						</tbody>
						
					</table>
					@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
					</div>
					<div id="menu2" class="tab-pane fade">
					<!-- Paused table here -->
					</div>
					<div id="menu3" class="tab-pane fade">
					@if (!empty($ongoing_jobs) && $ongoing_jobs->count() > 0)
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.awarded_to')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.awarded_bid')}}</th>
								<th>{{ trans('lang.released_milestones')}}</th>
								<th>{{ trans('lang.deadline')}}</th>
								<th>{{ trans('lang.progress')}}</th>
								<th>{{ trans('lang.status')}}</th>
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($ongoing_jobs as $job)
							@php
								$accepted_proposal = array();
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$accepted_proposal = \App\Job::find($job->id)->proposals()->where('status', 'hired')->first();
								$provider_name = \App\Helper::getUserName($accepted_proposal->provider_id);
								$profile = \App\User::find($accepted_proposal->provider_id)->profile;
								$user_image = !empty($profile) ? $profile->avater : '';
								$profile_image = !empty($user_image) ? '/uploads/users/'.$accepted_proposal->provider_id.'/'.$user_image : 'images/user-login.png';
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{  url('proposal/'.$job->slug.'/'.$job->status) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
									<span>{{{ Helper::getUserName($accepted_proposal->provider_id) }}}</span>
									<ul class="wt-hireduserimgs">
										<li><figure><img src="{{{ asset(Helper::getProjectImage($user_image, $accepted_proposal->provider_id)) }}}" alt="{{{ trans('lang.provider') }}}"></figure></li>
									</ul>
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{Helper::getCurrencySymbol($job->currency)}} {{ $accepted_proposal->amount  }}
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{ trans('lang.released_milestones')}}
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if($job->delivery_type == 'date') 
									@php 
										$expiry = date('d-m-Y', strtotime($job->expiry_date));
									@endphp
									{{$expiry}}
									@elseif($job->delivery_type == 'time') 
										Month : {{ $job->month }} <br> Week : {{ $job->week }} <br>Day : {{ $job->day }} <br>Hour : {{ $job->hour }} 
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{ trans('lang.progress')}}
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									{{$job->status}}
								</span></td>
								<td data-th="Action" style="min-width: 130px;"><span class="bt-content">
									<div class="">
										<!--<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												<a href="{{{  url('proposal/'.$job->slug.'/'.$job->status) }}}" >{{ trans('lang.view')}}</a>
												<a href="#">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						
						</tbody>
						
					</table>
					@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
					</div>
					<div id="menu4" class="tab-pane fade">
					@if (!empty($completed_jobs) && $completed_jobs->count() > 0)
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.awarded_to')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.awarded_bid')}}</th>
								<th>{{ trans('lang.released_milestones')}}</th>
								<th>{{ trans('lang.finished_on')}}</th>
								<th>{{ trans('lang.experience')}}</th>
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($completed_jobs as $job)
							@php
								$accepted_proposal = \App\Job::find($job->id)->proposals()->where('status', 'completed')->first();
								$profile = \App\User::find($accepted_proposal->provider_id)->profile;
								$user_image = !empty($profile) ? $profile->avater : '';
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{  url('proposal/'.$job->slug.'/'.$job->status) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
									<span>{{{ Helper::getUserName($accepted_proposal->provider_id) }}}</span>
									<ul class="wt-hireduserimgs">
										<li><figure><img src="{{{ asset(Helper::getProjectImage($user_image, $accepted_proposal->provider_id)) }}}" alt="{{{ trans('lang.provider') }}}"></figure></li>
									</ul>
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{Helper::getCurrencySymbol($job->currency)}} {{ $accepted_proposal->amount  }}
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{ trans('lang.released_milestones')}}
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								{{ trans('lang.finished_on')}}
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									<span class="badge badge-secondary">4.9</span> <i class="fas fa-star"></i>
								</span></td>
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">												
												<a href="#">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						
						</tbody>
						
					</table>
					@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
					</div>
					<div id="cancelled" class="tab-pane fade">
					@if (!empty($cancelled_jobs) && $cancelled_jobs->count() > 0)
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								
								<th>{{ trans('lang.type')}}</th>
								
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($cancelled_jobs as $job)
							@php
								
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ route('cancelledJob', $job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">												
												<a href="#">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						
						</tbody>
						
					</table>
					@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
					</div>
					<div id="menu5" class="tab-pane fade">
					@if (!empty($approval_jobs) && $approval_jobs->count() > 0)
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.proposals')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.average_bid')}}</th>
								<th>{{ trans('lang.budget')}}</th>
								<!--<th>Bid End Date</th>-->
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($approval_jobs as $job)
							@php
								$image = '';
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$proposals = \App\Proposal::where('job_id', $job->id)->where('status', '!=', 'cancelled')->get();
								if($proposals->count() > 0)
								{
									$total = 0;
									foreach($proposals as $proposal)
									{
										$total += $proposal->amount;
									}
									$avg = $total/$proposals->count();
									$avg = round($avg, 2);
								}
								
								$employer_img = \App\Profile::select('avater')->where('user_id', $job->employer->id)->first();
								$image = !empty($employer_img->avater) ? '/uploads/users/'.$job->employer->id.'/'.$employer_img->avater : '';
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ route('approvalJob', $job->slug) }}}">{{{ $job->title }}}</a></span></td>
								<td data-th="Name"><span class="bt-content" style="display: flex;">
								<h4>{{{ $proposals->count() }}}</h4>
									@if ($proposals->count() > 0)
										<ul class="wt-hireduserimgs">
											@foreach ($proposals as $proposal)
												@php
													$profile = \App\User::find($proposal->provider_id)->profile;
													$user_image = !empty($profile) ? $profile->avater : '';
													$profile_image = !empty($user_image) ? '/uploads/users/'.$proposal->provider_id.'/'.$user_image : 'images/user-login.png';
												@endphp
												<li><figure><img src="{{{ asset($profile_image) }}}" alt="{{ trans('lang.profile_img') }}" class="mCS_img_loaded"></figure></li>
											@endforeach
										</ul>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if ($proposals->count() > 0)
									@if (!empty($job->price))
										<span class="wt-dashboraddoller"><i>{{Helper::getCurrencySymbol($job->currency)}}</i> {{{ number_format($avg) }}}</span>
									@endif
								@else
									{{ trans('lang.no_bid_yet')}}
								@endif

								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if (!empty($job->price))
									<span class="wt-dashboraddoller"><i>{{Helper::getCurrencySymbol($job->currency)}}</i> {{{ number_format($job->price) }}}</span>
								@endif
								</span></td>
								<!--<td data-th="Slug"><span class="bt-content">{{{ $job->status }}}</span></td>-->
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--@if ($proposals->count() > 0)
											<a href="{{{ url('employer/dashboard/job/'.$job->slug.'/proposals') }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										@endif
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ route('approvalJob', $job->slug) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												
													<!--<a href="{{{ route('approvalJob', $job->slug) }}}" >{{ trans('lang.view')}}</a>-->
												
												<a href="#">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						
						</tbody>
						
					</table>
					@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
					</div>
					<div id="menu6" class="tab-pane fade">
					@if (!empty($rejected_jobs) && $rejected_jobs->count() > 0)
					<table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
									ID
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.average_bid')}}</th>
								<th>{{ trans('lang.budget')}}</th>
								<!--<th>Bid End Date</th>-->
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($rejected_jobs as $job)
							@php
								$image = '';
								$duration  =  \App\Helper::getJobDurationList($job->duration);
								$user_name = $job->employer->first_name.' '.$job->employer->last_name;
								$proposals = \App\Proposal::where('job_id', $job->id)->where('status', '!=', 'cancelled')->get();
								if($proposals->count() > 0)
								{
									$total = 0;
									foreach($proposals as $proposal)
									{
										$total += $proposal->amount;
									}
									$avg = $total/$proposals->count();
									$avg = round($avg, 2);
								}
								
								$employer_img = \App\Profile::select('avater')->where('user_id', $job->employer->id)->first();
								$image = !empty($employer_img->avater) ? '/uploads/users/'.$job->employer->id.'/'.$employer_img->avater : '';
								$verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
								$project_type  = Helper::getProjectTypeList($job->project_type);
							@endphp
							<tr>
								<td>
								{{{ $job->id }}}	
								</td>								
								<td data-th="Name"><span class="bt-content"><a href="{{{ route('approvalJob', $job->slug) }}}">{{{ $job->title }}}</a></span></td>
								
								<td data-th="Slug"><span class="bt-content">
									@if (!empty($job->project_type))
									<a href="javascript:void(0);" class="wt-clicksavefolder">{{{ $project_type }}}</a>
									@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if ($proposals->count() > 0)
									@if (!empty($job->price))
										<span class="wt-dashboraddoller"><i>{{ Helper::getCurrencySymbol($job->currency) }}</i> {{{ number_format($avg) }}}</span>
									@endif
								@else
									{{ trans('lang.no_bid_yet')}}
								@endif

								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if (!empty($job->price))
									<span class="wt-dashboraddoller"><i>{{ Helper::getCurrencySymbol($job->currency) }}</i> {{{ number_format($job->price) }}}</span>
								@endif
								</span></td>
								<!--<td data-th="Slug"><span class="bt-content">{{{ $job->status }}}</span></td>-->
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--@if ($proposals->count() > 0)
											<a href="{{{ url('employer/dashboard/job/'.$job->slug.'/proposals') }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										@endif
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ route('approvalJob', $job->slug) }}}"><button class="btn">{{ trans('lang.view')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												@if ($proposals->count() > 0)
													<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" >{{ trans('lang.view')}}</a>
												@endif
												<a href="#">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
							@endforeach
						
						</tbody>
						
					</table>
					@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						@endif
					</div>

				</div>
			</div>

	
		</div>
	</div> 
@endsection
@push('scripts')
<script>
	$(document).ready(function(){

if(window.location.hash != "") {
    //$('a[href="' + window.location.hash + '"]').click();
    var hashes = location.hash.split('-'); 
    
    $('a[href="' + hashes[0] + '"]').click();
    //var chat = hashes[1].replace('#', '');
   // document.onreadystatechange = () => {
  //if (document.readyState == "complete") {
   // var d = document.getElementById("wt-chat-" + chat);
    //d.className += ' wt-active'
  //}
//}
    
    //var message_center = document.getElementById("message-start").chat = chat;
    //console.log(message_center);
    //$("#wt-chat-" + chat).addClass('wt-active');
    //$("#wt-chat-" + chat).removeClass('wt-ad');
}

});
</script>
@endpush
