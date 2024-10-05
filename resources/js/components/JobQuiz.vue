<template>
    <div class="wt-dashboardboxcontent wt-categoriescontentholder">
        <div class="btn" style="margin: 24px;float: right;border: none!important;background-color: #ffffff00;margin-top: -71px;"><button @click="newquiz" class="wt-btn"> {{ $trans('lang.add_quiz') }}</button></div>
        <table class="wt-tablecategories" id="checked-val">
            <thead>
                <tr>
                    <th>
                        <span class="wt-checkbox">
                            <input name="cats[]" id="wt-cats" @click="selectAll" type="checkbox">
                            <label for="wt-cats"></label>
                        </span>
                    </th>
                    
                    <th>{{ $trans('lang.name') }}</th>
                    <th>{{ $trans('lang.created') }}</th>
                    <th>{{ $trans('lang.product_price') }}</th>
                    <th class=" float-right">{{ $trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr  v-for="quiz in quizzes" :key="quiz.id" :class="'del-' + quiz.id">
                        <td>
                            <span class="wt-checkbox">
                                <input name="cats[]" @click="selectRecord(quiz.id)" :id="'wt-check-' + quiz.id" type="checkbox" v-if="quiz.job_quiz == 1" checked>
                                <input name="cats[]" @click="selectRecord(quiz.id)" :id="'wt-check-' + quiz.id" type="checkbox" v-if="quiz.job_quiz == 0">
                                <label :for="'wt-check-' + quiz.id"></label>
                            </span>
                        </td>
                        
                        <td>
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
                        <td>{{ quiz.username }}</td>
                        <td>
                            $ {{ quiz.price }}
                        </td>
                        <td data-th="Action">
                            <span class="bt-content">
                                <div class="float-right" style="margin-right: 20px;">
                                    <a><button @click="editQuiz(quiz)" class="btn">{{ $trans('lang.edit') }} {{ $trans('lang.name') }}</button></a>
                                    <div class="dropdown">
                                        <button class="btn" style="border-left:1px solid #b4b1b1">
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <div class="dropdown-content">
                                            <a @click="viewResult(quiz)" >{{ $trans('lang.results') }}</a>
                                            <a  @click="viewQuiz(quiz)" >{{ $trans('lang.edit') }}</a>
                                            <a  @click="buyQuiz(quiz)" v-if="quiz.admin ==1" >{{ $trans('lang.buy') }}</a>
                                            <a href="javascript:void()"  @click="deleteQuiz(quiz.id)">{{ $trans('lang.delete') }}</a>											
                                        </div>
                                    </div>

                                    
                                    
                                </div>
                            </span>
                        </td>
                    </tr>
                    
                
            </tbody>
        </table>
        <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <form @submit.prevent="editmode ? UpdateQuiz() : CreateQuiz()">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">{{ $trans('lang.add_new_quiz') }}</h5>
                <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">{{ $trans('lang.update_quiz') }}</h5>
                <button type="button" class="close" data-dismiss="modal" @click="Close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
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
                <button type="button" class="btn btn-danger" @click="Close" data-dismiss="modal">{{ $trans('lang.close') }}</button>
                <button type="submit" v-show="editmode" class="btn btn-success">{{ $trans('lang.update') }}</button>
                <button type="submit" v-show="!editmode" class="btn btn-primary">{{ $trans('lang.create') }}</button>
            </div>
            
            </div>
        </div>
        </form>
        </div>
        <div class="modal fade" id="commonquiz" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $trans('lang.quiz_results') }}</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" @click="Close1" aria-label="Close">
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

        <!--View Quiz -->
        <div class="modal fade" id="viewquiz" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $trans('lang.edit') }} {{ $trans('lang.quiz') }}</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" @click="Close2" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-show="userid">
                    <question :userid = "userid" :quizid ="userid" :key="quizid"></question>
                </div>
            </div>        
        </div>
        </div>
        
    </div>
</template>

<script>
 export default{
    
        data(){
            return {
                quizzes : {},
                marks : {},
                editmode : false,
                username : '',
                quizid : '',
                form : new Form({
                    id: '',
                    title : '',
                    price : '',
                    user_id : this.userid            
                })

            }
        },
        props: {
            userid: String,
            jobid: String
        },
        methods: {
            loadQuiz() {
                let self = this;
                axios.get(APP_URL + '/api/aquiz/' + this.jobid).then(function (response) { 
                    
                    self.quizzes = response.data;
                    //console.log(self.quizzes);
                });
            },
            showquiz(id)
            {
                if( $('#accord-' + id).css('display') == 'none' )
                    document.getElementById('accord-' + id).style.display = 'block';
                else
                    document.getElementById('accord-' + id).style.display = 'none';
            },  
            Close() {
                $('#addnew').removeClass('show');
            },
            Close1() {
                $('#commonquiz').removeClass('show');
            },
            Close2() {
                $('#viewquiz').removeClass('show');
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
                    
                    self.emitter.emit('AfterChange');
                    $('#addnew').modal('hide');
                    $('#addnew').removeClass('show');
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
                    
                    self.emitter.emit('AfterChange');
                    $('#addnew').modal('hide');
                    $('#addnew').removeClass('show');
                    $('.modal-backdrop').addClass('modal');
                    $('.modal-backdrop').remove();
                })
                .catch(() => {

                })
            },
            viewQuiz(quiz)
            {
                let self = this; 
                //window.location.href="/questions/"+quiz.id;
                this.quizid = quiz.id;
                
                $('#viewquiz').modal('show');  
                $('#viewquiz').addClass('show in');
                self.emitter.emit('AfterCreateQuestion');
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
                //console.log('show is hitted');
            },
            editQuiz(quiz) 
            {
                /*this.editmode = true;
                this.form.reset();
                $('#addnew').modal('show');  
                $('#addnew').addClass('show in'); 
                this.form.fill(quiz);*/
                if(quiz.user_id == this.userid)
                {
                    this.editmode = true;
                    this.form.reset();
                    $('#addnew').modal('show');  
                    $('#addnew').addClass('show in'); 
                    this.form.fill(quiz);
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        text: 'Quiz cannot be editted.',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    
                }
                
            },
            deleteQuiz(id)
            {
                let self = this; 
                console.log('delete initiated');
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
                    
                    this.form.delete(APP_URL + '/api/aquiz/'+id).then(() => {
                        swal.fire(
                        'Deleted!',
                        'Your Quiz has been deleted.',
                        'success'
                        )
                        self.emitter.emit('AfterChange');
                    }).catch(() => {
                        swal("Failed", "There is something wrong.", "warning");
                    })
                }
                })
            },
            selectAll () {
                let self = this; 
                var cats = document.getElementById('wt-cats').checked;

                axios.get(APP_URL + '/api/aquiz/selectall/' + this.jobid + '-' + cats).then(function (response) { 
                    
                    self.emitter.emit('AfterChange');
                    Swal.fire({
                        icon: 'success',
                        text: 'Quiz updated successfully',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    
                });

                
            },
            selectRecord (id) {
                let self = this; 
                var cats = document.getElementById('wt-check-'+ id).checked;
                axios.get(APP_URL + '/api/aquiz/selectrecord/' + this.jobid + '-' + cats + '-' + id).then(function (response) { 
                    
                    self.emitter.emit('AfterChange');
                    Swal.fire({
                        icon: 'success',
                        text: 'Quiz updated successfully',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    
                });
            },
            userName() {
                let self = this;
                axios.get(APP_URL + '/api/v1/user/' + this.userid).then(function (response) {
                //console.log(response.data);
                self.username = response.data;
            });
            }
            
        },
        mounted: function () {
            this.loadQuiz();
            this.userName();
            this.emitter.on('AfterChange', () => {
                this.loadQuiz();
            });
           
        }
    }
</script>
