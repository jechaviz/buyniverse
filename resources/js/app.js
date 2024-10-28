import './bootstrap';
import { createApp } from 'vue';
import { Form, HasError, AlertError } from 'vform';

//import tinymce from 'tinymce/tinymce.js';
import Multiselect from 'vue-multiselect';
import Verte from 'verte';
//import 'verte/dist/verte.css';
import { VueStars } from "vue-stars";
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead';
import mitt from 'mitt';
import moment from 'moment';
import numeral from 'numeral';
//import {TinkerComponent} from 'botman-tinker';

import 'sweetalert2/dist/sweetalert2.min.css';
import Editor from '@tinymce/tinymce-vue'



const emitter = mitt();

window.Form = Form;






import Joboverview from './components/joboverview.vue';
import Tasks from './components/tasks.vue';
import Checklists from './components/checklists.vue';
import Comments from './components/comments.vue';
//import Quiz from './components/quiz.vue';
import Question from './components/question.vue';
import Answer from './components/answer.vue';
import Countdown from './components/countdown.vue';
//import JobQuiz from './components/JobQuiz.vue';
import Contest from './components/contest.vue';
import ContestProposal from './components/contest-proposal.vue';
import Proposal_file from './components/proposal_file.vue';
import Job_note from './components/job_note.vue';
import Job_ticket from './components/job_ticket.vue';
import Job_title from './components/job_title.vue';
import Job_file from './components/job_file.vue';
import Jobshow from './components/jobshow.vue';
import Sendinvite from './components/sendinvite.vue';
import Sendinvitation from './components/Sendinvitation.vue';
import Job_provider from './components/Job_provider.vue';
import Search_provider from './components/Search_provider.vue';
import IJob_provider from './components/IJob_provider.vue';
import Job_contest from './components/job_contest.vue';
import Chatroom from './components/chatroom.vue';
import Post_job from './components/post-job.vue';
import Draft_job from './components/draft-job.vue';
import Hirenow from './components/hirenow.vue';


//import UploadFileComponent from './components/UploadFileComponent.vue';
//import UploadImageComponent from './components/UploadImageComponent.vue';
import FlashMessages from './components/FlashMessages.vue';
import SwitchButton from './components/SwitchButton.vue';
import ProfileSkillComponent from './components/ProfileSkillComponent.vue';
import ProfileCategoryComponent from './components/ProfileCategoryComponent.vue';
import PageOrderComponent from './components/PageOrderComponent.vue';
import ProfileExperienceComponent from './components/ProfileExperienceComponent.vue';
//import ProfileEducationComponent from './components/ProfileEducationComponent.vue';
//import ProfileProjectComponent from './components/ProfileProjectComponent.vue';
//import ProfileAwardComponent from './components/ProfileAwardComponent.vue';
//import UploadJobAttachmentComponent from './components/UploadJobAttachmentComponent.vue';
//import JobMultipleAttachmentComponent from './components/JobMultipleAttachmentComponent.vue';
import JobSkillComponent from './components/JobSkillComponent.vue';
import PrivateMessageComponent from './components/PrivateMessageComponent.vue';
import RatingComponent from './components/RatingComponent.vue';
import SearchComponent from './components/SearchComponent.vue';
import ConversationComponent from './components/admin/ConversationComponent.vue';
import Chat from './components/Chat.vue';
import ChatUserComponent from './components/ChatUserComponent.vue';
import ChatUserComponent1 from './components/ChatUserComponent1.vue';
import ChatMessageComponent from './components/ChatMessageComponent.vue';
import ChatAreaComponent from './components/ChatAreaComponent.vue';
import ChatComponent from './components/ChatComponent.vue';
import ChatComponent1 from './components/ChatComponent1.vue';
import emojiTexeareaComponent from './components/emojiTexeareaComponent.vue';
import DeleteRecordComponent from './components/DeleteRecordComponent.vue';
import CountdownComponent from './components/CountdownComponent.vue';
import ProviderExperienceComponent from './components/ProviderExperienceComponent.vue';
import ProviderEducationComponent from './components/ProviderEducationComponent.vue';
import ProviderCraftedProjetcsComponent from './components/ProviderCraftedProjetcsComponent.vue';
import Map from './components/map.vue';
import DashboardIconUploadComponent from './components/DashboardIconUploadComponent.vue';
//import UploadServiceAttachmentComponent from './components/UploadServiceAttachmentComponent.vue';
import ProviderReviewsComponent from './components/ProviderReviewsComponent.vue';
import JobExperyComponent from './components/JobExperyComponent.vue';
import Style2 from './components/pages/show/sections/sliders/style2.vue';
import Style3 from './components/pages/show/sections/sliders/style3.vue';
//import PageAttachmentComponent from './components/PageAttachmentComponent.vue';
import CustomLinkComponent from './components/CustomLinkComponent.vue';
//import Pcreate from './components/pages/create.vue';
//import Pedit from './components/pages/edit.vue';
import Show from './components/pages/show/show.vue';
//import SearchComponentV2 from './components/SearchComponentV2.vue';
import Slider from './components/pages/show/skeleton/slider.vue';

import { ContentLoader } from "vue-content-loader"


/*if (document.getElementById("jobs")) {
    const app = createApp({});
}
elseif (document.getElementById("pages-list")) {
    const app = createApp({

        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
        created: function () {
            // this.getPageOption();
        },
        
        methods: {
            removeImage: function (id) {
                this.page_banner = true;
                document.getElementById(id).value = '';
            },
            showMessage(message) {
                return this.$toast.success(' ', message, this.notificationSystem.options.success);
            },
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error);
            },
            selectAll: function () {
                this.is_show = !this.is_show;
                jQuery("#wt-pages").change(function () {
                    jQuery("input:checkbox").prop('checked', jQuery(this).prop("checked"));
                });
            },
            selectRecord: function () {
                if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
                    this.is_show = true;
                } else {
                    this.is_show = false;
                }
            },
            deleteChecked: function (msg, text) {
                var deleteIDs = jQuery("#checked-val input:checkbox:checked").map(function () {
                    return jQuery(this).val();
                }).get();
                var self = this;
                this.$swal({
                    title: msg,
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        axios.post(APP_URL + '/admin/delete-checked-pages', {
                            ids: deleteIDs
                        })
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    setTimeout(function () {
                                        self.$swal({
                                            title: this.title,
                                            text: text,
                                            type: "success"
                                        })
                                    }, 500);
                                    window.location.replace(APP_URL + '/admin/pages');
                                } else {
                                    self.showError(response.data.message);
                                }
                            })
                    } else {
                        this.$swal.close()
                    }
                })
            }
        }
        
    });
}
else
{
    const app = createApp({});
}*/
    
const app = createApp({});


app.config.globalProperties.$trans = (key) => {
    return _.get(window.trans, key, key);
};

app.config.globalProperties.$filters = {
  two_digits(value) {
    if (value.toString().length <= 1) {
        return "0" + value.toString();
    }
    return value.toString();
  },
  formatDate(value) {
    if (value) {
        return moment(String(value)).format('MM-DD-YYYY')
    }
  },
  formatDate1(value) {
    if (value) {
        return moment(String(value)).format('DD-MM-YYYY')
    }
  },
  datetime(value) {
    if (value) {
      return moment(String(value)).format('MM-DD-YYYY hh:mm:ss')
    }
  },
  formatAgo(value) {
    if (value) {
      return moment(String(value)).fromNow()
    }
  },
  countdown(value) {
    if (value) {
      return moment(String(value)).countdown().toString();
    }
  },
  formatPriority(value) {
    switch(value)
    {
        case 0 : return 'Normal';
        case 1 : return 'High';
        case 2 : return 'Urgent';
        case 3 : return 'Low';
    }
  },
  formatStatus(value) {
    switch(value)
    {
        case 0 : return 'New';
        case 1 : return 'In Progress';
        case 2 : return 'Testing';
        case 3 : return 'Awaiting Feedback';
        case 4 : return 'Completed';
    }
  },
  formatClient(value) {
    switch(value)
    {
        case 0 : return 'Not Visible';
        case 1 : return 'Visible';        
    }
  },
  formatMilestone(value) {
    switch(value)
    {
        case 0 : return 'Planing';
        case 1 : return 'Design';
        case 2 : return 'Development';
        case 3 : return 'Testing';
    }
  },
  numFormat(value) {
    return numeral(1000).format('0,0');
    //return numeralIntl.NumberFormat(value);
  },
  toCurrency(value) {
    return numeralIntl.NumberFormat(value);
  }

};

window.Fire = createApp({});



//Jobs vue components
app.component('joboverview', Joboverview);

app.component('tasks', Tasks);
app.component('checklists', Checklists);
app.component('comments', Comments);
//app.component('quiz', Quiz);
app.component('question', Question);
app.component('answer', Answer);
//app.component('countdown', Countdown);
//app.component('job_quiz', JobQuiz);
app.component('contest', Contest);
app.component('contest-proposal', ContestProposal);
app.component('proposal_file', Proposal_file);
app.component('job_note', Job_note);
app.component('job_file', Job_file);
app.component('job_ticket', Job_ticket);
app.component('job_title', Job_title);

app.component('jobshow', Jobshow);
//app.component('gmap', require('./components/gmap.vue').default);
app.component('sendinvite', Sendinvite);
app.component('sendinvitation', Sendinvitation);
app.component('job_provider', Job_provider);
app.component('provider_search', Search_provider);
app.component('ijob_provider', IJob_provider);
app.component('tinymce', Editor);
//app.component('botman-tinker', TinkerComponent);
app.component('job_contest', Job_contest);
app.component('chatroom', Chatroom);
app.component('post-job', Post_job);
app.component('draft-job', Draft_job);
app.component('multiselect', Multiselect);
app.component('hirenow', Hirenow);


app.component('verte', Verte);

//app.component('upload-file', UploadFileComponent);
//app.component('upload-image', UploadImageComponent);
app.component('flash_messages', FlashMessages);
app.component('switch_button', SwitchButton);
app.component('user_skills', ProfileSkillComponent);
app.component('user_category', ProfileCategoryComponent);
app.component('page-order', PageOrderComponent);
app.component('provider_experience', ProfileExperienceComponent);
//app.component('provider_education', ProfileEducationComponent);
//app.component('provider_project', ProfileProjectComponent);
//app.component('provider_award', ProfileAwardComponent);
///app.component('job_attachments',UploadJobAttachmentComponent);
//app.component('job_multiple-attachments', JobMultipleAttachmentComponent);
app.component('job_skills', JobSkillComponent);
app.component('private-message', PrivateMessageComponent);
app.component('rating', RatingComponent);
app.component('search-form', SearchComponent);
//require('./components/FlashMessageComponent.vue').default
app.component("vue-stars", VueStars)
app.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)
app.component('conversation', ConversationComponent);
app.component('chat', Chat);
app.component('chat-users', ChatUserComponent);
app.component('chat-users1', ChatUserComponent1);
app.component('chat-messages', ChatMessageComponent);
app.component('chat-area', ChatAreaComponent);
app.component('message-center', ChatComponent);
app.component('message-center1', ChatComponent1);
app.component('emoji-textarea', emojiTexeareaComponent);
app.component('delete', DeleteRecordComponent);
app.component('countdown', CountdownComponent);
app.component('experience', ProviderExperienceComponent);
app.component('education', ProviderEducationComponent);
app.component('crafted_project', ProviderCraftedProjetcsComponent);
app.component('custom-map', Map);
app.component('dashboard-icon', DashboardIconUploadComponent);
//app.component('image-attachments', UploadServiceAttachmentComponent);
app.component('provider-reviews', ProviderReviewsComponent);
app.component('job-expiry', JobExperyComponent);
app.component('second-slider', Style2);
app.component('third-slider', Style3);
//app.component('page-media', PageAttachmentComponent)
app.component('custom-link', CustomLinkComponent);
//app.component('create-new-page', Pcreate);
//app.component('edit-new-page', Pedit);
app.component('show-new-page', Show);
//app.component('search-form-v2', SearchComponentV2);
app.component('slider-skeleton', Slider);
app.component('content-loader', ContentLoader);



app.config.globalProperties.emitter = emitter;
//app.config.globalProperties.$emitter = emitter;



/*if (document.getElementById("jobs")) {
    app.mount('#buyniverse_app');
}
if (document.getElementById("pages-list")) {

  
}*/
//app.mount('#buyniverse_app  '); id="buyniverse_app"
if (document.getElementById('registration')) 
{
    const registration = createApp({
        mounted() {
            // Your code here
        },
        data() {
               return {
                notificationSystem: {
                    options: {
                        error: {
                            position: "topRight",
                            timeout: 4000
                        }
                    }
                },
                step: 1,
                user_email: '',
                first_name: '',
                last_name: '',
                nickname: '',
                form_step1: {
                    email_error: '',
                    is_email_error: false,
                    first_name_error: '',
                    is_first_name_error: false,
                    last_name_error: '',
                    is_last_name_error: false,
                    nickname_error: '',
                    is_nickname_error: false,
                },
                form_step2: {
                    locations_error: '',
                    is_locations_error: false,
                    password_error: '',
                    is_password_error: false,
                    password_confirm_error: '',
                    is_password_confirm_error: false,
                    termsconditions_error: '',
                    is_termsconditions_error: false,
                    role_error: '',
                    is_role_error: false,
                },
                loading: false,
                user_role: 'employer',
                is_show: true,
                error_message: ''
            };
        },
        methods: {
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error);
            },
            prev: function () {
                this.step--;
            },
            next: function () {
                this.step++;
            },
            selectedRole: function (role) {
                if (role == 'employer') {
                    this.is_show = true;
                } else {
                    this.is_show = false;
                }
            },
            checkSingleForm: function (error_message) {
                this.error_message = error_message
                this.loading = true
                this.form_step1.first_name_error = '';
                this.form_step1.is_first_name_error = false;
                this.form_step1.last_name_error = '';
                this.form_step1.is_last_name_error = false;
                this.form_step1.nickname_error = '';
                this.form_step1.is_nickname_error = false;
                this.form_step1.email_error = '';
                this.form_step1.is_email_error = false;
                this.form_step2.password_error = '';
                this.form_step2.is_password_error = false;
                this.form_step2.password_confirm_error = '';
                this.form_step2.is_password_confirm_error = false;
                this.form_step2.termsconditions_error = '';
                this.form_step2.is_termsconditions_error = false;
                this.form_step2.role = '';
                this.form_step2.is_role = false;
                var self = this
                let registerForm = document.getElementById('register_form')
                let formData = new FormData(registerForm)
                axios.post(APP_URL + '/register/single-form-custom-errors', formData)
                    .then(function (response) {
                        self.loading = false
                        self.submitUser('single')
                    })
                    .catch(function (error) {
                        self.loading = false
                        if (error.response.data.errors.first_name) {
                            self.form_step1.first_name_error = error.response.data.errors.first_name[0];
                            self.form_step1.is_first_name_error = true;
                        }
                        if (error.response.data.errors.last_name) {
                            self.form_step1.last_name_error = error.response.data.errors.last_name[0];
                            self.form_step1.is_last_name_error = true;
                        }
                        if (error.response.data.errors.nickname) {
                            self.form_step1.nickname_error = error.response.data.errors.nickname[0];
                            self.form_step1.is_nickname_error = true;
                        }
                        if (error.response.data.errors.email) {
                            self.form_step1.email_error = error.response.data.errors.email[0];
                            self.form_step1.is_email_error = true;
                        }
                        if (error.response.data.errors.password) {
                            self.form_step2.password_error = error.response.data.errors.password[0];
                            self.form_step2.is_password_error = true;
                        }
                        if (error.response.data.errors.password_confirmation) {
                            self.form_step2.password_confirm_error = error.response.data.errors.password_confirmation[0];
                            self.form_step2.is_password_confirm_error = true;
                        }
                        if (error.response.data.errors.termsconditions) {
                            self.form_step2.termsconditions_error = error.response.data.errors.termsconditions[0];
                            self.form_step2.is_termsconditions_error = true;
                        }
                        if (error.response.data.errors.role) {
                            self.form_step2.role_error = error.response.data.errors.role[0];
                            self.form_step2.is_role_error = true;
                        }
                    })
            },
            checkStep1: function (e) {
                this.form_step1.first_name_error = '';
                this.form_step1.is_first_name_error = false;
                this.form_step1.last_name_error = '';
                this.form_step1.is_last_name_error = false;
                this.form_step1.nickname_error = '';
                this.form_step1.is_nickname_error = false;
                this.form_step1.email_error = '';
                this.form_step1.is_email_error = false;
                var self = this;
                let register_Form = document.getElementById('register_form');
                let form_data = new FormData(register_Form);
                axios.post(APP_URL + '/register/form-step1-custom-errors', form_data)
                    .then(function (response) {
                        self.next();
                        //this.emitter.emit('Loadmap');
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.first_name) {
                            self.form_step1.first_name_error = error.response.data.errors.first_name[0];
                            self.form_step1.is_first_name_error = true;
                        }
                        if (error.response.data.errors.last_name) {
                            self.form_step1.last_name_error = error.response.data.errors.last_name[0];
                            self.form_step1.is_last_name_error = true;
                        }
                        if (error.response.data.errors.nickname) {
                            self.form_step1.nickname_error = error.response.data.errors.nickname[0];
                            self.form_step1.is_nickname_error = true;
                        }
                        if (error.response.data.errors.email) {
                            self.form_step1.email_error = error.response.data.errors.email[0];
                            self.form_step1.is_email_error = true;
                        }
                    });
            },
            checkStep2: function (error_message) {
                this.error_message = error_message;
                let register_Form = document.getElementById('register_form');
                let form_data = new FormData(register_Form);
                this.form_step2.password_error = '';
                this.form_step2.is_password_error = false;
                this.form_step2.password_confirm_error = '';
                this.form_step2.is_password_confirm_error = false;
                this.form_step2.termsconditions_error = '';
                this.form_step2.is_termsconditions_error = false;
                this.form_step2.role = '';
                this.form_step2.is_role = false;
                var self = this;
                axios.post(APP_URL + '/register/form-step2-custom-errors', form_data).
                    then(function (response) {
                        self.submitUser('multiple')
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.password) {
                            self.form_step2.password_error = error.response.data.errors.password[0];
                            self.form_step2.is_password_error = true;
                        }
                        if (error.response.data.errors.password_confirmation) {
                            self.form_step2.password_confirm_error = error.response.data.errors.password_confirmation[0];
                            self.form_step2.is_password_confirm_error = true;
                        }
                        if (error.response.data.errors.termsconditions) {
                            self.form_step2.termsconditions_error = error.response.data.errors.termsconditions[0];
                            self.form_step2.is_termsconditions_error = true;
                        }
                        if (error.response.data.errors.role) {
                            self.form_step2.role_error = error.response.data.errors.role[0];
                            self.form_step2.is_role_error = true;
                        }
                    });
            },
            submitUser: function (formType) {
                this.loading = true;
                let register_Form = document.getElementById('register_form');
                let form_data = new FormData(register_Form);
                if (formType == 'multiple') {
                    form_data.append('email', this.user_email);
                    form_data.append('first_name', this.first_name);
                    form_data.append('last_name', this.last_name);
                    form_data.append('nickname', this.nickname);
                }
                var self = this;
                axios.post(APP_URL + '/register', form_data)
                    .then(function (response) {
                        self.loading = false;
                        if (response.data.type == 'success') {
                            if (response.data.email == 'not_configured') {
                                window.location.replace(response.data.url);
                            } else {
                                if (formType == 'single') {
                                    self.loginRegisterUser()
                                } else if (formType == 'multiple') {
                                    self.next();
                                }
                            }
                        } else if (response.data.type == 'error') {
                            self.loading = false;
                            self.custom_error = true;
                            if (response.data.email_error) self.form_errors.push(response.data.email_error);
                            if (response.data.password_error) self.form_errors.push(response.data.password_error);
                        }
                        else if (response.data.type == 'server_error') {
                            self.loading = false;
                            self.custom_error = true;
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.status == 500) {
                            self.showError(self.error_message);
                        }
                    });
            },
            verifyCode: function () {
                this.loading = true;
                let register_Form = document.getElementById('verification_form');
                let form_data = new FormData(register_Form);
                var self = this;
                axios.post(APP_URL + '/register/verify-user-code', form_data)
                    .then(function (response) {
                        self.loading = false;
                        if (response.data.type == 'success') {
                            self.next();
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loginRegisterUser: function () {
                var self = this;
                axios.post(APP_URL + '/register/login-register-user')
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            window.location.href = APP_URL + '/' + response.data.role + '/dashboard';
                        } else if (response.data.type == 'error') {
                            self.error_message = response.data.message;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            scrollTop: function () {
                var _scrollUp = jQuery('html, body');
                _scrollUp.animate({ scrollTop: 0 }, 'slow');
                jQuery('.wt-loginarea .wt-loginformhold').slideToggle();
            },
        }
    });

    registration.mount('#registration');

}
else
{
    app.mount('#wt-main');
}


