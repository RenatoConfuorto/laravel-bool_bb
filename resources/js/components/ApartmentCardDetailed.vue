<template>
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
</template>

<script>

export default {
  name: 'ApartmentCardDetailed',
  props: {
    apartment: Object
  }
}
</script>

<style lang="scss" scoped>

</style>