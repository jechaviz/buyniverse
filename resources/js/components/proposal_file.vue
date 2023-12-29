<template>
    
    <div>
        <i class="fa fa-paperclip" @click="pfshowrow(form.user_id)"></i>
        <div :class="'prow-' + form.user_id" class="btn hidden" style="margin: 24px;float: right;border: none!important;background-color: #ffffff00;" v-if="add_file == 'yes'"><button type="button" @click="newfile" class="wt-btn"> {{ trans('lang.add_files') }}</button></div>
        
        <table :class="'prow-' + form.user_id" class="hidden wt-tablecategories" v-if="proposal_files.length > 0">
            
            <thead>
                <tr>
                    <th>{{ trans('lang.name') }}</th>
                    <th>{{ trans('lang.size') }}</th>
                    <th>{{ trans('lang.description') }}</th>
                    <th>{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file in proposal_files" :key="file.id">
                    
                    <td>{{ file.name }}</td>
                    <td>{{ file.size }}</td>
                    <td>{{ file.description }}</td>
                    <td data-th="Action">
                        <span class="bt-content"> 
                            <div class="">
                            <a @click="getDownload(file)"><button type="button" class="btn">{{ trans('lang.download') }}</button></a>

                            <div class="dropdown" v-if="add_file == 'yes'">
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
        <div v-if="!proposal_files.length > 0">
            <div :class="'prow-' + form.user_id" class="wt-emptydata-holder hidden" style="background-color: white;">
                <div class="wt-emptydata">
                    <div class="wt-emptydetails wt-empty-person">
                        <em>{{ trans('lang.no_record') }}</em>
                    </div>
                </div>
            </div>
        </div>
        
        <form @submit.prevent="CreateFile()" enctype="multipart/form-data" v-if="add_file == 'yes'">
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
                                <span class="wt-btn">{{ trans('lang.select_file') }}</span> {{filename}}
                            </label>
                            <input v-on:change="onFileChange" id="files" type="file" style="display:none;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-group-holder">
                            <span class="wt-input">
                                <input id="description" type="text" v-model="form.description" style="width: 100%;">
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="proposal_id" v-model="form.proposal_id">
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
        proposal_files : {},
        form : new Form({
            id: '',
            files : '',
            description : '',
            job_id : this.jobid,
            user_id : this.userid,
            
        }),
        //role : '',
        filename : '',
        wcreate: true,
        add_file: this.addfile

        
    }
  },
  props: {
      //option: Number,
      jobid: String,
      proposalid: String,
      userid: String,
      addfile: String
  },
  methods: {
        pfshowrow(id) {
            var clas = 'prow-' + id;
            console.log(clas);
            if ($('.' + clas).hasClass("hidden")) {
            $('.' + clas).removeClass('hidden');
            }
            else
            {
            $('.' + clas).addClass('hidden');
            }
        },
        newfile() 
        {            
            //this.editmode = false;
            this.form.reset();
            $('#newfile').modal('show');   
            $('#newfile').addClass('show');
        },
        onFileChange(e){
            let self = this;
            self.filename = e.target.files[0].name;
            this.form.files = e.target.files[0];
            this.form.append('files', e.target.files[0])
        },
        loadFiles() {
            let self = this;
            
            axios.get(APP_URL + '/api/proposal_file/' + this.proposalid).then(function (response) {
                self.proposal_files = response.data;
                //console.log(response.data);
            });          
        },
        /*loadRole() {
            let self = this;            
            axios.get(APP_URL + '/api/user/role/' + this.userid).then(function (response) {
                self.role = response.data;
            });
        },*/
        getDownload(file) {
            //console.log(file);
            
            axios({
                url: APP_URL + '/api/proposal_file/download/' + file.id,
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement('a');

                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', file.file);
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
                this.form.delete(APP_URL + '/api/dproposal_file/'+id).then(() => {
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
            
            let formData = new FormData();

            formData.append("files", this.form.files);
            formData.append("description", this.form.description);
            formData.append("user_id", this.form.user_id);
            formData.append("job_id", this.form.job_id);

            axios.post(APP_URL + '/api/proposal_file', formData)
            .then(() => {
                toast.fire({
                type: 'success',
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
        //this.loadRole();
        this.loadFiles();
        Fire.$on('AfterCreate', () => {
            this.loadFiles();
            this.Close();
        });
  }
};
</script>
<style>
.hidden {
    display: none;
}
.wt-emptydata {
    height: 100px;
}
</style>