@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('createProposal', $job->slug); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php')))
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.job_proposal'), 'inner_banner' => '', 'show_banner' => 'true' ]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.job_proposal'), 'inner_banner' => '', 'show_banner' => 'true' ]
        )
    @endif
    
    <div id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
        <div class="wt-haslayout wt-main-section">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2" id="jobs">
                        <div class="preloader-section" v-if="loading" v-cloak>
                            <div class="preloader-holder">
                                <div class="loader"></div>
                            </div>
                        </div>
                        <div class="wt-jobalertsholder la-jobalerts-holder">
                            <ul class="wt-jobalerts">
                                @if ($submitted_proposals_count)
                                    <!--<li class="alert alert-danger alert-dismissible fade show">
                                        <span>{{{ trans('lang.proposal_already_submitted') }}}</span>
                                        <a href="javascript:void(0)" class="wt-alertbtn danger close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </li>-->
                                @endif
                                @if ($job->status != 'posted')
                                    <li class="alert alert-danger alert-dismissible fade show">
                                        <span>{{{ trans('lang.hired_provider_note') }}}</span>
                                        <a href="javascript:void(0)" class="wt-alertbtn danger close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (!empty($check_skill_req))
                                    <li class="alert alert-primary alert-dismissible fade show">
                                        <span><em>{{trans('lang.info')}}: </em> {{{ trans('lang.skill_req_provider_note') }}}</span>
                                        <a href="javascript:void(0)" class="wt-alertbtn primary close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                    </li>
                                @endif
                                @if ($remaining_proposals <= $submitted_proposals)
                                    <li class="alert alert-warning alert-dismissible fade show">
                                        <span><em>{{trans('lang.info')}}: </em>  You’ve consumed all you points to apply new job,</span>
                                        <a href="javascript:void(0)" class="wt-alertbtn primary close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="wt-proposalholder">
                            @if (!empty($job->is_featured) && $job->is_featured === 'true')
                                <span class="wt-featuredtag"><img src="{{{ asset('images/featured.png') }}}" alt="{{{ trans('lang.is_featured') }}}" data-tipso="Plus Member" class="template-content tipso_style"></span>
                            @endif
                            <div class="wt-proposalhead">
                                @if (!empty($job->title))
                                    <h2>{{{ $job->title }}}</h2>
                                @endif
                                <ul class="wt-userlisting-breadcrumb wt-userlisting-breadcrumbvtwo">
                                    @if (!empty($job->price))
                                        <li>
                                            <span>
                                                <i class="wt-viewjobdollar">{{ Helper::getCurrencySymbol($job->currency) }}</i> {{{ number_format($job->price) }}}
                                            </span>
                                        </li>
                                    @endif
                                    @if (!empty($job->location->title))
                                        <li><span><img src="{{{asset(Helper::getLocationFlag($job->location->flag))}}}" alt="{{ trans('lang.img') }}"> {{{ $job->location->title }}}</span></li>
                                    @endif
                                    @if (!empty($job->project_type))
                                        @php $project_type  = Helper::getProjectTypeList($job->project_type); @endphp
                                        <li><span class="wt-clicksavefolder"><img class="wt-job-icon" src="{{asset('images/job-icons/job-type.png')}}"> {{ trans('lang.type') }} {{{ $project_type }}}</span></li>
                                    @endif
                                    @if (!empty($job->duration))
                                        <li><span class="wt-dashboradclock"><img class="wt-job-icon" src="{{asset('images/job-icons/job-duration.png')}}"> {{ trans('lang.duration') }} {{{ Helper::getJobDurationList($job->duration) }}}</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        @if($job->quiz == 'yes')
                        <div class="wt-proposalholder">
                            <div class="wt-proposalhead">
                                <h4>For this job Quiz is required to be filled</h4> 
                                <div class="row">
                                    <div class="col-md-6">Quiz Name</div>
                                    <div class="col-md-6 float-right">Action</div>
                                </div>
                                <br>
                                @foreach($job_quizzes as $value)
                                <div class="row">
                                    <div class="col-md-6">{{ $value->quiz }}</div>
                                    <div class="col-md-6 float-right">
                                        <a target="_blank" href="{{{ route('getQuiz', $value->quiz_id) }}}">Please Click Here</a>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                                
                            </div>
                        </div>
                        @endif


                        <div class="wt-proposalamount-holder">
                            <div class="wt-title">
                                <h2>{{{ trans('lang.proposal_amount') }}}</h2>
                            </div>
                            
                            <form action="{{ url('proposal/submit-proposal') }}" class="wt-haslayout" method="post" id="send-propsal" @submit.prevent="submitJobProposal({{ $job->id }}, {{ Auth::user()->id }})">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="wt-proposalamount accordion">
                                    <div class="form-group">
                                        <span>( <i>{{ Helper::getCurrencySymbol($job->currency) }}</i> )</span>
                                        <input class="form-control" min="1" placeholder="{{ trans('lang.ph_proposal_amount') }}" v-model="proposal.amount" v-on:keyup="calculate_amount('{{ $commision }}')" name="amount" type="number">
                                        <a href="javascript:void(0);" class="collapsed" id="headingOne" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="lnr lnr-chevron-up"></i>
                                        </a>
                                        <em>{{{ trans('lang.amount_note') }}}</em>
                                    </div>
                                    <ul class="wt-totalamount collapse show" id="collapseOne" aria-labelledby="headingOne">
                                        <li v-cloak>
                                            <h3>( <i>{{ Helper::getCurrencySymbol($job->currency) }}</i> ) <em>- @{{this.proposal.deduction}}</em></h3>
                                            <span>{{{ trans('lang.service_fee') }}}
                                                <i class="fa fa-exclamation-circle template-content tipso_style" data-tipso="Plus Member"></i>
                                            </span>
                                        </li>
                                        <li v-cloak>
                                            <h3>( <i>{{ Helper::getCurrencySymbol($job->currency) }}</i> ) <em>@{{this.proposal.total}}</em></h3>
                                            <span>
                                                {{{ trans('lang.receiving_amount') }}} <strong>“ {{{ trans('lang.receiving_amount') }}} ”</strong>
                                                {{{ trans('lang.fee_deduction') }}}
                                                <i class="fa fa-exclamation-circle template-content tipso_style" data-tipso="Plus Member"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="wt-formtheme wt-formproposal">
                                    <fieldset>
                                        <div class="form-group">
                                            <span class="wt-select">
                                                
                                                <select name="completion_time" v-model="proposal.completion_time" placeholder="{{ trans('lang.ph_job_completion_time') }}">
                                                    @foreach ($job_completion_time as $time)
                                                        <option value="{{ $time->id }}">{{ $time->name }}</option>
                                                    @endforeach
                                                </select>

                                            </span>
                                        </div>
                                        <div class="form-group">
                                            
                                            <textarea v-model="proposal.description" name="description" class="form-control" placeholder="{{ trans('lang.ph_cover_letter'])') }}"></textarea>
                                        </div>
                                    </fieldset>
                                    <div class="wt-attachments wt-attachmentsvtwo wt-attachmentsholder lara-proposal-attachment">
                                        <div class="lara-attachment-files">
                                            <div class="wt-title">
                                                <h3>{{{ trans('lang.upload_file') }}}</h3>
                                            </div>
                                            <job_attachments :temp_url="'{{url('proposal/upload-temp-image')}}'"></job_attachments>
                                            <div class="form-group input-preview">
                                                <ul class="wt-attachfile dropzone-previews">

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea id="" name="fdescription" class="form-control" placeholder="{{ trans('lang.description'])') }}" v-model="proposal.fdescription"></textarea>
                                        </div>
                                    </div>
                                    <div class="wt-btnarea">
                                        
                                        <input type="submit" value="{{ trans('lang.btn_send') }}" class="wt-btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
