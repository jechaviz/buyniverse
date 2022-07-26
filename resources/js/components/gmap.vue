<template>
  <div >
    <div id="map" class="map"></div>
    
  </div>
</template>

<script>
export default {
    props: {
        
    }, 
    data () {
        return {
            map : {},
            markers : {},
            latitude : 19.39068,
            longitude : -99.2836995
        
        }
    },
    
    methods: {
        initMap() {
            var myLatlng = new google.maps.LatLng(19.39068,-99.2836995);
            var mapOptions = {
            zoom: 4,
            center: myLatlng
            }
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                draggable: true,
                title:"My Location"
            });

            marker.addListener("drag", () => {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                //console.log(lat, lng);
                document.getElementById('lng-input').value = lng;
                document.getElementById('lat-input').value = lat;
                //$('#lat-input').value = lat;
                //console.log(document.getElementById('lng-input').value);
            });

            // To add the marker to the map, call setMap();
            marker.setMap(map);
        }
    },
    mounted: function() { 
      let recaptchaScript = document.createElement('script')
      recaptchaScript.setAttribute('src', '')
      document.head.appendChild(recaptchaScript)
      this.initMap();      
    
  }
}
</script>
