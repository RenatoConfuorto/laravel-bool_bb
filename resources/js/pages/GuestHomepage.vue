<template>
  <div class="test">
    <main>
      <div class="container-fluid d-flex justify-content-center align-items-center flex-wrap">

        <SearchBar @searchResults="getResults"/>
        <div v-if="loading">
          <LoadingComponent/>
        </div>

        <!-- V-ELSE CONTAINER -->
        <div v-else class="container-fluid d-flex justify-content-center flex-wrap">
          <div class="container-fluid d-flex justify-content-center flex-wrap">
            <!-- PAGINATION NAV -->
            <nav aria-label="...">
              <ul class="pagination">
                <!-- PREVIUOS PAGE -->
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                  <a class="page-link" href="#" @click="getApartments(currentPage - 1)">Previous</a>
                </li>
                <!-- /PREVIUOS PAGE -->

                <!-- PAGES NUMBER -->
                <li class="page-item" :class="{ active: currentPage === n }" v-for="n in lastPage" :key="n">
                  <a class="page-link" href="#" @click="getApartments(currentPage = n)">{{ n }}</a>
                </li>
                <!-- /PAGES NUMBER -->

                <!-- NEXT PAGE -->
                <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                  <a class="page-link" href="#" @click="getApartments(currentPage + 1)">Next</a>
                </li>
                <!-- /NEXT PAGE -->
              </ul>
            </nav>
            <!-- /PAGINATION NAV -->
          </div>
        
          <!-- APARTMENTS CONTAINER -->
          <div class="container-fluid d-flex justify-content-center flex-wrap">
          <ApartmentCard v-for="apartment in apartments" :key="apartment.id" :apartment="apartment"/>
          </div>
          <!-- /APARTMENTS CONTAINER -->
        </div>
        <!-- /V-ELSE CONTAINER -->
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
    SearchBar,
  },
  data() {
    return {
      apartments: [],
      loading: true,
      currentPage: 1,
      lastPage: 0,
      apartmentsPerPage: 100
    }
  },
  created() {
    this.getApartments(1);
  },
  methods: {
    getApartments(pageNumber) {
      axios.get('http://127.0.0.1:8000/api/apartments', {
        params: {
          page: pageNumber,
          // apartments_per_page: this.apartmentsPerPage,
        }
      })
      .then((resp) => {

        this.apartments = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results.last_page;
        this.totalApartments = resp.data.results.total;
        this.loading = false;
      })
    },
    getResults(event){
      console.log(event);
      this.apartments = event;
    }
  }
}
</script>

<style lang="scss" scoped>

</style>