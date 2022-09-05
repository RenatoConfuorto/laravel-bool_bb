<template>
  <div class="test">
    <main>
      <div class="container-fluid d-flex justify-content-center align-items-center flex-wrap">

        <SearchBar/>
        <div v-if="loading">
          <LoadingComponent/>
        </div>

        <div v-else class="container-fluid d-flex justify-content-center flex-wrap"> 
          <ApartmentCard v-for="apartment in apartments" :key="apartment.id" :apartment="apartment"/>
        </div>

      </div>
    </main>
  </div>
</template>

<script>
import ApartmentCard from '../components/ApartmentCard.vue';
import LoadingComponent from'../components/LoadingComponent.vue';
import SearchBar from'../components/SearchBar.vue';

export default {
  name: 'GuestHomepage',
  components: {
    ApartmentCard,
    LoadingComponent,
    SearchBar
  },
  data() {
    return {
      apartments: [],
      loading: true,
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
        this.loading = false;
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.test {
  height: 100vh;

  main {
    height: 100%;

    .container-fluid {
      height: 100%;
    }
  }
}

</style>