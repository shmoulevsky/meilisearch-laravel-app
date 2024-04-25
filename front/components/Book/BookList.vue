<script setup lang="ts">


import Pagination from "~/components/Ui/Pagination.vue";
import {useGenreStore} from "~/store/genres";
import {storeToRefs} from "pinia";

const genresStore = storeToRefs(useGenreStore());

const route = useRoute()
const currentPage = ref(1)



let query:Object = {
  'page' : currentPage,
  'filter[q]' : route.query['filter[q]'] ?? null,
  'filter[genre_id]' : route.params.genre_id ?? null,
  'filter[author_id]' : route.params.author_id ?? null,
  'filter[genres]' : genresStore.genreIds,
}


const {data:books} = await useMyFetch(`/api/v1/books?`, {
  query,
  watch: [currentPage, genresStore.genreIds]
})

function navClick(page:string){
  currentPage.value = page;
}

</script>
<template>
  <h1>Books list</h1>
  <div v-if="books?.data" class="adv-list">
    <p v-if="books?.description">{{books?.description}}</p>
    <BookItem v-for="(item, key) in books.data" :key="key" :item="item"></BookItem>
    <Pagination
        :links=books?.meta?.links
        @navClick="navClick"
    ></Pagination>
  </div>
  <div v-if="books?.data?.length === 0">
    <p>No books</p>
  </div>
</template>