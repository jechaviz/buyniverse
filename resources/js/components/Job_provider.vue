<template>
    <div class="wt-haslayout wt-main-section" id="user_profile">
        <div class="wt-haslayout">
            <div>
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                            <aside id="wt-sidebar" class="wt-sidebar wt-usersidebar">
                                <form class="wt-formtheme wt-formsearch" id="wt-formsearch" @submit.prevent="search_filter()">

                                
                                    <input type="hidden" value="freelancer" name="type">
                                    <div class="wt-widget wt-effectiveholder wt-startsearch">
                                        <div class="wt-widgettitle">
                                            <h2>{{ trans('lang.start_search') }}</h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input type="text" name="s" class="form-control" :placeholder="trans('lang.ph_search_freelancer')" :value="form.s">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>{{ trans('lang.skills') }}</h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <fieldset>
                                                <div v-if="skills.length > 0">
                                                    <div class="wt-checkboxholder wt-verticalscrollbar">
                                                        
                                                            
                                                            <span v-for="(skill, index) in skills" :key="index" class="wt-checkbox">
                                                                <input :id="'skill-' + index " type="checkbox" name="skills[]" :value="skill.slug" >
                                                                <label :for="'skill-' + index">{{ skill.title }}</label>
                                                            </span>
                                                        
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgetcontent">
                                            <div class="wt-applyfilters">
                                                <span>{{ trans('lang.apply_filter') }}<br> {{ trans('lang.changes_by_you') }}</span>
                                                
                                                <button type="submit" class="btn wt-btn btn-success">{{ trans('lang.btn_apply_filters') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </aside>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingholder wt-userlisting wt-haslayout">
                                <div class="wt-userlistingtitle">
                                    <span v-if="users.length > 0">{{ trans('lang.01') }} {{users.length}} of {{users.total}} results <span v-if="keyword">for <em>"{{keyword}}"</em></span></span>
                                </div>
                                <div v-if="users.length > 0">
                                    <div v-for="(freelancer, key) in users" :key="key" >
                                    
                                        <div :class="'wt-userlistinghold ' + freelancer.feature_class">
                                            
                                            <figure class="wt-userlistingimg">
                                                <img :src="appurl+freelancer.image" :alt="trans('lang.img')">
                                            </figure>
                                            <div class="wt-userlistingcontent">
                                                <div class="wt-contenthead">
                                                    <div class="wt-title">
                                                        <a @click="gotourl('profile/' + freelancer.slug)">
                                                            
                                                                <i v-if="freelancer.verified_user" class="fa fa-check-circle"></i>
                                                            
                                                            {{freelancer.username}}
                                                        </a>
                                                        
                                                            <h2 v-if="freelancer.tagline"><a @click="gotourl('profile/' + freelancer.slug)">{{ freelancer.tagline }}}</a></h2>
                                                        
                                                    </div>
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        
                                                            <li v-if="freelancer.hourly_rate"><span><i class="far fa-money-bill-alt"></i>
                                                                <span>{{freelancer.symbol.code}}</span>{{ freelancer.hourly_rate }} {{ trans('lang.per_hour') }}</span>
                                                            </li>
                                                        
                                                        
                                                            <li v-if="freelancer.location"><span><img :src="freelancer.flag" alt="Flag"> {{ freelancer.location_title }}</span></li>
                                                        
                                                        
                                                            <li v-cloak>
                                                                <a href="javascrip:void(0);" class="wt-clicklike" :id="'freelancer-' + freelancer.id" @click.prevent="add_wishlist('freelancer-' + freelancer.id,  freelancer.id, 'saved_freelancer', trans('lang.saved'))">
                                                                    <i class="fa fa-heart"></i>
                                                                    <span class="save_text">{{ trans('lang.click_to_save') }}</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="wt-rightarea">
                                                    <span class="wt-stars"><span :style="'width: ' + freelancer.stars + '%;'"></span></span>
                                                    <span class="wt-starcontent">
                                                        {{ freelancer.average_rating_count }}<sub>{{ trans('lang.5') }}</sub> <em>({{ freelancer.feedbacks }} {{ trans('lang.feedbacks') }})</em>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                                <div class="wt-description" v-if="freelancer.description">
                                                    <p v-html="freelancer.description"></p>
                                                </div>
                                            
                                            
                                            <div class="wt-rightarea">
                                                <sendinvitation :userid="freelancer.id" :invitation="freelancer.invitation" :jobid="tjob"></sendinvitation>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="wt-emptydata-holder" style="background-color: white;">
                                    <div class="wt-emptydata">
                                        <div class="wt-emptydetails wt-empty-person">
                                        <img :src="'/images/empty-images/no-record.png'">
                                            <em>{{ trans('lang.no_record') }}</em>
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
    props: {
        proposalid: String, 
        mode: String,
        job: String
    }, 
    data () {
        return {
            proposal: this.proposalid, 
            mod: this.mode,
            form : new Form({
                id: '',
                s : '',
                description : '',
                user_id : this.userid,
                job_id : this.job           
            }),
            skills: {},
            users: {},
            keyword: '',
            tjob: this.job,
            appurl: APP_ASSET_URL+"/"

        
        }
    },
    
    methods: {
        loadSearch() {
            let self = this;            
            axios.get(APP_URL + '/api/get_search/'+ self.tjob).then(function (response) {
                self.skills = response.data.skills;
                self.users = response.data.users.data;
                self.keyword = response.data.keyword;
            });
        },
        gotourl(url)
        {
            window.location.href=url;
        }
    },
    mounted: function() { 
        this.loadSearch();
  }
}
</script>
