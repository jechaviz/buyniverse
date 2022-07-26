<template>
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle wt-titlewithsearch">
            <h2>Manage Tasks</h2> 
            <div class="wt-rightarea">
                <button @click="newTask" class="wt-btn">Add Task</button>
            </div>
        </div>
        <div class="wt-dashboardboxcontent wt-categoriescontentholder">
            <table class="wt-tablecategories">
                <thead>
                    <tr>
                        <th>Task</th> 
                        
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    <tr v-for="task in tasks" :key="task.id" :style="task.status ? style='background-color: #dedede;' : ''">
                        <td data-th="title" style="width: 80%;">
                            <span class="bt-content">{{ task.title }}</span>
                        </td>
                        <td data-th="Action">
                            <span class="bt-content">
                                <div class="wt-actionbtn" v-show="!task.status">
                                    <a  @click="markTask(task.id)" class="wt-viewinfo">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a @click="editTask(task)" class="wt-addinfo wt-skillsaddinfo">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="javascript:void()"  @click="deleteTask(task.id)" class="wt-deleteinfo wt-skillsaddinfo">
                                        <i class="fa fa-trash"></i>
                                    </a> 
                                    
                                </div>
                            </span>
                        </td>
                    </tr>         
                </tbody>
            </table> 
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addnew" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">Add New Task</h5>
                <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">Update Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? UpdateTask() : CreateTask ()">
            <div class="modal-body">
                <div class="form-group">
                    <label>Title</label>
                    <input v-model="form.title" type="text" name="title"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                    
                </div>
                <input type="hidden" name="job_id" v-model="form.job_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" v-show="editmode" class="btn btn-success">Update</button>
                <button type="submit" v-show="!editmode" class="btn btn-primary">Create</button>
            </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        editmode : false,

        tasks : {},        
        form : new Form({
            id: '',
            title : '',
            job_id : this.jobid,
            status: '',
        })
    }
  },
  props: {
      jobid: String 
  },
  methods: {
        markTask(id)
        {
            axios.get(APP_URL + '/api/tasks/status/' + id).then(function (response) {
                Fire.$emit('AfterCreate');
            });
        },
        UpdateTask()
        {
            this.form.put('/api/tasks/'+ this.form.id)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Task Updated successfully'
                });
                Fire.$emit('AfterCreate');
                $('#addnew').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
        },
        newTask() 
        {
            this.editmode = false;
            this.form.reset();
            $('#addnew').modal('show');   
            $('#addnew').addClass('show');
        },
        editTask(task) 
        {
            this.editmode = true;
            this.form.reset();
            $('#addnew').modal('show');  
            $('.modal').addClass('show in'); 
            this.form.fill(task);
        },
        deleteTask(id)
        {
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) 
            {
                //server request
                this.form.delete(APP_URL + '/api/tasks/'+id).then(() => {
                    swal.fire(
                    'Deleted!',
                    'Your Task has been deleted.',
                    'success'
                    )
                    Fire.$emit('AfterCreate');
                }).catch(() => {
                    swal("Failed", "There is something wrong.", "warning");
                })
            }
            })
        },
        loadTasks() {
            let self = this;
            axios.get(APP_URL + '/api/tasks/' + this.jobid).then(function (response) {
                self.tasks = response.data;
            });
        },
        CreateTask() {
            this.form.post('/api/tasks/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Task Created successfully'
                });
                Fire.$emit('AfterCreate');
                $('#addnew').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
            
        }       

  },
    mounted: function() {
      this.loadTasks();
      Fire.$on('AfterCreate', () => {
                this.loadTasks();
            });
  }
};
</script>