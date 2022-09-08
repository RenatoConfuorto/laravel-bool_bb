<template>
  <footer>
    <div class="info">
      <p>
      500 Terry Francois Street, <br>
      San Francisco, CA 94158  |  1-800-000-0000
      </p>
    </div>

    <div class="socials">
      <i class="fa-brands fa-twitter"></i>
      <i class="fa-brands fa-facebook-f"></i>
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-tiktok"></i>
    </div>

    <div class="copyright">
      <i class="far fa-copyright"></i>
      2022 Boolean class #62 - Team #7
    </div>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter',
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';
@import '../../sass/frontOffice.scss';


footer{
  padding: 1rem;
  margin: 1rem $main-side;;
  border-top: 1px solid $text-primary-color;

  .info{
    font-size: 0.8rem;
  }

  .socials{
    font-size: 1.3rem;
    margin: 1.3rem 0 0.8rem;

    i{
      margin: 0 5px;
    }
  }

  .copyright{
    font-size: 0.7rem;
  }
}
</style>