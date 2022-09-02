<template>
  <div>
    <UserLogin/>
    <router-view></router-view>
  </div>
</template>

<script>
import UserLogin from '../components/UserLogin.vue';

export default {
  name: 'App',
  components: {
    UserLogin,
  },
}
</script>

<style>

</style>