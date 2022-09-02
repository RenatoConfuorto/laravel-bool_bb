<template>
  <div class="container-fluid d-flex justify-content-center flex-wrap">
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
      <div class="card-body">
        <router-link :to="{ name: 'homepage'  }">HOME</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SingleApartment',
  data() {
    return {
      apartment: {},
      // con null da un'errore in console perchè cerca di leggere i dati prima che arrivino
      // apartment: null
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
        } else {
          // per adesso reindirizza alla homepage, da gestire meglio
          this.$router.push({ name: 'homepage' });
        }
      });
    }
  }
}
</script>

<style>

</style>