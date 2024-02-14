<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="provider.sectionClass + ' wt-haslayout  wt-main-section'"
            :id="provider.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(provider).length != 0"
        >
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-8">
                        <div class="wt-sectionhead wt-textcenter">
                            <div class="wt-sectiontitle">
                                <h2 :style="{color:provider.titleColor}" >{{provider.title}}</h2>
                                <span :style="{color:provider.subtitleColor}">{{provider.subtitle}}</span>
                            </div>
                            <div class="wt-description" v-if="provider.description" v-html="provider.description"></div>
                        </div>
                    </div>
                    <div class="wt-topproviders">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 float-left" v-for="(provider, index) in topproviders" :key="index">
                            <div class="wt-provideritems">
                                <div class="wt-userlistinghold wt-featured">
                                    <div class="wt-userlistingcontent">
                                        <figure>
                                            <img :src="provider.image" alt="image">
                                            <div class="wt-userdropdown wt-away template-content tipso_style wt-tipso" data-tipso="Offline"></div>
                                        </figure>
                                        <div class="wt-contenthead">
                                            <div class="wt-title">
                                                <a :href="baseUrl+'/profile/'+provider.slug"><i class="fa fa-check-circle"></i> {{provider.name}}</a>
                                                <h2>{{provider.tagline}}</h2>
                                            </div>
                                        </div>
                                        <div class="wt-viewjobholder">
                                            <ul>
                                                <li><span><i class="far fa-money-bill-alt"></i>{{provider.symbol}}{{provider.hourly_rate}} / hr</span></li>
                                                <li><span><em><img :src="baseUrl+provider.flag" alt="img description"></em>{{provider.location}}</span></li>
                                                <!--<li v-if="provider.save_providers.includes(provider.id)" class="wt-btndisbaled">
                                                    <a href="javascript:void(0);" class="wt-clicksave"><i class="fa fa-heart"></i>{{ trans('lang.saved') }}</a>
                                                </li>
                                                <li v-else>
                                                    <a href="javascrip:void(0);" class="wt-clicklike" :id="'provider-'+provider.id" @click.prevent="add_wishlist('provider-'+provider.id, provider.id, 'saved_provider')">
                                                        <i class="fa fa-heart"></i><span class="save_text">{{trans("lang.click_to_save")}}</span>
                                                    </a>
                                                </li>-->

                                                <li>
                                                    <a href="javascript:void(0);" class="wt-freestars"><i class="fas fa-star"> </i>{{provider.average_rating_count}}{{ trans('lang.5') }} <em> ({{provider.total_reviews}} {{ trans('lang.feedbacks') }})</em></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'providers', 'pageID'],
    data() {
        return {
            provider:{},
            topproviders:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.provider.padding ? `${this.provider.padding.top}${this.provider.padding.unit} ${this.provider.padding.right}${this.provider.padding.unit} ${this.provider.padding.bottom}${this.provider.padding.unit} ${this.provider.padding.left}${this.provider.padding.unit}` : '',
                margin: this.provider.margin ? `${this.provider.margin.top}${this.provider.margin.unit} ${this.provider.margin.right}${this.provider.margin.unit} ${this.provider.margin.bottom}${this.provider.margin.unit} ${this.provider.margin.left}${this.provider.margin.unit}` : '',
                'text-align': this.provider.alignment,
                background: this.provider.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.provider.contentBackground,
                color:this.provider.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.providers, 'id', this.element_id)
        if (this.provider[index]) {
            this.provider = this.provider[index]
        }
        this.provider.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('provider-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        getTopProviders: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-top-providers")
            .then(function(response) {
                if (response.data.type == "success") {
                    self.topproviders =response.data.providers
                }
            })
            .catch(function(error) {  });
        }
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.providers, 'id', self.element_id)
            if (self.providers[index]) {
                self.provider = self.providers[index]
            }
        }, 100);
        this.getTopProviders()
    },
};
</script>
