<template>
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 float-right">
    <div class="wt-dashboardbox wt-messages-holder wt-openmsg wt-conversationholder">
        <div class="wt-dashboardboxtitle wt-titlemessage">
            <div class="wt-titlemessage__content">
                <figure>
                    <img :src="image_path+conversation_users.receiver_img" >
                </figure>
                <div class="wt-titlemessage__text">
                    <p>{{conversation_users.receiver_name}}</p>
                    <span>{{conversation_users.receiver_role}}</span>
                </div>
            </div>
            <div class="wt-titlemessage__content">
                <figure>
                    <img :src="image_path+conversation_users.sender_img" >
                </figure>
                <div class="wt-titlemessage__text">
                    <p>{{conversation_users.sender_name}}</p>
                    <span>{{conversation_users.sender_role}}</span>
                </div>
            </div>
        </div>
        <div class="wt-dashboardboxcontent wt-dashboardholder wt-offersmessages">
            <ul>
                <li class="d-none"></li>
                <li class="wt-conversation">
                    <div class="wt-chatarea wt-chatboxpop">
                        <div class="wt-custom-scrollbar-wrapper wt-conversationscrollbar wt-dashboardscrollbar">
                            <div class="wt-messages messages">
                                <transition-group name="list">
                                    <div v-for="msg in messages" v-bind:key="msg.id"  :id="'conv-message-'+msg.id" :ref="'message-'+msg.id" v-bind:class="[msg.is_sender==='yes' ? 'wt-memessage' : 'wt-offerermessage', msg.read_status + ' list-item']">
                                        <figure v-if="msg.image">
                                            <img :src="image_path+msg.image" >
                                        </figure>
                                        <div class="wt-description wt-tickremove">
                                            <a href="javascript:void(0);" v-on:click="deleteMessage(msg.id)" class="wt-cross">x</a>
                                            <div class="clearfix"></div>
                                            <p v-if="msg.message" v-html="msg.message"></p>
                                            <div class="clearfix"></div>
                                            <time :datetime="msg.date">{{msg.date}}</time>
                                        </div>
                                    </div>
                                </transition-group>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            image_path:APP_ASSET_URL+"",
        }
    },
    props: ['messages', 'conversation_users'],
    mounted() {
        jQuery('.wt-conversationscrollbar').mCustomScrollbar({
            axis:"y",
            scrollbarPosition: "outside",
            autoHideScrollbar: true,
            scrollTo:'bottom',
            setTop:"9999px",
            callbacks:{
                onTotalScrollBackOffset:100,
                alwaysTriggerOffsets:false
            },
            advanced:{updateOnContentResize:true} //disable auto-updates (optional)
        });
    },
    methods:{
        getArrayIndex(array, attr, value) {
            this.json = '';
            if (array.length) {
                for (let x = 0; x < array.length; x++) {
                if (array[x] && array[x][attr]) {
                    if (array[x][attr] === value) {
                    this.json = array[x]['order'] ? array[x]['order'] : '';
                    }
                }
                }
            }
            return this.json;
        },
        deleteMessage (message_id) {
            this.$swal({
                title: 'Delete Message',
                type: "warning",
                showCancelButton: true,
                customContainerClass:'hire_popup',
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                }).then((result) => {
                    var self = this;
                    if(result.value) {
                        axios.post(APP_URL + '/admin/conversation/delete-message', {
                            id: message_id
                        })
                        .then(function (response) {
                            if (response.data.type == 'success') {
                                var index = self.getArrayIndex(self.messages, 'id', message_id)
                                self.messages.splice(index, 1)
                            } else {
                                self.showError(response.data.message);
                            }
                        })
                    } else {
                        this.$swal.close()
                    }
            })
        }
    },
}
</script>
<style>
.list-item {
  display: inline-block;
  margin-right: 10px;
}
.list-enter-active, .list-leave-active {
  transition: all 0.5s;
}
.list-enter, .list-leave-to {
  opacity: 0;
  transform: translateX(10px);
}
</style>