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
					<li class="active">{{ trans('lang.approval')}}</li>
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
                @if($approver->status == 0)
                <div class="row">
                <div class="float-right" style="width:100%;text-align: end;"><a href="{{{ route('approverrejectjob', $approver->id) }}}" class="wt-btn" style="margin-right:5px;">{{{ trans('lang.reject') }}}</a><a href="{{{ route('approverapprovejob', $approver->id) }}}" class="wt-btn">{{{ trans('lang.approve') }}}</a></div>
                </div>
                @endif
                
                

                <div class="row" style="margin-top:30px;">
                    

                    <div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e4dede 1px solid;">
                        
                        <div id="overview" class="tab-pane fade in active">
                        <!--<jobshow jobid = "{{ $job->id }}"></jobshow>-->
                        <joboverview jobid = "{{ $job->id }}" isapprover="{{ $job->approver }}" userid = "{{ Auth::user()->id }}"></joboverview>
                        
                            
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            </div>
        </div>
        
        
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
@endpush