<template>
    <div class="genres">
      <div class="genre-item" v-for="genre in genres.data" >
        <span @click="filterGenre(genre)" :class="genre.active ? 'active' : ''" class="title">{{genre.title}} ({{genre.count}})</span>
      </div>
    </div>

</template>

<script setup lang="ts">

import {useGenreStore} from "~/store/genres";

const genresStore = useGenreStore();
const {data:genres} = await useMyFetch(`/api/v1/genres`)

function filterGenre(genre:any){

  genre.active = !genre.active;
  console.log(genre.active)

  if(genre.active){
    genresStore.push(genre)
    return
  }

  genresStore.remove(genre)

}

</script>

<style lang="scss" scoped>
@import "./assets/variables.scss";

.genres{
  display: flex;
  flex-wrap: wrap;
}

.genre-item{
  margin:0px 10px 10px 0px;
  font-size: 14px;
  cursor: pointer;
}

.genre-item span{
  padding: 2px 5px;
  border-radius: 2px;
}

.active{
  background-color: #1e7e34;
  color: #fff;
}

</style>