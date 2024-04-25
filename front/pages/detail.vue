<template>
  <div class="wrap">
    <SearchBar></SearchBar>
    <BookDetail></BookDetail>
  </div>
</template>
<script setup lang="ts">
import SearchBar from "~/components/Ui/SearchBar.vue";
import BookDetail from "~/components/Book/BookDetail.vue";
</script>
<style lang="scss" scoped>
@import "./assets/variables.scss";

</style>