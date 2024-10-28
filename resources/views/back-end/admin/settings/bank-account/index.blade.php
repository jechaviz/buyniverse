<div class="la-inner-pages wt-haslayout">

<form action="" class="wt-formtheme wt-userform la-bank-detail" id="back-detail-form" @submit.prevent="submitBankDetail">
@csrf
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle la-switch-option">
            <h2>{{{ trans('lang.account_detail') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="form-group form-group-half toolip-wrapo">
                
                <input type="text" name="account_name" value="{{ $account_name }}" class="form-control" placeholder="{{ trans('lang.bank_account_name')}}">
            </div>
            <div class="form-group form-group-half toolip-wrapo">
                
                <input type="text" name="account_number" value="{{ $account_number }}" class="form-control" placeholder="{{ trans('lang.bank_account_number')}}">
            </div>
            <div class="form-group form-group-half toolip-wrapo">
                
                <input type="text" name="bank_name" value="{{ $bank_name }}" class="form-control" placeholder="{{ trans('lang.bank_name')}}">
            </div>
            <div class="form-group form-group-half toolip-wrapo">
                
                <input type="text" name="bank_routing_number" value="{{ $bank_routing_number }}" class="form-control" placeholder="{{ trans('lang.bank_routing_number')}}">
            </div>
            <div class="form-group form-group-half toolip-wrapo">
                
                <input type="text" name="bank_bic_swift" value="{{ $bank_bic_swift }}" class="form-control" placeholder="{{ trans('lang.bank_bic_swift')}}">
            </div>
            <div class="form-group form-group-half toolip-wrapo">
                
                <input type="text" name="bank_iban" value="{{ $bank_iban }}" class="form-control" placeholder="{{ trans('lang.bank_iban')}}">
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle la-switch-option">
            <h2>{{{ trans('lang.description') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <textarea name="description" class="form-control">{{ $bank_description }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle la-switch-option">
            <h2>{{{ trans('lang.instruction') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <textarea name="instruction" class="form-control">{{ $bank_instruction }}</textarea>
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
</div>
