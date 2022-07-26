@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap1.min.css') }}">


<style>
        #map {
        height: 500px;
            width: 100%;
        }
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
    
<div class="wt-haslayout wt-dbsectionspace">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left" id="post_job">
            @if (Session::has('payment_message'))
                @php $response = Session::get('payment_message') @endphp
                <div class="flash_msg">
                    <flash_messages :message_class="'{{{$response['code']}}}'" :time ='5' :message="'{{{ $response['message'] }}}'" v-cloak></flash_messages>
                </div>
            @endif
            @if (session()->has('type'))
                @php session()->forget('type'); @endphp
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
					<li class="active">{{ trans('lang.post_job')}}</li>
				</ol>
			</div>
            <div class="wt-haslayout wt-post-job-wrap">
                {!! Form::open(['url' => url('job/post-job'), 'class' =>'post-job-form wt-haslayout', 'id' => 'post_job_form',  '@submit.prevent'=>'submitJob']) !!}
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{ trans('lang.post_job') }}</h2>
                        </div>
                        <!--<div class="wt-dashboardboxcontent">
                            <div class="wt-jobdescription wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.job_desc') }}</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control" placeholder="{{ trans('lang.job_title') }}" v-model="title">
                                        </div>
                                        <div class="form-group form-group-half wt-formwithlabel">
                                            <span class="wt-select">
                                                {!! Form::select('project_levels', $project_levels, null, array('class' => '', 'placeholder' => trans('lang.select_project_level'), 'v-model'=>'project_level')) !!}
                                            </span>
                                        </div>
                                        
                                        <div class="form-group form-group-half wt-formwithlabel">
                                            <span class="wt-select">
                                                {!! Form::select('freelancer_type', $freelancer_level, null, array('placeholder' => trans('lang.select_freelancer_level'), 'class' => '', 'v-model'=>'freelancer_level')) !!}
                                            </span>
                                        </div>
                                        <div class="form-group form-group-half wt-formwithlabel">
                                            <span class="wt-select">
                                                {!! Form::select('english_level', $english_levels, null, array('class' => '', 'placeholder' => trans('lang.select_english_level'), 'v-model'=>'english_level')) !!}
                                            </span>
                                        </div>
                                        <div class="form-group form-group-half wt-formwithlabel job-cost-input">
                                            {!! Form::number('project_cost', null, array('class' => '', 'placeholder' => trans('lang.project_cost'))) !!}
                                        </div>
                                        <job-expiry 
                                            :ph_expiry_date="trans('lang.project_expiry')"
                                            :weekdays="'{{json_encode($weekdays)}}'"
                                            :months="'{{json_encode($months)}}'">
                                        </job-expiry>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="wt-jobcategories wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.job_cats') }}</h2>
                                </div>
                                <div class="wt-divtheme wt-userform wt-userformvtwo">
                                    <div class="form-group">
                                        <span class="wt-select">
                                            {!! Form::select('categories[]', $categories, null, array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_job_cats'))) !!}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-languages-holder wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.langs') }}</h2>
                                </div>
                                <div class="wt-divtheme wt-userform wt-userformvtwo">
                                    <div class="form-group">
                                        <span class="wt-select">
                                            {!! Form::select('languages[]', $languages, null, array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_lang'))) !!}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-jobdetails wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.job_dtl') }}</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo">
                                    {!! Form::textarea('description', null, ['class' => 'wt-tinymceeditor', 'id' => 'wt-tinymceeditor', 'placeholder' => trans('lang.job_dtl_note')]) !!}
                                </div>
                            </div>
                            <div class="wt-jobskills wt-jobskills-holder wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.skills_req') }}</h2>
                                </div>
                                <job_skills :placeholder="'skills already selected'"></job_skills>
                            </div>
                            <div class="wt-joblocation wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.your_loc') }}</h2>
                                </div>
                                <div class="wt-formtheme wt-userform">
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
                            <div class="wt-featuredholder wt-tabsinfo" id="wt-new-added">
                                <div class="wt-tabscontenttitle">
                                    <h2>Need Quiz for the Job</h2>
                                    <div class="wt-rightarea">
                                        <div class="float-right">
                                        <input type="checkbox" name="quiz" id="quiz" class="checkboxes">
                                        </div>
                                    </div>
                                </div>
                                <div id="quizzes" style="display: none;">
                                    <div class="wt-jobskills wt-jobskills-holder wt-tabsinfo">
            
                                        <div>
                                            <div class="wt-formtheme wt-skillsform">
                                                <fieldset>
                                                    <div class="wt-formgroupwrap">
                                                        <div class="form-group">
                                                            <div class="form-group-holder">
                                                                <span class="wt-select">
                                                                    <select id="quiz-list" class="job-skills">
                                                                        @foreach($quizzes as $quiz)
                                                                        <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
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
                                            <input type="text" name="title" class="form-control" placeholder="{{ trans('lang.job_title') }}" v-model="title">
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
                                                    <div id="select-payment" class="switch-button" onclick="paymentchange()" style="--color:#4D4D4D;">
                                                            <div class="button"></div>
                                                        </div> 
                                                        <div class="" style="padding-left: 20px;">Per Hour</div>
                                                    </div> 
                                                    <input type="hidden" value="fixed" id="payment" name="payment">
                                            </div>
                                            {!! Form::number('project_cost', null, array('class' => '', 'style' => 'width: 100%;margin-top: 7px;', 'placeholder' => trans('lang.project_cost'))) !!}
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
                                                    <div id="delivery" class="switch-button" onclick="deliverychange()" style="--color:#4D4D4D;">
                                                            <div class="button"></div>
                                                        </div> 
                                                        <div class="" style="padding-left: 20px;">Time</div>
                                                    </div> 
                                                    <input type="hidden" value="date" id="delivery_type" name="delivery_type">
                                                    
                                                
                                            </div>
                                            <div id="delivery_date">
                                            <job-expiry 
                                                :ph_expiry_date="trans('lang.project_expiry')"
                                                :weekdays="'{{json_encode($weekdays)}}'"
                                                :months="'{{json_encode($months)}}'">
                                            </job-expiry>
                                            </div>
                                            <div id="delivery_time" style="display: none;margin-top: 7px;">
                                                <input type="number" name="time_month" class="form-control" placeholder="months" min="0" max="12">
                                                <input type="number" name="time_week" class="form-control" placeholder="weeks" min="0" max="4">
                                                <input type="number" name="time_day" class="form-control" placeholder="days" min="0" max="7">
                                                <input type="number" name="time_hour" class="form-control" placeholder="hours" min="0" max="24"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="wt-tabscontenttitle">
                                    <h2>{{ trans('lang.job_dtl') }}</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo wt-userformvtwo1">
                                    <!--{!! Form::textarea('description', null, ['class' => 'wt-tinymceeditor', 'id' => 'wt-tinymceeditor', 'placeholder' => trans('lang.job_dtl_note')]) !!}-->
                                    <tinymce id="wt-tinymceeditor" name="description" ref="tm"></tinymce>
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
                                            {!! Form::select('freelancer_type[]', $freelancer_level, null, array('class' => 'chosen-select', 'multiple', 'v-model'=>'freelancer_level')) !!}
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
                                            {!! Form::select('english_level[]', $english_levels, null, array('class' => 'chosen-select', 'multiple',  'v-model'=>'english_level')) !!}
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
                                            {!! Form::select('project_levels', $project_levels, null, array('class' => '', 'placeholder' => trans('lang.select_project_level'), 'v-model'=>'project_level')) !!}
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
                                                {!! Form::select('job_duration', $job_duration, null, array('class' => '', 'placeholder' => trans('lang.select_job_duration'), 'v-model'=>'job_duration')) !!}
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
                                                {!! Form::select('categories[]', $categories, null, array('class' => 'chosen-select', 'multiple', 'id' => 'categories', 'data-placeholder' => trans('lang.select_job_cats'))) !!}
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
                                                {!! Form::select('languages[]', $languages, null, array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_lang'))) !!}
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
                                                {!! Form::select('skills[]', $skills, null, array('id' => 'skill-select', 'class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.skills_req'))) !!}
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
                                            <input type="checkbox" name="quiz" id="quiz" class="checkboxes">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="quizzes" style="display: none;">
                                        <div class="wt-divtheme wt-userform wt-userformvtwo">
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    <select id="quiz-list" class="job-skills chosen-select" name="selectquiz[]" data-placeholder="Please choose quiz" multiple>
                                                        @foreach($quizzes as $quiz)
                                                        <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                        <!--<div class="wt-jobskills wt-jobskills-holder wt-tabsinfo">
                
                                            <div>
                                                <div class="wt-formtheme wt-skillsform wt-userformvtwo1">
                                                    <fieldset>
                                                        <div class="wt-formgroupwrap">
                                                            <div class="form-group">
                                                                <div class="form-group-holder">
                                                                    <span class="wt-select">
                                                                        <select id="quiz-list" class="job-skills">
                                                                            @foreach($quizzes as $quiz)
                                                                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
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
                                <!--
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
                                </div>-->
                                <br>
                                <div class="wt-dashboardboxtitle" style="border-top: 1px solid #ddd;margin-top: 20px;">
                                    <input type="button" class="wt-btn" value="Previous" onclick="show_prev('account_details','bar1');">
                                    <input type="button" class="wt-btn" value="Next" onclick="show_next('user_details','qualification','bar2');" style="float: right;">
                                </div>
                            </div>
                                    
                            <div id="qualification">
                                <p class='form_head'>Location</p>
                                <div id="map" class="map"></div>
                                {!! Form::text( 'longitude', null, ['id'=>"lng-input", 'class' =>'form-control hidden', 'placeholder' => trans('lang.enter_logitude')]) !!}
                                {!! Form::text( 'latitude', null, ['id'=>"lat-input", 'class' =>'form-control hidden', 'placeholder' => trans('lang.enter_latitude')]) !!}
                                <!--<div class="wt-joblocation wt-tabsinfo">
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
                                                
                                            </div>
                                            <div class="form-group form-group-half">
                                                {!! Form::text( 'longitude', null, ['id'=>"lng-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_logitude')]) !!}
                                            </div>
                                            <div class="form-group form-group-half">
                                                {!! Form::text( 'latitude', null, ['id'=>"lat-input", 'class' =>'form-control', 'placeholder' => trans('lang.enter_latitude')]) !!}
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>-->
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
                                        <div>
                                            <div class="wt-formgroupwrap">
                                                <div class="form-group" style="width: 80%;">
                                                    <div class="row" style="margin-left: 5px;">
                                                    <input type="text" id="team_name" name="team_name" class="form-control" placeholder="First Name" style="margin: 5px;width: 48%;">
                                                    <input type="text" id="team_lname" name="team_lname" class="form-control" placeholder="Last Name" style="margin: 5px;width: 48%;">
                                                    </div>
                                                    <div class="row" style="margin-left: 5px;">
                                                    <input type="text" id="team_email" name="team_email" class="form-control" placeholder="Email" style="margin: 5px;width: 48%;">
                                                    <input type="text" id="team_role" name="team_role" class="form-control" placeholder="Role" style="margin: 5px;width: 48%;">
                                                    </div>
                                                    <select id="team_permission" name="team_permission" class="form-control" style="margin: 5px;border-color: #e5e5e5;color: #abb0bf;">
                                                        <option value="" disabled selected>Select your option</option>
                                                        <option value="1">{{ trans('lang.can_view') }}</option>
                                                        <option value="2">{{ trans('lang.can_edit') }}</option>                                    
                                                    </select>
                                                </div> 
                                                <div class="form-group wt-btnarea" style="width: 20%;">
                                                    <button type="button" id="addteam" class="wt-btn" style="margin: 5px;float: right;">Add team</button>
                                                </div>
                                            </div> 
                                            <div class="wt-myskills">
                                                <ul id="team_list" class="sortable list"> 
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                <div class="wt-jobcategories wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>Approvers</h2>
                                    </div>
                                    <div class="wt-divtheme wt-userform wt-userformvtwo">
                                        <div>
                                            <div class="wt-formgroupwrap">
                                                <div class="form-group" style="width: 80%;">
                                                    <div class="row" style="margin-left: 5px;">
                                                    <input type="text" id="approver_name" name="approver_name" class="form-control" placeholder="First Name" style="margin: 5px;width: 48%;">
                                                    <input type="text" id="approver_lname" name="approver_lname" class="form-control" placeholder="Last Name" style="margin: 5px;width: 48%;">
                                                    </div>
                                                    <div class="row" style="margin-left: 5px;">
                                                    <input type="text" id="approver_email" name="approver_email" class="form-control" placeholder="Email" style="margin: 5px;width: 48%;">
                                                    <input type="text" id="approver_role" name="approver_role" class="form-control" placeholder="Position" style="margin: 5px;width: 48%;">
                                                    </div>
                                                    <select id="approver_permission" name="approver_permission" class="form-control" style="margin: 5px;border-color: #e5e5e5;color: #abb0bf;">
                                                        <option value="" disabled selected>Select level</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div> 
                                                <div class="form-group wt-btnarea" style="width: 20%;">
                                                    <button type="button" id="addapprover" class="wt-btn" style="margin: 5px;float: right;">Add approver</button>
                                                </div>
                                            </div> 
                                            <div class="wt-myskills">
                                                <ul id="approver_list" class="sortable list"> 
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <div>
                                <!--
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
                                <div class="wt-jobcategories wt-tabsinfo">
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
                                <div class="wt-featuredholder wt-tabsinfo" id="wt-new-added">
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
                                                <div class="wt-tabscontenttitle">
                                                    <h2>Message</h2>
                                                </div>
                                                <div class="wt-formtheme wt-skillsform wt-userformvtwo1">
                                                    <textarea id="wt-email_text" name="email_text" style="width: 100%;height: 200px;">Hello Sir/Mam,

I want to invite you to make a proposal for my project.

For the further information, please click the invitation below.

{Link}

Thanks in advance,
{name}
</textarea>    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <br>
                                <div class="wt-dashboardboxtitle" style="border-top: 1px solid #ddd;margin-top: 20px;">
                                    <input type="button" class="wt-btn" value="Previous" onclick="show_prev('qualification','bar3');">
                                    <input type="submit" id="submit-profile" class="wt-btn" value="{{ trans('lang.post_job') }}" style="float: right;">
                                </div>
                            </div>
                        </div>
                        
                        <!-- end wizard -->
                    </div>
                    <!--<div class="wt-updatall">
                        <i class="ti-announcement"></i>
                        <span>{{{ trans('lang.save_changes_note') }}}</span>
                        {!! Form::submit(trans('lang.post_job'), ['class' => 'wt-btn', 'id'=>'submit-profile']) !!}
                    </div>-->
                {!! form::close(); !!}
            </div>
        </div>
    </div>
</div>
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
            var count = 0;
            var count1 = 0;

            initMap();
            
            $('#addquiz').click(function() {                
                var quiz_value = $('#quiz-list').find(":selected").val();
                var quiz_title = $('#quiz-list').find(":selected").text();
               if(quiz_value)
               {
                $('#quiz_list').append('<li id="quizl-'+ quiz_value +'"><div class="wt-dragdroptool"><a href="javascript:void(0)" class="lnr lnr-menu"></a></div><span class="skill-dynamic-html">'+ quiz_title +'</span><span class="skill-dynamic-field"><input type="hidden" name="quiz-'+ quiz_value +'" value="true"></span><div class="wt-rightarea"><button type="button" class="delete-quiz wt-deleteinfo" style=" width: 30px;float: left;color: #fff;height: 30px;font-size: 14px;line-height: 30px;border-radius: 4px;text-align: center;"><i class="lnr lnr-trash"></i></button></div></li>');
               $('#quiz-list').find('[value="'+ quiz_value +'"]').remove();
               }
               
            });
            $('#addteam').click(function() {                
                var team_name = $('#team_name').val();
                var team_lname = $('#team_lname').val();
                var team_email = $('#team_email').val();
                var team_role = $('#team_role').val();
                var team_permission = $('#team_permission').val();
                //console.log(team_name,team_lname,team_role,team_permission, team_email, count);
               if(team_name)
               {
                   if(team_permission == 1){                   
                        $('#team_list').append('<li id="teaml-'+ count +'"><div class="wt-dragdroptool"><a href="javascript:void(0)" class="lnr lnr-menu"></a></div><span class="skill-dynamic-html col-md-4">'+ team_name +' ' + team_lname + '</span><span class="skill-dynamic-html col-md-4">'+ team_email +'</span> <span class="skill-dynamic-html col-md-3">'+ team_role + ' - Can View</span><span class="skill-dynamic-field"><input type="hidden" name="team['+count+'][name]" value="'+team_name+'"><input type="hidden" name="team['+count+'][email]" value="'+team_email+'"><input type="hidden" name="team['+count+'][lname]" value="'+team_lname+'"><input type="hidden" name="team['+count+'][role]" value="'+team_role+'"><input type="hidden" name="team['+count+'][permission]" value="'+team_permission+'"></span><div class="wt-rightarea"><button type="button" class="delete-team wt-deleteinfo" style=" width: 30px;float: left;color: #fff;height: 30px;font-size: 14px;line-height: 30px;border-radius: 4px;text-align: center;"><i class="lnr lnr-trash"></i></button></div></li>');
                   }
                   else
                   {
                        $('#team_list').append('<li id="teaml-'+ count +'"><div class="wt-dragdroptool"><a href="javascript:void(0)" class="lnr lnr-menu"></a></div><span class="skill-dynamic-html col-md-4">'+ team_name +' ' + team_lname + '</span><span class="skill-dynamic-html col-md-4">'+ team_email +'</span> <span class="skill-dynamic-html col-md-3">'+ team_role + ' - Can Edit</span><span class="skill-dynamic-field"><input type="hidden" name="team['+count+'][name]" value="'+team_name+'"><input type="hidden" name="team['+count+'][email]" value="'+team_email+'"><input type="hidden" name="team['+count+'][lname]" value="'+team_lname+'"><input type="hidden" name="team['+count+'][role]" value="'+team_role+'"><input type="hidden" name="team['+count+'][permission]" value="'+team_permission+'"></span><div class="wt-rightarea"><button type="button" class="delete-team wt-deleteinfo" style=" width: 30px;float: left;color: #fff;height: 30px;font-size: 14px;line-height: 30px;border-radius: 4px;text-align: center;"><i class="lnr lnr-trash"></i></button></div></li>');
                   }
               //$('#team-list').find('[value="'+ team_name +'"]').remove();
               }
               count++;
               var team_name = $('#team_name').val("");
               var team_email = $('#team_email').val("");
               var team_lname = $('#team_lname').val("");
                
                var team_role = $('#team_role').val("");
                var team_permission = $('#team_permission').val("");
            });
            $('#addapprover').click(function() {                
                var approver_name = $('#approver_name').val();
                var approver_lname = $('#approver_lname').val();
                var approver_email = $('#approver_email').val();
                var approver_role = $('#approver_role').val();
                var approver_permission = $('#approver_permission').val();
                //console.log(team_name,team_lname,team_role,team_permission, team_email, count);
               if(approver_name)
               {                                     
                    $('#approver_list').append('<li id="approverl-'+ count1 +'"><div class="wt-dragdroptool"><a href="javascript:void(0)" class="lnr lnr-menu"></a></div><span class="skill-dynamic-html col-md-4">'+ approver_name +' ' + approver_lname + '</span><span class="skill-dynamic-html col-md-4">'+ approver_email +'</span> <span class="skill-dynamic-html col-md-3">'+ approver_role + ' - level ' + approver_permission +'</span><span class="skill-dynamic-field"><input type="hidden" name="approver['+count1+'][name]" value="'+approver_name+'"><input type="hidden" name="approver['+count1+'][email]" value="'+approver_email+'"><input type="hidden" name="approver['+count1+'][lname]" value="'+approver_lname+'"><input type="hidden" name="approver['+count1+'][role]" value="'+approver_role+'"><input type="hidden" name="approver['+count1+'][permission]" value="'+approver_permission+'"></span><div class="wt-rightarea"><button type="button" class="delete-approver wt-deleteinfo" style=" width: 30px;float: left;color: #fff;height: 30px;font-size: 14px;line-height: 30px;border-radius: 4px;text-align: center;"><i class="lnr lnr-trash"></i></button></div></li>');
                   
               //$('#team-list').find('[value="'+ team_name +'"]').remove();
               }
               count1++;
               var approver_name = $('#approver_name').val("");
               var approver_lname = $('#approver_lname').val("");
                var approver_email = $('#approver_email').val("");
                var approver_role = $('#approver_role').val("");
                var approver_permission = $('#approver_permission').val("");
            });
            $('#approver_list').on('click', '.delete-approver', function () { 
                var id = $(this).closest('li').prop('id');
                var ids = id.split('-');
                var text = $(this).closest('li').text();
                //console.log(ids);
                $(this).closest('li').remove();
                //$('#quiz-list').append('<option value="'+ ids[1] +'">'+ text +'</option>');
            });
            $('#team_list').on('click', '.delete-team', function () { 
                var id = $(this).closest('li').prop('id');
                var ids = id.split('-');
                var text = $(this).closest('li').text();
                //console.log(ids);
                $(this).closest('li').remove();
                //$('#quiz-list').append('<option value="'+ ids[1] +'">'+ text +'</option>');
            });
            $('#quiz_list').on('click', '.delete-quiz', function () { 
                var id = $(this).closest('li').prop('id');
                var ids = id.split('-');
                var text = $(this).closest('li').text();
                console.log(ids);
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
                            console.log(subCat.sub_category, subCat);
                            $('#sub-skill-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                            $('#sub-skill-select').trigger("chosen:updated");
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
                            $('#sub-cat-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_category +'</option>');
                            $('#sub-cat-select').trigger("chosen:updated");
                        });
                    });
                });    
            });     
            
        });
    </script>
@stop
@endsection
