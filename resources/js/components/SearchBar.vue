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
import {callApi, getAddressString, addressClick, search} from '../userApiSearch.js';
export default {
  name: 'SearchBar',
  data(){
    return {
      address: '',
      addressResults: [],
      searchResults: [],
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
    callApi,
    getAddressString,
    addressClick,
    search,
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