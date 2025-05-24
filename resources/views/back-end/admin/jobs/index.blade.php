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
    <div class="wt-haslayout wt-dbsectionspace" id="jobs">
        <div class="preloader-section" v-if="loading" v-cloak>
            <div class="preloader-holder">
                <div class="loader"></div>
            </div>
        </div>
        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        <h2>{{ trans('lang.all_jobs') }}</h2>
						<form action="{{ url('admin/jobs/search') }}" class="wt-formtheme wt-formsearch" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset>
                            <div class="form-group">
                                <input type="text" name="keyword" value="{{{ request()->query('keyword', '') }}}"
                                    class="form-control" placeholder="{{{ trans('lang.ph_search_jobs') }}}">
                                <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                            </div>
                        </fieldset>
                        </form>
                    </div>
                    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.all_jobs')}}</li>
                            </ol>
                        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-dashboardbox la-alljob-holder">
                    
                    
                    @if (!empty($jobs) && $jobs->count() > 0)
                    <table class="wt-tablecategories">
						<thead>
							<tr>
								<th>
                                {{ trans('lang.id')}}
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.proposals')}}</th>
								<th>{{ trans('lang.type')}}</th>
								<th>{{ trans('lang.average_bid')}}</th>
								<th>{{ trans('lang.budget')}}</th>
								<th>{{ trans('lang.status')}}</th>
								<th style="width: 130px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach ($jobs as $job)
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
										<span class="wt-dashboraddoller"><i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i> {{{ $avg }}}</span>
									@endif
								@else
                                {{ trans('lang.no_bid_yet')}}
								@endif

								</span></td>
								<td data-th="Slug"><span class="bt-content">
								@if (!empty($job->price))
									<span class="wt-dashboraddoller"><i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i> {{{ $job->price }}}</span>
								@endif
								</span></td>
								<td data-th="Slug"><span class="bt-content">{{{ $job->status }}}</span></td>
								<td data-th="Action"><span class="bt-content">
									<div class="">
										<!--@if ($proposals->count() > 0)
											<a href="{{{ url('employer/dashboard/job/'.$job->slug.'/proposals') }}}" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
										@endif
										<a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
										<a href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>-->
										<a href="{{{ url('job/edit-job/'.$job->slug) }}}"><button class="btn">{{ trans('lang.edit')}}</button></a>
										<div class="dropdown">
											<button class="btn" style="border-left:1px solid #b4b1b1">
												<i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
												@if ($proposals->count() > 0)
													<a href="{{{ url('proposal/'.$job->slug.'/'.$job->status) }}}" >{{ trans('lang.view')}}</a>
												@endif
                                                @if (!empty($cancel_proposal) && Helper::getOrderPayout($cancel_proposal->id)->count() == 0)
                                                            <a href="javascript:void(0);"  v-on:click.prevent="showRefoundForm({{ $job->id }})"  class="wt-btn"><span>{{ trans('lang.refund_now') }}</span></a>
                                                        @endif
												<a href="javascript:void(0);" v-on:click.prevent="deleteJob({{$job->id}})">{{ trans('lang.delete')}}</a>											
											</div>
										</div>
									</div>
								</span></td>
							</tr>
                            <b-modal ref="myModalRef-{{ $job->id }}" hide-footer title="Refund" v-cloak>
                                <div class="d-block text-center">
									<form action="" class="wt-formtheme" id="submit_refund_{{ $job->id }}" @submit.prevent="submitRefund({{$job->id}})">
									@csrf
                                        <fieldset>
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    <select id="refundable_user_id-{{$job->id}}" class="form-control" placeholder="{{ trans('lang.select_users') }}" v-model="refundable_user">
                                                        <option value="">{{ trans('lang.select_users') }}</option>
                                                        @if (!empty($job->employer))
                                                            <option value="{{$job->employer->id}}">{{ trans('lang.search_filter_list.employers_val') }}</option>
                                                        @endif
                                                        @if (!empty($cancel_proposal))
                                                            <option value="{{$cancel_proposal->provider_id}}">{{ trans('lang.search_filter_list.provider_val') }}</option>
                                                        @endif
                                                    </select>
                                                </span>
                                            </div>
                                            @if (!empty($cancel_proposal))
                                                <input type="hidden" value="{{$cancel_proposal->amount}}" id="refundable-amount-{{$job->id}}">
                                                <input type="hidden" value="{{$cancel_proposal->id}}" id="refundable-order-id-{{$job->id}}">
                                            @endif
                                            <input type="hidden" value="{{$job->id}}" id="refundable-job-id-{{$job->id}}">

                                            <div class="form-group wt-btnarea">
												<input type="submit" value="{{ trans('lang.refund') }}" class="wt-btn">
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </b-modal>
							@endforeach
						@else
							@if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
						
						</tbody>
					</table>
                    @endif
                    @if ( method_exists($jobs,'links') ) {{ $jobs->links('pagination.custom') }} @endif
                </div>
            </div>
        </div>
    </div>
@endsection
