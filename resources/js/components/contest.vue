<template>
    <div class="wt-dashboardboxcontent wt-jobdetailsholder">
        <table class="wt-tablecategories no-border">
            <thead>
                <tr>{{ trans('lang.timer') }} : <span v-if="contest.status == 'close'">Contest is Over</span><span v-else-if="contest.result">Contest will begin shortly</span><span v-else>{{ distance*10 }}</span></tr>
                <tr>
                    <th>{{ trans('lang.name') }}</th> 
                    <th>{{ trans('lang.bid_amount') }}</th>
                    <th>{{ trans('lang.original_bid') }}</th>
                    
                </tr>
            </thead> 
            <tbody>
                <tr v-for="value in contest.participants" :key="value.id">
                    <td>
                        <span class="bt-content">
                            {{ value.name }} <br> <span  style="font-size: 12px;">{{ value.tagline }}</span>
                        </span>
                    </td> 
                    <td>
                        <span class="bt-content">$ {{ value.proposal.amount | numFormat }}</span> 
                    </td>
                    <td>
                        <span class="bt-content">$ {{ value.proposal.original | numFormat }}</span> 
                    </td>
                    
                </tr>
                
                
            </tbody>
        </table>
    </div>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        
        
        contest : {},
        distance : 100      
        
    }
  },
  props: {
      contestid: Number 
  },
  methods: {
        /*countDownTimer() {
            if(self.distance > 0) {
                setTimeout(() => {
                    self.distance -= 1;
                    //document.getElementById("countdown").innerHTML = self.distance;
                    //this.countDownTimer();
                }, 1000)
            }
        },*/
        
        loadcontest() {
            let self = this;
            axios.get(APP_URL + '/api/contest/' + this.contestid).then(function (response) {                
                self.contest = response.data;
                //console.log(self.contest.status, self.contest.status == 'close');
                if(self.contest.status == 'close')
                    self.distance = 0;
                else if(self.contest.result)
                    self.distance = 'Contest Will start Shortly';
                else
                    self.distance = response.data.time_limit*6;
                
                //console.log('contest is loaded');
                
                
                    
            });
        },

        loadcontest1(contest) {
            let self = this;
            console.log('loadcontest1 - ' + contest);
            axios.get(APP_URL + '/api/contest/' + contest).then(function (response) {                
                self.contest = response.data;
                //console.log(self.contest.status, self.contest.status == 'close');
                if(self.contest.status == 'close')
                    self.distance = 0;
                else if(self.contest.result)
                    self.distance = 'Contest Will start Shortly';
                else
                    self.distance = response.data.time_limit*6;
                
                //console.log('contest is loaded');
                
                
                    
            });
        }
           


  },
  watch: {

            distance: {
                handler(value) {

                    if (value > 0) {
                        setTimeout(() => {
                            this.distance--;
                            if(this.distance == 0)
                            {
                                axios.get(APP_URL + '/api/contest/over/' + this.contestid).then(function (response) {
                                });
                                toast.fire({
                                    icon: 'success',
                                    title: 'Contest is over'
                                });
                                Fire.$emit('Aftercontestchange');
                            }
                            axios.get(APP_URL + '/api/contest/bid/' + this.contestid).then(function (response) {
                                //console.log(response.data, response.data == true);
                                if(response.data == true)
                                {
                                    toast.fire({
                                        icon: 'success',
                                        title: 'New Bid is added'
                                    });
                                    Fire.$emit('Aftercontestchange');
                                    Fire.$emit('Aftercontestupdate');
                                    $(".no-border").addClass("highlighted");
                                    setTimeout(
                                        function() { 
                                            $(".no-border").removeClass('highlighted'); 
                                        },
                                        5000
                                    );
                                }
                                    
                            });
                        }, 10000);
                    }
                    else
                    {   
                        if(this.contest.status == 'open' && !this.contest.result)
                        {
                            axios.get(APP_URL + '/api/contest/over/' + this.contestid).then(function (response) {
                            });
                        }
                        this.distance = 'Time out';
                    }

                },
                immediate: true // This ensures the watcher is triggered upon creation
            }

        },
    mounted: function() {
      
      this.loadcontest();
      
      Fire.$on('Aftercontestchange', () => {
                this.loadcontest();
            });
        Fire.$on('Aftercontestcreate', (contest) => {
            console.log('Aftercontestcreate - ' + contest);
            this.loadcontest1(contest);
        });
  }
};
</script>

