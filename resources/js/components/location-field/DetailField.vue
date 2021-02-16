<template>
  <div class="flex border-b border-40 -mx-6 px-6 google-map" :id="field.attribute">
    <div class="google-map-inject" ref="map"></div>
  </div>
</template>

<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],
  data() {
    return {
      map: null,
      marker: null,
    }
  },
  mounted () {
    this.map = new google.maps.Map(this.$refs.map, {
      zoom: 8,
      center: this.location,
    });
    // The marker, positioned at Uluru
    this.marker = new google.maps.Marker({
      position: this.location,
      map: this.map,
    });
  },
  computed: {
    location() {
      return {
        lng: this.field.value.longitude,
        lat: this.field.value.latitude,
      }
    }
  }
}
</script>
<style>
  .google-map {
    height: 400px;
  }
  .google-map-inject {
    width: 100%;
  }
</style>