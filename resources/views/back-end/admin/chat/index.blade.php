@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
<div id="message_center">
    <link rel="stylesheet" href="{{ asset('css/bootstrap1.min.css') }}">
    <style>
		@media (min-width: 992px)
		{
			
		.navbar-collapse.collapse {
			display: block!important;
			height: auto!important;
			padding-bottom: 0;
			overflow: visible!important;
		}
		}
	
        .btn {
            background-color: #ffffff;
            color: #b4b1b1;
            font-size: 14px;
            border: 1px solid #b4b1b1;
            outline: none;
            border-radius: 0;
        }

        .dropdown {
        position: absolute;
        display: inline-block;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        z-index: 1;
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }

        .dropdown-content a:hover {background-color: #ddd}

        .dropdown:hover .dropdown-content {
        display: block;
        }

        .btn:hover, .dropdown:hover .btn {
        background-color: #b4b1b1;
        color:white;
        }
    </style>
    <section class="wt-haslayout wt-dbsectionspace">
    
			<div class="row" style="margin-left: 10px;padding-bottom: 15px;">
				<ol class="wt-breadcrumb">
					<li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
					<li class="active">{{ trans('lang.conversations')}}</li>
				</ol>
			</div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 float-left">
                <div class="wt-dashboardbox">
                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        <h2>{{{ trans('lang.conversations') }}}</h2>
                        <form action="{{ url('admin/conversations/search') }}" class="wt-formtheme wt-formsearch" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">
                                <input type="text" name="keyword" value="{{{ request()->query('keyword', '') }}}"
                                    class="form-control" placeholder="{{{ trans('lang.ph_search_participants') }}}">
                                <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                            </div>
                        </fieldset>
                        </form>
                    </div>
                    @if (count($conversations) > 0)
                        <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                            <table class="wt-tablecategories wt-chattable" >
                                <thead>
                                    <tr>
                                        <th>{{{ trans('lang.participants') }}}</th>
                                        <th>{{{ trans('lang.action') }}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 0; @endphp
                                    @foreach ($conversations as $conv)
                                        @php
                                            $user = \App\User::find($conv->user_id);
                                            $user_name = \App\Helper::getUserName($conv->user_id);
                                            $receiver =  \App\User::find($conv->receiver_id);
                                            $receiver_name = \App\Helper::getUserName($conv->receiver_id);
                                        @endphp
                                        <tr class="del-{{$conv->user_id}}-{{$conv->receiver_id}}">
                                            <td>
                                                <a href="{{{ url(route('showUserProfile', ['slug' => $user->slug, 'role' => 'employer'])) }}}">{{{ $user_name }}}</a> , <a href="{{{ url(route('showUserProfile', ['slug' => $receiver->slug, 'role' => 'provider'])) }}}">{{$receiver_name}}</a>
                                            </td>
                                            <td>
                                                <span class="bt-content">
                                                    <div class="">
                                                        <!--<delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{$conv->user_id}}-{{$conv->receiver_id}}'" :message="'{{trans("lang.ph_conversation_delete_message")}}'" :url="'{{url('admin/conversation/delete')}}'"></delete>
                                                        <a v-on:click="viewConversation({{$conv->user_id}}, {{$conv->receiver_id}})" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-eye"></i>
                                                        </a>-->
                                                        <a v-on:click="viewConversation({{$conv->user_id}}, {{$conv->receiver_id}})"><button class="btn">View</button></a>
                                                        <div class="dropdown">
                                                            <button class="btn" style="border-left:1px solid #b4b1b1">
                                                                <i class="fa fa-caret-down"></i>
                                                            </button>
                                                            <div class="dropdown-content">
                                                                <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{$conv->user_id}}-{{$conv->receiver_id}}'" :message="'{{trans("lang.ph_conversation_delete_message")}}'" :url="'{{url('admin/conversation/delete')}}'"></delete>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @if ( method_exists($conversations,'links') )
                                {{ $conversations->links('pagination.custom') }}
                            @endif
                        </div>
                    @else
                        @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                            @include('extend.errors.no-record')
                        @else 
                            @include('errors.no-record')
                        @endif
                    @endif
                </div>
            </div>
            <transition name="fade">
                <conversation v-if="showConversation" :messages='messages' :conversation_users='users'></conversation>
            </transition>
        </div>
    </section>
</div>
@endsection