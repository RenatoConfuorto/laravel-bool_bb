<template>
  <div class="search-bar">
    <div class="input-wrapper">
      <div class="search">
        <input type="text" placeholder="Search" v-model="address">
        <button @click="search">Cerca</button>
      </div>
      <div class="alert alert-danger" v-if="error">{{ error }}</div>
      <div class="address-tips mb-3" v-if="addressResults">
        <div v-for="(address, index) in addressResults" :key="index" @click="addressClick(address)">
          {{ getAddressString(address) }}
        </div>
      </div>
    </div>
    <div class="filters">
      <div class="mb-3">
        <label for="number" class="form-label">Distanza:</label>
        <input id="number" class="form-control" type="number" name="radius" v-model="radius">
      </div>

      <div class="mb-3">
        <label for="number" class="form-label">Numero minimo di stanze:</label>
        <input id="number" class="form-control" type="number" name="radius" v-model="rooms">
      </div>

      <div class="mb-3">
        <label for="number" class="form-label">Numero minimo di posti letto:</label>
        <input id="number" class="form-control" type="number" name="radius" v-model="beds">
      </div>

      <div class="services" v-if="extraServices">
        <div class="form-checked" v-for="service in extraServices " :key="service.id">
          <input class="form-check-input extra_services" type="checkbox" :value="service.id" :id="`extra_service-${service.id}`">
          <label class="form-check-label" :for='`extra_service-${service.id}`'>
            {{ service.name }}
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SearchBar',
  data(){
    return {
      address: '',
      addressResults: [],
      searchTextCtrl: '',
      radius: 20,
      rooms: '',
      beds: '',
      extraServices: [],
      latitude: null,
      longitude: null,
      error: null,
    }
  },
  methods: {
    callApi(){
      if(
        this.address !== this.searchTextCtrl &&
        this.address !== '' &&
        this.address.length > 3
        ){
        this.searchTextCtrl = this.address;
        // console.log('far partire api', this.searchTextCtrl);

        axios.get(`https://api.tomtom.com/search/2/geocode/${this.address}.json`, {
          params : {
            key : 'b4J1e7HlWzyGPehDTXwH8o0kl7zyTSuA',
            countrySet: 'IT'
          }
        }).then(resp => {
          this.addressResults = resp.data.results;
          // this.addSuggestions(resp.data.results);
        }).catch(e => {
          console.error('Sorry! ' + e);
        });
      }
    },

    getAddressString(address){
      return `${address.address.freeformAddress}, ${address.address.countrySecondarySubdivision}, ${address.address.countrySubdivision}`;
    },

    addressClick(address){
      this.addressResults = [];
      // console.log(address)
      const addressString = this.getAddressString(address);
      // console.log(this)
      this.address = addressString; //inserire indirizzo completo nell'imput
      this.searchTextCtrl = addressString; //non far partire una nuova richiesta al click del tip
      this.latitude = address.position.lat;
      this.longitude = address.position.lon;
    },

    search(){
      const checkedServices = [];
      document.querySelectorAll('.extra_services').forEach(element => {
        if(element.checked)checkedServices.push(element.value);
      });
      // console.log(checkedServices);

      const params = {
        latitude: this.latitude,
        longitude: this.longitude,
        beds: this.beds ? this.beds : 1,
        rooms: this.rooms ? this.rooms : 1,
        radius: this.radius ? this.radius : 20,
        services: JSON.stringify(checkedServices),
      };
      //parametri di validazione
      const validation = 
        !params.longitude ||
        !params.latitude ||
        params.latitude < -90 ||
        params.latitude > 90 ||
        params.longitude > 180 ||
        params.longitude < -180 ||
        params.beds < 1 ||
        params.rooms < 1 ||
        params.radius < 1
      // console.log(params);
      if(!validation){
        this.error = null;
        // console.log('cerca')
        axios
        .get('http://127.0.0.1:8000/api/search/apartments', {
          params: params
        })
        .then(resp => {
          // console.log(resp.data.data);
          if(resp.data.success){
            this.$emit('searchResults', resp.data.data)
          }else{
            this.error = resp.data.error;
          }

        })
      }else{
        this.error = 'Qualcosa è andato storto, riprovare'
      }
    }
  },
  created(){
    delete axios.defaults.headers.common['X-Requested-With'];
    //impostare l'api
    setInterval(this.callApi, 500);
    //ottenere i servizi extra
    axios
    .get('http://127.0.0.1:8000/api/extra_services')
    .then(resp => {
      // console.log(resp.data);
      this.extraServices = resp.data;
    });
  }
}
</script>

<style lang="scss" scoped>
  .search-bar{
    width: 60%;

    .search{
      width: 100%;
      display: flex;

      input{
        flex-grow: 1;
      }
    }
  }
</style>