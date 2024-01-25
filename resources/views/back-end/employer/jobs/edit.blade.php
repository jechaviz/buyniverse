@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left" id="post_job">
                @if (Session::has('error'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
                    </div>
                @endif
                <div class="preloader-section" v-if="loading" v-cloak>
                    <div class="preloader-holder">
                        <div class="loader"></div>
                    </div>
                </div>
                @php
                $user = !empty(Auth::user()) ? Auth::user() : '';
                $role = !empty($user) ? $user->role : array();
                @endphp
                <div class="row" style="margin-left: 10px;padding-bottom: 15px;">
                    <ol class="wt-breadcrumb">
                        <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                        <li><a href="{{{ url($role.'/dashboard') }}}">{{ trans('lang.dashboard') }}</a></li>
                        <li class="active">{{ trans('lang.edit_job')}}</li>
                    </ol>
                </div>
                <div class="wt-haslayout wt-post-job-wrap">
                    {!! Form::open(['url' => '', 'class' =>'post-job-form wt-haslayout', 'id' => 'job_edit_form', '@submit.prevent'=>'updateJob("'.$job->id.'")']) !!}
                        <div class="wt-dashboardbox">
                            <div class="wt-dashboardboxtitle">
                                <h2>{{ trans('lang.edit_job') }}</h2>
                            </div>
                            <!--<div class="wt-dashboardboxcontent">
                                <div class="wt-jobdescription wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.job_desc') }}</h2>
                                    </div>
                                    <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                                        <fieldset>
                                            <div class="form-group">
                                                {!! Form::text('title', $job->title, array('class' => 'form-control', 'placeholder' => trans('lang.job_title'))) !!}
                                            </div>
                                            <div class="form-group form-group-half wt-formwithlabel">
                                                <span class="wt-select">
                                                        {!! Form::select('project_levels', $project_levels , e($job->project_level)) !!}
                                                    </span>
                                            </div>
                                            <div class="form-group form-group-half wt-formwithlabel">
                                                <span class="wt-select">
                                                    {!! Form::select('job_duration', $job_duration , e($job->duration)) !!}
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half wt-formwithlabel">
                                                <span class="wt-select">
                                                    {!! Form::select('provider_type', $freelancer_level_list, e($job->provider_type)) !!}
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half wt-formwithlabel">
                                                <span class="wt-select">
                                                    {!! Form::select('english_level', $english_levels, e($job->english_level)) !!}
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half wt-formwithlabel job-cost-input">
                                                {!! Form::text('project_cost', $job->price, array('class' => 'form-control', 'placeholder' => trans('lang.project_cost'))) !!}
                                            </div>
                                            <job-expiry 
                                                :db_expiry_date="'{{$job->expiry_date}}'" 
                                                :ph_expiry_date="trans('lang.project_expiry')"
                                                :weekdays="'{{json_encode($weekdays)}}'"
                                                :months="'{{json_encode($months)}}'">
                                            </job-expiry>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="wt-jobskills wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.job_cats') }}</h2>
                                    </div>
                                    <div class="wt-divtheme wt-userform wt-userformvtwo">
                                        <div class="form-group">
                                            <span class="wt-select">
                                                {!! Form::select('categories[]', $categories, $job->categories, array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_job_cats'))) !!}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wt-jobskills wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.langs') }}</h2>
                                    </div>
                                    <div class="wt-divtheme wt-userform wt-userformvtwo">
                                        <div class="form-group">
                                            <span class="wt-select">
                                                {!! Form::select('languages[]', $languages, $job->languages, array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_lang'))) !!}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wt-jobdetails wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.job_dtl') }}</h2>
                                    </div>
                                    <div class="wt-formtheme wt-userform wt-userformvtwo">
                                        {!! Form::textarea('description', $job->description, ['class' => 'wt-tinymceeditor', 'id' => 'wt-tinymceeditor', 'placeholder'
                                        => trans('lang.job_dtl_note')]) !!}
                                    </div>
                                </div>
                                <div class="wt-jobskills wt-tabsinfo la-jobedit">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.skills_req') }}</h2>
                                    </div>
                                    <div class="la-jobedit-content">
                                        <job_skills :placeholder="'select skills'"></job_skills>
                                    </div>
                                </div>
                                <div class="wt-joblocation wt-tabsinfo la-location-edit">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.your_loc') }}</h2>
                                    </div>
                                    <div class="wt-formtheme wt-userform">
                                        <fieldset>
                                            <div class="form-group form-group-half">
                                                <span class="wt-select">
                                                        {!! Form::select('locations', $locations, $job->location_id, array('class' => 'skill-dynamic-field', 'placeholder' => trans('lang.select_locations'))) !!}
                                                    </span>
                                            </div>
                                            <div class="form-group form-group-half">
                                                {!! Form::text( 'address', $job->address, ['id'=>"pac-input", 'class' =>'form-control', 'placeholder' => trans('lang.your_address')] ) !!}
                                            </div>
                                            <div class="form-group wt-formmap">
                                                @include('includes.map')
                                            </div>
                                            <div class="form-group form-group-half">
                                                {!! Form::text( 'longitude', $job->longitude, ['id'=>"lng-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_logitude')])
                                                !!}
                                            </div>
                                            <div class="form-group form-group-half">
                                                {!! Form::text( 'latitude', $job->latitude, ['id'=>"lat-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_latitude')]) !!}
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="wt-featuredholder wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.is_featured') }}</h2>
                                        <div class="wt-rightarea">
                                            <div class="wt-on-off float-right">
                                                <switch_button v-model="is_featured">{{{ trans('lang.make_job_featured') }}}</switch_button>
                                                <input type="hidden" :value="is_featured" name="is_featured">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wt-attachmentsholder">
                                    <div class="lara-attachment-files">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.attachments') }}</h2>
                                            <div class="wt-rightarea">
                                                <div class="wt-on-off float-right">
                                                    <switch_button v-model="show_attachments">{{{ trans('lang.attachments_note') }}}</switch_button>
                                                    <input type="hidden" :value="show_attachments" name="show_attachments">
                                                </div>
                                            </div>
                                        </div>
                                        <job_attachments :temp_url="'{{url('job/upload-temp-image')}}'"></job_attachments>
                                        <div class="form-group input-preview">
                                            <ul class="wt-attachfile dropzone-previews">

                                            </ul>
                                        </div>
                                        @if (!empty($attachments))
                                            @php $count = 0; @endphp
                                            <div class="form-group input-preview">
                                                <ul class="wt-attachfile">
                                                    @foreach ($attachments as $key => $attachment)
                                                        <li id="attachment-item-{{$key}}">
                                                            <span>{{{Helper::formateFileName($attachment)}}}</span>
                                                            <em>
                                                                @if (Storage::disk('local')->exists('uploads/jobs/'.$job->user_id.'/'.$attachment))
                                                                    {{ trans('lang.file_size') }} {{{Helper::bytesToHuman(Storage::size('uploads/jobs/'.$job->user_id.'/'.$attachment))}}}
                                                                @endif
                                                                <a href="{{{route('getfile', ['type'=>'jobs','attachment'=>$attachment,'id'=>$job->user_id])}}}"><i class="lnr lnr-download"></i></a>
                                                                <a href="#" v-on:click.prevent="deleteAttachment('attachment-item-{{$key}}')"><i class="lnr lnr-cross"></i></a>
                                                            </em>
                                                            <input type="hidden" value="{{{$attachment}}}" class="" name="attachments[{{$key}}]">
                                                        </li>
                                                        @php $count++; @endphp
                                                    @endforeach
                                                    <div class="dropzone-previews"></div>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>-->
                            <!-- Step wizard -->
                        
                            <link href="{{ asset('css/multi/style.css') }}" rel="stylesheet">
                            <div id="wrapper">
                                <div style="text-align:center;">
                                <span class='baricon'>1</span>
                                <span id="bar1" class='progress_bar'></span>
                                <span class='baricon'>2</span>
                                <span id="bar2" class='progress_bar'></span>
                                <span class='baricon'>3</span>
                                <span id="bar3" class='progress_bar'></span>
                                <span class='baricon'>4</span>
                                </div>
                                <div id="account_details">
                                    <p class='form_head'>Details</p>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Job Title</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">                                
                                            <div class="form-group">
                                                <input type="text" name="title" value="{{$job->title}}" class="form-control" placeholder="{{ trans('lang.job_title') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="form-group form-group-half wt-formwithlabel">
                                        <span class="wt-select">
                                            {!! Form::select('project_levels', $project_levels, null, array('class' => '', 'placeholder' => trans('lang.select_project_level'), 'v-model'=>'project_level')) !!}
                                        </span>
                                    </div>
                                    <div class="form-group form-group-half wt-formwithlabel">
                                        
                                    </div>-->
                                    
                                    
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Payment</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group" style="display: flex;">
                                                
                                                <div class="wt-on-off" style="padding: 20px;border: 1px solid #cdc6c6;border-radius: 5px;width: 300px;">
                                                        <div class="switch-button-control" style="display: flex;">
                                                        <div class="" style="padding-right: 20px;color:#005178;">Fixed</div>
                                                        <div id="select-payment" class="switch-button @if($job->payment == 'perhour') enabled @endif" onclick="paymentchange()" style="--color:#4D4D4D;">
                                                                <div class="button"></div>
                                                            </div> 
                                                            <div class="" style="padding-left: 20px;">Per Hour</div>
                                                        </div> 
                                                        <input type="hidden" value="{{ $job->payment }}" id="payment" name="payment">
                                                </div>
                                                {!! Form::number('project_cost', $job->price, array('class' => '', 'style' => 'width: 100%;margin-top: 7px;', 'placeholder' => trans('lang.project_cost'))) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group form-group-half wt-formwithlabel job-cost-input">
                                        {!! Form::number('project_cost', null, array('class' => '', 'style' => 'width: 100%;', 'placeholder' => trans('lang.project_cost'))) !!}
                                    </div>-->
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Delivery Time</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                
                                                <div class="wt-on-off" style="padding: 20px;border: 1px solid #cdc6c6;border-radius: 5px;width: 240px;">
                                                        <div class="switch-button-control" style="display: flex;">
                                                        <div class="" style="padding-right: 20px;color:#005178;">Date</div>
                                                        <div id="delivery" class="switch-button @if($job->delivery_type == 'time') enabled @endif" onclick="deliverychange()" style="--color:#4D4D4D;">
                                                                <div class="button"></div>
                                                            </div> 
                                                            <div class="" style="padding-left: 20px;">Time</div>
                                                        </div> 
                                                        <input type="hidden" value="{{ $job->delivery_type }}" id="delivery_type" name="delivery_type">
                                                        
                                                    
                                                </div>
                                                <div id="delivery_date" @if($job->delivery_type == 'time') style="display:none;" @endif>
                                                <job-expiry 
                                                    :db_expiry_date="'{{$job->expiry_date}}'" 
                                                    :weekdays="'{{json_encode($weekdays)}}'"
                                                    :months="'{{json_encode($months)}}'">
                                                </job-expiry>
                                                </div>
                                                <div id="delivery_time" style="@if($job->delivery_type == 'date') display: none;margin-top: 7px;@else display:flex; @endif ">
                                                    <input type="number" name="time_month" class="form-control" placeholder="months" min="0" max="12" value="{{ $job->month }}">
                                                    <input type="number" name="time_week" class="form-control" placeholder="weeks" min="0" max="4" value="{{ $job->week }}">
                                                    <input type="number" name="time_day" class="form-control" placeholder="days" min="0" max="7" value="{{ $job->day }}">
                                                    <input type="number" name="time_hour" class="form-control" placeholder="hours" min="0" max="24"  value="{{ $job->hour }}"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{ trans('lang.job_dtl') }}</h2>
                                    </div>
                                    <div class="wt-formtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                        <!--{!! Form::textarea('description', $job->description, ['class' => 'wt-tinymceeditor', 'id' => 'wt-tinymceeditor', 'placeholder' => trans('lang.job_dtl_note')]) !!}-->
                                        <tinymce id="wt-tinymceeditor" name="description" value="{{$job->description}}" ref="tm"></tinymce>
                                    </div>
                                    <div class="wt-attachmentsholder">
                                        <div class="lara-attachment-files">
                                            
                                            <job_attachments :temp_url="'{{url('job/upload-temp-image')}}'"></job_attachments>
                                            <div class="form-group input-preview">
                                                <ul class="wt-attachfile dropzone-previews">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wt-dashboardboxtitle" style="border-top: 1px solid #ddd;margin-top: 20px;">
                                        <input type="button" class="wt-btn" value="Next" onclick="show_next('account_details','user_details','bar1');" style="float: right;">
                                    </div>
                                </div>

                                <div id="user_details">
                                    <p class='form_head'>Category</p>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.select_freelancer_level') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group ">
                                                <span class="wt-select">
                                                    {!! Form::select('provider_type', $freelancer_level_list, e($job->provider_type), array('placeholder' => trans('lang.select_freelancer_level'), 'class' => '')) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.select_english_level') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group ">
                                                <span class="wt-select">
                                                {!! Form::select('english_level', $english_levels, e($job->english_level), array('class' => '', 'placeholder' => trans('lang.select_english_level'))) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.select_project_level') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group ">
                                                <span class="wt-select">
                                                {!! Form::select('project_levels', $project_levels, e($job->project_level), array('class' => '', 'placeholder' => trans('lang.select_project_level'))) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.select_job_duration') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group ">
                                                <span class="wt-select">
                                                    {!! Form::select('job_duration', $job_duration , e($job->duration)) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group form-group-half wt-formwithlabel">
                                        <span class="wt-select">
                                            {!! Form::select('english_level', $english_levels, null, array('class' => '', 'placeholder' => trans('lang.select_english_level'), 'v-model'=>'english_level')) !!}
                                        </span>
                                    </div>-->
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.job_cats') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    {!! Form::select('categories[]', $categories, $job->categories, array('class' => 'chosen-select', 'multiple', 'id' => 'categories', 'data-placeholder' => trans('lang.select_job_cats'))) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Sub {{ trans('lang.job_cats') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    <select multiple="multiple" id="sub-cat-select" data-placeholder="Sub category Required" name="sub_cat[]" class="chosen-select">
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wt-languages-holder wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.langs') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    {!! Form::select('languages[]', $languages, $job->languages, array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_lang'))) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-jobskills wt-jobskills-holder wt-tabsinfo">
                                            
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.skills_req') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    {!! Form::select('skills[]', $skills, $job->skills, array('class' => 'chosen-select', 'multiple', 'id' => 'skill-select', 'data-placeholder' => trans('lang.skills_req'))) !!}
                                                </span>
                                            </div>
                                        </div>

                                        <!--<job_skills :placeholder="'skills already selected'"></job_skills>-->
                                    </div>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Sub {{ trans('lang.skills_req') }}</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    <select multiple="multiple" id="sub-skill-select" data-placeholder="Sub Skill Required" name="sub_skill[]" class="chosen-select">
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-featuredholder wt-tabsinfo" id="wt-new-added">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Need Quiz for the Job</h2>
                                            <div class="wt-rightarea">
                                                <div class="float-right">
                                                <input type="checkbox" name="quiz" id="quiz" class="checkboxes" @if($job->quiz === 'yes') checked @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="quizzes" @if($job->quiz == 'no') style="display: none;" @endif>
                                            <div class="wt-divtheme wt-userform wt-userformvtwo">
                                                <span class="wt-select">
                                                        <select id="quiz-list" class="job-skills chosen-select" name="selectquiz[]" data-placeholder="Please choose quiz" multiple>
                                                            @foreach($quizzes as $quiz)
                                                            <option value="{{ $quiz->id }}" @if($quiz->selected == true) selected="selected" @endif>{{ $quiz->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>
                                                <!--<div>
                                                    <div class="wt-formtheme wt-skillsform wt-userformvtwo1">
                                                        <fieldset>
                                                            <div class="wt-formgroupwrap">
                                                                <div class="form-group">
                                                                    <div class="form-group-holder">
                                                                        <span class="wt-select">
                                                                            <select id="quiz-list" class="job-skills">
                                                                                @foreach($quizzes as $quiz)
                                                                                    @if($quiz->selected == false)
                                                                                        <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group wt-btnarea">
                                                                    <button type="button" id="addquiz" class="wt-btn">Add Quiz</button>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div> 
                                                    <div class="wt-myskills">
                                                        <ul id="quiz_list" class="sortable list"> 
                                                        
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>-->
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="wt-languages-holder wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2 style="font-size: x-large;">Contracts to be signed</h2>
                                        </div>
                                        <div class="wt-tabscontenttitle">
                                            <h2>Before freelancer post a bid</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                <select multiple="multiple" name="bid1" class="chosen-select" style="display: none;">
                                                    <option selected="selected" value="">Item1</option>
                                                    <option value="independent">Item2</option>
                                                    <option value="agency">Item3</option>
                                                    <option value="rising_talent">Item4</option>
                                                </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-languages-holder wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>If freelancer is awarded</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                <select multiple="multiple" name="bid2" class="chosen-select" style="display: none;">
                                                    <option selected="selected" value="">Item1</option>
                                                    <option value="independent">Item2</option>
                                                    <option value="agency">Item3</option>
                                                    <option value="rising_talent">Item4</option>
                                                </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-languages-holder wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Upload a new contract</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                            <div class="form-group">
                                                <job_attachments :temp_url="'{{url('job')}}'"></job_attachments>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wt-dashboardboxtitle" style="border-top: 1px solid #ddd;margin-top: 20px;">
                                        <input type="button" class="wt-btn" value="Previous" onclick="show_prev('account_details','bar1');">
                                        <input type="button" class="wt-btn" value="Next" onclick="show_next('user_details','qualification','bar2');" style="float: right;">
                                    </div>
                                </div>
                                        
                                <div id="qualification">
                                    <p class='form_head'>Location</p>
                                    <div class="wt-joblocation wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.your_loc') }}</h2>
                                        </div>
                                        <div class="wt-formtheme wt-userform wt-userformvtwo1">
                                            <fieldset>
                                                <div class="form-group form-group-half">
                                                    <span class="wt-select">
                                                        {!! Form::select('locations', $locations, null, array('class' => 'skill-dynamic-field', 'placeholder' => trans('lang.select_locations'))) !!}
                                                    </span>
                                                </div>
                                                <div class="form-group form-group-half">
                                                    {!! Form::text( 'address', null, ['id'=>"pac-input", 'class' =>'form-control', 'placeholder' => trans('lang.your_address')] ) !!}
                                                </div>
                                                <div class="form-group wt-formmap">
                                                    @include('includes.map')
                                                </div>
                                                <div class="form-group form-group-half">
                                                    {!! Form::text( 'longitude', null, ['id'=>"lng-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_logitude')]) !!}
                                                </div>
                                                <div class="form-group form-group-half">
                                                    {!! Form::text( 'latitude', null, ['id'=>"lat-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_latitude')]) !!}
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="wt-featuredholder wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{ trans('lang.is_featured') }}</h2>
                                            <div class="wt-rightarea">
                                                <div class="wt-on-off float-right">
                                                    <switch_button v-model="is_featured">{{{ trans('lang.is_featured') }}}</switch_button>
                                                    <input type="hidden" :value="is_featured" name="is_featured">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <br>
                                    <input type="button" class="wt-btn" value="Previous" onclick="show_prev('user_details','bar2');">
                                    <input type="button" class="wt-btn" value="Next" onclick="show_next('qualification', 'team', 'bar3');" style="float: right;">
                                    <!--{!! Form::submit(trans('lang.post_job'), ['class' => 'wt-btn', 'id'=>'submit-profile', 'style'=>'float: right;']) !!}-->
                                    <!--<input type="Submit" class="wt-btn" value="Submit">-->
                                </div>

                                <div id="team">
                                    <p class='form_head'>Team</p>
                                    
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Team</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo">
                                            
                                        </div>
                                    <div>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Approvers</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo">
                                            
                                        </div>
                                    <div>
                                    <div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Company</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo">
                                            <div class="form-group form-group-half wt-formwithlabel">
                                                <span class="wt-select">
                                                    <select name="">
                                                        <option selected="selected" value="">Company</option>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half wt-formwithlabel">
                                                <span class="wt-select">
                                                    <select name="">
                                                        <option selected="selected" value="">Department</option>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half wt-formwithlabel">
                                                <span class="wt-select">
                                                    <select name="">
                                                        <option selected="selected" value="">Branch</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                    <div>
                                    <!--<div class="wt-jobcategories wt-tabsinfo">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Invite Freelancers</h2>
                                        </div>
                                        <div class="wt-divtheme wt-userform wt-userformvtwo wt-userformvtwo1">                                
                                            <div class="form-group">
                                                <input type="email" name="emails" class="form-control" placeholder="Enter emails" v-model="emails" data-role="tagsinput" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    Add email here--
                                    -->
                                    <!--<div class="wt-featuredholder wt-tabsinfo" id="wt-new-added">
                                        <div class="wt-tabscontenttitle">
                                            <h2>Invite freelancers</h2>
                                        </div>
                                        <div>
                                            <div class="wt-jobskills wt-jobskills-holder wt-tabsinfo">
                    
                                                <div>
                                                    <div class="wt-formtheme wt-skillsform wt-userformvtwo1">
                                                        <fieldset>
                                                            <div class="wt-formgroupwrap">
                                                                <div class="form-group">
                                                                    <div class="form-group-holder">
                                                                    <input type="email" name="email" id="email" style="width: 100%;">
                                                                    </div>
                                                                </div> 
                                                                <input type="text" name="emails" id="emails" value="" class="hidden">
                                                                <div class="form-group wt-btnarea">
                                                                    <button type="button" id="addemail" class="wt-btn">Add Email</button>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div> 
                                                    <div class="wt-myskills">
                                                        <ul id="email_list" class="sortable list"> 
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>-->
                                    
                                    <br>
                                    <div class="wt-dashboardboxtitle" style="border-top: 1px solid #ddd;margin-top: 20px;">
                                        <input type="button" class="wt-btn" value="Previous" onclick="show_prev('qualification','bar3');">
                                        <input type="submit" id="submit-profile" class="wt-btn" value="{{ trans('lang.btn_save_update') }}" style="float: right;">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- end wizard -->
                        </div>
                        <!--<div class="wt-updatall">
                            <i class="ti-announcement"></i>
                            <span>{{{ trans('lang.save_changes_note') }}}</span> {!! Form::submit(trans('lang.btn_save_update'), ['class' => 'wt-btn',
                            'id'=>'submit-profile']) !!}
                        </div>-->
                    {!! form::close(); !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bootstrap_script')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/multi/script.js') }}"></script>
    <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.js'></script>-->
    
    <script>
        function deliverychange() {
            if(document.getElementById('delivery').classList.contains('enabled'))
            {
                $('#delivery').removeClass('enabled');
                document.getElementById('delivery_type').value = 'date';
                document.getElementById('delivery_date').style.display = 'block';
                document.getElementById('delivery_time').style.display = 'none';
            }                
            else
            {
                $('#delivery').addClass('enabled');
                document.getElementById('delivery_type').value = 'time';
                document.getElementById('delivery_date').style.display = 'none';
                document.getElementById('delivery_time').style.display = 'flex';
            }
        }
        function paymentchange() {
            if(document.getElementById('select-payment').classList.contains('enabled'))
            {
                $('#select-payment').removeClass('enabled');
                document.getElementById('payment').value = 'fixed';
                
            }                
            else
            {
                $('#select-payment').addClass('enabled');
                document.getElementById('payment').value = 'perhour';
                
            }
        }
        $(document).ready(function() {

            var job_id = JSON.parse("{{ json_encode($job->id) }}");
            //console.log(job_id);
            var selected1 = $('#categories').val();
                
                $.each(selected1, function(key, value) {
                    $.get('{{ url('api') }}/sub_category/' + value, function(data) {
                        
                        $.each(data, function(index, subCat){
                            //console.log(subCat.sub_category, subCat);
                            $.get('{{ url('api') }}/sub_cat_status/' + job_id + '-' + subCat.id, function(data) {
                                //console.log(data, subCat);
                                if(data == 1)
                                {
                                    //console.log('yes');
                                    $('#sub-cat-select').append('<option  selected value="'+ subCat.id +'">'+ subCat.sub_category +'</option>');
                                    $('#sub-cat-select').trigger("chosen:updated");
                                }
                                else
                                {
                                    $('#sub-cat-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_category +'</option>');
                                    $('#sub-cat-select').trigger("chosen:updated");
                                }
                                    
                                
                            });
                            
                        });
                    });
                });
                
                
                var selected2 = $('#skill-select').val();
                //console.log(selected2);
                $.each(selected2, function(key, value) {
                    $.get('{{ url('api') }}/sub_skills/' + value, function(data) {
                        
                        $.each(data, function(index, subCat){
                            $.get('{{ url('api') }}/sub_skill_status/' + job_id + '-' + subCat.id, function(data) {
                                //console.log(data, subCat);
                                if(data == 1)
                                {
                                    console.log('yes');
                                    $('#sub-skill-select').append('<option  selected value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                                    $('#sub-skill-select').trigger("chosen:updated");
                                }
                                else
                                {
                                    $('#sub-skill-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                                    $('#sub-skill-select').trigger("chosen:updated");
                                }
                                    
                                
                            });
                        });
                    });
                    //console.log( key, value );
                    
                }); 
            $('#addquiz').click(function() {                
                var quiz_value = $('#quiz-list').find(":selected").val();
                var quiz_title = $('#quiz-list').find(":selected").text();
               if(quiz_value)
               {
                $('#quiz_list').append('<li id="quizl-'+ quiz_value +'"><div class="wt-dragdroptool"><a href="javascript:void(0)" class="lnr lnr-menu"></a></div><span class="skill-dynamic-html">'+ quiz_title +'</span><span class="skill-dynamic-field"><input type="hidden" name="quiz-'+ quiz_value +'" value="true"></span><div class="wt-rightarea"><button type="button" class="delete-quiz wt-deleteinfo" style=" width: 30px;float: left;color: #fff;height: 30px;font-size: 14px;line-height: 30px;border-radius: 4px;text-align: center;"><i class="lnr lnr-trash"></i></button></div></li>');
               $('#quiz-list').find('[value="'+ quiz_value +'"]').remove();
               }
               
            });
            $('#quiz_list').on('click', '.delete-quiz', function () { 
                var id = $(this).closest('li').prop('id');
                var ids = id.split('-');
                var text = $(this).closest('li').text();
                //console.log(ids);
                $(this).closest('li').remove();
                $('#quiz-list').append('<option value="'+ ids[1] +'">'+ text +'</option>');
            });

            $('#quiz').change(function() {
                if(this.checked) {
                    document.getElementById('quizzes').style.display = 'block';
                }
                else{
                    document.getElementById('quizzes').style.display = 'none';
                }
            });
            $('#addemail').click(function() {                
                var email_value = $('#email').val();
                //var email_title = $('#email-list').find(":selected").text();
                
               if(email_value)
               {
                $('#email_list').append('<li id="emaill-'+ email_value +'"><div class="wt-dragdroptool"><a href="javascript:void(0)" class="lnr lnr-menu"></a></div><span class="skill-dynamic-html">'+ email_value +'</span><span class="skill-dynamic-field"></span><div class="wt-rightarea"><button type="button" class="delete-email wt-deleteinfo" style=" width: 30px;float: left;color: #fff;height: 30px;font-size: 14px;line-height: 30px;border-radius: 4px;text-align: center;"><i class="lnr lnr-trash"></i></button></div></li>');
                $('#email-list').find('[value="'+ email_value +'"]').remove();
                $('#email').val('');
                var emails_value = $('#emails').val();
                if(emails_value)
                    $('#emails').val(emails_value + ', ' + email_value);
                else
                    $('#emails').val(email_value);
               }
               
            });
            $('#email_list').on('click', '.delete-email', function () { 
                var id = $(this).closest('li').prop('id');
                var ids = id.split('-');
                var text = $(this).closest('li').text();
                console.log(ids);
                $(this).closest('li').remove();
                $('#email-list').append('<option value="'+ ids[1] +'">'+ text +'</option>');
            });   
            $('#skill-select').on('change', function(e) {
                $('#sub-skill-select').empty();
                $('#sub-skill-select').trigger("chosen:updated");
                
                var selected = $(e.target).val();
                
                $.each(selected, function(key, value) {
                    $.get('{{ url('api') }}/sub_skills/' + value, function(data) {
                        
                        $.each(data, function(index, subCat){
                            //console.log(subCat.sub_category, subCat);
                            $.get('{{ url('api') }}/sub_skill_status/' + job_id + '-' + subCat.id, function(data) {
                                if(data == 1)
                                    $('#sub-skill-select').append('<option selected value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                                else
                                    $('#sub-skill-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                                $('#sub-skill-select').trigger("chosen:updated");
                            });
                            //$('#sub-skill-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                            
                        });
                    });
                    //console.log( key, value );
                    
                });                
                

                
            });   
            $('#categories').on('change', function(e) {
                $('#sub-cat-select').empty();
                $('#sub-cat-select').trigger("chosen:updated");
                
                var selected = $(e.target).val();
                
                $.each(selected, function(key, value) {
                    $.get('{{ url('api') }}/sub_category/' + value, function(data) {
                        
                        $.each(data, function(index, subCat){
                            //console.log(subCat.sub_category, subCat);
                            $.get('{{ url('api') }}/sub_cat_status/' + job_id + '-' + subCat.id, function(data) {
                                //console.log(data, subCat);
                                if(data == 1)
                                {
                                    //console.log('yes');
                                    $('#sub-cat-select').append('<option  selected value="'+ subCat.id +'">'+ subCat.sub_category +'</option>');
                                    $('#sub-cat-select').trigger("chosen:updated");
                                }
                                else
                                {
                                    $('#sub-cat-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_category +'</option>');
                                    $('#sub-cat-select').trigger("chosen:updated");
                                }
                            });
                            /*$('#sub-cat-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_category +'</option>');
                            $('#sub-cat-select').trigger("chosen:updated");*/
                        });
                    });
                });    
            });
            
            
        });
    </script>
@stop

