<template>
    <div v-if="this.openchat">
        
        <button class="chatbox-open" @click="open">
            <i class="fa fa-comment fa-2x" aria-hidden="true"></i>
            </button>
            <button class="chatbox-close" @click="close">
            <i class="fa fa-close fa-2x" aria-hidden="true"></i>
            </button>
            <section class="chatbox-popup">
            <header class="chatbox-popup__header">
            <!--<aside style="flex:3">
            <i class="fa fa-user-circle fa-4x chatbox-popup__avatar" aria-hidden="true"></i>
            </aside>-->
            <aside style="flex:8">
            {{ trans('lang.chatroom_contest') }}
            </aside>
            <!--<aside style="flex:1">
            <button class="chatbox-maximize"><i class="fa fa-window-maximize" aria-hidden="true"></i></button>
            </aside>-->
            </header>
            <div class="wt-dashboardboxcontent wt-dashboardholder wt-offersmessages" style="height: 350px!important;">
            <div class="wt-chatarea" style="height: 100%;overflow-y: scroll">
            <main class="chatbox-popup__main wt-verticalscrollbar">
              <div v-for="message in messages" :key="message.id">
                <div class="wt-offerermessage" v-if="message.user_id != userid">
                <figure>
                  <img :src="message.image">
                </figure> 
                <div class="wt-description">
                  <div class="clearfix"></div> 
                  <p style="text-align:left;">
                    <b>{{message.username}}</b><br>
                    {{message.message}}
                  </p> 
                  <div class="clearfix"></div> 
                  <time :datetime="message.created_at">{{ message.created_at | formatAgo}}</time>
                </div>
                </div>
                <div class="wt-memessage" v-if="message.user_id == userid">
                <figure>
                  <img :src="message.image">
                </figure> 
                <div class="wt-description">
                  <div class="clearfix"></div> 
                  <p style="text-align:left;">
                    <b>{{message.username}}</b><br>
                    {{message.message}}
                  </p> 
                  <div class="clearfix"></div> 
                  <time :datetime="message.created_at">{{ message.created_at | formatAgo}}</time>
                </div>
                </div>
              </div>
              <!--<div class="wt-memessage wt-readmessage">
                <figure>
                  <img src="http://localhost:8000/images/user.jpg">
                </figure> 
                <div class="wt-description">
                  <div class="clearfix"></div> 
                  <p>hello</p> 
                  <div class="clearfix"></div> 
                  <time datetime="2022-02-14 19:27:31">2022-02-14 19:27:31</time>
                </div>
              </div>-->
            
            </main>
            </div>
            </div>
            <!--<main>
            <div class="row float-right">this is the test</div>
            <div class="row">this is the test</div>
            </main>-->
            <footer class="chatbox-popup__footer">
            <!--<aside style="flex:1;color:#888;text-align:center;">
            <i class="fa fa-camera" aria-hidden="true"></i>
            </aside>-->
            <aside style="flex:10">
            <textarea type="text" v-model="form.message" placeholder="Type your message here..." autofocus></textarea>
            </aside>
            <aside @click="sendmessage" style="flex:1;color:#888;text-align:center;">
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
            </aside>
            </footer>
            </section>
            
    </div>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
      openchat : false,
      messages : {},
      chatroom_id : '',
      form : new Form({
            id: '',
            chatroom_id : '',
            message : ''
        })
    }
  },
  props: {
      jobid: String,
      userid: String
  },
  methods: {
        open() {
          $(".chatbox-popup, .chatbox-close").fadeIn();
          
        },
        close() {
          $(".chatbox-popup, .chatbox-close").fadeOut();
        },
        maximize() {
          $(".chatbox-popup, .chatbox-open, .chatbox-close").fadeOut();
          $(".chatbox-panel").fadeIn();
          $(".chatbox-panel").css({ display: "flex" });
        },
        loadchat() {
          let self = this;
          //console.log('chatroom : ' + self.chatroom_id);
          if(self.chatroom_id)
          {
              axios.get(APP_URL + '/api/contest/getmessages/' + self.chatroom_id).then(function (response) {                
              //console.log(response.data);
              self.messages = response.data;
              if(response.data)
              {
                
              }
            });
          }
            
        },
        checkcontest() {
            let self = this;
            axios.get(APP_URL + '/api/contest/check/' + self.jobid).then(function (response) {                
              if(response.data)
              {
                self.form.chatroom_id = response.data;
                self.chatroom_id = response.data;
                self.openchat = true;
              }
            });
        },
        sendmessage() {
          this.form.post('/api/contest/sendmessage')
            .then(() => {
                Fire.$emit('loadmessages');
                this.form.message = '';
            })
            .catch(() => {

            })
        }


  },
  watch: {
        chatroom_id : function () {
          this.loadchat();
        }
            

        },
    mounted: function() {
      this.checkcontest();
      this.loadchat();
      Fire.$on('loadmessages', () => {
          this.loadchat();
      });
      
  }
};
</script>

<style scoped>
h1 {
  margin: 0;
  font-size: 16px;
  line-height: 1;
}

button {
  color: inherit;
  background-color: transparent;
  border: 0;
  outline: 0 !important;
  cursor: pointer;
}
button.chatbox-open {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 52px;
  height: 52px;
  color: #fff;
  background-color: #005178;
  background-position: center center;
  background-repeat: no-repeat;
  box-shadow: 12px 15px 20px 0 rgba(46, 61, 73, 0.15);
  border: 0;
  border-radius: 50%;
  cursor: pointer;
  margin: 16px;
}
button.chatbox-close {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 52px;
  height: 52px;
  color: #fff;
  background-color: #005178;
  background-position: center center;
  background-repeat: no-repeat;
  box-shadow: 12px 15px 20px 0 rgba(46, 61, 73, 0.15);
  border: 0;
  border-radius: 50%;
  cursor: pointer;
  display: none;
  margin: 16px;
  /*margin: 16px calc(2 * 16px + 52px) 16px 16px;*/
}

textarea {
  box-sizing: border-box;
  width: 100%;
  margin: 0;
  height: calc(16px + 16px / 2);
  padding: 0 calc(16px / 2);
  font-family: inherit;
  font-size: 16px;
  line-height: calc(16px + 16px / 2);
  color: #888;
  background-color: none;
  border: 0;
  outline: 0 !important;
  resize: none;
  overflow: hidden;
}
textarea::-moz-placeholder {
  color: #888;
}
textarea:-ms-input-placeholder {
  color: #888;
}
textarea::placeholder {
  color: #888;
}

.chatbox-popup {
  display: flex;
  position: fixed;
  box-shadow: 5px 5px 25px 0 rgba(46, 61, 73, 0.2);
  flex-direction: column;
  display: none;
  bottom: calc(2 * 16px + 52px);
  right: 16px;
  width: 377px;
  max-height: 600px;
  background-color: #fff;
  border-radius: 16px;
}
.chatbox-popup .chatbox-popup__header {
  box-sizing: border-box;
  display: flex;
  width: 100%;
  padding: 16px;
  color: #fff;
  background-color: #005178;
  align-items: center;
  justify-content: space-around;
  border-top-right-radius: 12px;
  border-top-left-radius: 12px;
}
.chatbox-popup .chatbox-popup__header .chatbox-popup__avatar {
  margin-top: -32px;
  background-color: #005178;
  border: 5px solid rgba(0, 0, 0, 0.1);
  border-radius: 50%;
}
.chatbox-popup .chatbox-popup__main {
  box-sizing: border-box;
  width: 100%;
  padding: calc(2 * 16px) 16px;
  line-height: calc(16px + 16px / 2);
  color: #888;
  text-align: center;
}
.chatbox-popup .chatbox-popup__footer {
  box-sizing: border-box;
  position: initial;
  display: flex;
  width: 100%;
  padding: 16px;
  border-top: 1px solid #ddd;
  align-items: center;
  justify-content: space-around;
  border-bottom-right-radius: 12px;
  border-bottom-left-radius: 12px;
}

.chatbox-panel {
  display: flex;
  position: absolute;
  box-shadow: 5px 5px 25px 0 rgba(46, 61, 73, 0.2);
  flex-direction: column;
  display: none;
  top: 0;
  right: 0;
  bottom: 0;
  width: 377px;
  background-color: #fff;
}
.chatbox-panel .chatbox-panel__header {
  box-sizing: border-box;
  display: flex;
  width: 100%;
  padding: 16px;
  color: #fff;
  background-color: #005178;
  align-items: center;
  justify-content: space-around;
  flex: 0 0 auto;
}
.chatbox-panel .chatbox-panel__main {
  box-sizing: border-box;
  width: 100%;
  padding: calc(2 * 16px) 16px;
  line-height: calc(16px + 16px / 2);
  color: #888;
  text-align: center;
  flex: 1 1 auto;
}
.chatbox-panel .chatbox-panel__footer {
  box-sizing: border-box;
  display: flex;
  width: 100%;
  padding: 16px;
  border-top: 1px solid #ddd;
  align-items: center;
  justify-content: space-around;
  flex: 0 0 auto;
}
</style>
