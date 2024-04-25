<script setup lang="ts">

const route = useRoute()
let id = route.params.id

const {data:book} = await useMyFetch(`/api/v1/books/` + id)

</script>
<template>
  <h1>{{book.data.title}}</h1>
  <RouterLink class="author" :to=book.data.author_url>{{book.data.author}}</RouterLink>
  <div class="genre-wrap">
    <BookGenreList :items=book.data.genres></BookGenreList>
  </div>

  <div>
    <p>{{book.data.description}}</p>
  </div>
</template>

<style lang="scss" scoped>
@import "./assets/variables.scss";

.author{
  font-size: 16px;
  font-weight: bold;
  display: block;
  color: #777;
  text-decoration: none;
}

.title{
  font-size: 18px;
  display: block;
  text-decoration: none;
}

.rating{
  font-size: 14px;
  color: #777;
}

.count{
  font-size: 14px;
  color: #777;
  margin-left: 1rem;
}

.genre-wrap{
  margin: 1rem 0;
}

</style>