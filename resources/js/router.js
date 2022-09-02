import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import GuestHomepage from "./pages/GuestHomepage.vue";

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: 'homepage',
      component: GuestHomepage
    },
    {
      path: "/*", //link non riconosciuto
      component: GuestHomepage,
    }
  ]
});

export default router;