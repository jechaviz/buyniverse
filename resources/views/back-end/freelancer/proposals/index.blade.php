@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="wt-haslayout wt-dbsectionspace">
    
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="proposals">
            <h2>{{ trans('lang.all_proposals') }}</h2>
            <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.all_proposals')}}</li>
                            </ol>
                        </div>  
                <div class="wt-dashboardbox">
                    
                    

                    <table class="wt-tablecategories">
                        <!--{{!empty($proposals)}} -->
						@if (!empty($proposals))
						<thead>
							<tr>
								<th>
                                {{ trans('lang.project_id')}}
								</th>
								
								<th>{{ trans('lang.project_name')}}</th>
								<th>{{ trans('lang.posted_by')}}</th>
								<th>{{ trans('lang.budget')}}</th>
                                <th>{{ trans('lang.bid_amount')}}</th>
								<th>{{ trans('lang.duration')}}</th>							
                                <th>{{ trans('lang.status')}}</th>
								<th style="width: 230px;">{{ trans('lang.action')}}</th>
							</tr>
						</thead>
						<tbody>
                            
                            @foreach ($proposals as $proposal)
                                @php
                                    $provider_proposal = \App\Proposal::find($proposal->id);
                                    $duration = Helper::getJobDurationList($proposal->job->duration);
                                    $status_btn = $proposal->status == 'cancelled' ? trans('lang.view_reason') : trans('lang.view_detail');
                                    $detail_link = $proposal->status == 'hired' ? url('provider/job/'.$proposal->job->slug) : 'javascript:void(0);';
                                    $user_name = Helper::getUserName($proposal->job->employer->id);
                                @endphp
                            <tr>
                                <td>{{ $proposal->job->id }}</td>
                                <td>{{ $proposal->job->title }}</td>
                                <td>
                                    @if (!empty($user_name))
                                    <a href="{{{ url('profile/'.$proposal->job->employer->slug) }}}">
                                        @if ($proposal->job->employer->user_verified === 1)
                                            <i class="fa fa-check-circle"></i>
                                        @endif
                                        &nbsp;{{{ $user_name }}}</a>
                                    @endif
                                </td>
                                <td><i class="wt-viewjobdollar">{{ Helper::getCurrencySymbol($proposal->job->currency) }}</i> {{ number_format($proposal->job->price) }}</td>
                                <td><i class="wt-viewjobdollar">{{ Helper::getCurrencySymbol($proposal->job->currency) }}</i> {{ number_format($freelancer_proposal->amount) }}</td>
                                <td>
                                    @foreach($project_duration as $key => $value)
                                        @if($key == $proposal->job->duration)
                                        <span >{{ $value }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{{ Helper::displayProposalStatus($proposal->status) }}}</td>
                                <td>
                                    @if ( $proposal->status == 'pending' )
                                    <a href="{{{ url('job/'.$proposal->job->slug) }}}" class="wt-btn" style="background-color: #ffffff!important;color: #b4b1b1;font-size: 12px;border: 1px solid #b4b1b1;outline: none;border-radius: 0;padding: 5px 10px;font: inherit;">
                                        {{ trans('lang.edit')}}
                                    </a>
                                    @endif
                                    @if ( $proposal->status != 'pending' )
                                        <a href="{{{ url('provider/job/'.$proposal->job->slug) }}}" class="wt-btn"  style="background-color: #ffffff!important;color: #b4b1b1;font-size: 12px;border: 1px solid #b4b1b1;outline: none;border-radius: 0;padding: 5px 10px;font: inherit;">
                                            {{$status_btn}}
                                        </a>
                                    @else
                                        @if($proposal->contest == 'true')
                                        <a href="{{{ url('provider/contest/'.$proposal->contestid) }}}" class="wt-btn" style="background-color: #ffffff!important;color: #b4b1b1;font-size: 12px;border: 1px solid #b4b1b1;outline: none;border-radius: 0;padding: 5px 10px;font: inherit;">
                                        {{ trans('lang.view_contest')}}
                                        </a>
                                        @endif
                                    @endif
                                    
                                </td>
                                
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
@endsection
