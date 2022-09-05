<template>
  <div class="search-bar">
    <div class="input-wrapper">
      <input type="text" placeholder="Search">
      <button>Cerca</button>
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
      radius: 20,
      rooms: 1,
      beds: 1,
      extraServices: [],
    }
  },
  created(){
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

    .input-wrapper{
      width: 100%;
      display: flex;

      input{
        flex-grow: 1;
      }
    }
  }
</style>