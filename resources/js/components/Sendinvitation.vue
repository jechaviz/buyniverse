<template>
    <span> <a @click="invite" :id="'invite_to_project-'+user_id" v-show="!flag" class="wt-btn" style="cursor: pointer;"><span>{{ trans('lang.invite') }}</span></a>
    <span :id="'invitation_sent-'+user_id" v-show="flag" style="margin-right: 20px;font-weight: bold;">{{ trans('lang.invitation_sent') }}</span></span>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        user_id : this.userid,
        flag : this.invitation
    }
  },
  props: {
      userid: String, 
      jobid: String,
      invitation: String
  },
  methods: {
        
        
        
        invite() {
            let self = this;
            console.log('invite');
            axios.get(APP_URL + '/api/sendinvitation/' + this.jobid +'-' + this.userid).then(function (response) {
                toast.fire({
                icon: 'success',
                title: 'Provider is successfully invited for the job'
                });
                self.flag = true;
            });
        },
             

  },
    mounted: function() {
        
    
  }
};
</script>