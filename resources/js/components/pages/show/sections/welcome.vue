<template>
    <section 
        :class="welcome.sectionClass + ' wt-haslayout  wt-main-section wt-paddingnull wt-companyinfohold'"
        :id="welcome.sectionId" 
        :style="sectionStyle" 
        v-if="Object.entries(welcome).length != 0"
    >
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="wt-companydetails">
                        <div class="wt-companycontent">
                            <div class="wt-companyinfotitle">
                                <h2 :style="{color:welcome.firstTitleColor}">{{welcome.first_title}}</h2>
                            </div>
                            <div class="wt-description" :style="{color:welcome.firstDescColor}" v-html="welcome.first_description"></div>
                            <div class="wt-btnarea">
                                <a :href="welcome.first_url" class="wt-btn" >{{welcome.first_url_button}}</a>
                            </div>
                        </div>
                        <div class="wt-companycontent">
                            <div class="wt-companyinfotitle">
                                <h2 :style="{color:welcome.secondTitleColor}">{{welcome.second_title}}</h2>
                            </div>
                            <div class="wt-description" v-html="welcome.second_description" :style="{color:welcome.secondDescColor}"></div>
                            <div class="wt-btnarea">
                                <a :href="welcome.second_url" class="wt-btn">{{ welcome.second_url_button }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
// import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'welcome_section', 'pageID'],
    data() {
        return {
            welcome:{},
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/public/uploads/pages/temp/',
            imageUrl:APP_URL+'/public/uploads/pages/'+this.pageID+'/',
            newVideoPosterImage: false
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.welcome.padding ? `${this.welcome.padding.top}${this.welcome.padding.unit} ${this.welcome.padding.right}${this.welcome.padding.unit} ${this.welcome.padding.bottom}${this.welcome.padding.unit} ${this.welcome.padding.left}${this.welcome.padding.unit}` : '',
                margin: this.welcome.margin ? `${this.welcome.margin.top}${this.welcome.margin.unit} ${this.welcome.margin.right}${this.welcome.margin.unit} ${this.welcome.margin.bottom}${this.welcome.margin.unit} ${this.welcome.margin.left}${this.welcome.margin.unit}` : '',
                'text-align': this.welcome.alignment,
                // background: !this.welcome.welcome_background ? this.welcome.sectionColor : '',
                // 'background-image': this.pageID ? 'url('+ this.imageUrl + this.welcome.welcome_background+')' : 'url('+ this.tempUrl + this.welcome.welcome_background+')'
                background: this.newVideoPosterImage ? 'url('+ this.tempUrl + this.welcome.welcome_background+')' : this.pageID ? 'url('+ this.imageUrl + this.welcome.welcome_background+')' : this.welcome.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.welcome.contentBackground,
                color:this.welcome.contentColor
            }
        },
    },
    methods: {
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
        }
    },
    updated: function() {
        var index = this.getArrayIndex(this.welcome_section, 'id', this.element_id)
        if (this.welcome[index]) {
            this.welcome = this.welcome[index]
        }
        this.welcome.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        
        this.emitter.on('welcome-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })

        
        this.emitter.on('new-video-poster-image', (data) => {
            this.newVideoPosterImage = true
        })
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.welcome_section, 'id', self.element_id)
            if (self.welcome_section[index]) {
                self.welcome = self.welcome_section[index]
            }
        }, 100);
    },
};
</script>
