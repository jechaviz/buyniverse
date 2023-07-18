<template>
    
    <div>
        
        <div class="btn" style="margin: 24px;float: right;border: none!important;background-color: #ffffff00;margin-top: -71px;"><button @click="newfile" class="wt-btn"> {{ trans('lang.add_files') }}</button></div>
        
        <table class="wt-tablecategories" v-if="job_files.length > 0">
            
            <thead>
                <tr>
                    <th>
                        {{ trans('lang.id') }}
                    </th>
                    
                    <th>{{ trans('lang.file_name') }}</th>
                    <th>{{ trans('lang.size') }}</th>
                    <th>{{ trans('lang.use') }}</th>
                    <th>{{ trans('lang.added_by') }}</th>
                    <th>{{ trans('lang.status') }}</th>
                    <th>{{ trans('lang.last_acivity') }}</th>
                    <th>{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file in job_files" :key="file.id">
                    <td>{{ file.id }}</td>
                    <td>{{ file.name }}</td>
                    <td>{{ file.size }}</td>
                    <td v-if="file.use == 'normal'">
                        {{ trans('lang.normal') }}
                    </td>
                    <td v-else>
                        {{ trans('lang.contract') }}
                    </td>
                    <td>{{ file.user_id }}</td>
                    <td>{{ file.status }}</td>
                    <td>{{ file.updated_at | formatDate }}</td>
                    <td data-th="Action">
                        <span class="bt-content"> 
                            <div class="">
                            <a @click="getDownload(file)"><button class="btn">{{ trans('lang.download') }}</button></a>
                            <div class="dropdown">
                                <button class="btn" style="border-left:1px solid #b4b1b1">
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a @click="deletefile(file.id)">{{ trans('lang.delete') }}</a>											
                                </div>
                            </div>
                                <!--<a class="wt-addinfo wt-skillsaddinfo" @click="getDownload(file)"><i class="fas fa-eye"></i></a>
                                <a href="javascript:void(0);" class="wt-deleteinfo"><i class="fa fa-times"></i></a>-->
                            </div>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="!job_files.length > 0">
            <div class="wt-emptydata-holder" style="background-color: white;">
                <div class="wt-emptydata">
                    <div class="wt-emptydetails wt-empty-person">
                        <em>{{ trans('lang.no_record') }}</em>
                    </div>
                </div>
            </div>
        </div>
        
        <form @submit.prevent="CreateFile()" enctype="multipart/form-data">
        <div class="modal fade" id="newfile" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.add_new_file') }}</h5>
                    
                    <button type="button" class="close" @click="Close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <div class="form-group form-group-label">
                        <div class="wt-labelgroup">
                            <label for="files">
                                <span class="wt-btn">{{ trans('lang.select_files') }}</span> {{filename}}
                            </label>
                            <input v-on:change="onFileChange" id="files" type="file" style="display:none;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-group-holder">
                            <span class="wt-select">
                                <select id="use" class="job-skills" v-model="form.use">
                                    <option value="normal">{{ trans('lang.normal') }}</option>
                                    <option value="contract">{{ trans('lang.contract') }}</option>                                    
                                </select>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" v-model="form.user_id">
                    <input type="hidden" name="job_id" v-model="form.job_id">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="Close" data-dismiss="modal">{{ trans('lang.close') }}</button>
                    
                    <button  v-show="wcreate" type="submit" class="btn btn-primary">{{ trans('lang.create') }}</button>
                    <button  v-show="!wcreate" class="btn btn-primary">{{ trans('lang.please_wait') }}</button>

                </div>
                
                </div>
            </div>
        </div>
        </form>
    </div>
</template>

<script>

import vueDropzone from "vue2-dropzone";
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        job_files : {},
        form : new Form({
            id: '',
            files : '',
            use : 'normal',
            user_id : this.userid,
            job_id : this.jobid                     
        }),
        role : '',
        filename : '',
        wcreate: true
        
    }
  },
  props: {
      //option: Number,
      jobid: String,
      userid: String
  },
  methods: {
        newfile() 
        {            
            this.editmode = false;
            this.form.reset();
            $('#newfile').modal('show');   
            $('#newfile').addClass('show');
        },
        onFileChange(e){
            let self = this;
            self.filename = e.target.files[0].name;
            this.form.files = e.target.files[0];
            //this.form.append('files', e.target.files[0])
        },
        loadFiles() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_file/' + this.jobid).then(function (response) {
                self.job_files = response.data;
            });            
        },
        loadRole() {
            let self = this;            
            axios.get(APP_URL + '/api/user/role/' + this.userid).then(function (response) {
                self.role = response.data;
            });
        },
        getDownload(file) {
            //console.log(file);
            /*axios.get(APP_URL + '/api/job_file/download/' + file.id).then(function (response) {
                
            });*/
            axios({
                url: APP_URL + '/api/job_file/download/' + file.id,
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement('a');

                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', file.file_id);
                    document.body.appendChild(fileLink);

                    fileLink.click();
            });
        },
        Close() {
            $('#newfile').removeClass('show');
            $('#newfile').modal('hide');
        },
        deletefile(id)
        {
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            //console.log(result.value);
            if (result.value == true) 
            {
                //server request
                console.log('delete is confirmed');
                this.form.delete(APP_URL + '/api/job_file/'+id).then(() => {
                    swal.fire(
                    'Deleted!',
                    'Your File has been deleted.',
                    'success'
                    )
                    Fire.$emit('AfterCreate');
                }).catch(() => {
                    swal("Failed", "There is something wrong.", "warning");
                })
            }
            })
        },
        CreateFile() {
            console.log(this.form);
            this.wcreate = false;
            /*this.form.post('/api/job_file/', {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            })*/
            let formData = new FormData();

            formData.append("files", this.form.files);
            formData.append("use", this.form.use);
            formData.append("user_id", this.form.user_id);
            formData.append("job_id", this.form.job_id);

            axios.post(APP_URL + '/api/job_file', formData)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'File Created successfully'
                });
                Fire.$emit('AfterCreate');
                $('#newfile').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
                this.wcreate = true;
            })
            .catch(() => {
                this.wcreate = true;
            })
        }
        
            

  },
    mounted: function() {
        this.loadRole();
        this.loadFiles();
        Fire.$on('AfterCreate', () => {
            this.loadFiles();
            this.Close();
        });
  }
};
</script>