<template>
    <div class="element-form-wrapper" v-if="provider">
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <input type="text" v-model="provider.title" :placeholder="$trans('lang.sec_title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="provider.subtitle" :placeholder="$trans('lang.sec_subtitle')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="provider.description" :placeholder="$trans('lang.sec_desc')" class="form-control">
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
            <h6>{{ $trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="provider.subtitleColor"></verte>
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
                <div class="form-group" v-if="provider.padding">
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
                <div class="form-group" v-if="provider.margin">
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
export default {
    props:['parent_index', 'element_id', 'provider', 'pageID'],
};
</script>
