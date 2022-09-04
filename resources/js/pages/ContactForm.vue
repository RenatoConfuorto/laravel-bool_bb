<template>
  <div class="container">
    FORM CONTATTO
    <form>
      <div class="form-group">
        <label for="exampleFormControlInput1">Inserisci la tua email per essere ricontattato</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
      </div>
      
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Il tuo messaggio</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'ContactForm'
}
</script>

<style>

</style>