<template>
  <div class="test">
    <main>
      <div class="container-fluid d-flex justify-content-center align-items-center flex-wrap">

        <SearchBar @searchResults="getResults"
        :given-address="address"
        :given-latitude="latitude"
        :given-longitude="longitude"
        />
        <div v-if="loading">
          <LoadingComponent/>
        </div>

        <div v-else class="container-fluid d-flex justify-content-center flex-wrap"> 
          <ApartmentCard v-for="apartment in searchResults" :key="apartment.id" :apartment="apartment"/>
        </div>

      </div>
    </main>
  </div>
</template>

<script>
import ApartmentCard from '../components/ApartmentCard.vue';
import LoadingComponent from'../components/LoadingComponent.vue';
import SearchBar from'../components/SearchBar.vue';
import {search} from '../userApiSearch.js';

export default {
  name: 'AdvancedSearch',
  components: {
    ApartmentCard,
    LoadingComponent,
    SearchBar
  },
  data() {
    return {
      address: '',
      latitude: null,
      longitude: null,
      searchResults: [],
      loading: true,
    }
  },
  created() {
    console.log(this.$route);
    this.address = this.$route.params.address;
    this.latitude = this.$route.params.latitude;
    this.longitude = this.$route.params.longitude;
    this.apartments = this.$route.params.apartments;
  },
  mounted(){
    this.search();
  },
  watch: {
    searchResults: function(){
      this.loading = false;
    }
  },
  methods: {
    search,
    // getApartments() {
    //   axios.get('http://127.0.0.1:8000/api/search/apartments' )
    //   .then((resp) => {

    //     this.apartments = resp.data.results;
    //     this.loading = false;
    //   })
    // },
    getResults(event){
      // console.log(event);
      this.apartments = event;
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