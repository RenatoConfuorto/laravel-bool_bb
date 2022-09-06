<template>
  <div class="container-fluid">
    <div id="map"></div>
  </div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';

export default {
  name: 'TomTomMap',
  props: {
    apartment: Object
  },
  data() {
    return {
      map: {}
    }
  },
  mounted() {
    this.createMap();
    this.addMarker();
  },
  methods: {
    createMap() {
      this.map = tt.map({
        key: 'b4J1e7HlWzyGPehDTXwH8o0kl7zyTSuA',
        container: 'map',
        center: [this.apartment.longitude, this.apartment.latitude],
        zoom: 10
      });
    },
    addMarker() {
      const marker = new tt.Marker()
      .setLngLat([this.apartment.longitude, this.apartment.latitude])
      .addTo(this.map);
    }
  },
}

</script>

<style lang="scss" scoped>
#map {
  width: 100%;
  height: 500px;
}
</style>