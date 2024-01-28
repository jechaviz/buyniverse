@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    
    <section class="wt-haslayout wt-dbsectionspace la-dbproposal" id="jobs">
        @if (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        @php
                        $user = !empty(Auth::user()) ? Auth::user() : '';
                        $role = !empty($user) ? $user->role : array();
                        @endphp
                        <div class="row" style="margin-left: 10px;padding-bottom: 15px;">
                            <ol class="wt-breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('lang.home') }}</a></li>
                                <li><a href="{{{ url($role.'/dashboard') }}}">{{ trans('lang.dashboard') }}</a></li>
                                
                                <li class="active">{{ trans('lang.contest')}}</li>
                            </ol>
                        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                
                <div class="wt-dashboardbox">
                    <div class="wt-dashboardboxtitle">
                        <h2>{{ trans('lang.contest')}} related to project # {{$job->id}} {{$job->title}}</h2>
                        <div class="wt-rightarea"> </div>
                    </div>
                    <job_contest contestid = "{{ $contest->id }}"></job_contest>
                    <chatroom jobid= "{{ $job->id }}" userid="{{ Auth::user()->id }}"></chatroom>
                    <!--<div class="wt-dashboardboxcontent wt-jobdetailsholder">
                        
                        <table class="wt-tablecategories" style="width: 500px;border: 2px #e0e0e0 solid;">
                            <tbody>
                                <tr><td><p id="demo" style="margin-bottom: 0;"></p></td></tr>
                                <tr><td>Your Position :  {{ $contest_user1->your_rank }}</td></tr>
                                <tr><td>Best Bid :  {{ $contest_user1->best_bid }}</td></tr>
                                <tr><td>Your Bid :  {{ $contest_user1->your_bid }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="wt-dashboardboxcontent wt-jobdetailsholder">

                        <table class="wt-tablecategories">
                            @if($contest->show_participant_to_provider == 'yes')
                            @if (!empty($contest_user1) && $contest_user1->count() > 0)                           
                            <thead>
                                <th>{{ trans('lang.name')}}</th>
                                @if($contest->show_participant_offer_to_provider == 'yes')
                                <th>{{ trans('lang.project_bid')}}</th>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($contest_user1 as $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    @if($contest->show_participant_offer_to_provider == 'yes')
                                    <td>{{ $value->bid }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                                @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                    @include('extend.errors.no-record')
                                @else 
                                    @include('errors.no-record')
                                @endif
                            @endif
                            @endif
                        </table>    
                        
                        
                    </div>-->
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            </div>
        </div>
        </section>
@endsection


@push('scripts')
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
    /*var botmanWidget = {
        title:'Job-bot',
        aboutText: '',
        introMessage: "Dear {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}, thank you for participating in the tender for {{ $job->title }}.<br><br> Please say status for learning status of the contest.",
        userId : {{ $contest->id }}
    };*/
    /*$(document).ready(function(){
    var startdate = new Date( "{{ $contest->start_date }}" ).getTime();
    var enddate = new Date( "{{ $contest->end_date }}" ).getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
        
    // Find the distance between now and the count down date
    var distance = startdate - now;
    var distance1 = enddate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    var days1 = Math.floor(distance1 / (1000 * 60 * 60 * 24));
    var hours1 = Math.floor((distance1 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes1 = Math.floor((distance1 % (1000 * 60 * 60)) / (1000 * 60));
    var seconds1 = Math.floor((distance1 % (1000 * 60)) / 1000);
        
    //document.getElementById("botmanWidgetRoot").style.display = "none";
    
        
    // If the count down is over, write some text 
    if (distance1 < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Contest is over";                
        
    }
    else if (distance <0) {
        //clearInterval(x);
        document.getElementById("demo").innerHTML = "Remaining Time : " + days1 + "d " + hours1 + "h " + minutes1 + "m " + seconds1 + "s ";
        //document.getElementById("botmanWidgetRoot").style.display = "block";
    }
    else {
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        
    }
    }, 1000);
    });*/
    /*document.getElementById("userText").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            console.log('messsage sent');
        }
    });*/
    /*var chattextbox = document.getElementById("userText");
    chattextbox.addEventListener("keyup", ({key}) => {
        if (key === "Enter") {
            console.log('messsage sent');
        }
    });*/
    /*$("#userText").addEventListener("keyup", function(event) {
        if ($("#userText").event.key == "Enter") {
            console.log('messsage sent');
        }
    });
    $(document).ready(function(){
        $('#userText').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                alert('You pressed a "enter" key in textbox');
            }
        });
    });*/
</script>

<!--<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>-->
@endpush 
