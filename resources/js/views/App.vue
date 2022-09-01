<template>
  <div>
    <UserLogin />
    <GuestHomepage />
  </div>
</template>

<script>
import UserLogin from '../components/UserLogin.vue';
import GuestHomepage from '../components/GuestHomepage.vue';

export default {
  name: 'App',
  components: {
    UserLogin,
    GuestHomepage
  }
}
</script>

<style>

</style>