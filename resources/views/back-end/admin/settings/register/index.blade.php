
    
<form action="{{ url('admin/store/registration-settings') }}" class="wt-formtheme wt-userform" method="post" id="registration-setting-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.registeration_form_type') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                        <select class="form-control" name="registration[0][registration_type]" v-model="reg_form_type">
                            @foreach ($registration_type as $key => $type)
                                @php $selected = $key == $selected_registration_type ? 'selected' : ''; @endphp
                                <option value="{{ $key }}" {{ $selected }}> {{ $type }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo" v-if="reg_form_type == 'single'">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.verification_type') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                        <select class="form-control" name="registration[0][verification_type]">
                            @foreach ($verification_types as $key => $type)
                                @php $selected = $key == $selected_verification_type ? 'selected' : ''; @endphp
                                <option value="{{ $key }}" {{ $selected }}> {{ $type }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo la-formstepone la-formsteps">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.registration_step1') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description"><p>{{ trans('lang.reg_step_1') }}</p></div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input type="text" name="registration[0][step1-title]" value="{{ $reg_one_title }}" class="form-control" placeholder="{{ trans('lang.title') }}">
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <textarea name="registration[0][step1-subtitle]" class="form-control" placeholder="{{ trans('lang.description'])') }}">{{ $reg_one_subtitle }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo la-formsteps" v-if="reg_form_type == 'multiple'">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.registration_step2') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description"><p>{{ trans('lang.reg_step_2') }}</p></div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input type="text" name="registration[0][step2-title]" value="{{ $reg_two_title }}" class="form-control" placeholder="{{ trans('lang.title') }}">
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <textarea name="registration[0][step2-subtitle]" class="form-control" placeholder="{{ trans('lang.description'])') }}">{{ $reg_two_subtitle }}</textarea>
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <textarea name="registration[0][step2-term-note]" class="form-control" placeholder="{{ trans('lang.term_note'])') }}">{{ $term_note }}</textarea>
                </div>
            </div>
        </div>
        <div class="wt-settingscontent la-settingsradio">
            <div class="wt-description"><p>{{ trans('lang.show_emplyr_inn_sec') }}</p></div>
            <switch_button v-model="show_emplyr_inn_sec">{{{ trans('lang.show_hide') }}}</switch_button>
            <input type="hidden" :value="show_emplyr_inn_sec" name="registration[0][show_emplyr_inn_sec]">
        </div>
    </div>
    <div class="wt-location wt-tabsinfo la-formsteps" v-if="reg_form_type == 'multiple'">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.registration_step3') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description"><p>{{ trans('lang.reg_step_3') }}</p></div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <input type="text" name="registration[0][step3-title]" value="{{ $reg_three_title }}" class="form-control" placeholder="{{ trans('lang.title') }}">
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <textarea name="registration[0][step3-subtitle]" class="form-control" placeholder="{{ trans('lang.description'])') }}">{{ $reg_three_subtitle }}</textarea>
                </div>
            </div>
        </div>
        <div class="wt-settingscontent la-footer-settings">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                        <select name="registration[0][step3-page]" class="" placeholder="{{ trans('lang.select_pages') }}">
                            @foreach ($pages as $page)
                                <option value="{{ $page->id }}" @if ($page->id == $reg_page) selected @endif>{{ $page->name }}</option>
                            @endforeach
                        </select>

                    </span>
                </div>
            </div>
        </div>
        @if (file_exists(resource_path('views/extend/back-end/admin/settings/register/image.blade.php')))
            @include('extend.back-end.admin.settings.register.image')
        @else
            @include('back-end.admin.settings.register.image')
        @endif
    </div>
    <div class="wt-location wt-tabsinfo la-formsteps" v-if="reg_form_type == 'multiple'">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.registration_step4') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description"><p>{{ trans('lang.reg_step_4') }}</p></div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <input type="text" name="registration[0][step4-title]" value="{{ $reg_four_title }}" class="form-control" placeholder="{{ trans('lang.title') }}">
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <textarea name="registration[0][step4-subtitle]" class="form-control" placeholder="{{ trans('lang.description'])') }}">{{ $reg_four_subtitle }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.registration_form_banner') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-settingscontent la-settingsradio">
                <div class="wt-description"><p>{{ trans('lang.reg_form_banner_note') }}</p></div>
                <switch_button v-model="show_reg_form_banner">{{{ trans('lang.enable_disable') }}}</switch_button>
                <input type="hidden" :value="show_reg_form_banner" name="registration[0][show_reg_form_banner]">
            </div>
        </div>
    </div>
    @if (file_exists(resource_path('views/extend/back-end/admin/settings/register/reg_form_banner.blade.php')))
        @include('extend.back-end.admin.settings.register.reg_form_banner')
    @else
        @include('back-end.admin.settings.register.reg_form_banner')
    @endif
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span>{{{ trans('lang.save_changes_note') }}}</span>
        <input type="submit" value="{{ trans('lang.btn_save') }}" class="wt-btn">
    </div>
    {{-- <div class="wt-updatall la-updateall-holder">
        
        <input type="submit" value="{{ trans('lang.btn_save') }}" class="wt-btn">
    </div> --}}
</form>
