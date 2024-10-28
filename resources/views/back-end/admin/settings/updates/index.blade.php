<div class="preloader-section" v-if="loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2>{{{ trans('lang.import_updates') }}}</h2>
    </div>
    
    <form action="" class="wt-formtheme wt-userform" id="import-updates" @submit.prevent="importUpdate({{ trans('lang.imprted') }}, {{ trans('lang.imprt_success') }}">
    @csrf
        <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
            <div class="wt-settingscontent">
                <div class="wt-description">
                    <p>{{{ trans('lang.import_updates_note') }}}</p>
                </div>
            </div>
        </div>
        <div class="wt-updatall la-updateall-holder">
            <i class="ti-announcement"></i>
            <span>{{{ trans('lang.save_update_note') }}}</span>
            
            <input type="submit" value="{{ trans('lang.btn_import_updates') }}" class="wt-btn">
        </div>
    </form>
</div>
