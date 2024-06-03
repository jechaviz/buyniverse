@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="skills-listing" id="packages">
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
                    <li><a href="{{{ url($role.'/packages') }}}">{{ trans('lang.packages')}}</a></li>
					<li class="active">{{ trans('lang.edit_package')}}</li>
				</ol>
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_package') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            
                            <form action="{{ url('admin/packages/update/'.$package->slug.'') }}" class="wt-formtheme wt-packagesform" method="post" id="packages">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        
                                        <input type="text" name="package_title" value="{{ $package->title }}" class="form-control {{( $errors->has('package_title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_pkg_title')}}">
                                        @if ($errors->has('package_title'))                                        
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('package_title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        
                                        <input type="text" name="package_subtitle" value="{{ $package->subtitle }}" class="form-control {{( $errors->has('package_subtitle') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_pkg_subtitle')}}">
                                        @if ($errors->has('package_subtitle'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('package_subtitle') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">                                        
                                        <input type="number" name="package_price" value="{{ $package->cost }}" class="form-control {{( $errors->has('package_price') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_pkg_price')}}">
                                        @if ($errors->has('package_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('package_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="wt-settingscontent">
                                            @if (!empty($package['image']))
                                                <div class="wt-formtheme wt-userform">
                                                    <div v-if="this.uploaded_image">
                                                        <upload-image
                                                            :id="'package_image'"
                                                            :img_ref="'package_img'"
                                                            :url="'{{url('admin/packages/upload-temp-image')}}'"
                                                            :name="'uploaded_image'"
                                                            >
                                                        </upload-image>
                                                        <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                                    </div>
                                                    <div class="form-group" v-else>
                                                        <ul class="wt-attachfile">
                                                            <li>
                                                                <span>{{{ $package['image'] }}}</span>
                                                                <em>{{{trans('lang.file_size')}}} <span data-dz-size></span>
                                                                    <a class="dz-remove" href="javascript:void();" v-on:click.prevent="removeImage('hidden_img')" >
                                                                        <span class="lnr lnr-cross"></span>
                                                                    </a>
                                                                </em>
                                                            </li>
                                                        </ul>
                                                        <input type="hidden" name="uploaded_image" id="hidden_img" value="{{{$package['image']}}}">
                                                    </div>
                                                </div>
                                            @else
                                                <div class = "wt-formtheme wt-userform">
                                                    <upload-image
                                                        :id="'package_image'"
                                                        :img_ref="'package_ref'"
                                                        :url="'{{url('admin/packages/upload-temp-image')}}'"
                                                        :name="'uploaded_image'"
                                                        >
                                                    </upload-image>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($package->role_id == 2)
                                        <div class="form-group">
                                            
                                            <input type="text" name="employer[jobs]" value="{{ $options['jobs'] }}" class="form-control" placeholder="{{ trans('lang.no_of_jobs') }}">
                                            @if ($errors->has('employer[jobs]'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('employer[jobs]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="text" name="employer[featured_jobs]" value="{{ $options['featured_jobs'] }}" class="form-control" placeholder="{{ trans('lang.no_of_featuredjobs') }}">
                                            @if ($errors->has('employer[featured_jobs]'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('employer[featured_jobs]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('employer[duration]') ? ' is-invalid' : '' }}">
                                            <span class="wt-select">
                                                <select name="employer[duration]">
                                                    <option value="" disabled="">{{ trans('lang.select_duration') }}</option>
                                                    @foreach ($durations as $key => $duration)
                                                        @php $selected = $package_duration == $key ? 'selected' : ''; @endphp
                                                        <option value="{{$key}}" {{$selected}}>{{ Helper::getPackageDurationList($key) }}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                            @if ($errors->has('employer[duration]'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('employer[duration]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <switch_button v-model="banner_option">{{{ trans('lang.show_banner_opt') }}}</switch_button>
                                            <input type="hidden" :value="banner_option" name="employer[banner_option]">
                                        </div>
                                        <div class="form-group">
                                            <switch_button v-model="private_chat">{{{ trans('lang.enabale_disable_pvt_chat') }}}</switch_button>
                                            <input type="hidden" :value="private_chat" name="employer[private_chat]">
                                        </div>
                                        @if ($employer_trial->count() == 0)
                                            <div class="form-group">
                                                <span class="wt-checkbox">
                                                    <input id="trial" type="checkbox" name="trial">
                                                    <label for="trial"><span>{{{ trans('lang.enable_trial') }}}</span></label>
                                                </span>
                                            </div>
                                        @endif
                                        {{-- @if ($package->trial == 1)
                                            <div class="form-group">
                                                <span class="wt-checkbox">
                                                    <input id="trial" type="checkbox" name="trial" checked>
                                                    <label for="trial"><span>{{{ trans('lang.enable_trial') }}}</span></label>
                                                </span>
                                            </div>
                                        @endif --}}
                                    @elseif ($package->role_id == 3)
                                        <div class="form-group">
                                            
                                            <input type="number" name="provider[no_of_connects]" value="{{ $options['no_of_connects'] }}" class="form-control" placeholder="{{ trans('lang.no_of_connects')}}">
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="number" name="provider[no_of_skills]" value="{{ $options['no_of_skills'] }}" class="form-control" placeholder="{{ trans('lang.no_of_skills')}}">
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="number" name="provider[no_of_services]" value="{{ $no_of_services }}" class="form-control" placeholder="{{ trans('lang.provider_pkg_opt.no_of_services')}}">
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="number" name="provider[no_of_featured_services]" value="{{ $no_of_featured_services }}" class="form-control" placeholder="{{ trans('lang.provider_pkg_opt.no_of_featured_services')}}">
                                        </div>
                                        <div class="form-group">
                                            <span class="wt-select">
                                                <select name="provider[duration]">
                                                    <option value="" disabled="">{{ trans('lang.select_duration') }}</option>
                                                    @foreach ($durations as $key => $duration)
                                                        <option value="{{$key}}">{{ Helper::getPackageDurationList($key) }}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                        @if ($package->trial != 1)
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    
                                                    <select name="provider[badge]" placeholder="{{ trans('lang.select_badge') }}">
                                                        @foreach ($badges as $key => $value)
                                                            <option value="{{ $key }}" {{ $package->badge_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <switch_button v-model="banner_option">{{{ trans('lang.show_banner_opt') }}}</switch_button>
                                            <input type="hidden" :value="banner_option" name="provider[banner_option]">
                                        </div>
                                        <div class="form-group">
                                            <switch_button v-model="private_chat">{{{ trans('lang.enabale_disable_pvt_chat') }}}</switch_button>
                                            <input type="hidden" :value="private_chat" name="provider[private_chat]">
                                        </div>
                                        @if ($provider_trial->count() == 0)
                                            <div class="form-group">
                                                <span class="wt-checkbox">
                                                    <input id="trial" type="checkbox" name="trial">
                                                    <label for="trial"><span>{{{ trans('lang.enable_trial') }}}</span></label>
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                    <input type="hidden" value="{{{$package->role_id}}}" name="roles">
                                    <div class="form-group wt-btnarea">
                                        
                                        <input type="submit" value="{{ trans('lang.update_package') }}" class="wt-btn">
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
