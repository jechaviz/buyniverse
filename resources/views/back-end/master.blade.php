@extends('master')
@push('stylesheets')
    @stack('backend_stylesheets')
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dbresponsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/emojionearea.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/tinymce/skins/lightgray/skin.min.css') }}">
    <style>
        @media (min-width: 992px) and (max-width: 1199px) {
            .wt-blue-nav {
                /*margin-top: 43px;*/
            }
            #wt-main {
                margin-top: 50px;
            }
            .wt-navigation {
                position: inherit!important;
                margin-top: 15px;
            }
            .wt-header .wt-navigation > ul > li > a {
                border: none;
            }
        }
    </style>
@endpush
@section('header')
    @if (file_exists(resource_path('views/extend/includes/header.blade.php')))
        @include('extend.back-end.includes.header')
    @else 
        @include('back-end.includes.header')
    @endif
@endsection
@section('main')
	<main id="wt-main" class="wt-main wt-haslayout">
        @if (Auth::user())
            @if (file_exists(resource_path('views/extend/back-end/includes/dashboard-menu.blade.php')))
                @include('extend.back-end.includes.dashboard-menu')
            @else 
                @include('back-end.includes.dashboard-menu')
            @endif
		@endif
		@yield('content')
    </main>

@endsection
@push('scripts')
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.basictable.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        jQuery('.chosen-select').chosen();
        jQuery('.wt-tablecategories').basictable({
            breakpoint: 767,
        });
        jQuery('.wt-ordertable').basictable({ breakpoint: 420,});
    </script>
@endpush
