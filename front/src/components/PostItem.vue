<template>
  <div style="display:flex;align-items:center;justify-content:center;">
    <RouterLink :to="'/posts/' + post.id">
      <img :src="post.image_path" :alt="post.name" style="max-width: 400px; max-height: 400px;">
    </RouterLink>
  </div>
</template>

<script setup>
import { ref, defineProps } from "vue";

const props = defineProps(["post"]);
const post = ref(props.post);

</script>
