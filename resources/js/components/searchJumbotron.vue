<template>
  <div class="search-jumbotron">
    <div class="black">
      {{ text }}
    </div>
    <div class="img">
      <img :src="require('../../img/apartment.png')" alt="">
    </div>
  </div>
</template>

<script>
export default {
  name: 'SearchJumbotron',
  props: {
    text: String,
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';
.search-jumbotron{
  display: flex;
  height: 300px;
  width: 100%;
  max-width: $main-max-width;

  .black{
    background-color: black;
    color: white;
    flex-grow: 1;
    flex-basis: 0;
  }

  .img{
    margin-left: 10px;
    flex-grow: 3;
    flex-basis: 0;
    overflow: hidden;

    img{
      min-width: 100%;
      min-height: 100%;
    }
  }
}
</style>