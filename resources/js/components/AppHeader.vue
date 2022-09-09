<template>
  <header>
    <nav>
      <div class="logo">
        <h1>Bool B&B</h1>
      </div>
      <ul>
        <li v-for="(link, index) in links" :key="index" v-if="link.visible">
          <a v-if="!link.router" :href="link.link">{{ link.text }}</a>
          <router-link v-else :to="{ name: link.name }">{{
            link.text
          }}</router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "AppHeader",
  data() {
    return {
      links: [
        {
          text: "Home",
          name: "homepage",
          visible: true,
          router: true,
        },
        {
          text: "Appartamenti",
          name: "apartments",
          visible: true,
          router: true,
        },
        {
          text: "Login", //testo del link
          link: this.loginRoute, //link
          visible: !this.loggedIn, //se il link può essere visto o meno
          router: false,
        },
        {
          text: "Register",
          link: this.registerRoute,
          visible: !this.loggedIn,
          router: false,
        },
        {
          text: "User",
          link: this.userRoute,
          visible: this.loggedIn,
          router: false,
        },
      ],
    };
  },
  props: {
    loggedIn: Boolean,
    userRoute: String,
    loginRoute: String,
    registerRoute: String,
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/_variables.scss";
header {
  width: 100%;
  box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 10px;
  nav {
    max-width: $main-max-width;
    margin: 0 auto;
    padding: $main-padding;
    height: $header-height;
    display: flex;
    justify-content: space-between;
    align-items: center;
    .logo {
      padding: 0 0.3rem;
      border-left: 1px solid $text-primary-color;

      h1 {
        font-size: 2.2rem;
        font-weight: 500;
        margin: 0;
        cursor: default;
      }
    }

    ul {
      margin-right: 1rem;
      height: 100%;
      display: flex;
      justify-content: flex-end;
      align-items: center;

      li {
        margin: 0 0.5rem;

        a {
          text-decoration: none;
          color: $text-primary-color;
          padding: 0.3rem 0.5rem;
        }

        &:hover {
          border-bottom: 1px solid black;
        }
      }
    }
  }
}
</style>