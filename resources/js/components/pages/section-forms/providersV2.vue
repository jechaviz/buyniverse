<template>
    <div class="element-form-wrapper" v-if="provider">
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <input type="text" v-model="provider.title" :placeholder="$trans('lang.sec_title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="provider.titleTwo" :placeholder="$trans('lang.title_two')" class="form-control">
                </div>
                <div class="form-group">
                    <tinymce-editor v-model="provider.description" :init="{height: 350, plugins: 'paste link code advlist autolink lists link charmap print', toolbar1: 'undo redo code | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist', menubar:false, statusbar: false, extended_valid_elements:'span[style],i[class]'}"></tinymce-editor>
                </div>
                <div 
                    class="at-profile-setting__upload bg_img dc-settingscontent" 
                    :id="'bg_img_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'bg_img_wrapper'+currentElementID"
                        :id="'bg_img'+currentElementID"
                        :img_ref="'bg_img'+currentElementID"
                        :name="'bg_img'"
                        :url="baseURL+'/admin/pages/upload-temp-image/bg_img'"
                        :preview_class="'bg_img_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_bg_img'+currentElementID"
                        :list_id="'list_id_bg_img'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="$trans('lang.bg_img')"
                        @addedFile="imageAdded('bg_img_wrapper'+currentElementID, 'bgImg', 'bg_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('bgImg')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'bg_img_preview'+currentElementID">
                            <li :id="'bg_hiddenImage'+currentElementID" v-if="provider.backgroundImg">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+provider.backgroundImg" @error="OldImageError('bgImg')" v-if="pageID && !newBgImg">
                                        <img :src="tempUrl+provider.backgroundImg" @error="TempImageError('bgImg')" v-else-if="!pageID || newBgImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('bgImg', 'bg_hiddenImage'+currentElementID)">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </span>
                                        <span class="at-tick">
                                            <span>
                                                <i class="fas fa-check"></i>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                                <input type="hidden" :value="provider.backgroundImg" name="image" :id="'bg_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"><h3>{{ $trans('lang.style') }}</h3></div>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ $trans('lang.title_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="provider.titleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ $trans('lang.title_two_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="provider.titleTwoColor"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"> <h3>{{ $trans('lang.sec_style') }}</h3></div>
        </div>
          <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ $trans('lang.section_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="provider.sectionColor"></verte>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <div class="amt-element-title">
                         <h6>{{ $trans('lang.padding') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="provider.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="provider.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="provider.padding.top"> <label for="at-top">{{ $trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="provider.padding.right"> <label for="at-right">{{ $trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="provider.padding.bottom"> <label for="at-bottom">{{ $trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="provider.padding.left"> <label for="at-left">{{ $trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="amt-element-title">
                        <h6>{{ $trans('lang.margin') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="provider.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="provider.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="provider.margin.top"> <label for="at-top">{{ $trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="provider.margin.right"> <label for="at-right">{{ $trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="provider.margin.bottom"> <label for="at-bottom">{{ $trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="provider.margin.left"> <label for="at-left">{{ $trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group"><input type="text" v-model="provider.sectionClass" :placeholder="$trans('lang.sec_class')" class="form-control"></div>
                <div class="form-group"><input type="text" v-model="provider.sectionId" :placeholder="$trans('lang.sec_id')" class="form-control"></div>
            </fieldset>
        </div>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue'
import Event from '../../../event'

export default {
    components: {
        'tinymce-editor': Editor
    },
    props:['parent_index', 'element_id', 'provider', 'pageID', 'currentElementID', 'cloneElement'],
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            newBgImg: false,
            changeFound:true
        }
    },
    watch:{
        currentElementID: function (change) {
            this.changeFound = false
            setTimeout(() => {
                this.changeFound = true
            }, 200);
        }
    },
    methods:{
        imageAdded: function(hiddenID, imageType, hiddenGenerateImage) {
            var self = this
            setTimeout(function(){ 
               if (document.querySelector('#'+hiddenID+ ' .at-profile-setting__imgs ul li [type="hidden"]')) {
                    var hidddenImage = document.querySelector('#'+hiddenID+ ' .at-profile-setting__imgs ul li [type="hidden"]');
                    let image = hidddenImage.value
                    if (imageType == 'bgImg') {
                        if (image) {
                            self.provider.backgroundImg = image
                            self.emitter.emit('new-provider-bg-image'+self.currentElementID)
                            self.newBgImg = true
                        } else {
                            self.provider.backgroundImg = null
                        }
                    }
                } 
            }, 120);
            setTimeout(function(){ 
                if (document.getElementById(hiddenGenerateImage)) {
                    document.getElementById(hiddenGenerateImage).remove()
                }
            }, 130);
        },
        imageRemoved: function(imageType) {
            // if (this.cloneElement == false) {
                if (imageType == 'bgImg') {
                    if (this.provider.backgroundImg) {
                        this.provider.backgroundImg = null
                    }
                }
            // }
        },
        removeImage: function(imageType, hiddenID) {
            if (imageType == 'bgImg') {
                if (this.provider.backgroundImg) {
                    this.provider.backgroundImg = null
                }
            }
            document.getElementById(hiddenID).remove()
        },
        TempImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = false
            }
        },
        OldImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = true
            }
        }
    }
};
</script>

