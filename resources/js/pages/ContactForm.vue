<template>
  <!-- GENERAL CONTAINER -->
  <div class="container">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid d-flex flex-column align-items-center">
      <div class="text-center">
        <h4 class="bg-info p-1 rounded-top rounded-bottom">Stai inviando un messaggio al proprietario di questo appartmento</h4>
      </div>
      <!-- APARTMENT DETAILS -->
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" :src="apartment.image" :alt="apartment.title">
        <div class="card-body">
          <h5 class="card-title">{{ apartment.title }}</h5>
          <p class="card-text">{{ apartment.address }}</p>
        </div>
      </div>
      <!-- /APARTMENT DETAILS -->
    </div>

    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
      <!-- CONTACT FORM -->
      <form class="mt-3 position-relative" @submit.prevent="submitForm" enctype="multipart/form-data">

        <div class="form-group">
          <label for="email">Inserisci la tua email per essere ricontattato</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required v-model="form.email">
        </div>
        
        <div class="form-group">
          <label for="text">Il tuo messaggio</label>
          <textarea type="text" class="form-control" id="text" rows="5" name="text" required v-model="form.text"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <!-- /CONTACT FORM -->
    </div>
    <!-- /CONTAINER FLUID -->
  </div>
  <!-- /GENERAL CONTAINER -->
</template>

<script>
export default {
  name: 'ContactForm',
  data() {
    return {
      apartment: {},
      form: {
        apartment_id: 0,
        email: '',
        text: '',
      }
    }
  },
  created() {
    this.getApartmentDetails();
  },
  methods: {
    getApartmentDetails() {
      const slug = this.$route.params.slug;

      axios.get(`http://127.0.0.1:8000/api/apartments/${slug}`)
      .then((resp) => {
        if (resp.data.success) {
          this.apartment = resp.data.results;
          this.form.apartment_id = resp.data.results.id;
        } else {
          // per adesso reindirizza alla homepage, da gestire meglio
          this.$router.push({ name: 'homepage' });
        }
      });
    },
    submitForm() {
      axios.post('http://127.0.0.1:8000/api/message', this.form)
      .then((resp) => {
        console.log(resp);
      });
    }
  }
}
</script>

<style>

</style>