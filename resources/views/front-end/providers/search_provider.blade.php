@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@push('stylesheets')
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@section('title'){{ $f_list_meta_title }} @stop
@section('description', $f_list_meta_desc)
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('searchResults'); @endphp
    @if (file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php')))
        @include('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.providers'), 'inner_banner' => $f_inner_banner, 'show_banner' => $show_f_banner ]
        )
    @else 
        @include('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.providers'), 'inner_banner' => $f_inner_banner, 'show_banner' => $show_f_banner ]
        )
    @endif
    @if (Auth::user())
    @php
        $user = !empty(Auth::user()) ? Auth::user() : '';
        $role = !empty($user) ? $user->role : array();
        
    @endphp
    
    @endif
    <div id="quiz-home">
        <provider_search></provider_search>
    </div>
    
    
    @push('scripts')
        <!--<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script>
            if (APP_DIRECTION == 'rtl') {
                var direction = true;
            } else {
                var direction = false;
            }
            
            jQuery("#wt-categoriesslider").owlCarousel({
                item: 6,
                rtl:direction,
                loop:true,
                nav:false,
                margin: 0,
                autoplay:true,
                center: true,
                responsiveClass:true,
                responsive:{
                    0:{items:1,},
                    481:{items:2,},
                    768:{items:3,},
                    1440:{items:4,},
                    1760:{items:6,}
                }
            });
        </script>-->
    @endpush
@endsection

