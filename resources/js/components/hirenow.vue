<template>
    <a @click="hire(proposal, mod)" class="wt-btn">{{ $trans('lang.hire_now') }}</a>
    
</template>

<script>
export default {
    props: {
        proposalid: String, 
        mode: String
    }, 
    data () {
        return {
            proposal: this.proposalid, 
            mod: this.mode
        
        }
    },
    
    methods: {
        hire(proposal, mode) {
            this.$swal({
                title: $trans('lang.want_to_hire'),
                type: "warning",
                customContainerClass: 'hire_popup',
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true,
                showLoaderOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    if (mode == 'false') {
                        axios.get(APP_URL + '/user/generate-order/bacs/'+proposal+'/job')
                        .then(function (response) {
                            if (response.data.type == 'success') {
                                window.location.replace(APP_URL+'/user/order/bacs/'+proposal+'/'+response.data.order_id+'/project');
                            } 
                        })
                        .catch(function (error) {
                            console.log(error);
                        });    
                    } else {
                        window.location.replace(APP_URL + '/payment-process/' + proposal);
                    }
                } else {
                    this.$swal.close()
                }
            })
        }
    },
    mounted: function() { 

  }
}
</script>
