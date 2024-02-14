<div class="wt-dashboardtabs">
    <ul class="wt-tabstitle nav navbar-nav">
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName()==='ProviderPayoutsSettings'? 'active': '' }}}" href="{{{ route('ProviderPayoutsSettings') }}}">{{{ trans('lang.payout_settings') }}}</a>
        </li>
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName()==='getProviderPayouts'? 'active': '' }}}" href="{{{ route('getProviderPayouts') }}}">{{{ trans('lang.payouts') }}}</a>
        </li>
    </ul>
</div>