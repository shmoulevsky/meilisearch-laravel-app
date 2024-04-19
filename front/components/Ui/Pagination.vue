<template>
  <nav aria-label="Page navigation">
    <ul v-if="links && links.length > 3" class="pagination">
      <li v-for="link in links" class="page-item">
        <NuxtLink :class="[link.active === true ? 'active' : '']" @click="navClick(link.label)" class="page-link" v-html="link.label"></NuxtLink>
      </li>
    </ul>
  </nav>

</template>

<script setup lang="ts">


const props = defineProps<{ links: Array<any> }>()
const emit = defineEmits(['navClick'])

function navClick(page:string){
  emit('navClick', page);
}

</script>

<style lang="scss" scoped>
@import "./assets/variables.scss";

.pagination{
  display: flex;
}

.pagination li{
  list-style-type: none;
}

.pagination a{
  cursor: pointer;
  display: block;
  padding: 0.2rem 0.5rem;
  margin-right: 0.4rem;
  border: 1px solid #ccc;
  border-radius: 2px;
}

.pagination a:hover{
  color: $secondaryColor;
}

.pagination a.active{
  background-color: $primaryColor;
}

.pagination a.active:hover{
  color: #fff;
}

</style>