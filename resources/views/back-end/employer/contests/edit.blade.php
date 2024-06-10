@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
<div class="wt-haslayout wt-dbsectionspace">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 float-left">
            @if (session()->has('type'))
                @php session()->forget('type'); @endphp
            @endif
            <div class="preloader-section" v-if="loading" v-cloak>
                <div class="preloader-holder">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="wt-haslayout">
                <form action="{{ route('contests.update', $contest->id) }}" class="wt-haslayout" method="post">
                <!--<input type="hidden" name="_method" value="PUT">-->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                    
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>Start A Contest</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <div class="wt-jobdescription wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>Contest Details</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                                    <fieldset>
                                        <div class="form-group form-group-half">
                                            <h4><label for="start_date">Start Date</label></h4>
                                            <input type="datetime-local" name="start_date" class="form-control" value="{{ $contest->startdate }}" placeholder="Start Date">
                                        </div>
                                        <div class="form-group form-group-half">
                                            <h4><label for="end_date">End Date</label></h4>
                                            <input type="datetime-local" name="end_date" class="form-control" value="{{ $contest->enddate }}" placeholder="End Date">
                                        </div>
                                    </fieldset>
                                    <br>
                                    <div class="form-group form-group-half" style="display:flex;">                                            
                                        <input type="checkbox" id="show_participant" name="show_participant" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" @if($contest->show_participant == 'yes') checked @endif>
                                        <label for="show_participant">Show name of participants</label>
                                    </div>
                                    <div class="form-group form-group-half" style="display:flex;">
                                        <input type="checkbox" id="show_participant_to_provider" name="show_participant_to_provider" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" @if($contest->show_participant_to_provider == 'yes') checked @endif>
                                        <label for="show_participant_to_provider">Show the list of participants to the Provider</label>
                                    </div>
                                    <div class="form-group form-group-half" style="display:flex;">
                                        <input type="checkbox" id="show_participant_offer_to_provider" name="show_participant_offer_to_provider" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" @if($contest->show_participant_offer_to_provider == 'yes') checked @endif>
                                        <label for="show_participant_offer_to_provider">Show participant offers to the Provider</label>
                                    </div>
                                    <div class="form-group">
                                        <h4><label for="time_limit">Time limit for the Provider to send a better offer</label></h4>
                                        <input type="text" name="time_limit" class="form-control" value="{{ $contest->time_limit }}" placeholder="In minutes">
                                    </div>
                                </div>
                            </div>
                            <div class="wt-jobdescription wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>Automatic Offer</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                                    <div class="form-group" style="display:flex;">
                                        <input type="checkbox" id="automatic_offer" name="automatic_offer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;"  @if($contest->automatic_offer == 'yes') checked @endif>
                                        <label for="automatic_offer">Make your own automatic bid to encourage Providers to lower their costs.<br>If your offer is matched, you will offer a lower offer at a random time. Do you want to include your own automatic offer?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-jobdescription wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2>How do you want your offer to be given?</h2>
                                </div>
                                <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                                    <div class="form-group form-group-half" style="display:flex;">
                                        <input type="radio" id="automatic_offer_choice" name="automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="percentage" @if($contest->automatic_offer_choice == 'percentage') checked @endif>
                                        <label for="automatic_offer_choice">Percentage less than the best offer given by Providers</label>
                                    </div>
                                    <div class="form-group form-group-half" style="display:flex;">
                                        <input type="radio" id="automatic_offer_choice2" name="automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="amount" @if($contest->automatic_offer_choice == 'amount') checked @endif>
                                        <label for="automatic_offer_choice2">Fixed amount less than the best offer given by Providers</label>
                                    </div>
                                    <div class="form-group" style="display:flex;">
                                        <input type="text" id="automatic_offer_value" name="automatic_offer_value" class="form-control" placeholder="Enter Percentage/Amount for automatic bid" value="{{ $contest->automatic_offer_value }}">                                        
                                    </div>
                                    
                                    <div class="form-group" style="display:flex;margin-top: 20px;">
                                        <input type="text" id="awarded_allowed" name="awarded_allowed" class="form-control" placeholder="Number of Provider Award allowed" value="{{ $contest->awarded_allowed }}">                         
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                        </div>
                    </div>
                    <div class="wt-updatall">
                        <i class="ti-announcement"></i>
                        <span>{{{ trans('lang.save_changes_note') }}}</span>
                        <input type="submit" value="Update a Contest" class="wt-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('bootstrap_script')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    
@stop
@endsection
