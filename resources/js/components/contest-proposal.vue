<template>
    <div style="width:100%;background-color: white; padding: 50px;">
        
        <form @submit.prevent="CreateContest()" v-if="!hasContest" >
            <div class="wt-jobdescription wt-tabsinfo">
                <div class="wt-tabscontenttitle">
                    <h2>{{ trans('lang.contest_details') }}</h2>
                </div>
                <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                    <fieldset>
                        <div class="form-group form-group-half">
                            <h4><label for="start_date">{{ trans('lang.start_date') }}</label></h4>
                            <input type="datetime-local" name="start_date" v-model="form.start_date" class="form-control" placeholder="Start Date" @change="startdate_change">
                        </div>
                        <div class="form-group form-group-half">
                            <h4><label for="end_date">{{ trans('lang.end_date') }}</label></h4>
                            <input type="datetime-local" name="end_date" v-model="form.end_date" class="form-control" placeholder="End Date">
                        </div>
                    </fieldset>
                    <br>
                    <div class="form-group form-group-half" style="display:flex;">                                            
                        <input type="checkbox" id="show_participant" name="show_participant" v-model="form.show_participant" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                        <label for="show_participant">{{ trans('lang.show_name_participants') }}</label>
                    </div>
                    <div class="form-group form-group-half" style="display:flex;">
                        <input type="checkbox" id="show_participant_to_freelancer" name="show_participant_to_freelancer" v-model="form.show_participant_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                        <label for="show_participant_to_freelancer">{{ trans('lang.show_list_participants') }}</label>
                    </div>
                    <div class="form-group form-group-half" style="display:flex;">
                        <input type="checkbox" id="show_participant_offer_to_freelancer" name="show_participant_offer_to_freelancer" v-model="form.show_participant_offer_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                        <label for="show_participant_offer_to_freelancer">{{ trans('lang.show_participant_offer') }}</label>
                    </div>
                    
                    <div class="form-group" style="margin-top: 30px;">
                        <h4><label for="time_limit">{{ trans('lang.time_limit_freelancer') }}</label></h4>
                        <input type="text" name="time_limit" v-model="form.time_limit" class="form-control" placeholder="In minutes">
                    </div>
                </div>
            </div>
            <div class="wt-jobdescription wt-tabsinfo">
                <div class="wt-tabscontenttitle">
                    <h2>{{ trans('lang.automatic_offer') }}</h2>
                </div>
                <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                    <div class="form-group" style="display:flex;">
                        <input type="checkbox" id="automatic_offer" name="automatic_offer" v-model="form.automatic_offer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                        <label for="automatic_offer">{{ trans('lang.make_automatic_offer') }}</label>
                    </div>
                </div>
            </div>
            <div class="wt-jobdescription wt-tabsinfo">
                <div class="wt-tabscontenttitle">
                    <h2>{{ trans('lang.how_offer_given') }}</h2>
                </div>
                <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                    <div class="form-group form-group-half" style="display:flex;margin-bottom: 50px;">
                        <input type="radio" id="automatic_offer_choice" name="automatic_offer_choice" v-model="form.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="percentage">
                        <label for="automatic_offer_choice">{{ trans('lang.automatic_offer_choice1') }}</label>
                    </div>
                    <div class="form-group form-group-half" style="display:flex;margin-bottom: 50px;">
                        <input type="radio" id="automatic_offer_choice2" name="automatic_offer_choice" v-model="form.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="amount">
                        <label for="automatic_offer_choice2">{{ trans('lang.automatic_offer_choice2') }}</label>
                    </div>
                    <div class="wt-tabscontenttitle" style="padding-left: 0px;margin-bottom: 0px;">
                        <h2>{{ trans('lang.amount_for_automatic_bid') }}</h2>
                    </div>
                    <div class="form-group" style="display:flex;">
                        <input type="text" id="automatic_offer_value" name="automatic_offer_value" v-model="form.automatic_offer_value" class="form-control" placeholder="Enter Percentage/Amount for automatic bid">                                        
                    </div>
                    <div class="wt-tabscontenttitle" style="padding-left: 0px;margin-bottom: 0px;">
                        <h2>{{ trans('lang.no_of_provider_allowed') }}</h2>
                    </div>
                    <div class="form-group" style="display:flex;margin-top: 20px;">
                        <input type="text" id="awarded_allowed" name="awarded_allowed" v-model="form.awarded_allowed" class="form-control" placeholder="Number of Provider Award allowed">                         
                    </div>
                </div>
            </div>
            <div class="wt-jobdescription wt-tabsinfo">
                <button type="submit" class="wt-btn float-right">{{ trans('lang.create') }}</button>
            </div>
        </form>
        <form @submit.prevent="editContest()" v-if="hasContest" >
        <div class="modal fade" id="editcontest" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true" style="overflow-y:auto;">
            <div class="modal-dialog modal-lg" id="edit-contest">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.edit_contest') }}</h5>
                    
                    <button type="button" class="close" @click="Close1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="job_id" v-model="form1.job_id">
                <div class="modal-body">
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.contest_details') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <h4><label for="start_date">{{ trans('lang.start_date') }}</label></h4>
                                    <input type="datetime-local" name="start_date" v-model="form1.start_date" class="form-control" placeholder="Start Date">
                                </div>
                                <div class="form-group form-group-half">
                                    <h4><label for="end_date">{{ trans('lang.end_date') }}</label></h4>
                                    <input type="datetime-local" name="end_date" v-model="form1.end_date" class="form-control" placeholder="End Date">
                                </div>
                            </fieldset>
                            <br>
                            <div class="form-group form-group-half" style="display:flex;">                                            
                                <input type="checkbox" id="show_participant" name="show_participant" v-model="form1.show_participant" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant">{{ trans('lang.show_name_participants') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="checkbox" id="show_participant_to_freelancer" name="show_participant_to_freelancer" v-model="form1.show_participant_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant_to_freelancer">{{ trans('lang.show_list_participants') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="checkbox" id="show_participant_offer_to_freelancer" name="show_participant_offer_to_freelancer" v-model="form1.show_participant_offer_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant_offer_to_freelancer">{{ trans('lang.show_participant_offer') }}</label>
                            </div>
                            <div class="form-group">
                                <h4><label for="time_limit">{{ trans('lang.time_limit_freelancer') }}</label></h4>
                                <input type="text" name="time_limit" v-model="form1.time_limit" class="form-control" placeholder="In minutes">
                            </div>
                        </div>
                    </div>
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.automatic_offer') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <div class="form-group" style="display:flex;">
                                <input type="checkbox" id="automatic_offer" name="automatic_offer" v-model="form1.automatic_offer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="automatic_offer">{{ trans('lang.make_automatic_offer') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.how_offer_given') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="radio" id="automatic_offer_choice" name="automatic_offer_choice" v-model="form1.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="percentage">
                                <label for="automatic_offer_choice">{{ trans('lang.automatic_offer_choice1') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="radio" id="automatic_offer_choice2" name="automatic_offer_choice" v-model="form1.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="amount">
                                <label for="automatic_offer_choice2">{{ trans('lang.automatic_offer_choice2') }}</label>
                            </div>
                            <div class="form-group" style="display:flex;">
                                <input type="text" id="automatic_offer_value" name="automatic_offer_value" v-model="form1.automatic_offer_value" class="form-control" placeholder="">                                        
                            </div>
                            
                            <div class="form-group" style="display:flex;margin-top: 20px;">
                                <input type="text" id="awarded_allowed" name="awarded_allowed" v-model="form1.awarded_allowed" class="form-control" placeholder="">                         
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" @click="Close1" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ trans('lang.update') }}</button>
                </div>
                
                </div>
            </div>
        </div>
        </form>
        <div class="row" v-if="hasContest">
                <!--<a @click="start(form1.id)" v-if="!form1.result" style="float:left;"><button class="wt-btn">{{ trans('lang.start_contest') }}</button></a>-->
                <!--<span v-if="form1.result">{{ trans('lang.contest_is_over') }}</span>-->
        </div>
        <div class="row" v-if="hasContest">
            <div class="col-md-6 wt-dashboardbox">
                <contest :contestid="form1.id"></contest>
            </div>
            <div class="col-md-6">
                <div class="wt-tabscontenttitle" style="text-align: center;font-size: 18px;font-weight: bold;background-color: rgb(0, 81, 120);">
                    <h2 style="color: white;">{{ trans('lang.details') }}</h2>
                </div>
                
                <table class="wt-tablecategories no-border">
                        <thead>
                            <tr>
                                <th>{{ trans('lang.name') }}</th> 
                                <th>{{ trans('lang.bid_amount') }}</th>
                                <th>{{ trans('lang.original_bid') }}</th>
                                <th>{{ trans('lang.saved') }}</th>
                                <th>{{ trans('lang.details') }}</th>
                            </tr>
                        </thead> 
                        <tbody v-for="value in participants" :key="value.id">
                            <tr>
                                <td>
                                    <span class="bt-content">{{ value.name }} <br> <span  style="font-size: 12px;">{{ value.tagline }}</span></span>
                                </td> 
                                <td>
                                    <span class="bt-content">$ {{ value.proposal.amount | numFormat }}</span> 
                                </td>
                                <td>
                                    <span class="bt-content">$ {{ value.proposal.original | numFormat }}</span> 
                                </td>
                                <td>
                                    <span class="bt-content">{{ value.proposal.saved }} %</span> 
                                </td>
                                <td>
                                    <span class="bt-content" @click="showrow(value.id)"> Expand <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                </td>
                            </tr>
                            <tr :id="'row-' + value.id" class="hidden">
                                <td colspan="5">
                                    <table class="wt-tablecategories">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('lang.number') }}</th> 
                                                <th>{{ trans('lang.bid_amount') }}</th>
                                                <th>{{ trans('lang.timestamp') }}</th>
                                            </tr>
                                        </thead> 
                                        <tbody v-for="bid, key1 in value.bids" :key="bid.id">
                                            <tr>
                                                <td>{{ ++key1 }}</td>
                                                <td>$ {{ bid.bid | numFormat }}</td>
                                                <td>{{ bid.created_at | datetime }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            
                            
                        </tbody>
                    </table>
                    <!--<canvas id="lineChart" ref="chart"></canvas>-->
                    <canvas id="myChart" ref="chart"></canvas>
            </div>
            
        </div>
        <div class="row" v-if="hasContest" style="margin-top: 20px;">
            <div class="col-md-6 wt-dashboardbox">
                <table class="wt-tablecategories no-border">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center;font-size: 15px;color: white;background-color: rgb(0, 81, 120);padding-top: 10px;padding-bottom: 10px;">{{ trans('lang.saving_summary') }}</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ trans('lang.initial_budget') }} : $ {{ job.price | numFormat }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ trans('lang.best_bid_before') }} : $ {{ job.best | numFormat }}
                                </td>
                                <td>
                                    {{ trans('lang.financial_saving') }} : $ {{ job.price - job.best | numFormat }} ( {{ job.financial  }} %)
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ trans('lang.best_bid_after') }} : $ {{ job.best_after | numFormat }}
                                </td>
                                <td>
                                    {{ trans('lang.additional_saving') }} : $ {{ job.best - job.best_after | numFormat }} ( {{ job.additional }} %)
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ trans('lang.final_project_cost') }} : $ {{ job.best_after | numFormat}}
                                </td>
                                <td><b>
                                    {{ trans('lang.total_saving') }}: $ {{ job.price - job.best_after | numFormat}} ( {{ job.total }} %)
                                    </b>
                                </td>
                            </tr>
                            
                            
                        </tbody>
                    </table>
                    <canvas id="barChart" ref="chart"></canvas>
                    
                
            </div>
            <div class="col-md-6 wt-dashboardbox">
                <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle" style="text-align: center;font-size: 15px;font-weight: bold;background-color: rgb(0, 81, 120);padding-top: 10px;padding-bottom: 10px;">
                            <h2 style="color:white;">{{ trans('lang.contest_details') }}                                
                            </h2>
                            
                        </div>
                        <a @click="edit_contest" v-if="form1.status == 'close' && !form1.result" style="float:right;"><button class="wt-btn float-right">{{ trans('lang.edit_contest') }}</button></a>
                        <div class="">
                            <table class="wt-tablecategories">
                                
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.job_title') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.title }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.start_date') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.start_date | datetime}}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.end_date') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.end_date | datetime }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.show_name_participants') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.show_participant }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.show_list_participants') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.show_participant_to_freelancer }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.show_participant_offer') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.show_participant_offer_to_freelancer }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.time_limit_offer') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.time_limit }} {{ trans('lang.minutes') }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.make_automatic_offer') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.automatic_offer }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.how_offer_given') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.automatic_offer_choice }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.automatic_offer_value') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.automatic_offer_value }}</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bt-content">{{ trans('lang.awarded_allowed') }}</span>
                                        </td> 
                                        <td>
                                            <span class="bt-content">{{ form1.awarded_allowed }}</span> 
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                
            </div>
        </div>

        <!--<div class="row" style="margin-top:30px;"  v-if="hasContest">
            <ul class="nav nav-tabs" style="width: 100%;">
                <li class="active"><a data-toggle="tab" href="#menu11">{{ trans('lang.saving') }}</a></li>
                <li><a data-toggle="tab" href="#menu12">{{ trans('lang.details') }}</a></li>
                <li><a data-toggle="tab" href="#menu13">{{ trans('lang.settings') }}</a></li>
            </ul>

            <div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e2dbd1 1px solid">
                <div id="menu11" class="tab-pane fade in active">
                    
                </div>
                <div id="menu12" class="tab-pane fade">
                    
                    
                </div>
                <div id="menu13" class="tab-pane fade">
                    
                </div>
            </div>
        </div>-->
        <!--<div class="wt-rightarea">
            <a v-if="!hasContest" @click="newcontest" style="float:right;margin-top: -90px;"><button class="wt-btn">{{ trans('lang.open_contest') }}</button></a>
            <a v-if="hasContest" @click="viewcontest" style="float:right;margin-top: -90px;"><button class="wt-btn">{{ trans('lang.view_contest') }}</button></a>
        </div>
        <form @submit.prevent="CreateContest()" v-if="!hasContest" >
        <div class="modal fade" id="newcontest" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.add_contest') }}</h5>
                    
                    <button type="button" class="close" @click="Close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="job_id" v-model="form.job_id">
                <div class="modal-body">
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.contest_details') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <h4><label for="start_date">{{ trans('lang.start_date') }}</label></h4>
                                    <input type="datetime-local" name="start_date" v-model="form.start_date" class="form-control" placeholder="Start Date" @change="startdate_change">
                                </div>
                                <div class="form-group form-group-half">
                                    <h4><label for="end_date">{{ trans('lang.end_date') }}</label></h4>
                                    <input type="datetime-local" name="end_date" v-model="form.end_date" class="form-control" placeholder="End Date">
                                </div>
                            </fieldset>
                            <br>
                            <div class="form-group form-group-half" style="display:flex;">                                            
                                <input type="checkbox" id="show_participant" name="show_participant" v-model="form.show_participant" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant">{{ trans('lang.show_name_participants') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="checkbox" id="show_participant_to_freelancer" name="show_participant_to_freelancer" v-model="form.show_participant_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant_to_freelancer">{{ trans('lang.show_list_participants') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="checkbox" id="show_participant_offer_to_freelancer" name="show_participant_offer_to_freelancer" v-model="form.show_participant_offer_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant_offer_to_freelancer">{{ trans('lang.show_participant_offer') }}</label>
                            </div>
                            
                            <div class="form-group" style="margin-top: 30px;">
                                <h4><label for="time_limit">{{ trans('lang.time_limit_freelancer') }}</label></h4>
                                <input type="text" name="time_limit" v-model="form.time_limit" class="form-control" placeholder="In minutes">
                            </div>
                        </div>
                    </div>
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.automatic_offer') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <div class="form-group" style="display:flex;">
                                <input type="checkbox" id="automatic_offer" name="automatic_offer" v-model="form.automatic_offer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="automatic_offer">{{ trans('lang.make_automatic_offer') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.how_offer_given') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="radio" id="automatic_offer_choice" name="automatic_offer_choice" v-model="form.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="percentage">
                                <label for="automatic_offer_choice">{{ trans('lang.automatic_offer_choice1') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="radio" id="automatic_offer_choice2" name="automatic_offer_choice" v-model="form.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="amount">
                                <label for="automatic_offer_choice2">{{ trans('lang.automatic_offer_choice2') }}</label>
                            </div>
                            <div class="form-group" style="display:flex;">
                                <input type="text" id="automatic_offer_value" name="automatic_offer_value" v-model="form.automatic_offer_value" class="form-control" placeholder="Enter Percentage/Amount for automatic bid">                                        
                            </div>
                            
                            <div class="form-group" style="display:flex;margin-top: 20px;">
                                <input type="text" id="awarded_allowed" name="awarded_allowed" v-model="form.awarded_allowed" class="form-control" placeholder="Number of Provider Award allowed">                         
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" @click="Close" class="btn btn-danger" data-dismiss="modal">{{ trans('lang.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('lang.create') }}</button>
                </div>
                
                </div>
            </div>
        </div>
        </form>
        <form @submit.prevent="editContest()" v-if="hasContest" >
        <div class="modal fade" id="editcontest" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true" style="overflow-y:auto;">
            <div class="modal-dialog modal-lg" id="edit-contest">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.edit_contest') }}</h5>
                    
                    <button type="button" class="close" @click="Close1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="job_id" v-model="form1.job_id">
                <div class="modal-body">
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.contest_details') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <h4><label for="start_date">{{ trans('lang.start_date') }}</label></h4>
                                    <input type="datetime-local" name="start_date" v-model="form1.start_date" class="form-control" placeholder="Start Date">
                                </div>
                                <div class="form-group form-group-half">
                                    <h4><label for="end_date">{{ trans('lang.end_date') }}</label></h4>
                                    <input type="datetime-local" name="end_date" v-model="form1.end_date" class="form-control" placeholder="End Date">
                                </div>
                            </fieldset>
                            <br>
                            <div class="form-group form-group-half" style="display:flex;">                                            
                                <input type="checkbox" id="show_participant" name="show_participant" v-model="form1.show_participant" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant">{{ trans('lang.show_name_participants') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="checkbox" id="show_participant_to_freelancer" name="show_participant_to_freelancer" v-model="form1.show_participant_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant_to_freelancer">{{ trans('lang.show_list_participants') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="checkbox" id="show_participant_offer_to_freelancer" name="show_participant_offer_to_freelancer" v-model="form1.show_participant_offer_to_freelancer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="show_participant_offer_to_freelancer">{{ trans('lang.show_participant_offer') }}</label>
                            </div>
                            <div class="form-group">
                                <h4><label for="time_limit">{{ trans('lang.time_limit_freelancer') }}</label></h4>
                                <input type="text" name="time_limit" v-model="form1.time_limit" class="form-control" placeholder="In minutes">
                            </div>
                        </div>
                    </div>
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.automatic_offer') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <div class="form-group" style="display:flex;">
                                <input type="checkbox" id="automatic_offer" name="automatic_offer" v-model="form1.automatic_offer" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;">
                                <label for="automatic_offer">{{ trans('lang.make_automatic_offer') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="wt-jobdescription wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>{{ trans('lang.how_offer_given') }}</h2>
                        </div>
                        <div class="wt-formtheme wt-userform wt-userformvtwo la-job-details-form">
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="radio" id="automatic_offer_choice" name="automatic_offer_choice" v-model="form1.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="percentage">
                                <label for="automatic_offer_choice">{{ trans('lang.automatic_offer_choice1') }}</label>
                            </div>
                            <div class="form-group form-group-half" style="display:flex;">
                                <input type="radio" id="automatic_offer_choice2" name="automatic_offer_choice" v-model="form1.automatic_offer_choice" class="form-control" style="height: 23px;width: 23px;margin-right: 23px;" value="amount">
                                <label for="automatic_offer_choice2">{{ trans('lang.automatic_offer_choice2') }}</label>
                            </div>
                            <div class="form-group" style="display:flex;">
                                <input type="text" id="automatic_offer_value" name="automatic_offer_value" v-model="form1.automatic_offer_value" class="form-control" placeholder="">                                        
                            </div>
                            
                            <div class="form-group" style="display:flex;margin-top: 20px;">
                                <input type="text" id="awarded_allowed" name="awarded_allowed" v-model="form1.awarded_allowed" class="form-control" placeholder="">                         
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" @click="Close1" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ trans('lang.update') }}</button>
                </div>
                
                </div>
            </div>
        </div>
        </form>
        <div class="modal fade" id="viewcontest" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg" id="view-contest">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.view_contest') }}</h5>
                    
                    <button type="button" class="close" @click="Close2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row" style="margin-bottom: 25px;">
                        <div class="col-md-6">
                            <a @click="start(form1.id)" v-if="!form1.result" style="float:left;"><button class="wt-btn">{{ trans('lang.start_contest') }}</button></a>
                            <span v-if="form1.result">{{ trans('lang.contest_is_over') }}</span>
                        </div>
                        <div class="col-md-6">
                            <a @click="edit_contest" v-if="form1.status == 'close' && !form1.result" style="float:right;"><button class="wt-btn">{{ trans('lang.edit_contest') }}</button></a>
                        </div>
                        
                    </div>
                    <div class="row" style="margin-top:30px;">
                        <ul class="nav nav-tabs" style="width: 100%;">
                            <li class="active"><a data-toggle="tab" href="#menu11">{{ trans('lang.saving') }}</a></li>
                            <li><a data-toggle="tab" href="#menu12">{{ trans('lang.details') }}</a></li>
                            <li><a data-toggle="tab" href="#menu13">{{ trans('lang.settings') }}</a></li>
                        </ul>

                        <div class="tab-content" style="width: 100%;margin: 10px;background-color: white;border: #e2dbd1 1px solid">
                            <div id="menu11" class="tab-pane fade in active">
                                <table class="wt-tablecategories">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('lang.saving_summary') }}</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ trans('lang.initial_budget') }} : $ {{ job.price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{ trans('lang.best_bid_before') }} : $ {{ job.best }}
                                            </td>
                                            <td>
                                                {{ trans('lang.financial_saving') }} : $ {{ job.price - job.best }} ( {{ job.financial }} %)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{ trans('lang.best_bid_after') }} : $ {{ job.best_after }}
                                            </td>
                                            <td>
                                                {{ trans('lang.additional_saving') }} : $ {{ job.best - job.best_after }} ( {{ job.additional }} %)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{ trans('lang.final_project_cost') }} : $ {{ job.best_after }}
                                            </td>
                                            <td><b>
                                                {{ trans('lang.total_saving') }}: $ {{ job.price - job.best_after }} ( {{ job.total }} %)
                                                </b>
                                            </td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                                
                                <canvas id="barChart" ref="chart"></canvas>
                            </div>
                            <div id="menu12" class="tab-pane fade">
                                <table class="wt-tablecategories">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('lang.name') }}</th> 
                                            <th>{{ trans('lang.bid_amount') }}</th>
                                            <th>{{ trans('lang.original_bid') }}</th>
                                            <th>{{ trans('lang.saved') }}</th>
                                            <th>{{ trans('lang.details') }}</th>
                                        </tr>
                                    </thead> 
                                    <tbody v-for="value in participants" :key="value.id">
                                        <tr>
                                            <td>
                                                <span class="bt-content">{{ value.name }}</span>
                                            </td> 
                                            <td>
                                                <span class="bt-content">{{ value.proposal.amount }}</span> 
                                            </td>
                                            <td>
                                                <span class="bt-content">{{ value.proposal.original }}</span> 
                                            </td>
                                            <td>
                                                <span class="bt-content">{{ value.proposal.saved }} %</span> 
                                            </td>
                                            <td>
                                                <span class="bt-content" @click="showrow(value.id)"> Expand <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            </td>
                                        </tr>
                                        <tr :id="'row-' + value.id" class="hidden">
                                            <td colspan="5">
                                                <table class="wt-tablecategories">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ trans('lang.number') }}</th> 
                                                            <th>{{ trans('lang.bid_amount') }}</th>
                                                            <th>{{ trans('lang.timestamp') }}</th>
                                                        </tr>
                                                    </thead> 
                                                    <tbody v-for="bid, key1 in value.bids" :key="bid.id">
                                                        <tr>
                                                            <td>{{ ++key1 }}</td>
                                                            <td>{{ bid.bid }}</td>
                                                            <td>{{ bid.created_at | datetime }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                                
                                
                                <canvas id="myChart" ref="chart"></canvas>
                                
                            </div>
                            <div id="menu13" class="tab-pane fade">
                                <div class="wt-dashboardbox">
                                    <div class="wt-dashboardboxtitle">
                                        <h2>{{ trans('lang.contest_details') }}</h2>
                                    </div>
                                    <div class="wt-dashboardboxcontent wt-jobdetailsholder">
                                        <table class="wt-tablecategories">
                                            
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.job_title') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.title }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.start_date') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.start_date | formatDate}}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.end_date') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.end_date | formatDate }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.show_name_participants') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.show_participant }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.show_list_participants') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.show_participant_to_freelancer }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.show_participant_offer') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.show_participant_offer_to_freelancer }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.time_limit_offer') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.time_limit }} {{ trans('lang.minutes') }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.make_automatic_offer') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.automatic_offer }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.how_offer_given') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.automatic_offer_choice }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.automatic_offer_value') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.automatic_offer_value }}</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="bt-content">{{ trans('lang.awarded_allowed') }}</span>
                                                    </td> 
                                                    <td>
                                                        <span class="bt-content">{{ form1.awarded_allowed }}</span> 
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
                
                
                </div>
            </div>
        </div>-->
    </div>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
import moment from 'moment';
import Chart from 'chart.js/auto'
import 'chartjs-adapter-moment';
import ApexCharts from 'apexcharts'
export default {   
 data () {
    return {
        //contest: {},
        form : new Form({
            id: '',
            start_date : '',
            end_date : '',
            show_participant : '',
            show_participant_to_freelancer : '',
            show_participant_offer_to_freelancer : '',
            time_limit : '',
            automatic_offer : '',
            automatic_offer_choice : '',
            automatic_offer_value : '',
            awarded_allowed : '',
            job_id : this.jobid            
        }),
        form1 : new Form({
            id: '',
            start_date : '',
            end_date : '',
            show_participant : '',
            show_participant_to_freelancer : '',
            show_participant_offer_to_freelancer : '',
            time_limit : '',
            automatic_offer : '',
            automatic_offer_choice : '',
            automatic_offer_value : '',
            awarded_allowed : '',
            job_id : this.jobid,
            title : '',
            status : '',
            result : ''         
        }),
        hasContest: false,
        participants : {},
        job : {},
        myChart : []        
    }
  },
  props: {
      jobid: String
  },
  methods: {
        
        newcontest() 
        {       
            this.form.reset();
            $('#newcontest').modal('show');   
            $('#newcontest').addClass('show');
        },
        startdate_change() {
            //console.log('date updated', this.form.start_date);
            var startdate = this.form.start_date; 
            var enddate = moment(startdate).add(1, 'hours').format('YYYY-MM-DDThh:mm');
            this.form.end_date = enddate;
            //console.log(this.form.end_date);
        },
        start(id) {
            if(id)
            {
                //console.log(this.participants.length)
                if(this.participants.length == 0)
                {
                    //console.log('true');
                    toast.fire({
                    type: 'error',
                    title: 'No Participants added to the Contest'
                    });
                }
                else                
                    window.location.href="/contests/start/"+id;
            }
            else
            {
                toast.fire({
                type: 'error',
                title: 'No Participants added to the Contest'
                });
                location.reload();
            }
                
        },
        viewcontest() 
        {       
            
            $('#viewcontest').modal('show');   
            $('#viewcontest').addClass('show');
            //$('#view-contest').addClass('show');
            //$('#edit-contest').addClass('hidden');

            
        },
        showrow(id) {
            var clas = 'row-' + id;
            if ($('#' + clas).hasClass("hidden")) {
            $('#' + clas).removeClass('hidden');
            }
            else
            {
            $('#' + clas).addClass('hidden');
            }
        },
        edit_contest() {
            
            $('#editcontest').modal('show');
            $('#editcontest').addClass('show')
            $('#viewcontest').modal('hide');
            $('#viewcontest').removeClass('show');
        },
        Close() {
            $('#newcontest').removeClass('show');
        },
        Close1() {
            $('#editcontest').removeClass('show');
        },
        Close2() {
            $('#viewcontest').modal('hide');
            $('#viewcontest').removeClass('show');
        },
        CreateContest() {
            //console.log(this.form);
            let self = this;
            this.form.post('/api/contest_proposal/')
            .then((response) => {
                toast.fire({
                type: 'success',
                title: 'Contest Created successfully'
                });
                this.hasContest = true;
                self.form1.id = response.data.id;
                //console.log(response.data);
                Fire.$emit('Aftercontestupdate');
                Fire.$emit('Aftercontestcreate', response.data.id);
                
                
                /*$('#addnew').modal('hide');
                $('#newcontest').removeClass('show');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();*/
                
                
            })
            .catch(() => {

            })
        },
        editContest() {
            this.form1.put('/api/contest_proposal/'+ this.form1.id)
            .then(() => {
                toast.fire({
                type: 'success',
                title: 'Contest Updated successfully'
                });
                Fire.$emit('Aftercontestupdate');
                Fire.$emit('Aftercontestcreate', this.form1.id);
                $('#editcontest').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
                $('#editcontest').removeClass('show in');
            })
            .catch(() => {

            })
        },
        loadcontest() {
            let self = this;
            axios.get(APP_URL + '/api/contest_proposal/hascontest/' + this.jobid).then(function (response) { 
                //console.log('contest loaded');               
                //console.log(response.data);
                if(response.data)
                {   
                    self.hasContest = true;
                    //console.log(self.form1.id);
                    self.form1.id = response.data.id;
                                        
                    //self.form1.start_date = response.data.start_date;
                    self.form1.start_date = moment(response.data.start_date).format('YYYY-MM-DDThh:mm');
                    self.form1.end_date = moment(response.data.end_date).format('YYYY-MM-DDThh:mm');
                    //self.form1.end_date = response.data.end_date;                    
                    self.form1.show_participant = response.data.show_participant;                    
                    self.form1.show_participant_to_freelancer = response.data.show_participant_to_freelancer;                    
                    self.form1.show_participant_offer_to_freelancer = response.data.show_participant_offer_to_freelancer;                    
                    self.form1.time_limit = response.data.time_limit;                    
                    self.form1.automatic_offer = response.data.automatic_offer;                    
                    self.form1.automatic_offer_choice = response.data.automatic_offer_choice;                    
                    self.form1.automatic_offer_value = response.data.automatic_offer_value;                    
                    self.form1.awarded_allowed = response.data.awarded_allowed;
                    self.form1.title = response.data.title;
                    self.form1.status = response.data.status;
                    self.form1.result = response.data.result;
                    self.participants = response.data.participants;
                    self.job = response.data.job;
                    window.onload = function () {
                    var datasetx = [];
                    var colors = [ '#2685CB', '#4AD95A', '#FEC81B', '#FD8D14', '#CE00E6', '#4B4AD3', '#FC3026', '#B8CCE3', '#6ADC88', '#FEE45F'];
                    var mindate = moment(response.data.min, 'YYYY-MM-DDTHH:mm');
                    var maxdate = moment(response.data.max, 'YYYY-MM-DDTHH:mm');
                    $.each(self.participants, function(key, value) {
                        var datal = value.chart1;
                        
                        var chart_data = [];
                        
                        for (var i = 0; i < datal[0].length; i++) {                        
                            var datetime = moment(datal[0][i]['created_at'], 'YYYY-MM-DDTHH:mm');
                            
                            chart_data.push({x: datetime, y: datal[0][i]['bid']});
                        }                        
                        var setx = {
                            data: chart_data,
                            label: value.name,
                            borderColor: colors[key],
                            backgroundColor: colors[key],
                            borderStyle: 'solid',
                            borderWidth:2
                        };
                        datasetx.push(setx);
                        
                    });
                    var mindate = moment(mindate).subtract(2, 'hours');
                    var maxdate = moment(maxdate).add(2, 'hours');
                    var chart = $("#myChart");
                    
                    var ctx = chart[0].getContext("2d");
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: response.data.name,
                            datasets: datasetx
                        },
                        options: {
                            
                            scales: {
                                x: {
                                    type: 'time',
                                    distribution: 'linear',
                                    display: true,
                                    title: {
                                    display: true,
                                    text: 'Date'
                                    },
                                    min: mindate,
                                    max: maxdate,
                                    ticks: {
                                        beginAtZero:false,
                                        fontSize: 14,
                                        
                                    }
                                }
                            }
                            
                        }
                    });
                    
                    var chart1 = $("#barChart");
                    
                    var ctx1 = chart1[0].getContext("2d")
                    var barChart = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: response.data.name,
                            datasets: [{ 
                                data: response.data.chart1,
                                label: "Original bid",
                                borderColor: "rgb(62,149,205)",
                                backgroundColor: "rgb(62,149,205,0.1)",
                                borderWidth:2
                            }, { 
                                data: response.data.chart2,
                                label: "Updated Bid",
                                borderColor: "rgb(60,186,159)",
                                backgroundColor: "rgb(60,186,159,0.1)",
                                borderWidth:2
                            }, 
                            ]
                        }
                    });

                    var chart2 = $("#lineChart");
                    
                    var ctx2 = chart2[0].getContext("2d")
                    var barChart = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: response.data.name,
                            datasets: datasetx
                        }
                    });
                    }

                    
                }
                else
                {
                    var now =moment().format('YYYY-MM-DDThh:mm');
                    //console.log(now);
                    self.form.start_date = now; 
                    var enddate = moment(now).add(1, 'hours').format('YYYY-MM-DDThh:mm');
                    self.form.end_date = enddate;
                }
                
                
            });
            
            
        }
           


  },
 
    mounted: function() {
      
      this.loadcontest();
      
      Fire.$on('Aftercontestupdate', () => {
                //console.log('after change');
                this.loadcontest();
            });
  }
};
</script>