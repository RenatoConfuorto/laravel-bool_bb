<template>
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" :src="apartment.image" :alt="apartment.title">
  <div class="card-body">
    <h5 class="card-title">{{ apartment.title }}</h5>
    <p class="card-text">{{ apartment.description }}</p>
    <span>{{ apartment.price }}</span>
    <span></span>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{ apartment.address }}</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
  <div class="card-body">
    <router-link :to="{ name: 'single-apartment', params: {slug: apartment.slug} }">Dettagli appartamento</router-link>
  </div>
</div>
</template>

<script>
export default {
  name: 'ApartmentCard',
  props: {
    apartment: Object
  }
}
</script>

<style>

</style>