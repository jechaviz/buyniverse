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
	<div class="wt-haslayout wt-dbsectionspace la-manage-jobs-holder">
	<div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.services_listing')}}</li>
                            </ol>
                        </div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-right" id="services">
				<div class="preloader-section" v-if="loading" v-cloak>
					<div class="preloader-holder">
						<div class="loader"></div>
					</div>
				</div>
				<div class="wt-dashboardbox wt-dashboardservcies">
					<div class="wt-dashboardboxtitle wt-titlewithsearch">
						<h2>{{ trans('lang.services_listing') }}</h2>
					</div>
					<div class="wt-dashboardboxcontent wt-categoriescontentholder">
						@if ($services->count() > 0)
							<table class="wt-tablecategories wt-tableservice">
								<thead>
									<tr>
										<th>{{ trans('lang.service_title') }}</th>
										<th>{{ trans('lang.service_status') }}</th>
										<th>{{ trans('lang.in_queue') }}</th>
										<th style="width: 10%;">{{ trans('lang.action') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($services as $service)
										@php 
											$attachment = Helper::getUnserializeData($service['attachments']); 
											$total_orders = Helper::getServiceCount($service['id'], 'hired');
										@endphp
										<tr class="del-{{{ $service['status'] }}}">
											<td data-th="Service Title">
												<span class="bt-content">
													<div class="wt-service-tabel">
														@if ($service->seller->count() > 0)
															@if (!empty($attachment))
																<figure class="service-feature-image"><img src="{{{asset( Helper::getImage('uploads/services/'.$service->seller[0]->id, $attachment[0], 'small-', 'small-service.jpg'))}}}" alt="{{{$service['title']}}}"></figure>
															@endif
														@endif
														<div class="wt-providers-content">
															<div class="dc-title">
																@if ($service['is_featured'] == 'true')
																	<span class="wt-featuredtagvtwo">Featured</span>
																@endif
																<h3>{{{$service['title']}}}</h3>
																<span><strong>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}{{{$service['price']}}}</strong> {{ trans('lang.starting_from') }}</span>
															</div>
														</div>
													</div>
												</span>
											</td>
											<td data-th="Service Status">
												<span class="bt-content">
													<form class="wt-formtheme wt-formsearch" id="change_job_status">
														<fieldset>
															<div class="form-group">
																<span class="wt-select">
																	<select name="status" id="{{ $service->id }}-service_status" data-placeholder="{{ trans('lang.select_status') }}">
																		@foreach ($status_list as $key => $value)
																			<option value="{{ $key }}" {{ $service['status'] == $key ? 'selected' : '' }}>{{ $value }}</option>
																		@endforeach
																	</select>
																</span>
																<a href="javascrip:void(0);" class="wt-searchgbtn job_status_popup" @click.prevent='changeStatus({{$service->id}})'><i class="fa fa-check"></i></a>
															</div>
														</fieldset>
													</form>
												</span>
											</td>
											<td data-th="In Queue">
												<span class="bt-content">
													<span>
														@if ($total_orders > 0)
															<i class="fa fa-spinner fa-spin"></i> 
														@endif
														{{{$total_orders}}} {{ trans('lang.in_queue') }}
													</span>
												</span>
											</td>
											<td data-th="Action">
												<span class="bt-content">
												<div>
													<a href="{{{route('serviceDetail',$service['slug'])}}}"><button class="btn">View</button></a>
													<div class="dropdown">
														<button class="btn" style="border-left:1px solid #b4b1b1">
															<i class="fa fa-caret-down"></i>
														</button>
														<div class="dropdown-content">
															<a href="{{{route('edit_service',$service['id'])}}}" >Edit</a>
															@if ($total_orders == 0)
																<delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $service['id'] }}'" :message="'{{trans("lang.ph_service_delete_message")}}'" :url="'{{url('provider/dashboard/delete-service')}}'"></delete>
															@endif											
														</div>
													</div>
												</div>
													<!--<div class="wt-actionbtn">
														<a href="{{{route('serviceDetail',$service['slug'])}}}" class="wt-viewinfo">
															<i class="lnr lnr-eye"></i>
														</a>
														<a href="{{{route('edit_service',$service['id'])}}}" class="wt-addinfo wt-skillsaddinfo">
															<i class="lnr lnr-pencil"></i>
														</a>
														@if ($total_orders == 0)
															<delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $service['id'] }}'" :message="'{{trans("lang.ph_service_delete_message")}}'" :url="'{{url('provider/dashboard/delete-service')}}'"></delete>
														@endif
													</div>-->
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
						@if ( method_exists($services,'links') ) {{ $services->links('pagination.custom') }} @endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
