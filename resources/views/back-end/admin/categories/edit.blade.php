@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="cats-listing" id="cat-list">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace la-editcategory">
        @php
			$user = !empty(Auth::user()) ? Auth::user() : '';
			$role = !empty($user) ? $user->role : array();
			@endphp
			<div class="row" style="margin-left: 10px;padding-bottom: 15px;">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                    <li><a href="{{{ url($role.'/categories') }}}">{{ trans('lang.cats')}}</a></li>
					<li class="active">{{ trans('lang.edit_cat')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_cat') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">                            
                            <form action="{{ url('admin/categories/update-cats/'.$cats->id.'') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="categories">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="category_title" value="{{ $cats['title'] }}" class="form-control">
                                        <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="wt-email_text" name="category_abstract" class="form-control" placeholder="{{ trans('lang.ph_desc') }}">{{ $cats['abstract'] }}</textarea>
                                        <span class="form-group-description">{{{ trans('lang.cat_desc') }}}</span>
                                    </div>
                                    <div class="form-group">
                                        <span class="wt-select">
                                            <select class="form-control" name="parent_id">
                                                <option value="0">{{ trans('lang.choose_parent_cat') }}</option>
                                                @if ($cats1->count() > 0)
                                                @foreach ($cats1 as $cat)
                                                <option value="{{$cat->id}}" @if($cat->id == $cats->parent_id) selected @endif>{{ $cat->title }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </span>
                                        <span class="form-group-description">{{{ trans('lang.parent_desc') }}}</span>
                                    </div>
                                    <div class="wt-settingscontent">
                                        @if (!empty($cats['image']))
                                            <div class="wt-formtheme wt-userform">
                                                <div v-if="this.uploaded_image">
                                                    <upload-image
                                                        :id="'cat_image'"
                                                        :img_ref="'cat_img'"
                                                        :url="'{{url('admin/categories/upload-temp-image')}}'"
                                                        :name="'uploaded_image'"
                                                        >
                                                    </upload-image>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img">
                                                </div>
                                                <div class="form-group" v-else>
                                                    <ul class="wt-attachfile">
                                                        <li>
                                                            <span>{{{ $cats['image'] }}}</span>
                                                            <em>{{{trans('lang.file_size')}}} <span data-dz-size></span>
                                                                <a class="dz-remove" href="javascript:void();" v-on:click.prevent="removeImage('hidden_img')" >
                                                                    <span class="lnr lnr-cross"></span>
                                                                </a>
                                                            </em>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="{{{$cats['image']}}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class = "wt-formtheme wt-userform">
                                                <upload-image
                                                    :id="'cat_image'"
                                                    :img_ref="'cat_ref'"
                                                    :url="'{{url('admin/categories/upload-temp-image')}}'"
                                                    :name="'uploaded_image'"
                                                    >
                                                </upload-image>
                                                <input type="hidden" name="uploaded_image" id="hidden_img">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group wt-btnarea">
                                        <input type="submit" value="{{ trans('lang.update_cat') }}" class="wt-btn">
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
