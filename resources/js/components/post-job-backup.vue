<template>
    <div>
    <div class="row">
        <div class="md-2" style="font-size: 70px;color: gold;">
            <i class="fa fa-trophy" aria-hidden="true"></i>
        </div>
        <div class="md-10" style="margin-left: 15px;">

            <h2 id="title" class="hidden">{{form.title}}</h2>
            <form @submit.prevent="posttitle()">
            <div class="form-group" id="posttitle">
                <input type="text" name="title" class="form-control" :placeholder="trans('lang.job_title')" v-model="form.title">
                <button type="submit" class="btn btn-sm x-submit-button" style="color: white;background-color: #005178;">
                    {{ trans('lang.post') }}
                </button>
            </div>
            </form>
            
        </div>
    </div>
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle">
            <h2>{{ trans('lang.post_job') }}</h2>
        </div>
        <div class="row" style="width: 100%;">
            <div class="col-md-7">
                <div style="margin: 30px;" class="hidden" id="description" v-html="form.description">
                    
                </div>
                
                <div style="margin: 30px;" id="editdescription" class="hidden" >
                    
                    <i @click="editdescription" class="fa fa-pencil" style="float:right;margin: 10px;"></i>
                    <form @submit.prevent="Updatedescription()">
                        <!--<textarea type="text" v-html="form.description" class="wt-tinymceeditor" name="description" id="datadescription"></textarea>-->
                        <tinymce id="datadescription" v-model="form.description" :other_options="{height:600}" ref="tm"></tinymce>
                        
                        <div class="x-button p-t-10 p-b-10 text-right" style="margin-top: 50px;">
                            <button type="button" @click="close" class="btn btn-default btn-sm" id="card-comment-close-button">
                                {{ trans('lang.close') }}
                            </button>
                            <!--submit button-->
                            <button type="submit" class="btn btn-sm x-submit-button" style="color: white;    background-color: #005178;" id="card-comment-post-button">
                                {{ trans('lang.post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">  
                <table style="margin-top: 30px;">
                    <tr id="tr1" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.project_levelx') }}</b></td>
                        <td @click="editprojectlevel" class="job-details" >
                            <span id="projectlevel" class="hidden"> {{ form.project_level }} <i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                            <div id="editprojectlevel" class="hidden">
                                <select class="form-control form-control-sm" id="editprojectlevel-select" name="editprojectlevel-select"  v-model="form.project_level" v-on:change="updateprojectlevel">
                                    <option selected>{{ trans('lang.select') }}</option>
                                    <option v-for="(item, key) in project_levels" :key="key" :value="key">{{ item }}</option>
                                </select>                        
                            </div>
                        </td>
                    </tr>
                    <tr id="tr2" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.duration') }}</b></td>
                        <td @click="editjobduration" class="job-details">
                            <span id="jobduration" class="hidden"><span v-for="(item, key) in project_duration" :key="key"  :value="key" v-if="key==form.project_duration">{{ item}}</span> <i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                            <div id="editjobduration" class="hidden">
                                <select class="form-control form-control-sm" id="editprojectlevel-select" name="editprojectlevel-select"  v-model="form.project_duration" v-on:change="updatejobduration">
                                    <option selected>{{ trans('lang.select') }}</option>
                                    <option v-for="(item, key) in project_duration" :key="key"  :value="key">{{ item }}</option>
                                </select>                        
                            </div>
                        </td>
                    </tr>
                    <tr id="tr3" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.budget') }}</b></td>
                        <td class="job-details">
                            <span id="price" class="hidden" @click="editprice">  $ {{ form.price | numFormat}} <i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                            <div id="editprice" class="hidden">            
                                <input type="number" class="form-control form-control-sm " name="editprice" autocomplete="off"   v-model="form.price">
                                <button @click="updateprice" class="btn btn-sm x-submit-button" style="color: white;    background-color: #005178;" id="card-comment-post-button">
                                {{ trans('lang.post') }}
                            </button>
                            </div>
                        </td>
                    </tr>
                    <tr id="tr4" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.freelancer_typex') }}</b></td>
                        <td class="job-details">
                            <span id="projectfreelancer" v-if="form.freelancer.length > 0"><span v-for="(item, index) in form.freelancer" :key="index">
                                <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="(item1, key1) in project_freelancer" :key="key1" v-if="item == item1[0]">{{ item1[1] }} <i @click="deletefreelancer(index)" class="fa fa-times" aria-hidden="true"></i></span>
                            </span><br>
                            </span>
                            <span @click="editfreelancer" id="addprojectfreelancer"><i class="fa fa-plus"></i></span>
                            <div id="editfreelancer" class="hidden">
                                <select class="form-control form-control-sm" id="editfreelancer-select" name="editfreelancer-select" v-on:change="updatefreelancer"
                                >
                                    <option selected>{{ trans('lang.select') }}</option>
                                    <option v-for="(item, key) in project_freelancer" :key="key" :value="item[0]">{{ item[1] }}</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="tr5" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.english_levelx') }}</b></td>
                        <td class="job-details">
                            <span id="english" v-if="form.english.length > 0"><span v-for="(item, key) in form.english" :key="key">
                                <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="(item1, key1) in project_english" :key="key1" v-if="item == key1">{{ item1 }} <i @click="deleteenglish(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                                </span>
                                </span>
                                <span @click="editenglish" id="addenglish"><i class="fa fa-plus"></i></span>
                            <div id="editenglish" class="hidden">
                                
                                <select class="form-control form-control-sm" id="editenglish-select" name="editenglish-select" v-on:change="updateenglish">
                                    <option selected>{{ trans('lang.select') }}</option>
                                    <option v-for="(item, key) in project_english" :key="key" :value="key">{{ item }}</option>
                                </select>                        
                            </div>
                        </td>
                    </tr>
                    <tr id="tr6" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.project_typex') }}</b></td>
                        <td class="job-details">
                            <span id="paymentlevel" class="hidden" @click="editpayment"> {{ form.payment }} <i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                            <select class="form-control form-control-sm" id="payment" name="payment" v-model="form.payment" v-on:change="payment">
                                <option selected>{{ trans('lang.select') }}</option>
                                <option value="fixed">{{ trans('lang.fixed') }}</option>
                                <option value="perhour">{{ trans('lang.perhour') }}</option>
                            </select> 
                        </td>
                    </tr>
                    <tr id="tr7" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.langs') }}</b></td>
                        <td class="job-details">
                            <span>
                                <span v-if="form.langs.length > 0" v-for="(item, key) in form.langs" :key="key">
                                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="(item1, key1) in languages" :key="key1" v-if="item == key1">{{ item1 }} <i @click="deletelang(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                                </span>
                                <span @click="addlang" id="addlang"><i class="fa fa-plus"></i></span>
                                <select class="form-control form-control-sm hidden" id="addlang-select" name="addlang-select" v-on:change="updateaddlang">
                                    <option selected>{{ trans('lang.select') }}</option>
                                    <option v-for="(item, key) in languages" :key="key" :value="key">{{ item }}</option>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <tr id="tr8" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.skills') }}</b></td>
                        <td class="job-details">
                            <span>
                                <span v-if="form.skills.length > 0" v-for="(item, key) in form.skills" :key="key">
                                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="(item1, key1) in xskills" :key="key1" v-if="item == key1">{{ item1 }} <i @click="deleteskill(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                                </span>
                                <span @click="addskill" id="addskill"><i class="fa fa-plus"></i></span>
                                <select class="form-control form-control-sm hidden" id="addskill-select" name="addskill-select" v-on:change="updateaddskill">
                                    <option selected>{{ trans('lang.select') }} </option>
                                    <option v-for="(item, key) in xskills" :key="key" :value="key">{{ item }}</option>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <tr id="tr9" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.sub_skills') }}</b></td>
                        <td class="job-details">
                            <span>
                                <span v-if="form.subskills.length > 0" v-for="(item, key) in form.subskills" :key="key">
                                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="(item1, key1) in sub_skills" :key="key1" v-if="item == item1[0]">{{ item1[1] }} <i @click="deletesubskill(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                                </span>
                                <span @click="addsubskill" id="addsubskill"><i class="fa fa-plus"></i></span>
                                <select class="form-control form-control-sm hidden" id="addsubskill-select" name="addsubskill-select" v-on:change="updateaddsubskill">
                                    <option selected>{{ trans('lang.select') }}</option>
                                    <option v-for="(item, key) in sub_skills" :key="key" :value="item[0]">{{ item[1] }}</option>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <tr id="tr10" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.categories') }}</b></td>
                        <td class="job-details">
                            <span>
                                <span v-if="form.category.length > 0" v-for="(item, key) in form.category" :key="key">
                                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="(item1, key1) in xcategory" :key="key1" v-if="item == item1.id">{{ item1.title }} <i @click="deletecategory(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                                </span>
                                <span @click="addcategory" id="addcategory"><i class="fa fa-plus"></i></span>
                                <select class="form-control form-control-sm hidden" id="addcategory-select" name="addcategory-select" v-on:change="updateaddcategory">                                    
                                    <option v-for="(item, key) in xcategory" :key="key" :value="item.id">{{ item.title }}</option>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <tr id="tr11" class="hidden">
                        <td class="job-details"><b>Sub {{ trans('lang.cats') }}</b></td>
                        <td class="job-details">
                            <span>
                                <span v-if="form.subcategory.length > 0" v-for="(item, key) in form.subcategory" :key="key">
                                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="(item1, key1) in sub_category" :key="key1" v-if="item == key1">{{ item1[1] }} <i @click="deletesubcategory(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                                </span>
                                <span @click="addsubcategory" id="addsubcategory"><i class="fa fa-plus"></i></span>
                                <select class="form-control form-control-sm hidden" id="addsubcategory-select" name="addsubcategory-select" v-on:change="updateaddsubcategory">
                                    <option selected>{{ trans('lang.select') }}</option>
                                    <option v-for="(item, key) in sub_category" :key="key" :value="key">{{ item[1] }}</option>
                                </select>
                            </span>
                        </td>
                    </tr>
                    
                    
                    <tr id="tr12" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.team') }}</b></td>
                        <td class="job-details">
                            <span v-for="(team, key) in form.teams" :key="key">
                                <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ team[0] }} {{ team[1] }} - {{ team[2] }} <br> {{ team[4] }}</span><i @click="deleteteam(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                            </span>
                            <span @click="addteam" id="addteam"><i class="fa fa-plus"></i></span>
                            <div id="addteam-select" class="hidden">
                                <form @submit.prevent="Createteam()">
                                <div class="form-group" style="">
                                    <input type="text" id="team_name" v-model="form1.name"  name="team_name" class="form-control" placeholder="First Name">
                                    <input type="text" id="team_lname" v-model="form1.lname"  name="team_lname" class="form-control" placeholder="Last Name">
                                    <input type="text" id="team_email" name="team_email" v-model="form1.email" class="form-control" placeholder="Email">
                                    <input type="text" id="team_role" v-model="form1.role"  name="team_role" class="form-control" placeholder="Role">
                                    <select id="permission" class="form-control" v-model="form1.permission">
                                        <option value="" disabled selected>Select your option</option>
                                        <option value="1">{{ trans('lang.can_view') }}</option>
                                        <option value="2">{{ trans('lang.can_edit') }}</option>                                    
                                    </select>
                                </div> 
                                <div class="form-group wt-btnarea" >
                                    <button type="submit" id="addteam" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.add_team') }}</button>
                                </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr id="tr13" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.approver') }}</b></td>
                        <td class="job-details">
                            <span v-for="(approver, key) in form.approvers" :key="key">
                                <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ approver[0] }} {{ approver[1] }} - {{ approver[2] }} <br> {{approver[4]}} </span><i  @click="deleteapprover(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                            </span>
                            <span @click="addapprover"  id="addapprover"><i class="fa fa-plus"></i></span>
                            <div id="addapprover-select" class="hidden">
                                <form @submit.prevent="Createapprover()">
                                <div class="form-group" style="">
                                    <input type="text" id="approver_name" v-model="form2.name"  name="team_name" class="form-control" placeholder="Name">
                                    <input type="text" id="approver_lname" v-model="form2.lname"  name="team_lname" class="form-control" placeholder="Last Name">
                                    <input type="text" id="approver_email" name="approver_email" v-model="form2.email" class="form-control" placeholder="Email">
                                    <input type="text" id="approver_role" v-model="form2.role"  name="team_role" class="form-control" placeholder="Role">
                                    <select id="permission" class="form-control" v-model="form2.permission">
                                        <option value="" disabled selected>{{ trans('lang.select_level') }}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    
                                </div> 
                                <div class="form-group wt-btnarea" >
                                    <button type="submit" id="addapprover" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.add_approver') }}</button>
                                </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr id="tr16" class="hidden">
                        <td class="job-details"><b>{{ trans('lang.invited_freelancer') }}</b></td>
                        <td class="job-details">
                            <span v-for="(invited_freelancer, key) in form.invited_freelancers" :key="key">
                                <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ invited_freelancer }} </span><i  @click="deleteinvited_freelancer(key)" class="fa fa-times" aria-hidden="true"></i></span><br>
                            </span>
                            <div id="editemail" class="">            
                                <input type="email" class="form-control form-control-sm " id="invited_freelancers" name="invited_freelancers" autocomplete="off" >
                                <button @click="updateinvited_freelancers" class="btn btn-sm x-submit-button" style="color: white;    background-color: #005178;" id="card-comment-post-button">
                                {{ trans('lang.add') }}
                            </button>
                            </div>
                            <div id="editemail_text" class="">            
                                <textarea id="email_text" name="email_text" style="width: 100%;height: 200px;">Hello Sir/Mam,
I want to invite you to make a proposal for my project.

For the further information, please click the invitation below.

{Link}

Thanks in advance,
{name}</textarea>
                                <button @click="updateemail_text" class="btn btn-sm x-submit-button" style="color: white;    background-color: #005178;" id="card-comment-post-button">
                                {{ trans('lang.add') }}
                            </button>
                            </div>

                        </td>
                    </tr>
                    <tr id="tr14" class="hidden">
                        <!--<td class="job-details"><b>{{ trans('lang.delivery') }} <span v-if="job1.delivery_type == 'date'">{{ trans('lang.date') }}</span> <span v-if="job1.delivery_type == 'time'">{{ trans('lang.time') }}</span></b></td>
                        <td class="job-details">
                            <span @click="editexpirydate" v-if="job1.delivery_type == 'date'">
                                <span id="expirydate">{{ job1.expiry_date | formatDate}} <i class="fa fa-pencil" v-show="isapprover == '1' || permission == 2" style="float:right;margin: 10px;"></i></span>
                                <div id="editexpirydate" class="hidden">            
                                    <input type="date" class="form-control form-control-sm pickadate" name="editexpirydate" autocomplete="off" placeholder="Expiry Date" v-on:change="updateexpirydate">
                                </div>
                                </span>
                            <span v-if="job1.delivery_type == 'time'"><span id="jobmonth" @click="editjobmonth"> {{ trans('lang.month') }} : {{ job1.month }} <i class="fa fa-pencil" v-show="isapprover == '1' || permission == 2" style="float:right;margin: 10px;"></i></span>
                            <div id="editjobmonth" class="hidden" v-show="isapprover == '1' || permission == 2">            
                                    <input type="number" class="form-control form-control-sm " name="editjobmonth" autocomplete="off" :value="job1.month" v-on:change="updatejobmonth">
                                </div>
                            
                            <br><span id="jobweek" @click="editjobweek"> {{ trans('lang.week') }} : {{ job1.week }} <i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                            <div id="editjobweek" class="hidden">            
                                    <input type="number" class="form-control form-control-sm " name="editjobweek" autocomplete="off" :value="job1.week" v-on:change="updatejobweek">
                                </div>
                            
                            <br><span id="jobday" @click="editjobday"> {{ trans('lang.day') }} : {{ job1.day }} <i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                            <div id="editjobday" class="hidden">            
                                    <input type="number" class="form-control form-control-sm " name="editjobday" autocomplete="off" :value="job1.day" v-on:change="updatejobday">
                                </div>
                            
                            <br><span id="jobhour" @click="editjobhour"> {{ trans('lang.hour') }} : {{ job1.hour }}<i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                            <div id="editjobhour" class="hidden">            
                                    <input type="number" class="form-control form-control-sm " name="editjobhour" autocomplete="off" :value="job1.hour" v-on:change="updatejobhour">
                                </div>
                            </span>


                            
                            </td>-->
                            <td class="job-details"><b>{{ trans('lang.delivery') }} <span v-show="form.delivery_type == 'date'">{{ trans('lang.date') }}</span> <span v-show="form.delivery_type == 'time'">{{ trans('lang.time') }}</span></b></td>
                            <td class="job-details">
                            <div class="wt-on-off" style="padding: 20px;border: 1px solid #cdc6c6;border-radius: 5px;width: 240px;">
                                                    <div class="switch-button-control" style="display: flex;">
                                                    <div class="" style="padding-right: 20px;color:#005178;">Date</div>
                                                    <div id="delivery" class="switch-button" @click="deliverychange" style="--color:#4D4D4D;">
                                                            <div class="button"></div>
                                                        </div> 
                                                        <div class="" style="padding-left: 20px;">Time</div>
                                                    </div> 
                                                    
                                                    
                                                
                                            </div>
                                            <div id="delivery_date">
                                            <!--<job-expiry 
                                                :ph_expiry_date="trans('lang.project_expiry')"
                                                :weekdays="'{{json_encode($weekdays)}}'"
                                                :months="'{{json_encode($months)}}'">
                                            </job-expiry>-->
                                            <div id="editexpirydate" class="">            
                                                <input type="date" class="form-control form-control-sm pickadate" name="editexpirydate" autocomplete="off" placeholder="Expiry Date" v-model="form.expiry_date">
                                            </div>
                                            </div>
                                            <div id="delivery_time" style="display: none;margin-top: 7px;">
                                                <input type="number" v-model="form.months" name="time_month" class="form-control" placeholder="months" min="0" max="12">
                                                <input type="number" v-model="form.weeks" name="time_week" class="form-control" placeholder="weeks" min="0" max="4">
                                                <input type="number" v-model="form.days" name="time_day" class="form-control" placeholder="days" min="0" max="7">
                                                <input type="number" v-model="form.hours" name="time_hour" class="form-control" placeholder="hours" min="0" max="24"> 
                                            </div>
                            </td>
                    </tr>
                    <tr id="tr15" class="hidden">

                        <td colspan="2"><button @click="submitJob" id="post-job-show" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.post_job') }}</button></td>
                    </tr>


                </table>
            </div>
            
        </div>
    </div>
    
    </div>
        
</template>

<script>
  
export default {  
     
 data () {
    return {
        form : new Form({
            id: '',
            title : '',
            description : '',
            project_level : '',
            project_duration : '',
            price : '',
            payment : '',
            freelancer : [],
            english : [],
            langs : [],
            skills : [],
            subskills : [],
            category : [],
            subcategory : [],
            teams : [],
            approvers : [],
            delivery_type : 'date',
            months : '',
            weeks : '',
            days : '',
            hours : '',
            expiry_date : '',
            invited_freelancers : [],
            email_text : '',
            //subskills_show : [],
            
        }),
        form1 : new Form({
            name : '',
            lname : '',
            role : '',
            permission : '',
            email : '',
        }),
        form2 : new Form({
            name : '',
            lname : '',
            role : '',
            permission : '',
            email : '',
        }),
        project_levels : {},
        project_duration : {},
        project_freelancer : {},
        project_english : {},
        languages : {},
        xskills : {},
        sub_skills : {},
        sub_category : {},
        xcategory : {},
        
        
    }
  },
  props: {
      userid: String,
      isapprover : String
  },
  methods: {

        posttitle() {
            $('#title').removeClass('hidden');
            $('#posttitle').addClass('hidden');
            $('#editdescription').removeClass('hidden');
        },
        deliverychange() {
            let self = this;
            if(document.getElementById('delivery').classList.contains('enabled'))
            {
                $('#delivery').removeClass('enabled');
                //document.getElementById('delivery_type').value = 'date';
                document.getElementById('delivery_date').style.display = 'block';
                document.getElementById('delivery_time').style.display = 'none';
                self.delivery_type = 'date';
            }                
            else
            {
                $('#delivery').addClass('enabled');
                //document.getElementById('delivery_type').value = 'time';
                document.getElementById('delivery_date').style.display = 'none';
                document.getElementById('delivery_time').style.display = 'block';
                self.delivery_type = 'time';
            }
            
            Fire.$emit('postupdate');

        },
        Updatedescription() 
        {
            $('#editdescription').addClass('hidden');
            $('#description').removeClass('hidden');
            $('#editprojectlevel').removeClass('hidden');
            $('#tr1').removeClass('hidden');
        },
        updateprojectlevel() {
            $('#editprojectlevel').addClass('hidden');
            $('#projectlevel').removeClass('hidden');
            $('#editjobduration').removeClass('hidden');
            $('#tr2').removeClass('hidden');
        },
        updatejobduration() {
            $('#editjobduration').addClass('hidden');
            $('#jobduration').removeClass('hidden');
            $('#editprice').removeClass('hidden');
            $('#tr3').removeClass('hidden');
        },
        updateprice() {
            $('#editprice').addClass('hidden');
            $('#price').removeClass('hidden');
            $('#tr4').removeClass('hidden');
            //$('#editprice').removeClass('hidden');
        },
        editfreelancer() {
            //$('#editprice').addClass('hidden');
            $('#editfreelancer').removeClass('hidden');

        },
        editenglish() {
            $('#editenglish').removeClass('hidden');
            $('#tr6').removeClass('hidden');
        },
        payment() {
            $('#payment').addClass('hidden');
            $('#paymentlevel').removeClass('hidden');
            $('#tr7').removeClass('hidden');
            //$('#editjobduration').removeClass('hidden');
        },
        editpayment() {
            $('#payment').addClass('hidden');
            $('#paymentlevel').removeClass('hidden');
        },
        addlang() {
            $('#addlang-select').removeClass('hidden');
        },
        addskill() {
            $('#addskill-select').removeClass('hidden');
            
        },
        addsubskill() {
            $('#addsubskill-select').removeClass('hidden');
        },
        addcategory() {
            $('#addcategory-select').removeClass('hidden');
            
        },
        addsubcategory() {
            $('#addsubcategory-select').removeClass('hidden');
        },
        addteam() {
            $('#addteam-select').removeClass('hidden');
        },
        addapprover() {
            $('#addapprover-select').removeClass('hidden');
        },
        Createteam() {
            let self = this;
            var dat = [self.form1.name, self.form1.lname, self.form1.role, self.form1.permission, self.form1.email];
            
            self.form.teams.push(dat);
            self.form1.reset();
            $('#addteam-select').addClass('hidden');
            
            Fire.$emit('postupdate');

        },
        Createapprover() {
            let self = this;
            var dat = [self.form2.name, self.form2.lname, self.form2.role, self.form2.permission, self.form2.email];
            
            self.form.approvers.push(dat);
            self.form2.reset();
            $('#addapprover-select').addClass('hidden');
            $('#post-job-show').removeClass('hidden');
            Fire.$emit('postupdate');
            
        },
        submitJob: function () {
            this.loading = true;
            var self = this;
            /*let register_Form = document.getElementById('post_job_form');
            let form_data = new FormData(register_Form);
            var description = tinyMCE.get('wt-tinymceeditor').getContent();
            form_data.append('description', description);*/
            let form_data = self.form;
            
            axios.post(APP_URL + '/job/post-job', form_data)
                .then(function (response) {
                    if (response.data.type == 'success') {
                        self.loading = false;
                        self.showInfo(Vue.prototype.trans('lang.job_submitting'));
                        setTimeout(function () {
                            window.location.replace(APP_URL + '/employer/dashboard/manage-jobs');
                        }, 4000);
                    } else {
                        self.loading = false;
                        self.showError(response.data.message);
                    }
                })
                .catch(function (error) {
                    self.loading = false;
                    if (error.response.data.errors.job_duration) {
                        self.showError(error.response.data.errors.job_duration[0]);
                    }
                    if (error.response.data.errors.english_level) {
                        self.showError(error.response.data.errors.english_level[0]);
                    }
                    if (error.response.data.errors.title) {
                        self.showError(error.response.data.errors.title[0]);
                    }
                    if (error.response.data.errors.project_levels) {
                        self.showError(error.response.data.errors.project_levels[0]);
                    }
                    if (error.response.data.errors.freelancer_type) {
                        self.showError(error.response.data.errors.freelancer_type[0]);
                    }
                    if (error.response.data.errors.project_cost) {
                        self.showError(error.response.data.errors.project_cost[0]);
                    }
                    if (error.response.data.errors.description) {
                        self.showError(error.response.data.errors.description[0]);
                    }
                    if (error.response.data.errors.latitude) {
                        self.showError(error.response.data.errors.latitude[0]);
                    }
                    if (error.response.data.errors.longitude) {
                        self.showError(error.response.data.errors.longitude[0]);
                    }
                    if (error.response.data.errors.expiry_date) {
                        self.showError(error.response.data.errors.expiry_date[0]);
                    }
                });
        },
        updatefreelancer(e) {

            let self = this;
            var check = 0;
            
            
            if(self.form.freelancer.length == 0)
            {
                if(self.form.freelancer == 'Select')
                {}
                else
                    self.form.freelancer[0] = e.target.value;
            }
            else
            {
                if(self.form.freelancer == 'Select')
                {}
                else
                {
                    for(let i = 0; i < self.form.freelancer.length; i++ )
                    {
                        //console.log(freelancer[key], e.target.value);
                        if(self.form.freelancer[i] == e.target.value)
                        check = 1;
                    }
                    
                    if(check == 0)
                        self.form.freelancer[self.form.freelancer.length] = e.target.value;
                }
            }
            Fire.$emit('postupdate');
            $('#tr5').removeClass('hidden');
            $('#editfreelancer').addClass('hidden');
            
        },
        updateenglish(e) {
            let self = this;
            var check = 0;
            
            
            if(self.form.english.length == 0)
            {
                if(self.form.english == 'Select')
                {}
                else
                    self.form.english[0] = e.target.value;
            }
            else
            {
                if(self.form.english == 'Select')
                {}
                else
                {
                    for(let i = 0; i < self.form.english.length; i++ )
                    {
                        //console.log(freelancer[key], e.target.value);
                        if(self.form.english[i] == e.target.value)
                        check = 1;
                    }
                    
                    if(check == 0)
                        self.form.english[self.form.english.length] = e.target.value;
                }
            }
            Fire.$emit('postupdate');
            $('#editenglish').addClass('hidden');
            $('#tr5').removeClass('hidden');
        },
        updateaddlang(e) {
            let self = this;
            var check = 0;
            
            
            if(self.form.langs.length == 0)
            {
                if(self.form.langs == 'Select')
                {}
                else
                    self.form.langs[0] = e.target.value;
            }
            else
            {
                if(self.form.langs == 'Select')
                {}
                else
                {
                    for(let i = 0; i < self.form.langs.length; i++ )
                    {
                        //console.log(freelancer[key], e.target.value);
                        if(self.form.langs[i] == e.target.value)
                        check = 1;
                    }
                    
                    if(check == 0)
                        self.form.langs[self.form.langs.length] = e.target.value;
                }
            }
            Fire.$emit('postupdate');
            $('#tr8').removeClass('hidden');
            $('#addlang-select').addClass('hidden');
        },
        updateaddskill(e) {
            let self = this;
            var check = 0;
            
            //console.log('1-' + self.form.skills.length);
            if(self.form.skills.length == 0)
            {
                //console.log('2-' + self.form.skills.length);
                if(self.form.skills == 'Select')
                {}
                else
                    self.form.skills[0] = e.target.value;
            }
            else
            {
                //console.log('3-' + self.form.skills.length);
                if(self.form.skills == 'Select')
                {}
                else
                {
                    for(let i = 0; i < self.form.skills.length; i++ )
                    {
                        //console.log(self.form.skills[key], e.target.value);
                        if(self.form.skills[i] == e.target.value)
                        check = 1;
                    }
                    
                    if(check == 0)
                        self.form.skills[self.form.skills.length] = e.target.value;
                }
            }
            Fire.$emit('postupdate');

            
            $('#addsubskill-select').empty();
            
            var skills = this.form.skills;
            self.sub_skills = [];
            //self.form.subskills_show = [];
            //$('#addsubskill-select').append('<option selected>Select</option>');;
            //var i = 0;
            //self.sub_skills.push('select');
            //console.log(self.sub_skills);
            //i++;
            $.each(skills, function(key, value) {
                axios.get(APP_URL + '/api/sub_skills/' + value).then(function (response) {
                    //console.log(response.data);
                    $.each(response.data, function(index, subCat){
                            var dat = [subCat.id, subCat.sub_skill];
                            self.sub_skills.push(dat);
                            //self.form.subskills_show.push(subCat.sub_skill);
                            //self.sub_skills.push({id : subCat.id, value : subCat.sub_skill});
                            //console.log(subCat.id, subCat.sub_skill);
                            //self.sub_skills = subCat.sub_skill;
                            //i++;
                            //$('#addsubskill-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                            //$('#sub-skill-select').trigger("chosen:updated");
                            /*if(self.sub_skills.length == 0)
                            {
                                self.sub_skills[0] = e.target.value;
                            }
                            else
                            {
                                if(self.form.english == 'Select')
                                {}
                                else
                                {
                                    for(let i = 0; i < self.form.english.length; i++ )
                                    {
                                        //console.log(freelancer[key], e.target.value);
                                        if(self.form.english[i] == e.target.value)
                                        check = 1;
                                    }
                                    
                                    if(check == 0)
                                        self.form.english[self.form.english.length] = e.target.value;
                                }
                            }*/
                        });
                });
            });
            $('#addskill-select').addClass('hidden');
            $('#tr9').removeClass('hidden');
            Fire.$emit('postupdate');
            
        },
        updateaddsubskill(e) {
            let self = this;
            var check = 0;
            
            
            if(self.form.subskills.length == 0)
            {
                if(self.form.subskills == 'Select')
                {}
                else
                    self.form.subskills[0] = e.target.value;
            }
            else
            {
                if(self.form.subskills == 'Select')
                {}
                else
                {
                    for(let i = 0; i < self.form.subskills.length; i++ )
                    {
                        //console.log(freelancer[key], e.target.value);
                        if(self.form.subskills[i] == e.target.value)
                        check = 1;
                    }
                    
                    if(check == 0)
                        self.form.subskills[self.form.subskills.length] = e.target.value;
                }
            }
            Fire.$emit('postupdate');
            $('#tr10').removeClass('hidden');
            $('#addsubskill-select').addClass('hidden');
        },
        updateaddcategory(e) {
            let self = this;
            var check = 0;
            
            //console.log('1-' + self.form.skills.length);
            if(self.form.category.length == 0)
            {
                //console.log('2-' + self.form.skills.length);
                if(self.form.category == 'Select')
                {}
                else
                    self.form.category[0] = e.target.value;
            }
            else
            {
                //console.log('3-' + self.form.skills.length);
                if(self.form.category == 'Select')
                {}
                else
                {
                    for(let i = 0; i < self.form.category.length; i++ )
                    {
                        //console.log(self.form.skills[key], e.target.value);
                        if(self.form.category[i] == e.target.value)
                        check = 1;
                    }
                    
                    if(check == 0)
                        self.form.category[self.form.category.length] = e.target.value;
                }
            }
            Fire.$emit('postupdate');

            
            $('#addsubcategory-select').empty();
            
            var category = this.form.category;
            self.sub_category = [];
            //self.form.subskills_show = [];
            //$('#addsubskill-select').append('<option selected>Select</option>');;
            //var i = 0;
            //self.sub_category.push('select');
            //console.log(self.sub_skills);
            //i++;
            $.each(category, function(key, value) {
                axios.get(APP_URL + '/api/sub_category/' + value).then(function (response) {
                    //console.log(response.data);
                    $.each(response.data, function(index, subCat){
                            var dat = [subCat.id, subCat.sub_category];
                            self.sub_category.push(dat);
                            //self.form.subskills_show.push(subCat.sub_skill);
                            //self.sub_skills.push({id : subCat.id, value : subCat.sub_skill});
                            //console.log(subCat.id, subCat.sub_skill);
                            //self.sub_skills = subCat.sub_skill;
                            //i++;
                            //$('#addsubskill-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                            //$('#sub-skill-select').trigger("chosen:updated");
                            /*if(self.sub_skills.length == 0)
                            {
                                self.sub_skills[0] = e.target.value;
                            }
                            else
                            {
                                if(self.form.english == 'Select')
                                {}
                                else
                                {
                                    for(let i = 0; i < self.form.english.length; i++ )
                                    {
                                        //console.log(freelancer[key], e.target.value);
                                        if(self.form.english[i] == e.target.value)
                                        check = 1;
                                    }
                                    
                                    if(check == 0)
                                        self.form.english[self.form.english.length] = e.target.value;
                                }
                            }*/
                        });
                });
            });
            $('#addcategory-select').addClass('hidden');
            $('#tr11').removeClass('hidden');
            Fire.$emit('postupdate');
            
        },
        updateaddsubcategory(e) {
            let self = this;
            var check = 0;
            
            
            if(self.form.subcategory.length == 0)
            {
                if(self.form.subcategory == 'Select')
                {}
                else
                    self.form.subcategory[0] = e.target.value;
            }
            else
            {
                if(self.form.subcategory == 'Select')
                {}
                else
                {
                    for(let i = 0; i < self.form.subcategory.length; i++ )
                    {
                        //console.log(freelancer[key], e.target.value);
                        if(self.form.subcategory[i] == e.target.value)
                        check = 1;
                    }
                    
                    if(check == 0)
                        self.form.subcategory[self.form.subcategory.length] = e.target.value;
                }
            }
            Fire.$emit('postupdate');
            $('#tr12').removeClass('hidden');
            $('#tr13').removeClass('hidden');
            $('#tr14').removeClass('hidden');
            $('#tr15').removeClass('hidden');
            $('#tr16').removeClass('hidden');
            $('#addsubcategory-select').addClass('hidden');
        },
        updateinvited_freelancers() {
            let self = this;
            var email = $("#invited_freelancers").val();
            self.form.invited_freelancers.push(email);
            $("#invited_freelancers").val("");
            Fire.$emit('postupdate');
        },
        updateemail_text() {
            let self = this;
            var email_text = $("#email_text").val();
            self.form.email_text = email_text;
            Fire.$emit('postupdate');
        },
        close() {

        },      
        editdescription() {
            $('#description').addClass('hidden');
            $('#editdescription').removeClass('hidden');
        },  
        editprojectlevel() {
            $('#projectlevel').addClass('hidden');
            $('#editprojectlevel').removeClass('hidden');
        },
        editjobduration() {
            $('#jobduration').addClass('hidden');
            $('#editjobduration').removeClass('hidden');
        },
        editprice() {
            $('#price').addClass('hidden');
            $('#editprice').removeClass('hidden');
        }, 
        deleteinvited_freelancer(id) {

        }, 
        deleteenglish(id) {
            let self = this;
            self.form.english.splice(id, 1);
            Fire.$emit('postupdate');
        },      
        deletefreelancer(id) {
            let self = this;
            //console.log(id);
            self.form.freelancer.splice(id, 1);
            Fire.$emit('postupdate');
            //array.splice(index, 1);

        },
        deletelang(id) {
            let self = this;
            self.form.langs.splice(id, 1);
            Fire.$emit('postupdate');
        },
        deleteskill(id) {
            let self = this;
            self.form.skills.splice(id, 1);
            Fire.$emit('postupdate');
        },
        deletesubskill(id) {
            let self = this;
            self.form.subskills.splice(id, 1);
            Fire.$emit('postupdate');
        },
        deleteteam(id) {
            let self = this;
            self.form.teams.splice(id, 1);
            Fire.$emit('postupdate');
        },
        deleteapprover(id) {
            let self = this;
            self.form.approvers.splice(id, 1);
            Fire.$emit('postupdate');
        },
        loadprojectlevel() {
            let self = this;
            axios.get(APP_URL + '/api/job_project_level/').then(function (response) {
                self.project_levels = response.data;
            });  
        },
        loadprojectduration() {
            let self = this;
            axios.get(APP_URL + '/api/job_project_duration/').then(function (response) {
                self.project_duration = response.data;
            });  
        },
        loadprojectfreelancer() {
            let self = this;
            axios.get(APP_URL + '/api/job_project_freelancer/').then(function (response) {
                self.project_freelancer = Object.entries(response.data);
            });  
                 
        },
        loadprojectenglish() {
            let self = this;            
            axios.get(APP_URL + '/api/job_project_english/').then(function (response) {
                self.project_english = response.data;
                
            });                   
        },
        loadlanguage() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/language/'+ this.jobid).then(function (response) {
                self.languages = response.data;
                //console.log(self.languages);
            });  
        },
        loadskill() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/skill/x').then(function (response) {
                self.xskills = response.data;
                //console.log(self.xskills);
            });  
        },
        loadcategory() {
            let self = this;
            axios.get(APP_URL + '/get-categories').then(function (response) {
                self.xcategory = response.data.categories;
                //console.log(self.xskills);
            });  
        },
        addsubskill() {
            /*$('#addsubskill-select').empty();
            
            var skills = this.xskills;
            console.log(skills);
            $.each(skills, function(key, value) {
                axios.get(APP_URL + '/api/sub_skills/' + value.id).then(function (response) {
                    //console.log(response.data);
                    $.each(response.data, function(index, subCat){
                            //console.log(subCat.sub_category, subCat);
                            $('#addsubskill-select').append('<option value="'+ subCat.id +'">'+ subCat.sub_skill +'</option>');
                            //$('#sub-skill-select').trigger("chosen:updated");
                        });
                });
            });
            */
            //$('#addsubskill').addClass('hidden');
            $('#addsubskill-select').removeClass('hidden');
        },
        
            

  },
    mounted: function() {
        this.loadprojectlevel();
        this.loadprojectduration();
        this.loadprojectfreelancer();
        this.loadprojectenglish();
        this.loadlanguage();
        this.loadskill();
        this.loadcategory();
        Fire.$on('postupdate', () => {
            this.loadprojectlevel();
        });
  }
};
</script>
<style>
td {
    border-top: 1px solid #dbdbdb;
    border: 1px solid #dbdbdb;
    line-height: 2.5;
    padding-left: 3px;
    text-align: center;
    vertical-align: top;
}
.job-details {
	text-align:left;
	padding-left:20px;
    width: 50%;
}
.mce-menubar {
    display: none;
}
.mce-statusbar {
    display: none!important;
}
</style>