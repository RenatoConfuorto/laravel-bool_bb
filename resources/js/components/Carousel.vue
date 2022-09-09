<template>
  <vueper-slides autoplay duration="4000" :pauseOnHover="false" :bullets="false" fixedHeight="750px">
    <vueper-slide
      v-for="(slide, i) in slides"
      :key="i"
      :title="slide.title"
      :image="slide.image"
    >
    </vueper-slide>
  </vueper-slides>
</template>

<script>
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";

export default {
  name: "Carousel",
  components: {
    VueperSlides,
    VueperSlide,
  },
  props: {
    slides: Array,
  },
};
</script>

<style lang="scss" scoped>
</style>