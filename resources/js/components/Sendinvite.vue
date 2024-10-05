<template>
    <span> <a :href="'/contests/invite/'+contestid+'-'+userid" :id="'invite_to_contest-'+user_id" v-show="!flag" class="wt-btn" style="cursor: pointer;"><span>{{ $trans('lang.invite_to_contest') }}</span></a>
    <span :id="'invitation_sent-'+user_id" v-show="flag" style="margin-right: 20px;font-weight: bold;">{{ $trans('lang.invitation_sent') }}</span></span>
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
      contestid: String 
  },
  methods: {
        saving(message)
        {
            toast1.fire({
                type: 'info',
                title: message,
                showConfirmButton: false,
                timer: 1500
            });
        },        
        invite(id) {
            this.saving('Inviting . . .');
            let self = this;
            
            axios.get(APP_URL + '/contests/invite/' + this.contestid +'-' + id).then(function (response) {
                Swal.fire({
                    icon: 'success',
                    text: 'Provider in successfully invited for the contest',
                    showConfirmButton: false,
                    timer: 3500
                });
                
                self.flag = true;

            });
        },
             

  },
    mounted: function() {
        
    
  }
};
</script>