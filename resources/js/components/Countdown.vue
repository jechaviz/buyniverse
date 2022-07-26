<template>
    <div>{{ trans('lang.event_start_in') }} {{ timerdate | countdown }}. </div>
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        timerdate : this.timerdate,

        
    }
  },
  props: {
      timerdate: String 
  },
  methods: {
        
        
               

  },
    mounted: function() {
      
  }
};
</script>