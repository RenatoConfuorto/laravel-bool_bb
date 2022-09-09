<template>
  <div class="test">
    <main>
      <SimpleSearchBar @searchResults="getResults"/>

      <div v-if="loading">
        <LoadingComponent/>
      </div>

      <!-- V-ELSE CONTAINER -->
      <div v-else class="container-fluid d-flex justify-content-center flex-wrap">
        <h1>In evidenza</h1>
        <PageNavigation
        :currentPage="currentPage"
        :lastPage="lastPage"
        :getApartments="getApartments"
        v-if="lastPage > 1"
        />
      
        <!-- APARTMENTS CONTAINER -->
        <div class="container-fluid d-flex justify-content-center flex-wrap">
        <ApartmentCard v-for="apartment in apartments" :key="apartment.id" :apartment="apartment"/>
        </div>
        <!-- /APARTMENTS CONTAINER -->

        <PageNavigation
        :currentPage="currentPage"
        :lastPage="lastPage"
        :getApartments="getApartments"
        v-if="lastPage > 1"
        />
      </div>
      <!-- /V-ELSE CONTAINER -->
    </main>
  </div>
</template>

<script>
import ApartmentCard from '../components/ApartmentCard.vue';
import LoadingComponent from'../components/LoadingComponent.vue';
import SimpleSearchBar from'../components/SimpleSearchBar.vue';
import PageNavigation from '../components/PageNavigation.vue';

export default {
  name: 'GuestHomepage',
  components: {
    ApartmentCard,
    LoadingComponent,
    SimpleSearchBar,
    PageNavigation,
  },
  data() {
    return {
      apartments: [],
      loading: true,
      currentPage: 1,
      lastPage: 0,
    }
  },
  created() {
    this.getApartments(1);
  },
  methods: {
    getApartments(page) {
      console.log(page)
        axios.get('http://127.0.0.1:8000/api/search/apartments_evidence', {
          params: {
            page: page,
        }
      })
      .then((resp) => {
        this.apartments = resp.data.data;
        // console.log('apartments', this.apartments);
        this.currentPage = page;
        this.lastPage = resp.data.number_of_pages;
        // this.totalApartments = resp.data.results.total;
        this.loading = false;
      })
    },
    getResults(event){
      // console.log(event);
      this.apartments = event;
    }
  }
}
</script>

<style lang="scss" scoped>

</style>