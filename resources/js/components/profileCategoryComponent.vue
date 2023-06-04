<template>
          
    <div id="tr5">
        <!--<td class="job-details"><b>{{ trans('lang.categories') }}</b></td>-->
        <div>
            <span>
                <span v-if="categories">
                    <span style="background-color: #005178;color: white;padding: 10px;border-radius: 20px;margin: 5px;white-space: nowrap;line-height:4;" v-for="item in categories" :key="item.id">{{ item.name }} <i @click="deletecategory(item.id)" class="fa fa-times" aria-hidden="true"></i></span><br>
                </span>
                <!--<span @click="addcategory" id="addcategory"><i class="fa fa-plus"></i></span>-->
                <select class="form-control form-control-sm" id="addcategory-select" name="addcategory-select" v-on:change="updateaddcategory">  
                    <option selected>{{ trans('lang.select') }}</option>                                  
                    
                    <component v-for="(item, key) in xcategory" :key="key" :value="item.id" :is="(item.stat == 'hide') ? 'optgroup' : 'option'" :label="item.title" style="color: black;">
                        <option v-if="item.stat == 'hide' && item.cat.length > 0" v-for="(item1, key1) in item.cat" :key="key1" :value="item1.id">{{ item1.title }}</option>
                    </component>

                    <!--<option v-for="(item, key) in xcategory" :key="key" :value="item.id" :disabled="(item.stat == 'hide') ? true : false">{{ item.title }}</option>-->
                </select>
            </span>
        </div>
    </div>
          
</template>

<script>

//import vueDropzone from "vue2-dropzone";
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        
        xcategory : {},
        categories : {},
        
    }
  },
  props: {
      userid: String,
  },
  methods: {
       
        loadcategory() {
            let self = this;
            axios.get(APP_URL + '/get-categories').then(function (response) {
                self.xcategory = response.data.categories;
            });
            axios.get(APP_URL + '/api/getusercategory').then(function (response) {
                self.categories = response.data;
            }); 
        },
        
        updateaddcategory(e) {
            console.log(e.target.value);
            let statp = e.target.value;
            axios.get(APP_URL + '/api/job_overview/updateusercategory/' + statp).then(function (response) {
                Fire.$emit('AfterCreate');
            });
            Fire.$emit('AfterCreate');
        },
        deletecategory(id)
        {
            
            axios.get(APP_URL + '/api/job_overview/deleteusercategory/' + id).then(function (response) {
                Fire.$emit('AfterCreate');
            });
        },
  },
    mounted: function() {
        
        
        
        
        
        this.loadcategory();
        
        
        
        Fire.$on('AfterCreate', () => {
            this.loadcategory();
        });
  }
};
</script>
<style>
td {
    border-top: 1px solid #dbdbdb;
    border: 1px solid #dbdbdb;
    line-height: 2.5;
    padding-left: 3px;
    text-align: center;
    vertical-align: top;
}
.job-details {
	text-align:left;
	padding-left:20px;
    width: 50%;
}
</style>