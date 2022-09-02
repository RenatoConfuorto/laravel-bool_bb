<template>
  <div>
    <UserLogin/>
    <router-view></router-view>
  </div>
</template>

<script>
import UserLogin from '../components/UserLogin.vue';
import GuestHomepage from '../pages/GuestHomepage.vue';

export default {
  name: 'App',
  components: {
    UserLogin,
    GuestHomepage
  },
}
</script>

<style>

</style>