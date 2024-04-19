<template>
  <div class="wrap">
    <SearchBar></SearchBar>
    <BookList></BookList>
  </div>
</template>
<script setup lang="ts">
import SearchBar from "~/components/Ui/SearchBar.vue";
import BookList from "~/components/Book/BookList.vue";
</script>
<style lang="scss" scoped>
@import "./assets/variables.scss";

</style>