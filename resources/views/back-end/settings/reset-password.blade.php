@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @php $user_id = !empty(Auth::user()) ? Auth::user()->id : '';  @endphp
    <div class="wt-haslayout wt-dbsectionspace">
        <div class="wt-haslayout wt-reset-pass" id="pass-reset">
        <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.reset_pass')}}</li>
                            </ol>
                        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    @if (Session::has('error'))
                        <div class="flash_msg float-right">
                            <flash_messages :message_class="'danger'" :time='5' message="{{{ Session::get('error') }}}" v-cloak></flash_messages>
                        </div>
                    @endif
                    <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">
                        @if (file_exists(resource_path('views/extend/back-end/settings/tabs.blade.php')))
                            @include('extend.back-end.settings.tabs')
                        @else
                            @include('back-end.settings.tabs')
                        @endif
                        <div class="wt-tabscontent tab-content">
                            <div class="wt-passwordholder" id="wt-password">
                                <div class="wt-changepassword">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{{ trans('lang.change_pass') }}}</h2>
                                    </div>
                                    
                                    <form action="{{ url('profile/settings/request-password') }}" class="wt-formtheme wt-userform" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <fieldset>
                                            <div class="form-group form-group-half">
                                                
                                                <input type="password" name="old_password" class="form-control {{ .($errors->has('old_password') ? ' is-invalid' : '') }}" placeholder="{{ trans('lang.ph_oldpass') }}">
                                                @if ($errors->has('old_password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('old_password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group form-group-half">
                                                
                                                <input type="password" name="confirm_password" class="form-control" placeholder="{{ trans('lang.ph_newpass') }}">

                                            </div>
                                            <div class="form-group">
                                                
                                                <input type="password" name="confirm_new_password" class="form-control" placeholder="{{ trans('lang.ph_confirm_new_pass') }}">
                                            </div>
                                            
                                            <input type="hidden" name="user_id" value="{{ $user_id }}">

                                            <div class="form-group form-group-half wt-btnarea">
                                                
                                                <input type="submit" value="{{ trans('lang.btn_save') }}" class="wt-btn">
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
