<template>
  <div style="margin-top: 20px;">
    <span>Галерея изображений</span>
    <div  v-if="posts.length > 0" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
      <Post v-for="post in posts" :key="post.id" :post="post"/>
    </div>
    <div v-else>Нет данных</div>
  </div>
</template>

<script setup>
import { defineProps, ref, watch } from "vue";

const props = defineProps(["posts"]);
const posts = ref(props.posts);

watch(() => props.posts,
    () => { posts.value = props.posts }
);

</script>