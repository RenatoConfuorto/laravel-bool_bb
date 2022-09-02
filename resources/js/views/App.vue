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
  data(){
    return{
      userData: null,
    };
  },
  components: {
    UserLogin,
    GuestHomepage
  },
  props: {
    loggedIn: Boolean,
    user: String,
    userRoute: String,
    loginRoute: String,
    registerRoute: String,
  },
  created(){
    this.userData = JSON.parse(this.user);
    console.log(this.userData)
    console.log(this.registerRoute);
  }
}
</script>

<style>

</style>