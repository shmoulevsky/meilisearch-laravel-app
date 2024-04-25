<template>
    <RouterLink v-for="item in items" :to=item.url class="genre">
      {{item.title}}
    </RouterLink>
</template>

<script setup lang="ts">

const props = defineProps({
  items: Array,
})

</script>

<style lang="scss" scoped>
@import "./assets/variables.scss";

.genre{
  color: #111;
  margin-right: 1rem;
}

</style>