@if (file_exists(resource_path('views/extend/back-end/admin/home-page-settings/banner-settings/background-image.blade.php'))) 
    @include('extend.back-end.admin.home-page-settings.banner-settings.background-image')
@else 
    @include('back-end.admin.home-page-settings.banner-settings.background-image')
@endif
@if (file_exists(resource_path('views/extend/back-end/admin/home-page-settings/banner-settings/banner-image.blade.php'))) 
    @include('extend.back-end.admin.home-page-settings.banner-settings.banner-image')
@else 
    @include('back-end.admin.home-page-settings.banner-settings.banner-image')
@endif
<div class="wt-location wt-tabsinfo">
    <h5>{{{ trans('lang.banner_title') }}}</h5>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="home[0][banner_title]" value="{{ $banner_title }}" class="form-control">
            </div>
        </div>
        
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h5>{{{ trans('lang.banner_subtitle') }}}</h5>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="home[0][banner_subtitle]" value="{{ $banner_subtitle }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h5>{{{ trans('lang.banner_desc') }}}</h5>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <textarea name="home[0][banner_description]" class="form-control">{{ $banner_description }}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h5>{{{ trans('lang.banner_video_link') }}}</h5>
    <span>{{ trans('lang.video_note') }}</span>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="home[0][video_link]" value="{{ $banner_video_link }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h5>{{{ trans('lang.video_title') }}}</h5>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="home[0][video_title]" value="{{ $banner_video_title }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h5>{{{ trans('lang.video_desc') }}}</h5>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="home[0][video_desc]" value="{{ $banner_video_desc }}" class="form-control">
            </div>
        </div>
    </div>
</div>
