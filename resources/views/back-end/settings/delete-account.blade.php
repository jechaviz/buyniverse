@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="wt-haslayout wt-delete-account wt-dbsectionspace" id="profile_settings">
    <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.delete_account')}}</li>
                            </ol>
                        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                @if (Session::has('message'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                    </div>
                    @elseif (Session::has('error'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
                    </div>
                @endif
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">
                    @if (file_exists(resource_path('views/extend/back-end/settings/tabs.blade.php'))) 
                        @include('extend.back-end.settings.tabs')
                    @else 
                        @include('back-end.settings.tabs')
                    @endif
                    <div class="wt-tabscontent tab-content">
                        <div class="wt-yourdetails wt-tabsinfo">
                            <div class="wt-tabscontenttitle">
                                <h2>{{{ trans('lang.delete_account') }}}</h2>
                            </div>
                            <div class="wt-formtheme wt-userform">
                                
                                <form action="{{ url('profile/settings/delete-user') }}" class="wt-formtheme wt-userform delete-user-form" method="post" id="delete_acc_form" @submit.prevent="deleteAccount($event)">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <fieldset>
                                        <div class="form-group form-group-half">
                                            
                                            <input type="password" name="old_password" class="form-control" placeholder="{{ trans('lang.ph_oldpass') }}">

                                        </div>
                                        <div class="form-group form-group-half">
                                            
                                            <input type="password" name="retype_password" class="form-control" placeholder="{{ trans('lang.ph_retype_pass') }}">
                                        </div>
                                        <div class="form-group">
                                            <span class="wt-select">
                                                
                                                <select name="delete_reason" class="">
                                                    <option value="" disabled selected>{{ trans('lang.select_reason') }}</option>
                                                    @foreach (Helper::getDeleteAccReason() as $reason)
                                                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                                                    @endforeach
                                                </select>

                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="delete_description" class="form-control" placeholder="{{{ trans('lang.ph_desc_optional') }}}"></textarea>
                                        </div>
                                        <div class="form-group form-group-half wt-btnarea">
                                            
                                            <input type="submit" value="{{ trans('lang.btn_delete_account') }}" class="wt-btn">
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
@endsection
