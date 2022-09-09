import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import GuestHomepage from "./pages/GuestHomepage.vue";
import AdvancedSearch from "./pages/AdvancedSearch.vue";
import SingleApartment from "./pages/SingleApartment.vue";
import ContactForm from "./pages/ContactForm.vue";

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: 'homepage',
      component: GuestHomepage
    },
    {
      path: "/search",
      name: 'advanced-search',
      component: AdvancedSearch
    },
    {
      path: "/:slug",
      name: "single-apartment",
      component: SingleApartment
    },
    {
      path: "/:slug/contact",
      name: "contact-form",
      component: ContactForm
    },
    {
      path: "/*", //link non riconosciuto
      component: GuestHomepage,
    },
  ]
});

export default router;