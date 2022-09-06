<template>
  <div class="search-bar">
    <div class="input-wrapper">
      <div class="search">
        <input type="text" placeholder="Search" v-model="address">
        <button @click="() => {search(), redirect()}">Cerca</button>
      </div>
      <div class="alert alert-danger" v-if="error">{{ error }}</div>
      <div class="address-tips mb-3" v-if="addressResults">
        <div v-for="(address, index) in addressResults" :key="index" @click="addressClick(address)">
          {{ getAddressString(address) }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {callApi, getAddressString, addressClick, search} from '../userApiSearch.js';

export default {
  name: 'SimpleSearchBar',
  data(){
    return {
      address: '',
      addressResults: [],
      searchResults: [],
      searchTextCtrl: '',
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
    redirect(){
      if(!this.error){
        // console.log('redirect');
        this.$router.push({name: 'advanced-search', params: {apartments: this.searchResults}});
      }
    }
  },
  created(){
    delete axios.defaults.headers.common['X-Requested-With'];
    setInterval(this.callApi, 500);
  },
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