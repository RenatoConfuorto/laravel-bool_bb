<template>
  <div class="container">
    FORM CONTATTO
    <form class="mt-3 position-relative" action="" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label for="email">Inserisci la tua email per essere ricontattato</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required v-model="email">
      </div>
      
      <div class="form-group">
        <label for="text">Il tuo messaggio</label>
        <textarea type="text" class="form-control" id="text" rows="5" name="text" required v-model="text"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'ContactForm',
  data() {
    return {
      email: '',
      text: '',
    }

  },
  methods: {
    submitForm() {
      let message = {
        email: this.email,
        text: this.text,
      };
    }
  }
}
</script>

<style>

</style>