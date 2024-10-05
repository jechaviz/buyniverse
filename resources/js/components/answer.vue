<template>
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle wt-titlewithsearch">
            <h2>{{ $trans('lang.manage_answers') }}</h2> 
            <div class="wt-rightarea">
                <button @click="newanswer" class="wt-btn">{{ $trans('lang.add_answer') }}</button>
            </div>
        </div>
        <div class="wt-dashboardboxcontent wt-categoriescontentholder">
            <table class="wt-tablecategories">
                <thead>
                    <tr>
                        <th>{{ $trans('lang.answer') }}</th>
                        <th>{{ $trans('lang.value') }}</th> 
                        
                        <th class=" float-right">{{ $trans('lang.action') }}</th>
                    </tr>
                </thead> 
                <tbody>
                    <tr v-for="answer in answers" :key="answer.id">
                        <td data-th="title" style="width: 30%;">
                            <span class="bt-content">{{ answer.answer }}</span>
                        </td>
                        <td data-th="title" style="width: 30%;">
                            <span class="bt-content">{{ answer.value }}</span>
                        </td>
                        <td data-th="Action">
                            <span class="bt-content">
                                <div class="float-right" style="margin-right: 20px;">                                    
                                    <a @click="editAnswer(answer)"><button class="btn">{{ $trans('lang.edit') }}</button></a>
                                    <div class="dropdown">
                                        <button class="btn" style="border-left:1px solid #b4b1b1">
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <div class="dropdown-content">
                                            <a @click="deleteAnswer(answer.id)">{{ $trans('lang.delete') }}</a>											
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
        <div class="modal fade" id="addnewAnswer" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">{{ $trans('lang.add_new_answer') }}</h5>
                <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">{{ $trans('lang.update_answer') }}</h5>
                <button type="button" class="close" @click="Close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? UpdateAnswer() : CreateAnswer()">
            <div class="modal-body">
                <div class="form-group">
                    <label>{{ $trans('lang.answer') }}</label>
                    <input v-model="form.answer" type="text" name="answer"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('answer') }">
                    
                </div>
                <div class="form-group">
                    <label>{{ $trans('lang.max_value') }}</label>
                    <input v-model="form.value" type="text" name="value"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('value') }">
                </div>
                <input type="hidden" name="question_id" v-model="form.question_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" @click="Close" data-dismiss="modal">{{ $trans('lang.close') }}</button>
                <button type="submit" v-show="editmode" class="btn btn-success">{{ $trans('lang.update') }}</button>
                <button type="submit" v-show="!editmode" class="btn btn-primary">{{ $trans('lang.create') }}</button>
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
        answers : {},        
        form : new Form({
            id: '',
            answer : '',
            value: '',
            question_id : this.questionid            
        })
    }
  },
  props: {      
      questionid: String 
  },
  methods: {
        
        newanswer() 
        {            
            this.editmode = false;
            this.form.reset();
            $('#addnewAnswer').modal('show');   
            $('#addnewAnswer').addClass('show');
        },        
        CreateAnswer() {
            let self = this; 
            this.form.post('/api/answer/')
            .then(() => {
                
                Swal.fire({
                    icon: 'success',
                    text: 'Answer Created successfully',
                    showConfirmButton: false,
                    timer: 3500
                });
                self.emitter.emit('AfterCreateAnswer');
                $('#addnewAnswer').modal('hide');
                //$('.modal-backdrop').addClass('modal');
                //$('.modal-backdrop').remove();
            })
            .catch(() => {

            })
            
        },
        Close() {
            $('#addnewAnswer').modal('hide');
            $('#addnewAnswer').removeClass('show');
        },
        UpdateAnswer()
        {
            let self = this; 
            this.form.put('/api/answer/'+ this.form.id)
            .then(() => {
                
                Swal.fire({
                    icon: 'success',
                    text: 'Answer Updated successfully',
                    showConfirmButton: false,
                    timer: 3500
                });
                self.emitter.emit('AfterCreateAnswer');
                $('#addnewAnswer').modal('hide');
                //$('.modal-backdrop').addClass('modal');
                //$('.modal-backdrop').remove();
            })
            .catch(() => {

            })
        },
        loadAnswer() {
            let self = this;
            axios.get(APP_URL + '/api/answer/' + this.questionid).then(function (response) {
                self.answers = response.data;
            });
        },        
        editAnswer(answer) 
        {
            this.editmode = true;
            this.form.reset();
            $('#addnewAnswer').modal('show');  
            $('#addnewAnswer').addClass('show in'); 
            this.form.fill(answer);
        },
        deleteAnswer(id)
        {
            let self = this; 
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
                this.form.delete(APP_URL + '/api/answer/'+id).then(() => {
                    swal.fire(
                    'Deleted!',
                    'Your Answer has been deleted.',
                    'success'
                    )
                    self.emitter.emit('AfterCreateAnswer');
                }).catch(() => {
                    swal("Failed", "There is something wrong.", "warning");
                })
            }
            })
        },     

  },
    mounted: function() {
        this.loadAnswer();
        this.emitter.on('AfterCreateAnswer', () => {
            this.loadAnswer();
        });
    
  }
};
</script>