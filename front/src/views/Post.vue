<template>
  <div style="height: calc(100% - 90px); width: 100%; height: 100%;display:flex;align-items:center;justify-content:center;">
    <img v-if="post" :src="post.image_path" :alt="post.name">
  </div>
</template>

<script setup>
import { onMounted, ref, defineProps } from "vue";
import axios from "axios";

const props = defineProps(["id"]);
const id = ref(props.id);
const post = ref();

onMounted(() => {
  fetchPost();
});

const fetchPost = async () => {
  try {
    axios
        .get(import.meta.env.VITE_API_ENDPOINT + "/api/posts/" + id.value)
        .then((response) => {
          if (response.data.status) {
            post.value = response.data.post;
            console.log(post.value)
          }
        });

  } catch (e) {
    console.log(e);
  }
};
</script>

<style scoped>

</style>