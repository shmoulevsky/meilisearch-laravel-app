<template>
  <div class="search-wrap">
    <input @keyup.enter="search()" @input="fastSearch()" @focusout="hideFastSearch()" v-model="q" class="search" type="text" value="">
    <button @click="search()">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.1533 13.1255L17 17M15.2222 8.11111C15.2222 12.0385 12.0385 15.2222 8.11111 15.2222C4.18375 15.2222 1 12.0385 1 8.11111C1 4.18375 4.18375 1 8.11111 1C12.0385 1 15.2222 4.18375 15.2222 8.11111Z" stroke="#D04907" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    <ul v-if="isShowFastSearch"  class="fast-search">
      <li v-for="(result, key) in fastSearchResults" :key="key" @click="navigateDetail(result.url)">{{result.title}}</li>
    </ul>
  </div>
</template>

<script setup lang="ts">

const q = ref('')
const isShowFastSearch = ref(false)
let fastSearchResults = reactive([])


async function search(){

  await navigateTo({
    path: '/books/search',
    query: {
      page: 1,
      'filter[q]':  q.value
    }
  })
}

async function fastSearch(){

  if(q.value.length <= 2) return

  const {data} = await useMyFetch(`/api/v1/books/search/fast?`, {
    query: {
      q: q.value
    }
  })
  fastSearchResults = data.value.data;
  isShowFastSearch.value = true
}

async function navigateDetail(url:string){
  isShowFastSearch.value = false
  await navigateTo({
    path: url
  })
}

function hideFastSearch(){
  setTimeout(() => {isShowFastSearch.value = false}, 200)
}

</script>

<style lang="scss" scoped>
@import "./assets/variables.scss";

.search-wrap{
  display: flex;
  position: relative;
  margin-bottom: 20px;
}

.search{
  border: 1px solid #bbb;
  border-radius: 4px;
  width: 100%;
  height: 40px;
  padding: 0 1rem;
  position: relative;
}

button{
  border: 0px;
  background-color: transparent;
  position: absolute;
  right: 14px;
  top: 12px;
}



.fast-search{
  width: 100%;
  position: absolute;
  top: 38px;
  background-color: #fff;
  z-index: 10;
  border: 1px solid #ccc;
  padding: 0;
}

.fast-search li{
  list-style-type: none;
  cursor: pointer;
  padding: 0.4rem 0.2rem 0.2rem 1.2rem;
}

.fast-search li:hover{
  background-color: $primaryLightColor;
}

</style>