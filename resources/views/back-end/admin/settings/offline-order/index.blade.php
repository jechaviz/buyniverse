<div class="la-inner-pages wt-haslayout">

<form action="" class="wt-formtheme wt-userform" id="order_settings_form" @submit.prevent="submitOrderSettings">
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.new_order_admin_email') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description"><p>{{ trans('lang.variables') }}</p></div>
            <ul>
                <li>%name% => user name</li>
                <li>%order_id% => order_id</li>
                <li>%signature% => signature</li>
            </ul>
        </div>
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="admin_order[subject]" value="{{ $new_order_subject }}" class="form-control" placeholder="{{ trans('lang.subject')}}">
            </div>
        </div>
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <textarea id="wt-tinymceeditor" name="admin_order[email_content]" class="wt-tinymceeditor" placeholder="{{ trans('lang.add_template_content'])') }}">{{ $new_order_content }}</textarea>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.employer_hire_email') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description"><p>{{ trans('lang.variables') }}</p></div>
            <ul>
                <li>%name% => user name</li>
                <li>%order_id% => order_id</li>
                <li>%signature% => signature</li>
            </ul>
        </div>
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <input type="text" name="employer_hire[subject]" value="{{ $employer_hiring_subject }}" class="form-control" placeholder="{{ trans('lang.subject')}}">
            </div>
        </div>
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                
                <textarea id="wt-tinymceemployereditor" name="employer_hire[email_content]" class="wt-tinymceeditor" placeholder="{{ trans('lang.add_template_content'])') }}">{{ $employer_hiring_content }}</textarea>
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
