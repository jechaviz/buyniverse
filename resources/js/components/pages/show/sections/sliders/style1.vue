<template>
    <div 
        :class="slider.sectionClass + ' wt-haslayout wt-bannerholder'"
        :style="sectionStyle" 
        :id="slider.sectionId"
        v-if="Object.entries(slider).length != 0"
    >
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                <div class="wt-bannerimages">
                    <figure class="wt-bannermanimg">
                        <img :src="imageUrl+slider.inner_banner_image" alt="img description">
                        <img :src="imageUrl+slider.floating_image01" class="wt-bannermanimgone" alt="img description">
                        <img :src="imageUrl+slider.floating_image02" class="wt-bannermanimgtwo" alt="img description">
                    </figure>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                <div class="wt-bannercontent">
                    <div class="wt-bannerhead">
                        <div class="wt-title">
                            <h1>
                                <span>{{slider.title}}</span>
                                {{slider.subtitle}}
                            </h1>
                        </div>
                        <div class="wt-description" v-html="slider.description"></div>
                    </div>
                    <search-form
                    :widget_type="'home'"
                    :placeholder="$trans('lang.looking_for')"
                    :provider_placeholder="$trans('lang.search_filter_list.provider')"
                    :employer_placeholder="$trans('lang.search_filter_list.employers')"
                    :job_placeholder="$trans('lang.search_filter_list.jobs')"
                    :service_placeholder="$trans('lang.search_filter_list.services')"
                    :no_record_message="$trans('lang.no_record')"
                    >
                    </search-form>
                    <div class="wt-videoholder" v-if="slider.video_link">
                        <div class="wt-videoshow">
                            <a data-rel="prettyPhoto[video]" :href="slider.video_link"><i class="fa fa-play"></i></a>
                        </div>
                        <div class="wt-videocontent">
                            <span>{{slider.video_title}}<em>{{slider.video_description}}</em></span>
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
    props:['slider', 'page_id'],
    data() {
        return {
            /*tempUrl:APP_URL+'/public/uploads/pages/temp/',
            imageUrl:APP_URL+'/public/uploads/pages/'+this.page_id+'/',*/
            tempUrl:APP_ASSET_URL+'/uploads/pages/temp/',
            imageUrl:APP_ASSET_URL+'/uploads/pages/'+this.page_id+'/',
        }
    },
    computed: {
        sectionStyle() {
            
            return {
                padding: this.slider.padding ? `${this.slider.padding.top}${this.slider.padding.unit} ${this.slider.padding.right}${this.slider.padding.unit} ${this.slider.padding.bottom}${this.slider.padding.unit} ${this.slider.padding.left}${this.slider.padding.unit}` : '',
                margin: this.slider.margin ? `${this.slider.margin.top}${this.slider.margin.unit} ${this.slider.margin.right}${this.slider.margin.unit} ${this.slider.margin.bottom}${this.slider.margin.unit} ${this.slider.margin.left}${this.slider.margin.unit}` : '',
                'text-align': this.slider.alignment,
                background: this.newSliderImage ? 'url('+ this.tempUrl + this.slider.slider_image[0] +')' : this.page_id ? 'url('+ this.imageUrl + this.slider.slider_image[0] +')' : this.slider.sectionColor
            }
        },
    },
    mounted: function() {
        var self = this;
        setTimeout(function(){
            jQuery("a[data-rel]").each(function () {
                jQuery(this).attr("rel", jQuery(this).data("rel"));
            });
            jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
                animation_speed: 'normal',
                theme: 'dark_square',
                slideshow: 3000,
                default_width: 800,
                default_height: 500,
                allowfullscreen: true,
                autoplay_slideshow: false,
                social_tools: false,
                iframe_markup: "<iframe src='{path}' width='{width}' height='{height}' frameborder='no' allowfullscreen='true'></iframe>",
                deeplinking: false
            });
             $('.wt-bannermanimg').tilt();
        },1000);
    } 
};
</script>