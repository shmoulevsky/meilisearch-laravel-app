<script setup lang="ts">


import Pagination from "~/components/Ui/Pagination.vue";

const route = useRoute()
const currentPage = ref(1)


let query:Object = {
  'url' : route.path,
  'page' : currentPage
}


const {data:books} = await useMyFetch(`/api/v1/books?`, {
  query,
  watch: [currentPage.value]
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