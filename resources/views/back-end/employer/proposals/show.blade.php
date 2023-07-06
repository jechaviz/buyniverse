@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @php
        $count = 0;
        if($accepted_proposal)
        $reviews = \App\Review::where('receiver_id', $accepted_proposal->freelancer_id)->count();
        $verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
        $project_type  = Helper::getProjectTypeList($job->project_type);
    @endphp
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
	</style>
    
    
    <section class="wt-haslayout wt-dbsectionspace" id="jobs">
        <div class="preloader-section" v-if="loading" v-cloak>
            <div class="preloader-holder">
                <div class="loader"></div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                @if (Session::has('success'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('success') }}}'" v-cloak></flash_messages>
                    </div>
                    @php session()->forget('success'); @endphp
                @elseif (Session::has('error'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
                    </div>
                @endif
                
                
                <!-- New design -->
                @php
			$user = !empty(Auth::user()) ? Auth::user() : '';
			$role = !empty($user) ? $user->role : array();
			@endphp
			<div class="row">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
					<li><a href="{{{ url($role.'/dashboard') }}}">{{ trans('lang.dashboard') }}</a></li>
                    <li><a href="{{{ url($role.'/dashboard/manage-jobs') }}}">{{ trans('lang.jobs')}}</a></li>
					<li class="active">{{ trans('lang.job')}}</li>
				</ol>
			</div>
                <div class="row">
                    <div class="md-2" style="font-size: 70px;color: gold;">
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <div class="md-10" style="margin-left: 15px;">
                        <h2> {{{ $job->title }}}</h2>
                        
                        <h4>{{ trans('lang.project_id') }} : # {{{ $job->id }}}</h4>
                    </div>
                </div>
                
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
                        <li class="active"><a data-toggle="tab" href="#overview">{{ trans('lang.overview') }} <!--<span class="badge bg-danger"></span>--></a></li>
                        <!--<li><a data-toggle="tab" href="#menu1">Details <span class="badge bg-danger"></span></a></li>-->
                        <li><a data-toggle="tab" href="#menu2">{{ trans('lang.files') }} <!--<span class="badge bg-danger">{{$job->files}}</span>--></a></li>
                        <li><a data-toggle="tab" href="#menu3">{{ trans('lang.proposals') }} <!--<span class="badge bg-danger">{{$job->proposals}}</span>--></a></li>
                        <!--<li><a data-toggle="tab" href="#menu4">{{ trans('lang.payments') }} </a> </li>-->
                        <li><a data-toggle="tab" href="#task-component">{{ trans('lang.tasks') }} <!--<span class="badge bg-danger">{{$job->tasks}}</span>--></a> </li>
                        @if($role != 'admin')
                        <li><a data-toggle="tab" href="#menu6">{{ trans('lang.chats') }} <!--<span class="badge bg-danger"></span>--></a> </li>
                        @endif
                        <li><a data-toggle="tab" href="#menu7">{{ trans('lang.tickets') }} <!--<span class="badge bg-danger">{{$job->tickets}}</span>--></a> </li>
                        <li><a data-toggle="tab" href="#menu8">{{ trans('lang.notes') }} <!--<span class="badge bg-danger">{{$job->notes}}</span>--></a> </li>
                        <!--<li><a data-toggle="tab" href="#menu9">{{ trans('lang.financial') }} <span class="badge bg-danger"></span></a> </li>-->
                        <!--<li><a data-toggle="tab" href="#menu10">{{ trans('lang.quiz') }} <span class="badge bg-danger"></span></a> </li>-->
                        <!--<li><a data-toggle="tab" href="#provider">{{ trans('lang.freelancer') }} <span class="badge bg-danger"></span></a> </li>-->
                    </ul>

                    <div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e4dede 1px solid;">
                        
                        <div id="overview" class="tab-pane fade in active">
                        <!--<jobshow jobid = "{{ $job->id }}"></jobshow>-->
                        <joboverview jobid = "{{ $job->id }}" isapprover="{{ $job->approver }}" userid = "{{ Auth::user()->id }}"></joboverview>
                        
                            
                        </div>
                        <div id="menu2" class="tab-pane fade" style="">
                            <job_file jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_file>
                        </div>
                        <div id="menu3" class="tab-pane fade" style="background-color: #f7f7f7;">
                            <div class="row" style="margin: 0px;">
                                <ul class="nav nav-tabs" style="width: 100%;">
                                    <li id="sproposals" class="active"><a data-toggle="tab" href="#proposals">{{ trans('lang.proposals') }}</a></li>
                                    <li id="sproviders"><a data-toggle="tab" href="#providers">{{ trans('lang.freelancers') }} </a></li>
                                    <li id="scontest"><a data-toggle="tab" href="#contest">{{ trans('lang.contest') }} </a></li>
                                    <li id="sinvited"><a data-toggle="tab" href="#invited">{{ trans('lang.invited') }} </a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div id="proposals" class="tab-pane fade in active">
                                    <div class="">
                                    

                                    @if (!empty($proposals))                                   
                                    @if($accepted_proposal)
                                    <div class="wt-userlistingholder wt-userlisting wt-haslayout" style="padding: 20px;background-color: #f7f7f7;">
                                    

                                        @php
                                        
                                            $user = \App\User::find($accepted_proposal->freelancer_id);
                                            $profile = \App\User::find($accepted_proposal->freelancer_id)->profile;
                                            $user_image = !empty($profile) ? $profile->avater : '';
                                            $flag = !empty($user->location->flag) ? Helper::getLocationFlag($user->location->flag) :
                                                        '/images/img-01.png';
                                            $profile_image = !empty($user_image) ? '/uploads/users/'.$accepted_proposal->freelancer_id.'/'.$user_image : 'images/user-login.png';
                                            $user_name = Helper::getUserName($user->id);
                                            $feedbacks = \App\Review::select('feedback')->where('receiver_id', $user->id)->count();
                                            $avg_rating = App\Review::where('receiver_id', $user->id)->sum('avg_rating');
                                            $rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                                            $reviews = \App\Review::where('receiver_id', $user->id)->get();
                                            $stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                                            $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                                            $completion_time = !empty($accepted_proposal->completion_time) ? \App\Helper::getJobDurationList($accepted_proposal->completion_time) : '';
                                            $p_attachments = !empty($accepted_proposal->attachments) ? unserialize($accepted_proposal->attachments) : '';
                                            $badge = Helper::getUserBadge($user->id);
                                            if (!empty($enable_package) && $enable_package === 'true') {
                                                $feature_class = !empty($badge) ? 'wt-featured' : '';
                                                $badge_color = !empty($badge) ? $badge->color : '';
                                                $badge_img  = !empty($badge) ? $badge->image : '';
                                            } else {
                                                    $feature_class = '';
                                                    $badge_color = '';
                                                    $badge_img    = '';
                                            }
                                        
                                        @endphp
                                        
                                        <div class="wt-userlistinghold wt-exp">
                                            <figure class="wt-userlistingimg">
                                                <img src="{{{ asset($profile_image) }}}" alt="{{ trans('lang.profile_img') }}">
                                            </figure> 
                                            <div class="wt-userlistingcontent">
                                                <div class="wt-contenthead">
                                                    <div class="wt-title">
                                                        
                                                        <h2>
                                                            <a href="{{ url('profile/'.$user->slug.'/freelancer') }}">
                                                                <span><img src="{{{ asset($flag)}}}" alt="Flag"> {{$user_name}} <i class="fa fa-check-circle"></i>
                                                                <br>
                                                                <span style="font-size: 12px;">{{ $user->profile->tagline }}</span>
                                                            </a>
                                                        </h2>
                                                    </div> 
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        <li><span class="wt-stars"><span style="width: {{ $stars }}%;"></span></span></li>
                                                        <li><i class="fa fa-commenting" aria-hidden="true"></i> {{{ $feedbacks }}}</li>                                                    
                                                    </ul>
                                                </div> 
                                                <div class="wt-rightarea">
                                                    {{ Helper::getCurrencySymbol($job->currency) }} {{{ $accepted_proposal->amount }}}
                                                    <br>
                                                    {{ trans('lang.awarded') }}
                                                    
                                                </div>
                                            </div> 
                                            <div class="wt-description">
                                                <p>{{{$accepted_proposal->content}}}</p>
                                            </div> 
                                            @if (!empty($user->skills))
                                                <div class="wt-tag wt-widgettag">
                                                    @foreach($user->skills as $skill)
                                                        <a href="{{{url('search-results?type=job&skills%5B%5D='.$skill->slug)}}}">{{{ $skill->title }}}</a>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if($job->quiz == 'yes')
                                                @if($accepted_proposal->quiz_ans == 'true')
                                                    <br>
                                                    <div class="wt-description" style="margin-top: 20px;">
                                                    <a data-toggle="modal" data-target="#quizresult-{{ $accepted_proposal->id }}">{{ trans('lang.quiz_answered') }} (@if($accepted_proposal->quiz_ans == 'true') {{{$accepted_proposal->marks->marks}}} / {{{$accepted_proposal->marks->total}}} @endif)</a>
                                                    </div>
                                                    <div class="modal fade" data-backdrop="static" id="quizresult-{{ $accepted_proposal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.quiz_result') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            {{{$accepted_proposal->quiz_title}}} - @if($accepted_proposal->quiz_ans == 'true') {{{$accepted_proposal->marks->marks}}} / {{{$accepted_proposal->marks->total}}} @else {{ trans('lang.not_answered_yet') }} @endif <br>
                                                            <br>
                                                            @if($accepted_proposal->quiz_ans == 'true')
                                                            {!! $accepted_proposal->marks->report !!} 
                                                            @endif
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                <br>
                                                    <div class="wt-description" style="margin-top: 20px;">
                                                    {{ trans('lang.quiz_not_answered') }}
                                                    </div>
                                                @endif
                                            @endif 
                                            <div class="wt-rightarea">
                                                @if ($job->status === 'hired' && Auth::user()->role == 'employer')
                                                    <form class="wt-formtheme wt-formsearch" id="change_job_status">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <span class="wt-select">
                                                                    {!! Form::select('status', $project_status, $job->status, array('id' =>'job_status', 'data-placeholder' => trans('lang.select_status'), '@change' => 'jobStatus('.$job->id.', '.$accepted_proposal->id.', "'.$cancel_proposal_text.'", "'.$cancel_proposal_button.'", "'.$validation_error_text.'", "'.$cancel_popup_title.'")')) !!}
                                                                </span>
                                                                <a href="javascrip:void(0);" class="wt-searchgbtn job_status_popup" @click.prevent='jobStatus({{$job->id}}, {{$accepted_proposal->id}}, "{{$cancel_proposal_text}}", "{{$cancel_proposal_button}}", "{{$validation_error_text}}", "{{$cancel_popup_title}}")'><i class="fa fa-check"></i></a>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                @endif
                                            </div>
                                        </div> 
                                        
                                        
                                        

                                    </div>
                                    @endif
                                    <div class="wt-userlistingholder wt-userlisting wt-haslayout" style="padding: 20px;background-color: #f7f7f7;">
                                        
                                            
                                        @foreach ($proposals as $proposal)
                                            @php
                                                $user = \App\User::find($proposal->freelancer_id);
                                                $profile = \App\User::find($proposal->freelancer_id)->profile;
                                                $user_image = !empty($profile) ? $profile->avater : '';
                                                $profile_image = !empty($user_image) ? '/uploads/users/'.$proposal->freelancer_id.'/'.$user_image : 'images/user-login.png';
                                                $user_name = $user->first_name.' '.$user->last_name;
                                                $feedbacks = \App\Review::select('feedback')->where('receiver_id', $proposal->freelancer_id)->count();
                                                $avg_rating = App\Review::where('receiver_id', $proposal->freelancer_id)->sum('avg_rating');
                                                $rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                                                $reviews = \App\Review::where('receiver_id', $proposal->freelancer_id)->get();
                                                $stars  = $reviews->sum('avg_rating') != 0 ? (($reviews->sum('avg_rating')/$feedbacks)/5)*100 : 0;
                                                $average_rating_count = !empty($feedbacks) ? $reviews->sum('avg_rating')/$feedbacks : 0;
                                                $completion_time = !empty($proposal->completion_time) ? \App\Helper::getJobDurationList($proposal->completion_time) : '';
                                                $attachments = !empty($proposal->attachments) ? unserialize($proposal->attachments) : '';
                                                $attachments_count = 0;
                                                if (!empty($attachments)){
                                                    $attachments_count = count($attachments);
                                                }
                                                $reviews = \App\Review::where('receiver_id', $user->id)->count();
                                                $badge = Helper::getUserBadge($user->id);
                                                if (!empty($enable_package) && $enable_package === 'true') {
                                                    $feature_class = !empty($badge) ? 'wt-featured' : '';
                                                    $badge_color = !empty($badge) ? $badge->color : '';
                                                    $badge_img  = !empty($badge) ? $badge->image : '';
                                                } else {
                                                    $feature_class = '';
                                                    $badge_color = '';
                                                    $badge_img    = '';
                                                }
                                            @endphp

                                        @if($proposal->hired == 0)
                                        <div class="wt-userlistinghold wt-exp">
                                            <figure class="wt-userlistingimg">
                                                <img src="{{{ asset($profile_image) }}}" alt="{{ trans('lang.profile_img') }}">
                                            </figure> 
                                            <div class="wt-userlistingcontent">
                                                <div class="wt-contenthead">
                                                    <div class="wt-title">
                                                        
                                                        <h2>
                                                            <a href="{{ url('profile/'.$user->slug.'/freelancer') }}">
                                                                <span> {{$user_name}} <i class="fa fa-check-circle"></i>
                                                                <br>
                                                                <span style="font-size: 12px;">{{ $user->profile->tagline }}</span>
                                                            </a>
                                                        </h2>
                                                    </div> 
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        <li><span class="wt-stars"><span style="width: {{ $stars }}%;"></span></span></li>
                                                        <li><i class="fa fa-commenting" aria-hidden="true"></i> {{{ $feedbacks }}}</li>                                                    
                                                    </ul>
                                                </div> 
                                                <div class="wt-rightarea">
                                                    {{ Helper::getCurrencySymbol($job->currency) }} {{{ $proposal->amount }}}
                                                    
                                                </div>
                                            </div> 
                                            <div class="wt-description">
                                                <p>{{{$proposal->content}}}</p>
                                            </div> 
                                            @if (!empty($user->skills))
                                                <div class="wt-tag wt-widgettag">
                                                    @foreach($user->skills as $skill)
                                                        <a href="{{{url('search-results?type=job&skills%5B%5D='.$skill->slug)}}}">{{{ $skill->title }}}</a>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if($job->quiz == 'yes')
                                                @if($proposal->quiz_ans == 'true')
                                                    <br>
                                                    <div class="wt-description" style="margin-top: 20px;">
                                                    <a data-toggle="modal" data-target="#quizresult-{{ $proposal->id }}">{{ trans('lang.quiz_answered') }} (@if($proposal->quiz_ans == 'true') {{{$proposal->marks->marks}}} / {{{$proposal->marks->total}}} @endif)</a>
                                                    </div>
                                                    <div class="modal fade" data-backdrop="static" id="quizresult-{{ $proposal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.quiz_result') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            {{{$proposal->quiz_title}}} - @if($proposal->quiz_ans == 'true') {{{$proposal->marks->marks}}} / {{{$proposal->marks->total}}} @else {{ trans('lang.not_answered_yet') }} @endif <br>
                                                            <br>
                                                            @if($proposal->quiz_ans == 'true')
                                                            {!! $proposal->marks->report !!} 
                                                            @endif
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                <br>
                                                    <div class="wt-description" style="margin-top: 20px;">
                                                    {{ trans('lang.quiz_not_answered') }}
                                                    </div>
                                                @endif
                                            @endif    
                                            <div class="wt-rightarea" id="hire-now">
                                                @if (empty($accepted_proposal))
                                                    @if (!empty($order))
                                                        @if ($order->product_id == $proposal->id)     
                                                            <h5>{{trans('lang.pending_hiring')}}</h5>
                                                        @endif
                                                    @else
                                                        @if($proposals->contest == 'true' && $proposals->over == 'true')
                                                        @if($proposal->sent == 'false')  
                                                        <sendinvite contestid="{{$proposals->contestid}}" userid="{{ $user->id }}"></sendinvite>                                                  
                                                        
                                                    
                                                        @else 
                                                            <span style="margin-right: 20px;font-weight: bold;">{{ trans('lang.invitation_sent') }}</span>
                                                        @endif
                                                        @endif
                                                        <a href="{{{ route('startchat', $proposal->freelancer_id.'_'.$job->id.'_'.$user->id) }}}" class="wt-btn"><i class="fa fa-circle" aria-hidden="true"></i> {{ trans('lang.chat') }}</a>
                                                        @if($job->approver == 0)
                                                        @if($mode == 'false')
                                                        <a href="{{ route('generate.order', [$proposal->id, 'job']) }}" class="wt-btn">{{ trans('lang.hire_now') }}</a>
                                                        @else
                                                        @endif
                                                        <!--<hirenow proposalid="{{$proposal->id}}" mode="{{$mode}}"></hirenow>-->
                                                        <!--<a href="javascript:void(0);"  v-on:click.prevent="hireFreelancer('{{{$proposal->id}}}', '{{$mode}}')" class="wt-btn">{{ trans('lang.hire_now') }}</a>-->
                                                        @endif

                                                    @endif
                                                @endif
                                            </div>   
                                        </div>
                                        
                                        @endif
                                        @endforeach

                                    </div>
                                    @endif
                                    @if ($proposals->count() == 0) 
                                        
                                        @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                            @include('extend.errors.no-providers')
                                        @else 
                                            @include('errors.no-providers')
                                        @endif
                                    @endif 

                                </div>
                                </div>
                                <div id="contest" class="tab-pane fade">    
                                    <contest-proposal jobid= "{{ $job->id }}"></contest-proposal>
                                    <chatroom jobid= "{{ $job->id }}" userid="{{ Auth::user()->id }}"></chatroom>
                                </div>
                                <div id="providers" class="tab-pane fade">
                                    <job_provider proposalid="" mode="" job="{{$job->id}}"></job_provider>
                                </div>
                                <div id="invited" class="tab-pane fade">
                                    <ijob_provider proposalid="" mode="" job="{{$job->id}}"></ijob_provider>
                                </div>
                            </div>

                            
                        </div>
                        <!--<div id="menu4" class="tab-pane fade" style="">
                        @if (!empty($item) )
                            <table class="wt-tablecategories">
                                <thead>
                                    <tr>
                                        
                                        <th>{{ trans('lang.invoice_id') }}</th>
                                        <th>{{ trans('lang.issue_date') }}</th>
                                        <th>{{ trans('lang.amount') }}</th>
                                        <th>{{ trans('lang.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item as $value)
                                        <tr>
                                            
                                            <td>{{ $value->invoice_id }}</td>
                                            <td>{{{ \Carbon\Carbon::parse($value->created_at)->format('M d, Y') }}}</td>
                                            <td>{{ !empty($symbol) ? $symbol['symbol'] : '$'  }}{{{ $value->item_price }}}</td>
                                            <td>
                                                <div class="">
                                                    <a class="wt-btn" style="background-color: rgb(255, 255, 255) !important; color: rgb(180, 177, 177); font: inherit; border: 1px solid rgb(180, 177, 177); outline: none; border-radius: 0px; padding: 5px 10px;" href="{{ url('show/invoice/'.$value->invoice_id) }}">{{ trans('lang.view_invoice') }}</a>
                                                </div>
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
                        </div>-->
                        <div id="task-component" class="tab-pane fade" style="">
                            <link href="{{ asset('css/tasks.css') }}" rel="stylesheet">
                            <tasks jobid = "{{ $job->id }}" isapprover="{{ $job->approver }}" userid = "{{ Auth::user()->id }}" jobtitle = "{{ $job->title }}"></tasks>
                        </div>
                        @if($role != 'admin')
                        <div id="menu6" class="tab-pane fade" style="">
                        <div>                            
                            <message-center1 id="message-start"
                                
                                :empty_field="'{{ trans('lang.empty_field') }}'" 
                                :host="'{{!empty($chat_settings['host']) ? $chat_settings['host'] : ''}}'" 
                                :port="'{{!empty($chat_settings['port']) ? $chat_settings['port'] : ''}}'"
                                chat="{{$job->id}}">
                            </message-center1>
                        </div>
                        
                        </div>
                        @endif
                        <div id="menu7" class="tab-pane fade" style="">
                            @if($accepted_proposal)
                            <job_ticket freelancerid="{{ $accepted_proposal->freelancer_id }}" jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_ticket>
                            @else
                            <job_ticket freelancerid="0" jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_ticket>
                            @endif
                        </div>
                        <div id="menu8" class="tab-pane fade" style="">
                            <job_note jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_note>
                        </div>
                        <div id="menu9" class="tab-pane fade" style="">
                            <!--<table class="wt-tablecategories">
                                <thead>
                                    <tr>
                                        <th>{{ trans('lang.description') }} <i class="fa fa-pencil" aria-hidden="true"></i></th>
                                        <th>{{ trans('lang.features') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>-->
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                        @include('extend.errors.no-record')
                                    @else 
                                        @include('errors.no-record')
                                    @endif
                        </div>
                        <div id="menu10" class="tab-pane fade" style="">
                            <job_quiz jobid = "{{ $job->id }}" userid = "{{ Auth::user()->id }}"></job_quiz>
                        </div>
                        <!--<div id="provider" class="tab-pane fade" style="">
                            
                            
                            
                        </div>-->
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            </div>
        </div>
        @if($accepted_proposal)
        <b-modal ref="myModalRef" hide-footer title="Project Status">
            <div class="d-block text-center">
                <form class="wt-formtheme wt-formfeedback" id="submit-review-form">
                    <fieldset>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="{{ trans('lang.add_your_feedback') }}" name="feedback"></textarea>
                        </div>
                        @if(!empty($review_options))
                            @foreach ($review_options as $key => $option)
                                <div class="form-group wt-ratingholder">
                                    <div class="wt-ratepoints">
                                        <vue-stars
                                            :name="'rating[{{$key}}][rate]'"
                                            :active-color="'#fecb02'"
                                            :inactive-color="'#999999'"
                                            :shadow-color="'#ffff00'"
                                            :hover-color="'#dddd00'"
                                            :max="5"
                                            :value="0"
                                            :readonly="false"
                                            :char="'★'"
                                            id="rating-{{$key}}"
                                        />
                                        <div class="counter wt-pointscounter"></div>
                                    </div>
                                    <input type="hidden" name="rating[{{$key}}][reason]" value="{{{$option->id}}}">
                                    <span class="wt-ratingdescription">{{{$option->title}}}</span>
                                </div>
                            @endforeach
                        @endif
                        <input type="hidden" name="receiver_id" value="{{{$accepted_proposal->freelancer_id}}}">
                        <input type="hidden" name="proposal_id" value="{{{$accepted_proposal->id}}}">
                        <div class="form-group wt-btnarea">
                            <a class="wt-btn" href="javascript:void(0);" v-on:click='submitFeedback({{$accepted_proposal->freelancer_id}}, {{$job->id}})'>{{ trans('lang.btn_send_feedback') }}</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </b-modal>
        @endif
        
    </section>
    @endsection

    @push('scripts')
    <script src="{{ asset('js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('js/linkify.min.js') }}"></script>
    <script src="{{ asset('js/linkify-jquery.min.js') }}"></script>
    <script>
        $(document).ready(function(){

if(window.location.hash != "") {
    //$('a[href="' + window.location.hash + '"]').click();
    var hashes = location.hash.split('-'); 
    
    $('a[href="' + hashes[0] + '"]').click();
    var chat = hashes[1].replace('#', '');
    document.onreadystatechange = () => {
  if (document.readyState == "complete") {
    var d = document.getElementById("wt-chat-" + chat);
    d.className += ' wt-active'
  }
}
    
    //var message_center = document.getElementById("message-start").chat = chat;
    //console.log(message_center);
    //$("#wt-chat-" + chat).addClass('wt-active');
    //$("#wt-chat-" + chat).removeClass('wt-ad');
}

});
    </script>   
    <script>
    document.getElementById("add_providers").addEventListener("click", function(event){
        console.log('add_providers');
        $('#sproposals').removeClass('active');
        $('#proposals').removeClass('show active in');
        $('#sproviders').addClass('active');
        $('#proposals').removeClass('in active');
        $('#providers').addClass('in active');
    });

</script> 
@endpush