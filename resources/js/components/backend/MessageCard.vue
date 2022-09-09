<template>
  <div class="card m-1" style="width: 18rem;">
    <div class="card-body">
      <p>Messaggio ricevuto il: {{ message.created_at }}</p>
      <!-- <h5 class="card-title">{{ message.apartment }}</h5> -->
      <h6 class="card-subtitle mb-2 text-muted">{{ message.email }}</h6>
      <p class="card-text">{{ truncateText(50) }}</p>
      <a :href="routeToDetails" class="card-link">Leggi il messaggio completo</a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MessageCard',
  props: {
    message: Object,
    routeToDetails: String
  },
  methods: {
    truncateText(maxCharNumber) {
      if (this.message.text > maxCharNumber) {
        return this.message.text.substr(0, maxCharNumber) + '...';
      }
      return this.message.text;
    }
  }
}
</script>

<style lang="scss" scoped>

</style>