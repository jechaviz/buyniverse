<template>
    <!--Comments-->
        <div class="card-comments" id="card-comments">
            <div class="x-heading"><i class="mdi mdi-message-text"></i>{{ trans('lang.comments') }}</div>
            <div class="x-content">
                <!--complete commenting form-->
        <div class="post-comment" id="post-card-comment-form">
            <!--placeholder textbox-->
            <div class="x-message-field x-message-field-placeholder m-b-10" id="card-coment-placeholder-input-container">
                <textarea class="form-control form-control-sm w-100" rows="1" @click="newcomment"  id="card-coment-placeholder-input" style="height: 60px;">{{ trans('lang.post_a_comment') }}</textarea>
            </div>
            <!--rich text editor-->
            <form @submit.prevent="Createcomment()">
            <div class="x-message-field hidden" id="card-comment-tinmyce-container">
                <!--tinymce editor-->
                <textarea class="form-control form-control-sm w-99" v-model="form.comment" rows="2" id="card-comment-tinmyce" name="comment_text" style="height: 100px;"></textarea>
                <!--close button-->
                <div class="x-button p-t-10 p-b-10 text-right">
                    <button type="button" @click="close" class="btn btn-default btn-sm" id="card-comment-close-button">
                        {{ trans('lang.close') }}
                    </button>
                    <!--submit button-->
                    <button v-show="wcreate" type="submit" class="btn btn-danger btn-sm x-submit-button" id="card-comment-post-button">
                        {{ trans('lang.post') }}
                    </button>
                    <button v-show="!wcreate" class="btn btn-danger btn-sm x-submit-button" id="card-comment-post-button">
                        {{ trans('lang.please_wait') }}
                    </button>
                </div>
            </div>
            </form>
        </div>
        <!--/#complete commenting form-->
                <!--comments-->
                <div id="card-comments-container">
            <!-- comments started -->
            <div class="display-flex flex-row comment-row" id="card_comment_9" v-for="comment in comments" :key="comment.id">
            <div class="p-2 comment-avatar">
                <img src="http://projects.terapixel.com.mx/storage/avatars/system/default_avatar.jpg" class="img-circle" alt="Sadique" width="40">
            </div>
            <div class="comment-text w-100 js-hover-actions">
                <div class="row">
                    <div class="col-sm-6 x-name">{{ comment.username }}</div>
                    <div class="col-sm-6 x-meta text-right">
                        <!--meta-->
                        <span class="x-date"><small>{{ comment.created_at | formatAgo }}</small></span>
                        <!--actions: delete-->
                                        <span class="comment-actions"> |
                            <a class="js-delete-ux-confirm confirm-action-danger text-danger" style="cursor: pointer;" @click="deleteComment(comment.id)" >
                                <small>{{ trans('lang.delete') }}</small>
                            </a>
                        </span>
                                    </div>
                </div>
                <div class="p-t-4">{{ comment.comment }}</div>
            </div>
        </div>
        <!-- comments end -->
        
        
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
        comments : {},
        form : new Form({
            id: '',
            comment : '',
            task_id : this.taskid,  
            user_id : this.userid        
        }),
        wcreate: true


        
    }
  },
  props: {
      taskid : String,
      userid : String 
  },
  methods: {
        
        newcomment() {
            $('#card-coment-placeholder-input-container').addClass('hidden');
            $('#card-comment-tinmyce-container').removeClass('hidden');
        },
        close() {
            $('#card-coment-placeholder-input-container').removeClass('hidden');
            $('#card-comment-tinmyce-container').addClass('hidden');
        },
        deleteComment(id) {
            this.form.delete(APP_URL + '/api/comments/'+id).then(() => {
                swal.fire(
                'Deleted!',
                'Your Comment has been deleted.',
                'success'
                )
                Fire.$emit('Aftercomment');
            }).catch(() => {
                swal("Failed", "There is something wrong.", "warning");
            })
        },
        loadcomments() {
            let self = this;
            axios.get(APP_URL + '/api/comments/' + this.taskid).then(function (response) {
                self.comments = response.data;
                //console.log(self.checklists);
            });
        },
        
        Createcomment() {
            this.wcreate = false;
            this.form.task_id = this.taskid;
            this.form.user_id = this.userid;
            //console.log(this.form);
            this.form.post('/api/comments/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Comment Added successfully'
                });
                Fire.$emit('Aftercomment');
                $('#card-coment-placeholder-input-container').removeClass('hidden');
                $('#card-comment-tinmyce-container').addClass('hidden');
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
          this.loadcomments();
      }
  },
    mounted: function() {
      this.loadcomments();
      Fire.$on('Aftercomment', () => {
                this.loadcomments();
            });
  }
};
</script>