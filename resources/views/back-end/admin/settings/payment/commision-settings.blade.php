
<form action="" class="wt-formtheme wt-userform" id="comission-form" @submit.prevent="submitCommisionSettings">
@csrf
    @if (file_exists(resource_path('views/extend/back-end/admin/settings/payment/site-payment-options.blade.php')))
        @include('extend.back-end.admin.settings.payment.site-payment-options')
    @else
        @include('back-end.admin.settings.payment.site-payment-options')
    @endif
    @if (file_exists(resource_path('views/extend/back-end/admin/settings/payment/payment-mode.blade.php')))
        @include('extend.back-end.admin.settings.payment.payment-mode')
    @else
        @include('back-end.admin.settings.payment.payment-mode')
    @endif
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.ph_currency_setting') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                    <select name="payment[0][currency]" class="form-control" data-placeholder = "{{trans('lang.ph_select_currency')}}">
                        @foreach ($currency as $key => $payment)
                            @php $selected = in_array($payment['value'], $existing_currency) ? 'selected': ''; @endphp
                            <option value="{{$payment['value']}}" {{$selected}}>{{$payment['title']}}</option>
                        @endforeach
                    </select>
                </span>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.commission_settings') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p>{{ trans('lang.set_comm_project') }}</p>
            </div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input type="number" name="payment[0][commision]" value="{{ $commision }}" class="form-control" placeholder="0">
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.min_payout') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p>{{ trans('lang.set_min_payout') }}</p>
            </div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    
                    <input type="number" name="payment[0][min_payout]" value="{{ $min_payout }}" class="form-control" placeholder="{{ trans('lang.ph_min_payout')}}">
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.select_payment_method') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                        <select name="payment[0][payment_method][]" class="chosen-select" multiple data-placeholder = "{{trans('lang.select_pay_method')}}">
                            @foreach ($payment_methods as $key => $payment_method)
                                @php $selected = in_array($payment_method['value'], $payment_gateway) ? 'selected': ''; @endphp
                                <option value="{{$payment_method['value']}}" {{$selected}}>{{$payment_method['title']}}</option>
                            @endforeach
                        </select>
                    </span>
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
