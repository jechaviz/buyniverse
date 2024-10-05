<template>
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle wt-titlewithsearch">
            <h2>{{ $trans('lang.manage_quiz') }}</h2> 
            <div class="wt-rightarea">
                <button @click="newquiz" class="wt-btn">{{ $trans('lang.add_quiz') }}</button>
            </div>
        </div>
        <div class="wt-dashboardboxcontent wt-categoriescontentholder">
            <table class="wt-tablecategories">
                <thead>
                    <tr>
                        <th>{{ $trans('lang.quiz') }}</th> 
                        <th>{{ $trans('lang.product_price') }}</th> 
                        
                        <th class=" float-right">{{ $trans('lang.action') }}</th>
                    </tr>
                </thead> 
                <tbody>
                    <tr v-for="quiz in quizzes" :key="quiz.id">
                        <td data-th="title" style="width: 80%;">
                            <span class="bt-content" style="cursor: pointer;" @click="showquiz(quiz.id)">{{ quiz.title }}</span>
                            <div :id="'accord-' + quiz.id" class="bt-content" style="display:none;">
                                <br><br>
                                <div v-for="question in quiz.questions" :key="question.id">
                                    <div class="bt-content">
                                        Q : {{question.question}} - {{question.value}}
                                        <div v-for="(answer, index) in question.answers" :key="index">
                                            {{ index + 1 }} : {{answer.answer}} - {{answer.value}}
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                
                            </div>
                        </td>
                        <td data-th="price">
                            $ {{ quiz.price }}
                        </td>
                        <td data-th="Action">
                            <span class="bt-content">
                                <div class="float-right" style="margin-right: 20px;">
                                    <a @click="editQuiz(quiz)"><button class="btn">{{ $trans('lang.edit') }}</button></a>
                                    <div class="dropdown">
                                        <button class="btn" style="border-left:1px solid #b4b1b1">
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <div class="dropdown-content">
                                            <a @click="viewResult(quiz)" >{{ $trans('lang.results') }}</a>
                                            <a  @click="viewQuiz(quiz)" >{{ $trans('lang.view') }}</a>
                                            <a @click="buyQuiz(quiz)" v-if="quiz.admin ==1" >{{ $trans('lang.buy') }}</a>
                                            <a href="javascript:void()"  @click="deleteQuiz(quiz.id)">{{ $trans('lang.delete') }}</a>											
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
        <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">{{ $trans('lang.add_new_quiz') }}</h5>
                <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">{{ $trans('lang.update_quiz') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? UpdateQuiz() : CreateQuiz()">
            <div class="modal-body">
                <div class="form-group">
                    <label>{{ $trans('lang.title') }}</label>
                    <input v-model="form.title" type="text" name="title"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                    
                </div>
                <div class="form-group">
                    <label>{{ $trans('lang.product_price') }}</label>
                    <input v-model="form.price" type="text" name="price"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                    
                </div>
                <input type="hidden" name="user_id" v-model="form.user_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $trans('lang.close') }}</button>
                <button type="submit" v-show="editmode" class="btn btn-success">{{ $trans('lang.update') }}</button>
                <button type="submit" v-show="!editmode" class="btn btn-primary">{{ $trans('lang.create') }}</button>
            </div>
            </form>
            </div>
        </div>
        </div>

        <div class="modal fade" id="commonquiz" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $trans('lang.quiz_results') }}</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                        <table class="wt-tablecategories">
                            <thead>
                                <tr>
                                    <th>{{ $trans('lang.user_name') }}</th> 
                                    <th class="float-fight">{{ $trans('lang.results') }}</th> 
                                </tr>
                            </thead> 
                            <tbody>
                                <div v-for="mark in marks" :key="mark.id">
                                <tr style="width:100%" >
                                    <td style="width: 60%;">
                                        <span class="bt-content">{{ mark.username }}</span>
                                    </td>
                                    <td class="float-fight" style="width:40%">
                                        <span class="bt-content">{{ mark.marks }} / {{ mark.total }}</span>
                                    </td>
                                </tr> 
                                <tr style="width:100%" >
                                    <td  style="width:100%" v-html="mark.report"></td>
                                </tr>
                                </div>        
                            </tbody>
                        </table> 
                    </div>      
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
        quizzes : {},
        marks : {},
        form : new Form({
            id: '',
            title : '',
            price : '',
            user_id : this.userid            
        })
    }
  },
  props: {
      userid: String 
  },
  methods: {
        showquiz(id)
        {
            if( $('#accord-' + id).css('display') == 'none' )
                document.getElementById('accord-' + id).style.display = 'block';
            else
                document.getElementById('accord-' + id).style.display = 'none';
        },        
        newquiz() 
        {
            
            this.editmode = false;
            this.form.reset();
            $('#addnew').modal('show');   
            $('#addnew').addClass('show');
        },        
        CreateQuiz() {
            let self = this; 
            this.form.post('/api/aquiz/')
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    text: 'Quiz Created successfully',
                    showConfirmButton: false,
                    timer: 3500
                });
                
                self.emitter.emit('AfterCreate');
                $('#addnew').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
            
        },
        UpdateQuiz()
        {
            let self = this; 
            this.form.put('/api/aquiz/'+ this.form.id)
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    text: 'Quiz Updated successfully',
                    showConfirmButton: false,
                    timer: 3500
                });
                
                self.emitter.emit('AfterCreate');
                $('#addnew').modal('hide');
                $('.modal-backdrop').addClass('modal');
                $('.modal-backdrop').remove();
            })
            .catch(() => {

            })
        },
        loadQuiz() {
            let self = this;
            axios.get(APP_URL + '/api/aquiz/' + this.userid).then(function (response) {
                self.quizzes = response.data;
            });
        },
        viewQuiz(quiz)
        {
            window.location.href="/questions/"+quiz.id;
        },
        buyQuiz(quiz)
        {
            
            axios.post(APP_URL + '/user/generate-order/bacs/'+quiz.id+'/quiz')
            .then(function (response) {
                if (response.data.type == 'success') {
                    window.location.replace(APP_URL+'/user/order/bacs/'+quiz.id+'/'+response.data.order_id+'/quiz');
                } 
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        viewResult(quiz)
        {
            $('#commonquiz').modal('show');  
            $('#commonquiz').addClass('show in'); 
            let self = this;
            axios.get(APP_URL + '/api/quiz/results/' + quiz.id).then(function (response) {
                self.marks = response.data;
            });
        },
        editQuiz(quiz) 
        {
            if(quiz.user_id == this.userid)
            {
                this.editmode = true;
                this.form.reset();
                $('#addnew').modal('show');  
                $('.modal').addClass('show in'); 
                this.form.fill(quiz);
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    text: 'Quiz cannot be editted',
                    showConfirmButton: false,
                    timer: 3500
                });
                
            }
            
        },
        deleteQuiz(id)
        {
            let self = this; 
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) 
            {
                //server request
                this.form.delete(APP_URL + '/api/aquiz/'+id).then(() => {
                    swal.fire(
                    'Deleted!',
                    'Your Quiz has been deleted.',
                    'success'
                    )
                    self.emitter.emit('AfterCreate');
                }).catch(() => {
                    swal("Failed", "There is something wrong.", "warning");
                })
            }
            })
        },     

  },
    mounted: function() {
        this.loadQuiz();
        this.emitter.on('AfterCreate', () => {
            this.loadQuiz();
        });
    
  }
};
</script>