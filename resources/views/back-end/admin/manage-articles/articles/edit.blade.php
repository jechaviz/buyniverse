@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="cats-listing wt-addarticles-wrap" id="articles">
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
                    <li><a href="{{{ url($role.'/articles') }}}">{{ trans('lang.articles')}}</a></li>
					<li class="active">{{ trans('lang.edit_article')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                    <div class="wt-dashboardbox la-article-box">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_article') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <form action="{{ url('admin/articles/update-article/'.$articles->id) }}" method="POST" class="wt-formtheme la-articlebox-form" id="categories">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        
                                        <input type="text" name="title" value="{{ $articles['title'] }}" class="form-control" placeholder="{{ trans('lang.ph_title')}}">
                                        <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="wt-tinymceeditor" name="description" class="wt-tinymceeditor" placeholder="{{ trans('lang.ph_desc'])') }}">{{ $articles['description'] }}</textarea>
                                        
                                        <span class="form-group-description">{{{ trans('lang.cat_desc') }}}</span>
                                    </div>
                                    <div class="form-group">
                                        <span class="wt-select">
                                            <select name="cats[]" class="chosen-select" multiple data-placeholder = "{{trans('lang.select_cats')}}">
                                                @foreach ($cats as $key => $cat)
                                                    @php $selected = array_key_exists($key, $selected_cats) ? 'selected': ''; @endphp
                                                    <option value="{{$key}}" {{$selected}}>{{$cat}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="wt-settingscontent form-group">
                                        @if (!empty($articles['banner']))
                                            <div class="wt-formtheme wt-userform">
                                                <div v-if="this.uploaded_image">
                                                    <upload-image
                                                        :id="'article_image'"
                                                        :img_ref="'article_ref'"
                                                        :url="'{{url('admin/articles/upload-temp-image')}}'"
                                                        :name="'uploaded_image'"
                                                        >
                                                    </upload-image>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                                </div>
                                                <div class="form-group" v-else>
                                                    <ul class="wt-attachfile">
                                                        <li>
                                                            <span>{{{ $articles['banner'] }}}</span>
                                                            <em>{{{trans('lang.file_size')}}} <span data-dz-size></span>
                                                                <a class="dz-remove" href="javascript:void();" v-on:click.prevent="removeImage('hidden_img')" >
                                                                    <span class="lnr lnr-cross"></span>
                                                                </a>
                                                            </em>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="{{{$articles['banner']}}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class = "wt-formtheme wt-userform">
                                                <upload-image
                                                    :id="'cat_image'"
                                                    :img_ref="'cat_ref'"
                                                    :url="'{{url('admin/articles/upload-temp-image')}}'"
                                                    :name="'uploaded_image'"
                                                    >
                                                </upload-image>
                                                <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group wt-btnarea">
                                        
                                        <input type="submit" value="{{ trans('lang.update_article') }}" class="wt-btn">
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
