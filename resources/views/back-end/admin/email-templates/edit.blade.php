@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="cats-listing" id="emails">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace">
        @php
			$user = !empty(Auth::user()) ? Auth::user() : '';
			$role = !empty($user) ? $user->role : array();
			@endphp
			<div class="row" style="margin-left: 10px;padding-bottom: 15px;">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                    <li><a href="{{{ url($role.'/email-templates/filter-templates') }}}">{{ trans('lang.email_templates')}}</a></li>
					<li class="active">{{ trans('lang.edit_email_template')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_email_template') }}}</h2>
                            <div>
                                <strong>{{{ trans('lang.variables') }}}</strong>
                                <ul>
                                    @foreach ($variables_array as $key => $value )
                                        <li>{{ $key }} => {{ $value }}</li>
                                    @endforeach
                                </ul>
                                <span>{{{ trans('lang.variable_note') }}}</span>
                            </div>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <form action="{{ url('admin/email-templates/update-templates/'.$template->id.'') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="update_email_templates">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="title" value="{{ $template->title }}" class="form-control" placeholder="{{ trans('lang.title')}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" value="{{ $template->subject }}" class="form-control" placeholder="{{ trans('lang.subject')}}">                                        
                                </div>
                                <div class="form-group">
                                    <textarea name="email_content" class="wt-tinymceeditor" id="wt-tinymceeditor" placeholder="{{ trans('lang.add_template_content') }}">{!! $template->content !!}</textarea>
                                </div>
                                <div class="form-group wt-btnarea">
                                    <input type="submit" value="{{ trans('lang.update_email_template') }}" class="wt-btn">
                                </div>
                            </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
