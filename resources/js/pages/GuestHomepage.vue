<template>
  <div>
    <main>
      <div class="container-fluid d-flex justify-content-center flex-wrap">
        <ApartmentCard v-for="apartment in apartments" :key="apartment.id" :apartment="apartment"/>
      </div>
    </main>
  </div>
</template>

<script>
import ApartmentCard from './ApartmentCard.vue';

export default {
  name: 'GuestHomepage',
  components: {
    ApartmentCard
  },
  data() {
    return {
      apartments: []
    }
  },
  created() {
    this.getApartments();
  },
  methods: {
    getApartments() {
      axios.get('http://127.0.0.1:8000/api/apartments')
      .then((resp) => {

        this.apartments = resp.data.results;
        console.log(resp.data.results);
      })
    }
  }
}
</script>

<style>

</style>