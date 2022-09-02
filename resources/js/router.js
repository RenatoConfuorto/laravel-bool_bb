import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import GuestHomepage from "./pages/GuestHomepage.vue";
import SingleApartment from "./pages/SingleApartment.vue";

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
    },
    {
      path: "/:slug",
      name: "single-apartment",
      component: SingleApartment
    },
  ]
});

export default router;