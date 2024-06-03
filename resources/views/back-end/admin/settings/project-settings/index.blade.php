<div class="la-inner-pages wt-haslayout">

<form action="" class="wt-formtheme wt-userform" id="project_settings_form" @submit.prevent="submitProjectSettings">
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.completed_projects') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-settingscontent la-settingsradio">
                <div class="wt-description"><p>{{ trans('lang.completed_project_note') }}</p></div>
                <switch_button v-model="enable_completed_projects">{{{ trans('lang.show_hide_job') }}}</switch_button>
                <input type="hidden" :value="enable_completed_projects" name="enable_completed_projects">
            </div>

        </div>
    </div>
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span>{{{ trans('lang.save_changes_note') }}}</span>
        <input type="submit" value="{{ trans('lang.btn_save') }}" class="wt-btn">
    </div>
</form>
</div>
