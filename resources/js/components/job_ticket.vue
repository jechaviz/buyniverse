<template>
    <div>
        <div class="btn" style="margin: 24px;float: right;border: none!important;background-color: #ffffff00;margin-top: -71px;" v-if="role == 'employer' && freelancerid != 0"><button @click="newticket" class="wt-btn"> {{ trans('lang.new_ticket') }} </button></div>
        
        <table class="wt-tablecategories" v-if="tickets.length > 0">
            
            <thead>
                <tr>
                    <th>
                        {{ trans('lang.id') }}
                    </th>
                    
                    <th>{{ trans('lang.subject') }}</th>
                    <th>{{ trans('lang.sent_to') }}</th>
                    <th>{{ trans('lang.from') }}</th>
                    <th>{{ trans('lang.date') }}</th>
                    <th>{{ trans('lang.priority') }}</th>
                    <th>{{ trans('lang.status') }}</th>
                    <th>{{ trans('lang.last_acivity') }}</th>
                    <th>{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket in tickets" :key="ticket.id">
                    <td data-toggle="modal" :data-target="'#message-' + ticket.id">{{ticket.id}}</td>                
                    <td data-toggle="modal" :data-target="'#message-' + ticket.id">{{ticket.subject}}</td>
                    <td>{{ticket.sent_to}}</td>
                    <td>{{ticket.from}}</td>
                    <td>{{ticket.created_at | formatDate}}</td>
                    <td>{{ticket.priority}}</td>
                    <td >{{ticket.status}}</td>
                    <td>{{ticket.updated_at | formatDate}}</td>
                    <td data-th="Action">
                        <span class="bt-content">
                            <div class="">
                                <a data-toggle="modal" :data-target="'#message-' + ticket.id"><button class="btn">{{ trans('lang.view') }}</button></a>
                                <div class="dropdown">
                                    <button class="btn" style="border-left:1px solid #b4b1b1">
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a data-toggle="modal" :data-target="'#reply-' + ticket.id">{{ trans('lang.reply') }}</a>											
                                    </div>
                                </div>
                                <!--<a data-toggle="modal" :data-target="'#message-' + ticket.id" class="wt-addinfo wt-skillsaddinfo"><i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" :data-target="'#reply-' + ticket.id"  class="wt-addinfo wt-skillsaddinfo"><i class="fa fa-reply"></i></a>
                                <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo"><i class="fa fa-pause"></i></a>
                                <a href="javascript:void(0);" class="wt-deleteinfo"><i class="fa fa-times"></i></a>-->
                            </div>
                        </span>
                    </td>
                    <div class="modal fade" :id="'message-' + ticket.id" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ticket.subject}}</h5>
                                <div class="x-element" id="card-ticket-status"  v-if="role == 'employer'" @click="editstatus()" style="width: 100%;">
                                    <span style="float: right;border: 1px solid black;padding: 10px 25px;border-radius: 10px;">{{ ticket.status }}</span>
                                </div>
                                <div id="card-ticket-stat" class="hidden" style="margin-bottom: 13px;width:100%">
                                    <div class="float-right">
                                    <select class="form-control form-control-sm" style="height: 32px;" id="task-stat" name="ticket-stat" v-on:change="statuschange">
                                        <option :value="ticket.id + '-open'">{{ trans('lang.open') }}</option>
                                        <option :value="ticket.id + '-waiting'">{{ trans('lang.waiting') }}</option>
                                        <option :value="ticket.id + '-hold'">{{ trans('lang.hold') }}</option>
                                        <option :value="ticket.id + '-close'">{{ trans('lang.close') }}</option>
                                    </select>  
                                    </div>                      
                                </div>
                                <button type="button" class="close" @click="Close2(ticket.id)" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        {{ticket.from}} <br>
                                        {{ticket.created_at | formatAgo}}
                                    </div>
                                    <div class="col-md-8">
                                        {{ ticket.message }}
                                        <div v-if="ticket.file_id">
                                        <br>
                                        <a style="cursor: pointer;" @click="getDownload(ticket)"> <i class="fa fa-download" aria-hidden="true"></i> {{ trans('lang.attachments') }}</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div v-for="reply in ticket.reply" :key="reply.id">
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        {{reply.user}} <br>
                                        {{reply.created_at | formatAgo}}
                                    </div>
                                    <div class="col-md-8">
                                        {{ reply.message }}
                                    </div>
                                </div>
                                </div>
                                
                                
                                
                            </div>
                            
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="modal fade" :id="'reply-' + ticket.id" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <form @submit.prevent="replyTicket(ticket.id)">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ticket.subject}} - {{ trans('lang.reply') }}</h5>
                                
                                <button type="button" class="close" @click="Close1(ticket.id)" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <div class="modal-body">
                                
                                <div class="form-group">
                                    <label>{{ trans('lang.msg') }}</label>
                                    <textarea v-model="form1.message"  class="form-control" name="message" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                                </div>
                                
                                <input type="hidden" name="user_id" v-model="form1.user_id">
                                <input type="hidden" name="ticket_id" v-model="form1.ticket_id">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger"  @click="Close1(ticket.id)" data-dismiss="modal">{{ trans('lang.close') }}</button>
                                <button type="submit" class="btn btn-success">{{ trans('lang.reply') }}</button>
                                
                            </div>
                            
                            </div>
                            </form>
                        </div>                        
                    </div>
                    
                </tr>
            </tbody>
        </table>
        <div v-if="!tickets.length > 0">
            <div class="wt-emptydata-holder" style="background-color: white;">
                <div class="wt-emptydata">
                    <div class="wt-emptydetails wt-empty-person">
                        <em>{{ trans('lang.no_record') }}</em>
                    </div>
                </div>
            </div>
        </div>
        
        <form @submit.prevent="editmode ? UpdateTicket() : CreateTicket()">
        <div class="modal fade" id="newticket" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 50px;">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">{{ trans('lang.add_new_ticket') }}</h5>
                    <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">{{ trans('lang.update_ticket') }}</h5>
                    <button type="button" class="close" @click="Close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('lang.subject') }}</label>
                        <input v-model="form.subject" type="text" name="subject"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('subject') }">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('lang.msg') }}</label>
                        <textarea  rows="5" v-model="form.message"  class="form-control" name="message" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                    </div>
                    <div class="form-group form-group-half" style="padding-right: 5px;">
                        <div class="form-group-holder">
                            <label>{{ trans('lang.sent_to') }}</label>
                            <span class="wt-select">
                                <select v-model="form.sent_to" id="sent_to" class="job-skills">
                                    <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}} - {{user.role}}</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-half" style="padding-left: 5px;">
                        <div class="form-group-holder">
                            <label>{{ trans('lang.priority') }}</label>
                            <span class="wt-select">
                                <select id="priority" v-model="form.priority" class="job-skills">
                                    <option value="normal">{{ trans('lang.normal') }}</option>
                                    <option value="medium">{{ trans('lang.mediumx') }}</option>
                                    <option value="high">{{ trans('lang.high') }}</option>
                                    <option value="critical">{{ trans('lang.critical') }}</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-label">
                        <div class="wt-labelgroup">
                            <label for="ticket_files">
                                <span class="wt-btn">{{ trans('lang.select_files') }}</span>
                            </label>
                            <input v-on:change="onTicketFileChange" id="ticket_files" type="file" style="display:none;">
                        </div>
                    </div>
                    <input type="hidden" name="user_id" v-model="form.user_id">
                    <input type="hidden" name="job_id" v-model="form.job_id">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"  @click="Close" data-dismiss="modal">{{ trans('lang.close') }}</button>
                    <button type="submit" v-show="editmode" class="btn btn-success">{{ trans('lang.update') }}</button>
                    <button type="submit" v-show="!editmode" class="btn btn-primary">{{ trans('lang.create') }}</button>
                </div>
                
                </div>
            </div>
        </div>
        </form>
    </div>
</template>

<script>

//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        editmode : false,
        users : {},
        tickets : {},
        form : new Form({
            id: '',
            subject : '',
            message : '',
            sent_to : '',
            priority : '',
            user_id : this.userid,
            job_id : this.jobid,
            files : ''            
        }),
        form1 : new Form({
            id : '',
            message : '',
            user_id : this.userid,
            ticket_id : ''
        }),
        role : ''
        
    }
  },
  props: {
      jobid: String,
      userid: String,
      freelancerid: String
  },
  methods: {
        newticket() 
        {            
            this.editmode = false;
            this.form.reset();
            $('#newticket').modal('show');   
            $('#newticket').addClass('show');
        },
        CreateTicket() {

            let formData = new FormData();

            formData.append("files", this.form.files);
            formData.append("subject", this.form.subject);
            formData.append("message", this.form.message);
            formData.append("sent_to", this.form.sent_to);
            formData.append("priority", this.form.priority);
            formData.append("user_id", this.form.user_id);
            formData.append("job_id", this.form.job_id);

            axios.post(APP_URL + '/api/job_ticket/', formData) 
            .then(() => {
                toast.fire({
                type: 'success',
                title: 'Ticket Created successfully'
                });
                Fire.$emit('AfterCreate');
                $('#newticket').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
        },
        replyTicket(id) {
            this.form1.ticket_id = id;
            this.form1.post('/api/reply_ticket/')
            .then(() => {
                toast.fire({
                type: 'success',
                title: 'Replied successfully'
                });
                Fire.$emit('AfterCreate');
                $('#reply-' + id).modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
        },
        onTicketFileChange(e) {
            
            this.form.files = e.target.files[0];
            //console.log(this.form.files);
        },
        getDownload(file) {
            
            axios({
                url: APP_URL + '/api/job_ticket/download/' + file.id,
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement('a');

                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', file.file_id);
                    document.body.appendChild(fileLink);

                    fileLink.click();
            });
        },
        editstatus() {
            $('#card-ticket-status').addClass('hidden');
            $('#card-ticket-stat').removeClass('hidden');
        },
        statuschange(e) {            
            let stat =  e.target.value;
            console.log(stat);
            axios.get(APP_URL + '/api/ticket/status/' + stat).then(function (response) {
                Fire.$emit('AfterCreate');
                $('#card-ticket-status').removeClass('hidden');
                $('#card-ticket-stat').addClass('hidden');
                $('#cardModal').modal('hide');
            });
        },
        loadTicket() {
            let self = this;
            axios.get(APP_URL + '/api/job_ticket/' + this.jobid).then(function (response) {
                self.tickets = response.data;
            });
        },
        Close() {
            $('#newticket').removeClass('show');
        },
        Close1(id) {
            $('#reply'+ id).removeClass('show');
        },
        Close2(id) {
            $('#message'+ id).removeClass('show');
        },
        loadRole() {
            let self = this;            
            axios.get(APP_URL + '/api/user/role/' + this.userid).then(function (response) {
                self.role = response.data;
            });
        },
        loadUsers() {
            let self = this;
            axios.get(APP_URL + '/api/job_ticket/teams/' + this.freelancerid).then(function (response) {
                self.users = response.data;
            });
        }

            

  },
    mounted: function() {
        this.loadRole();
        this.loadTicket();
        this.loadUsers();
        Fire.$on('AfterCreate', () => {
            this.loadTicket();
            this.Close();
        });
    
  }
};
</script>