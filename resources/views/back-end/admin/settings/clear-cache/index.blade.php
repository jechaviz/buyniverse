<div class="preloader-section" v-if="loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2>{{{ trans('lang.menu_clear_cache') }}}</h2>
    </div>
    
    <form action="" class="wt-formtheme wt-userform" id="form-cache-clear" @submit.prevent="clearCache">
    @csrf
        <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
            <div class="wt-settingscontent">
                <div class="wt-description">
                    <p>{{{ trans('lang.selected_cache_note') }}}</p>
                </div>
                <ul class="wt-accountinfo">
                    <li>
                        <switch_button v-model="clear_cache">{{{ trans('lang.clear_cache') }}}</switch_button>
                        <input type="hidden" :value="clear_cache" name="clear_cache">
                    </li>
                    <li>
                        <switch_button v-model="clear_views">{{{ trans('lang.clear_views') }}}</switch_button>
                        <input type="hidden" :value="clear_views" name="clear_views">
                    </li>
                    <li>
                        <switch_button v-model="clear_routes">{{{ trans('lang.clear_routes') }}}</switch_button>
                        <input type="hidden" :value="clear_routes" name="clear_routes">
                    </li>
                </ul>
            </div>
        </div>
    
    <input type="submit" value="{{ trans('lang.btn_clear_selected_cache') }}" class="wt-btn">
    </form>
</div>
<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2>{{{ trans('lang.clr_all_cache') }}}</h2>
    </div>
    
    <form action="" class="wt-formtheme wt-userform" id="cache-clear" @submit.prevent="clearAllCache">
    @csrf
        <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
            <div class="wt-settingscontent">
                <div class="wt-description">
                    <p>{{{ trans('lang.clear_all_cache_note') }}}</p>
                </div>
            </div>
        </div>
    
    <input type="submit" value="{{ trans('lang.btn_clear_all_cache') }}" class="wt-btn">
    </form>
</div>
