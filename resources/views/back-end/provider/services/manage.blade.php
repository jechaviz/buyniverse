@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
	@if (session()->has('project_type'))
		@php session()->forget('project_type'); @endphp
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
		.fade {
			opacity: 1!important;
		}
		#__BVID__12___BV_modal_content_ {
			margin-top: 200px;
		}
		#__BVID__13___BV_modal_content_ {
			margin-top: 200px;
		}
	</style>
	<div class="wt-haslayout wt-dbsectionspace la-manage-jobs-holder">
	<div class="row">
		<h3 style="width:50%">{{ trans('lang.manage_services')}}
		</h3>
		
	</div>
	<div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
		<ol class="wt-breadcrumb">
			<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
			<li class="active">{{ trans('lang.manage_services')}}</li>
		</ol>
	</div>
	<div class="row" style="margin-top:30px;" id="services">
		<ul class="nav nav-tabs" style="width: 100%;">
			<li class="active"><a data-toggle="tab" href="#menu1">{{ trans('lang.hired')}}</a></li>
			<li><a data-toggle="tab" href="#menu2">{{ trans('lang.completed')}}</a></li>
			<li><a data-toggle="tab" href="#menu3">{{ trans('lang.cancelled')}} </a></li>
			
		</ul>

		<div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e2dbd1 1px solid">
			<div id="menu1" class="tab-pane fade in active">
			@if ($hired_services->count() > 0)
				<table class="wt-tablecategories wt-tableservice">
					<thead>
						<tr>
							<th>{{ trans('lang.service_title') }}</th>
							<th>{{ trans('lang.offered_by') }}</th>
							<th  style="width: 130px;">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($hired_services as $service)
							@php 
								$seller = Helper::getServiceSeller($service->id);
								$provider = App\User::find($seller->user_id);
								$attachment = Helper::getUnserializeData($service->attachments);
							@endphp
							<tr class="del-hired">
								<td data-th="Service Title">
									<span class="bt-content">
										<div class="wt-service-tabel">
											@if (!empty($provider))
												@if (!empty($attachment))
													<figure class="service-feature-image"><img src="{{{asset(Helper::getImage('uploads/services/'.$provider->id, $attachment[0], 'medium-', 'small-service.jpg'))}}}" alt="{{{$service->title}}}"></figure>
												@endif
											@endif
											<div class="wt-freelancers-content">
												<div class="dc-title">
													@if ($service->is_featured == 'true')
														<span class="wt-featuredtagvtwo">{{ trans('lang.featured') }}</span>
													@endif
													<h3>{{{$service->title}}}</h3>
													<span><strong>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}{{{$service->price}}}</strong> {{ trans('lang.starting_from') }}</span>
												</div>
											</div>
										</div>
									</span>
								</td>
								<td>
									@if (!empty($provider))
										<span class="bt-content">
											<div class="wt-userlistingsingle">
												<figure class="wt-userlistingimg">
													<img src="{{{url(Helper::getProfileImage($provider->id))}}}" alt="image description">
												</figure>
												<div class="wt-userlistingcontent">
													<div class="wt-contenthead wt-followcomhead">
													<div class="wt-title">
														<a href="{{{url('profile/'.$provider->slug)}}}">
															@if ($provider->user_verified)
																<i class="fa fa-check-circle"></i> {{{Helper::getUserName($provider->id)}}}
															@endif
														</a>
														<h3>{{{$provider->profile->tagline}}}</h3>
													</div>
													</div>
												</div>
											</div>
										</span>
									@endif
								</td>
								<td data-th="Action">
									<span class="bt-content">
										<div class="">
											<a href="{{{url('provider/service/'.$service->pivot_id.'/hired')}}}" class="wt-btn" style="background-color: rgb(255, 255, 255) !important; color: rgb(180, 177, 177); font: inherit; border: 1px solid rgb(180, 177, 177); outline: none; border-radius: 0px; padding: 5px 10px;">{{ trans('lang.view') }}</a>
										</div>
									</span>
								</td>
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
			@if ($completed_services->count() > 0)
				<table class="wt-tablecategories wt-tableservice">
					<thead>
						<tr>
							<th>{{ trans('lang.service_title') }}</th>
							<th>{{ trans('lang.offered_by') }}</th>
							<th>{{ trans('lang.rating') }}</th>
							<th>{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($completed_services as $service)
							@php 
							$attachment = Helper::getUnserializeData($service->attachments); 
							$seller = Helper::getServiceSeller($service->id);
							$provider = App\User::find($seller->user_id);
							$review = Helper::getEmployerServiceReview($service->pivot_user, $service->pivot_id);
							$stars  = $review->avg_rating != 0 ? $review->avg_rating/5*100 : 0;
							$service_reviews = Helper::getUnserializeData($review->rating);
							@endphp
							<tr class="del-completed">
								<td data-th="Service Title">
									<span class="bt-content">
										<div class="wt-service-tabel">
											@if (!empty($attachment))
												<figure class="service-feature-image"><img src="{{{asset(Helper::getImage('uploads/services/'.$provider->id, $attachment[0], 'medium-', 'small-service.jpg'))}}}" alt="{{{$service->title}}}"></figure>
											@endif
											<div class="wt-freelancers-content">
												<div class="dc-title">
													@if ($service->is_featured == 'true')
														<span class="wt-featuredtagvtwo">{{ trans('lang.featured') }}</span>
													@endif
													<h3>{{{$service->title}}}</h3>
													<span><strong>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}{{{$service->price}}}</strong> {{ trans('lang.starting_from') }}</span>
												</div>
											</div>
										</div>
									</span>
								</td>
								<td>
									<span class="bt-content">
										<div class="wt-userlistingsingle">
											<figure class="wt-userlistingimg">
												<img src="{{{url(Helper::getProfileImage($provider->id))}}}" alt="image description">
											</figure>
											<div class="wt-userlistingcontent">
												<div class="wt-contenthead wt-followcomhead">
												<div class="wt-title">
													<a href="{{{url('profile/'.$provider->slug)}}}">
														@if ($provider->user_verified)
															<i class="fa fa-check-circle"></i> {{{Helper::getUserName($provider->id)}}}
														@endif
													</a>
													<h3>{{{$provider->profile->tagline}}}</h3>
												</div>
												</div>
											</div>
										</div>
									</span>
								</td>
								<td>
									<div class="user-stars-v2">
										<span class="wt-stars"><span style="width: {{ $stars }}%;"></span></span>
										<a href="javascript:void(0);" class="wt-ratinginfo" v-on:click.prevent="showReview('{{ $service->pivot_id }}')">
											<i class="fa fa-question-circle"></i>
										</a>
									</div>
								</td>
								<td data-th="Action">
									<span class="bt-content">
										<div class="">
											<a href="{{{url('provider/service/'.$service->pivot_id.'/completed')}}}" class="wt-btn" style="background-color: rgb(255, 255, 255) !important; color: rgb(180, 177, 177); font: inherit; border: 1px solid rgb(180, 177, 177); outline: none; border-radius: 0px; padding: 5px 10px;">{{ trans('lang.view') }}</a>
										</div>
									</span>
								</td>
							</tr>
							@if (!empty($review))
								<b-modal ref="myModalRef-{{ $service->pivot_id }}" class="wt-uploadrating" hide-footer title="{{{trans('lang.service_feedback')}}}" v-cloak>
									<div class="wt-modalbody modal-body">
										<div class="wt-description">
											<p>{{{$review->feedback}}}</p>
										</div>
										<div class="wt-formtheme wt-formfeedback">
											<fieldset>
												@foreach ($service_reviews as $review)
													@php 
														$stars  = $review['rating'] != 0 ? $review['rating']/5*100 : 0; 
														$reason = Helper::getReviewReasons($review['reason']);
													@endphp
												<div class="form-group wt-ratingholder">
													<div class="wt-ratepoints">
														<div class="counter wt-pointscounter">{{{$review['rating']}}}</div>
														<span class="wt-stars"><span style="width: {{ $stars }}%;"></span></span>
													</div>
													<span class="wt-ratingdescription">{{{$reason->title}}}</span>
												</div>
												@endforeach
											</fieldset>
										</div>
									</div>
								</b-modal>	
							@endif
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
			<div id="menu3" class="tab-pane fade">
			@if ($cancelled_services->count() > 0)
				<table class="wt-tablecategories wt-tableservice">
					<thead>
						<tr>
							<th>{{ trans('lang.service_title') }}</th>
							<th>{{ trans('lang.offered_by') }}</th>
							<th>{{ trans('lang.rating') }}</th>
							<th>{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($cancelled_services as $service)
							@php 
								$attachment = Helper::getUnserializeData($service->attachments); 
								$seller = Helper::getServiceSeller($service->id);
								$provider = App\User::find($seller->user_id);
								$report = Helper::getPivotServiceReport($service->pivot_id);
							@endphp
							<tr class="del-cancelled">
								<td data-th="Service Title">
									<span class="bt-content">
										<div class="wt-service-tabel">
											@if (!empty($attachment))
												<figure class="service-feature-image"><img src="{{{asset(Helper::getImage('uploads/services/'.$provider->id, $attachment[0], 'medium-', 'small-service.jpg'))}}}" alt="{{{$service->title}}}"></figure>
											@endif
											<div class="wt-freelancers-content">
												<div class="dc-title">
													@if ($service->is_featured == 'true')
														<span class="wt-featuredtagvtwo">{{ trans('lang.featured') }}</span>
													@endif
													<h3>{{{$service->title}}}</h3>
													<span><strong>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}{{{$service->price}}}</strong> {{ trans('lang.starting_from') }}</span>
												</div>
											</div>
										</div>
									</span>
								</td>
								<td>
									<span class="bt-content">
										<div class="wt-userlistingsingle">
											<figure class="wt-userlistingimg">
												<img src="{{{url(Helper::getProfileImage($provider->id))}}}" alt="image description">
											</figure>
											<div class="wt-userlistingcontent">
												<div class="wt-contenthead wt-followcomhead">
												<div class="wt-title">
													<a href="{{{url('profile/'.$provider->slug)}}}">
														@if ($provider->user_verified)
															<i class="fa fa-check-circle"></i> {{{Helper::getUserName($provider->id)}}}
														@endif
													</a>
													<h3>{{{$provider->profile->tagline}}}</h3>
												</div>
												</div>
											</div>
										</div>
									</span>
								</td>
								<td>
									<span class="bt-content">
										<div class="wt-actionbtn">
											<a href="javascript:void(0);" v-on:click.prevent="showReview('{{ $service->pivot_id }}')" class="wt-viewinfo wt-btnhistory wt-reasonbtn">{{ trans('lang.reason') }}</a>
										</div>
									</span>
								</td>
								<td data-th="Action">
									<span class="bt-content">
										<div class="">
											<a href="{{{url('provider/service/'.$service->pivot_id.'/cancelled')}}}" class="wt-btn" style="background-color: rgb(255, 255, 255) !important; color: rgb(180, 177, 177); font: inherit; border: 1px solid rgb(180, 177, 177); outline: none; border-radius: 0px; padding: 5px 10px;">{{ trans('lang.view') }}</a>
										</div>
									</span>
								</td>
							</tr>
							<b-modal ref="myModalRef-{{ $service->pivot_id }}" class="wt-uploadrating" hide-footer title="{{{trans('lang.rejection_reason')}}}" v-cloak>
								<div class="wt-modalbody modal-body">
									<div class="wt-description">
										<p>{{{$report->description}}}</p>
									</div>
								</div>
							</b-modal>		
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
@endsection
