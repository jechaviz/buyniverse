<template>
    <div>
    <div class="row">
        <div class="md-2" style="font-size: 70px;color: gold;">
            <i class="fa fa-trophy" aria-hidden="true"></i>
        </div>
        <div class="md-10" style="margin-left: 15px;">

            <h2 id="title" class="hidden" v-html="jobform.title"></h2>
            <h4 id="project_id" class="hidden">{{ trans('lang.project_id') }}: # {{ job1.id }}</h4>
            <form @submit.prevent="posttitle()">
            <div class="form-group" id="posttitle">
                <input type="text" name="title" class="form-control" :placeholder="trans('lang.job_title')" v-model="jobform.title">
                <button type="submit" class="btn btn-sm x-submit-button" style="color: white;background-color: #005178;">
                    {{ trans('lang.post') }}
                </button>
            </div>
            </form>
            
        </div>
    </div>
    <div id="trx" class="wt-dashboardbox hidden">
                                <div class="wt-dashboardboxtitle">
                                    <div class="col-md-6">
                                        <h2>{{ trans('lang.post_job') }}</h2>
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
                                        <i @click="editdescription"  class="fa fa-pencil" style="float:right;margin: 10px;"></i>
                                        <div style="margin: 30px;" id="description" v-html="job1.description">
                                            
                                        </div>
                                        <div style="margin: 30px;" class="hidden"  id="editdescription">
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
                  <span id="projectlevel"> {{ job1.project_level }} <i  class="fa fa-pencil" style="float:right;margin: 10px;"></i></span>
                  <div id="editprojectlevel"  class="hidden">
                        
                        <select class="form-control form-control-sm" id="editprojectlevel-select" name="editprojectlevel-select" v-on:change="updateprojectlevel">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in project_levels" :key="key" :value="key">{{ item }}</option>
                        </select>                        
                    </div>
                </td>

          </tr>
          
          <tr id="tr2" class="hidden">
              <td class="job-details"><b>{{ trans('lang.duration') }}</b></td>
              <td @click="editjobduration" class="job-details">
                  <span id="jobduration"><span v-if="key==job1.duration" v-for="(item, key) in project_duration" :key="key"  :value="key">{{ item}}</span> <i class="fa fa-pencil"  style="float:right;margin: 10px;"></i></span>
                  <div id="editjobduration" class="hidden" >
                        
                        <select class="form-control form-control-sm" id="editprojectlevel-select" name="editprojectlevel-select" v-on:change="updatejobduration">
                            <option selected>{{ trans('lang.select') }}</option>
                            <option v-for="(item, key) in project_duration" :key="key"  :value="key">{{ item }}</option>
                        </select>                        
                    </div>
                </td>
          </tr>
          <tr id="tr3" class="hidden">
                <td class="job-details"><b>{{ trans('lang.tcurrency') }}</b></td>
                <td class="job-details">
                    <span>
                        <span v-if="job1.currency">
                            <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;">{{ job1.curr.symbol }} - {{ job1.curr.name }} </span><br>
                        </span>
                        <span @click="addcurrency" id="addcurrency"><i class="fa fa-plus"></i></span>
                        <select class="form-control form-control-sm hidden" id="addcurrency-select" name="addcurrency-select" v-on:change="updateaddcurrency">   
                            <option selected>{{ trans('lang.select') }}</option>                                 
                            <option v-for="(item, key) in xcurrency" :key="key" :value="item">{{ item }}</option>
                        </select>
                    </span>
                </td>
            </tr>
          <tr id="tr4" class="hidden">
              <td class="job-details"><b>{{ trans('lang.budget') }}</b></td>
              <td @click="editprice" class="job-details">
                    <span id="price"> <span v-if="job1.currency">{{ job1.curr.symbol }}</span>  {{ job1.price | numFormat}} <i class="fa fa-pencil"  style="float:right;margin: 10px;"></i></span>
                    <div id="editprice" class="hidden" >            
                        <input type="number" class="form-control form-control-sm " name="editprice" autocomplete="off" :value="job1.price" v-on:change="updateprice">
                    </div>
                </td>
          </tr>
          
          
            <tr id="tr5" class="hidden">
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
          <tr id="tr6" class="hidden">
              
              <td class="job-details"><b>{{ trans('lang.team') }}</b></td>
              <td class="job-details">
                  <span v-for="team in teams" :key="team.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ team.name }} {{ team.lname }} - {{ team.role }} <br> {{ team.email }}</span><i @click="deleteteam(team.id)"  class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span @click="addteam"  id="addteam"><i class="fa fa-plus"></i></span>
                    <div id="addteam-select"  class="hidden">
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
                            <button type="submit" id="addteam" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.add_team') }}</button>
                        </div>
                        </form>
                    </div>
              </td>
          </tr>
          <tr id="tr7" class="hidden">
              
              <td class="job-details"><b>{{ trans('lang.approver') }}</b></td>
              <td class="job-details">
                  <span v-for="approver in approvers" :key="approver.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:1;display: inline-block;"><span>{{ approver.name }} {{ approver.lname }} - {{ approver.role }} <br> {{approver.email}} </span><i  @click="deleteapprover(approver.id)" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span  @click="addapprover" id="addapprover"><i class="fa fa-plus"></i></span>
                    <div id="addapprover-select" class="hidden" >
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
                            <button type="submit" id="addapprover" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.add_approver') }}</button>
                        </div>
                        </form>
                    </div>
              </td>
          </tr>
          
          <tr id="tr8" class="hidden">
              <td class="job-details"><b>{{ trans('lang.quiz') }}</b></td>
              <td class="job-details">
                  <span @click="editquiz" id="quiz">{{ job1.quiz}} <i  class="fa fa-pencil float-right" style="padding: 12px;"></i></span>
                  <select class="form-control form-control-sm hidden"  id="editquiz-select" name="editquiz-select" v-on:change="updatequiz">
                            <option selected>{{ trans('lang.select') }} </option>
                            <option value="yes">{{ trans('lang.yes') }}</option>
                            <option value="no">{{ trans('lang.no') }}</option>
                        </select>
                  <br>

                  <span v-if="job1.quiz == 'yes'" >
                      
                      
                    <span v-for="quizx in quizzes" :key="quizx.id">
                        <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:3;"><span @click="showquiz(quizx.quiz_id)" style="cursor: pointer;">{{ quizx.title }}</span> <i @click="deletequiz(quizx.quiz_id)" class="fa fa-times" aria-hidden="true"></i></span><br>
                    </span>
                    <span @click="addquiz" id="addquiz"><i class="fa fa-plus"></i></span>
                    <select class="form-control form-control-sm hidden" id="addquiz-select" name="addquiz-select" v-on:change="updateaddquiz">
                            <option selected>{{ trans('lang.select') }} </option>
                            <option v-for="item in quizadd" :value="item.id" :key="item.id">{{ item.title }}</option>
                        </select>
                  </span>
                </td>
          </tr>
          <tr id="tr9" class="hidden">
              <td class="job-details"><b>{{ trans('lang.delivery') }} <span v-if="job1.delivery_type == 'date'">{{ trans('lang.date') }}</span> <span v-if="job1.delivery_type == 'time'">{{ trans('lang.time') }}</span></b></td>
              <td class="job-details">
                  <span @click="editexpirydate" v-if="job1.delivery_type == 'date'">
                      <span id="expirydate">{{ job1.expiry_date | formatDate1}} <i class="fa fa-pencil"  style="float:right;margin: 10px;"></i></span>
                      <div id="editexpirydate" class="hidden">            
                        <input type="date" class="form-control form-control-sm pickadate" name="editexpirydate" autocomplete="off" placeholder="Expiry Date" v-on:change="updateexpirydate">
                    </div>
                    </span>
                  <span v-if="job1.delivery_type == 'time'"><span id="jobmonth" @click="editjobmonth"> {{ trans('lang.month') }} : {{ job1.month }} <i class="fa fa-pencil"  style="float:right;margin: 10px;"></i></span>
                  <div id="editjobmonth" class="hidden" >            
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
          <tr id="tr10" class="hidden">

                <td colspan="2"><button @click="submitJob" id="post-job-show" class="wt-btn" style="margin: 5px;float: right;">{{ trans('lang.post_job') }}</button></td>
            </tr>
          
      </table>
                                        

                                    </div>
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
        jobform : new Form({
            title : '',
        }),
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
        
        
        quizadd : {},
        
        
        
        teams : {},
        approvers : {},
        
        
        
        xcurrency : {},
        currency : {},
        xcategory : {},
        category : {},
        form1 : new Form({
            id: '',
            name : '',
            lname : '',
            role : '',
            permission : '',
            email : '',
            job_id : ''
        }),
        form2 : new Form({
            id: '',
            name : '',
            lname : '',
            role : '',
            permission : '',
            email : '',
            job_id : ''
        }),
        form3 : new Form({
            id: '',
            email : '',
            job_id : ''
        }),
        job_id : ''


        
    }
  },
  props: {
      userid: String,
  },
  methods: {
        posttitle() {
            $('#title').removeClass('hidden');
            $('#posttitle').addClass('hidden');
            $('#description').addClass('hidden');
            $('#editdescription').removeClass('hidden');
            $('#project_id').removeClass('hidden');
            //$('#title').html(self.jobform.title);
            
            this.loading = true;
            var self = this;
            
            let form_data = self.jobform;
            
            axios.post(APP_URL + '/job/job-post', form_data)
                .then(function (response) {
                    console.log(response.data);
                    self.job_id = response.data.id;
                    self.form.job_id = response.data.id;
                    self.form1.job_id = response.data.id;
                    self.form2.job_id = response.data.id;
                    self.form3.job_id = response.data.id;
                    Fire.$emit('AfterCreate');
                });
                $('#trx').removeClass('hidden');
        },
        loadjob() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_overview/' + self.job_id + '-' + this.userid).then(function (response) {
                self.job1 = response.data.job[0];
                self.quizzes = response.data.quizzes;
                self.permission = response.data.permission;
                //self.form1.project_level = response.data.project_level; 
                //console.log(response.data.job[0]);
            });  
            //console.log(this.job1);       
        },
        submitJob: function () {
            this.loading = true;
            var self = this;
            
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
                Fire.$emit('Aftercat');
                $('#addskill-select').addClass('hidden');
                $('#addskill').removeClass('hidden');
            });
        
            Fire.$emit('AfterCreate');
            $('#addcategory-select').addClass('hidden');
            $('#tr6').removeClass('hidden');
            $('#tr7').removeClass('hidden');    
            $('#tr8').removeClass('hidden');
            $('#tr9').removeClass('hidden');
            $('#tr10').removeClass('hidden');
            
            
            
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
        
        
        loadteam() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getteam/'+ self.job_id).then(function (response) {
                self.teams = response.data;
                
            });  
        },
        loadapprover() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/getapprover/'+ self.job_id + '-' + this.userid).then(function (response) {
                self.approvers = response.data;
                
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
            let self = this;
            this.form1.post('/api/job_overview/team/'+ self.job_id)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Team Created successfully'
                });
                Fire.$emit('Afterteam');
                $('#addteam-select').addClass('hidden');
                $('#team_name').val("");
                $('#team_email').val("");
                
            })
            .catch(() => {

            })
        },
        deleteapprover(approver) {
            //let statp =  this.job1.id + '-' + team;
            axios.get(APP_URL + '/api/job_overview/deleteapprover/' + approver).then(function (response) {
                Fire.$emit('Afterapprover');
            });
        },
        Createapprover() {
            let self = this;
            this.form2.post('/api/job_overview/approver/'+ self.job_id)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Approver Created successfully'
                });
                Fire.$emit('Afterapprover');
                $('#addapprover-select').addClass('hidden');
                $('#approver_name').val("");
                $('#approver_email').val("");
                
            })
            .catch(() => {

            })
        },
        deleteteam(team) {
            //let statp =  this.job1.id + '-' + team;
            axios.get(APP_URL + '/api/job_overview/deleteteam/' + team).then(function (response) {
                Fire.$emit('Afterteam');
            });
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
        
        editquiz() {
            
            $('#quiz').addClass('hidden');
            $('#editquiz-select').removeClass('hidden');
            
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
                $('#tr1').removeClass('hidden');
                $('#projectlevel').addClass('hidden');
                $('#editprojectlevel').removeClass('hidden');
            })
            .catch(() => {

            })
            
        },
        close() {
            $('#editdescription').addClass('hidden');
            $('#description').removeClass('hidden');
        },
        
        editprojectlevel() {
            
            $('#projectlevel').addClass('hidden');
            $('#editprojectlevel').removeClass('hidden');
            
        },
        updateprojectlevel(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_level/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editprojectlevel').addClass('hidden');
                $('#projectlevel').removeClass('hidden');
                $('#tr2').removeClass('hidden');
                $('#jobduration').addClass('hidden');
                $('#editjobduration').removeClass('hidden');
            });
        },
        editjobduration() {
            
            $('#jobduration').addClass('hidden');
            $('#editjobduration').removeClass('hidden');
            
        },
        updatejobduration(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_duration/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editjobduration').addClass('hidden');
                $('#jobduration').removeClass('hidden');
                $('#tr3').removeClass('hidden');
                $('#price').addClass('hidden');
                $('#editprice').removeClass('hidden');
            });
        },
        editprice() {
            
            $('#price').addClass('hidden');
            $('#editprice').removeClass('hidden');
            
        },
        updateprice(e) {
            let statp =  this.job1.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/job_overview/project_price/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#editprice').addClass('hidden');
                $('#price').removeClass('hidden');
                $('#tr5').removeClass('hidden');
                
                
                
                $('#addprojectfreelancer').addClass('hidden');
                $('#editfreelancer').removeClass('hidden');
            });
        },
        
        editexpirydate() {
            
            $('#expirydate').addClass('hidden');
            $('#editexpirydate').removeClass('hidden');
            
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
            
            $('#jobmonth').addClass('hidden');
            $('#editjobmonth').removeClass('hidden');
            
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
            
            $('#jobday').addClass('hidden');
            $('#editjobday').removeClass('hidden');
            
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
            
            $('#jobweek').addClass('hidden');
            $('#editjobweek').removeClass('hidden');
            
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
            
            $('#jobhour').addClass('hidden');
            $('#editjobhour').removeClass('hidden');
            
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
        
        
        
        
        this.loadprojectlevel();
        this.loadprojectduration();
        //this.loadprojectenglish();
        //this.loadprojectfreelancer();
        this.loadcategory();
        this.loadcurrency();
        //this.loadteam();
        //this.loadapprover();
        //this.loadenglish();
        //this.loadfreelancer();
        //this.loadsubskills();
        //this.loadinvited();
        
        
        Fire.$on('Afterteam', () => {
            this.loadteam();
        });
        Fire.$on('Afterapprover', () => {
            this.loadapprover();
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