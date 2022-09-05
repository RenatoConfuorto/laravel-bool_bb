<template>
  <!-- CONTAINER E ROOT ELEMENT -->
  <div class="container d-flex justify-content-center alig-items-center flex-wrap">

    <div v-if="loading">
      <LoadingComponent/>
    </div>

    <div v-else class="container-fluid d-flex justify-content-center">
      <!-- BOOTSTRAP CARD -->
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" :src="apartment.image" :alt="apartment.title">
        <div class="card-body">
          <h5 class="card-title">{{ apartment.title }}</h5>
          <p class="card-text">{{ apartment.description }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Prezzo: {{ apartment.price }} &euro;</li>
          <li class="list-group-item">Indirizzo: {{ apartment.address }}</li>
          <li class="list-group-item">Numero di stanze: {{ apartment.rooms_number }}</li>
          <li class="list-group-item">Numero di letti: {{ apartment.beds_number }}</li>
          <li class="list-group-item">Numero di bagni: {{ apartment.bathrooms_number }}</li>
        </ul>
        <div class="services text-center">
          <span class="badge rounded-pill bg-success" v-for="service in apartment.services" :key="service.id">{{ service.name }} </span>
        </div>
        <div class="card-body">
          <router-link :to="{ name: 'homepage' }">HOME</router-link>
          <router-link :to="{ name: 'contact-form', params: {slug: apartment.slug} }">Contatta il proprietario dell'appartamento</router-link>
        </div>
      </div>
      <!-- BOOTSTRAP CARD -->

      <div class="container-fluid">
        <!-- TOM TOM MAP -->
        <div id="map"></div>
        <!-- /TOM TOM MAP -->
      </div>
    </div>
  </div>
  <!-- /CONTAINER E ROOT ELEMENT -->
</template>

<script>
import LoadingComponent from'../components/LoadingComponent.vue';
import tt from '@tomtom-international/web-sdk-maps';
export default {
  name: 'SingleApartment',
  components: {
    LoadingComponent
  },
  data() {
    return {
      apartment: {},
      loading: true
    }
  },
  created() {
    this.getApartmentDetails();
  },
  methods: {
    getApartmentDetails() {
      const slug = this.$route.params.slug;
      axios.get(`http://127.0.0.1:8000/api/apartments/${slug}`)
      .then((resp) => {
        if (resp.data.success) {
          this.apartment = resp.data.results;
          this.loading = false;
        } else {
          // per adesso reindirizza alla homepage, da gestire meglio
          this.$router.push({ name: 'homepage' });
        }
      });
    },
    // createMap() {
    //   if (this.loading === false) {
    //     const map = tt.map({
    //       key: 'b4J1e7HlWzyGPehDTXwH8o0kl7zyTSuA',
    //       container: 'map'
    //     });
    //   }
    // },
    // addMarker(map) {
    //   const tt = window.tt;
    //   // console.log(window);
    //   let location = [-121.91595, 37.36729];
    //   console.log(location);
    //   let popupOffset = 25;
    //   let marker = new tt.Marker().setLngLat(location).addTo(map);
      
    //   let popup = new tt.Popup({ offset: popupOffset }).setHTML("Your address!");
    //   marker.setPopup(popup).togglePopup();
    //   console.log(marker);
    // },
  },
  computed: {
    createMap() {
      if (this.loading === false) {
        const map = tt.map({
          key: 'b4J1e7HlWzyGPehDTXwH8o0kl7zyTSuA',
          container: 'map'
        });
      }
    }
  }
}
</script>

<style lang="scss" scoped>
#map {
  width: 100%;
  height: 500px;
}
</style>