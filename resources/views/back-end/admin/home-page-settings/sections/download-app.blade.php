@if (file_exists(resource_path('views/extend/back-end/admin/home-page-settings/sections/download-app-image.php'))) 
    @include('extend.back-end.admin.home-page-settings.sections.download-app-image')
@else 
    @include('back-end.admin.home-page-settings.sections.download-app-image')
@endif
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.app_sec_title') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="section[0][app_title]" value="{{ $app_title }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.app_sec_subtitle') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="section[0][app_subtitle]" value="{{ $app_subtitle }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.description') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <textarea id="app_desc_wt_tinymceeditor" name="app_desc" class="form-control wt-tinymceeditor">{{ $app_desc }}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.android_app_link') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="app_android_link" value="{{ $app_android_link }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6>{{{ trans('lang.ios_app_link') }}}</h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="app_ios_link" value="{{ $app_ios_link }}" class="form-control">
            </div>
        </div>
    </div>
</div>
