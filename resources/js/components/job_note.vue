<template>
    <div>
        <a @click="newnote" class="wt-btn float-right" style="margin-top: -90px;">{{ trans('lang.add_note') }}</a>
        <div class="tab-content bg-transparent">
            <div id="note-full-container" class="note-has-grid row" v-if="notes.length > 0">
                <div class="col-md-3 single-note-item all-category note-family"  v-for="note in notes" :key="note.id">
                    <div class="note-card note-card-body note-bg-green">
                        <span class="side-stick"></span>
                        <div class="note-header">
                            <h5 class="note-title text-truncate w-75 mb-0">
                                {{ note.title }}
                            </h5>
                            <div class="text-right w-25">
                                <span class="mr-1" @click="starnote(note.id)">
                                    <i class="far fa-star favourite-note font-17" v-if="note.star == 1"></i>
                                    <i class="far fa-star font-17" v-if="note.star == 0"></i>
                                </span>
                                <span class="mr-1" v-if="role == 'employer'" @click="deletenote(note.id)"><i class="far fa-trash-alt remove-note font-17"></i></span>
                            </div>
                        </div>
                        <p class="note-date font-12">{{ note.created_at | formatDate }}</p>
                        <div class="note-content">
                            <p class="note-inner-content">
                                {{ note.description }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center">
                            <!--<ul class="list-unstyled order-list m-b-0">
                                <li class="team-member team-member-sm"><figure><img src="{{{ asset(Helper::getProjectImage($user_image, $accepted_proposal->freelancer_id)) }}}" alt="{{{ trans('lang.freelancer') }}}"></figure></li>
                                <li class="team-member team-member-sm"><img class="rounded-circle" src="assets/img/users/user-6.png" alt="user" data-toggle="tooltip" title="" data-original-title="John Deo"></li>
                                <li class="team-member team-member-sm"><img class="rounded-circle" src="assets/img/users/user-3.png" alt="user" data-toggle="tooltip" title="" data-original-title="Sarah Smith"></li>
                                <li class="avatar avatar-sm"><span class="badge badge-primary">+2</span></li>
                            </ul>-->
                            <!--<div class="ml-auto">
                                <div class="category-selector btn-group">
                                    <a class="nav-link dropdown-toggle category-dropdown label-group p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                        <div class="category">
                                            <div class="category-work"></div>
                                            <div class="category-family"></div>
                                            <div class="category-important"></div>
                                            <span class="more-options text-dark"><i class="icon-options-vertical"></i></span>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right category-menu">
                                        <a class="note-work badge-group-item badge-work dropdown-item position-relative category-work" href="javascript:void(0);">
                                        <i class="far fa-dot-circle mr-2"></i>Work
                                        </a>
                                        <a class="note-family badge-group-item badge-family dropdown-item position-relative category-family" href="javascript:void(0);">
                                        <i class="far fa-dot-circle mr-2"></i> Family
                                        </a>
                                        <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important" href="javascript:void(0);">
                                        <i class="far fa-dot-circle mr-2"></i> Important
                                        </a>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!notes.length > 0">
            <div class="wt-emptydata-holder" style="background-color: white;">
                <div class="wt-emptydata">
                    <div class="wt-emptydetails wt-empty-person">
                        <em>{{ trans('lang.no_record') }}</em>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <form @submit.prevent="editmode ? UpdateNote() : CreateNote()">
        <div class="modal fade" id="newnote" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">{{ trans('lang.add_new_note') }}</h5>
                    <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">{{ trans('lang.update_note') }}</h5>
                    <button type="button" class="close" @click="Close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('lang.title') }}</label>
                        <input v-model="form.title" type="text" name="title"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('lang.description') }}</label>
                        <textarea v-model="form.description"  class="form-control" name="description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                    </div>
                    <input type="hidden" name="user_id" v-model="form.user_id">
                    <input type="hidden" name="job_id" v-model="form.job_id">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="Close" data-dismiss="modal">{{ trans('lang.close') }}</button>
                    <button type="submit" v-show="editmode" class="btn btn-success">{{ trans('lang.update') }}</button>
                    <button type="submit" v-show="!editmode" class="btn btn-primary">{{ trans('lang.create') }}</button>
                </div>
                
                </div>
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
        notes : {},
        form : new Form({
            id: '',
            title : '',
            description : '',
            user_id : this.userid,
            job_id : this.jobid           
        }),
        role : '' 
        
    }
  },
  props: {
      jobid: String,
      userid: String
  },
  methods: {
        newnote() 
        {            
            this.editmode = false;
            this.form.reset();
            $('#newnote').modal('show');   
            $('#newnote').addClass('show');
        },
        CreateNote() {
            this.form.post('/api/job_note/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Note Created successfully'
                });
                Fire.$emit('AfterCreate');
                $('#newnote').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
        },
        UpdateNote() {
        },
        starnote(id) {
            axios.get(APP_URL + '/api/job_note/star/' + id).then(function (response) {
                Fire.$emit('AfterCreate');
                toast.fire({
                icon: 'success',
                title: 'Note updated successfully'
                });
            });
        },
        deletenote(id) {
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
                this.form.delete(APP_URL + '/api/job_note/'+id).then(() => {
                    swal.fire(
                    'Deleted!',
                    'Your Note has been deleted.',
                    'success'
                    )
                    Fire.$emit('AfterCreate');
                }).catch(() => {
                    swal("Failed", "There is something wrong.", "warning");
                })
            }
            })
        },
        Close() {
            $('#newnote').removeClass('show');
        },
        loadRole() {
            let self = this;            
            axios.get(APP_URL + '/api/user/role/' + this.userid).then(function (response) {
                self.role = response.data;
            });
        },
        loadNote() {
            let self = this;
            axios.get(APP_URL + '/api/job_note/' + this.jobid).then(function (response) {
                self.notes = response.data;
            });
        }

            

  },
    mounted: function() {
        this.loadNote();
        this.loadRole();
        Fire.$on('AfterCreate', () => {
            this.loadNote();
            this.Close();
        });
    
  }
};
</script>