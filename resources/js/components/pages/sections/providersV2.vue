<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="provider.sectionClass + ' wt-main-section wt-section-bg wt-providers-wrap'"
            :id="provider.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(provider).length != 0"
        >
            <div class="wt-overlay-4" :style="[newBgImage ?
                {'background-image': 'url('+tempUrl+provider.backgroundImg+')'} :
                pageID && provider.backgroundImg ?
                {'background-image': 'url('+imageUrl+provider.backgroundImg+')'} : '']"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="wt-sectionheadvthree wt-textcenter">
                            <div class="wt-sectiontitlevtwo">
                                <h2 :style="{color:provider.titleColor}">{{provider.title}} 
                                    <em :style="{color:provider.titleTwoColor}">{{provider.titleTwo}}</em>
                                </h2>
                            </div>
                            <div class="wt-description" v-if="provider.description" v-html="provider.description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- <carousel id="wt-providers-silder" class="wt-providers-silder" :items='3' :loop='true' :nav='false' :dots='true' 
                    :autoplay='false' :margin='30' v-if="filtersApplied"> -->
                        <div id="wt-providers-silder" class="wt-providers-silder owl-carousel">
                            <div class="wt-provider" v-for="(provider, index) in topproviders" :key="index">
                                <figure class="wt-provider-img">
                                    <img :src="provider.image" alt="image">
                                </figure>
                                <div class="wt-provider-head">
                                    <div class="wt-provider-tag">
                                        <a :href="baseUrl+'/profile/'+provider.slug">{{provider.name}}</a>
                                    </div>
                                    <div class="wt-title">
                                        <h3>{{provider.tagline}}</h3>
                                    </div>
                                    <div class="wt-provider-about">
                                        <div class="wt-provider-price"><span><i class="fas fa-money-bill-alt"></i> {{provider.symbol}}{{provider.hourly_rate}} / hr </span></div>
                                        <div class="wt-rating">
                                            <span class="wt-stars wt-starstwo"><span></span></span> <em>{{provider.average_rating_count}}{{ $trans('lang.5') }}</em>
                                        </div>
                                    </div>
                                    <div class="wt-provider-social">
                                        <ul>
                                            <li v-for="(skill, item) in provider.skills" :key="item">
                                                <a href="javascript:void(0)">{{skill}}</a>
                                            </li>
                                            <li>
                                                <span>[<a href="javascript:void(0)">...</a>]</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <ul class="wt-provider-footer">
                                    <li>
                                        <address><i class="ti-location-pin"></i>{{provider.location}}</address>
                                    </li>
                                    <li v-if="provider.save_providers.includes(provider.id)">
                                        <a href="javascript:void(0);"  :id="'provider-'+provider.id" @click.prevent="add_wishlist('provider-'+provider.id, provider.id, 'saved_provider')">
                                        <i class="ti-heart"></i> {{$trans("lang.saved")}}</a>
                                    </li>
                                    <li><a href="javascript:void(0);"  :id="'provider-'+provider.id" @click.prevent="add_wishlist('provider-'+provider.id, provider.id, 'saved_provider')">
                                        <i class="ti-heart"></i> {{$trans("lang.save")}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <!-- </carousel> -->
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Event from '../../../event'
import carousel from 'vue-owl-carousel'

export default {
    props:['parent_index', 'element_id', 'providers', 'pageID'],
    components:{carousel},
    data() {
        return {
            provider:{},
            topproviders:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            filtersApplied: false,
            newBgImage:false,
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
        
        this.emitter.on('provider-sectionV2-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
        //Event.$on('new-provider-bg-image'+self.element_id, (data) => {
        this.emitter.on('new-provider-bg-image'+self.element_id, (data) => {
            this.newBgImage = true
        })
    },
    methods:{
        getArrayIndex(array, attr, value) {
            this.json = '';
            if (array.length) {
                for (let x = 0; x < array.length; x++) {
                if (array[x] && array[x][attr]) {
                    if (array[x][attr] === value) {
                    this.json = array[x]['order'] ? array[x]['order'] : '';
                    }
                }
                }
            }
            return this.json;
        },
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        add_wishlist: function (element_id, id, column, saved_text) {
            var self = this;
            axios.post(APP_URL + '/user/add-wishlist', {
                id: id,
                column: column,
            })
            .then(function (response) {
                if (response.data.authentication == true) {
                    if (response.data.type == 'success') {
                        if (column == 'saved_provider') {
                            jQuery('#' + element_id).parents('li').addClass('wt-btndisbaled');
                            jQuery('#' + element_id).addClass('wt-clicksave');
                            jQuery('#' + element_id).find('.save_text').text(Vue.prototype.$trans('lang.saved'));
                            self.disable_btn = 'wt-btndisbaled';
                            self.text = Vue.prototype.$trans('lang.btn_save');
                            self.saved_class = 'fa fa-heart';
                            self.click_to_save = 'wt-clicksave'
                        }
                        self.showMessage(response.data.message);
                    } else {
                        self.showError(response.data.message);
                    }
                } else {
                    self.showError(response.data.message);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getTopProviders: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-top-providers")
            .then(function(response) {
                if (response.data.type == "success") {
                    self.topproviders =response.data.providers
                    self.filtersApplied = true
                    /* provider Slider */
                    Vue.nextTick(function() {
                        var wt_providers_silder = jQuery(".wt-providers-silder")
                        wt_providers_silder.owlCarousel({
                            item: 3,
                            loop:true,
                            nav:false,
                            margin: 30,
                            rtl:true,
                            autoplay:false,
                            dots: true,
                            dotsClass: 'wt-sliderdots',
                            responsiveClass:true,
                        
                        });
                    })
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
