<template>
    <!--checklist-->
        <div class="card-checklist" id="card-checklist">
            <div class="x-heading clearfix">
                <span class="pull-left"><i class="mdi mdi-checkbox-marked"></i>{{ $trans('lang.checklist') }}</span>
                <span class="pull-right p-t-5" id="card-checklist-progress">0/0</span>
            </div>
            <div class="progress" id="card-checklist-progress-container"><div class="progress-bar bg-success h-px-6 w-0" role="progressbar"></div></div>
            <div class="x-content" id="card-checklists-container"><!--each checklist-->

            <div class="checklist-item" id="task_checklist_container_3" v-for="checklist in checklists" :key="checklist.id" :style="checklist.status ? style='background-color: #dedede;' : ''">
                <input type="checkbox" class="filled-in chk-col-light-blue js-ajax-ux-request-default" @change="markTask(checklist.id)"  name="card_checklist" id="task_checklist_3" :checked="checklist.checked">                
                <label class="checklist-label" for="task_checklist_3"></label>
                <span class="checklist-text js-card-checklist-toggle">{{ checklist.title }}</span>
                <!--delete action-->
                    <a class="x-action-delete" @click="deleteChecklist(checklist.id)"><i class="fa fa-trash text-danger"></i></a>
            </div>

        <!--each checklist-->

        </div>
            <div class="x-action">
                <a href="javascript:void(0)" class="js-card-checklist-toggle" id="card-checklist-add-new" @click="newchecklist">{{ $trans('lang.create_new_item') }}</a>
            </div>
            <form @submit.prevent="CreateItem()">
            <div id="element-checklist-text" class="hidden copied-checklist-text" style="">
                <textarea class="form-control form-control-sm checklist_text" v-model="form.title" rows="3" name="title" id="checklist_text" spellcheck="false"></textarea>
                
                <div class="text-right">
                    <button class="btn btn-default  btn-xs  js-card-checklist-toggle" @click="close">
                        {{ $trans('lang.close') }}
                    </button>
                    <button v-show="wcreate" type="submit" class="btn btn-danger btn-xs js-" id="checklist-submit-button">
                        {{ $trans('lang.add') }}
                    </button>
                    <button v-show="!wcreate" class="btn btn-danger btn-xs js-" id="checklist-submit-button">
                        {{ $trans('lang.please_wait') }}
                    </button>
                    
                </div>
            </div>
            </form>
    
    </div>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        editmode : false,        
        checklists : {},
        form : new Form({
            id: '',
            title : '',
            task_id : this.taskid,          
        }),
        wcreate: true


        
    }
  },
  props: {
      taskid : String 
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
        markTask(id)
        {
            let self = this; 
            this.saving('Saving Details');
            axios.get(APP_URL + '/api/checklist/status/' + id).then(function (response) {
                self.emitter.emit('Aftermark');
            });
        },
        newchecklist() {
            $('#card-checklist-add-new').addClass('hidden');
            $('#element-checklist-text').removeClass('hidden');
        },
        close() {
            $('#card-checklist-add-new').removeClass('hidden');
            $('#element-checklist-text').addClass('hidden');
        },
        deleteChecklist(id) {
            let self = this; 
            this.saving('Deleting . . .');
            this.form.delete(APP_URL + '/api/checklist/'+id).then(() => {
                swal.fire(
                'Deleted!',
                'Your Checklist has been deleted.',
                'success'
                )
                self.emitter.emit('Aftermark');
            }).catch(() => {
                swal("Failed", "There is something wrong.", "warning");
            })
        },
        loadchecklist() {
            let self = this;
            axios.get(APP_URL + '/api/checklist/' + this.taskid).then(function (response) {
                self.checklists = response.data;
                //console.log(self.checklists);
            });
        },
        
        CreateItem() {
            let self = this; 
            this.saving('Saving Details');
            this.wcreate = false;
            this.form.task_id = this.taskid;
            //console.log(this.form);
            this.form.post('/api/checklist/')
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    text: 'Checklist Item Created successfully',
                    showConfirmButton: false,
                    timer: 3500
                });
                
                self.emitter.emit('Aftermark');
                $('#card-checklist-add-new').removeClass('hidden');
                $('#element-checklist-text').addClass('hidden');
                this.form.reset();
                this.wcreate = true;
            })
            .catch(() => {
                this.wcreate = true;
            })
            
        }

        
  },
  watch : {
      taskid (value) {
          //console.log('task id changed' + value);
          this.loadchecklist();
      }
  },
    mounted: function() {
      this.loadchecklist();
      this.emitter.on('Aftermark', () => {
                this.loadchecklist();
            });
  }
};
</script>