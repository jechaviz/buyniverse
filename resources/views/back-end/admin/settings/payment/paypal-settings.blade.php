
<form action="" class="wt-formtheme wt-userform" id="payment-form" @submit.prevent="submitPaypalSettings">
@csrf
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle la-switch-option">
            <h2>{{{ trans('lang.paypal_settings') }}}</h2>
            <switch_button v-model="enable_sandbox">{{{ trans('lang.enable_sandbox') }}}</switch_button>
            <input type="hidden" :value="enable_sandbox" name="enable_sandbox">
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input type="text" name="client_id" value="{{ $client_id }}" class="form-control" placeholder="trans('lang.ph_paypal_id')">
                </div>
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input id="password" type="password" class="form-control" name="paypal_password" value="{{ $payment_password }}" placeholder="{{ trans('lang.ph_paypal_pass') }}">
                </div> 
            </div>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input id="password" type="password" class="form-control" name="paypal_secret" value="{{ $existing_payment_secret }}" placeholder="{{ trans('lang.ph_paypal_secret') }}">
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
