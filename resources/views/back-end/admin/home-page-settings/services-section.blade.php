<form action="" class="wt-formtheme wt-userform" id="services-sec-settings" @submit.prevent="submitServicesSectionSettings">
<div class="wt-tabscontenttitle la-switch-option">
    <h2>{{ trans('lang.show_services_sec') }}</h2>
    <switch_button v-model="show_services_section">{{{ trans('lang.show_hide_sec') }}}</switch_button>
    <input type="hidden" :value="show_services_section" name="show_services_section">
</div>
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.title') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <input type="text" name="title" value="{{ $service_sec_title }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.subtitle') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <input type="text" name="subtitle" value="{{ $service_sec_subtitle }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.description') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <textarea name="description" class="form-control  wt-tinymceeditor" id="wt-tinymceeditor">{!! $service_sec_description !!}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="wt-updatall la-updateall-holder">
    <i class="ti-announcement"></i>
    <span>{{{ trans('lang.save_changes_note') }}}</span>
    <input type="submit" value="{{ trans('lang.btn_save') }}" class="wt-btn">
</div>
</form>
