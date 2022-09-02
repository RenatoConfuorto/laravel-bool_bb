<template>
  <div>
    <AppHeader
    v-if="loggedIn"
    :logged-in=loggedIn
    :user-route="userRoute"
    />
    <AppHeader
    v-else
    :logged-in="loggedIn"
    :login-route="loginRoute"
    :registerRoute="registerRoute"
    />
    <router-view></router-view>
  </div>
</template> 

<script>
import AppHeader from '../components/AppHeader.vue';
import GuestHomepage from '../pages/GuestHomepage.vue';

export default {
  name: 'App',
  data(){
    return{
      userData: null,
    };
  },
  components: {
    AppHeader,
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
    if(this.user)this.userData = JSON.parse(this.user);
    console.log(this.userData)
    console.log(this.registerRoute);
  }
}
</script>

<style>

</style>