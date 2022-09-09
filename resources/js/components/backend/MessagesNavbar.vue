<template>
  <div class="navbar">
    <a :href="routeToApartmentMessages">
      <li class="list-group-item list-group-item-action mb-3">
        <div class="row">
          <div class="col-md-8">
            <p>{{ apartment.title }}</p>
            <p>{{ apartment.address }}</p>
          </div>
          <div class="col-md-4">
            <div class="img-wrap">
              <img id="navbar-img" :src="apartment.image" :alt="apartment.title">
            </div>
          </div>
        </div>
      </li>
    </a>
  </div>
</template>

<script>
export default {
  name: 'MessagesNavbar',
  props: {
    apartment: Object,
    routeToApartmentMessages: String
  }
}
</script>

<style lang="scss" scoped>
.navbar {

  li.list-group-item-action {
  height: calc(100vh / 5);
  max-height: 250px;
  border-radius: 10px;
  margin-bottom: .5rem;

    a {
      text-decoration: none;
      color: black;
    }

    .img-wrap {
      width: 100%;
      border-radius: 25px;
      overflow: hidden;
    
      img {
      width: 100%;
      height: 100%;
      object-fit: center;
      }
    }
  }
}
  
</style>