<div class="wt-dashboardtabs">
    <ul class="wt-tabstitle nav navbar-nav">
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName()==='personalDetail'? 'active': '' }}}" href="{{{ route('employerPersonalDetail') }}}">{{{ trans('lang.profile_detail') }}}</a>
        </li>
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName()==='employerDetail'? 'active': '' }}}" href="{{{ route('employerDetail') }}}">{{{ trans('lang.employer_detail') }}}</a>
        </li>
        @if($employer->id)
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName()==='addressDetail'? 'active': '' }}}" href="{{{ route('addressDetail') }}}">{{{ trans('lang.address_detail') }}}</a>
        </li>
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName()==='contactDetail'? 'active': '' }}}" href="{{{ route('contactDetail') }}}">{{{ trans('lang.contact_detail') }}}</a>
        </li>
        @endif
    </ul>
</div>