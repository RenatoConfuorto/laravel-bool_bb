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
          text: 'Home',
          link: '/',
          visible: true,
          router: true,
        },
        {
          text: 'User',
          link: this.userRoute,
          visible: this.loggedIn,
          router: false,
        },
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

<style lang="scss" scoped>
  nav {
    width: 100%;
    height: 50px;
    background-color: #1d1d1d;
    line-height: 50px;
    vertical-align: middle;
    padding: 0 2.5rem;

    ul {
      list-style: none;
      display: flex;
      flex-grow: 1;
      justify-content: flex-end;

      :first-child {
        margin-right: auto;
      }

      li  {
        margin-right: 1rem;
        font-size: 1rem;
        a {
          text-decoration: none;
          color: #db0356;
        }
      }
    }
  }
</style>