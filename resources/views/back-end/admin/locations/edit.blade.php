@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="edit-location" id="location">
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
                    <li><a href="{{{ url($role.'/locations') }}}">{{ trans('lang.locations')}}</a></li>
					<li class="active">{{ trans('lang.edit_location')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_location') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <form action="{{ url('admin/locations/update-location/'.$locations->id.'') }}" class="wt-formtheme wt-formprojectinfo wt-formcategory" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <input type="hidden" name="location" id="uploaded_id" value="{{ $locations->id }}">
                                    <div class="form-group">
                                        <input type="text" name="title" value="{{ $locations->title }}" class="form-control {{( $errors->has('title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_location_title')}}" id="location_title">
                                        <span class="form-group-description">{{{ trans('lang.desc') }}}</span>
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @if (!empty($store_locations))
                                        <div class="form-group">
                                            <span class="wt-select">
                                                <select name="parent_location" id="parent">
                                                    <option value="0">{{ trans('lang.choose_parent_cat') }}</option>
                                                    @foreach ($store_locations as $store_location)
                                                        @php
                                                            if ($store_location->id == $locations->parent ) {
                                                                $selected = 'selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                        @endphp
                                                        <option value="{{{$store_location->id}}}" {{$selected}}>{{{$store_location->title}}}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                            <span class="form-group-description">{{{ trans('lang.parent_desc') }}}</span>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <textarea id="location_abstract" name="abstract" class="form-control" placeholder="{{ trans('lang.ph_desc') }}">{{ $locations->description }}</textarea>
                                        <span class="form-group-description">{{{ trans('lang.cat_desc') }}}</span>
                                    </div>
                                    <div class="wt-settingscontent">
                                        @if (!empty($locations->flag))
                                            <div class="wt-formtheme wt-userform">
                                                <div v-if="this.uploaded_image">
                                                    <upload-image
                                                        :id="'location_image'"
                                                        :img_ref="'location_ref'"
                                                        :url="'{{url('admin/locations/upload-temp-image')}}'"
                                                        :name="'uploaded_image'"
                                                        >
                                                    </upload-image>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                                </div>
                                                <div class="form-group" v-else>
                                                    <ul class="wt-attachfile">
                                                        <li>
                                                            <span>{{{ $locations->flag }}}</span>
                                                            <em>File size: <span data-dz-size></span>
                                                                <a class="dz-remove" href="javascript:void();" v-on:click.prevent="removeImage('hidden_img')" >
                                                                    <span class="lnr lnr-cross"></span>
                                                                </a>
                                                            </em>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="{{{ $locations->flag }}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class = "wt-formtheme wt-userform">
                                                <upload-image
                                                :id="'location_image'"
                                                :img_ref="'location_ref'"
                                                :url="'{{url('admin/locations/upload-temp-image')}}'"
                                                :name="'uploaded_image'"
                                                >
                                                </upload-image>
                                                <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group wt-btnarea">
                                        <input type="submit" value="{{ trans('lang.update_location') }}" class="wt-btn">
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
