@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="packages-listing" id="packages">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace la-addpackages">
        <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.packages')}}</li>
                            </ol>
                        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_packages') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            
                            <form action="{{ url('admin/store/package') }}" class="wt-formtheme wt-packagesform" method="post" id="packages" @submit.prevent="submitPackage"> <!--id' => 'package_form'-->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        
                                        <input type="text" name="package_title" value="" class="form-control {{( $errors->has('package_title') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_pkg_title')}}">
                                        @if ($errors->has('package_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('package_title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        
                                        <input type="text" name="package_subtitle" value="" class="form-control {{( $errors->has('package_subtitle') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_pkg_subtitle')}}">
                                        @if ($errors->has('package_subtitle'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('package_subtitle') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        
                                        <input type="number" name="package_price" value="" class="form-control {{( $errors->has('package_price') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.ph_pkg_price')}}">
                                        @if ($errors->has('package_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('package_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="wt-settingscontent">
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
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('roles') ? ' is-invalid' : '' }}">
                                        <span class="wt-select">
                                            <select name="roles" v-model="user_role" v-on:change="selectedRole(user_role)">
                                                <option value="" disabled="">{{ trans('lang.select_users') }}</option>
                                                    @foreach ($roles as $key => $role)
                                                        <option value="{{{ $role['id'] }}}">{{{ $role['name'] }}}</option>
                                                    @endforeach
                                            </select>
                                        </span>
                                        @if ($errors->has('roles'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('roles') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div v-if="employer_options" v-cloak>
                                        <div class="form-group">
                                            
                                            <input type="text" name="employer[jobs]" value="" class="form-control {{( $errors->has('employer[jobs]') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.no_of_jobs')}}">
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="text" name="employer[featured_jobs]" value="" class="form-control {{( $errors->has('employer[featured_jobs]') ? ' is-invalid' : '')}}" placeholder="{{ trans('lang.no_of_featuredjobs')}}">
                                        </div>
                                        <div class="form-group {{ $errors->has('employer[duration]') ? ' is-invalid' : '' }}">
                                            <span class="wt-select">
                                                <select name="employer[duration]">
                                                    <option value="" disabled="">{{ trans('lang.select_duration') }}</option>
                                                        @foreach ($durations as $key => $duration)
                                                            <option value="{{$key}}">{{ Helper::getPackageDurationList($key) }}</option>
                                                        @endforeach
                                                </select>
                                            </span>
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
                                    </div>
                                    <div v-if="provider_options" v-cloak>
                                        <div class="form-group">
                                            
                                            <input type="text" name="provider[no_of_connects]" value="" class="form-control" placeholder="{{ trans('lang.no_of_connects')}}" v-model="package.conneects">
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="number" name="provider[no_of_services]" value="" class="form-control" placeholder="{{ trans('lang.provider_pkg_opt.no_of_services')}}" v-model="package.services">
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="number" name="provider[no_of_featured_services]" value="" class="form-control" placeholder="{{ trans('lang.provider_pkg_opt.no_of_featured_services')}}" v-model="package.featured_services">
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="text" name="provider[no_of_skills]" value="" class="form-control" placeholder="{{ trans('lang.no_of_skills')}}" v-model="package.skills">
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
                                        <div class="form-group">
                                            <span class="wt-select">
                                                
                                                <select name="provider[badge]" placeholder="{{ trans('lang.select_badge') }}">
                                                    @foreach ($badges as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
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
                                    </div>
                                    <div class="form-group wt-btnarea">
                                        
                                        <input type="submit" value="{{ trans('lang.add_packages') }}" class="wt-btn">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-right">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            <h2>{{{ trans('lang.packages') }}}</h2>
                            
                            <form action="{{ url('admin/packages/search') }}" class="wt-formtheme wt-formsearch" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="keyword" value="{{{ request()->query('keyword', '') }}}" class="form-control" placeholder="{{{ trans('lang.ph_search_packages') }}}">
                                        <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        @if (!empty($packages) || $packages->count() > 0)
                            <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                                <table class="wt-tablecategories">
                                    <thead>
                                        <tr>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.type') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($packages as $package)
                                            <tr class="del-{{{ $package->id }}}" v-bind:id="packageID">
                                                <td>{{{ $package->title }}}</td>
                                                <td>{{{ $package->slug }}}</td>
                                                <td>{{{ Helper::getRoleName($package->role_id) }}}</td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        <a href="{{{ url('admin/packages/edit') }}}/{{{ $package->slug }}}" class="wt-addinfo wt-packagesaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        @if ($package->trial != 1)
                                                            <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{$package->id}}'" :message="'{{trans("lang.ph_pkg_delete_message")}}'" :url="'{{url('admin/packages/delete-package')}}'"></delete>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($packages,'links') ) {{ $packages->links('pagination.custom') }} @endif
                            </div>
                        @else
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                @include('extend.errors.no-record')
                            @else 
                                @include('errors.no-record')
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
