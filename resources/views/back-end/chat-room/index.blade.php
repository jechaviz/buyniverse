@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <style>
        main#wt-main {
            padding: 0!important;
        }
        .wt-offersmessages .wt-ad:after {
            background: none!important;
        }
    </style>
    <section class="wt-haslayout wt-dbsectionspace" style="padding: 0;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="message_center">
                <div class="wt-dashboardbox wt-messages-holder">
                    <div class="wt-dashboardboxtitle">
                        <h2>{{ trans('lang.msgs') }}
                        <div class="row"  style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li class="active">{{ trans('lang.msgs')}}</li>
                            </ol>
                        </div>
                        </h2>
                        
                    </div>
                    
                    <message-center 
                        :empty_field="'{{ trans('lang.empty_field') }}'" 
                        :host="'{{!empty($chat_settings['host']) ? $chat_settings['host'] : ''}}'" 
                        :port="'{{!empty($chat_settings['port']) ? $chat_settings['port'] : ''}}'">
                    </message-center>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('js/linkify.min.js') }}"></script>
    <script src="{{ asset('js/linkify-jquery.min.js') }}"></script>
@endpush
