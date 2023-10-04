<template>    
    <div>        
        <h2  v-show="!showform"> {{ title }} <i @click="edittitle" v-show="canedit" class="fa fa-pencil" style="float:right;margin: 10px;font-size: 16px;font-weight: 100;"></i></h2>
        <form @submit.prevent="UpdateTitle()" enctype="multipart/form-data"  v-show="showform">
            <div id="title" v-show="showform">            
                <input type="text" class="form-control form-control-sm " name="title" autocomplete="off"  v-model="form.title">
            </div>
            <button type="button" class="btn btn-danget" @click="cancelled">{{ trans('lang.cancel') }}</button>
            <button type="submit" class="btn btn-success">{{ trans('lang.btn_submit') }}</button>
        </form>
    </div>
</template>

<script>
export default {   
 data () {
    return {
        //job_files : {},
        form : new Form({
            id: '',
            title : '',
            job_id : this.jobid                     
        }),
        showform : false,
        canedit: false,
        title: ''
        
    }
  },
  props: {
      //option: Number,
      jobid: String,
  },
  methods: {
        loadtitle() {
            let self = this;            
            axios.get(APP_URL + '/api/jobtitle/' + this.jobid).then(function (response) {
                self.form.title = response.data.title;
                self.title = response.data.title;
                self.canedit = response.data.canedit;
            });
        },
        edittitle() {
            let self = this;
            self.showform = true;
            
        },
        cancelled() {
            let self = this;
            self.showform = false;
        },
        UpdateTitle() {
            let self = this;
            this.form.post('/api/postjobtitle/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Job Title updated successfully'
                });
                self.showform = false;
                Fire.$emit('AfterTitle');
            })
            .catch(() => {

            })   
        }
        
            

  },
    mounted: function() {
        this.loadtitle();
        Fire.$on('AfterTitle', () => {
            this.loadtitle();
        });
  }
};
</script>