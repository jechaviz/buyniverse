<template>
    <div class="wt-haslayout wt-main-section">
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                            <aside id="wt-sidebar" class="wt-sidebar wt-usersidebar">
                                <form class="wt-formtheme wt-formsearch" id="wt-formsearch" @submit.prevent="search_filter()">

                                
                                    <input type="hidden" value="provider" name="type">
                                    <div class="wt-widget wt-effectiveholder wt-startsearch">
                                        <div class="wt-widgettitle">
                                            <h2>{{ $trans('lang.start_search') }}</h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input type="text" name="s" class="form-control" :placeholder="$trans('lang.ph_search_provider')" :value="form.s" @keyup="search_text">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>{{ $trans('lang.categories') }}</h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <fieldset>                                                
                                                <div>
                                                    <div class="wt-checkboxholder wt-verticalscrollbar" style="overflow: auto;">
                                                        <span v-for="(category, index) in categories" :key="index" class="wt-checkbox">
                                                            <input :id="'category-' + index " type="checkbox" name="categories[]" :value="index" v-model="form.category" @change="search_skill">
                                                            <label :for="'category-' + index">{{ category }}</label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>{{ $trans('lang.skills') }}</h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <fieldset>                                                
                                                <div>
                                                    <div class="wt-checkboxholder wt-verticalscrollbar" style="overflow: auto;">
                                                        <span v-for="(skill, index) in skills" :key="index" class="wt-checkbox">
                                                            <input :id="'skill-' + index " type="checkbox" name="skills[]" :value="index" v-model="form.skill" @change="search_skill">
                                                            <label :for="'skill-' + index">{{ skill }}</label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </form>
                            </aside>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingholder wt-userlisting wt-haslayout">
                                <div class="wt-userlistingtitle">
                                    <span v-if="users.length > 0">{{fusers.length}} of {{users.length}} results <span v-if="keyword">for <em>"{{keyword}}"</em></span></span>
                                </div>
                                <div v-if="users.length > 0">
                                    <div v-for="(provider, key) in users" :key="key" >
                                        <div :class="'wt-userlistinghold ' + provider.feature_class" style="margin-top: 10px;">
                                            
                                            <figure class="wt-userlistingimg">
                                                <img :src="appurl+provider.image" :alt="$trans('lang.img')">
                                            </figure>
                                            <div class="wt-userlistingcontent">
                                                <div class="wt-contenthead">
                                                    <div class="wt-title">
                                                        <a @click="gotourl('profile/' + provider.slug + '/provider')" style="font-size: 18px;">
                                                            
                                                                <i v-if="provider.verified_user" class="fa fa-check-circle"></i>
                                                            
                                                            {{provider.username}}
                                                        </a>
                                                        
                                                            <p v-if="provider.tagline" style="font-size: 14px!important;"><a @click="gotourl('profile/' + provider.slug + '/provider')">{{ provider.tagline }}</a></p>
                                                        
                                                    </div>
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        
                                                            <li v-if="provider.hourly_rate"><span><i class="far fa-money-bill-alt"></i>
                                                                <span>{{provider.symbol.code}}</span>{{ provider.hourly_rate }} {{ $trans('lang.per_hour') }}</span>
                                                            </li>
                                                        
                                                        
                                                            <li v-if="provider.location"><span><img :src="appurl1+provider.flag" alt="Flag"> {{ provider.location_title }}</span></li>
                                                        
                                                        
                                                            
                                                        
                                                    </ul>
                                                </div>
                                                <div class="wt-rightarea">
                                                    <span class="wt-stars"><span :style="'width: ' + provider.stars + '%;'"></span></span>
                                                    <span class="wt-starcontent">
                                                        {{ provider.average_rating_count }}<sub>{{ $trans('lang.5') }}</sub> <em>({{ provider.feedbacks }} {{ $trans('lang.feedbacks') }})</em>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                                <div class="wt-description" v-if="provider.description">
                                                    <p v-html="provider.description"></p>
                                                </div>
                                            
                                            <div class="wt-tag wt-widgettag">
                                                    <a v-for="(skill, key1) in provider.categories" :key="key1" v-if="skill.name">{{ skill.name }}</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="wt-emptydata-holder" style="background-color: white;">
                                    <div class="wt-emptydata">
                                        <div class="wt-emptydetails wt-empty-person">
                                        <img :src="'/images/empty-images/no-record.png'">
                                            <em>{{ $trans('lang.no_record') }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
export default {
    
    data () {
        return {
            
            form : new Form({
                id: '',
                s : '',
                description : '',
                skill: [],
                category: [],
                //user_id : this.userid,
                //job_id : this.job           
            }),
            skills: [],
            categories: [],
            users: {},
            fusers: {},
            keyword: '',
            appurl: APP_ASSET_URL+"/",
            appurl1: APP_ASSET_URL+""

        
        }
    },
    /*computed: {
        filteredusers() {
            let self = this;
            self.fusers = this.users.filter(x => x.invitation === false); // text or user, whichever field is for username
        },
    },*/
    methods: {
        updatefuser() {
            let self = this;
            //self.fusers = this.users.filter(x => x.invitation === false);
            self.fusers = this.users;
        },
        search_skill(e) {
            //console.log(e.target.value);
            this.search_filter();
        },
        search_text(e) {
            //console.log(e.target.value);
            let self = this;
            self.form.s = e.target.value;
            this.search_filter();
        },
        loadSearch() {
            let self = this;            
            axios.get(APP_URL + '/api/get_provider_search').then(function (response) {
                self.skills = response.data.skills;
                self.categories = response.data.categories;
                self.users = response.data.users.data;
                self.keyword = response.data.keyword;
                //self.fusers = response.data.users.data;
                //console.log(self.users);
                self.emitter.emit('UpdatefUsers');
            });
        },
        search_filter()
        {
            let self = this;
            self.users = {};
            this.form.post('/api/search_provider_filter/')
            .then((response) => {
                self.skills = response.data.skills;
                self.categories = response.data.categories;
                self.users = response.data.users.data;
                self.keyword = response.data.keyword;

                //search
                self.form.skill = response.data.skill;
                self.form.category = response.data.category;

                self.emitter.emit('UpdatefUsers');
            })
            .catch(() => {

            })
        },
        gotourl(url)
        {
            window.location.href=url;
        }
    },
    mounted: function() { 
        this.loadSearch();
        this.emitter.on('UpdatefUsers', () => {
            this.updatefuser();
        });
  }
}
</script>
