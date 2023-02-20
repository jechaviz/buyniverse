<template>
    <div class="wt-dashboardbox">
                                <div class="wt-dashboardboxtitle">
                                    <div class="col-md-6">
                                        <h2>{{ trans('lang.job_detail') }}</h2>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="row float-right">
                                                <b>{{ trans('lang.code') }}</b> : {{ job1.code}}
                                            </div>
                                            <br>
                                            <div class="row float-right">
                                                <b>{{ trans('lang.created_at') }}</b> : {{ job1.created_at | formatDate}}
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="row" style="width: 100%;">
                                    <div class="col-md-7">
                                        <i @click="editdescription" v-show="isapprover == '1' || permission == 2" class="fa fa-pencil" style="float:right;margin: 10px;"></i>
                                        <div style="margin: 30px;" id="description" v-html="job1.description">
                                            
                                        </div>
                                        <div style="margin: 30px;" class="hidden" v-show="isapprover == '1' || permission == 2" id="editdescription">
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
          <tr>
              <td class="job-details"><b>{{ trans('lang.project_levelx') }}</b></td>
              <td @click="editprojectlevel" class="job-details" >
                  <span id="projectlevel"> {{ job1.project_level }} <i v-show="isapprover == '1' || permission == 2" class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                  <div id="editprojectlevel" v-show="isapprover == '1' || permission == 2" class="hidden">
                        
                        <select class="form-control form-control-sm" id="editprojectlevel-select" name="editprojectlevel-select" v-on:change="updateprojectlevel">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in project_levels" :key="key" :value="key">{{ item }}</option>
                        </select>                        
                    </div>
                </td>

          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.status') }}</b></td>
              <td class="job-details">
                  {{ job1.status}}
                  <br>
                  <span v-if="approvers.length > 0">
                      <span v-for="approver in approvers" :key="approver.id">
                            <span >{{ trans('lang.name') }} : {{ approver.name }} {{ approver.lname }}</span><br>
                            <span >{{ trans('lang.position') }} : {{ approver.role }}  </span><br>
                            <span >{{ trans('lang.level') }} : {{ approver.permission }}  </span><br>
                            <!--<span v-if="approver.update == 1">Status : <span @click="approvejob(approver.id)" style="cursor: pointer;color: #005178;">Click here to approve</span></span>-->
                            <span >Status : 
                                <span v-if="approver.status == 0"> {{ trans('lang.waiting') }} </span>
                                <span v-if="approver.status == 2"> {{ trans('lang.rejected') }} </span>
                                <span v-else>
                                    <span v-if="job1.status == 'cancelled'">{{ trans('lang.job_cancelled') }}</span>
                                    <span v-else> {{ trans('lang.approved') }}</span>
                                </span>  
                            </span><br>
                        </span>
                    </span>
                </td>
          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.duration') }}</b></td>
              <td @click="editjobduration" class="job-details">
                  <span id="jobduration"><span v-for="(item, key) in project_duration" :key="key"  :value="key" v-if="key==job1.duration">{{ item}}</span> <i class="fa fa-pencil" v-show="isapprover == '1' || permission == 2" style="float:right;margin: 10px;"></i></span>
                  <div id="editjobduration" class="hidden" v-show="isapprover == '1' || permission == 2">
                        
                        <select class="form-control form-control-sm" id="editprojectlevel-select" name="editprojectlevel-select" v-on:change="updatejobduration">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in project_duration" :key="key"  :value="key">{{ item }}</option>
                        </select>                        
                    </div>
                </td>
          </tr>
          <tr>
                <td class="job-details"><b>{{ trans('lang.tcurrency') }}</b></td>
                <td class="job-details">
                    <span>
                        <span v-if="job1.currency">
                            <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ job1.curr.symbol }} - {{ job1.curr.name }} </span>
                        </span>
                        <span v-if="job1.currency" @click="addcurrency" id="addcurrency"><i class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                         <span v-if="!job1.currency" @click="addcurrency" id="addcurrency"><i class="fa fa-plus"></i></span>
                        <select class="form-control form-control-sm hidden" id="addcurrency-select" name="addcurrency-select" v-on:change="updateaddcurrency">
                            <option selected>{{ trans('lang.select') }}</option>                                 
                            <option v-for="(item, key) in xcurrency" :key="key" :value="item">{{ item }}</option>
                        </select>
                    </span>
                </td>
            </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.budget') }}</b></td>
              <td @click="editprice" class="job-details">
                    <span id="price"><span v-if="job1.currency">{{ job1.curr.symbol }}</span><span v-else>$</span> {{ job1.price | numFormat}} <i class="fa fa-pencil" v-show="isapprover == '1' || permission == 2" style="float:right;margin: 10px;"></i></span>
                    <div id="editprice" class="hidden" v-show="isapprover == '1' || permission == 2">            
                        <input type="number" class="form-control form-control-sm " name="editprice" autocomplete="off" :value="job1.price" v-on:change="updateprice">
                    </div>
                </td>
          </tr>
          <tr>
                <td class="job-details"><b>{{ trans('lang.categories') }}</b></td>
                <td class="job-details">
                    <span>
                        <span v-if="job1.categories">
                            <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="item in job1.categories" :key="item.id">{{ item.title }} <i @click="deletecategory(item.id)" class="fa fa-times" aria-hidden="true"></i></span><br>
                        </span>
                        <span @click="addcategory" id="addcategory"><i class="fa fa-plus"></i></span>
                        <select class="form-control form-control-sm hidden" id="addcategory-select" name="addcategory-select" v-on:change="updateaddcategory">   
                            <option selected>{{ trans('lang.select') }}</option>                                 
                            <option v-for="(item, key) in xcategory" :key="key" :value="item.id">{{ item.title }}</option>
                        </select>
                    </span>
                </td>
            </tr>
          <!--<tr>
              <td class="job-details"><b>{{ trans('lang.freelancer_typex') }}</b></td>
              <td class="job-details">
                  <span id="projectfreelancer"><span v-for="(item, key) in freelancer" :key="key" :value="key">
                      <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ item.name }} <i @click="deletefreelancer(item.id)" v-show="isapprover == '1' || permission == 2" class="fa fa-times" aria-hidden="true"></i></span>
                  </span><br>
                  </span>
                  <span @click="editfreelancer" v-show="isapprover == '1' || permission == 2" id="addprojectfreelancer"><i class="fa fa-plus"></i></span>
                  <div id="editfreelancer" v-show="isapprover == '1' || permission == 2" class="hidden">
                        
                        <select class="form-control form-control-sm" id="editfreelancer-select" name="editfreelancer-select" v-on:change="updatefreelancer">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in project_freelancer" :key="key" :value="key">{{ item }}</option>
                        </select>                        
                    </div>
                </td>
          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.english_levelx') }}</b></td>
              <td class="job-details">
                  <span id="english"><span v-for="(item, key) in english" :key="key" :value="item.english_level">
                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ item.name }} <i @click="deleteenglish(item.id)" v-show="isapprover == '1' || permission == 2" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    </span>
                    <span @click="editenglish" v-show="isapprover == '1' || permission == 2" id="addenglish"><i class="fa fa-plus"></i></span>
                  <div id="editenglish" v-show="isapprover == '1' || permission == 2" class="hidden">
                        
                        <select class="form-control form-control-sm" id="editenglish-select" name="editenglish-select" v-on:change="updateenglish">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in project_english" :key="key" :value="key">{{ item }}</option>
                        </select>                        
                    </div>
                  </td>
          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.project_typex') }}</b></td>
              <td class="job-details">
                  <span>{{ job1.project_type}}</span>
                </td>
          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.langs') }}</b></td>
              <td class="job-details">
                  <span>
                    <span v-for="lang in langs" :key="lang.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ lang.title }} <i @click="deletelang(lang.id)" v-show="isapprover == '1' || permission == 2" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span @click="addlang" v-show="isapprover == '1' || permission == 2" id="addlang"><i class="fa fa-plus"></i></span>
                    <select class="form-control form-control-sm hidden" v-show="isapprover == '1'" id="addlang-select" name="addlang-select" v-on:change="updateaddlang">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in languages" :key="key" :value="key">{{ item }}</option>
                        </select>
                  </span>
                </td>
          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.skills') }}</b></td>
              <td class="job-details">
                  <span>
                    <span v-for="skill in xskills" :key="skill.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ skill.title }} <i @click="deleteskill(skill.id)" v-show="isapprover == '1' || permission == 2" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span @click="addskill" v-show="isapprover == '1' || permission == 2" id="addskill"><i class="fa fa-plus"></i></span>
                    <select class="form-control form-control-sm hidden" v-show="isapprover == '1' || permission == 2" id="addskill-select" name="addskill-select" v-on:change="updateaddskill">
                            <option selected>{{ trans('lang.select') }} </option>
                            <option v-for="(item, key) in skills" :key="key" :value="key">{{ item }}</option>
                        </select>
                  </span>
                </td>
          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.sub_skills') }}</b></td>
              <td class="job-details">
                  <span>
                    <span v-for="skill in subskills" :key="skill.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ skill.name }} <i @click="deletesubskill(skill.id)" v-show="isapprover == '1' || permission == 2" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span @click="addsubskill" v-show="isapprover == '1' || permission == 2" id="addsubskill"><i class="fa fa-plus"></i></span>
                    <select class="form-control form-control-sm hidden" v-show="isapprover == '1' || permission == 2" id="addsubskill-select" name="addsubskill-select" v-on:change="updateaddsubskill">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in sub_skills" :key="key" :value="key">{{ item }}</option>
                        </select>
                  </span>
                </td>
          </tr>
          
          <tr>
              <td class="job-details"><b>{{ trans('lang.featured') }}</b></td>
              <td class="job-details"><span v-if="job1.is_featured == 'false'">{{ trans('lang.no') }}</span> <span v-if="job1.is_featured == 'true'">{{ trans('lang.yes') }}</span></td>
          </tr>-->
          <!--<tr>
              <td class="job-details"><b>{{ trans('lang.code') }}</b></td>
              <td class="job-details">{{ job1.code}}</td>
          </tr>
          <tr>
              
              <td class="job-details"><b>{{ trans('lang.created_at') }}</b></td>
              <td class="job-details">{{ job1.created_at | formatDate}} </td>
          </tr>-->
          <tr>
              
              <td class="job-details"><b>{{ trans('lang.team') }}</b></td>
              <td class="job-details">
                  <span v-for="team in teams" :key="team.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ team.name }} {{ team.lname }} - {{ team.role }} <br> {{ team.email }}</span><i @click="deleteteam(team.id)" v-show="isapprover == '1' || permission == 2" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span @click="addteam" v-show="isapprover == '1' || permission == 2" id="addteam"><i class="fa fa-plus"></i></span>
                    <div id="addteam-select" v-show="isapprover == '1' || permission == 2" class="hidden">
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
                            <input type="hidden" name="user_id" v-model="form1.job_id">
                        </div> 
                        <div class="form-group wt-btnarea" >
                            <button v-show="wteam" type="submit" id="addteam" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.add_team') }}</button>
                            <button v-show="!wteam" type="submit" id="addteam" class="wt-btn" style="margin: 5px;float: right;" disabled>{{ trans('lang.please_wait') }}</button>

                            
                        </div>
                        </form>
                    </div>
              </td>
          </tr>
          <tr>
              
              <td class="job-details"><b>{{ trans('lang.approver') }}</b></td>
              <td class="job-details">
                  <span v-for="approver in approvers" :key="approver.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ approver.name }} {{ approver.lname }} - {{ approver.role }} <br> {{approver.email}} <br> Level - {{ approver.permission }} </span><i v-show="isapprover == '1' || permission == 2" @click="deleteapprover(approver.id)" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span v-show="isapprover == '1' || permission == 2" @click="addapprover" id="addapprover"><i class="fa fa-plus"></i></span>
                    <div id="addapprover-select" class="hidden" v-show="isapprover == '1' || permission == 2">
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

                            <input type="hidden" name="job_id" v-model="form2.job_id">
                        </div> 
                        <div class="form-group wt-btnarea" >
                            <button v-show="wapprover" type="submit" id="addapprover" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.add_approver') }}</button>
                            <button v-show="!wapprover" type="submit" id="addapprover" class="wt-btn" style="margin: 5px;float: right;" disabled>{{ trans('lang.please_wait') }}</button>

                        </div>
                        </form>
                    </div>
              </td>
          </tr>
          <!--<tr>
              <td class="job-details"><b>{{ trans('lang.invited_freelancer') }}</b></td>
              <td class="job-details">
                  <span v-for="invite in invited" :key="invite.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ invite.name }}<br> {{invite.email}} </span><i v-show="isapprover == '1' || permission == 2" @click="deleteinvited(invite.email)" class="fa fa-times" aria-hidden="true"></i></span><br>
                        
                    </span>
                    <span v-show="isapprover == '1' || permission == 2" @click="addinvite" id="addinvite"><i class="fa fa-plus"></i></span>
                    <div id="addinvite-select" class="hidden" v-show="isapprover == '1' || permission == 2">
                        <form @submit.prevent="Createinvite()">
                        <div class="form-group" style="">
                            <input type="text" id="invite_email" name="invite_email" v-model="form3.email" class="form-control" placeholder="Email">
                        </div>
                        <input type="hidden" name="job_id" v-model="form2.job_id">
                        <div class="form-group wt-btnarea" >
                            <button type="submit" id="addinvite" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.invite') }}</button>
                        </div>
                        </form>
                    </div>
              </td>
          </tr>
          <tr>
              <td class="job-details"><b>{{ trans('lang.quiz') }}</b></td>
              <td class="job-details">
                  <span @click="editquiz" id="quiz">{{ job1.quiz}} <i v-show="isapprover == '1' || permission == 2" class="fa fa-pencil float-right" style="padding: 12px;"></i></span>
                  <select class="form-control form-control-sm hidden" v-show="isapprover == '1' || permission == 2" id="editquiz-select" name="editquiz-select" v-on:change="updatequiz">
                            <option selected>{{ trans('lang.select') }} </option>
                            <option value="yes">{{ trans('lang.yes') }}</option>
                            <option value="no">{{ trans('lang.no') }}</option>
                        </select>
                  <br>

                  <span v-if="job1.quiz == 'yes'" v-show="isapprover == '1' || permission == 2">
                      
                      
                    <span v-for="quizx in quizzes" :key="quizx.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:3;"><span @click="showquiz(quizx.quiz_id)" style="cursor: pointer;">{{ quizx.title }}</span> <i @click="deletequiz(quizx.quiz_id)" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span @click="addquiz" id="addquiz"><i class="fa fa-plus"></i></span>
                    <select class="form-control form-control-sm hidden" id="addquiz-select" name="addquiz-select" v-on:change="updateaddquiz">
                            <option selected>{{ trans('lang.select') }} </option>
                            <option v-for="item in quizadd" :value="item.id">{{ item.title }}</option>
                        </select>
                  </span>
                </td>
          </tr>-->
          <tr>
              <td class="job-details"><b>{{ trans('lang.delivery') }} <span v-if="job1.delivery_type == 'date'">{{ trans('lang.date') }}</span> <span v-if="job1.delivery_type == 'time'">{{ trans('lang.time') }}</span></b></td>
              <td class="job-details">
                  <span @click="editexpirydate" v-if="job1.delivery_type == 'date'">
                      <span id="expirydate">{{ job1.expiry_date | formatDate1}} <i class="fa fa-pencil" v-show="isapprover == '1' || permission == 2" style="float:right;margin: 10px;"></i></span>
                      <div id="editexpirydate" class="hidden">            
                        <input type="date" dateformat="d M y" class="form-control form-control-sm pickadate" name="editexpirydate" autocomplete="off" placeholder="Expiry Date" v-on:change="updateexpirydate">
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


                  
                </td>
          </tr>
          
      </table>
                                        

                                    </div>
                                </div>
                                
                            </div>
        
</template>

<script>

//import vueDropzone from "vue2-dropzone";
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        form : new Form({
            id: '',
            description : '',
            job_id : ''
        }),
        job1 : {},
        quizzes : {},
        permission : {},
        project_levels : {},
        project_duration : {},
        project_english : {},
        project_freelancer : {},
        quizadd : {},
        languages : {},
        langs : {},
        skills : {},
        xskills : {},
        subskills : {},
        sub_skills : {},
        teams : {},
        approvers : {},
        invited : {},
        english : {},
        freelancer : {},
        form1 : new Form({
            id: '',
            name : '',
            lname : '',
            role : '',
            permission : '',
            email : '',
            job_id : this.jobid
        }),
        form2 : new Form({
            id: '',
            name : '',
            lname : '',
            role : '',
            permission : '',
            email : '',
            job_id : this.jobid
        }),
        form3 : new Form({
            id: '',
            email : '',
            job_id : this.jobid
        }),

        xcurrency : {},
        currency : {},
        xcategory : {},
        category : {},
        wapprover: true,
        wteam: true



        
    }
  },
  props: {
      jobid: String,
      userid: String,
      isapprover : String
  },
  methods: {
        loadjob() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_overview/' + this.jobid + '-' + this.userid).then(function (response) {
                self.job1 = response.data.job[0];
                self.quizzes = response.data.quizzes;
                self.permission = response.data.permission;
                //self.form1.project_level = response.data.project_level; 
                //console.log(response.data.job[0]);
            });  
            //console.log(this.job1);       
        },
        addcategory() {
            $('#addcategory-select').removeClass('hidden');
            
        },
        addcurrency() {
            $('#addcurrency-select').removeClass('hidden');
            
        },
        loadcurrency() {
            let self = this;
            axios.get(APP_URL + '/get-currency').then(function (response) {
                self.xcurrency = response.data.currency;
            });  
        },
        loadcategory() {
            let self = this;
            axios.get(APP_URL + '/get-categories').then(function (response) {
                self.xcategory = response.data.categories;
                //console.log(self.xskills);
            });  
        },
        updateaddcurrency(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/updatecurrency/' + statp).then(function (response) {
                
                $('#addcurrency-select').addClass('hidden');
                $('#addcurrency').removeClass('hidden');
            });
        
            Fire.$emit('AfterCreate');
            $('#addcurrency-select').addClass('hidden');
            $('#tr4').removeClass('hidden');
            
            
        },
        updateaddcategory(e) {
            
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/updatecategory/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#addskill-select').addClass('hidden');
                $('#addskill').removeClass('hidden');
            });
        
            Fire.$emit('AfterCreate');
            $('#addcategory-select').addClass('hidden');
        },
        deletecategory(id)
        {
            let statp =  this.job1.id + '-' + id;
            axios.get(APP_URL + '/api/job_overview/deletecategory/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
            });
        },
        showquiz(id) {
            //console.log(id);
            window.location.href="/questions/"+id;
        },
        loadlang() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getlang/'+ this.jobid).then(function (response) {
                self.langs = response.data;
                //console.log(self.project_levels);
            });  
        },
        loadenglish() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getenglish/'+ this.jobid).then(function (response) {
                self.english = response.data;
                //console.log(self.project_levels);
            });  
        },
        loadinvited() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getinvited/'+ this.jobid).then(function (response) {
                self.invited = response.data;
                //console.log(self.project_levels);
            });  
        },
        deleteinvited(email) {
            //console.log('delete is hitted');
            axios.get(APP_URL + '/api/job_overview/deleteinvited/'+ this.jobid + '-' + email).then(function (response) {
                Fire.$emit('Afterinvited');
            });
        },
        loadfreelancer() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getfreelancer/'+ this.jobid).then(function (response) {
                self.freelancer = response.data;
                //console.log(self.project_levels);
            });  
        },
        
        loadteam() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getteam/'+ this.jobid).then(function (response) {
                self.teams = response.data;
                
            });  
        },
        loadapprover() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getapprover/'+ this.jobid + '-' + this.userid).then(function (response) {
                self.approvers = response.data;
                
            });  
        },
        loadlanguage() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/language/'+ this.jobid).then(function (response) {
                self.languages = response.data;
                //console.log(self.project_levels);
            });  
        },
        loadskill() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getskill/'+ this.jobid).then(function (response) {
                self.xskills = response.data;
                //console.log(self.xskills);
            });  
        },
        loadskills() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/skill/'+ this.jobid).then(function (response) {
                self.skills = response.data;
                //console.log(self.project_levels);
            });  
        },
        loadsubskills() {
            let self = this;
            axios.get(APP_URL + '/api/sub_skill/'+ this.jobid).then(function (response) {
                self.subskills = response.data;
                //console.log(self.project_levels);
            });  
        },
        loadprojectlevel() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_project_level/').then(function (response) {
                self.project_levels = response.data;
                //console.log(self.project_levels);
            });  
                 
        },
        loadprojectduration() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_project_duration/').then(function (response) {
                self.project_duration = response.data;
                //console.log(self.project_levels);
            });  
                 
        },
        loadprojectenglish() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_project_english/').then(function (response) {
                self.project_english = response.data;
                //console.log(self.project_levels);
            });  
                 
        },
        addinvite() {
            //$('#addskill').addClass('hidden');
            $('#addinvite-select').removeClass('hidden');
        },
        addteam() {
            //$('#addskill').addClass('hidden');
            $('#addteam-select').removeClass('hidden');
        },
        addapprover() {
            //$('#addskill').addClass('hidden');
            $('#addapprover-select').removeClass('hidden');
        },
        Createinvite() {
            this.form3.post('/api/job_overview/createinvite/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Invited successfully'
                });
                Fire.$emit('Afterinvited');
                $('#addinvite-select').addClass('hidden');
                $('#invite_email').val("");
                
            })
            .catch(() => {

            })
        },
        Createteam() {
            this.wteam = false;
            this.form1.post('/api/job_overview/team/'+ this.job1.id)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Team Created successfully'
                });
                Fire.$emit('Afterteam');
                $('#addteam-select').addClass('hidden');
                $('#team_name').val("");
                $('#team_email').val("");
                this.wteam = true;
                this.form1.reset();
                
            })
            .catch(() => {
                this.wteam = true;
            })
        },
        deleteapprover(approver) {
            //let statp =  this.job1.id + '-' + team;
            axios.get(APP_URL + '/api/job_overview/deleteapprover/' + approver).then(function (response) {
                Fire.$emit('Afterapprover');
            });
        },
        Createapprover() {
            this.wapprover = false;
            this.form2.post('/api/job_overview/approver/'+ this.job1.id)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Approver Created successfully'
                });
                
                $('#addapprover-select').addClass('hidden');
                $('#approver_name').val("");
                $('#approver_email').val("");
                this.wapprover = true;
                this.form2.reset();
                Fire.$emit('Afterapprover');
            })
            .catch(() => {
                this.wapprover = true;
                this.form.reset();
            })
        },
        deleteteam(team) {
            //let statp =  this.job1.id + '-' + team;
            axios.get(APP_URL + '/api/job_overview/deleteteam/' + team).then(function (response) {
                Fire.$emit('Afterteam');
            });
        },
        deletesubskill(id) {
            
            axios.get(APP_URL + '/api/delete_sub_skill/' + id).then(function (response) {
                Fire.$emit('Aftersubskill');
            });
        },
        addskill() {
            $('#addskill').addClass('hidden');
            $('#addskill-select').removeClass('hidden');
        },
        addsubskill() {
            $('#addsubskill-select').empty();
            //console.log(this.xskills);
            var skills = this.xskills;
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

            $('#addsubskill').addClass('hidden');
            $('#addsubskill-select').removeClass('hidden');
        },
        approvejob(id)
        {
            //console.log(id);
            
            axios.get(APP_URL + '/api/job_overview/approvejob/' + id).then(function (response) {
                //console.log(response.data);
                Fire.$emit('Afterapprover');
                if(response.data == 0)
                {
                    toast.fire({
                    icon: 'success',
                    title: 'Job is approved'
                    });
                }
                else{
                    toast.fire({
                    icon: 'success',
                    title: 'Job is now posted and is open for Bidding.'
                    });
                }
            });
        },
        updateaddsubskill(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/post_sub_skill/' + statp).then(function (response) {
                Fire.$emit('Aftersubskill');
                $('#addsubskill-select').addClass('hidden');
                $('#addsubskill').removeClass('hidden');
            });
        },
        updateaddskill(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/updateskill/' + statp).then(function (response) {
                Fire.$emit('Afterskill');
                $('#addskill-select').addClass('hidden');
                $('#addskill').removeClass('hidden');
            });
        },
        deleteskill(lang) {
            let statp =  this.job1.id + '-' + lang;
            axios.get(APP_URL + '/api/job_overview/deleteskill/' + statp).then(function (response) {
                Fire.$emit('Afterskill');
            });
        },
        addlang() {
            $('#addlang').addClass('hidden');
            $('#addlang-select').removeClass('hidden');
        },
        updateaddlang(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/updatelang/' + statp).then(function (response) {
                Fire.$emit('AfterLang');
                $('#addlang-select').addClass('hidden');
                $('#addlang').removeClass('hidden');
            });
        },
        deletelang(lang) {
            let statp =  this.job1.id + '-' + lang;
            axios.get(APP_URL + '/api/job_overview/deletelang/' + statp).then(function (response) {
                Fire.$emit('AfterLang');
            });
        },
        addquiz() {
            let self = this;
            let statp =  this.job1.id + '-' + this.userid;
            axios.get(APP_URL + '/api/job_overview/getquiz/' + statp).then(function (response) {
                self.quizadd = response.data;
                //console.log(self.project_levels);
            });
            $('#addquiz').addClass('hidden');
            $('#addquiz-select').removeClass('hidden');
        },
        updateaddquiz(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/updatequiz/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#addquiz-select').addClass('hidden');
                $('#addquiz').removeClass('hidden');
            });
            
        },
        deletequiz(quiz) {
            let statp =  this.job1.id + '-' + quiz;
            axios.get(APP_URL + '/api/job_overview/deletequiz/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
            });
        },
        deleteenglish(id) {
            
            axios.get(APP_URL + '/api/job_overview/deleteenglish/' + id).then(function (response) {
                Fire.$emit('Afterenglish');
            });
        },
        deletefreelancer(id) {
            
            axios.get(APP_URL + '/api/job_overview/deletefreelancer/' + id).then(function (response) {
                Fire.$emit('Afterfreelancer');
            });
        },
        editquiz() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#quiz').addClass('hidden');
            $('#editquiz-select').removeClass('hidden');
            }
        },
        updatequiz(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/quiz/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editquiz-select').addClass('hidden');
                $('#quiz').removeClass('hidden');
            });
            
        },
        editdescription() {
            let self = this;
            self.form.description = this.job1.description;
            self.form.job_id = this.job1.id;
            
            $('#description').addClass('hidden');
            $('#editdescription').removeClass('hidden');
            
        },
        Updatedescription() {
            
            this.form.post('/api/job_overview/description/'+ this.job1.id)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Description Updated successfully'
                });
                Fire.$emit('AfterCreate');
                $('#editdescription').addClass('hidden');
                $('#description').removeClass('hidden');
            })
            .catch(() => {

            })
            
        },
        close() {
            $('#editdescription').addClass('hidden');
            $('#description').removeClass('hidden');
        },
        loadprojectfreelancer() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_project_freelancer/').then(function (response) {
                self.project_freelancer = response.data;
                //console.log(self.project_freelancer);
            });  
                 
        },
        editprojectlevel() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#projectlevel').addClass('hidden');
            $('#editprojectlevel').removeClass('hidden');
            }
        },
        updateprojectlevel(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_level/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editprojectlevel').addClass('hidden');
                $('#projectlevel').removeClass('hidden');
            });
        },
        editjobduration() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#jobduration').addClass('hidden');
            $('#editjobduration').removeClass('hidden');
            }
        },
        updatejobduration(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_duration/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editjobduration').addClass('hidden');
                $('#jobduration').removeClass('hidden');
            });
        },
        editprice() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#price').addClass('hidden');
            $('#editprice').removeClass('hidden');
            }
        },
        updateprice(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_price/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editprice').addClass('hidden');
                $('#price').removeClass('hidden');
            });
        },
        editfreelancer() {
            $('#addprojectfreelancer').addClass('hidden');
            $('#editfreelancer').removeClass('hidden');
        },
        updatefreelancer(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_freelancer/' + statp).then(function (response) {
                Fire.$emit('Afterfreelancer');
                $('#editfreelancer').addClass('hidden');
                $('#addprojectfreelancer').removeClass('hidden');
            });
        },
        editenglish() {
            $('#addenglish').addClass('hidden');
            $('#editenglish').removeClass('hidden');
        },
        updateenglish(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_english/' + statp).then(function (response) {
                Fire.$emit('Afterenglish');
                $('#editenglish').addClass('hidden');
                $('#addenglish').removeClass('hidden');
            });
        },
        editexpirydate() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#expirydate').addClass('hidden');
            $('#editexpirydate').removeClass('hidden');
            }
        },
        updateexpirydate(e) {
            let statp =  this.job1.id + '_' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_expirydate/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editexpirydate').addClass('hidden');
                $('#expirydate').removeClass('hidden');
            });
        },
        editjobmonth() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#jobmonth').addClass('hidden');
            $('#editjobmonth').removeClass('hidden');
            }
        },
        updatejobmonth(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_jobmonth/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editjobmonth').addClass('hidden');
                $('#jobmonth').removeClass('hidden');
            });
        },
        editjobday() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#jobday').addClass('hidden');
            $('#editjobday').removeClass('hidden');
            }
        },
        updatejobday(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_jobday/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editjobday').addClass('hidden');
                $('#jobday').removeClass('hidden');
            });
        },
        editjobweek() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#jobweek').addClass('hidden');
            $('#editjobweek').removeClass('hidden');
            }
        },
        updatejobweek(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_jobweek/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editjobweek').addClass('hidden');
                $('#jobweek').removeClass('hidden');
            });
        },
        editjobhour() {
            if(this.isapprover == '1' || this.permission == 2)
            {
            $('#jobhour').addClass('hidden');
            $('#editjobhour').removeClass('hidden');
            }
        },
        updatejobhour(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_jobhour/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editjobhour').addClass('hidden');
                $('#jobhour').removeClass('hidden');
            });
        },

        
        
            

  },
    mounted: function() {
        this.loadjob();
        //this.loadlang();
        //this.loadlanguage();
        //this.loadskill();
        //this.loadskills();
        this.loadprojectlevel();
        this.loadprojectduration();
        //this.loadprojectenglish();
        this.loadprojectfreelancer();
        this.loadteam();
        this.loadapprover();
        //this.loadenglish();
        this.loadfreelancer();
        //this.loadsubskills();
        //this.loadinvited();
        this.loadcategory();
        this.loadcurrency();
        
        
        Fire.$on('Afterteam', () => {
            this.loadteam();
        });
        Fire.$on('Afterapprover', () => {
            this.loadapprover();
        });
        Fire.$on('Afterfreelancer', () => {
            this.loadfreelancer();
        });
        
        Fire.$on('AfterCreate', () => {
            this.loadjob();
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