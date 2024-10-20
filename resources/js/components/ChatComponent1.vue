<template>
    <div>
        <div class="wt-dashboardboxtitle wt-titlemessages" v-if="user">
            <a href="javascript:void(0);" class="wt-back"><i class="ti-arrow-left"></i></a>
            <div class="wt-userlogedin">
                <figure class="wt-userimg">
                    <img :src="user.selected_user_image" alt="image description">
                </figure>
                <div class="wt-username">
                    <h3><i class="fa fa-check-circle"></i> {{user.selected_user_name}}</h3>
                    <span>{{user.selected_user_tagline}}</span>
                </div>
            </div>
            <a :href="url+'/profile/'+user.selected_user_slug" class="wt-viewprofile">{{ $trans('lang.view_profile') }}</a>
        </div>
        <div class="wt-dashboardboxcontent wt-dashboardholder wt-offersmessages" style="background: white;">
            <ul v-if="users">
                <li>
                    <div class="wt-verticalscrollbar wt-dashboardscrollbar">
                        <chat-users1></chat-users1>
                    </div>
                </li>
                <li>
                    <chat-area :empty_error="$trans('lang.empty_field')" :chat_host="this.host" :chat_port="this.port"></chat-area>
                </li>
            </ul>
            <div class="wt-chatarea wt-chatarea-empty" v-else>
                <figure class="wt-chatemptyimg">
                    <img :src="no_record_img" alt="img description">
                    <figcaption><h3>{{ $trans('lang.no_chat_message') }}</h3></figcaption>
                </figure>
            </div>
        </div>
    </div>
</template>
<script>
import Event from '../event.js';
    export default{
        props:['no_msg', 'empty_field', 'host', 'port'],
        data() {
            return {
                users: true,
                url:APP_URL,
                no_record_img: APP_ASSET_URL+'/images/message-img.png',
                chat_users:[],
                id:'',
                user:'',
                job: this.chat,
            }
        },
        props: {
            chat: String 
        },
        methods: {
            getUsers(){
                let self = this;
                axios.get(APP_URL + '/message-center-job/' + self.job)
                .then(function (response) {
                    if (response.data.type == 'error') {
                        self.users = false;
                        self.emitter.emit('chat-users', { users:self.chat_users });
                    } else {
                        self.emitter.emit('chat-users', { users:response.data });
                    }
                });

            },
        },
        mounted() {
            
            this.emitter.on('active-user', (data) => {
                //console.log(this.id, data.id, data.user);
                this.id = data.id;
                this.user = data.user;
            })
        },
        created: function () {
            this.getUsers();
        }
    }
</script>
