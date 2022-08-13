<template>
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle wt-titlewithsearch">
            <h2>{{ trans('lang.manage_questions') }}</h2> 
            <div class="wt-rightarea">
                <button @click="newquestion" class="wt-btn">{{ trans('lang.add_question') }}</button>
            </div>
        </div>
        <div class="wt-dashboardboxcontent wt-categoriescontentholder">
            <table class="wt-tablecategories">
                <thead>
                    <tr>
                        <th>{{ trans('lang.question') }}</th>
                        <th>{{ trans('lang.value') }}</th> 
                        
                        <th class=" float-right">{{ trans('lang.action') }}</th>
                    </tr>
                </thead> 
                <tbody>
                    <tr v-for="question in questions" :key="question.id">
                        <td data-th="title" style="width: 30%;">
                            <span class="bt-content">{{ question.question }}</span>
                        </td>
                        <td data-th="title" style="width: 30%;">
                            <span class="bt-content">{{ question.value }}</span>
                        </td>
                        <td data-th="Action">
                            <span class="bt-content">
                                <div class="float-right" style="margin-right: 20px;">
                                    <a @click="editQuestion(question)"><button class="btn">{{ trans('lang.edit') }}</button></a>
                                    <div class="dropdown">
                                        <button class="btn" style="border-left:1px solid #b4b1b1">
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <div class="dropdown-content">
                                            <a @click="viewQuestion(question)" >{{ trans('lang.view') }}</a>
                                            <a @click="deleteQuestion(question.id)">{{ trans('lang.delete') }}</a>											
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </td>
                    </tr>         
                </tbody>
            </table> 
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addnewquestion" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">{{ trans('lang.add_new_question') }}</h5>
                <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">{{ trans('lang.update_question') }}</h5>
                <button type="button" class="close" @click="Close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? UpdateQuestion() : CreateQuestion()">
            <div class="modal-body">
                <div class="form-group">
                    <label>{{ trans('lang.question') }}</label>
                    <input v-model="form.question" type="text" name="question"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('question') }">
                    
                </div>
                <div class="form-group">
                    <label>{{ trans('lang.max_value') }}</label>
                    <input v-model="form.value" type="text" name="value"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('value') }">
                </div>
                <input type="hidden" name="quiz_id" v-model="form.quiz_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" @click="Close" data-dismiss="modal">{{ trans('lang.close') }}</button>
                <button type="submit" v-show="editmode" class="btn btn-success">{{ trans('lang.update') }}</button>
                <button type="submit" v-show="!editmode" class="btn btn-primary">{{ trans('lang.create') }}</button>
            </div>
            </form>
            </div>
        </div>
        </div>

        <!--View answers -->
        <div class="modal fade" id="viewquestion" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.edit') }} {{ trans('lang.question') }}</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" @click="Close2" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                    
                    <answer :questionid ="questionid" :key="questionid"></answer>
                </div>
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
        questions : {},   
        questionid : '',     
        form : new Form({
            id: '',
            question : '',            
            value: '',
            quiz_id : this.quizid            
        })
    }
  },
  props: {
      userid: String, 
      quizid: String 
  },
  methods: {
        
        newquestion() 
        {            
            this.editmode = false;
            this.form.reset();
            $('#addnewquestion').modal('show');   
            $('#addnewquestion').addClass('show');
        },        
        CreateQuestion() {
            this.form.post('/api/question/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Question Created successfully'
                });
                Fire.$emit('AfterCreateQuestion');
                $('#addnewquestion').modal('hide');
                $('#addnewquestion').removeClass('show');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
            
        },
        Close() {
            $('#addnewquestion').modal('hide');
            $('#addnewquestion').removeClass('show');
        },
        Close2() {
            $('#viewquestion').removeClass('show');
        },
        UpdateQuestion()
        {
            this.form.put('/api/question/'+ this.form.id)
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Question Updated successfully'
                });
                Fire.$emit('AfterCreateQuestion');
                $('#addnewquestion').modal('hide');
                $('#addnewquestion').removeClass('show');
                //$('.modal-backdrop').addClass('modal');
                //$('.modal-backdrop').remove();
            })
            .catch(() => {

            })
        },
        loadQuestion() {
            let self = this;
            axios.get(APP_URL + '/api/question/' + this.quizid).then(function (response) {
                self.questions = response.data;
            });
        },
        viewQuestion(question)
        {
            //window.location.href="/answer/"+question.id;
            this.questionid = question.id;                
            $('#viewquestion').modal('show');  
            $('#viewquestion').addClass('show in');
            Fire.$emit('AfterCreateAnswer');
        },
        editQuestion(question) 
        {
            this.editmode = true;
            this.form.reset();
            $('#addnewquestion').modal('show');  
            $('#addnewquestion').addClass('show in'); 
            this.form.fill(question);
        },
        deleteQuestion(id)
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
                this.form.delete(APP_URL + '/api/question/'+id).then(() => {
                    swal.fire(
                    'Deleted!',
                    'Your Question has been deleted.',
                    'success'
                    )
                    Fire.$emit('AfterCreateQuestion');
                }).catch(() => {
                    swal("Failed", "There is something wrong.", "warning");
                })
            }
            })
        },     

  },
    mounted: function() {
        this.loadQuestion();
        Fire.$on('AfterCreateQuestion', () => {
            this.loadQuestion();
        });
    
  }
};
</script>