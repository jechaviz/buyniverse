<template>
    <div>
        <style1 
        :app="app"
        :sectionStyle="sectionStyle"
        :pageID="pageID"
        v-if="app.style == 'style1'">
        </style1>
        <style2 
        :app="app"
        :sectionStyle="sectionStyle"
        :pageID="pageID"
        v-else-if="app.style == 'style2'">
        </style2>
        <style3
        :app="app"
        :sectionStyle="sectionStyle"
        :pageID="pageID"
        v-else-if="app.style == 'style3'">
        </style3>
    </div>
</template>
<script>
import style1 from './style1.vue'
import style2 from './style2.vue'
import style3 from './style3.vue'
export default {
    components:{style1, style2, style3},
    props:['parent_index', 'element_id', 'apps', 'pageID'],
    data() {
        return {
            url:APP_URL,
            app:{},
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.app.padding ? `${this.app.padding.top}${this.app.padding.unit} ${this.app.padding.right}${this.app.padding.unit} ${this.app.padding.bottom}${this.app.padding.unit} ${this.app.padding.left}${this.app.padding.unit}` : '',
                margin: this.app.margin ? `${this.app.margin.top}${this.app.margin.unit} ${this.app.margin.right}${this.app.margin.unit} ${this.app.margin.bottom}${this.app.margin.unit} ${this.app.margin.left}${this.app.margin.unit}` : '',
                'text-align': this.app.alignment,
                background: !this.app.background_image ? this.app.sectionColor : ''
            }
        },
        contentSectionStyle() {
            return {
                background:this.app.contentBackground,
                color:this.app.contentColor
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
    mounted: function() {
        this.isActive = false
        var self= this
        
        this.emitter.on('app-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    created: function() {
        var self = this
        setTimeout(function () {
            var index = self.getArrayIndex(self.apps, 'id', self.element_id)
            if (self.apps[index]) {
                self.app = self.apps[index]
            }
        }, 100);
    },   
};
</script>
