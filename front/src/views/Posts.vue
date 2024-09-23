<script setup>
import { onMounted, ref, reactive } from 'vue';
import axios from "axios";

const inputs = reactive({ items: [{ id: 0 }] });
const posts = ref([]);
const fileInputs = ref([]);

onMounted(async () => {
  fetchPosts();
});

const formData = ref({
  accept: 'application/jpeg,.jpeg,.jpg,.png',
  files: []
});

const storePost = async () => {
  const formdata = new FormData();

  if (formData.value.files.length > 0) {
    for (let i = 0; i < formData.value.files.length; i++) {
      formdata.append('files[]', formData.value.files[i]);
    }
  }

  try {
    axios
      .post(import.meta.env.VITE_API_ENDPOINT + "/api/posts", formdata)
      .then((response) => {
        if (response.data.status) {
          fetchPosts();
          formData.value.files = [];
          fileInputs.value.forEach((element, idx) => {
            if (idx !== 0) {
              element.remove()
            } else {
              element.querySelector('input').value = null;
            }
          });
        }
      });

  } catch (e) {
    console.log(e);
  }
};

const fetchPosts = async () => {
  try {
    axios
        .get(import.meta.env.VITE_API_ENDPOINT + "/api/posts")
        .then((response) => {
          if (response.data.status) {
            posts.value = response.data.posts;
          }
        });

  } catch (e) {
    console.log(e);
  }
};

const addFileInput = () => {
  inputs.items.push({id: inputs.items.length})
};

const removeFileInput = (index) => {
  if (inputs.items.length > 1) {
    inputs.items.splice(index, 1)
    formData.value.files.splice(index, 1)
  }
};

const handleChangeFile = (e) => {
  formData.value.files.push(e.target.files[0]);
};

</script>

<template>
  <div style="height: calc(100% - 90px); width: 100%; height: 100%;">
    <div>
      <label>Добавить файлы</label>
      <div style="margin-top: 10px;">
        <div v-for="(input, index) in inputs.items" :key="input.id" ref="fileInputs">
          <div style="display: flex">
            <input :style="index > 0 ? 'margin-top:5px' : ''" :accept="formData.accept" @change="handleChangeFile" aria-describedby="file" type="file">
            <div
                class="flex"
                :style="index > 0 ? 'margin-top:5px' : ''"
            >
              <button
                  @click="addFileInput"
              >+</button>
              <button
                  @click="removeFileInput(index)"
              >-</button>
            </div>
          </div>
        </div>
      </div>
      <button @click="storePost">Сохранить</button>
    </div>
    <Gallery :posts="posts" />
  </div>
</template>
