<template>
    
    <div>
        <div class="wt-dashboardboxcontent wt-jobdetailsholder" style="display:flex">
                        
            <table class="wt-tablecategories no-border" style="width: 49%;border: 2px #e0e0e0 solid;">
                <tbody v-if="job_contest.status == 'open'">
                    <tr><td style="text-align: center;font-size: 18px;font-weight: bold;color: white;background-color: #005178;">{{ trans('lang.bid_status') }}</td></tr>
                    <tr><td>{{ trans('lang.status') }} : <span v-if="your_rank == 1">{{ trans('lang.your_bid_wining') }}</span><span v-else>{{ trans('lang.your_bid_loosing') }}</span> </td></tr>
                    
                    <tr><td>
                        
                        <input type="number" id="bid" name="bid" class="form-control" :class="{ 'is-invalid': form.errors.has('bid') }" style="width: 75%;">
                        <a @click="updatebid"><button class="btn" style="float: right;">{{ trans('lang.update') }}</button></a>
                        
                        <input type="hidden" name="contest_id" v-model="form.contest_id">
                    </td></tr>
                    <tr v-if="notice"><td>{{notice}}</td></tr>
                    
                </tbody>
                <tbody v-else>
                    <tr><td style="text-align: center;font-size: 18px;font-weight: bold;color: white;background-color: #005178;">{{ trans('lang.bid_status') }}</td></tr>
                    <tr><td>{{ trans('lang.contest_is_over') }}</td></tr>
                </tbody>
            </table>
            <table class="wt-tablecategories no-border" style="width: 49%;border: 2px #e0e0e0 solid;margin-left: 30px;">
                <tbody>
                    <tr><td>{{ message }}</td></tr>
                    <tr><td>{{ trans('lang.your_position') }} :  {{ your_rank }}</td></tr>
                    <tr><td>{{ trans('lang.best_bid') }} :  {{ best_bid }}</td></tr>
                    <tr><td>{{ trans('lang.your_bid') }} :  {{ your_bid }}</td></tr>
                </tbody>
            </table>
        </div>
        <div class="wt-dashboardboxcontent wt-jobdetailsholder">

            <table class="wt-tablecategories no-border" v-if="job_contest.show_participant_to_provider == 'yes' && contest_users !== null">
                
                
                <thead class="row">
                    <th class="col-md-4">{{ trans('lang.name')}}</th>
                    <th  class="col-md-4">{{ trans('lang.nickname')}}</th>
                    <th v-if="job_contest.show_participant_to_provider == 'yes'"  class="col-md-4">{{ trans('lang.project_bid')}}</th>
                </thead>
                <tbody>
                    <tr class="row" v-for="contest_user in contest_users" :key="contest_user.id">
                        <td class="col-md-4">{{ contest_user.name }}</td>
                        <td class="col-md-4">{{ contest_user.nickname }}</td>
                        <td class="col-md-4" v-if="job_contest.show_participant_to_provider == 'yes'">{{ contest_user.bid }}</td>
                    </tr>
                </tbody>
                
                <div v-if="contest_users == null">
                    <div class="wt-emptydata-holder" style="background-color: white;">
                        <div class="wt-emptydata">
                            <div class="wt-emptydetails wt-empty-person">
                                <em>{{ trans('lang.no_record') }}</em>
                            </div>
                        </div>
                    </div>
                </div>
            </table>    
            
            
        </div>
    </div>
</template>

<script>


export default {   
 data () {
    return {
        job_contest : {},
        contest_users : {},
        your_rank : '',
        best_bid : '',
        your_bid : '',
        startdate : '',
        enddate : '',
        now : '',
        message : '',
        notice : '',
        distance : 100,
        form : new Form({
            id: '',
            bid : '',
            contest_id : this.contestid           
        }),
    }
  },
  props: {
      //option: Number,
      contestid: String
  },
  methods: {
        loadusers() {
            let self = this;
            
            axios.get(APP_URL + '/api/job_overview/getcontest/' + this.contestid).then(function (response) {
                self.job_contest = response.data.contest;
                self.your_rank = response.data.your_rank;
                self.best_bid = response.data.best_bid;
                self.your_bid = response.data.your_bid;
                self.contest_users = response.data.contest_user1;
                
                if(self.job_contest.status == 'close')
                {
                    self.message = 'Contest is over';
                    self.distance = 0;
                }
                else
                {
                    self.countDownTimer();
                    self.distance = response.data.contest.time_limit*6;
                }
                /*self.startdate = new Date( response.data.contest.start_date ).getTime();
                self.enddate = new Date( response.data.contest.end_date ).getTime();
                self.now = new Date().getTime();
                self.distance = self.startdate - self.now;
                self.distance1 = self.enddate - self.now;
                if (self.distance1 < 0)
                {
                    self.message = 'Contest is over';
                    
                }
                else if (self.distance < 0 )
                {
                    self.countdown = self.distance1;
                }
                else
                {
                    self.countdown = self.distance;
                }*/
                
            });            
        },
        updatebid() {
            let self = this;
            var bid = $('#bid').val();
            
            /*this.form.post('/job_overview/newbid/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Note Created successfully'
                });
                
            })
            .catch(() => {

            })*/
            axios.get(APP_URL + '/api/job_overview/newbid/' + bid + '-' + this.form.contest_id).then(function (response) {
                Fire.$emit('Afterupdate');
                //console.log(response.data);
                self.notice = response.data;
                /*toast.fire({
                icon: 'success',
                title: 'Note updated successfully'
                });*/
            });
        },
        countDownTimer() {
            let self = this;
            var startdate = new Date( self.job_contest.start_date ).getTime();
            var enddate = new Date( self.job_contest.end_date ).getTime();
            
            
            var x = setInterval(function() {

            
            var now = new Date().getTime();
                
            
            var distance = startdate - now;
            var distance1 = enddate - now;
            
            
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var days1 = Math.floor(distance1 / (1000 * 60 * 60 * 24));
            var hours1 = Math.floor((distance1 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes1 = Math.floor((distance1 % (1000 * 60 * 60)) / (1000 * 60));
            var seconds1 = Math.floor((distance1 % (1000 * 60)) / 1000);
                
            
            if (distance1 < 0) {
                clearInterval(x);
                self.message = 'Contest is over';
            }
            else if (distance <0) {
                self.message = "Remaining Time : " + days1 + "d " + hours1 + "h " + minutes1 + "m " + seconds1 + "s ";
            }
            else {                
                self.message = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            }
            }, 1000);
            /*let self = this;
            var x = setInterval(function() {
            if (self.distance1 < 0)
            {
                self.message = 'Contest is over';
                console.log(self.message);
            }
            else if (self.distance < 0 )
            {
                var days1 = Math.floor(self.distance1 / (1000 * 60 * 60 * 24));
                var hours1 = Math.floor((self.distance1 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes1 = Math.floor((self.distance1 % (1000 * 60 * 60)) / (1000 * 60));
                var seconds1 = Math.floor((self.distance1 % (1000 * 60)) / 1000);

                self.message = "Remaining Time : " + days1 + "d " + hours1 + "h " + minutes1 + "m " + seconds1 + "s ";
                self.distance1 = self.distance1 - 1;
                console.log(self.message, self.distance1);
            }
            else
            {
                var days = Math.floor(self.distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((self.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((self.distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((self.distance % (1000 * 60)) / 1000);
                self.message = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                self.distance--;
                console.log(self.message);
            }
            }, 1000);*/
            /*
            if(self.countdown > 0) {
                setTimeout(() => {
                    self.countdown -= 1;
                    var days = Math.floor(self.countdown / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((self.countdown % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((self.countdown % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((self.countdown % (1000 * 60)) / 1000);
                    self.message = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                    self.countDownTimer()
                }, 1000)
            }*/
        },
        /*settimer() {
            
            var x = setInterval(function() {
            
            var distance = this.distance;
            var distance1 = this.distance1;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var days1 = Math.floor(distance1 / (1000 * 60 * 60 * 24));
            var hours1 = Math.floor((distance1 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes1 = Math.floor((distance1 % (1000 * 60 * 60)) / (1000 * 60));
            var seconds1 = Math.floor((distance1 % (1000 * 60)) / 1000);
            if (distance1 < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "Contest is over";
            }
            else if (distance <0) {
                document.getElementById("demo").innerHTML = "Remaining Time : " + days1 + "d " + hours1 + "h " + minutes1 + "m " + seconds1 + "s ";
            }
            else {
                document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            }
            }, 1000);
        }*/
    },
    watch: {

            distance: {
                handler(value) {

                    if (value > 0) {
                        setTimeout(() => {
                            this.distance--;
                            axios.get(APP_URL + '/api/contest/provider_bid/' + this.contestid).then(function (response) {
                                //console.log(response.data, response.data == true);
                                if(response.data == true)
                                {
                                    toast.fire({
                                        icon: 'success',
                                        title: 'New Bid is added'
                                    });
                                    Fire.$emit('Afterupdate');
                                    $(".no-border").addClass("highlighted");
                                    setTimeout(
                                        function() { 
                                            $(".no-border").removeClass('highlighted'); 
                                        },
                                        5000
                                    );
                                }
                                    
                            });
                        }, 20000);
                    }
                },
                immediate: true // This ensures the watcher is triggered upon creation
            }

        },    
    mounted: function() {
        this.loadusers();
        //this.countDownTimer();
        Fire.$on('Afterupdate', () => {
            this.loadusers();
            
        });
  }
};
</script>