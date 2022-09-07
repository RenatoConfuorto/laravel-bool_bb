<template>
  <div class="container-fluid d-flex justify-content-center flex-wrap">
    <!-- PAGINATION NAV -->
    <nav aria-label="...">
      <ul class="pagination">
        <!-- PREVIUOS PAGE -->
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a class="page-link" href="#" @click="getApartments(currentPage - 1)"
            >Previous</a
          >
        </li>
        <!-- /PREVIUOS PAGE -->

        <!-- PAGES NUMBER -->
        <li
          class="page-item"
          :class="{ active: currentPage === n }"
          v-for="n in lastPage"
          :key="n"
        >
          <a
            class="page-link"
            href="#"
            @click="getApartments((currentPage = n))"
            >{{ n }}</a
          >
        </li>
        <!-- /PAGES NUMBER -->

        <!-- NEXT PAGE -->
        <li class="page-item" :class="{ disabled: currentPage === lastPage }">
          <a class="page-link" href="#" @click="getApartments(currentPage + 1)"
            >Next</a
          >
        </li>
        <!-- /NEXT PAGE -->
      </ul>
    </nav>
    <!-- /PAGINATION NAV -->
  </div>
</template>

<script>
export default {
  name: 'paginationNav',
  props: {
    currentPage: Number,
    lastPage: Number,
    getApartments: Function,
  }
};
</script>

<style>
</style>