<template>
    <div class="wt-custom-scrollbar-wrapper wt-verticalscrollbar wt-dashboardscrollbar" id="scrollList" ref="scrollList">
        <div class="wt-messages messages">
            <!-- <small class="typing-test">
                <i>{{this.typing}} {{$trans('lang.is_typing')}}</i>
            </small> -->
            <div v-for="(msg, index) in message" :key="index" :id="msg.id" :ref="'message-'+msg.id" v-bind:class="[msg.is_sender==='yes' ? 'wt-memessage' : 'wt-offerermessage', msg.read_status]">
                <figure v-if="msg.image">
                    <img :src="image_path+msg.image" :alt="img">
                </figure>
                <div class="wt-description">
                    <div class="clearfix"></div>
                    <!-- <p v-if="msg.message">{{ msg.message }}</p> -->
                    
                    <p v-if="msg.message"><b>{{msg.name}}<br></b>{{msg.message}} </p>
                    <div class="clearfix"></div>
                    <time :datetime="msg.date">{{msg.date}}</time>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Event from '../event.js';
    export default{
        props: ['message', 'receiver_id','typing', 'img', 'message_id'],
        data() {
            return {
                messages: this.message,
                emoji_var: '',
                image_path:APP_ASSET_URL+"",
            }
        },
        methods:{

        },
        mounted() {
            jQuery('.wt-chatarea').linkify({target: "_blank"});

            jQuery('.wt-verticalscrollbar').mCustomScrollbar({
                axis:"y",
                scrollbarPosition: "outside",
                autoHideScrollbar: true,
                scrollTo:'bottom',
                setTop:"9999px",
                callbacks:{
                    //onTotalScrollBack:function(){ _add_older_messages(this) },
                    onTotalScrollBackOffset:100,
                    alwaysTriggerOffsets:false
                },
                advanced:{updateOnContentResize:false} //disable auto-updates (optional)
            });

        },
        updated () {
            jQuery('.wt-verticalscrollbar').mCustomScrollbar('scrollTo','bottom');
        },
    }
</script>
<style>
.wt-custom-scrollbar-wrapper {
  height: 652px;
}
</style>
