@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="badges-listing" id="badge-list">
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
                    <li><a href="{{{ url($role.'/badges') }}}">{{ trans('lang.badges')}}</a></li>
					<li class="active">{{ trans('lang.edit_badge')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_badge') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent la-editbadge">
                            <form action="{{ url('admin/badges/update-badges/'.$badges->id.'') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post" id="badges">
                                <!--<input type="hidden" name="_method" value="PUT">-->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="badge_title" class="form-control" value="{{ $badges['title'] }}">
                                    </div>
                                    <div class="wt-settingscontent">
                                        @if (!empty($badges['image']))
                                            <div class="wt-formtheme wt-userform">
                                                <div v-if="this.uploaded_image">
                                                    <div class="test"></div>
                                                    <upload-image
                                                        :id="'badge_image'"
                                                        :img_ref="'badge_img'"
                                                        :url="'{{url('admin/badges/upload-temp-image')}}'"
                                                        :name="'uploaded_image'"
                                                        >
                                                    </upload-image>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img">
                                                </div>
                                                <div class="form-group" v-else>
                                                    <ul class="wt-attachfile">
                                                        <li>
                                                            <span>{{{ $badges['image'] }}}</span>
                                                            <em>
                                                                <a class="dz-remove" href="javascript:void();" v-on:click.prevent="removeImage('hidden_img')" >
                                                                    <span class="lnr lnr-cross"></span>
                                                                </a>
                                                            </em>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="{{{$badges['image']}}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class = "wt-formtheme wt-userform">
                                                <upload-image
                                                    :id="'badge_image'"
                                                    :img_ref="'badge_ref'"
                                                    :url="'{{url('admin/badges/upload-temp-image')}}'"
                                                    :name="'uploaded_image'"
                                                    >
                                                </upload-image>
                                                <input type="hidden" name="uploaded_image" id="hidden_img">
                                            </div>

                                        @endif
                                    </div>
                                    <div class="form-group la-color-picker">
                                        <verte display="widget" v-model="color" menuPosition="left" model="hex"></verte>
                                        <input type="hidden" name="color" :value="color">
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
