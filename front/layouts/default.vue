<template>
  <div class="wrapper">
  <AppHeader />
  <div>
    <slot />
  </div>
  <AppFooter />
  </div><!--/wrapper-->
</template>
<script lang="ts" setup>

import AppHeader from "~/components/Ui/AppHeader.vue";
import AppFooter from "~/components/Ui/AppFooter.vue";
</script>
