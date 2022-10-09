<template>
    <span> <a :href="'/sendinvitation/'+jobid+'-'+userid" :id="'invite_to_project-'+user_id" v-show="!flag" class="wt-btn" style="cursor: pointer;"><span>{{ trans('lang.invite') }}</span></a>
    <span :id="'invitation_sent-'+user_id" v-show="flag" style="margin-right: 20px;font-weight: bold;">{{ trans('lang.invitation_sent') }}</span></span>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        user_id : this.userid,
        flag : false
    }
  },
  props: {
      userid: String, 
      jobid: String 
  },
  methods: {
        
        
        
        invite(id) {
            let self = this;
            console.log('invite');
            axios.get(APP_URL + '/contests/invite/' + this.contestid +'-' + id).then(function (response) {
                toast.fire({
                icon: 'success',
                title: 'Provider in successfully invited for the contest'
                });
                self.flag = true;

            });
        },
             

  },
    mounted: function() {
        
    
  }
};
</script>