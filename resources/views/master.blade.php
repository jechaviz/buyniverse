<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="" dir="{{Helper::getTextDirection()}}">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
		<title>Buyniverse</title>
	
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="icon" href="{{{ asset(Helper::getSiteFavicon()) }}}" type="image/x-icon">
	@stack('PackageStyle')
	<!--<link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!--<link href="https://cloud-ex42.usaupload.com/file/5cow/app.css" rel="stylesheet"> -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/normalize-min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/scrollbar-min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/fontawesome-all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('css/jquery-ui-min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/linearicons.css') }}" rel="stylesheet">
	@stack('sliderStyle')
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	@if(Helper::getTextDirection() == 'rtl')
		<link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
	@endif
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

	<link href="{{ asset('css/color.css') }}" rel="stylesheet">
	<link href="{{ asset('css/maintwo.css') }}" rel="stylesheet">
	@php echo \App\Typo::setSiteStyling(); @endphp
    <link href="{{ asset('css/transitions.css') }}" rel="stylesheet">
	@stack('stylesheets')
	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/')) !!}
		var APP_ASSET_URL = {!! json_encode(url('/')) !!}
		var readmore_trans = {!! json_encode(trans('lang.read_more')) !!}
		var less_trans = {!! json_encode(trans('lang.less')) !!}
		var Map_key = {!! json_encode(Helper::getGoogleMapApiKey()) !!}
		var APP_DIRECTION = {!! json_encode(Helper::getTextDirection()) !!}
	</script>
	@if (Auth::user())
		<script type="text/javascript">
			var USERID = {!! json_encode(Auth::user()->id) !!}
			window.Laravel = {!! json_encode([
			'csrfToken'=> csrf_token(),
			'user'=> [
				'authenticated' => auth()->check(),
				'id' => auth()->check() ? auth()->user()->id : null,
				'name' => auth()->check() ? auth()->user()->first_name : null,
				'image' => !empty(auth()->user()->profile->avater) ? asset('uploads/users/'.auth()->user()->id .'/'.auth()->user()->profile->avater) : asset('images/user-login.png'),
				'image_name' => !empty(auth()->user()->profile->avater) ? auth()->user()->profile->avater : '',
				]
				])
			!!};
		</script>
	@endif
	<script>
		window.trans = <?php
		$lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
		$trans = [];
		foreach ($lang_files as $f) {
			$filename = pathinfo($f)['filename'];
			$trans[$filename] = trans($filename);
		}
		echo json_encode($trans);
		?>;
	</script>
	@yield('styles_content')
</head>

<body class="wt-login {{Helper::getBodyLangClass()}} {{Helper::getTextDirection()}} {{empty(Request::segment(1)) ? 'home-wrapper' : '' }}">
	{{ \App::setLocale(env('APP_LANG')) }}
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	@php
		$general_settings = !empty(App\SiteManagement::getMetaValue('settings')) ? App\SiteManagement::getMetaValue('settings') : array();
		$enable_loader = !empty($general_settings) && !empty($general_settings[0]['enable_loader']) ? $general_settings[0]['enable_loader'] : true;
	@endphp
	@if (!empty($enable_loader) && ($enable_loader === true || $enable_loader === 'true'))
		<!--<div class="preloader-outer">
			<div class="preloader-holder">
				<div class="loader"></div>
			</div>
			<svg class="square-loader" width="100" height="100" viewBox="0 0 100 100">
				<polyline class="line-cornered stroke-still" points="0,0 100,0 100,100" stroke-width="10" fill="none"></polyline>
				<polyline class="line-cornered stroke-still" points="0,0 0,100 100,100" stroke-width="10" fill="none"></polyline>
				<polyline class="line-cornered stroke-animation" points="0,0 100,0 100,100" stroke-width="10" fill="none"></polyline>
				<polyline class="line-cornered stroke-animation" points="0,0 0,100 100,100" stroke-width="10" fill="none"></polyline>
			</svg>
			
		</div>-->
		<div class="loader1">
				<div class="loader__element"></div>
			</div>
	@endif
	<div id="wt-wrapper" class="wt-wrapper wt-haslayout wt-openmenu">
		<div class="wt-contentwrapper">
			@yield('header')
			@yield('slider')
			@yield('main')
			@yield('footer')
		</div>
	</div>
	@vite('resources/js/app.js')
	@yield('script_content')
	<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	@yield('bootstrap_script')
	<!--<script src="{{ asset('js/app.js') }}"></script>-->
	<!--<script src="{{ asset('js/vendor/jquery-library.js') }}"></script>-->
	<script src="{{ asset('js/scrollbar.min.js') }}"></script>
	<script src="{{ asset('js/particles.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-min.js') }}"></script>
    @stack('scripts')
    <script>
        jQuery(window).on("load",function() {
            jQuery(".preloader-outer").delay(500).fadeOut();
            jQuery(".pins").delay(500).fadeOut("slow");
        });
		jQuery(window).on("load",function() {
            jQuery(".loader1").delay(500).fadeOut();
            jQuery(".pins").delay(500).fadeOut("slow");
        });
		const Toast = Swal.mixin({
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.onmouseenter = Swal.stopTimer;
				toast.onmouseleave = Swal.resumeTimer;
			}
		});
    </script>
</body>
</html>
