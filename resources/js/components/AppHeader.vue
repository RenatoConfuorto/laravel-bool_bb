<template>
  <nav>
    <ul>
      <li
      v-for="(link, index) in links"
      :key="index" v-if="link.visible">
        <a v-if="!link.router" :href="link.link">{{ link.text }}</a>
        <router-link v-else :to="link.link">{{ link.text }}</router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'AppHeader',
  data(){
    return{
      links: [
        {
          text: 'Login', //testo del link
          link: this.loginRoute, //link
          visible: !this.loggedIn, //se il link può essere visto o meno
          router: false,
        },
        {
          text: 'Register',
          link: this.registerRoute,
          visible: !this.loggedIn,
          router: false,
        },
        {
          text: 'User',
          link: this.userRoute,
          visible: this.loggedIn,
          router: false,
        },
      ],
    }
  },
  props: {
    loggedIn: Boolean,
    userRoute: String,
    loginRoute: String,
    registerRoute: String,
  }
}
  
</script>

<style>

</style>