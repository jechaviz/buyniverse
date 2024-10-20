<template>
    <div v-if="notify">
        <div v-for="(user, index) in users" :key="index" @click="startChat(user.id)" class="wt-ad" :id="'wt-chat-'+ user.id" :class="[active_id===user.id ? 'wt-active' : '' , user.status_class]" v-if="user.chatshow == 1">
            <figure v-if="user.image"><img :src="image_path+user.image" :alt="user.image_name"></figure>
            <div class="wt-adcontent">
                <h3 v-if="user.name">{{user.name}}</h3>
                <span v-if="user.tagline">{{user.tagline}}</span>
            </div>
        </div>
    </div>
    <div v-else>
        <div v-for="(user, index) in users" :key="index" @click="startChat(user.id)" class="wt-ad" :id="'wt-chat-'+ user.id" :class="[active_id===user.id ? 'wt-active' : '']" v-if="user.chatshow == 1">
            <figure v-if="user.image"><img :src="image_path+user.image" :alt="user.image_name"></figure>
            <div class="wt-adcontent">
                <h3 v-if="user.name">{{user.name}}</h3>
                <span v-if="user.tagline">{{user.tagline}}</span>
            </div>
        </div>
    </div>
</template>
<script>
import Event from '../event.js';
    export default{
        data() {
            return {
                users: [],
                active:false,
                messages:[],
                active_id:'',
                notify:true,
                image_path:APP_ASSET_URL+'',
            }
        },
        methods: {
            getstarted() {
                if(window.location.hash != "") {
                var hashes = location.hash.split('-'); 
    
                $('a[href="' + hashes[0] + '"]').click();
                var chat = hashes[1].replace('#', '');
                //console.log(chat, 'this is the test');
                //$('#wt-chat' + chat).addClass('wt-active'); 
                //this.active_id = chat;
                var d = document.getElementById("#wt-chat-" + chat);
                //console.log(d, chat, 'this is the chat');
                this.startChat(chat); 
                //$("#wt-chat-" + chat).addClass('wt-active');
                }
            },
            startChat(id){
                this.notify = false;
                this.active_id = id;
                let self = this;
                console.log(self.image_path);
                axios.post(APP_URL + '/message-center/get-messages',{
                    sender_id : id
                })
                .then(function (response) {
                   self.messages = response.data.messages;
                   self.emitter.emit('chat-start', { user_id: id, chat:true, messages:self.messages });
                   self.emitter.emit('active-user', { user: response.data.selected, id:id});
                });
                self.messages = [];
            },
            
        },
        mounted: function () {
            
            this.emitter.on('chat-users', (data) => {
                this.users = data.users;
            })
            this.getstarted();
        },
        created() {
            
        }
    }
</script>

<style>
    .users {
        background-color: #fff;
        border-radius: 3px;
    }
</style>