<template>
    <div>
        <table style="margin-top: 30px;">
          <tr>
              <td class="job-details"><b>Project Level</b></td>
              <td class="job-details" @click="project_level">{{ job.project_level}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>Status</b></td>
              <td class="job-details">{{ job.status}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>Duration</b></td>
              <td class="job-details">{{ job.duration}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>Budget</b></td>
              <td class="job-details">$ {{ job.price}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>Freelancer Type</b></td>
              <td class="job-details">{{ job.freelancer_type}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>English Level</b></td>
              <td class="job-details">{{ job.english_level}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>Project Type</b></td>
              <td class="job-details">{{ job.project_type}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>Featured</b></td>
              <td class="job-details"></td>
          </tr>
          <tr>
              <td class="job-details"><b>Code</b></td>
              <td class="job-details">{{ job.code}}</td>
          </tr>
          <tr>
              
              <td class="job-details"><b>Created At</b></td>
              <td class="job-details">{{ job.created}} </td>
          </tr>
          <tr>
              <td class="job-details"><b>Quiz</b></td>
              <td class="job-details">{{ job.quiz}}</td>
          </tr>
          <tr>
              <td class="job-details"><b>Delivery </b></td>
              <td class="job-details">
                  </td>
          </tr>
          
      </table>
    </div>
</template>

<script>

//import vueDropzone from "vue2-dropzone";
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        job : {},
        form1 : new Form({
          project_level : ''
        })
    }
  },
  props: {
      jobid: String
  },
  methods: {
        loadJob() {
            let self = this;
            axios.get(APP_URL + '/api/job_overview/' + this.jobid).then(function (response) {
                self.job = response.data[0];
                self.form1.project_level = response.data.project_level; 
                //console.log(self.job);
            });
            //console.log(self.job);
        },
        project_level() {
          console.log('project_level edited');
        }

   },
    mounted: function() {
        this.loadJob();
        //console.log(this.job);
        Fire.$on('AfterCreate', () => {
            this.loadJob();
        });
        
  }
};
</script>
<style scoped>
td {
    border-top: 1px solid #dbdbdb;
    border: 1px solid #dbdbdb;
    line-height: 2.5;
    vertical-align: top;
}
</style>